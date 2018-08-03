@extends('layouts.admin')
@section('konten')
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Poppins');

	*{
		font-family: 'Poppins', sans-serif;
	}

	#chart {
		max-width: 760px;
		margin: 35px auto;
		opacity: 0.9;
	}

	#timeline-chart .apexcharts-toolbar {
		opacity: 1;
		transform: translate(0, -17px);
		border: 0;
	}
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/se/b-1.5.2/b-html5-1.5.2/datatables.min.css"/>

<div class="m-content">
	@if(Session::has('alert-success'))
	<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-brand alert-dismissible fade show" role="alert">
		<div class="m-alert__icon">
			<i class="flaticon-exclamation-1"></i>
			<span></span>
		</div>
		<div class="m-alert__text">
			<strong> {{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
		</div>
		<div class="m-alert__close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	@endif
	@if(Session::has('alert-danger'))
	<div class="m-alert m-alert--icon m-alert--icon-solid m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
		<div class="m-alert__icon">
			<i class="flaticon-exclamation-1"></i>
			<span></span>
		</div>
		<div class="m-alert__text">
			<strong> {{ \Illuminate\Support\Facades\Session::get('alert-danger') }}</strong>
		</div>
		<div class="m-alert__close">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	@endif
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Penjualan
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
				<div class="row align-items-center">
					<div class="col-xl-8 order-2 order-xl-1">
						<div class="form-group m-form__group row align-items-center">
							<div class="col-md-4">
							</div>
						</div>
					</div>
					<div class="col-xl-4 order-1 order-xl-2 m--align-right">
						<a href="{{route('penjualan.create')}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
							<span>
								<i class="flaticon-plus"></i>
								<span>
									Tambah Data
								</span>
							</span>
						</a>
						<div class="m-separator m-separator--dashed d-xl-none"></div>
					</div>
				</div>
			</div>
			<table class="table" id="table_penjualan">
				<thead>
					<tr>
						<th>NO</th>
						<th>Penjualan</th>
						<th>Tanggal</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
			</table>

			<div class="col-md-4">
				<label>
					Masukan Tahun dan Bulan
				</label><p>
				<select class="btn btn-success dropdown-toggle" name="tahun">
					<option>Tahun</option>
					<option value="2013">2013</option>
					<option value="2014">2014</option>
					<option value="2015">2015</option>
					<option value="2016">2016</option>
					<option value="2017">2017</option>
					<option value="2018">2018</option> 
				</select>
				<select class="btn btn-success dropdown-toggle" name="bulan">
					<option>Bulan</option>
					<option value="01">Januari</option>
					<option value="02">Februari</option>
					<option value="03">Maret</option>
					<option value="04">April</option>
					<option value="05">Mei</option>
					<option value="06">Juni</option>
					<option value="07">Juli</option>
					<option value="08">Augustus</option>
					<option value="09">September</option>
					<option value="10">Oktober</option>
					<option value="11">November</option> 
					<option value="12">Desember</option> 
				</select>
				<select class="btn btn-success dropdown-toggle" name="tipe">
					<option>Tipe</option>
					<option value="line">Line</option>
					<option value="bar">Bar</option>
				</select>
			</div>
			<div id="chart">
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript" src="{{asset('js/apexcharts.min.js')}}"></script>
<script type="text/javascript">
	$(function() {
		var oTable = $('#table_penjualan').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: '{{ url("admin/penjualanlist") }}'
			},
			columns: [
			{data: 'id', name: 'id'},
			{data: 'penjualan', name: 'penjualan'},
			{data: 'tanggal', name: 'tanggal'},
			{data: 'test', name: 'test'},
			{data: 'action', name: 'action'},
			],
		});
	});
</script>
<script type="text/javascript">
	$('[name=tahun]').change(function(){
		$('[name=bulan]').val('01').trigger('change');
		$('[name=tipe]').val('line').trigger('change');
		$.get('{{url('/admin/penjualandatatable')}}'+'/'+$(this).val()+'/01',function(data){
			return chartCtrl(data)
		})  
	})
	$('[name=bulan]').change(function(){
		var tahun = $('[name=tahun]').val();
		$.get('{{url('/admin/penjualandatatable')}}'+'/'+tahun+'/'+$(this).val(),function(data){
			return chartCtrl(data)
		})  
	})
	function getDaysInMonth(year,month){
		return new Date(year,month,0).getDate();
	}
	function chartCtrl(data){
		var tipe = $('[name=tipe]').val();
		var days       = getDaysInMonth(2018,01);
		var categories = [];
		for(var i = 1; i <= days; i++){
			categories.push(i);
		}

		var options = {
			chart: {
				type: tipe
			},
			series: [{
				name: 'sales',
				data: data
			}],
			xaxis: {
				categories: categories
			}
		}

		var chart = new ApexCharts(document.querySelector("#chart"), options);

		chart.render();    
	}
</script>
@endsection