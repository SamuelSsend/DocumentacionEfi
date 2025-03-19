<!doctype html>
<html class="theme-<?php echo $config['theme']?>">
<!--
<?php echo $throwableString?>
-->
<head>
    <!-- Hide dumps asap -->
    <style>
        pre.sf-dump {
            display: none !important;
        }
    </style>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">

    <title><?php echo $title ?></title>

    <?php foreach ($styles as $script): ?>
        <link rel="stylesheet" href="<?php echo $housekeepingEndpoint?>/styles/<?php echo $script?>">
    <?php endforeach; ?>

</head>
<body class="scrollbar-lg">

<script>
    window.data = <?php echo
        $jsonEncode(
            [
            'report' => $report,
            'config' => $config,
            'solutions' => $solutions,
            'telescopeUrl' => $telescopeUrl,
            'shareEndpoint' => $shareEndpoint,
            'defaultTab' => $defaultTab,
            'defaultTabProps' => $defaultTabProps,
            'appEnv' => $appEnv,
            'appDebug' => $appDebug,
            ]
        )
                    ?>;

    window.tabs = <?php echo $tabs?>;
</script>

<noscript><pre><?php echo $throwableString?></pre></noscript>

<div id="app"></div>

<script><?php echo $getAssetContents('ignition.js') ?></script>
<script>
    window.Ignition = window.ignite(window.data);
</script>
<?php foreach ($scripts as $script): ?>
    <script src="<?php echo $housekeepingEndpoint?>/scripts/<?php echo $script?>"></script>
<?php endforeach; ?>
<script>
    Ignition.start();
</script>
<!--
<?php echo $throwableString?>
-->
</body>
</html>
