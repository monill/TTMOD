<!DOCTYPE html>
<html>
    <head>
    	<meta charset="utf-8" />
    	<meta name="author" content="monil" />
    	<meta name="viewport" content="width=device-width,initial-scale=1" />
        <meta name="description" content="" />

        <title><?php echo isset($this->title) ? $this->title : SNAME; ?></title>

    	<link rel="stylesheet" type="text/css" href="<?= URL; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?= URL; ?>/vendor/jquery-ui-1.12.1/jquery-ui.css">
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
                                <h4 class="card-title">Signup</h4>
                                <form method="post" action="<?= url('/signup/in'); ?>" autocomplete="off">
                                    <input type="hidden" name="token" value="<?php echo isset($this->token) ? $this->token : $this->token; ?>" />

                                    <div class="form-group">
                                    	<label for="username">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" minlength="3" maxlength="25" required autofocus />
                                    </div>
                                    <div class="form-group">
                                    	<label for="password">Password</label>
                                    	<input id="password" type="password" class="form-control" name="password" minlength="6" maxlength="16" required data-eye />
                                    </div>
                                    <div class="form-group">
                                    	<label for="password2">Repeat password</label>
                                    	<input id="password2" type="password" class="form-control" name="passagain" minlength="6" maxlength="16" required data-eye />
                                    </div>
                                    <div class="form-group">
                                    	<label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" maxlength="50" />
                                    </div>
                                    <div class="form-group">
                                    	<label for="dob">Bithday</label>
                                        <input id="dob" type="text" class="form-control" name="dob" />
                                    </div>
                                    <div class="form-group">
                                        <label for="estate"> Estate </label>
                                        <select name="estate" id="estate" class="form-control" size="1">
                                            <option selected disabled="disabled"> Select a estate </option>
                                            <?php foreach (isset($this->estates) ? $this->estates : $this->estates as $estate): ?>
                                                <option value="<?= intval($estate->id); ?>"><?= \App\Libs\Helper::escape($estate->name); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                    	<label for="gender"> Gender </label>
                                        <select name="gender" id="gender" class="form-control" size="1">
                                            <option value="na">N/A</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="">
                                            <input type="checkbox" value="aceito"> I agree to the <a href="#">
                                                Terms of Service </a> and <a href="#"> Privacy Policy </a>
                                        </label>
                                    </div>
                                    <div class="form-group no-margin">
        								<button type="submit" class="btn btn-primary btn-block"> Signup </button>
        							</div>
        							<div class="margin-top20 text-center">
        								Have an account? <a href="<?= url('/login'); ?>">Login</a>
        							</div>
                                </form>
                            </div>
                        </div>
    					<div class="footer">
    						Copyright &copy; <?= date('Y'); ?> &mdash; TTMOD
    					</div>
	               </div>
                </div>
            </div>
        </section>

        <script src="<?= URL; ?>/js/jquery-3.3.1.min.js"></script>
        <script src="<?= URL; ?>/js/popper.js"></script>
        <script src="<?= URL; ?>/js/bootstrap.min.js"></script>
    	<script src="<?= URL; ?>/js/my-login.js"></script>

        <script src="<?= URL; ?>/vendor/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <script>
            $( function() {
                $( "#dob" ).datepicker({
                    dateFormat: 'dd/mm/yy',
                    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                    dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
                    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
                    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                    changeMonth: true,
                    changeYear: true,
                    yearRange: "1930:<?= date('Y'); ?>"
                });
            } );
        </script>

    </body>
</html>
