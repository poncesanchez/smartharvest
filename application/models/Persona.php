<?php
class Persona extends CI_Model{

  public function getPersonas($idEmpresa){
      $this->db->select("*");
      $this->db->from("persona");
      $this->db->where("idempresa",$idEmpresa);
      $this->db->where("idrol","1");
      $this->db->order_by("nombre","ASC");
      return $this->db->get();
  }

  public function getPersona($idPersona){
    $this->db->select("*");
    $this->db->from("persona");
    $this->db->where("idpersona",$idPersona);
    return $this->db->get();
  }

  public function actualizarPersona($idPersona){
    $this->db->set('nombre', $empresa['nombre']);
    $this->db->set('vigente', $empresa['vigente']);
    $this->db->set('descripcion', $empresa['descripcion']);
    $this->db->where('idempresa', $empresa['idempresa']);
    $this->db->update('empresa');
  }

  public function nuevaPersona($persona){
      $this->db->insert('persona',$persona);
  }
}
