
@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý trung tâm' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('ManagerCenterController@create') }}" class="btn btn-primary">Thêm mới trung tâm</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách trung tâm</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Tên trung tâm</th>
			  <th>Mã trung tâm</th>
			  <th>Đối tác</th>
			  <th>Phone</th>
			  <th>Địa chỉ</th>
			  <th style="width:300px;">Action</th>
			</tr>
			 @foreach($centers as $center)
			<tr>
			  <td>{{ $center->id }}</td>
			  <td>{{ $center->name }}</td>
			  <td>{{ $center->code }}</td>
			  <td>{{ Common::getObject($center->partner, 'name', 'Chưa có') }}</td>
			  <td>{{ $center->phone }}</td>
			  <td>{{ $center->address }}</td>
			  <td>
				<a href=" {{ action('ManagerCenterController@edit', $center->id) }} " class="btn btn-primary">Sửa</a>
				{{ Form::open(array('method'=>'DELETE', 'action' => array('ManagerCenterController@destroy', $center->id), 'style' => 'display: inline-block;')) }}
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
