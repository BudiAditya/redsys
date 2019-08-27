<!-- Bootstrap core JavaScript-->

  <script src="{{ URL::asset('adm/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ URL::asset('adm/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ URL::asset('adm/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ URL::asset('adm/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ URL::asset('adm/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ URL::asset('adm/js/demo/chart-pie-demo.js') }}"></script>
  
  <!-- Page level plugins -->
  <script src="{{ URL::asset('adm/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ URL::asset('adm/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ URL::asset('adm/js/demo/datatables-demo.js') }}"></script> 
  
  <script src="http://code.highcharts.com/highcharts.js"></script>
  <script src="http://code.highcharts.com/modules/exporting.js"></script>
  <script src="http://code.highcharts.com/modules/offline-exporting.js"></script>
  <script src="http://code.highcharts.com/highcharts-more.js"></script>
  
  <script>
	function displayChart(data) {
		var y = new Array();
		var series = new Array();	
		
		y.push({
			name:"In Progress",
			y:data.inprogress
		});
		y.push({
			name:"Finish",
			y:data.finish
		});
		
		
		series.push({
				colorByPoint: true,
				name: "Aset",
				data: y
		});
	   
		myChart = Highcharts.chart('container', {
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: true,
						format: '<b>{point.name}</b>: {point.percentage:.1f} %',
						style: {
							color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
						}
					}
				}
			},
			legend: {
				layout: 'vertical',
				align: 'right',
				verticalAlign: 'middle'
			},
			exporting: {
				chartOptions: { // specific options for the exported image
					plotOptions: {
						series: {
							dataLabels: {
								enabled: true
							}
						}
					}
				},
				scale: 3,
				fallBackExportToServer: false
			},


			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Aset'
			},
			
			series: series,
		});

		
	}

	function loadChart()
	{
		$.ajax({
			url:"{{ Url('/grafik') }}",
			type: 'GET'			
			, async: true			
			, cache: false
			, contentType: "application/json; charset=utf-8"
			, dataType: "json"
			, success: function (data) {							
				displayChart(data);
				
			}
		});
	}

	$(document).ready(function()
	{		
		loadChart();
		return false;
	
	});
</script>

@yield('new-script')

</body>

</html>