<?php

namespace Doctrine\DBAL\Driver\PDOPgSql;

use Doctrine\DBAL\Driver\AbstractPostgreSQLDriver;
use Doctrine\DBAL\Driver\PDO;
use Doctrine\DBAL\Exception;
use Doctrine\Deprecations\Deprecation;
use PDOException;

use function defined;

/**
 * Driver that connects through pdo_pgsql.
 *
 * @deprecated Use {@link PDO\PgSQL\Driver} instead.
 */
class Driver extends AbstractPostgreSQLDriver
{
    /**
     * {@inheritdoc}
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
    {
        try {
            $pdo = new PDO\Connection(
                $this->_constructPdoDsn($params),
                $username,
                $password,
                $driverOptions
            );

            if (defined('PDO::PGSQL_ATTR_DISABLE_PREPARES')
                && (! isset($driverOptions[\PDO::PGSQL_ATTR_DISABLE_PREPARES])
                || $driverOptions[\PDO::PGSQL_ATTR_DISABLE_PREPARES] === true)
            ) {
                $pdo->setAttribute(\PDO::PGSQL_ATTR_DISABLE_PREPARES, true);
            }

            /* defining client_encoding via SET NAMES to avoid inconsistent DSN support
             * - the 'client_encoding' connection param only works with postgres >= 9.1
             * - passing client_encoding via the 'options' param breaks pgbouncer support
             */
            if (isset($params['charset'])) {
                $pdo->exec('SET NAMES \'' . $params['charset'] . '\'');
            }

            return $pdo;
        } catch (PDOException $e) {
            throw Exception::driverException($this, $e);
        }
    }

    /**
     * Constructs the Postgres PDO DSN.
     *
     * @param mixed[] $params
     *
     * @return string The DSN.
     */
    private function _constructPdoDsn(array $params)
    {
        $dsn = 'pgsql:';

        if (isset($params['host']) && $params['host'] !== '') {
            $dsn .= 'host=' . $params['host'] . ';';
        }

        if (isset($params['port']) && $params['port'] !== '') {
            $dsn .= 'port=' . $params['port'] . ';';
        }

        if (isset($params['dbname'])) {
            $dsn .= 'dbname=' . $params['dbname'] . ';';
        } elseif (isset($params['default_dbname'])) {
            $dsn .= 'dbname=' . $params['default_dbname'] . ';';
        } else {
            // Used for temporary connections to allow operations like dropping the database currently connected to.
            // Connecting without an explicit database does not work, therefore "postgres" database is used
            // as it is mostly present in every server setup.
            $dsn .= 'dbname=postgres;';
        }

        if (isset($params['sslmode'])) {
            $dsn .= 'sslmode=' . $params['sslmode'] . ';';
        }

        if (isset($params['sslrootcert'])) {
            $dsn .= 'sslrootcert=' . $params['sslrootcert'] . ';';
        }

        if (isset($params['sslcert'])) {
            $dsn .= 'sslcert=' . $params['sslcert'] . ';';
        }

        if (isset($params['sslkey'])) {
            $dsn .= 'sslkey=' . $params['sslkey'] . ';';
        }

        if (isset($params['sslcrl'])) {
            $dsn .= 'sslcrl=' . $params['sslcrl'] . ';';
        }

        if (isset($params['application_name'])) {
            $dsn .= 'application_name=' . $params['application_name'] . ';';
        }

        return $dsn;
    }

    /**
     * {@inheritdoc}
     *
     * @deprecated
     */
    public function getName()
    {
        Deprecation::trigger(
            'doctrine/dbal',
            'https://github.com/doctrine/dbal/issues/3580',
            'Driver::getName() is deprecated'
        );

        return 'pdo_pgsql';
    }
}
