<?php
class Personas extends CI_Controller{
  public function __construct() {
      parent::__construct();
      if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE)
          redirect('login');
      $this->load->model('persona');
  }

  public function listado($idEmpresa,$rol,$pagina){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idEmpresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('personas/listado/'.$this->session->user['usuario']->idempresa.'/'.$rol.'/'.$pagina);
    }

    $this->load->model('persona');
    if ($rol=="trabajador") {
      $rolnum = "1";
    }elseif ($rol=="jefecuadrilla") {
      $rolnum = "2";
    }elseif ($rol=="contratista") {
      $rolnum = "3";
    } else{
      $rolnum = "0";
    }
    $activo = "1"; //activo
    $data = $this->persona->getPersonas($idEmpresa,$pagina,$rolnum,$activo);
    $cantidadPersonas = $this->persona->numeroPersonas($idEmpresa,$rolnum);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar',array('idEmpresa'=>$idEmpresa));
    $this->load->view('persona/index',array('personas'=>$data->result(),'idEmpresa'=>$idEmpresa,'cantidadPersonas'=>$cantidadPersonas,'rol'=>$rol));
    $this->load->view('templates/footer');
  }

  public function editar($idempresa, $idPersona){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idempresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('personas/listado/'.$this->session->user['usuario']->idempresa.'/'.$idPersona);
    }

    if (!empty($_POST))
    {
        $dataPersona = array(
           'idempresa'=>$this->input->post('idempresa'),
           'nombre'=>$this->input->post('nombre'),
           'vigente'=>$vigente,
           'descripcion'=>$this->input->post('descripcion')
       );
       $this->persona->actualizarPersona($dataPersona);
    }
    $this->load->model('persona');

    $generos = $this->persona->getGeneros();
    foreach($generos->result() as $row){
      $arrayGeneros[htmlspecialchars($row->idgenero, ENT_QUOTES)] = htmlspecialchars($row->genero, ENT_QUOTES);
    }
    $contratos = $this->persona->getContratos();
    $arrayContratos['0'] = 'Seleccionar';
    foreach($contratos->result() as $row){
      $arrayContratos[htmlspecialchars($row->idtipocontrato, ENT_QUOTES)] = htmlspecialchars($row->tipocontrato, ENT_QUOTES);
    }
    $roles = $this->persona->getRol();
    foreach($roles->result() as $row){
      $arrayRoles[htmlspecialchars($row->idrol, ENT_QUOTES)] = htmlspecialchars($row->descripcion, ENT_QUOTES);
    }

    $data = $this->persona->getPersona($idPersona, $idempresa);
    foreach($data->result() as $persona){
        $persona = array(
            'idpersona'=>$persona->idpersona,
            'idempresa'=>$persona->idempresa,
            'rut'=>$persona->rut,
            'dv'=>$persona->dv,
            'nombre'=>$persona->nombre,
            'apellidopaterno'=>$persona->apellidopaterno,
            'apellidomaterno'=>$persona->apellidomaterno,
            'fechainicio'=>$persona->fechainicio,
            'fechatermino'=>$persona->fechatermino,
            'idgenero'=>$persona->idgenero,
            'idusuario'=>$persona->idusuario,
            'idcontratista'=>$persona->idcontratista,
            'idtipocontrato'=>$persona->idtipocontrato,
            'vigente'=>$persona->vigente,
            'idrol'=>$persona->idrol
        );
    }
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar',array('idEmpresa'=>$idempresa));
    $this->load->view('persona/editar', array(
      'persona'=>$persona,
      'generos'=>$arrayGeneros,
      'contratos'=>$arrayContratos,
      'roles'=>$arrayRoles)
    );
    $this->load->view('templates/footer');
  }

  public function crear($idEmpresa){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idEmpresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('personas/listado/'.$this->session->user['usuario']->idempresa);
    }

    if (!empty($_POST))
    {
        $empresa = array(
           'nombre'=>$this->input->post('nombre'),
           'vigente'=>"1",
           'descripcion'=>$this->input->post('descripcion')
       );
       $this->empresa->nuevaEmpresa($empresa);
    }
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('personas/crear');
    $this->load->view('templates/footer');
  }
}
