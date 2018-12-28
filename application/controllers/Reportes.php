<?php
class Reportes extends CI_Controller{
  public function __construct() {
      parent::__construct();
      if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE)
          redirect('login');
      $this->load->model('panelcontrol');
      $this->load->model('empresa');
      $this->load->library('pagination');
      $this->load->helper('url');
  }

  public function panelcontrol($idempresa){
    $predio = 0;
    $jefecuadrilla = 0;
    $labor = 0;
    $fechainicio = null;
    $fechatermino = null;

    if (!empty($_POST))
    {
      $paginacion = $this->input->post('paginacion');
      if ($paginacion != null) {
        if ($paginacion=='1') {
          $pagina = 0;
        }else{
          $pagina = ($paginacion-1).'1';
        }
      }else{
        $pagina = 0;
      }
      $predio = $this->input->post('predio');
      $jefecuadrilla = $this->input->post('jefecuadrilla');
      $labor = $this->input->post('labor');
      $fechainicio = $this->input->post('fechainicio');
      $fechatermino = $this->input->post('fechatermino');
    } else {
      $pagina = 0;
    }
    $predios = $this->empresa->getPredios($idempresa);
    $arrayPredios['0'] = 'Seleccionar';
    foreach($predios->result() as $row){
      $arrayPredios[htmlspecialchars($row->idpredio, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
    }
    $jefeCuadrilla = $this->empresa->getJefeCuadrillas($idempresa);
    $arrayJCuadrilla['0'] = "Seleccionar";
    foreach ($jefeCuadrilla->result() as $row) {
      $arrayJCuadrilla[htmlspecialchars($row->idpersona, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
    }

    $labores = $this->empresa->getLabores($idempresa);
    $arrayLabores['0'] = "Seleccionar";
    foreach ($labores->result() as $row) {
      $arrayLabores[htmlspecialchars($row->idlabor, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
    }

    $reporteria = $this->panelcontrol->getDefault($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino);
    $numeroPaginas = $this->panelcontrol->getDefaultNumber($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$idempresa));
    $this->load->view('asistencia/index',array(
      'idEmpresa'=>$idempresa,
      'predios'=>$arrayPredios,
      'jefescuadrilla' =>$arrayJCuadrilla,
      'labores' => $arrayLabores,
      'reporteria' => $reporteria->result(),
      'numeroPaginas' => $numeroPaginas,
      'pagina' => $pagina
    ));
    $this->load->view('templates/footer');
  }

  public function jefecuadrilla($idempresa){
    $predio = 0;
    $jefecuadrilla = 0;
    $labor = 0;
    $fechainicio = null;
    $fechatermino = null;

    if (!empty($_POST))
    {
      $paginacion = $this->input->post('paginacion');
      if ($paginacion != null) {
        if ($paginacion=='1') {
          $pagina = 0;
        }else{
          $pagina = ($paginacion-1).'1';
        }
      }else{
        $pagina = 0;
      }
      $predio = $this->input->post('predio');
      $jefecuadrilla = $this->input->post('jefecuadrilla');
      $labor = $this->input->post('labor');
      $fechainicio = $this->input->post('fechainicio');
      $fechatermino = $this->input->post('fechatermino');
    } else {
      $pagina = 0;
    }
    $predios = $this->empresa->getPredios($idempresa);
    $arrayPredios['0'] = 'Seleccionar';
    foreach($predios->result() as $row){
      $arrayPredios[htmlspecialchars($row->idpredio, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
    }
    $jefeCuadrilla = $this->empresa->getJefeCuadrillas($idempresa);
    $arrayJCuadrilla['0'] = "Seleccionar";
    foreach ($jefeCuadrilla->result() as $row) {
      $arrayJCuadrilla[htmlspecialchars($row->idpersona, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
    }

    $labores = $this->empresa->getLabores($idempresa);
    $arrayLabores['0'] = "Seleccionar";
    foreach ($labores->result() as $row) {
      $arrayLabores[htmlspecialchars($row->idlabor, ENT_QUOTES)] = htmlspecialchars($row->nombre, ENT_QUOTES);
    }

    $reporteria = $this->panelcontrol->getDefault($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino);
    $numeroPaginas = $this->panelcontrol->getDefaultNumber($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$idempresa));
    $this->load->view('asistencia/jefecuadrilla',array(
      'idEmpresa'=>$idempresa,
      'predios'=>$arrayPredios,
      'jefescuadrilla' =>$arrayJCuadrilla,
      'labores' => $arrayLabores,
      'reporteria' => $reporteria->result(),
      'numeroPaginas' => $numeroPaginas,
      'pagina' => $pagina
    ));
    $this->load->view('templates/footer');
  }
}
