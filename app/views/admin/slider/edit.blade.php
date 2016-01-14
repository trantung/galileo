@extends('admin.layout.default')

@section('title')
{{ $title='Sửa slide' }}
@stop

@section('content')

<div class="row margin-bottom">
	<div class="col-xs-12">
		<a href="{{ action('AdminSlideController@index') }} " class="btn btn-success">Danh sách slide</a>
	</div>
</div>

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('AdminSlideController@update', $slide->id), 'method' => 'PUT', 'files' => true)) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Name</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::text('name', $slide->name , textParentCategory('Name')) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Description</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::text('description', $slide->description , textParentCategory('Mô tả')) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Type</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::select('type', [1 => 'Banner', 2 => 'Đối tác']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Link</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::text('link', $slide->link , textParentCategory('Đường dẫn')) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Chọn list ảnh mới, xoá hết ảnh cũ</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::file('image_url[]', array('id' => 'image_url', 'multiple' => true)) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					@foreach($slide->images as $key => $image)
						<label for="name">Image thứ {{$key + 1}}</label>
						<div class="row">
							<div class="col-sm-6">
								<label for="name">Đổi ảnh</label>
								{{ Form::file('image[' .$image->id. ']', array('id' => 'image_url')) }}
								<img src="{{ url(UPLOAD_IMAGE_SLIDE . '/image'. '/' . $slide->id . '/' . $image->image_url) }}" ,width="100px", height="100px"  />
		                    	<a href="javascript:;" onclick="deleteImageRelate()" data-id="{{ $image->id }}" class="image_relate btn btn-danger">Xoá</a>
							</div>
						</div>
						<div>
	                @endforeach
				</div>

			  <div class="box-footer">
				{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
			  </div>
			{{ Form::close() }}
		  </div>
		  <!-- /.box -->
	</div>
</div>
@include('admin.slider.script')
@stop
