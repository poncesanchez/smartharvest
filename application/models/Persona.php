<?php
class Persona extends CI_Model{

  public function getPersonas($idEmpresa,$pagina,$rol,$activo){
      $this->db->select("*");
      $this->db->from("persona");
      $this->db->where("idempresa",$idEmpresa);
      $this->db->where("idrol",$rol);
      $this->db->where("activo","1");
      $this->db->limit(10,$pagina);
      $this->db->order_by("nombre","ASC");
      return $this->db->get();
  }

  public function getPersona($idPersona, $idempresa){
    $this->db->select("*");
    $this->db->from("persona");
    $this->db->where("idpersona",$idPersona);
    $this->db->where("idempresa",$idempresa);
    return $this->db->get();
  }

  public function getPersonaSinEmpresa($idPersona){
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

  public function numeroPersonas($idEmpresa,$rol){
    $this->db->from("persona");
    $this->db->where("idempresa",$idEmpresa);
    $this->db->where("idrol",$rol);
    $this->db->where("activo","1");
    return $this->db->count_all_results();
  }
}
