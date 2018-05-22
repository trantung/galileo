@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý admin' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('AdminController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm quản trị mới</a>
	</div>
</div>
@include('administrator.filter')
<div class="box alert padding0">
	<table class ="table table-bordered table-striped table-hover margin0">
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Role</th>
			<th>Thao tác</th>
		</tr>
		@foreach($data as $key => $admin)
		<tr>
			<td>{{ $admin->username }}</td>
			<td>{{ $admin->email }}</td>
			<td>{{ Common::getRoleName($admin->role_id) }}</td>
			<td>
           		<a href="{{ action('AdminController@edit', $admin->id) }}" class="btn btn-info" title="Sửa"><i class="fa fa-edit"></i></a>
				<a href=" {{ action('AdminController@getResetPass', $admin->id) }}" title="Thay mật khẩu" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset password</a>
		   		{{ Form::open(array('method'=>'DELETE', 'action' => array('AdminController@destroy', $admin->id), 'class' => 'inline-block')) }}
           			<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class="fa fa-trash"></i></button>
           		{{ Form::close() }}
			</td>
		</tr>
		@endforeach
	</table>
</div>
@stop