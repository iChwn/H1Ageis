@extends('layouts.admin')
@section('konten')

<div class="m-content">
	<div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
		<div class="m-alert__icon">
			<i class="flaticon-exclamation m--font-brand"></i>
		</div>
		<div class="m-alert__text">
			Silahkan Tambah data yang akurat dan tepat :*
		</div>
	</div>
	<div class="m-portlet m-portlet--mobile">
		<div class="m-portlet__head">
			<div class="m-portlet__head-caption">
				<div class="m-portlet__head-title">
					<h3 class="m-portlet__head-text">
						Tambah Data Penjualan
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
		@foreach($data as $key)
			<form class="m-form m-form--fit m-form--label-align-right" action="{{URL('admin/chart/update',$key->id)}}">
				<div class="m-portlet__body">
					<div class="form-group m-form__group">
						<label for="transaksi">
							Transaksi
						</label>
						<input type="number" class="form-control m-input" id="transaksi" aria-describedby="emailHelp" name="transaksi" placeholder="Transaksi" value="{{$key->transaksi}}">
						<span class="m-form__help">
							{!! $errors->first('transaksi','<p class="help-block">:message</p>') !!}
						</span>
					</div>
					<div class="form-group m-form__group">
						<label for="bulan">
							Bulan
						</label>
						<select class="form-control m-input" name="bulan" id="bulan">
						<option> {{$key->bulan}}</option>
							<option></option>
							<option>January</option>
							<option>February</option>
							<option>March</option>
							<option>April</option>
							<option>May</option>
							<option>June</option>
							<option>July</option>
							<option>August</option>
							<option>September</option>
							<option>October</option>
							<option>November</option> 
							<option>December</option> 
						</select>
						<span class="m-form__help">
							{!! $errors->first('bulan','<p class="help-block">:message</p>') !!}
						</span>
					</div>
				</div>
				<div class="m-portlet__foot m-portlet__foot--fit">
					<div class="m-form__actions">
						<button type="submit" class="btn btn-primary">
							Submit
						</button>
						<button type="reset" class="btn btn-secondary">
							Cancel
						</button>
					</div>
				</div>
			</form>
		@endforeach
		</div>
	</div>
</div>


@endsection