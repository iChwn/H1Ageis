@extends('layouts.admin')
@section('konten')

<div class="m-content">
	<div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
		<div class="m-alert__icon">
			<i class="flaticon-exclamation m--font-brand"></i>
		</div>
		<div class="m-alert__text">
			Silahkan Tambah data yang akurat dan tepat
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
			<form class="m-form m-form--fit m-form--label-align-right" action="{{route('penjualan.store')}}" method="post">
			{{ csrf_field('POST') }}
				<div class="m-portlet__body">
					<div class="form-group m-form__group">
						<label for="penjualan">
							Penjualan
						</label>
						<input type="number" class="form-control m-input"  aria-describedby="emailHelp" name="penjualan" placeholder="Transaksi">
						<span class="m-form__help">
							{!! $errors->first('penjualan','<p class="help-block">:message</p>') !!}
						</span>
					</div>
					<div class="form-group m-form__group">
						<label for="tanggal">
							Tanggal
						</label>
						<div class="col-lg-4 col-md-9 col-sm-12">
							<div class="input-group date">
								<input data-format="yyyy-MM-dd" name="tanggal" type="text" class="form-control m-input" readonly  placeholder="Pilih Tanggal" id="m_datepicker_2"/>
								<div class="input-group-append">
									<span class="input-group-text">
										<i class="la la-calendar-check-o"></i>
									</span>
								</div>
							</div>
						</div>
						<span class="m-form__help">
							{!! $errors->first('tanggal','<p class="help-block">:message</p>') !!}
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
		</div>
	</div>
</div>

@endsection