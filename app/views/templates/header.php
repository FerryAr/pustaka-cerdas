<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<?php
include_once dirname(__DIR__, 3) . "/config/config.php";

$config = new Config();

$baseUrl = $config->root;

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <title><?= $title ?> | PustakaCerdas</title>

    <link rel="stylesheet" href="<?= $baseUrl ?>assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/compiled/css/iconly.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script src="<?= $baseUrl ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php
        require dirname(__DIR__) . "/$role/sidebar.php";
        ?>

        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>