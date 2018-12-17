<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-building"></i> Nueva Empresa</h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas">Empresas</a></li>
    <li class="active">Nueva </li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Nueva empresa</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?=form_open('empresas/crear')?>
        <div class="box-body">
          <div class="form-group">
            <?=form_label('Nombre','nombre')?>
            <?=form_input(array('name'=>'nombre','class'=>'form-control'))?>
          </div>
          <div class="form-group">
            <?=form_label('Descripción','descripcion')?>
            <?=form_textarea(array('name'=>'descripcion','class'=>'form-control', 'type'=>'textarea'))?>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> Crear Empresa</button>
        </div>
        <?=form_close()?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <?php if (!empty($_POST)):?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-check"></i> ¡Empresa creada!</h4>
            Se ha creado en el sistema una nueva empresa satisfactoriamente.
        </div>
      <?php endif; ?>
      <?php if(!empty(validation_errors())): ?>
        <div class="alert alert-danger">
          <?=validation_errors()?>
        </div>
      <?php endif; ?>
      <?php if(!empty($error)):?>
        <div class="alert alert-danger">
          <?=$error?>
        </div>
      <?php endif; ?>
      <a class="btn btn-primary" href="<?=site_url()?>/empresas"><i class="fa fa-angle-left"></i> Volver</a>
    </div>
  </div>
</section>
