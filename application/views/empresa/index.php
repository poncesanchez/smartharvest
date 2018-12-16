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
          <button type="button" class="btn btn-block btn-success"><i class="fa fa-plus"></i> Crear empresa</button>
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
                    <h4><a href="<?=$empresa->idempresa?>"><?=$empresa->nombre?></a></h4>
                    <p class="text-muted">Descripción empresa</p>
                  </div>
                  <div class="col-md-3 pull-right text-center">
                    <a class="btn-sm btn-primary" role="button" href="/sh/pw/dashboard/empresas/5bf4250c75149/">
                      <i class="glyphicon glyphicon-eye-open"></i> <strong>ver</strong>
                    </a>
                    <a class="btn-sm btn-success" role="button" href="/sh/pw/dashboard/empresas/5bf4250c75149/editar/">
                      <i class="glyphicon glyphicon-pencil"></i> <strong>editar</strong>
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