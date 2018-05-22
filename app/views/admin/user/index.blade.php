@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý nhân viên trung tâm' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('ManagerUserController@create') }}" class="btn btn-primary"><i class ="fa fa-plus"> Thêm mới nhân viên trung tâm</i></a>
	</div>
</div>
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
			  <th>Trung tâm</th>
			  <th>Username</th>
			  <th>Email</th>
			  <th>Phân quyền học liệu</th>
			  <th>Lịch cố vấn</th>
			  <th>Thao tác</th>
			  <th>Thay đổi mật khẩu</th>
			</tr>
			 @foreach($users as $user)
			<tr>
				<td>{{ $user->id }}</td>
				<td>{{ Common::getCenterByUser($user->id) }}</td>
				<td>{{ $user->username }}</td>
				<td>{{ $user->email }}</td>
				<td>
					<a href=" {{ action('ManagerUserController@getPermission', $user->id) }} " class="btn btn-primary fa fa-balance-scale"> Phân quyền học liệu</a>
				</td>
				<td>
					<a href="{{ action('ManagerUserController@getSetTime', [$user->id]) }}" class="btn btn-primary fa fa-calendar" ></a>
				</td>
				<td>
					<a href=" {{ action('ManagerUserController@edit', $user->id) }} " class="btn btn-primary fa fa-edit"> Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('ManagerUserController@destroy', $user->id), 'style' => 'display: inline-block;')) }}
					<button class="btn btn-danger fa fa-trash" onclick="return confirm('Bạn có chắc chắn muốn xóa?');"> Xóa</button>
				</td>
				<td>
					<a href=" {{ action('ManagerUserController@getResetPass', $user->id) }} " class="btn btn-primary fa fa-exchange"> Passsword</a>
				{{ Form::close() }}
				</td>
	</tr>
	@endforeach
</table>
<div class="col-xs-12 text-center">
	{{ $users->appends(Request::except('page'))->links() }}
</div>

@stop
