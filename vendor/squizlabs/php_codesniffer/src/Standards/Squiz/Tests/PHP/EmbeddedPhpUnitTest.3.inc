<?php
// This test case file MUST always start with a long open PHP tag set (with this comment) to prevent
// the tests running into the "first PHP open tag excepted" condition breaking the tests.
// Tests related to that "first PHP open tag excepted" condition should go in separate files.

// This test case file only deals with SHORT OPEN ECHO TAGS.
?>
<html>
<head>
<title><?php echo $title ?></title>
<script><?php echo $script; ?></script>
</head>
<body>
    <?php echo
        $body;
    ?>
    hello
    <?php echo
    $moreBody;
    ?>
    <?php echo  'one'; ?>
    <?php echo  'two';   ?>
    <?php echo 'three;' ?>
    <?php echo 'fourA'; echo 'fourB;'; ?>
    <?php echo  'fiveA'; echo 'fiveB;';   ?>

    <?php echo

        $start - $indent + $end;

    ?>
    <?php echo

    $blankLines;

    ?>

    <?php echo
    $closerNeedsOwnLine; ?>
    <?php echo $openerNeedsOwnLine;
    ?>

            <?php echo
            'hi';
            ?>

    <?php echo
    'hi';
    ?>

    <a onClick="Javascript: set_hidden_field('<?php echo $link_offset - $num_per_page; ?>'); set_hidden_field('process_form', '0'); submit_form(); return false;">

            <strong><?php echo
            'foo';
            ?></strong>

</body>
</html>

<?php echo 'okay'; // Something. ?>
<?php echo 'too much space before close'; // Something.      ?>
<?php echo 'no space before close'; // Something.?>

<?php echo 'okay'; /* translators: okay */ ?>
<?php echo 'oops' /* translators: no space before close */?>
<?php echo 'oops' /* translators: too much space before close */      ?>

<?php echo 'okay'; // phpcs:ignore Standard.Category.Sniff -- reason. ?>
<?php echo 'too much space before close'; // phpcs:ignore Standard.Category.Sniff -- reason.    ?>
<?php echo 'no space before close'; // phpcs:ignore Standard.Category.Sniff -- reason.?>

<!--
Make sure the "content after opener" fixer does not leave trailing space behind.
-->
    <?php echo   $openerNeedsOwnLine;
    ?>

<!--
Make sure the "content before closer" fixer does not leave trailing space behind.
-->
    <?php echo
    $closerNeedsOwnLine;   ?>

<!--
Make sure the "content after closer" fixer does not leave trailing space behind.
-->
    <?php echo
    $closerNeedsOwnLine;
    ?>  </div>

    <?php echo
    $closerNeedsOwnLine;
    ?>  <?php echo $i; ?>

<!--
Safeguard fixing when there is no whitespace between the open tag and the contents.
-->
<?php echo $var ?>
    <?php echo $var;
    ?>

// Safeguard fixing when there is no whitespace between the close tag and the contents.
<?php echo $var?>
    <?php echo
    $var;?>

<!--
Make sure the fixer does not add stray new lines when there are consecutive PHP blocks.
-->
<?php echo
    'something'
?><?php echo
    'embedded';
?>  <?php echo
        'embedded';
?><?php echo
'embedded';
?>

<?php
// This test case file MUST always end with an unclosed long open PHP tag (with this comment) to prevent
// the tests running into the "last PHP closing tag excepted" condition breaking tests.
// Tests related to that "last PHP closing tag excepted" condition should go in separate files.
