<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-group"></i>  Jefe Cuadrilla</h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas/home/<?=$idEmpresa?>">Empresa</a></li>
    <li class="active">Jefes de cuadrilla</li>
  </ol>
</section>
<?=form_open('reportes/jefecuadrilla/'.$idEmpresa)?>
<section class="content">
  <div class="box box-success">
    <div class="box-body">
      <div class="row">
          <div class="col-md-9">
              <div class="input-group">
                <input type="text" placeholder="Buscar..." class="form-control">
                <span class="input-group-addon"><i class="fa fa-search"></i></span>
              </div>
          </div>
          <div class="col-md-3">
            <?=form_button(array('type'=>'submit','class'=>'btn btn-block btn-success'),'<i class="fa fa-search"></i> Filtrar resultados')?>
          </div>
      </div>
      <div class="row mt-10">
        <div class="col-md-3">
          <label>Predio:</label>
          <?=form_dropdown(array('name'=>'predio','class'=>'form-control','value'=>set_value('predio')),$predios) ?>
        </div>
        <div class="col-md-3">
          <label>Jefe cuadrilla:</label>
          <?=form_dropdown(array('name'=>'jefecuadrilla','class'=>'form-control','value'=>set_value('jefecuadrilla')),$jefescuadrilla) ?>
        </div>
        <div class="col-md-3">
          <label>Labor:</label>
          <?=form_dropdown(array('name'=>'labor','class'=>'form-control','value'=>set_value('labor')),$labores) ?>
        </div>
        <div class="col-md-3">
          <label>Fecha inicio:</label>
          <?=form_input(array('name'=>'fechainicio','class'=>'form-control','type'=>'date','value'=>set_value('fechainicio')))?>
        </div>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-body">
      <div class="list-item-container">
        <div class="no-padding">
            <?php if(empty($reporteria)){ ?>
              <h4>Sin resultados</h4>
            <?php } else { ?>

            <div class="table-responsive-sm">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Nº</th>
                    <th scope="col">Nombre trabajador</th>
                    <th scope="col">Labor</th>
                    <th scope="col">Cuartel</th>
                    <th scope="col">Hora Inicio</th>
                    <th scope="col">Hora Termino</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($reporteria as $key=>$asistencia): ?>
                  <tr>
                    <th scope="row"><?=$asistencia->dia?></th>
                    <td><?=$asistencia->trabajador?></td>
                    <td><?=$asistencia->labor?></td>
                    <td><?=$asistencia->cuartel?></td>
                    <td><?=$asistencia->ingreso?></td>
                    <td><?=$asistencia->salida?></td>
                  </tr>
                <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php } ?>
        </div>
      </div>
    </div>
</div>
<?php if ($numeroPaginas>10 && (!empty($reporteria))) { ?>
  <ul class="pagination pagination-sm no-margin">
  <?php
  $paged = ($numeroPaginas/10);
  if($numeroPaginas%10!==0){
    $paged = round($paged);
    $paged++;
  }
  for ($i=0; $i < $paged; $i++) { ?>
    <?php if ($i==0) { ?>
      <li><input type="submit" name="paginacion" value="<?=$i+1?>"></li>
    <?php } else { ?>
      <li><input type="submit" name="paginacion" value="<?=$i+1?>"></li>
    <?php }?>
  <?php } ?>
  </ul>
<?php } ?>
<?=form_close()?>
</section>
