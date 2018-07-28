<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<link rel="stylesheet" type="text/css" href="{{asset('css/datatables.bootstrap.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<table class="table" id="table_penjualan">
		<thead>
			<tr>
				<th>NO</th>
				<th>Transaksi</th>
				<th>Bulan</th>
				<th>Action</th>
				<th>test</th>
			</tr>
		</thead>
	</table>
	<script type="text/javascript" src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dataTables.bootstrap.min.js')}}"></script>
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
				{data: 'transaksi', name: 'transaksi'},
				{data: 'bulan', name: 'bulan'},
				{data: 'action', name: 'action'},
				{data: 'test', name: 'test'},
				],
			});
		});
	</script>
</body>
</html>