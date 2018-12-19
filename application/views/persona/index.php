<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <?php if ($rol=="trabajador") { ?>
    <h1><i class="fa fa-user"></i>  Trabajadores</h1>
  <?php }elseif ($rol=="jefecuadrilla") { ?>
    <h1><i class="fa fa-group"></i>  Jefe de cuadrilla</h1>
  <?php }elseif ($rol=="contratista") { ?>
    <h1><i class="fa fa-group"></i>  Contratistas</h1>
  <?php } else { ?>
  <?php } ?>

  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas/home/<?=$idEmpresa?>">Empresa</a></li>
    <li class="active">Jefes de cuadrilla</li>
  </ol>
</section>
<section class="content">
  <div class="box box-success">
    <div class="box-body">
      <div class="row">
        <div class="col-md-9">
          <form class="" action="index.html" method="post">
            <div class="input-group">
              <input type="text" placeholder="Buscar trabajador..." class="form-control">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
          </form>
        </div>
        <div class="col-md-3">
          <a class="btn btn-block btn-success" href="<?=site_url()?>/empresas/crear"><i class="fa fa-plus"></i> Crear Jefe de cuadrilla</a>
        </div>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-body">
      <div class="list-item-container">
        <div class="no-padding">
          <ul class="nav nav-stacked">
            <?php if(empty($personas)){ ?>
              <h4>Sin resultados</h4>
            <?php } ?>
            <?php foreach($personas as $key=>$persona): ?>
              <li class="empresa-item">
                <div class="row">
                  <div class="col-md-9 item-description text-left">
                    <h4><a href="<?=site_url()?>/personas/editar/<?=$persona->idpersona?>"><?=$persona->nombre." ".$persona->apellidopaterno." ".$persona->apellidomaterno?></a>
                    </h4>
                    <p class="text-muted"><?=$persona->rut."-".$persona->dv?></p>
                  </div>
                  <div class="col-md-3 pt-20 pull-right text-right">
                    <a class="btn-sm btn-success" role="button" href="<?=site_url()?>/personas/editar/<?=$idEmpresa?>/<?=$persona->idpersona?>">
                      <i class="glyphicon glyphicon-pencil"></i> editar
                    </a>
                  </div>
                </div>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
    </div>
</div>
<?php if ($cantidadPersonas>10 && (!empty($personas))) { ?>
  <ul class="pagination pagination-sm no-margin">
  <?php
  $paged = round($cantidadPersonas/10);
  for ($i=0; $i < $paged; $i++) { ?>
    <?php if ($i==0) { ?>
      <li><a href="<?=site_url()?>/personas/listado/<?=$idEmpresa?>/<?=$rol?>/<?=$i?>"><?=$i+1?></a></li>
    <?php } else { ?>
      <li><a href="<?=site_url()?>/personas/listado/<?=$idEmpresa?>/<?=$rol?>/<?=$i?>1"><?=$i+1?></a></li>
    <?php }?>

  <?php } ?>
  </ul>
<?php } ?>


</section>
