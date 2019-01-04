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
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idempresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('reportes/panelcontrol/'.$this->session->user['usuario']->idempresa);
    }

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
      if($fechainicio!=null){
        if ($fechatermino==null) {
          $fechatermino = Date('d-m-Y');
        }
        $fechatermino = Date('d-m-Y', strtotime($fechatermino. ' + 1 days'));
        $period = new DatePeriod(
        new DateTime($fechainicio),
        new DateInterval('P1D'),
        new DateTime($fechatermino));
        foreach ($period as $date) {
          $fechas[] = $date->format("d-m-Y");
        }
      }else{
        //Cambiar estas fechas dinámicamente.
        $fechas = array('10-12-2018','11-12-2018','12-12-2018','13-12-2018','14-12-2018','15-12-2018');
      }

    } else {
      $pagina = 0;
      //Cambiar estas fechas dinámicamente.
      $fechas = array('10-12-2018','11-12-2018','12-12-2018','13-12-2018','14-12-2018','15-12-2018');
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

    $reporteria = $this->panelcontrol->getDefault($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechas);
    $numeroPaginas = $this->panelcontrol->getDefaultNumber($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechas);
    $dataGrafico = $this->panelcontrol->graficoDefault($idempresa, $predio, $jefecuadrilla, $labor, $fechas);

    for ($i=0; $i < sizeof($fechas); $i++) {
      $horasNormales = 0;
      $horasExtra = 0;
      $totalAsistencias = 0;
      $jornadaLaboral = 8;
      $varFecha = $fechas[$i];
      foreach($dataGrafico->result() as $row){
        if($varFecha==$row->dia){
          if ($jornadaLaboral<$row->horas) {
            $horasExtra += $row->horas - $jornadaLaboral;
            $horasNormales += $jornadaLaboral;
          }else{
            $horasNormales += $row->horas;
          }
          $totalAsistencias++;
        }
      }
      $grafico['fechas'][] = $varFecha;
      $grafico['horasNormales'][] = $horasNormales;
      $grafico['horasExtras'][] = $horasExtra;
      $grafico['asistencias'][] = $totalAsistencias;
    }

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$idempresa,'active'=>true));
    $this->load->view('asistencia/index',array(
      'idEmpresa'=>$idempresa,
      'predios'=>$arrayPredios,
      'jefescuadrilla' =>$arrayJCuadrilla,
      'labores' => $arrayLabores,
      'reporteria' => $reporteria->result(),
      'numeroPaginas' => $numeroPaginas,
      'pagina' => $pagina,
      'dataGrafico' => $grafico,
      'data' => $dataGrafico->result()
    ));
    $this->load->view('templates/footer');
  }

  public function jefecuadrilla($idempresa){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idempresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('reportes/jefecuadrilla/'.$this->session->user['usuario']->idempresa);
    }

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

    $reporteria = $this->panelcontrol->reporteJefeCuadrilla($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio);
    $numeroPaginas = $this->panelcontrol->numReporteJefeCuadrilla($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$idempresa,'active'=>true));
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

  public function asistencia($idempresa){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idempresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('reportes/asistencia/'.$this->session->user['usuario']->idempresa);
    }

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

    $reporteria = $this->panelcontrol->reporteTrabajador($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino);
    /*$numeroPaginas = $this->panelcontrol->numReporteJefeCuadrilla($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio);*/
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$idempresa,'active'=>true));
    $this->load->view('asistencia/asistencia',array(
      'idEmpresa'=>$idempresa,
      'predios'=>$arrayPredios,
      'jefescuadrilla' =>$arrayJCuadrilla,
      'labores' => $arrayLabores,
      'reporteria' => $reporteria->result(),
      'numeroPaginas' => null,
      'pagina' => $pagina
    ));
    $this->load->view('templates/footer');
  }
}
