<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="author" content="monil" />
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="" />

        <title><?php echo isset($this->title) ? $this->title : SNAME; ?></title>

		<link rel="stylesheet" type="text/css" href="<?= URL; ?>/css/bootstrap.min.css">
    	<link rel="stylesheet" type="text/css" href="<?= URL; ?>/css/my-login.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="my-login-page">

        <section class="h-100">
            <div class="container h-100">
                <div class="row justify-content-md-center h-100">
                    <div class="card-wrapper">
                        <div class="brand">
                            <img src="<?= URL; ?>/img/logo.jpg" alt="Logo" />
                        </div>
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title">Recover Password</h4>
                                <form method="post" action="<?= url('/recover/in'); ?>">
                                    <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />
                                    <div class="form-group">
                                        <label for="email"> E-mail </label>
                                        <input id="email" type="email" class="form-control" name="email" required data-eye>
                                    </div>
                                    <div class="form-group no-margin">
                                        <button class="btn btn-default" onclick="location.href='<?= url('/login'); ?>'" type="button">Cancel</button>
                                        <button type="submit" class="btn btn-primary "> Recover </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="footer"> Copyright &copy; <?= date('Y'); ?> - TTMOD </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="<?= URL; ?>/js/jquery-3.3.1.min.js"></script>
        <script src="<?= URL; ?>/js/popper.js"></script>
        <script src="<?= URL; ?>/js/bootstrap.min.js"></script>
        <script src="<?= URL; ?>/js/my-login.js"></script>

    </body>
</html>
