<?php
class Empresa extends CI_Model{

  public function getEmpresas(){
      $this->db->select("*");
      $this->db->from("empresa");
      return $this->db->get();
  }
}
