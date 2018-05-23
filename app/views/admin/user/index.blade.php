@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý nhân viên trung tâm' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('ManagerUserController@create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Thêm mới nhân viên trung tâm</a>
	</div>
</div>
@include('admin.user.filter')
<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách nhân viên trung tâm</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Username</th>
			  <th>Email</th>
			  <th>Trung tâm</th>
			  <th>Quyền</th>
			  <th>Thao tác</th>
			</tr>
			 @foreach($users as $user)
			<tr>
			  <td>#{{ $user->id }}</td>
			  <td>{{ $user->username }}</td>
			  <td>{{ $user->email }}</td>
			  <td>{{ Common::getCenterByUser($user->id) }}</td>
			  <td>{{ Common::getRoleName($user->role_id) }}</td>
			  <td>
					<a href=" {{ action('ManagerUserController@getPermission', $user->id) }} " class="btn btn-primary"><i class="fa fa-balance-scale"></i> Phân quyền học liệu</a>
				  	<a href="{{ action('ManagerUserController@getSetTime', [$user->id]) }}" class="btn btn-primary"><i class="fa fa-calendar"></i> Lịch dạy</a>
					<a href=" {{ action('ManagerUserController@edit', $user->id) }} " class="btn btn-info"><i class="fa fa-edit"></i></a>
					<a href=" {{ action('ManagerUserController@getResetPass', $user->id) }} " class="btn btn-warning"> <i class="fa fa-refresh"></i> Reset password</a>

					{{ Form::open(array('method'=>'DELETE', 'action' => array('ManagerUserController@destroy', $user->id), 'style' => 'display: inline-block;')) }}
					<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"><i class="fa fa-trash"></i></button>
				
				{{ Form::close() }}
			</td>
		</tr>
	@endforeach
</table>
<div class="col-xs-12 text-center">
	{{ $users->appends(Request::except('page'))->links() }}
</div>

@stop
