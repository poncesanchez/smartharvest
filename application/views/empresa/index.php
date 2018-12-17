<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<section class="content-header">
  <h1><i class="fa fa-building"></i>  Empresas</h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url()?>/login/home"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Empresas</a></li>
    <!-- <li class="active">Blank page</li> -->
  </ol>
</section>
<section class="content">
  <div class="box box-success">
    <div class="box-body">
      <div class="row">
        <div class="col-md-9">
          <form class="" action="index.html" method="post">
            <div class="input-group">
              <input type="text" placeholder="Buscar empresa..." class="form-control">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
          </form>
        </div>
        <div class="col-md-3">
          <a class="btn btn-block btn-success" href="<?=site_url()?>/empresas/crear"><i class="fa fa-plus"></i> Crear empresa</a>
        </div>
      </div>
    </div>
  </div>

  <div class="box">
    <div class="box-body">
      <div class="list-item-container">

        <div class="no-padding">
          <ul class="nav nav-stacked">
            <?php foreach($empresas as $key=>$empresa): ?>
              <li class="empresa-item">
                <div class="row">
                  <div class="col-md-9 item-description text-left">
                    <h4><a href="<?=$empresa->idempresa?>"><?=$empresa->nombre?></a>
                      <?php if($empresa->vigente == '0'){ ?>
                        <small class="label bg-red desactivada">Desactivada</small>
                      <?php } ?>
                    </h4>
                    <p class="text-muted"><?=$empresa->descripcion?></p>
                  </div>
                  <div class="col-md-3 pt-20 pull-right text-right">
                    <a class="btn-sm btn-primary" role="button" href="<?=site_url()?>/empresas/editar/<?=$empresa->idempresa?>">
                      <i class="glyphicon glyphicon-search"></i> ver
                    </a>
                    <a class="btn-sm btn-success" role="button" href="<?=site_url()?>/empresas/editar/<?=$empresa->idempresa?>">
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


</section>
