@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý about' }}
@stop

@section('content')

<!-- inclue Search form

-->
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('AdminAboutUsController@create') }}" class="btn btn-primary">Thêm</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Tên Vietnamese</th>
			  <th>Tên English</th>
			  <th style="width:200px;">Action</th>
			</tr>
			@foreach($data as $value)
				<tr>
				  <td>{{ returnObjectLanguage($value, 'vi', 'AboutUs')->id }}</td>
				  <td>{{ returnObjectLanguage($value, 'vi', 'AboutUs')->title }}</td>
				  <td>{{ returnObjectLanguage($value, 'en', 'AboutUs')->title }}</td>
				  <td>
					<a href="{{ action('AdminAboutUsController@edit', returnObjectLanguage($value, 'vi', 'AboutUs')->id) }}" class="btn btn-primary">Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('AdminAboutUsController@destroy', returnObjectLanguage($value, 'vi', 'AboutUs')->id), 'style' => 'display: inline-block;')) }}
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

