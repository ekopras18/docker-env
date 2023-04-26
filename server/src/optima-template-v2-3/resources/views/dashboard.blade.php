<x-templete_top :data="$data" />
<!-- Main charts -->

<div class="row">
	<div class="col-xl-12">
		<!-- Chart data colors -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Rekap Pasien Umum & BPJS</h5>
				<div class="header-elements">
					<div class="list-icons">
						<span><i class="icon-calendar3 text-success mr-2"></i> <span id="set_today"></span></span>
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<input type="hidden" id='today' value="{{date('Y-m-d')}}">
					<input type="hidden" name="rekappasien" id="rekappasien" value="{{$rekappasien}}">
					<div class="chart" id="rekap_pasien"></div>
				</div>
			</div>
		</div>
		<!-- /chart data colors -->
	</div>
</div>
<script>
	var Dashboard = (function() {
		// Set Today di card-header Rekap Pasien Umum & BPJS
		const today = day($('#today').val());
		$('#set_today').html(today);

		// Rekap Pasien Bpjs & Umum
		var _Rekap_Pasien = function() {
				if (typeof echarts == 'undefined') {
						console.warn('Warning - echarts.min.js is not loaded.');
						return;
				}

				// Setup data
				var rekappasien = JSON.parse(document.getElementById('rekappasien').value);
				var umum = [];
				var bpjs = [];
				var category = [];

				for (var u = 0; u < rekappasien.umum.length; u++) {
					umum.push(rekappasien.umum[u]);
				}

				for (var b = 0; b < rekappasien.bpjs.length; b++) {
					bpjs.push(rekappasien.bpjs[b]);
				}

        for (var c = 0; c < rekappasien.klien.length; c++) {
					category.push(rekappasien.klien[c].label);
				}
				
				// Define elements
				var rekap_pasien_element = document.getElementById('rekap_pasien');

				if(rekap_pasien_element) {
					// Generate chart
					var obat = c3.generate({
							bindto: rekap_pasien_element,
							size: { 
								height: 400 
							},
							data: {
									columns: [
											umum,
											bpjs,
									],
									type: 'bar',
									colors: {
										Umum: '#2196f3',
										BPJS: '#66bb6a',
									}
							},
							axis: {
									x: {
											type: 'category',
											categories: category
								}
							},
							grid: {
									y: {
											show: true
									},
							}
					});

					// Resize chart on sidebar width change
					$('.sidebar-control').on('click', function() {
							obat.resize({height:400});
					});
				}

				setTimeout(function () {
						obat.resize({height:400})
				}, 10);


				// Resize function
				var triggerChartResize = function() {
						obat.resize({height:400});
				};

				// On sidebar width change
				$(document).on('click', '.sidebar-control', function() {
						setTimeout(function () {
								triggerChartResize();
						}, 0);
				});

				// On window resize
				var resizeCharts;
				window.onresize = function () {
						clearTimeout(resizeCharts);
						resizeCharts = setTimeout(function () {
								triggerChartResize();
						}, 60);
				};
		};
		// end obat

		return {
			initCharts: function() {
				// Diagnosa Chart
				_Rekap_Pasien();
			},
		};

	})();

	document.addEventListener("DOMContentLoaded", function() {
		Dashboard.initCharts();
	});
</script>
<!-- /main charts -->
<x-templete_bottom />