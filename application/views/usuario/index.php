<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-user"></i>  Usuarios</h1>

  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?=site_url()?>/empresas/home/<?=$idEmpresa?>">Empresa</a></li>
    <li class="active">Usuarios</li>
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
          <a class="btn btn-block btn-success" href="<?=site_url()?>/empresas/crear"><i class="fa fa-plus"></i> Crear usuario</a>
        </div>
      </div>
    </div>
  </div>
  <div class="box">
    <div class="box-body">
      <div class="list-item-container">
        <div class="no-padding">
          <ul class="nav nav-stacked">
            <?php if(empty($usuarios)){ ?>
              <h4>Sin resultados</h4>
            <?php } ?>
            <?php foreach($usuarios as $key=>$usuario): ?>
              <li class="empresa-item">
                <div class="row">
                  <div class="col-md-9 item-description text-left">
                    <h4>
                      <a role="button" href="<?=site_url()?>/usuarios/editar/<?=$idEmpresa?>/<?=$usuario->idusuario?>">
                        <?=$usuario->nombreusuario?></a>
                    </h4>
                    <p class="text-muted"><?=$usuario->descripcion?></p>
                  </div>
                  <div class="col-md-3 pt-20 pull-right text-right">
                    <a class="btn-sm btn-success" role="button" href="<?=site_url()?>/usuarios/editar/<?=$idEmpresa?>/<?=$usuario->idusuario?>">
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
<?=form_open('empresas/usuarios/'.$idEmpresa)?>
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
