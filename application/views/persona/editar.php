<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-building"></i> Editar <strong><?=$persona['nombre']?> <?=$persona['apellidopaterno']?></strong></h1>
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
          <h3 class="box-title">Actualizar perfíl</h3>
        </div>
        <?=form_open('empresas/editar/'.$persona['idempresa'])?>
        <div class="box-body">
          <div class="row">
            <div class="form-group col-xs-3">
              <?=form_label('Nombre','nombre')?>
              <?=form_input(array('name'=>'nombre','class'=>'form-control','value'=>set_value('nombre',$persona['nombre'])))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Apellido paterno','Apellido paterno')?>
              <?=form_input(array('name'=>'apellidopaterno','class'=>'form-control','value'=>set_value('nombre',$persona['apellidopaterno'])))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Apellido materno','Apellido materno')?>
              <?=form_input(array('name'=>'apellidopaterno','class'=>'form-control','value'=>set_value('nombre',$persona['apellidomaterno'])))?>
            </div>
            <div class="form-group col-xs-3">
              <div class="row">
                <div class="col-xs-12">
                  <?=form_label('Rut','rut')?>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9">
                  <?=form_input(array('name'=>'rut','class'=>'form-control','value'=>set_value('nombre',$persona['rut'])))?>
                </div>
                <div class="col-xs-3">
                  <?=form_input(array('name'=>'dv','class'=>'form-control','value'=>set_value('nombre',$persona['dv'])))?>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-xs-3">
              <?=form_label('Genero','genero')?>
              <?=form_input(array('name'=>'genero','class'=>'form-control','value'=>set_value('nombre',$persona['nombre'])))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Contratista','contratista')?>
              <?=form_input(array('name'=>'genero','class'=>'form-control','value'=>set_value('nombre',$persona['nombre'])))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Contrato','contrato')?>
              <?=form_input(array('name'=>'genero','class'=>'form-control','value'=>set_value('nombre',$persona['nombre'])))?>
            </div>
            <div class="form-group col-xs-3">
              <?=form_label('Rol','rol')?>
              <?=form_input(array('name'=>'genero','class'=>'form-control','value'=>set_value('nombre',$persona['nombre'])))?>
            </div>
          </div>
          <div class="row">
            <div class="checkbox col-xs-3">
              <label>
                <?php if($persona['activo']=="1"){ ?>
                  <?=form_checkbox(array('name'=>'activo', 'value'=>'1', 'checked'=>true))?>
                <?php } else { ?>
                  <?=form_checkbox(array('name'=>'activo', 'value'=>'0', 'checked'=>false))?>
                <?php } ?>
                Habilitado
              </label>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?=form_input(array('name'=>'idempresa','type'=>'hidden','class'=>'form-control','value'=>set_value('idempresa',$persona['idpersona'])))?>
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
