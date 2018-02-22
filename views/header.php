<?php
use App\Models\Layout;
use App\Libs\Database;

$startime =  array_sum(explode(" ", microtime()));
$db = Database::getInstance();

$user = $db->select1("SELECT * FROM users WHERE id = :id", ["id" => 7]);
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
            <a class="navbar-brand" href="<?= url("/home"); ?>">TTMOD</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= url("/home"); ?>"> Home </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/forum"); ?>"> Forum </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/torrents/upload"); ?>"> Upload Torrents </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/torrents"); ?>"> Torrents </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/faq"); ?>"> F.A.Q </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/rules"); ?>"> Rules </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/polls"); ?>"> Polls </a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= url("/admin"); ?>"> AdminCP </a></li>
                </ul>
                <a class="btn btn-outline-success my-2 my-sm-0" href="<?= url("/logout"); ?>">Logout</a>
            </div>
        </nav>
        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#statsnavbar" aria-controls="statsnavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="statsnavbar">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-user text-black"></i> <strong> username </strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-arrow-up text-green text-bold"></i> Up: 0.0 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-arrow-down text-red text-bold"></i> Down: 0.0 </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-signal text-blue text-bold"></i> Ratio: --- </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url("/account"); ?>">
                            <i class="fa fa-user text-purple text-bold"></i> Account </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fa fa-info"></i> Points: ---- </a>
                    </li>

                </ul>
            </div>
        </nav>

        <div class="container-fluid" style="padding-top: 100px;">
            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-2 col-sm-12">
                    <?php Layout::left(); ?>
                </div>
                <!-- Left Column -->

                <!-- Main Column -->
                <div class="col-lg-8 col-sm-12">
