@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý nhân viên trung tâm' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('UserController@create') }}" class="btn btn-primary">Thêm mới nhân viên trung tâm</a>
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
			  <th>Username</th>
			  <th>Email</th>
			  <th style="width:200px;">Action</th>
			</tr>
			 @foreach($users as $user)
			<tr>
			  <td>{{ $user->id }}</td>
			  <td>{{ $user->username }}</td>
			  <td>{{ $user->email }}</td>
			  <td>
				<a href=" " class="btn btn-primary">Sửa</a>
				{{ Form::open(array('method'=>'DELETE', 'action' => array('UserController@destroy', $user->id), 'style' => 'display: inline-block;')) }}
					<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
				{{ Form::close() }}
			  </td>
			</tr>
			@endforeach
		  </table>
		</div>
		<!-- /.box-body -->
	  </div>
	  <!-- /.box -->
	</div>
</div>

@stop
