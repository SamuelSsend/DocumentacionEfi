<?php

namespace Doctrine\DBAL\Schema;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Exception;
use Doctrine\DBAL\Platforms\OraclePlatform;
use Doctrine\DBAL\Types\Type;
use Throwable;

use function array_change_key_case;
use function array_values;
use function assert;
use function is_string;
use function preg_match;
use function sprintf;
use function str_replace;
use function strpos;
use function strtolower;
use function strtoupper;
use function trim;

use const CASE_LOWER;

/**
 * Oracle Schema Manager.
 */
class OracleSchemaManager extends AbstractSchemaManager
{
    /**
     * {@inheritdoc}
     */
    public function dropDatabase($database)
    {
        try {
            parent::dropDatabase($database);
        } catch (DBALException $exception) {
            $exception = $exception->getPrevious();
            assert($exception instanceof Throwable);

            if (! $exception instanceof Exception) {
                throw $exception;
            }

            // If we have a error code 1940 (ORA-01940), the drop database operation failed
            // because of active connections on the database.
            // To force dropping the database, we first have to close all active connections
            // on that database and issue the drop database operation again.
            if ($exception->getErrorCode() !== 1940) {
                throw $exception;
            }

            $this->killUserSessions($database);

            parent::dropDatabase($database);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableViewDefinition($view)
    {
        $view = array_change_key_case($view, CASE_LOWER);

        return new View($this->getQuotedIdentifierName($view['view_name']), $view['text']);
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableUserDefinition($user)
    {
        $user = array_change_key_case($user, CASE_LOWER);

        return [
            'user' => $user['username'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableTableDefinition($table)
    {
        $table = array_change_key_case($table, CASE_LOWER);

        return $this->getQuotedIdentifierName($table['table_name']);
    }

    /**
     * {@inheritdoc}
     *
     * @link http://ezcomponents.org/docs/api/trunk/DatabaseSchema/ezcDbSchemaPgsqlReader.html
     */
    protected function _getPortableTableIndexesList($tableIndexes, $tableName = null)
    {
        $indexBuffer = [];
        foreach ($tableIndexes as $tableIndex) {
            $tableIndex = array_change_key_case($tableIndex, CASE_LOWER);

            $keyName = strtolower($tableIndex['name']);
            $buffer  = [];

            if ($tableIndex['is_primary'] === 'P') {
                $keyName              = 'primary';
                $buffer['primary']    = true;
                $buffer['non_unique'] = false;
            } else {
                $buffer['primary']    = false;
                $buffer['non_unique'] = ! $tableIndex['is_unique'];
            }

            $buffer['key_name']    = $keyName;
            $buffer['column_name'] = $this->getQuotedIdentifierName($tableIndex['column_name']);
            $indexBuffer[]         = $buffer;
        }

        return parent::_getPortableTableIndexesList($indexBuffer, $tableName);
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableTableColumnDefinition($tableColumn)
    {
        $tableColumn = array_change_key_case($tableColumn, CASE_LOWER);

        $dbType = strtolower($tableColumn['data_type']);
        if (strpos($dbType, 'timestamp(') === 0) {
            if (strpos($dbType, 'with time zone')) {
                $dbType = 'timestamptz';
            } else {
                $dbType = 'timestamp';
            }
        }

        $unsigned = $fixed = $precision = $scale = $length = null;

        if (! isset($tableColumn['column_name'])) {
            $tableColumn['column_name'] = '';
        }

        // Default values returned from database sometimes have trailing spaces.
        if (is_string($tableColumn['data_default'])) {
            $tableColumn['data_default'] = trim($tableColumn['data_default']);
        }

        if ($tableColumn['data_default'] === '' || $tableColumn['data_default'] === 'NULL') {
            $tableColumn['data_default'] = null;
        }

        if ($tableColumn['data_default'] !== null) {
            // Default values returned from database are represented as literal expressions
            if (preg_match('/^\'(.*)\'$/s', $tableColumn['data_default'], $matches)) {
                $tableColumn['data_default'] = str_replace("''", "'", $matches[1]);
            }
        }

        if ($tableColumn['data_precision'] !== null) {
            $precision = (int) $tableColumn['data_precision'];
        }

        if ($tableColumn['data_scale'] !== null) {
            $scale = (int) $tableColumn['data_scale'];
        }

        $type                    = $this->_platform->getDoctrineTypeMapping($dbType);
        $type                    = $this->extractDoctrineTypeFromComment($tableColumn['comments'], $type);
        $tableColumn['comments'] = $this->removeDoctrineTypeFromComment($tableColumn['comments'], $type);

        switch ($dbType) {
        case 'number':
            if ($precision === 20 && $scale === 0) {
                $type = 'bigint';
            } elseif ($precision === 5 && $scale === 0) {
                $type = 'smallint';
            } elseif ($precision === 1 && $scale === 0) {
                $type = 'boolean';
            } elseif ($scale > 0) {
                $type = 'decimal';
            }

            break;

        case 'varchar':
        case 'varchar2':
        case 'nvarchar2':
            $length = $tableColumn['char_length'];
            $fixed  = false;
            break;

        case 'char':
        case 'nchar':
            $length = $tableColumn['char_length'];
            $fixed  = true;
            break;
        }

        $options = [
            'notnull'    => $tableColumn['nullable'] === 'N',
            'fixed'      => (bool) $fixed,
            'unsigned'   => (bool) $unsigned,
            'default'    => $tableColumn['data_default'],
            'length'     => $length,
            'precision'  => $precision,
            'scale'      => $scale,
            'comment'    => isset($tableColumn['comments']) && $tableColumn['comments'] !== ''
                ? $tableColumn['comments']
                : null,
        ];

        return new Column($this->getQuotedIdentifierName($tableColumn['column_name']), Type::getType($type), $options);
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableTableForeignKeysList($tableForeignKeys)
    {
        $list = [];
        foreach ($tableForeignKeys as $value) {
            $value = array_change_key_case($value, CASE_LOWER);
            if (! isset($list[$value['constraint_name']])) {
                if ($value['delete_rule'] === 'NO ACTION') {
                    $value['delete_rule'] = null;
                }

                $list[$value['constraint_name']] = [
                    'name' => $this->getQuotedIdentifierName($value['constraint_name']),
                    'local' => [],
                    'foreign' => [],
                    'foreignTable' => $value['references_table'],
                    'onDelete' => $value['delete_rule'],
                ];
            }

            $localColumn   = $this->getQuotedIdentifierName($value['local_column']);
            $foreignColumn = $this->getQuotedIdentifierName($value['foreign_column']);

            $list[$value['constraint_name']]['local'][$value['position']]   = $localColumn;
            $list[$value['constraint_name']]['foreign'][$value['position']] = $foreignColumn;
        }

        $result = [];
        foreach ($list as $constraint) {
            $result[] = new ForeignKeyConstraint(
                array_values($constraint['local']),
                $this->getQuotedIdentifierName($constraint['foreignTable']),
                array_values($constraint['foreign']),
                $this->getQuotedIdentifierName($constraint['name']),
                ['onDelete' => $constraint['onDelete']]
            );
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableSequenceDefinition($sequence)
    {
        $sequence = array_change_key_case($sequence, CASE_LOWER);

        return new Sequence(
            $this->getQuotedIdentifierName($sequence['sequence_name']),
            (int) $sequence['increment_by'],
            (int) $sequence['min_value']
        );
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated
     */
    protected function _getPortableFunctionDefinition($function)
    {
        $function = array_change_key_case($function, CASE_LOWER);

        return $function['name'];
    }

    /**
     * {@inheritdoc}
     */
    protected function _getPortableDatabaseDefinition($database)
    {
        $database = array_change_key_case($database, CASE_LOWER);

        return $database['username'];
    }

    /**
     * {@inheritdoc}
     *
     * @param string|null $database
     *
     * Calling this method without an argument or by passing NULL is deprecated.
     */
    public function createDatabase($database = null)
    {
        if ($database === null) {
            $database = $this->_conn->getDatabase();
        }

        $statement = 'CREATE USER ' . $database;

        $params = $this->_conn->getParams();

        if (isset($params['password'])) {
            $statement .= ' IDENTIFIED BY ' . $params['password'];
        }

        $this->_conn->executeStatement($statement);

        $statement = 'GRANT DBA TO ' . $database;
        $this->_conn->executeStatement($statement);
    }

    /**
     * @param string $table
     *
     * @return bool
     */
    public function dropAutoincrement($table)
    {
        assert($this->_platform instanceof OraclePlatform);

        $sql = $this->_platform->getDropAutoincrementSql($table);
        foreach ($sql as $query) {
            $this->_conn->executeStatement($query);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function dropTable($name)
    {
        $this->tryMethod('dropAutoincrement', $name);

        parent::dropTable($name);
    }

    /**
     * Returns the quoted representation of the given identifier name.
     *
     * Quotes non-uppercase identifiers explicitly to preserve case
     * and thus make references to the particular identifier work.
     *
     * @param string $identifier The identifier to quote.
     *
     * @return string The quoted identifier.
     */
    private function getQuotedIdentifierName($identifier)
    {
        if (preg_match('/[a-z]/', $identifier)) {
            return $this->_platform->quoteIdentifier($identifier);
        }

        return $identifier;
    }

    /**
     * Kills sessions connected with the given user.
     *
     * This is useful to force DROP USER operations which could fail because of active user sessions.
     *
     * @param string $user The name of the user to kill sessions for.
     *
     * @return void
     */
    private function killUserSessions($user)
    {
        $sql = <<<SQL
SELECT
    s.sid,
    s.serial#
FROM
    gv\$session s,
    gv\$process p
WHERE
    s.username = ?
    AND p.addr(+) = s.paddr
SQL;

        $activeUserSessions = $this->_conn->fetchAllAssociative($sql, [strtoupper($user)]);

        foreach ($activeUserSessions as $activeUserSession) {
            $activeUserSession = array_change_key_case($activeUserSession, CASE_LOWER);

            $this->_execSql(
                sprintf(
                    "ALTER SYSTEM KILL SESSION '%s, %s' IMMEDIATE",
                    $activeUserSession['sid'],
                    $activeUserSession['serial#']
                )
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function listTableDetails($name): Table
    {
        $table = parent::listTableDetails($name);

        $platform = $this->_platform;
        assert($platform instanceof OraclePlatform);
        $sql = $platform->getListTableCommentsSQL($name);

        $tableOptions = $this->_conn->fetchAssociative($sql);

        if ($tableOptions !== false) {
            $table->addOption('comment', $tableOptions['COMMENTS']);
        }

        return $table;
    }
}
