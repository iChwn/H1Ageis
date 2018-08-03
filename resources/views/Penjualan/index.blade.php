@extends('layouts.admin')
@section('konten')
<!DOCTYPE html>
<html>
 <body>


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
									<div class="m-input-icon m-input-icon--left">
										<input type="text" class="form-control m-input" placeholder="Search..." id="generalSearch">
										<span class="m-input-icon__icon m-input-icon__icon--left">
											<span>
												<i class="la la-search"></i>
											</span>
										</span>
									</div>
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
							<div class="m-separator m-separastor--dashed d-xl-none"></div>
						</div>
					</div>
				</div>
				<div id="chart_div"></div>
				<table class="m-datatable" id="table_penjualan" width="100%">
					<thead>
						<tr>
							<th>NO</th>
							<th>Tanggal</th>
							<th>Penjualan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						@php $no=1; @endphp
						@foreach($data as $key)
						<tr>
							<td>{{$no++}}</td>
							<td>{{$key->tanggal}}</td>
							<td>{{$key->penjualan}}</td>
							<td>
								<form action="{{ route('penjualan.destroy', $key->id) }}" method="post">
									{{ csrf_field() }}
									{{ method_field('DELETE') }}
									<a class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-accent" href="{{route('penjualan.edit',$key->id)}}">Edit</a>
									<button class="btn m-btn m-btn--gradient-from-danger m-btn--gradient-to-accent" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
								</form>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/gchart.js')}}"></script>
	<script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      $('[name=tahun]').change(function(){
		$('[name=bulan]').val('01').trigger('change');
		$('[name=tipe]').val('line').trigger('change');
		$.get('{{url('/admin/penjualandatatable/2018')}}'+(this).val()+'/01',function(data){
			return drawChart(data)
		})  
	})
	$('[name=bulan]').change(function(){
		var tahun = $('[name=tahun]').val();
		$.get('{{url('/admin/penjualandatatable')}}'+'/'+tahun+'/'+$(this).val(),function(data){
			return drawChart(data)
		})  
	})
      function getDaysInMonth(year,month){
      	return new Date(year,month,0).getDate();
      }

      function drawChart(data) {
      	var tipe = $('[name=tipe]').val();
		var days       = getDaysInMonth(2018,01);
		var categories = [];
		for(var i = 1; i <= days; i++){
			categories.push(i);
		}
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('string', 'Slices');
        data.addRows([
        	[categories, data]
        	]);

        // Set chart options
        var options = {'title':'How Much Pizza I Ate Last Night',
        'width':800,
        'height':600};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>

<script type="text/javascript">
	$(function() {
		var oTable = $('#table_penjualan').DataTable({
			processing: true,
			serverSide: true,
			ajax: {
				url: '{{ url("list") }}'
			},
			columns: [
			{data: 'id', name: 'id'},
			{data: 'tanggal', name: 'tanggal'},
			{data: 'penjualan', name: 'penjualan'},
			{data: 'action', name: 'action'},
			{data: 'test', name: 'test'},
			],
		});
	});
</script>
 </body>
</html>
@endsection
