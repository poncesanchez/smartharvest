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

  public function nuevaEmpresa($empresa){
    $this->db->insert('empresa',$empresa);
  }

  public function getCuarteles($empresa){
    $this->db->select("c.idcuartel");
    $this->db->from("empresa");
    $this->db->join('predio', 'predio.idempresa = empresa.idempresa');
    $this->db->join('cuartel', 'cuartel.idpredio = predio.idpredio');
    $this->db->where("empresa.idempresa", $empresa);
    $this->db->order_by("cuartel.idcuartel");
    return $this->db->get();
  }

  public function getPredios($empresa){
    $this->db->select("predio.idpredio, predio.nombre");
    $this->db->from("predio");
    $this->db->join("empresa","predio.idempresa = empresa.idempresa");
    $this->db->where("empresa.idempresa",$empresa);
    $this->db->order_by("empresa.idempresa");
    return $this->db->get();
  }

  public function getJefeCuadrillas($empresa){
    $rolid = 2; //jefe de cuadrillas id
    $this->db->select("persona.idpersona idpersona, concat(persona.nombre, ' ', persona.apellidopaterno) nombre");
    $this->db->from("persona");
    $this->db->join("rol","persona.idrol = rol.idrol");
    $this->db->where("persona.idrol", $rolid);
    $this->db->order_by("persona.idpersona");
    return $this->db->get();
  }

  public function getLabores(){
    $this->db->select("idlabor, nombre");
    $this->db->from("labor");
    $this->db->where("vigente",1);
    $this->db->order_by("idlabor");
    return $this->db->get();
  }
}
