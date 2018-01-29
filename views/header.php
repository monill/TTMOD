<?php
use App\Models\Layout;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="monil">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="" />

        <title><?php echo isset($this->title) ? $this->title : SNAME; ?></title>

        <!-- Bootstrap & core CSS -->
        <link href="<?= URL; ?>/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= URL; ?>/vendor/font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="<?= URL; ?>/css/ttce.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <a class="navbar-brand" href="<?= url('/home'); ?>">TTMOD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= url('/home'); ?>"> Home </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('/forum'); ?>"> Forum </a></li>
                    <li class="nav-item"><a class="nav-link" href="torrents-upload.php"> UPLOAD_TORRENT </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('/torrents'); ?>"> Torrents </a></li>
                    <li class="nav-item"><a class="nav-link" href="torrents-today.php"> TODAYS_TORRENTS </a></li>
                    <li class="nav-item"><a class="nav-link" href="torrents-search.php"> SEARCH_TORRENTS </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('/admin'); ?>"> AdminCP </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url('/logout'); ?>">Logout</a></li>
                </ul>

                <form method="get" action="torrents-search.php" class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="text" value="Search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit"> Search </button>
                </form>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#statsnavbar" aria-controls="statsnavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="statsnavbar">
                <ul class="navbar-nav mr-auto">


                </ul>
            </div>

        </nav>

        <div class="container-fluid" style="padding-top: 100px;">
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-2 col-sm-12">
                    <?php Layout::left(); ?>
                </div>
                <!--// Left Column -->

                <!-- Main Column -->
                <div class="col-lg-8 col-sm-12">