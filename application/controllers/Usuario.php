<?php
class Usuarios extends CI_Controller{

    /**
     * Función de login
     * Referencia en: login.php
     */
    public function login(){
        $data = array(
            'nrut' => $this->input->post('nrut'),
            'drut' => $this->input->post('drut'),
            'password' => $this->input->post('password')
        );
        $error = "";
        $this->load->model('usuario');

        if($this->usuario->validate($data)){
            $nrut = $this->input->post('nrut');
            $drut = $this->input->post('drut');
            $pass = $this->input->post('password');
            if($this->usuario->revisarCredenciales($nrut,$pass)){
                $this->session->logged_in = TRUE;
                $userdata = $this->usuario->getData($nrut);
                $this->session->user = $userdata;
                redirect('sistema/index');
            }else{
                $error = "Credenciales incorrectas :(";
            }
        }

        $this->load->view('fragments/header');
        $this->load->view('login',array('error'=>$error));
        $this->load->view('fragments/footer');
    }

    /**
     * Regla de verificación para validar el RUT
     * @param type $nrut Número de Rut
     * @param type $drut Dígito verificador
     * @return boolean
     */
    public function validaRut($nrut,$drut){
        $nrut = $this->input->post('nrut');
        $drut = $this->input->post('drut');
        $nrut = $nrut."-".$drut;
        if($this->usuario->verificarRut($nrut,$drut)){
          return true;
        }else{
          $this->form_validation->set_message('validaRut', 'El {field} es incorrecto');
          return false;
        }
    }

    public function logout(){
        unset($_SESSION["user"]);
        $this->session->logged_in = FALSE;
        redirect('login');
    }
}
