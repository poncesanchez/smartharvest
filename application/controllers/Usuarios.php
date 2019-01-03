<?php
class Usuarios extends CI_Controller{
  public function __construct() {
    parent::__construct();
    if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE)
        redirect('login');
    $this->load->model('panelcontrol');
    $this->load->model('empresa');
    $this->load->library('pagination');
    $this->load->helper('url');
    $this->load->model('usuario');
  }

    public function editar($idempresa, $idusuario){
      if (!empty($_POST))
      {
        $dataUsuario = array(
          'idusuario'=>$this->input->post('idusuario'),
          'pass'=>password_hash($this->input->post('pass'), PASSWORD_DEFAULT)
         );

         $this->usuario->actualizarUsuario($dataUsuario);
      }
      $this->load->model('usuario');
      $data = $this->usuario->getUsuario($idusuario);
      foreach($data->result() as $usuario){
        $usuario = array(
          'idusuario'=>$usuario->idusuario,
          'nombreusuario'=>$usuario->nombreusuario,
          'vigente'=>$usuario->vigente
        );
      }
      $this->load->view('templates/header');
      $this->load->view('templates/sidebar', array('idempresa' => $idempresa));
      $this->load->view('usuario/editar', array('usuario'=>$usuario));
      $this->load->view('templates/footer');
    }

    public function crear($idEmpresa){

    }
}
