@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý tên quyền group' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('PermissionGroupController@create') }}" class="btn btn-primary">Thêm mới tên quyền group</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách tên quyền group</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Name</th>
			  <th>Code</th>
			  <th style="width:300px;">Action</th>
			</tr>
			 @foreach($groups as $group)
			<tr>
			  <td>{{ $group->id }}</td>
			  <td>{{ $group->name }}</td>
			  <td>{{ $group->code }}</td>
			  <td>
				<a href=" {{ action('PermissionGroupController@edit', $group->id) }} " class="btn btn-primary">Sửa</a>
				{{ Form::open(array('method'=>'DELETE', 'action' => array('PermissionGroupController@destroy', $group->id), 'style' => 'display: inline-block;')) }}
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
