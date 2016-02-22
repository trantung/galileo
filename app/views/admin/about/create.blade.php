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
			{{ Form::open(array('action' => array('AdminAboutUsController@store'), 'files'=> true)) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Tên Vietnamese</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('title', null , textParentCategory('Tên Vietnamese')) }}
						</div>
					</div>
					<label for="name">Tên English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_title', null , textParentCategory('Tên English')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="name">Thể loại tin</label>
						<div class="row">
							<div class="col-sm-6">
							   {{  Form::select('type_id', Common::getTypeList('TypeAboutUs'), null, array('class' => 'form-control' )) }}
							</div>
						</div>
					</div>

					<div class="form-group">
						<label for="name">Vi trí</label>
						<div class="row">
							<div class="col-sm-6">
						   		{{ Form::text('weight', null , textParentCategory('Thứ tự hiển thị')) }}
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<label for="image_url">Upload ảnh tin</label>
						<p>Kích thước: 360x230 / Dung lượng < 1Mb</p>
						<div class="row">
							<div class="col-sm-6">
								{{ Form::file('image_url') }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="description">Nội dung tin Vietnamese</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('description', '' , array('class' => 'form-control',"rows"=>6, 'id' => 'editor1')) }}
							</div>
						</div>
					</div>
					<div>
						<label for="description">Nội dung tin English</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('en_description', '' , array('class' => 'form-control',"rows"=>6, 'id' => 'editor2')) }}
							</div>
						</div>
					</div>
				</div>
			  <!-- /.box-body -->

			  <div class="box-footer">
				{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
			  </div>
			{{ Form::close() }}
		  </div>
		  <!-- /.box -->
	</div>
</div>
@include('admin.common.ckeditor')
@stop
