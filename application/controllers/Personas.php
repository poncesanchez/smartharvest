<?php
class Personas extends CI_Controller{
  public function __construct() {
      parent::__construct();
      if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE)
          redirect('login');
      $this->load->model('persona');
  }

  public function listado($idEmpresa){
    $this->load->model('persona');
    $data = $this->persona->getPersonas($idEmpresa);
    $this->load->view('header',array('idEmpresa'=>$idEmpresa));
    $this->load->view('persona/index',array('personas'=>$data->result(),'idEmpresa'=>$idEmpresa));
    $this->load->view('footer');
  }

  public function editar($idPersona){
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
    $data = $this->persona->getPersona($idPersona);
    foreach($data->result() as $persona){
        $empresa = array(
            'idempresa'=>$empresa->idempresa,
            'nombre'=>$empresa->nombre,
            'vigente'=>$empresa->vigente,
            'descripcion'=>$empresa->descripcion
        );
    }
    $this->load->view('header');
    $this->load-> view('personas/editar', array('persona'=>$persona));
    $this->load->view('footer');
  }

  public function crear($idEmpresa){
    if (!empty($_POST))
    {
        $empresa = array(
           'nombre'=>$this->input->post('nombre'),
           'vigente'=>"1",
           'descripcion'=>$this->input->post('descripcion')
       );
       $this->empresa->nuevaEmpresa($empresa);
    }
    $this->load->view('header');
    $this->load-> view('personas/crear');
    $this->load->view('footer');
  }
}
