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
						Edit User
					</h3>
				</div>
			</div>
		</div>
		<div class="m-portlet__body">
			@foreach($data1 as $data)
			<form class="m-form m-form--fit m-form--label-align-right" action="{{ route('member.update', $data->id) }}" method="post">
				{{ csrf_field() }}
				{{method_field('PUT')}}
				<div class="m-portlet__body">
					<div class="form-group m-form__group">
						<label for="name">
							Nama
						</label>
						<input type="text" class="form-control m-input" id="name" aria-describedby="name" name="name" placeholder="Nama Lengkap" value="{{$data->name}}">
						<span class="m-form__help">
							{!! $errors->first('name','<p class="help-block">:message</p>') !!}
						</span>
					</div>
					<div class="form-group m-form__group">
						<label for="email">
							Email
						</label>
						<input type="email" class="form-control m-input" id="email" aria-describedby="email" name="email" placeholder="Email" value="{{$data->email}}">
						<span class="m-form__help">
							{!! $errors->first('email','<p class="help-block">:message</p>') !!}
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