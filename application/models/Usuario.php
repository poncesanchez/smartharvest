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

  public function getData($nombreusuario){
    $this->db->select("*");
    $this->db->from("usuario");
    $this->db->join("tipousuario","tipousuario.idtipousuario = usuario.idtipousuario");
    $this->db->where("usuario.nombreusuario",$nombreusuario);
    $data = $this->db->get()->result();
    if(!empty($data)){
      $usuario = $data[0];
      return $usuario;
    } else {
      return null;
    }
  }

  public function getUsuario($idusuario){
    $this->db->select("*");
    $this->db->from("usuario");
    $this->db->where("idusuario", $idusuario);
    $this->db->where("vigente", "1");
    return $this->db->get();
  }

  public function getUsuarios($idEmpresa,$pagina){
    $this->db->select("*");
    $this->db->from("usuario");
    $this->db->join("tipousuario","usuario.idtipousuario = tipousuario.idtipousuario");
    $this->db->where("idempresa", $idEmpresa);
    $this->db->where("usuario.vigente", "1");
    $this->db->limit(10,$pagina);
    $this->db->order_by("usuario.idusuario");
    return $this->db->get();
  }

  public function getNumUsuarios($idEmpresa){
    $this->db->select("*");
    $this->db->from("usuario");
    $this->db->join("tipousuario","usuario.idtipousuario = tipousuario.idtipousuario");
    $this->db->where("idempresa", $idEmpresa);
    $this->db->where("usuario.vigente", "1");
    $this->db->order_by("usuario.idusuario");
    return $this->db->count_all_results();
  }

  public function actualizarUsuario($usuario){
    $this->db->set('pass', $usuario['pass']);
    $this->db->where('idusuario', $usuario['idusuario']);
    $this->db->update('usuario');
  }

}
