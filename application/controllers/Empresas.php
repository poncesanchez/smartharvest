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

  public function editar($id){
    if (!empty($_POST))
    {
        $dataEmpresa = array(
           'idempresa'=>$this->input->post('idempresa'),
           'nombre'=>$this->input->post('nombre'),
           'vigente'=>$this->input->post('vigente'),
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
}
