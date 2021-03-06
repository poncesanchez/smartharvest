<?php
class Panelcontrol extends CI_Model{

  public function getDefault($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechas){
    $this->db->select("date_format(asistencia.horaingreso, '%d-%m-%Y') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) supervisor");
    $this->db->select("labor.nombre labor");
    $this->db->select("count(asistencia.idpersona) asistencia");
    $this->db->select("date_format(asistencia.horaingreso, '%H:%i:%s') ingreso");
    $this->db->select("date_format(asistencia.horatermino, '%H:%i:%s') salida");
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
    $this->db->where("asistencia.vigente",1);
    $this->db->where_in("date_format(asistencia.horaingreso, '%d-%m-%Y')",$fechas);
    $this->db->limit(10,$pagina);
    $this->db->group_by(array("date_format(asistencia.horaingreso, '%d-%m-%Y')", "asistencia.idsupervisor"));
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->get();
  }

  public function getDefaultNumber($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechas){
    $this->db->select("date_format(asistencia.horaingreso, '%d-%m-%Y') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) supervisor");
    $this->db->select("labor.nombre labor");
    $this->db->select("count(asistencia.idpersona) asistencia");
    $this->db->select("date_format(asistencia.horaingreso, '%H:%i:%s') ingreso");
    $this->db->select("date_format(asistencia.horatermino, '%H:%i:%s') salida");
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
    $this->db->where("asistencia.vigente",1);
    $this->db->where_in("date_format(asistencia.horaingreso, '%d-%m-%Y')",$fechas);
    $this->db->group_by(array("date_format(asistencia.horaingreso, '%d-%m-%Y')", "asistencia.idsupervisor"));
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->count_all_results();
  }

  public function graficoDefault($idempresa, $predio, $jefecuadrilla, $labor,$fechas){
    $this->db->select("date_format(asistencia.horaingreso, '%d-%m-%Y') dia, time_to_sec(timediff(asistencia.horatermino, asistencia.horaingreso))/3600 horas");
    $this->db->from("asistencia");
    $this->db->join("labor","asistencia.idlabor = labor.idlabor");
    $this->db->join("persona","asistencia.idpersona = persona.idpersona");
    $this->db->join("cuartel","cuartel.idcuartel = asistencia.idcuartel");
    $this->db->join("predio","predio.idpredio = cuartel.idpredio");
    $this->db->join("empresa","predio.idempresa = empresa.idempresa");
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
    $this->db->where_in("date_format(asistencia.horaingreso, '%d-%m-%Y')",$fechas);
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->get();
  }

  public function reporteJefeCuadrilla($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio){
    $this->db->select("date_format(asistencia.horaingreso, '%d-%m-%Y') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) trabajador");
    $this->db->select("labor.nombre labor");
    $this->db->select("cuartel.idcuartel cuartel");
    $this->db->select("date_format(asistencia.horaingreso, '%H:%i:%s') ingreso");
    $this->db->select("date_format(asistencia.horatermino, '%H:%i:%s') salida");
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
    }
    $this->db->where("asistencia.vigente",1);
    $this->db->limit(10,$pagina);
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->get();
  }

  public function numReporteJefeCuadrilla($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio){
    $this->db->select("date_format(asistencia.horaingreso, '%d-%m-%Y') dia");
    $this->db->select("concat(persona.nombre,' ',persona.apellidopaterno) trabajador");
    $this->db->select("labor.nombre Labor");
    $this->db->select("cuartel.idcuartel");
    $this->db->select("date_format(asistencia.horaingreso, '%H:%i:%s') ingreso");
    $this->db->select("date_format(asistencia.horatermino, '%H:%i:%s') salida");
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
    }
    $this->db->where("asistencia.vigente",1);
    $this->db->order_by("asistencia.horaingreso","asistencia.idlabor");
    return $this->db->count_all_results();
  }

  public function reporteTrabajador($idempresa, $pagina, $predio, $jefecuadrilla, $labor, $fechainicio, $fechatermino){
    $query = $this->db->query("select distinct(a1.idpersona), concat(persona.nombre,' ',persona.apellidopaterno) trabajador, (
      select count(a2.idasistencia) from asistencia a2 where a2.idpersona = a1.idpersona and date_format(a2.horaingreso, '%d-%m-%Y') = date_format((now() - INTERVAL 15 DAY), '%d-%m-%Y')
    	) fecha1,(
    	select count(a3.idasistencia) from asistencia a3 where a3.idpersona = a1.idpersona and date_format(a3.horaingreso, '%d-%m-%Y') = date_format((now() - INTERVAL 16 DAY), '%d-%m-%Y')
    	) fecha2,(
    	select count(a4.idasistencia) from asistencia a4 where a4.idpersona = a1.idpersona and date_format(a4.horaingreso, '%d-%m-%Y') = date_format((now() - INTERVAL 17 DAY), '%d-%m-%Y')
    	) fecha3,( select count(a5.idasistencia) from asistencia a5 where a5.idpersona = a1.idpersona and date_format(a5.horaingreso, '%d-%m-%Y') = date_format((now() - INTERVAL 18 DAY), '%d-%m-%Y')
    	) fecha4,( select count(a6.idasistencia) from asistencia a6 where a6.idpersona = a1.idpersona and date_format(a6.horaingreso, '%d-%m-%Y') = date_format((now() - INTERVAL 19 DAY), '%d-%m-%Y')
    	) fecha5
    from asistencia a1
    join persona on a1.idpersona = persona.idpersona");
    return $query;
  }
}
