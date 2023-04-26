<x-templete_top :data="$data" />
<!-- Main charts -->

<div class="row">
	<div class="col-xl-8">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Pengelompokan Penyakit</h5>
				<div class="header-elements">
					<div class="list-icons">
						<!-- <a class="list-icons-item" data-action="collapse"></a> -->
						<!-- <a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a> -->
					</div>
				</div>
			</div>

			<div class="card-body">
				<!-- Quick stats boxes -->
				<div class="row">
					<div class="col-lg-4" id="polamakan">

						<!-- Members online -->
						<div class="card bg-teal-400" style="min-height: 175px;">
							<div class="card-body">
								<div class="d-flex">
									<h3 class="font-weight-semibold mb-0">8,235</h3>
									<span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span>
								</div>
								<div>
									Penyakit Dengan Pola Makan
									<div class="font-size-sm opacity-75">479 avg</div>
								</div>
							</div>

							<div class="container-fluid">
								<div id="p-polamakan"></div>
							</div>
						</div>
						<!-- /members online -->

					</div>

					<div class="col-lg-4" id="keberagamanhidup">

						<!-- Current server load -->
						<div class="card bg-teal-400" style="min-height: 175px;">
							<div class="card-body">
								<div class="d-flex">
									<h3 class="font-weight-semibold mb-0">1,450</h3>
									<!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
								</div>

								<div>
									Penyakit Dengan Keberagaman Hidup
									<div class="font-size-sm opacity-75">234 avg</div>
								</div>
							</div>

							<div class="container-fluid">
								<div id="p-keberagamanhidup"></div>
							</div>
						</div>
						<!-- /current server load -->

					</div>

					<div class="col-lg-4" id="polapikir">

						<!-- Today's revenue -->
						<div class="card bg-teal-400" style="min-height: 175px;">
							<div class="card-body">
								<div class="d-flex">
									<h3 class="font-weight-semibold mb-0">840</h3>
									<!-- <span class="badge bg-teal-800 badge-pill align-self-center ml-auto">+53,6%</span> -->
								</div>

								<div>
									Penyakit Dengan Pola Pikir
									<div class="font-size-sm opacity-75">45 avg</div>
								</div>
							</div>

							<div class="container-fluid">
								<div id="p-polapikir"></div>
							</div>
						</div>
						<!-- /today's revenue -->

					</div>
				</div>
				<!-- /quick stats boxes -->
			</div>
		</div>

	</div>
	<div class="col-xl-4">
		<!-- Progress counters -->
		<div class="row" id="popup-gender">
			<div class="col-sm-6">

				<input type="hidden" name="datagender" id="datagender" value="{{$gender}}">

				<!-- Available hours -->
				<div class="card text-center">
					<div class="card-body">

						<!-- Progress counter -->
						<div class="svg-center position-relative" id="perempuan"></div>
						<!-- /progress counter -->


						<!-- Bars -->
						<div id="perempuan-bars"></div>
						<!-- /bars -->

					</div>
				</div>
				<!-- /available hours -->

			</div>

			<div class="col-sm-6">

				<!-- Productivity goal -->
				<div class="card text-center">
					<div class="card-body">

						<!-- Progress counter -->
						<div class="svg-center position-relative" id="laki"></div>
						<!-- /progress counter -->

						<!-- Bars -->
						<div id="laki-bars"></div>
						<!-- /bars -->

					</div>
				</div>
				<!-- /productivity goal -->

			</div>
		</div>
		<!-- /progress counters -->

	</div>
	<div class="col-xl-7">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Diagnosa Terbanyak</h5>
				<div class="header-elements">
					<div class="list-icons">
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<input type="hidden" name="datadiagnosa" id="datadiagnosa" value="{{$diagnosa}}">
					<div class="chart has-fixed-height" id="diagnosachart"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-5">
		<!-- Simple interaction -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Diagnosa Berdasarkan Wilayah (Kecamatan)</h5>
				<div class="header-elements">
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<input type="hidden" name="datakecamatan" id="datakecamatan" value="{{$kecamatan}}">
					<div class="chart has-fixed-height" id="wilayahchart"></div>
				</div>
			</div>
		</div>
		<!-- /simple interaction -->
	</div>

	<div class="col-xl-6">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Diagnosa Terbanyak</h5>
				<div class="header-elements">
				</div>
			</div>

			<div class="card-body">
				<div class="table-responsive">
					<table class="table chart-table text-nowrap">
						<thead>
							<tr>
								<th width="5%">Kode</th>
								<th>Diagnosa</th>
								<th width="10%">Jumlah</th>
							</tr>
						</thead>
						<tbody>
				            @foreach($diagnosa2 as $key => $data)
								<tr>
									<td>{{$data->msdiagKode}}</td>
									<td>{{$data->diagDiagnosa}}</td>
									<td style="text-align: right;">{{number_format($data->jumlah)}}</td>
								</tr>				            
				            @endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-6">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Diagnosa Terbanyak Berdasarkan Umur</h5>
				<div class="header-elements">
				</div>
			</div>

			<div class="card-body">
				<div class="table-responsive">
				<table class="table chart-table text-nowrap">
						<thead>
							<tr>
								<th width="25%">Range Umur</th>
								<th>Diagnosa</th>
								<th width="10%">Jumlah</th>
							</tr>
						</thead>
						<tbody>
				            @foreach($listumur as $key => $data2)
								<tr>
									<td>{{$data2["ket"]}}</td>
									<td>{{$data2["diagnosa"]}}</td>
									<td style="text-align: right;">{{$data2["jumlah"]}}</td>
								</tr>				            
				            @endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="col-xl-12">
		<!-- Path transitions -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<input type="hidden" name="dataumurdiagnosa" id="dataumurdiagnosa" value="{{$umurdiagnosa}}">
				<h5 class="card-title">Diagnosa Klasifikasi Umur</h5>
				<div class="header-elements">
					<div class="list-icons">
						<!-- <a class="list-icons-item" data-action="collapse"></a>
		                		<a class="list-icons-item" data-action="reload"></a>
		                		<a class="list-icons-item" data-action="remove"></a> -->
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<div class="chart" id="umurdiagnosa" style="min-height: 500px;"></div>
				</div>
			</div>
		</div>
		<!-- /path transitions -->
	</div>


	<div class="col-xl-6">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Diagnosa Terbanyak Berdasarkan Wilayah</h5>
				<div class="header-elements">
				</div>
			</div>

			<div class="card-body">
				<!-- <div class="table-responsive"> -->
				<table class="table chart-table text-nowrap">
						<thead>
							<tr>
								<th width="30%">Kecamatan</th>
								<th>Diagnosa</th>
								<th width="10%">Jumlah</th>
							</tr>
						</thead>
						<tbody>
			                @php
			      	          $rowIndex=0;
			                @endphp
				            @foreach($listkecamatan as $key => $data2)
				                @php
				      	          $rowIndex++;
				                @endphp
				                @if($rowIndex<=10)
								<tr>
									<td>{{$data2["nama"]}}</td>
									<td>{{$data2["diagnosa"]}}</td>
									<td style="text-align: right;">{{$data2["maxjum"]}}</td>
								</tr>
								@endif				            
				            @endforeach
						</tbody>
					</table>
			</div>
		</div>
	</div>


	<div class="col-xl-6">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">&nbsp;</h5>
				<div class="header-elements">
				</div>
			</div>

			<div class="card-body">
				<!-- <div class="table-responsive"> -->
				<table class="table chart-table text-nowrap">
						<thead>
							<tr>
								<th width="30%">Kecamatan</th>
								<th>Diagnosa</th>
								<th width="10%">Jumlah</th>
							</tr>
						</thead>
						<tbody>
			                @php
			      	          $rowIndex=0;
			                @endphp
				            @foreach($listkecamatan as $key => $data2)
				                @php
				      	          $rowIndex++;
				                @endphp
				                @if($rowIndex>10)
								<tr>
									<td>{{$data2["nama"]}}</td>
									<td>{{$data2["diagnosa"]}}</td>
									<td style="text-align: right;">{{$data2["maxjum"]}}</td>
								</tr>				            
								@endif				            
				            @endforeach
						</tbody>
					</table>
			</div>
		</div>
	</div>

	<!-- <div class="col-xl-4">
	</div> -->

	<div id="polamakanModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding-bottom: 10px;border-bottom-width: 1px;background-color: #293a50; color: white">
					<h5 class="modal-title">Penyakit Dengan Pola Makan </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="chart" id="d3-bar-vertical"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="keberagamanhidupModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding-bottom: 10px;border-bottom-width: 1px;background-color: #293a50; color: white">
					<h5 class="modal-title">Penyakit Dengan Keberagaman Hidup </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="chart" id="d3-bar-vertical2"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="polapikirModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding-bottom: 10px;border-bottom-width: 1px;background-color: #293a50; color: white">
					<h5 class="modal-title">Penyakit Dengan Pola Pikir </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="chart" id="d3-bar-vertical3"></div>
				</div>
			</div>
		</div>
	</div>

	<div id="genderModal" class="modal fade" tabindex="-1" role="dialog" style="min-width: 600px;">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content" style="min-width: 550px;">
				<input type="hidden" name="datagenderdiagnosa" id="datagenderdiagnosa" value="">
				<div class="modal-header" style="padding-bottom: 10px;border-bottom-width: 1px;background-color: #293a50; color: white">
					<h5 class="modal-title">Diagnosa Berdasarkan Gender</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="card-body py-0">
						<div class="row text-center">
							<div class="col-6">
								<div class="mb-3">
								<h5 class="font-weight-semibold mb-0"><span class="icon-woman" style="color: rgb(51, 102, 204);"></span> <div id="jumModalWoman">0</div></h5>
										<span class="text-muted font-size-sm">Perempuan</span>
								</div>
							</div>
							<div class="col-6">
								<div class="mb-3">
									<h5 class="font-weight-semibold mb-0"><span class="icon-man" style="color: rgb(220, 57, 18);"></span> <div id="jumModalMan">0</div></h5>
											<span class="text-muted font-size-sm">Laki-Laki</span>
								</div>
							</div>
						</div>
					</div>

					<!-- <div class="chart-container"> -->
					<div class="chart" id="genderdiagnosachart" style="height: 100%;"></div>
					<!-- </div> -->
					<!-- /sales stats -->
				</div>
			</div>
		</div>
	</div>

	<div id="wilayahModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header" style="padding-bottom: 10px;border-bottom-width: 1px;background-color: #293a50; color: white">
					<input type="hidden" name="dtkecdiagnosa" id="dtkecdiagnosa" value="{{$kecamatan_diagnosa}}">
					<h5 class="modal-title">Kecamatan <span id="kec"></span></h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="bodychart">
						<!-- <div class="chart-container has-scroll text-center"> -->
						<div class="chart svg-center" id="wilayahchartdetail"></div>
						<!-- </div> -->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="wilayahModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="kec"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Modal body text goes here.</p>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title"></h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<div class="chart has-fixed-height" id="pie_obat"></div>
				</div>
			</div>
		</div>
		<!-- /donut multiples -->
	</div>
	<div class="col-xl-8">
		<!-- Categorized axes -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Penjualan Obat</h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<div class="chart" id="penjualanobat"></div>
				</div>
			</div>
		</div>
		<!-- /xategorized axes -->
	</div>
	<div class="col-xl-4">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table class="table chart-table text-nowrap">
						<thead>
							<tr>
								<th width="5%">Kode</th>
								<th>Obat</th>
								<th width="10%">Harga</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>A098</td>
								<td>Acarbose</td>
								<td class="AutoNumeric angka">30600</td>
							</tr>
							<tr>
								<td>G058</td>
								<td>Alprazolam</td>
								<td class="AutoNumeric angka">1002</td>
							</tr>
							<tr>
								<td>A056</td>
								<td>Ambroxol 15 mg</td>
								<td class="AutoNumeric angka">1776</td>
							</tr>
							<tr>
								<td>S056</td>
								<td>Ambroxol 30 mg</td>
								<td class="AutoNumeric angka">25700</td>
							</tr>
							<tr>
								<td>A058</td>
								<td>Aminofin</td>
								<td class="AutoNumeric angka">1777</td>
							</tr>
							<tr>
								<td>C098</td>
								<td>Alprazolam 0,5 mg</td>
								<td class="AutoNumeric angka">3466</td>
							</tr>
							<tr>
								<td>B067</td>
								<td>Acyclovir 200 mg</td>
								<td class="AutoNumeric angka">500</td>
							</tr>
							<tr>
								<td>A023</td>
								<td>Acyclovir 400 mg</td>
								<td class="AutoNumeric angka">3500</td>
							</tr>
							<tr>
								<td>H089</td>
								<td>Acyclovir 5%</td>
								<td class="AutoNumeric angka">2300</td>
							</tr>
							<tr>
								<td>I089</td>
								<td>Allporinol</td>
								<td class="AutoNumeric angka">27600</td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-12">
		<!-- Chart data colors -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Chart Jenis Obat</h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<div class="chart" id="jenis_obat"></div>
				</div>
			</div>
		</div>
		<!-- /chart data colors -->
	</div>
	<div class="col-xl-12">
		<!-- Thermometer chart -->
		<div class="card">
			<div class="card-header header-elements-inline">
				<h5 class="card-title">Chart Stok Obat Terbanyak</h5>
				<div class="header-elements">
					<div class="list-icons">
						<a class="list-icons-item" data-action="collapse"></a>
					</div>
				</div>
			</div>

			<div class="card-body">
				<div class="chart-container">
					<div class="chart has-fixed-height" id="stok_obat"></div>
				</div>
			</div>
		</div>
		<!-- /thermometer chart -->
	</div>
