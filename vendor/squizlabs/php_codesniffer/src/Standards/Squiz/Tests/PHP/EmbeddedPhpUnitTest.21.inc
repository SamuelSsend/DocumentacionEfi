<?php
// This test case file MUST always start with a long open PHP tag set (with this comment) to prevent
// the tests running into the "first PHP open tag excepted" condition breaking the tests.
// Tests related to that "first PHP open tag excepted" condition should go in separate files.
?>
<!--
The complete tag block will **NOT** be ignored when it is the last (closed) tag block in a file
as long as it is followed by non-empty inline HTML.
-->
<div>
<?php echo
    'too much indent and close tag not on own line'; ?>

</div>
<p>Some more content after the last PHP tag block.</p>
