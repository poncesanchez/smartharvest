<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-building"></i> Editar <strong><?php echo $empresa['nombre']?></strong></h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas">Empresas</a></li>
    <li class="active">Editar </li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Actualizar empresa</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?=form_open('empresas/editar/'.$empresa['idempresa'])?>
        <div class="box-body">
          <div class="form-group">
            <?=form_label('Nombre','nombre')?>
            <?=form_input(array('name'=>'nombre','class'=>'form-control','value'=>set_value('nombre',$empresa['nombre'])))?>
          </div>
          <div class="form-group">
            <?=form_label('Descripción','descripcion')?>
            <?=form_textarea(array('name'=>'descripcion','class'=>'form-control', 'type'=>'textarea','value'=>set_value('descripcion',$empresa['descripcion'])))?>
          </div>
          <div class="checkbox">
            <label>
              <?php if($empresa['vigente']=="1"){ ?>
                <?=form_checkbox(array('name'=>'vigente', 'value'=>'1', 'checked'=>true))?>
              <?php } else { ?>
                <?=form_checkbox(array('name'=>'vigente', 'value'=>'0', 'checked'=>false))?>
              <?php } ?>
              Empresa activa y vigente
            </label>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?=form_input(array('name'=>'idempresa','type'=>'hidden','class'=>'form-control','value'=>set_value('idempresa',$empresa['idempresa'])))?>
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
      <a class="btn btn-primary" href="<?=site_url()?>/empresas"><i class="fa fa-angle-left"></i> Volver</a>
    </div>
  </div>
</section>
