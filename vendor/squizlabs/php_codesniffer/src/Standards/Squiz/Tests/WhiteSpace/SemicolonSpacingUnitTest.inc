<?php
$test = $this->testThis();
$test = $this->testThis();
$test = $this->testThis();
for ($var = 1   ; $var < 10  ; $var++) {
    echo $var ;
}
$test = $this->testThis()  /* comment here */;
$test = $this->testThis()  /* comment here */  ;

$hello ='foo';
;

$sum = $a /* + $b */;
$sum = $a // + $b
;
$sum = $a /* + $b
    + $c */ ;

/*
 * Test that the sniff does *not* throw incorrect errors for semicolons in
 * "empty" parts of a `for` control structure.
 */
for ($i = 1; ; $i++) {
}
for ( ; $ptr >= 0; $ptr-- ) {
}
for ( ; ; ) {
}

// But it should when the semicolon in a `for` follows a comment (but shouldn't move the semicolon).
for ( /* Deliberately left empty. */ ; $ptr >= 0; $ptr-- ) {
}
for ( $i = 1 ; /* Deliberately left empty. */ ; $i++ ) {
}

switch ($foo) {
case 'foo':
    ;
    break
    ;
}

// This is an empty statement and should be ignored.
if ($foo) {
    ;
}
