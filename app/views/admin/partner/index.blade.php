@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý đối tác' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('ManagerPartnerController@create') }}" class="btn btn-primary">Thêm mới đối tác</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách đối tác</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Username</th>
			  <th>Email</th>
			  <th>Phone</th>
			  <th style="width:300px;">Action</th>
			</tr>
			 @foreach($partners as $partner)
			<tr>
			  <td>{{ $partner->id }}</td>
			  <td>{{ $partner->username }}</td>
			  <td>{{ $partner->email }}</td>
			  <td>{{ $partner->phone }}</td>
			  <td>
				<a href=" {{ action('ManagerPartnerController@edit', $partner->id) }} " class="btn btn-primary">Sửa</a>
				<a href=" {{ action('ManagerPartnerController@getResetPass', $partner->id) }} " class="btn btn-primary">Reset password</a>
				{{ Form::open(array('method'=>'DELETE', 'action' => array('ManagerPartnerController@destroy', $partner->id), 'style' => 'display: inline-block;')) }}
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
