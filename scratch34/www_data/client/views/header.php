<!doctype html>
<!--<html lang="en" style="overflow: hidden;">-->
<html lang="en">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137880167-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-137880167-2');
    </script>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="/client/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo PROJECT_ROOT . '/libraries/bootstrap-4.3.1-dist/css/bootstrap.css'; ?>">

    <!-- jQuery -->
    <script src="<?php echo PROJECT_ROOT . '/libraries/jquery-3.3.1/jquery-3.3.1.min.js'; ?>"></script>

    <!-- DataTables -->
    <link rel="stylesheet" type="text/css" href="<?php echo PROJECT_ROOT . '/libraries/DataTables/datatables.min.css'; ?>" />

    <!-- Bootstrap Extended JS -->
    <script src="<?php echo PROJECT_ROOT . '/libraries/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js'; ?>"></script>
    <!-- DataTables JS after jquery -->
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/libraries/DataTables/datatables.min.js'; ?>"></script>

    <!-- OpenLayers CSS and JS -->
    <link rel="stylesheet" href="<?php echo PROJECT_ROOT . '/libraries/openlayers-5.2.0/ol.css'; ?>" type="text/css">
    <script src="<?php echo PROJECT_ROOT . '/libraries/openlayers-5.2.0/ol.js'; ?>"></script>

    <!-- OpenLayers Addons -->
    <!-- https://github.com/walkermatt/ol-layerswitcher -->
    <link rel="stylesheet" href="<?php echo PROJECT_ROOT . '/libraries/ol-layerswitcher-3.3.0/dist/ol-layerswitcher.css'; ?>" type="text/css" />
    <script src="<?php echo PROJECT_ROOT . '/libraries/ol-layerswitcher-3.3.0/dist/ol-layerswitcher.js'; ?>"></script>

    <!-- https://github.com/tyrasd/osmtogeojson -->
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/libraries/osmtogeojson/osmtogeojson.js'; ?>"></script>

    <!-- https://github.com/jonataswalker/ol-geocoder -->
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/libraries/ol-geocoder-3.3.0/ol-geocoder.js'; ?>"></script>
    <link rel="stylesheet" href="<?php echo PROJECT_ROOT . '/libraries/ol-geocoder-3.3.0/ol-geocoder.css'; ?>" type="text/css" />

    <!-- Yeti Bootstrap Theme https://bootswatch.com/yeti/ -->
    <link rel="stylesheet" href="<?php echo PROJECT_ROOT . '/libraries/bootstrap-yeti-theme/bootstrap.yeti.css'; ?>" type="text/css" />

    <!-- Custom CSS and JS last -->
    <link rel="stylesheet" href="<?php echo PROJECT_ROOT . '/css/bootstrapCustomized.css'; ?>" />
    <script src="<?php echo PROJECT_ROOT . '/js/deg_2_bearing.js'; ?>"></script>

    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/js/ol_functions.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo PROJECT_ROOT . '/js/ol_styles.js'; ?>"></script>

    <title>GeoWebSwarm Client: <?php echo $PAGE_TITLE; ?></title>
</head>
<!-- end header -->
<body class="bg-dark">