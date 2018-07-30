@extends('layouts.admin')
@section('konten')

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
						User
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
								<div class="m-form__group m-form__group--inline">
									<div class="m-form__label">
										<label>
											Status:
										</label>
									</div>
									<div class="m-form__control">
										<select class="form-control m-bootstrap-select" id="m_form_status">
											<option value="">
												All
											</option>
											<option value="1">
												Aktiv
											</option>
											<option value="2">
												Non
											</option>
											<option value="3">
												Canceled
											</option>
										</select>
									</div>
								</div>
								<div class="d-md-none m--margin-bottom-10"></div>
							</div>
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
						<a href="{{route('member.create')}}" class="btn btn-primary m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
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
			<table class="m-datatable" id="table_penjualan" width="100%">
				<thead>
					<tr>
						<th>NO</th>
						<th>Nama</th>
						<th>Email</th>
						<th title="Field #4">Stat</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@php $no=1; @endphp
					@foreach($data as $key)
					<tr>
						<td>{{$no++}}</td>
						<td>{{$key->name}}</td>
						<td>{{$key->email}}</td>
						@if($key->is_verified == 1)
						<td><span class="m-badge  m-badge--success m-badge--wide">Aktiv</span>
						</td>
						@else
						<td><span class="m-badge  m-badge--danger m-badge--wide">Pending</span></td>
						@endif
						<td>
							<form action="{{ route('member.destroy', $key->id) }}" method="post">
								{{ csrf_field() }}
								{{ method_field('DELETE') }}
								<a class="btn m-btn m-btn--gradient-from-primary m-btn--gradient-to-accent" href="{{route('member.edit',$key->id)}}">Edit</a>
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

@endsection