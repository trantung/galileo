@extends('admin.layout.default')

@section('title')
{{ $title='Sửa tin' }}
@stop

@section('content')

@include('admin.news.common')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('NewsController@update', $id), 'method' => 'PUT', 'files' => true)) }}
				<div class="box-body">
					<div class="form-group">
						<label for="title">Tiêu đề Vietnamese</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('name', Common::objectLanguage('AdminNew', $id, 'vi')->name , textParentCategory('Tiêu đề VietNamese')) }}
							</div>
						</div>
						<label for="title">Tiêu đề English</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('en_name', Common::objectLanguage('AdminNew', $id, 'en')->name , textParentCategory('Tiêu đề English')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Thể loại tin</label>
						<div class="row">
							<div class="col-sm-6">
							   {{  Form::select('type_new_id', Common::getTypeList('TypeNew'), AdminNew::find($id)->type_new_id, array('class' => 'form-control' )) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Trạng thái</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::select('status', [ 2=> 'Hiển thị', 1=> 'Không hiển thị'], Common::getValueLanguage('AdminNew', $id, 'status'), array('class' => 'form-control')) }}
							</div>
						</div>
					</div>
					<label for="name">Vị trí sắp xếp</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('position', Common::getValueLanguage('AdminNew', $id, 'position'), textParentCategory('Vị trí sắp xếp(số nguyên dương)')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="image_url">Upload ảnh tin</label>
						<p>Kích thước: 360x230 / Dung lượng < 1Mb</p>
						<div class="row">
							<div class="col-sm-6">
								@if(Admin::isSeo())
									{{ Form::file('image_url', array('disabled' => 'true' )) }}
									<img class="image_fb" src="{{ url(UPLOADIMG . '/news'.'/'. $id . '/' . Common::objectLanguage('AdminNew', $id, 'vi')->image_url) }}" />
								@else
									{{ Form::file('image_url') }}
									<img class="image_fb" src="{{ url(UPLOADIMG . '/news'.'/'. $id . '/' . Common::objectLanguage('AdminNew', $id, 'vi')->image_url) }}" />
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="description">Nội dung tin Vietnamese</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('description', Common::objectLanguage('AdminNew', $id, 'vi')->description , array('class' => 'form-control',"rows"=>6, 'id' => 'editor1')) }}
							</div>
						</div>
					</div>
					<div>
						<label for="description">Nội dung tin English</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('en_description', Common::objectLanguage('AdminNew', $id, 'en')->description , array('class' => 'form-control',"rows"=>6, 'id' => 'editor2')) }}
							</div>
						</div>
					</div>

					<!-- /.box-body -->

					<div class="box-footer">
					{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
					</div>
				</div>
			{{ Form::close() }}
		  	<!-- /.box -->
	  	</div>
	</div>
</div>
@include('admin.common.ckeditor')
@stop