</div>
<script>
	var Dashboard = (function() {


		var _Chart = function() {
			if (typeof echarts == 'undefined') {
				console.warn('Warning - echarts.min.js is not loaded.');
				return;
			}

			var diagnosa_element = document.getElementById('diagnosachart');
			var wilayah_element = document.getElementById('wilayahchart');
			var wilayah_detail_element = document.getElementById('wilayahchartdetail');
			// Thermometer
			if (diagnosa_element) {

				// Initialize chart
				var columns_thermometer = echarts.init(diagnosa_element);


				//
				// Chart config
				//

				var dtdiagnosa = JSON.parse(document.getElementById('datadiagnosa').value);

				var databar = [];
				var axisData = [];
				for (var i = 0; i < dtdiagnosa.length; i++) {
					var diag = {}
					diag.diagnosa = dtdiagnosa[i].diagDiagnosa;
					diag.value = dtdiagnosa[i].jumlah;
					axisData.push(dtdiagnosa[i].msdiagKode);
					databar.push(diag);
				}

				// Options
				var columns_thermometer_options = {

					// Global text styles
					textStyle: {
						fontFamily: 'Roboto, Arial, Verdana, sans-serif',
						fontSize: 10
					},

					// Chart animation duration
					animationDuration: 750,

					// Setup grid
					grid: {
						left: 10,
						right: 10,
						top: 35,
						bottom: 0,
						containLabel: true
					},

					// Add legend
					legend: {
						data: ['Forecast'],
						itemHeight: 8,
						itemGap: 20,
						selectedMode: false
					},

					// Add tooltip
					tooltip: {
						trigger: 'axis',
						backgroundColor: 'rgba(0,0,0,0.75)',
						padding: [10, 15],
						textStyle: {
							fontSize: 13,
							fontFamily: 'Roboto, sans-serif'
						},
						axisPointer: {
							type: 'shadow',
							shadowStyle: {
								color: 'rgba(0,0,0,0.025)'
							}
						},
						formatter: function(params) {
							return 'Kode : ' + params[0].name + '<br/>' +
								'Diagnosa : ' + params[0].data.diagnosa + '<br/>' +
								'Jumlah Diagnosa: ' + (params[0].value);
						}
					},

					// Horizontal axis
					xAxis: [{
						type: 'category',
						data: axisData,
						axisLabel: {
							color: '#333'
						},
						axisLine: {
							lineStyle: {
								color: '#999'
							}
						},
						splitLine: {
							show: true,
							lineStyle: {
								color: '#eee',
								type: 'dashed'
							}
						}
					}],

					// Vertical axis
					yAxis: [{
						type: 'value',
						boundaryGap: [0, 0.1],
						axisLabel: {
							color: '#333'
						},
						axisLine: {
							lineStyle: {
								color: '#999'
							}
						},
						splitLine: {
							lineStyle: {
								color: '#eee'
							}
						},
						splitArea: {
							show: true,
							areaStyle: {
								color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
							}
						}
					}],

					// Add series
					series: [{
						name: 'Diagnosa',
						type: 'bar',
						stack: 'sum',
						itemStyle: {
							normal: {
								color: '#f5f5f5',
								barBorderColor: '#FF7043',
								barBorderWidth: 3,
								label: {
									show: true,
									position: 'top',
									formatter: function(params) {
										for (var i = 0, l = columns_thermometer_options.xAxis[0].data.length; i < l; i++) {
											if (columns_thermometer_options.xAxis[0].data[i] == params.name) {
												// return columns_thermometer_options.series[0].data[i] + params.value;
												return params.value;
											}
										}
									},
									textStyle: {
										color: '#FF7043'
									}
								}
							}
						},
						// data: [2660, 1642, 906, 893, 719, 669, 661, 546, 534 ,508]
						data: databar
					}]
				};

				// Set options
				columns_thermometer.setOption(columns_thermometer_options);
			}

			if (wilayah_element) {

				// Initialize chart
				var pie_nested = echarts.init(wilayah_element);
				//
				// Chart config
				//

				var dtkecamatan = JSON.parse(document.getElementById('datakecamatan').value);

				var datapie = [];
				for (var i = 0; i < dtkecamatan.length; i++) {
					var res = {};
					res.name = dtkecamatan[i].nama;
					res.kode = dtkecamatan[i].kode;
					res.value = dtkecamatan[i].jumlah;
					res.diagnosa = [{
						dKd: 'A001',
						dNm: 'Nama Diagnosa 1',
						dJum: 120
					}, {
						dKd: 'A002',
						dNm: 'Nama Diagnosa 2',
						dJum: 345
					}];
					datapie.push(res);
				}

				// Options
				pie_nested.setOption({

					// Colors
					color: [
						'#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
						'#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
						'#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
						'#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
					],

					// Global text styles
					textStyle: {
						fontFamily: 'Roboto, Arial, Verdana, sans-serif',
						fontSize: 13
					},

					// Add tooltip
					tooltip: {
						trigger: 'item',
						backgroundColor: 'rgba(0,0,0,0.75)',
						padding: [10, 15],
						textStyle: {
							fontSize: 13,
							fontFamily: 'Roboto, sans-serif'
						},
						formatter: '{a} <br/>{b}: {c} ({d}%)'
					},

					// Add series
					series: [
						// Outer
						{
							name: 'Kecamatan',
							type: 'pie',
							radius: ['30%', '55%'],
							itemStyle: {
								normal: {
									borderWidth: 1,
									borderColor: '#fff'
								}
							},
							data: datapie
						}
					]
				});

				pie_nested.on('click', function(params) {
					// Print name in console
					// console.log(params.data);
					$("#kec").empty();
					$("#kec").append(params.data.name);

					var dtkecdiagnosa = JSON.parse(document.getElementById('dtkecdiagnosa').value);
					// console.log(dtkecdiagnosa);
					var kode = params.data.kode;
					var res = [];
					for (var i = 0; i < dtkecdiagnosa.length; i++) {
						if (dtkecdiagnosa[i].rawatKec == kode) {
							var dat = {};
							dat.diagnosa = dtkecdiagnosa[i].diagnosa;
							dat.kode = dtkecdiagnosa[i].kode;
							dat.jumlah = dtkecdiagnosa[i].jumlah;
							res.push(dat);
						}
					}
					res.sort(function(a, b) {
						return b.jumlah - a.jumlah;
					});

					var res2 = [];
					for (var i = 0; i < 5; i++) {
						var dat = {};
						dat.diagnosa = res[i].diagnosa;
						dat.label = res[i].jumlah.toLocaleString();
						dat.label2 = res[i].kode;
						dat.size = res[i].jumlah;
						res2.push(dat);
					}
					res = [];
					// console.log(res2);
					wilayah_detail_element.innerHTML = '';
					setTimeout(function() {

						var sets = res2;
						var s1 = Math.floor(Math.random() * 10);
						var s2 = Math.floor(Math.random() * 10);
						var s3 = Math.floor(Math.random() * 10);
						var s4 = Math.floor(Math.random() * 10);
						var s5 = Math.floor(Math.random() * 10);
						var s6 = Math.floor(Math.random() * 10);
						var s7 = Math.floor(Math.random() * 10);

						var overlaps = [{
								sets: [0, 1],
								size: s1
							},
							{
								sets: [0, 2],
								size: s5
							},
							{
								sets: [1, 2],
								size: s2
							},
							{
								sets: [1, 3],
								size: s6
							},
							{
								sets: [2, 3],
								size: s3
							},
							{
								sets: [2, 4],
								size: s7
							},
							{
								sets: [3, 4],
								size: s4
							},
						];


						// Initialize chart
						// ------------------------------

						// Define colors
						var colours = d3.scale.category10();

						// Get positions for each set
						sets = venn.venn(sets, overlaps);

						// Draw the diagram in the 'venn' div
						var diagram = venn.drawD3Diagram(d3.select(wilayah_detail_element), sets, 400, 400);


						// Add tooltip
						// ------------------------------

						// Add a tooltip showing the size of each set/intersection
						var tooltip = d3.select(".bodychart").append("div").attr("class", "venntooltip");
						// console.log(tooltip);

						d3.selection.prototype.moveParentToFront = function() {
							return this.each(function() {
								this.parentNode.parentNode.appendChild(this.parentNode);
							});
						};

						// Text styling
						diagram.text.style("fill", "white").style("font-weight", "500").style("cursor", "pointer");

						// Hover on all the circles
						diagram.circles
							.style("stroke-opacity", 0)
							.style("stroke", "white")
							.style("stroke-width", "2")
							.style("fill-opacity", .7);

						// Add events
						diagram.nodes
							.on("mousemove", function() {
								// console.log(tooltip);
								// tooltip.style("left", (d3.event.pageX + 20) + "px")
								// 	.style("top", (d3.event.pageY - 15) + "px");
							})
							.on("mouseover", function(d, i) {
								var selection = d3.select(this).select("circle");
								selection.moveParentToFront()
									.transition()
									.style("fill-opacity", .7)
									.style("cursor", "pointer")
									.style("stroke-opacity", 1);

								tooltip.transition().style("display", "block");
								tooltip.text(d.label2 + ' : ' + d.diagnosa + ' (' + d.label.toLocaleString() + ')');

								tooltip.style("left", (d.x + 100) + "px")
									.style("top", (d.y - 100) + "px");
							})
							.on("mouseout", function(d, i) {
								d3.select(this).select("circle").transition()
									.style("fill-opacity", .7)
									.style("stroke-opacity", 0);

								tooltip.transition().style("display", "none");
							});


					}.bind(this), 100);

					$('#wilayahModal').modal('show');
				});

			}

			// Resize function
			var triggerChartResize = function() {
				diagnosa_element && columns_thermometer.resize();
				wilayah_element && pie_nested.resize();

			};

			// On sidebar width change
			$(document).on('click', '.sidebar-control', function() {
				setTimeout(function() {
					triggerChartResize();
				}, 0);
			});

			// On window resize
			var resizeCharts;
			window.onresize = function() {
				clearTimeout(resizeCharts);
				resizeCharts = setTimeout(function() {
					triggerChartResize();
				}, 200);
			};
		};

		// Rounded progress charts
		var _GenderChart = function(element, radius, border, color, end, iconClass, textTitle, textAverage) {
			if (typeof d3 == 'undefined') {
				console.warn('Warning - d3.min.js is not loaded.');
				return;
			}

			// Initialize chart only if element exsists in the DOM
			if ($(element).length > 0) {


				// Basic setup
				// ------------------------------

				// Main variables
				var d3Container = d3.select(element),
					startPercent = 0,
					iconSize = 32,
					endPercent = end,
					twoPi = Math.PI * 2,
					formatPercent = d3.format('.0%'),
					boxSize = radius * 2;

				// Values count
				var count = Math.abs((endPercent - startPercent) / 0.01);

				// Values step
				var step = endPercent < startPercent ? -0.01 : 0.01;



				// Create chart
				// ------------------------------

				// Add SVG element
				var container = d3Container.append('svg');

				// Add SVG group
				var svg = container
					.attr('width', boxSize)
					.attr('height', boxSize)
					.append('g')
					.attr('transform', 'translate(' + (boxSize / 2) + ',' + (boxSize / 2) + ')');



				// Construct chart layout
				// ------------------------------

				// Arc
				var arc = d3.svg.arc()
					.startAngle(0)
					.innerRadius(radius)
					.outerRadius(radius - border);



				//
				// Append chart elements
				//

				// Paths
				// ------------------------------

				// Background path
				svg.append('path')
					.attr('class', 'd3-progress-background')
					.attr('d', arc.endAngle(twoPi))
					.style('fill', '#eee');

				// Foreground path
				var foreground = svg.append('path')
					.attr('class', 'd3-progress-foreground')
					.attr('filter', 'url(#blur)')
					.style('fill', color)
					.style('stroke', color);

				// Front path
				var front = svg.append('path')
					.attr('class', 'd3-progress-front')
					.style('fill', color)
					.style('fill-opacity', 1);



				// Text
				// ------------------------------

				// Percentage text value
				var numberText = d3.select(element)
					.append('h2')
					.attr('class', 'pt-1 mt-2 mb-1')

				// Icon
				d3.select(element)
					.append('i')
					.attr('class', iconClass + ' counter-icon')
					.attr('style', 'top: ' + ((boxSize - iconSize) / 2) + 'px');

				// Title
				d3.select(element)
					.append('div')
					.text(textTitle);

				// Subtitle
				d3.select(element)
					.append('div')
					.attr('class', 'font-size-sm text-muted mb-3')
					.text(textAverage);



				// Animation
				// ------------------------------

				// Animate path
				function updateProgress(progress) {
					foreground.attr('d', arc.endAngle(twoPi * progress));
					front.attr('d', arc.endAngle(twoPi * progress));
					numberText.text(formatPercent(progress));
				}

				// Animate text
				var progress = startPercent;
				(function loops() {
					updateProgress(progress);
					if (count > 0) {
						count--;
						progress += step;
						setTimeout(loops, 10);
					}
				})();
			}
		};

		// Bar charts
		var _GenderBarChart = function(element, barQty, height, animate, easing, duration, delay, color, tooltip) {
			if (typeof d3 == 'undefined') {
				console.warn('Warning - d3.min.js is not loaded.');
				return;
			}

			// Initialize chart only if element exsists in the DOM
			if ($(element).length > 0) {


				// Basic setup
				// ------------------------------

				// Add data set
				var bardata = [];
				for (var i = 0; i < barQty; i++) {
					bardata.push(Math.round(Math.random() * 10) + 10);
				}

				// Main variables
				var d3Container = d3.select(element),
					width = d3Container.node().getBoundingClientRect().width;



				// Construct scales
				// ------------------------------

				// Horizontal
				var x = d3.scale.ordinal()
					.rangeBands([0, width], 0.3);

				// Vertical
				var y = d3.scale.linear()
					.range([0, height]);



				// Set input domains
				// ------------------------------

				// Horizontal
				x.domain(d3.range(0, bardata.length));

				// Vertical
				y.domain([0, d3.max(bardata)]);



				// Create chart
				// ------------------------------

				// Add svg element
				var container = d3Container.append('svg');

				// Add SVG group
				var svg = container
					.attr('width', width)
					.attr('height', height)
					.append('g');



				//
				// Append chart elements
				//

				// Bars
				var bars = svg.selectAll('rect')
					.data(bardata)
					.enter()
					.append('rect')
					.attr('class', 'd3-random-bars')
					.attr('width', x.rangeBand())
					.attr('x', function(d, i) {
						return x(i);
					})
					.style('fill', color);



				// Tooltip
				// ------------------------------

				var tip = d3.tip()
					.attr('class', 'd3-tip')
					.offset([-10, 0]);

				// Show and hide
				if (tooltip == 'hours' || tooltip == 'goal' || tooltip == 'members') {
					bars.call(tip)
						.on('mouseover', tip.show)
						.on('mouseout', tip.hide);
				}

				// Daily meetings tooltip content
				if (tooltip == 'hours') {
					tip.html(function(d, i) {
						return '<div class="text-center">' +
							'<h6 class="m-0">' + d + '</h6>' +
							'<span class="font-size-sm">meetings</span>' +
							'<div class="font-size-sm">' + i + ':00' + '</div>' +
							'</div>'
					});
				}

				// Statements tooltip content
				if (tooltip == 'goal') {
					tip.html(function(d, i) {
						return '<div class="text-center">' +
							'<h6 class="m-0">' + d + '</h6>' +
							'<span class="font-size-sm">statements</span>' +
							'<div class="font-size-sm">' + i + ':00' + '</div>' +
							'</div>'
					});
				}

				// Online members tooltip content
				if (tooltip == 'members') {
					tip.html(function(d, i) {
						return '<div class="text-center">' +
							'<h6 class="m-0">' + d + '0' + '</h6>' +
							'<span class="font-size-sm">members</span>' +
							'<div class="font-size-sm">' + i + ':00' + '</div>' +
							'</div>'
					});
				}



				// Bar loading animation
				// ------------------------------

				// Choose between animated or static
				if (animate) {
					withAnimation();
				} else {
					withoutAnimation();
				}

				// Animate on load
				function withAnimation() {
					bars
						.attr('height', 0)
						.attr('y', height)
						.transition()
						.attr('height', function(d) {
							return y(d);
						})
						.attr('y', function(d) {
							return height - y(d);
						})
						.delay(function(d, i) {
							return i * delay;
						})
						.duration(duration)
						.ease(easing);
				}

				// Load without animateion
				function withoutAnimation() {
					bars
						.attr('height', function(d) {
							return y(d);
						})
						.attr('y', function(d) {
							return height - y(d);
						})
				}



				// Resize chart
				// ------------------------------

				// Call function on window resize
				$(window).on('resize', barsResize);

				// Call function on sidebar width change
				$(document).on('click', '.sidebar-control', barsResize);

				// Resize function
				// 
				// Since D3 doesn't support SVG resize by default,
				// we need to manually specify parts of the graph that need to 
				// be updated on window resize
				function barsResize() {

					// Layout variables
					width = d3Container.node().getBoundingClientRect().width;


					// Layout
					// -------------------------

					// Main svg width
					container.attr('width', width);

					// Width of appended group
					svg.attr('width', width);

					// Horizontal range
					x.rangeBands([0, width], 0.3);


					// Chart elements
					// -------------------------

					// Bars
					svg.selectAll('.d3-random-bars')
						.attr('width', x.rangeBand())
						.attr('x', function(d, i) {
							return x(i);
						});
				}
			}
		};

		var _UmurDiagnosa = function() {
			if (typeof d3 == 'undefined') {
				console.warn('Warning - d3.min.js is not loaded.');
				return;
			}

			// Main variables
			var element = document.getElementById('umurdiagnosa'),
				height = 500;


			// Initialize chart only if element exsists in the DOM
			if (element) {

				// Basic setup
				// ------------------------------

				// Define main variables
				var d3Container = d3.select(element),
					margin = {
						top: 25,
						right: 40,
						bottom: 20,
						left: 300
					},
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
					height = height - margin.top - margin.bottom - 5,
					barHeight = 30,
					duration = 750,
					delay = 25;



				// Construct scales
				// ------------------------------

				// Horizontal
				var x = d3.scale.linear()
					.range([0, width]);

				// Colors
				var color = d3.scale.ordinal()
					.range(["#26A69A", "#26ff0A"]);



				// Create axes
				// ------------------------------

				// Horizontal
				var xAxis = d3.svg.axis()
					.scale(x)
					.orient("top");



				// Create chart
				// ------------------------------

				// Add SVG element
				var container = d3Container.append("svg");

				// Add SVG group
				var svg = container
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


				// Construct chart layout
				// ------------------------------

				// Partition
				var partition = d3.layout.partition()
					.value(function(d) {
						return d.size;
					});


				// Add SVG group
				var svg = container
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

				// Load data
				// ------------------------------

				var data = JSON.parse(document.getElementById('dataumurdiagnosa').value);

				var bardata = {
					"name": "flare",
					"children": [],
				}

				var tempCode = 0;
				for (var i = 0; i < data.length; i++) {
					if (tempCode != data[i].no) {
						var res = {};
						res.name = data[i].ket;
						bardata.children.push(res);
						res.children = [];
						var resChild = {
							name: data[i].diagnosa,
							size: data[i].jumlah
						};
						res.children.push(resChild);


						tempCode = data[i].no;
					} else {
						var resChild = {
							name: data[i].diagnosa,
							size: data[i].jumlah
						};
						res.children.push(resChild);
					}
				}

				// console.log(bardata);
				setTimeout(function() {
					partition.nodes(bardata);
					x.domain([0, bardata.value]).nice();
					down(bardata, 0);
				}.bind(this), 500);

				// d3.json("assets/js/data/d3/bars/bars_hierarchical.json", function(error, root) {
				//     partition.nodes(root);
				//     x.domain([0, root.value]).nice();
				//     down(root, 0);
				// });


				//
				// Append chart elements
				//

				// Add background bars
				svg.append("rect")
					.attr("class", "d3-bars-background")
					.attr("width", width)
					.attr("height", height)
					.style("fill", "#fff")
					.on("click", up);
				// Append axes
				// ------------------------------

				// Horizontal
				svg.append("g")
					.attr("class", "d3-axis d3-axis-horizontal d3-axis-strong");


				// Append bars
				// ------------------------------

				// Create hierarchical structure
				function down(d, i) {
					if (!d.children || this.__transition__) return;
					var end = duration + d.children.length * delay;

					// Mark any currently-displayed bars as exiting.
					var exit = svg.selectAll(".enter")
						.attr("class", "exit");

					// Entering nodes immediately obscure the clicked-on bar, so hide it.
					exit.selectAll("rect").filter(function(p) {
							return p === d;
						})
						.style("fill-opacity", 1e-6);

					// Enter the new bars for the clicked-on data.
					// Per above, entering bars are immediately visible.
					var enter = bar(d)
						.attr("transform", stack(i))
						.style("opacity", 1);

					// Have the text fade-in, even though the bars are visible.
					// Color the bars as parents; they will fade to children if appropriate.
					enter.select("text").style("fill-opacity", 1e-6);
					enter.select("rect").style("fill", color(true));

					// Update the x-scale domain.
					x.domain([0, d3.max(d.children, function(d) {
						return d.value;
					})]).nice();

					// Update the x-axis.
					svg.selectAll(".d3-axis-horizontal").transition()
						.duration(duration)
						.call(xAxis);

					// Transition entering bars to their new position.
					var enterTransition = enter.transition()
						.duration(duration)
						.delay(function(d, i) {
							return i * delay;
						})
						.attr("transform", function(d, i) {
							return "translate(0," + barHeight * i * 1.2 + ")";
						});

					// Transition entering text.
					enterTransition.select("text")
						.style("fill-opacity", 1);

					// Transition entering rects to the new x-scale.
					enterTransition.select("rect")
						.attr("width", function(d) {
							return x(d.value);
						})
						.style("fill", function(d) {
							return color(!!d.children);
						});

					// Transition exiting bars to fade out.
					var exitTransition = exit.transition()
						.duration(duration)
						.style("opacity", 1e-6)
						.remove();

					// Transition exiting bars to the new x-scale.
					exitTransition.selectAll("rect")
						.attr("width", function(d) {
							return x(d.value);
						});

					// Rebind the current node to the background.
					svg.select(".d3-bars-background")
						.datum(d)
						.transition()
						.duration(end);

					d.index = i;
				}

				// Return to parent level
				function up(d) {
					if (!d.parent || this.__transition__) return;
					var end = duration + d.children.length * delay;

					// Mark any currently-displayed bars as exiting.
					var exit = svg.selectAll(".enter")
						.attr("class", "exit");

					// Enter the new bars for the clicked-on data's parent.
					var enter = bar(d.parent)
						.attr("transform", function(d, i) {
							return "translate(0," + barHeight * i * 1.2 + ")";
						})
						.style("opacity", 1e-6);

					// Color the bars as appropriate.
					// Exiting nodes will obscure the parent bar, so hide it.
					enter.select("rect")
						.style("fill", function(d) {
							return color(!!d.children);
						})
						.filter(function(p) {
							return p === d;
						})
						.style("fill-opacity", 1e-6);

					// Update the x-scale domain.
					x.domain([0, d3.max(d.parent.children, function(d) {
						return d.value;
					})]).nice();

					// Update the x-axis.
					svg.selectAll(".d3-axis-horizontal").transition()
						.duration(duration)
						.call(xAxis);

					// Transition entering bars to fade in over the full duration.
					var enterTransition = enter.transition()
						.duration(end)
						.style("opacity", 1);

					// Transition entering rects to the new x-scale.
					// When the entering parent rect is done, make it visible!
					enterTransition.select("rect")
						.attr("width", function(d) {
							return x(d.value);
						})
						.each("end", function(p) {
							if (p === d) d3.select(this).style("fill-opacity", null);
						});

					// Transition exiting bars to the parent's position.
					var exitTransition = exit.selectAll("g").transition()
						.duration(duration)
						.delay(function(d, i) {
							return i * delay;
						})
						.attr("transform", stack(d.index));

					// Transition exiting text to fade out.
					exitTransition.select("text")
						.style("fill-opacity", 1e-6);

					// Transition exiting rects to the new scale and fade to parent color.
					exitTransition.select("rect")
						.attr("width", function(d) {
							return x(d.value);
						})
						.style("fill", color(true));

					// Remove exiting nodes when the last child has finished transitioning.
					exit.transition()
						.duration(end)
						.remove();

					// Rebind the current parent to the background.
					svg.select(".d3-bars-background")
						.datum(d.parent)
						.transition()
						.duration(end);
				}

				// Creates a set of bars for the given data node, at the specified index.
				function bar(d) {
					var bar = svg.insert("g", ".d3-axis-vertical")
						.attr("class", "enter")
						.attr("transform", "translate(0,5)")
						.selectAll("g")
						.data(d.children)
						.enter()
						.append("g")
						.style("cursor", function(d) {
							return !d.children ? null : "pointer";
						})
						.on("click", down);

					bar.append("text")
						.attr("x", -6)
						.attr("y", barHeight / 2)
						.attr("dy", ".35em")
						.style("text-anchor", "end")
						.text(function(d) {
							return d.name;
						});

					bar.append("rect")
						.attr("width", function(d) {
							return x(d.value);
						})
						.attr("height", barHeight);

					return bar;
				}

				// A stateful closure for stacking bars horizontally.
				function stack(i) {
					var x0 = 0;
					return function(d) {
						var tx = "translate(" + x0 + "," + barHeight * i * 1.2 + ")";
						x0 += x(d.value);
						return tx;
					};
				}

				// Resize chart
				// ------------------------------

				// Call function on window resize
				$(window).on('resize', resize);

				// Call function on sidebar width change
				$('.sidebar-control').on('click', resize);

				// Resize function
				// 
				// Since D3 doesn't support SVG resize by default,
				// we need to manually specify parts of the graph that need to 
				// be updated on window resize
				function resize() {

					// Layout variables
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);

					// Axes
					// -------------------------

					// Horizontal range
					x.range([0, width]);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Bars
					svg.selectAll('.enter rect').attr("width", function(d) {
						return x(d.value);
					});
				}
			}
		};


		// Line chart
		var _GenderDiagnosaChart = function() {
			if (typeof google == "undefined") {
				console.warn("Warning - Google Charts library is not loaded.");
				return;
			}

			// Initialize chart
			google.charts.load("current", {
				callback: function() {
					// Draw chart
					drawLineChart();

					// Resize on sidebar width change
					$(document).on("click", ".sidebar-control", drawLineChart);

					// Resize on window resize
					var resizeLineBasic;
					$(window).on("resize", function(data) {
						clearTimeout(resizeLineBasic);
						resizeLineBasic = setTimeout(function() {
							drawLineChart();
						}, 0);
					});
				},
				packages: ["corechart"],
			});

			setTimeout(function() {
				$.getJSON("/getdashboarddata", function(data) {
					console.log('data retrived')
					drawLineChart(data);
				});
			}.bind(this), 200);

			// Chart settings
			function drawLineChart(dtgenderdiagnosa) {
				// Define charts element
				if (dtgenderdiagnosa == null) return;
				var line_chart_element = document.getElementById("genderdiagnosachart");
				var data = google.visualization.arrayToDataTable(dtgenderdiagnosa);

				// Options
				var options = {
					fontName: "Roboto",
					height: 400,
					width: 550,
					curveType: "function",
					fontSize: 12,
					chartArea: {
						left: "5%",
						width: 550,
						height: 350,
					},
					pointSize: 4,
					tooltip: {
						textStyle: {
							fontName: "Roboto",
							fontSize: 14,
						},
					},
					hAxis: {
						title: 'Diagnosa',
					},
					vAxis: {
						title: "Jumlah",
						titleTextStyle: {
							fontSize: 12,
							italic: false,
						},
						gridlines: {
							color: "#e5e5e5",
							count: 10,
						},
						minValue: 0,
					},
					legend: {
						position: "top",
						alignment: "center",
						textStyle: {
							fontSize: 14,
						},
					},
				};

				// Draw chart
				var line_chart = new google.visualization.LineChart(line_chart_element);
				line_chart.draw(data, options);
			}
		};

		// Chart
		var _polamakanChart = function() {
			if (typeof d3 == 'undefined') {
				console.warn('Warning - d3.min.js is not loaded.');
				return;
			}

			// Main variables
			var element = document.getElementById('d3-bar-vertical'),
				height = 400;

			// Initialize chart only if element exsists in the DOM
			if (element) {

				var d3Container = d3.select(element),
					margin = {
						top: 5,
						right: 10,
						bottom: 20,
						left: 40
					},
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
					height = height - margin.top - margin.bottom - 5;

				var x = d3.scale.ordinal()
					.rangeRoundBands([0, width], .1, .5);

				// Vertical
				var y = d3.scale.linear()
					.range([height, 0]);

				// Color
				var color = d3.scale.category20c();

				// Horizontal
				var xAxis = d3.svg.axis()
					.scale(x)
					.orient("bottom");

				// Vertical
				var yAxis = d3.svg.axis()
					.scale(y)
					.orient("left")
					.ticks(10, "%");

				// Add SVG element
				var container = d3Container.append("svg");

				// Add SVG group
				var svg = container
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


				d3.tsv("assets/js/data/d3/bars/bars_basic.tsv", function(error, data) {

					// Pull out values
					data.forEach(function(d) {
						d.frequency = +d.frequency;
					});


					// Set input domains
					// ------------------------------

					// Horizontal
					x.domain(data.map(function(d) {
						return d.letter;
					}));

					// Vertical
					y.domain([0, d3.max(data, function(d) {
						return d.frequency;
					})]);


					//
					// Append chart elements
					//

					// Append axes
					// ------------------------------

					// Horizontal
					svg.append("g")
						.attr("class", "d3-axis d3-axis-horizontal d3-axis-strong")
						.attr("transform", "translate(0," + height + ")")
						.call(xAxis);

					// Vertical
					var verticalAxis = svg.append("g")
						.attr("class", "d3-axis d3-axis-vertical d3-axis-strong")
						.call(yAxis);

					// Add text label
					verticalAxis.append("text")
						.attr("transform", "rotate(-90)")
						.attr("y", 10)
						.attr("dy", ".71em")
						.style("text-anchor", "end")
						.style("fill", "#999")
						.style("font-size", 12)
						.text("Frequency");


					// Add bars
					svg.selectAll(".d3-bar")
						.data(data)
						.enter()
						.append("rect")
						.attr("class", "d3-bar")
						.attr("x", function(d) {
							return x(d.letter);
						})
						.attr("width", x.rangeBand())
						.attr("y", function(d) {
							return y(d.frequency);
						})
						.attr("height", function(d) {
							return height - y(d.frequency);
						})
						.style("fill", function(d) {
							return color(d.letter);
						});
				});



				// Resize chart
				// ------------------------------

				// Call function on window resize
				$(window).on('resize', resize);

				// Call function on sidebar width change
				$('.sidebar-control').on('click', resize);


				setTimeout(function(){
					resize2();
				}.bind(this),1000);

				// Resize function
				// 
				// Since D3 doesn't support SVG resize by default,
				// we need to manually specify parts of the graph that need to 
				// be updated on window resize
				function resize() {
					// Layout variables
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);


					// Axes
					// -------------------------

					// Horizontal range
					x.rangeRoundBands([0, width], .1, .5);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Line path
					svg.selectAll('.d3-bar').attr("x", function(d) {
						return x(d.letter);
					}).attr("width", x.rangeBand());
				}


				function resize2() {
					// Layout variables
					width = 520;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);


					// Axes
					// -------------------------

					// Horizontal range
					x.rangeRoundBands([0, width], .1, .5);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Line path
					svg.selectAll('.d3-bar').attr("x", function(d) {
						return x(d.letter);
					}).attr("width", x.rangeBand());
				}

			}

		};






		// Chart
		var _keberagamanChart = function() {
			if (typeof d3 == 'undefined') {
				console.warn('Warning - d3.min.js is not loaded.');
				return;
			}

	
			// Main variables
			var element = document.getElementById('d3-bar-vertical2'),
				height = 400;

			// Initialize chart only if element exsists in the DOM
			if (element) {

				var d3Container = d3.select(element),
					margin = {
						top: 5,
						right: 10,
						bottom: 20,
						left: 40
					},
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
					height = height - margin.top - margin.bottom - 5;

				var x = d3.scale.ordinal()
					.rangeRoundBands([0, width], .1, .5);

				// Vertical
				var y = d3.scale.linear()
					.range([height, 0]);

				// Color
				var color = d3.scale.category20c();

				// Horizontal
				var xAxis = d3.svg.axis()
					.scale(x)
					.orient("bottom");

				// Vertical
				var yAxis = d3.svg.axis()
					.scale(y)
					.orient("left")
					.ticks(10, "%");

				// Add SVG element
				var container = d3Container.append("svg");

				// Add SVG group
				var svg = container
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


				d3.tsv("assets/js/data/d3/bars/bars_basic.tsv", function(error, data) {

					// Pull out values
					data.forEach(function(d) {
						d.frequency = +d.frequency;
					});


					// Set input domains
					// ------------------------------

					// Horizontal
					x.domain(data.map(function(d) {
						return d.letter;
					}));

					// Vertical
					y.domain([0, d3.max(data, function(d) {
						return d.frequency;
					})]);


					//
					// Append chart elements
					//

					// Append axes
					// ------------------------------

					// Horizontal
					svg.append("g")
						.attr("class", "d3-axis d3-axis-horizontal d3-axis-strong")
						.attr("transform", "translate(0," + height + ")")
						.call(xAxis);

					// Vertical
					var verticalAxis = svg.append("g")
						.attr("class", "d3-axis d3-axis-vertical d3-axis-strong")
						.call(yAxis);

					// Add text label
					verticalAxis.append("text")
						.attr("transform", "rotate(-90)")
						.attr("y", 10)
						.attr("dy", ".71em")
						.style("text-anchor", "end")
						.style("fill", "#999")
						.style("font-size", 12)
						.text("Frequency");


					// Add bars
					svg.selectAll(".d3-bar")
						.data(data)
						.enter()
						.append("rect")
						.attr("class", "d3-bar")
						.attr("x", function(d) {
							return x(d.letter);
						})
						.attr("width", x.rangeBand())
						.attr("y", function(d) {
							return y(d.frequency);
						})
						.attr("height", function(d) {
							return height - y(d.frequency);
						})
						.style("fill", function(d) {
							return color(d.letter);
						});
				});



				// Resize chart
				// ------------------------------

				// Call function on window resize
				$(window).on('resize', resize);

				// Call function on sidebar width change
				$('.sidebar-control').on('click', resize);


				setTimeout(function(){
					resize2();
				}.bind(this),1000);

				// Resize function
				// 
				// Since D3 doesn't support SVG resize by default,
				// we need to manually specify parts of the graph that need to 
				// be updated on window resize
				function resize() {
					// Layout variables
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);


					// Axes
					// -------------------------

					// Horizontal range
					x.rangeRoundBands([0, width], .1, .5);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Line path
					svg.selectAll('.d3-bar').attr("x", function(d) {
						return x(d.letter);
					}).attr("width", x.rangeBand());
				}


				function resize2() {
					// Layout variables
					width = 520;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);


					// Axes
					// -------------------------

					// Horizontal range
					x.rangeRoundBands([0, width], .1, .5);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Line path
					svg.selectAll('.d3-bar').attr("x", function(d) {
						return x(d.letter);
					}).attr("width", x.rangeBand());
				}

			}


		};



		// Chart
		var _polapikirChart = function() {
			if (typeof d3 == 'undefined') {
				console.warn('Warning - d3.min.js is not loaded.');
				return;
			}

	
			// Main variables
			var element = document.getElementById('d3-bar-vertical3'),
				height = 400;

			// Initialize chart only if element exsists in the DOM
			if (element) {

				var d3Container = d3.select(element),
					margin = {
						top: 5,
						right: 10,
						bottom: 20,
						left: 40
					},
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
					height = height - margin.top - margin.bottom - 5;

				var x = d3.scale.ordinal()
					.rangeRoundBands([0, width], .1, .5);

				// Vertical
				var y = d3.scale.linear()
					.range([height, 0]);

				// Color
				var color = d3.scale.category20c();

				// Horizontal
				var xAxis = d3.svg.axis()
					.scale(x)
					.orient("bottom");

				// Vertical
				var yAxis = d3.svg.axis()
					.scale(y)
					.orient("left")
					.ticks(10, "%");

				// Add SVG element
				var container = d3Container.append("svg");

				// Add SVG group
				var svg = container
					.attr("width", width + margin.left + margin.right)
					.attr("height", height + margin.top + margin.bottom)
					.append("g")
					.attr("transform", "translate(" + margin.left + "," + margin.top + ")");


				d3.tsv("assets/js/data/d3/bars/bars_basic.tsv", function(error, data) {

					// Pull out values
					data.forEach(function(d) {
						d.frequency = +d.frequency;
					});


					// Set input domains
					// ------------------------------

					// Horizontal
					x.domain(data.map(function(d) {
						return d.letter;
					}));

					// Vertical
					y.domain([0, d3.max(data, function(d) {
						return d.frequency;
					})]);


					//
					// Append chart elements
					//

					// Append axes
					// ------------------------------

					// Horizontal
					svg.append("g")
						.attr("class", "d3-axis d3-axis-horizontal d3-axis-strong")
						.attr("transform", "translate(0," + height + ")")
						.call(xAxis);

					// Vertical
					var verticalAxis = svg.append("g")
						.attr("class", "d3-axis d3-axis-vertical d3-axis-strong")
						.call(yAxis);

					// Add text label
					verticalAxis.append("text")
						.attr("transform", "rotate(-90)")
						.attr("y", 10)
						.attr("dy", ".71em")
						.style("text-anchor", "end")
						.style("fill", "#999")
						.style("font-size", 12)
						.text("Frequency");


					// Add bars
					svg.selectAll(".d3-bar")
						.data(data)
						.enter()
						.append("rect")
						.attr("class", "d3-bar")
						.attr("x", function(d) {
							return x(d.letter);
						})
						.attr("width", x.rangeBand())
						.attr("y", function(d) {
							return y(d.frequency);
						})
						.attr("height", function(d) {
							return height - y(d.frequency);
						})
						.style("fill", function(d) {
							return color(d.letter);
						});
				});



				// Resize chart
				// ------------------------------

				// Call function on window resize
				$(window).on('resize', resize);

				// Call function on sidebar width change
				$('.sidebar-control').on('click', resize);


				setTimeout(function(){
					resize2();
				}.bind(this),1000);

				// Resize function
				// 
				// Since D3 doesn't support SVG resize by default,
				// we need to manually specify parts of the graph that need to 
				// be updated on window resize
				function resize() {
					// Layout variables
					width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);


					// Axes
					// -------------------------

					// Horizontal range
					x.rangeRoundBands([0, width], .1, .5);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Line path
					svg.selectAll('.d3-bar').attr("x", function(d) {
						return x(d.letter);
					}).attr("width", x.rangeBand());
				}


				function resize2() {
					// Layout variables
					width = 520;


					// Layout
					// -------------------------

					// Main svg width
					container.attr("width", width + margin.left + margin.right);

					// Width of appended group
					svg.attr("width", width + margin.left + margin.right);


					// Axes
					// -------------------------

					// Horizontal range
					x.rangeRoundBands([0, width], .1, .5);

					// Horizontal axis
					svg.selectAll('.d3-axis-horizontal').call(xAxis);


					// Chart elements
					// -------------------------

					// Line path
					svg.selectAll('.d3-bar').attr("x", function(d) {
						return x(d.letter);
					}).attr("width", x.rangeBand());
				}

			}


		};


		var dtgender = JSON.parse(document.getElementById('datagender').value);
		var jumlaki = 0;
		var jumPerempuan = 0;
		for (var i = 0; i < dtgender.length; i++) {
			if (dtgender[i].nomor == '1') {
				jumlaki = dtgender[i].jumlah;
			} else if (dtgender[i].nomor == '2') {
				jumPerempuan = dtgender[i].jumlah;
			}
		}

		document.getElementById('jumModalWoman').innerHTML = jumPerempuan.toLocaleString();
		document.getElementById('jumModalMan').innerHTML = jumlaki.toLocaleString();

		var persenLaki = jumlaki / (jumlaki + jumPerempuan);
		var persenPerempuan = jumPerempuan / (jumlaki + jumPerempuan);

		$('#popup-gender').on('click', function(params) {

			$('#genderModal').modal('show');
		});

		$('#polamakan').on('click', function(params) {
			$('#polamakanModal').modal('show');
		});
		$('#keberagamanhidup').on('click', function(params) {
			$('#keberagamanhidupModal').modal('show');
		});
		$('#polapikir').on('click', function(params) {
			$('#polapikirModal').modal('show');
		});


		// obat

		// Pie and donut charts
		var _Chart_obat = function() {
				if (typeof echarts == 'undefined') {
						console.warn('Warning - echarts.min.js is not loaded.');
						return;
				}

				// Define elements
				var pie_obat_element = document.getElementById('pie_obat');
				var penjualanobat_element = document.getElementById('penjualanobat');
				var jenis_obat_element = document.getElementById('jenis_obat');
				var stok_obat_element = document.getElementById('stok_obat');


				// Donut multiples
				if (pie_obat_element) {

						// Initialize chart
						var pie_obat = echarts.init(pie_obat_element);

						//
						// Chart config
						//

						// Top text label
						var labelTop = {
								show: true,
								position: 'center',
								formatter: '{b}\n',
								fontSize: 15,
								lineHeight: 50,
								rich: {
										a: {}
								}
						};

						// Background item style
						var backStyle = {
								color: '#eee',
								emphasis: {
										color: '#eee'
								}
						};

						// Bottom text label
						var labelBottom = {
								color: '#333',
								show: true,
								position: 'center',
								formatter: function (params) {
										return '\n\n' + (100 - params.value) + '%'
								},
								fontWeight: 500,
								lineHeight: 35,
								rich: {
										a: {}
								},
								emphasis: {
										color: '#333'
								}
						};

						// Set inner and outer radius
						var radius = [52, 65];

						// Options
						pie_obat.setOption({

								// Colors
								color: [
										'#2ec7c9','#b6a2de','#5ab1ef','#ffb980','#d87a80',
										'#8d98b3','#e5cf0d','#97b552','#95706d','#dc69aa',
										'#07a2a4','#9a7fd1','#588dd5','#f5994e','#c05050',
										'#59678c','#c9ab00','#7eb00a','#6f5553','#c14089'
								],

								// Global text styles
								textStyle: {
										// fontFamily: 'Roboto, Arial, Verdana, sans-serif',
										fontSize: 12
								},

								// Add title
								title: {
										text: 'Grafik Donut Obat',
										subtext: 'Obat Dengan Pengeluaran Terbanyak',
										left: 'center',
										textStyle: {
												fontSize: 17,
												fontWeight: 500
										},
										subtextStyle: {
												fontSize: 12
										}
								},

								// Add legend
								legend: {
										bottom: 0,
										left: 'center',
										data: ['37', '56', '34', 'B', 'C', 'D', 'E', 'F', 'G', 'H'],
										itemHeight: 8,
										itemWidth: 8,
										selectedMode: false
								},

								// Add series
								series: [
										{
												type: 'pie',
												center: ['10%', '33%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 46, label: labelBottom, itemStyle: backStyle},
														{name: 'A087', value: 54, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['30%', '33%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 56, label: labelBottom, itemStyle: backStyle},
														{name: 'A997', value: 44, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['50%', '33%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 65, label: labelBottom, itemStyle: backStyle},
														{name: 'A900', value: 35, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['70%', '33%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 70, label: labelBottom, itemStyle: backStyle},
														{name: 'A003', value: 30, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['90%', '33%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 73, label: labelBottom, itemStyle: backStyle},
														{name: 'A089', value: 27, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['10%', '73%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 78, label: labelBottom, itemStyle: backStyle},
														{name: 'A886', value: 22, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['30%', '73%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 78, label: labelBottom, itemStyle: backStyle},
														{name: 'A990', value: 22, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['50%', '73%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 78, label: labelBottom, itemStyle: backStyle},
														{name: 'A660', value: 22, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['70%', '73%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 83, label: labelBottom, itemStyle: backStyle},
														{name: 'A444', value: 17, label: labelTop}
												]
										},
										{
												type: 'pie',
												center: ['90%', '73%'],
												radius: radius,
												hoverAnimation: true,
												data: [
														{name: 'other', value: 88, label: labelBottom, itemStyle: backStyle},
														{name: 'A987', value: 12, label: labelTop}
												]
										}
								]
						});
				}

				if(penjualanobat_element) {

					// Generate chart
					var penjualan = c3.generate({
							bindto: penjualanobat_element,
							size: { height: 400 },
							data: {
									columns: [
											['Penjualan', 30, 1200, 100, 400, 150, 250, 2330, 100, 250, 300]
									]
							},
							color: {
									pattern: ['#03A9F4']
							},
							axis: {
									x: {
											type: 'category',
											categories: ['A098', 'G056', 'A056', 'S056', 'A058', 'C098', 'B067', 'A023', 'H089', 'I089']
									}
							},
							grid: {
									x: {
											show: true
									}
							}
					});

					// Resize chart on sidebar width change
					$('.sidebar-control').on('click', function() {
							penjualan.resize();
					});
				}

				if(jenis_obat_element) {
					// Generate chart
					var obat = c3.generate({
							bindto: jenis_obat_element,
							size: { height: 400 },
							data: {
									columns: [
											['Generik', 30, 20, 50, 40, 60, 50, 34, 45, 45, 78, 566, 67],
											['Paten', 200, 130, 90, 240, 130, 220, 34, 465, 45, 68, 56, 67],
											['Narkotika', 300, 200, 160, 400, 250, 250, 34, 465, 45, 78, 230, 77]
									],
									type: 'bar',
									colors: {
										Generik: '#2ec7c9',
										Paten: '#5ab1ef',
										Narkotika: '#d87a80'
									}
							},
							axis: {
									x: {
											type: 'category',
											categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
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
							obat.resize();
					});
				}

				// Thermometer
				if (stok_obat_element) {

					// Initialize chart
					var stok_obat = echarts.init(stok_obat_element);
					// Options
					var stok_obat_options = {

							// Global text styles
							textStyle: {
									// fontFamily: 'Roboto, Arial, Verdana, sans-serif',
									fontSize: 13
							},

							// Chart animation duration
							animationDuration: 750,

							// Setup grid
							grid: {
									left: 10,
									right: 10,
									top: 35,
									bottom: 0,
									containLabel: true
							},

							// Add legend
							legend: {
									data: ['Actual', 'Forecast'],
									itemHeight: 8,
									itemGap: 20,
									selectedMode: false
							},

							// Add tooltip
							tooltip: {
									trigger: 'axis',
									backgroundColor: 'rgba(0,0,0,0.75)',
									padding: [10, 15],
									textStyle: {
											fontSize: 13,
											fontFamily: 'Roboto, sans-serif'
									},
									axisPointer: {
											type: 'shadow',
											shadowStyle: {
													color: 'rgba(0,0,0,0.025)'
											}
									},
									formatter: function(params) {
									return 'Kode : ' + params[0].name + '<br/>' +
										'Obat : Nama Obat <br/>' +
										'Stok Obat: ' + (params[0].value);
								}
							},

							// Horizontal axis
							xAxis: [{
									type: 'category',
									data: ['A001', 'A006', 'A986', 'A970', 'B780', 'A560', 'B090', 'BMHP001', 'A889', 'A005', 'C998', 'B876'],
									axisLabel: {
											color: '#333'
									},
									axisLine: {
											lineStyle: {
													color: '#999'
											}
									},
									splitLine: {
											show: true,
											lineStyle: {
													color: '#eee',
													type: 'dashed'
											}
									}
							}],

							// Vertical axis
							yAxis: [{
									type: 'value',
									boundaryGap: [0, 0.1],
									axisLabel: {
											color: '#333'
									},
									axisLine: {
											lineStyle: {
													color: '#999'
											}
									},
									splitLine: {
											lineStyle: {
													color: '#eee'
											}
									},
									splitArea: {
											show: true,
											areaStyle: {
													color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.015)']
											}
									}
							}],

							// Add series
							series: [
									{
											name: '',
											type: 'bar',
											stack: 'sum',
											itemStyle: {
													normal: {
															color: '#f5f5f5',
															barBorderColor: '#d87a80',
															barBorderWidth: 2,
															label: {
																	show: true, 
																	position: 'top',
																	formatter: function (params) {
																			return params.value;
																	},
																	textStyle: {
																			color: '#d87a80'
																	}
															}
													}
											},
											data: [40, 80, 50, 80,80, 70, 60, 90, 300, 23, 129, 56, 56]
									}
							]
					};

					// Set options
					stok_obat.setOption(stok_obat_options);
				}


				// Resize function
				var triggerChartResize = function() {
						pie_obat_element && pie_obat.resize();
						stok_obat_element && stok_obat.resize();

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
						}, 200);
				};
		};

		// end obat


		return {
			initCharts: function() {
				// Diagnosa Chart
				_Chart();
				_Chart_obat();
				_UmurDiagnosa();
				_GenderDiagnosaChart();

				_polamakanChart();
				_keberagamanChart();
				_polapikirChart();

				_polamakanChart();


				// Bar charts
				_GenderChart('#perempuan', 38, 1.5, '#F06292', persenLaki.toFixed(2), 'icon-woman text-pink-400', 'Total ' + jumlaki.toLocaleString() + ' Perempuan', 'Statisik Pasien Perempuan');
				_GenderChart('#laki', 38, 1.5, '#5C6BC0', persenPerempuan.toFixed(2), 'icon-man text-indigo-400', 'Total ' + jumPerempuan.toLocaleString() + ' Laki - Laki', 'Statisik Pasien Laki - Laki');
				_GenderBarChart('#perempuan-bars', 30, 40, true, 'elastic', 1200, 50, '#EC407A', '');
				_GenderBarChart('#laki-bars', 30, 40, true, 'elastic', 1200, 50, '#5C6BC0', '');
				_GenderBarChart('#p-polamakan', 40, 40, true, 'elastic', 1200, 50, 'rgba(255,255,255,0.5)', '');
				_GenderBarChart('#p-keberagamanhidup', 40, 40, true, 'elastic', 1200, 50, 'rgba(255,255,255,0.5)', '');
				_GenderBarChart('#p-polapikir', 40, 40, true, 'elastic', 1200, 50, 'rgba(255,255,255,0.5)', '');
			},
		};

	})();

	document.addEventListener("DOMContentLoaded", function() {
		Dashboard.initCharts();
	});
</script>
<!-- /main charts -->
<x-templete_bottom />