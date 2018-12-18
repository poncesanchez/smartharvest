<?php
class Empresas extends CI_Controller{
  public function __construct() {
      parent::__construct();
      if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE)
          redirect('login');
      $this->load->model('empresa');
  }

  public function index(){
    $this->load->model('empresa');
    $data = $this->empresa->getEmpresas();
    $this->load->view('header');
    $this->load->view('empresa/index',array(
      //'nombre'=>$nombre,
      'empresas'=>$data->result()));
    $this->load->view('footer');
  }

  public function home($id){
    $this->load->model('empresa');
    $data = $this->empresa->getEmpresa($id);
    foreach($data->result() as $empresa){
        $empresa = array(
            'idempresa'=>$empresa->idempresa,
            'nombre'=>$empresa->nombre,
            'vigente'=>$empresa->vigente,
            'descripcion'=>$empresa->descripcion
        );
    }
    $this->load->view('header', array('idEmpresa'=>$id));
    $this->load->view('empresa/home', array('empresa'=>$empresa));
    $this->load->view('footer');
  }

  public function editar($id){
    if (!empty($_POST))
    {
      if($this->input->post('vigente') == null){
        $vigente = "0";
      }else{
        $vigente = "1";
      }
        $dataEmpresa = array(
           'idempresa'=>$this->input->post('idempresa'),
           'nombre'=>$this->input->post('nombre'),
           'vigente'=>$vigente,
           'descripcion'=>$this->input->post('descripcion')
       );
       $this->empresa->actualizarEmpresa($dataEmpresa);
    }
    $this->load->model('empresa');
    $data = $this->empresa->getEmpresa($id);
    foreach($data->result() as $empresa){
        $empresa = array(
            'idempresa'=>$empresa->idempresa,
            'nombre'=>$empresa->nombre,
            'vigente'=>$empresa->vigente,
            'descripcion'=>$empresa->descripcion
        );
    }
    $this->load->view('header');
    $this->load-> view('empresa/editar', array('empresa'=>$empresa));
    $this->load->view('footer');
  }

  public function crear(){
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
    $this->load-> view('empresa/crear');
    $this->load->view('footer');
  }
}
