<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		if(!isset($this->session->logged_in) || $this->session->logged_in==FALSE){
			$this->load->view('login');
		} else {
			redirect('login/home');
		}
	}

	public function ingresar(){
		$data = array(
				'usuario' => $this->input->post('usuario'),
				'password' => $this->input->post('password')
		);
		$error = "";
		$this->load->model('usuario');
		if($this->usuario->validate($data)){
			$usuario = $this->input->post('usuario');
			$pass = $this->input->post('password');
			$userdata = $this->usuario->getData($usuario);
			if (!empty($userdata)) {
				if (password_verify($pass, $userdata->pass)) {
					$this->session->logged_in = TRUE;
					$datosSesion['usuario'] = $userdata;
					$this->session->user = $datosSesion;
					redirect('login/home');
				} else {
	  			$error = "Credenciales incorrectas";
				}
			} else {
				$error = "Credenciales incorrectas";
			}

		}
		$this->load->view('login',array('error'=>$error));
	}

	public function logout(){
			unset($_SESSION["user"]);
			$this->session->logged_in = FALSE;
			redirect('login');
	}

	public function home(){
		if($this->session->user['usuario']->permalink!="superadmin"){
			redirect('empresas/home/'.$this->session->user['usuario']->idempresa);
		}

		$this->load->view('templates/header');
    $this->load->view('templates/sidebar');
		$this->load->view('index');
		$this->load->view('templates/footer');
	}
}
