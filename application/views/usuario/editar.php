<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-building"></i> Editar <strong><?=$usuario['nombreusuario']?></strong></h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas">Empresas</a></li>
    <li class="active">Editar </li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Actualizar usuario</h3>
        </div>
        <?=form_open('usuarios/editar/'.$idempresa.'/'.$usuario['idusuario'])?>
        <div class="box-body">
          <div class="row">
            <div class="form-group col-xs-3">
              <?=form_label('Nombre','nombre')?>
              <?=form_input(array('name'=>'nombreusuario','class'=>'form-control','disabled'=>true,'value'=>set_value('nombre',$usuario['nombreusuario'])))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Contraseña','Contraseña')?>
              <?=form_input(array('name'=>'pass','type'=>'password','class'=>'form-control'))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Repetir Contraseña','Repetir Contraseña')?>
              <?=form_input(array('name'=>'passconfirm','type'=>'password','class'=>'form-control'))?>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?=form_input(array('name'=>'idusuario','type'=>'hidden','class'=>'form-control','value'=>set_value('idusuario',$usuario['idusuario'])))?>
          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar Cambios</button>
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
          <h4><i class="icon fa fa-check"></i> ¡Cambios Guardados!</h4>
            Los datos han sido actualizados
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
      <a class="btn btn-primary" onclick="window.history.back()"><i class="fa fa-angle-left"></i> Volver</a>
    </div>
  </div>
</section>
