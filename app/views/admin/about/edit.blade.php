@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới about' }}
@stop

@section('content')

@include('admin.about.common')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('AdminAboutUsController@update', $id), 'method' => 'PUT', 'files' => true)) }}
				<div class="box-body">
					<div class="form-group">
						<label for="title">Tiêu đề Vietnamese</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('title', Common::objectLanguage('AboutUs', $id, 'vi')->title , textParentCategory('Tiêu đề VietNamese')) }}
							</div>
						</div>
						<label for="title">Tiêu đề English</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('en_title', Common::objectLanguage('AboutUs', $id, 'en')->title , textParentCategory('Tiêu đề English')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Thể loại tin</label>
						<div class="row">
							<div class="col-sm-6">
							   {{  Form::select('type_id', Common::getTypeList('TypeAboutUs'), Common::objectLanguage('AboutUs', $id, 'vi')->type_id, array('class' => 'form-control' )) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Thứ tự hiển thị</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('weight', Common::objectLanguage('AboutUs', $id, 'vi')->weight , textParentCategory('Thứ tự hiển thị')) }}
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="image_url">Upload ảnh tin</label>
						<p>Kích thước: 360x230 / Dung lượng < 1Mb</p>
						<div class="row">
							<div class="col-sm-6">
								@if(Admin::isSeo())
									{{ Form::file('image_url', array('disabled' => 'true' )) }}
									<img class="image_fb" src="{{ url(UPLOADIMG . UPLOAD_ABOUT .'/'. $id . '/' . Common::objectLanguage('AboutUs', $id, 'vi')->image_url) }}" />
								@else
									{{ Form::file('image_url') }}
									<img class="image_fb" src="{{ url(UPLOADIMG . UPLOAD_ABOUT .'/'. $id . '/' . Common::objectLanguage('AboutUs', $id, 'vi')->image_url) }}" />
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="description">Nội dung tin Vietnamese</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('description', Common::objectLanguage('AboutUs', $id, 'vi')->description , array('class' => 'form-control',"rows"=>6, 'id' => 'editor1')) }}
							</div>
						</div>
					</div>
					<div>
						<label for="description">Nội dung tin English</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('en_description', Common::objectLanguage('AboutUs', $id, 'en')->description , array('class' => 'form-control',"rows"=>6, 'id' => 'editor2')) }}
							</div>
						</div>
					</div>

					<!-- /.box-body -->

					<div class="box-footer">
					{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
					</div>
				</div>
			{{ Form::close() }}
		  </div>
		  <!-- /.box -->
	</div>
</div>
@include('admin.common.ckeditor')
@stop
