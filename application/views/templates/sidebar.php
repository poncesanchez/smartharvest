<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">NAVEGACION</li>
          <li><a href="<?=site_url()?>/empresas/"><i class="fa fa-building"></i> <span>Empresas</span></a></li>
          <?php if(!empty($idEmpresa)){ ?>
            <li><a href="#"><i class="fa fa-users"></i> <span>Usuarios</span></a></li>
          <?php } ?>
          <li class="header">Reportes</li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-calendar-check-o"></i> <span>Asistencia</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if(!empty($idEmpresa)){ ?>
              <li><a href="<?=site_url()?>/reportes/panelcontrol/<?=$idEmpresa?>"><i class="fa fa-bar-chart"></i> Panel de Control
              </a></li>
              <?php } ?>
              <!-- no aparece en mockup <li><a href="../forms/advanced.html"><i class="fa fa-th-large"></i> Predio</a></li> -->
              <li><a href="<?=site_url()?>/reportes/jefecuadrilla/<?=$idEmpresa?>"><i class="fa fa-street-view"></i> Jefe de Cuadrilla</a></li>
              <li><a href="../forms/editors.html"><i class="fa fa-users"></i> Trabajadores</a></li>
            </ul>
          </li>
          <li class="header">Mantenedores</li>
          <!-- no abarcar en este spring <li><a href="#"><i class="fa fa-calendar"></i> <span>Temporadas</span></a></li> -->
          <li><a href="#"><i class="fa fa-th-large"></i> <span>Predios</span></a></li>
          <li><a href="#"><i class="fa fa-th"></i> <span>Cuarteles</span></a></li>
          <?php if(!empty($idEmpresa)){ ?>
          <li><a href="<?=site_url()?>/personas/listado/<?=$idEmpresa?>/contratista/0"><i class="fa fa-building-o"></i> <span>Contratistas</span></a></li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i> <span>Trabajadores</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
            <ul class="treeview-menu">
              <li><a href="<?=site_url()?>/personas/listado/<?=$idEmpresa?>/trabajador/0"><i class="fa fa-user"></i> Personas</a></li>
              <li><a href="<?=site_url()?>/personas/listado/<?=$idEmpresa?>/jefecuadrilla/0"><i class="fa fa-male"></i> Jefes de Cuadrilla</a></li>
            </ul>
            </li>
          <?php } ?>
        </ul>
      </section>
    </aside>
    <!-- =============================================== -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
