@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý slider' }}
@stop

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('AdminSlideController@create') }}" class="btn btn-primary">Thêm mới slide</a>
	</div>
</div>
<div class="box-body table-responsive no-padding">
  	<table class="table table-hover">
	<tr>
	  	<th>ID</th>
	  	<th>Tên</th>
	  	<th>Type</th>
	  	<th>Đường dẫn</th>
	  	<th>Ảnh</th>
	  	<th style="width:200px;">Action</th>
	</tr>
		@foreach($slides as $value)
			<tr>
			  	<td>{{ $value->id }}</td>
				<td>{{ $value->name }}</td>
				<td>{{ CommonUpload::getNameTypeSlide($value->type) }}</td>
				<td>{{ $value->link }}</td>
				<td style="width:200px;">
					<img src="{{ url(UPLOADIMG . UPLOAD_SLIDE . '/' . $value->id . '/' . $value->image_url) }}" width="100%" height="auto"  />
				</td>
				<td>
				<a href="{{  action('AdminSlideController@edit', $value->id) }}" class="btn btn-primary">Sửa</a>
					{{ Form::open(array('method'=>'DELETE', 'action' => array('AdminSlideController@destroy', $value->id), 'style' => 'display: inline-block;')) }}
						<button class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</button>
					{{ Form::close() }}
			  	</td>
			</tr>
		@endforeach
  	</table>
</div>
@stop
