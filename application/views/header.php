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
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/skins/_all-skins.min.css">
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-black sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <a href="../../index2.html" class="logo">
        <span class="logo-mini"><b>S</b>H</span>
        <span class="logo-lg"><b>Smart</b> Harvest</span>
      </a>
      <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                <span class="hidden-xs">Configuración</span>
              </a>
              <ul class="dropdown-menu">
                <li class="user-header">
                  <p>
                    Alexander Pierce - Web Developer
                    <small>Member since Nov. 2012</small>
                  </p>
                </li>
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-primary">Perfíl</a>
                  </div>
                  <div class="pull-right">
                    <a href="" class="btn btn-danger">Cerrar Sesión</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <!-- =============================================== -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVEGACION</li>
          <li><a href="<?=site_url()?>/empresas/"><i class="fa fa-building"></i> <span>Empresas</span></a></li>
          <li><a href="#"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>

          <li class="header">Reportes</li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar-check-o"></i> <span>Asistencia</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="../forms/general.html"><i class="fa fa-bar-chart"></i> Panel de Control</a></li>
              <li><a href="../forms/advanced.html"><i class="fa fa-th-large"></i> Predio</a></li>
              <li><a href="../forms/editors.html"><i class="fa fa-street-view"></i> Jefe de Cuadrilla</a></li>
              <li><a href="../forms/editors.html"><i class="fa fa-users"></i> Trabajadores</a></li>
            </ul>
          </li>

          <li class="header">Mantenedores</li>
          <li><a href="#"><i class="fa fa-calendar"></i> <span>Temporadas</span></a></li>
          <li><a href="#"><i class="fa fa-th-large"></i> <span>Predios</span></a></li>
          <li><a href="#"><i class="fa fa-th"></i> <span>Cuarteles</span></a></li>
          <li><a href="#"><i class="fa fa-building-o"></i> <span>Contratistas</span></a></li>
        </ul>
      </section>
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
