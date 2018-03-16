@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý admin' }}
@stop
@section('content')

	<a href="{{ action('AdminController@create') }}" class="btn btn-primary">Thêm người dùng mới</a>
	<table class ="table table-bordered table-striped table-hover">
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
			<th>Phân quyền</th>
			<th>Edit</th>
			<th>Reset password</th>
			<th>Delete</th>
		</tr>
		@foreach($data as $key => $admin)
		<tr>
			<td>{{ $admin->username }}</td>
			<td>{{ $admin->email }}</td>
			<td>{{ $admin->role_id }}</td>
			<td>
	           <a href="{{ action('AdminController@edit', $admin->id) }}" class="btn btn-primary">Phân quyền</a>
			</td>
			<td>
	           <a href="{{ action('AdminController@edit', $admin->id) }}" class="btn btn-primary">Edit</a>
			</td>
			</td>
			<td><a href=" {{ action('AdminController@getResetPass', $admin->id) }} " class="btn btn-warning">Reset password</a></td>
			<td>
			   {{ Form::open(array('method'=>'DELETE', 'action' => array('AdminController@destroy', $admin->id), 'style' => 'display: inline-block;')) }}
	           <button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Delete</button>
	           {{ Form::close() }}
			
		</tr>
		@endforeach
	</table>
@stop