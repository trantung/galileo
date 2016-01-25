@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới Slide' }}
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
			{{ Form::open(array('action' => array('AdminSlideController@store'), 'files' => true)) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Name</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::text('name', null , textParentCategory('Name')) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Type</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::select('type', [SLIDE_TOP => 'Banner', SLIDE_BOTTOM => 'Đối tác']) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Link</label>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::text('link', null , textParentCategory('Đường dẫn')) }}
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="name">Image</label>
					<p>Kích thước: Banner: 1350x500 / đối tác: 250x130 / Dung lượng < 1Mb</p>
					<div class="row">
						<div class="col-sm-6">
							{{ Form::file('image_url') }}
						</div>
					</div>
				</div>

			  <div class="box-footer">
				{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
			  </div>
			{{ Form::close() }}
		  </div>
		  <!-- /.box -->
	</div>
</div>
@stop
