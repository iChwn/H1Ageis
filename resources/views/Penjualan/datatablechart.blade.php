
<html>
<head>
  <title></title>
</head>
<body>
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
  <link rel="stylesheet" type="text/css" href="{{asset('css/datatables.bootstrap.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
  <table class="table" id="table_penjualan">
    <thead>
     <tr>
      <th>NO</th>
      <th>Penjualan</th>
      <th>Tanggal</th>
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
     url: '{{ url("admin/penjualanlist") }}'
   },
   columns: [
   {data: 'id', name: 'id'},
   {data: 'penjualan', name: 'penjualan'},
   {data: 'tanggal', name: 'tanggal'},
   {data: 'action', name: 'action'},
   {data: 'test', name: 'test'},
   ],
 });
 });
</script>
</body>
</html>


<div class="col-md-4">
 <label>
  Tahun
</label>
<select name="tahun">
  <option></option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2015">2015</option>
  <option value="2016">2016</option>
  <option value="2017">2017</option>
  <option value="2018">2018</option> 
</select>
<label>
  Bulan
</label>
<select name="bulan">
  <option></option>
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
</div>
<div id="chart">
</div>

<script type="text/javascript" src="{{asset('js/apexcharts.min.js')}}"></script>

<script type="text/javascript">
  $('[name=tahun]').change(function(){
    $('[name=bulan]').val('01').trigger('change');
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

    var days       = getDaysInMonth(2018,01);
    var categories = [];
    for(var i = 1; i <= days; i++){
      categories.push(i);
    }

    var options = {
      chart: {
        type: 'line'
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
