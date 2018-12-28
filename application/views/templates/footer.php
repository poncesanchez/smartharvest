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
</script>
<script>

		var chartData = {
			labels: ['10-11-2018', '11-11-2018', '11-12-2018', '12-12-2018', '13-12-2018', '14-12-2018', '15-12-2018'],
			datasets: [{
				type: 'line',
				label: 'Dataset 1',
				borderColor: 'rgb(54, 162, 235)',
				borderWidth: 2,
				fill: false,
				data: [7,8,7,6,9,8]
			}, {
				type: 'line',
				label: 'Dataset 2',
				backgroundColor: 'rgb(255, 99, 132)',
				data: [2,1,2,3,2,4],
				borderColor: 'white',
        fill: false,
				borderWidth: 2
			}, {
				type: 'bar',
				label: 'Dataset 3',
				backgroundColor: 'rgb(75, 192, 192)',
				data: [5,10,15,20,25,30]
			}]

		};
		window.onload = function() {
			var ctx = document.getElementById('myChart').getContext('2d');
			window.myMixedChart = new Chart(ctx, {
				type: 'bar',
				data: chartData,
				options: {
					responsive: true,
					title: {
						display: true,
						text: 'Chart.js Combo Bar Line Chart'
					},
					tooltips: {
						mode: 'index',
						intersect: true
					}
				}
			});
		};

</script>
</body>
</html>
