@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý nhân viên trung tâm' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('ManagerUserController@create') }}" class="btn btn-primary">Thêm mới nhân viên trung tâm</a>
	</div>
</div>
<table class="table table-bordered table-responsive">
	<thead class="bg-primary">
		<tr>
			<th>ID</th>
			<th>Trung tâm</th>
			<th>Username</th>
			<th>Email</th>
			<th style="width:300px;">Action</th>
		</tr>
	</thead>
	@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ Common::getObject($user->center, 'name') }}</td>
		<td>{{ $user->username }}</td>
		<td>{{ $user->email }}</td>
		<td>
			<a href=" {{ action('ManagerUserController@edit', $user->id) }} " class="btn btn-primary">Sửa</a>
			<a href=" {{ action('ManagerUserController@getResetPass', $user->id) }} " class="btn btn-primary">Reset password</a>

			{{ Form::open(array('method'=>'DELETE', 'action' => array('ManagerUserController@destroy', $user->id), 'style' => 'display: inline-block;')) }}
			<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
			{{ Form::close() }}
		</td>
	</tr>
	@endforeach
</table>
<div class="col-xs-12 text-center">
	{{ $users->appends(Request::except('page'))->links() }}
</div>

@stop
