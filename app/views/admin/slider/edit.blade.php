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
					<label for="name">Type</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::select('type', [SLIDE_TOP => 'Banner', SLIDE_BOTTOM => 'Đối tác'], $slide->type, array('class' => 'form-control')) }}
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
					<div class="row">
						<div class="col-sm-6">
							<label for="name">Upload ảnh</label>
							<p>Kích thước: Banner: 1350x500 / đối tác: 250x130 / Dung lượng < 1Mb</p>
							{{ Form::file('image_url') }}
							<img src="{{ url(UPLOADIMG . UPLOAD_SLIDE . '/' . $slide->id . '/' . $slide->image_url) }}" width="200px" height="auto"  />
						</div>
					</div>
					<div>
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
