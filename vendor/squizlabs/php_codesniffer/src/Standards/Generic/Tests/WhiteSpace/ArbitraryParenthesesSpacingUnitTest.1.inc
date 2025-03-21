<?php

/*
 * Make sure the sniff does not act on structures it shouldn't act on.
 * All parentheses have extra spacing around it to test this properly.
 */
$b = functioncall($something);
$b = function ( $something ) {
};
$c = myFunction($arg1, $arg2 = array( ));

function something( $param )
{
}

$d = new MyClass();
$e = new class(  ) {
};

try {
} catch( Exception $e ) {
}

require PATH . 'file.php';

if (in_array($arg1, array( 'foo','bar' )) ) {
}
isset($abc);
unset($abc);
empty($abc);
eval($abc);
exit($abc);
clone( $_date1 <= $_date2 ? $_date1 : $_date2 );
declare( ticks=1 );
list( $post_mime_types, $avail_post_mime_types ) = wp_edit_attachments_query($q);
throw( $e );
yield from ( function () {
} );

$obj->{$var}($foo, $bar);

$bar(
    function ( $a, $b ) {
        return function ( $c, $d ) use ( $a, $b ) {
            echo $a, $b, $c, $d;
        };
    }
)('a', 'b')('c', 'd');

$closure($foo, $bar);
$var = $closure() + $closure($foo, $bar) + self::$closure($foo, $bar);

class Test
{
    public static function baz( $foo, $bar )
    {
        $a = new self($foo, $bar);
        $b = new static($foo, $bar);
    }
}

/*
 * Test warning for empty parentheses.
 */
$a = 4 + (); // Warning.
$a = 4 + (   ); // Warning.
$a = 4 + (/* Not empty */);

/*
 * Test the actual sniff.
 */
if ((null !== $extra) && ($row->extra !== $extra)) {
}

if (( null !== $extra ) && ( $row->extra !== $extra )) {
} // Bad x 4.

if ((        null !== $extra // Bad x 1.
    && is_int($extra))
    && ( $row->extra !== $extra // Bad x 1.
    || $something      ) // Bad x 1.
) {
}

if (( null !== $extra ) // Bad x 2.
    && ( $row->extra !== $extra ) // Bad x 2.
) {
}

$a = (null !== $extra);
$a = ( null !== $extra ); // Bad x 2.

$sx = $vert ? ($w - 1) : 0;

$this->is_overloaded = ( ( ini_get("mbstring.func_overload") & 2 ) != 0 ) && function_exists('mb_substr'); // Bad x 4.

$image->flip(($operation->axis & 1) != 0, ($operation->axis & 2) != 0);

if ($success && ('nothumb' == $target || 'all' == $target) ) {
}

$directory = ('/' == $file[ strlen($file)-1 ]);

// phpcs:set Generic.WhiteSpace.ArbitraryParenthesesSpacing spacing 1
if ((null !== $extra) && ($row->extra !== $extra)) {
} // Bad x 4.

if (( null !== $extra ) && ( $row->extra !== $extra )) {
}

if ((        null !== $extra // Bad x 1.
    && is_int($extra)) // Bad x 1.
    && ( $row->extra !== $extra
    || $something      ) // Bad x 1.
) {
}

if ((null !== $extra) // Bad x 2.
    && ($row->extra !== $extra) // Bad x 2.
) {
}

$a = (null !== $extra); // Bad x 2.
$a = ( null !== $extra );

$sx = $vert ? ($w - 1) : 0; // Bad x 2.

$this->is_overloaded = ((ini_get("mbstring.func_overload") & 2) != 0) && function_exists('mb_substr'); // Bad x 4.

$image->flip(($operation->axis & 1) != 0, ($operation->axis & 2) != 0); // Bad x 4.

if ($success && ('nothumb' == $target || 'all' == $target) ) {
} // Bad x 2.

$directory = ('/' == $file[ strlen($file)-1 ]); // Bad x 2.

// phpcs:set Generic.WhiteSpace.ArbitraryParenthesesSpacing spacing 0

/*
 * Test handling of ignoreNewlines.
 */
if ((    null !== $extra) && (    $row->extra !== $extra)
) {
} // Bad x 4, 1 x line 123, 2 x line 125, 1 x line 127.


$a = (
    null !== $extra
); // Bad x 2, 1 x line 131, 1 x line 133.

// phpcs:set Generic.WhiteSpace.ArbitraryParenthesesSpacing spacing 1
if ((    null !== $extra) && (    $row->extra !== $extra)
) {
} // Bad x 4, 1 x line 137, 2 x line 139, 1 x line 141.

$a = (
    null !== $extra
); // Bad x 2, 1 x line 144, 1 x line 146.
// phpcs:set Generic.WhiteSpace.ArbitraryParenthesesSpacing spacing 0

// phpcs:set Generic.WhiteSpace.ArbitraryParenthesesSpacing ignoreNewlines true
if ((    null !== $extra) && (    $row->extra !== $extra)
) {
}

$a = (
    null !== $extra
);
// phpcs:set Generic.WhiteSpace.ArbitraryParenthesesSpacing ignoreNewlines false

if (true) {
} ( 1+2) === 3 ? $a = 1 : $a = 2;
class A
{
} ( 1+2) === 3 ? $a = 1 : $a = 2;
function foo()
{
} ( 1+2) === 3 ? $a = 1 : $a = 2;

// Issue #3618.
class NonArbitraryParenthesesWithKeywords
{
    public static function baz( $foo, $bar )
    {
        $a = new self();
        $b = new parent();
        $c = new static();

        // self/static are already tested above, round line 45.
        $d = new parent($foo, $bar);
    }
}

// Test that the match expression does not trigger the sniff.
$b = match (  $a  ) {
    1 => true,
};

// Parentheses after die/exit in a switch case should be ignored.
switch ( $type ) {
case A:
    exit(1);
case B:
    die();
default:
    break;
}
