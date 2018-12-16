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
}
