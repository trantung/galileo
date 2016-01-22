@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý introduce' }}
@stop
@section('content')
<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('AdminIntroduceController@create') }}" class="btn btn-primary">Thêm mới introduce</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
	  <div class="box">
		<div class="box-header">
		  <h3 class="box-title">Danh sách introduce</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body table-responsive no-padding">
		  <table class="table table-hover">
			<tr>
			  <th>ID</th>
			  <th>Tiêu đề Vietnamese</th>
			  <th>Tiêu đề English</th>
			  <th>Css</th>
			  <th style="width:200px;">Action</th>
			</tr>
			 @foreach($introduces as $value)
			<tr>
			  <td>{{ returnObjectLanguage($value, 'vi', 'Introduce')->id }}</td>
			  <td>{{ returnObjectLanguage($value, 'vi', 'Introduce')->title }}</td>
			  <td>{{ returnObjectLanguage($value, 'en', 'Introduce')->title }}</td>
			  <td>{{ returnObjectLanguage($value, 'vi', 'Introduce')->css }}</td>
			  <td>
				<a href="{{  action('AdminIntroduceController@edit', returnObjectLanguage($value, 'vi', 'Introduce')->id) }}" class="btn btn-primary">Sửa</a>
				{{ Form::open(array('method'=>'DELETE', 'action' => array('AdminIntroduceController@destroy', returnObjectLanguage($value, 'vi', 'Introduce')->id), 'style' => 'display: inline-block;')) }}
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

