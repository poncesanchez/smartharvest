<?php

class Usuario extends CI_Model{

    public $validate = array(
        array(
          'field'=>'usuario',
          'label'=>'Usuario',
          'rules'=>'trim|required',
          'errors'=>array(
            'required'=>'Indique su %s',
            'trim'=>'Debe ingresar su usuario')),
        array(
          'field'=>'password',
          'label'=>'Contraseña',
          'rules'=>'trim|required',
          'errors'=>array(
            'required'=>'Indique su %s'))
    );

    public function validate($data){
        if(!empty($this->validate)){
            foreach($data as $key=>$value){
                $_POST[$key] = $value;
            }
            $this->form_validation->set_rules($this->validate);
            return $this->form_validation->run();
        }else{
            return TRUE;
        }
    }

    public function getData($user){
        $data = $this->db->get_where('usuario',array('nombreusuario'=>$user))->result();
        if(!empty($data)){
          $usuario = $data[0];
          return $usuario;
        } else {
          return null;
        }
    }
}
