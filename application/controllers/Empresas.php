<?php
class Empresas extends CI_Controller{
  public function __construct() {
      parent::__construct();
      if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE)
          redirect('login');
      $this->load->model('empresa');
      $this->load->model('usuario');
  }

  public function index(){
    $this->load->model('empresa');
    $data = $this->empresa->getEmpresas();
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('empresa/index',array('empresas'=>$data->result(),'idEmpresa'=>null));
    $this->load->view('templates/footer');
  }

  public function home($id){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$id && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('empresas/home/'.$this->session->user['usuario']->idempresa);
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
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$id));
    $this->load->view('empresa/home', array('empresa'=>$empresa));
    $this->load->view('templates/footer');
  }

  public function editar($id){
    //Control de acceso
    if($this->session->user['usuario']->permalink!="superadmin"){
			redirect('empresas/home/'.$this->session->user['usuario']->idempresa);
		}

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
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('empresa/editar', array('empresa'=>$empresa));
    $this->load->view('templates/footer');
  }

  public function crear(){
    //Control de acceso
    if($this->session->user['usuario']->permalink!="superadmin"){
			redirect('empresas/home/'.$this->session->user['usuario']->idempresa);
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
    $this->load-> view('empresa/crear');
    $this->load->view('templates/footer');
  }

  public function usuarios($idempresa){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idempresa && $this->session->user['usuario']->permalink!="superadmin"){
      redirect('empresas/usuarios/'.$this->session->user['usuario']->idempresa);
    }

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
    } else {
      $pagina = 0;
    }
    $data = $this->usuario->getUsuarios($idempresa,$pagina);
    $numRegistros = $this->usuario->getNumUsuarios($idempresa);
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar', array('idEmpresa'=>$idempresa));
    $this->load->view('usuario/index', array('usuarios'=>$data->result(),'numeroPaginas'=>$pagina));
    $this->load->view('templates/footer');
  }

  public function borrar($id){
    //Control de acceso
    if($this->session->user['usuario']->permalink!="superadmin"){
			redirect('empresas/home/'.$this->session->user['usuario']->idempresa);
		}

    $error = "";
    if (!empty($_POST))
    {
      if (strtoupper($this->input->post('eliminar')) == "ELIMINAR") {
        $idEmpresa = $this->input->post('idempresa');
        $this->empresa->borrarEmpresa($idEmpresa);
        $this->empresa->borrarEmpresaAsistencias($idEmpresa);
        $this->empresa->borarEmpresaPersonas($idEmpresa);
        $this->empresa->borrarEmpresaCuarteles($idEmpresa);
        $this->empresa->borrarEmpresaPredio($idEmpresa);
        $this->empresa->borrarEmpresaUsuario($idEmpresa);
        redirect('empresas/');
      } else{
        $error = "La palabra ingresada es incorrecta.";
      }
    }
    $data = $this->empresa->getEmpresa($id);
    foreach($data->result() as $empresa){
        $empresa = array(
            'idempresa'=>$empresa->idempresa,
            'nombre'=>$empresa->nombre,
            'vigente'=>$empresa->vigente,
            'descripcion'=>$empresa->descripcion
        );
    }
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    $this->load->view('empresa/borrar', array('empresa'=>$empresa,'error'=>$error));
    $this->load->view('templates/footer');
  }
}
