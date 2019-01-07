<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-building"></i> Borrar <strong><?php echo $persona['nombre']?></strong></h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-home"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas">Personas</a></li>
    <li class="active">Borrar </li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-xs-6">
      <?php if(!empty($error)):?>
        <div class="alert alert-danger">
          <?=$error?>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          <h3 class="box-title">Atención</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?=form_open('empresas/borrar/'.$idEmpresa.'/'.$persona['idpersona'])?>
        <div class="box-body">
          <h4>Estas apunto de eliminar todos los registros relacionados a la empresa <strong><?php echo $persona['nombre']?></strong>.</h4>
          <p>Confirma la eliminación escribiendo la palabra: <strong>ELIMINAR</strong> en la casilla.</p>

          <input class="form-control" type="text" name="eliminar" placeholder="ingresa la palabra aquí" value="" required>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <?=form_input(array('name'=>'idempresa','type'=>'hidden','class'=>'form-control','value'=>set_value('idempresa',$persona['idpersona'])))?>
          <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Borrar Empresa</button>
        </div>
        <?=form_close()?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <a class="btn btn-primary" href="<?=site_url()?>/personas/listado/<?=$idEmpresa?>/trabajador/0"><i class="fa fa-angle-left"></i> Volver</a>
    </div>
  </div>
</section>
