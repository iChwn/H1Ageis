@extends('layouts.app')
@section('content')
<a href="{{ route('admins.create')}}" class=" btn btn-sm btn-primary">Tambah Data</a>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Nama</th>
					<th>Email</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@php $no = 1; @endphp
				@foreach($data as $member)
				<tr>
					<td>{{ $no++ }}</td>
					<td>{{ $member->name }}</td>
					<td>{{ $member->email }}</td>
					@if($member->is_verified == 1)
					<td>Aktiv</td>
					@else
					<td>Non</td>
					@endif
					<td>
						<form action="{{ route('admins.destroy', $member->id) }}" method="post">
							{{ csrf_field() }}
							{{ method_field('DELETE') }}
							<a href="{{ route('admins.edit',$member->id) }}" class=" btn btn-sm btn-primary">Edit</a>
							<button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
@endsection