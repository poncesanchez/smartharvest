<?php
class Empresa extends CI_Model{

  public function getEmpresas(){
      $this->db->select("*");
      $this->db->from("empresa");
      return $this->db->get();
  }

  public function getEmpresa($id){
    $this->db->select("*");
    $this->db->from("empresa");
    $this->db->where("idempresa",$id);
    return $this->db->get();
  }

  public function actualizarEmpresa($empresa){
    $this->db->set('nombre', $empresa['nombre']);
    $this->db->set('vigente', $empresa['vigente']);
    $this->db->set('descripcion', $empresa['descripcion']);
    $this->db->where('idempresa', $empresa['idempresa']);
    $this->db->update('empresa');
  }
}
