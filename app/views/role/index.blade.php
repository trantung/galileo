@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý nhóm quyền' }}
@stop
@section('content')
	<div class="row margin-bottom">
	    <div class="col-xs-12">
	    	{{-- {{ renderUrl('PermissionController@index', 'Quản lý phân quyền', [], ['class' => 'btn btn-primary']) }} --}}
	    	{{-- {{ renderUrl('RoleController@create', 'Thêm nhóm quyền mới', [], ['class' => 'btn btn-primary']) }} --}}
	    </div>
	</div>
	<div class="box box-primary">
		<div class="box-body">
			<table class ="table table-bordered table-striped table-hover sticky-table">
				<thead>
					<tr>
						<th>Tên nhóm quyền</th>
						<th>Action</th>
					</tr>
				</thead>
				@foreach ($data as $role)
					<tr>
						<td>{{ $role->name }}</td>
						<td>
							{{-- {{ renderUrl('RoleController@edit', 'sửa', [$role->id], ['class' => 'btn btn-primary']) }} --}}
							{{ renderUrl('PermissionController@editRole', 'phân quyền', [$role->slug], ['class' => 'btn btn-primary']) }}
							{{-- {{ renderUrl('RoleController@destroy', 'xóa', [$role->id], ['class' => 'btn btn-danger']) }} --}}
						</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@stop