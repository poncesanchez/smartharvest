<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Smart Harvest</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="<?=base_url()?>assets/style.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
	  <div class="login-logo"><b>Smart </b>Harvest</div>
	  <div class="login-box-body">
	    <p class="login-box-msg">Ingresa tus credenciales para iniciar sesión</p>
			<?=form_open('login/ingresar')?>
	      <div class="form-group has-feedback">
					<?=form_input(array('name'=>'usuario','class'=>'form-control','value'=>set_value('usuario'), 'placeholder' => 'Usuario'))?>
	        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	      </div>
	      <div class="form-group has-feedback">
					<?=form_input(array('type'=>'password','name'=>'password','class'=>'form-control','placeholder' => 'Contraseña'))?>
	        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	      </div>
	      <div class="row">
	        <div class="col-xs-12">
	          <button type="submit" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
	        </div>
	      </div>
	    <?=form_close()?>
			<?php if(!empty(validation_errors())): ?>
			<div class="alert alert-danger">
					<?=validation_errors()?>
			</div>
			<?php endif; ?>

			<?php if(!empty($error)):?>
        <div class="alert alert-danger alert-dismissible mt-20">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <p><i class="icon fa fa-ban"></i> <?=$error?></p>
        </div>
			<?php endif; ?>
	  </div>
	</div>
	<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
	<script>
	  $(function () {
	    $('input').iCheck({
	      checkboxClass: 'icheckbox_square-blue',
	      radioClass: 'iradio_square-blue',
	      increaseArea: '20%' /* optional */
	    });
	  });
	</script>
	</body>
	</html>
