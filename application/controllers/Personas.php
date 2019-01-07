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

    $arrayGeneros = $this->persona->getGeneros();
    $arrayContratos = $this->persona->getContratos();
    $arrayRoles = $this->persona->getRol();

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

  public function crear($idempresa){
    //Control de acceso
    if($this->session->user['usuario']->idempresa!=$idempresa && $this->session->user['usuario']->permalink!="superadmin"){
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

    $arrayGeneros = $this->persona->getGeneros();
    $arrayContratos = $this->persona->getContratos();
    $arrayRoles = $this->persona->getRol();

    $this->load->view('templates/header');
    $this->load->view('templates/sidebar',array('idEmpresa'=>$idempresa));
    $this->load->view('persona/crear',array(
      'idEmpresa'=>$idempresa,
      'persona'=>null,
      'generos'=>$arrayGeneros,
      'contratos'=>$arrayContratos,
      'roles'=>$arrayRoles
    ));
    $this->load->view('templates/footer');
  }

  public function borrar($idempresa, $idpersona){
    //Control de acceso
    if($this->session->user['usuario']->permalink!="superadmin"){
			redirect('empresas/home/'.$this->session->user['usuario']->idempresa);
		}

    $error = "";
    if (!empty($_POST))
    {
      if (strtoupper($this->input->post('eliminar')) == "ELIMINAR") {
        $idEmpresa = $this->input->post('idpersona');
        $this->empresa->borrarEmpresaUsuario($idEmpresa);
        redirect('personas/listado/'.$idEmpresa.'/trabajador/0');
      } else{
        $error = "La palabra ingresada es incorrecta.";
      }
    }
    $data = $this->persona->getPersona($idpersona, $idempresa);
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
    $this->load->view('persona/borrar', array(
      'persona'=>$persona,
      'error'=>$error
    ));
    $this->load->view('templates/footer');
  }
}
