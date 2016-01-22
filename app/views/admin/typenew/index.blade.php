@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý loại tin' }}
@stop

@section('content')

<!-- inclue Search form 

-->
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('NewsTypeController@create') }}" class="btn btn-primary">Thêm loại tin</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách loại tin</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Tên Vietnamese</th>
			  <th>Tên English</th>
			  <th>Vị trí sắp xếp</th>
			  <th>Hiển thị trên content</th>
			  <th style="width:200px;">Action</th>
			</tr>
			@foreach($inputNewType as $value)
				<tr>
				  <td>{{ returnObjectLanguage($value, 'vi', 'TypeNew')->id }}</td>
				  <td>{{ returnObjectLanguage($value, 'vi', 'TypeNew')->name }}</td>
				  <td>{{ returnObjectLanguage($value, 'en', 'TypeNew')->name }}</td>
				  <td>{{ $value->position }}</td>
				  <td>{{ getNameStatus($value->status) }}</td>
				  <td>
					<a href="{{ action('NewsTypeController@edit', returnObjectLanguage($value, 'vi', 'TypeNew')->id) }}" class="btn btn-primary">Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('NewsTypeController@destroy', returnObjectLanguage($value, 'vi', 'TypeNew')->id), 'style' => 'display: inline-block;')) }}
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

