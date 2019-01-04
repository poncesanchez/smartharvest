<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
</div><!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong>Copyright &copy; 2018 <a href="http://smartharvest.cl">Smart Harvest</a>.</strong> Todos los derechos reservados.
</footer>
</div>
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?=base_url()?>assets/dist/js/adminlte.min.js"></script>
<script src="<?=base_url()?>assets/bower_components/chart.js/Chart.bundle.js"></script>
<script src="<?=base_url()?>assets/dist/js/pages/dashboard2.js"></script>
<script src="<?=base_url()?>assets/dist/js/demo.js"></script>
<script>
$(document).ready(function () {
  $('.sidebar-menu').tree()
})

function fechaFin(){
  var fechaInicio = document.getElementById("fechaInicio");
  var fechaTermino = document.getElementById("fechaTermino");
  if(!rangoFechas(fechaInicio.value, fechaTermino.value)){
    fechaTermino.focus();
    fechaTermino.value = "dd/mm/aaaa";
  }
}
function rangoFechas(fechaInicio,fechaTermino){
  if(fechaTermino>=fechaInicio){
    return true;
  } else {
    alert("El rango de fechas seleccionados es incorrecto");
    return false;
  }
}
function filtroFecha(){
  var fechaInicio = document.getElementById("fechaInicio");
  var fechaTermino = document.getElementById("fechaTermino");
  fechaTermino.disabled = false;
  fechaTermino.focus();
  if(fechaTermino.value){
    if(!rangoFechas(fechaInicio.value, fechaTermino.value)){
      fechaInicio.focus();
      fechaInicio.value = "dd/mm/aaaa";
      fechaTermino.value = "dd/mm/aaaa";
    }
  }
}


</script>
</body>
</html>
