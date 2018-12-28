<?php
class Panelcontrol extends CI_Model{

  public function getDefault($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino){
    $this->db->select("date_format(asistencia.horaingreso, '%Y-%m-%d') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) supervisor");
    $this->db->select("labor.nombre labor");
    $this->db->select("count(asistencia.idpersona) asistencia");
    $this->db->select("date_format(min(asistencia.horaingreso), '%H:%i:%s') ingreso");
    $this->db->select("date_format(max(asistencia.horaingreso), '%H:%i:%s') salida");
    $this->db->from("asistencia");
    $this->db->join('labor', 'asistencia.idlabor = labor.idlabor');
    $this->db->join('persona', 'asistencia.idpersona = persona.idpersona');
    $this->db->join('cuartel', 'cuartel.idcuartel = asistencia.idcuartel');
    $this->db->join('predio', 'predio.idpredio = cuartel.idpredio');
    $this->db->join('empresa','predio.idempresa = empresa.idempresa');
    $this->db->where("empresa.idempresa",$idempresa);
    if($predio>0) {
      $this->db->where("predio.idpredio",$predio);
    }
    if($jefecuadrilla>0){
      $this->db->where("asistencia.idsupervisor",$jefecuadrilla);
    }
    if($labor>0){
      $this->db->where("labor.idlabor",$labor);
    }
    if($fechainicio!=null){
      $this->db->where("asistencia.horaingreso >= ", $fechainicio);
      if ($fechatermino!=null) {
        $this->db->where("asistencia.horaingreso <= ", $fechatermino);
      }
    }

    $this->db->where("asistencia.vigente",1);
    $this->db->limit(10,$pagina);
    $this->db->group_by(array("date_format(asistencia.horaingreso, '%Y-%m-%d')", "asistencia.idsupervisor", "asistencia.idlabor"));
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->get();
  }
  public function getDefaultNumber($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino){
    $this->db->select("date_format(asistencia.horaingreso, '%Y-%m-%d') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) supervisor");
    $this->db->select("labor.nombre labor");
    $this->db->select("count(asistencia.idpersona) asistencia");
    $this->db->select("date_format(min(asistencia.horaingreso), '%H:%i:%s') ingreso");
    $this->db->select("date_format(max(asistencia.horaingreso), '%H:%i:%s') salida");
    $this->db->from("asistencia");
    $this->db->join('labor', 'asistencia.idlabor = labor.idlabor');
    $this->db->join('persona', 'asistencia.idpersona = persona.idpersona');
    $this->db->join('cuartel', 'cuartel.idcuartel = asistencia.idcuartel');
    $this->db->join('predio', 'predio.idpredio = cuartel.idpredio');
    $this->db->join('empresa','predio.idempresa = empresa.idempresa');
    $this->db->where("empresa.idempresa",$idempresa);
    if($predio>0) {
      $this->db->where("predio.idpredio",$predio);
    }
    if($jefecuadrilla>0){
      $this->db->where("asistencia.idsupervisor",$jefecuadrilla);
    }
    if($labor>0){
      $this->db->where("labor.idlabor",$labor);
    }
    if($fechainicio!=null){
      $this->db->where("asistencia.horaingreso >= ", $fechainicio);
      if ($fechatermino!=null) {
        $this->db->where("asistencia.horaingreso <= ", $fechatermino);
      }
    }
    $this->db->where("asistencia.vigente",1);
    $this->db->group_by(array("date_format(asistencia.horaingreso, '%Y-%m-%d')", "asistencia.idsupervisor", "asistencia.idlabor"));
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->count_all_results();
  }

  /*
  public function getDefault($idPredio){
    $this->db->select("date_format(asistencia.horaingreso, '%Y-%m-%d') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) supervisor");
    $this->db->select("labor.nombre labor");
    $this->db->select("count(asistencia.idpersona) asistencia");
    $this->db->select("date_format(min(asistencia.horaingreso), '%H:%i:%s') ingreso");
    $this->db->select("date_format(max(asistencia.horaingreso), '%H:%i:%s') salida");
    $this->db->from("asistencia");
    $this->db->join('labor', 'asistencia.idlabor = labor.idlabor');
    $this->db->join('persona', 'asistencia.idpersona = persona.idpersona');
    $this->db->join('cuartel', 'cuartel.idcuartel = asistencia.idcuartel');
    $this->db->where("cuartel.idpredio",$idPredio);
    $this->db->where("asistencia.vigente",1);
    $this->db->group_by(array("date_format(asistencia.horaingreso, '%Y-%m-%d')", "asistencia.idsupervisor", "asistencia.idlabor"));
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->get();
  }
  */


  /*
  get reporteria por id_empresa

  select
  date_format(asistencia.horaingreso, '%Y-%m-%d') dia,
  concat(persona.nombre,' ',persona.apellidopaterno) supervisor,
  labor.nombre labor,
  count(asistencia.idpersona) asistencia,
  date_format(min(asistencia.horaingreso), '%H:%i:%s') ingreso,
  date_format(max(asistencia.horaingreso), '%H:%i:%s') salida
  from asistencia
  join labor on asistencia.idlabor = labor.idlabor
  join persona on asistencia.idpersona = persona.idpersona
  join cuartel on cuartel.idcuartel = asistencia.idcuartel
  join predio on predio.idpredio = cuartel.idpredio
  join empresa on predio.idempresa = empresa.idempresa
  where empresa.idempresa = 1 and asistencia.vigente = 1
  group by date_format(asistencia.horaingreso, '%Y-%m-%d'), asistencia.idsupervisor, asistencia.idlabor
  order by asistencia.horaingreso,asistencia.idlabor;
  */



}
