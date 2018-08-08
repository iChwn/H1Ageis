<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>

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
		<option value="line">Line</option>
		<option value="bar">Bar</option>
	</select>
</div>
<div id="myfirstchart" style="height: 250px;"></div>

<script type="text/javascript">
	$('[name=tahun]').change(function(){
		$('[name=bulan]').val('01').trigger('change');
		$('[name=tipe]').val('line').trigger('change');
		$.get('{{url('/admin/penjualandatatable')}}'+'/'+$(this).val()+'/01',function(data){
			return chartCtrl(data)
		})  
	})

	function getDaysInMonth(year,month){
		return new Date(year,month,0).getDate();
	}
	function chartCtrl(data){
		var tipe 	   = $('[name=tipe]').val();
		var days       = getDaysInMonth(2018,01);
		var categories = [];
		for(var i = 1; i <= days; i++){
			categories.push(i);
		}
		new Morris.Line({
  // ID of the element in which to draw the chart.
  element: 'myfirstchart',
  // Chart data records -- each entry in this array corresponds to a point on
  // the chart.
  data: [
  { year: ''+categories+'', value: ''+data+''}
  ],
  // The name of the data record attribute that contains x-values.
  xkey: 'year',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['value'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Value']
});
	}
</script>