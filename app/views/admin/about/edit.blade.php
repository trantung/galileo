@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới tin' }}
@stop

@section('content')

@include('admin.about.common')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('AdminTypeAboutController@update', $id), 'method' => 'PUT')) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Tên Vietnamese</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('name', Common::objectLanguage('AboutUs', $id, 'vi')->name, textParentCategory('Tên Vietnamese')) }}
						</div>
					</div>
					<label for="name">Tên English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_name', Common::objectLanguage('AboutUs', $id, 'en')->name, textParentCategory('Tên English')) }}
						</div>
					</div>
					<label for="name">Vị trí sắp xếp</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('position', Common::getValueLanguage('AboutUs', $id, 'position'), textParentCategory('Vị trí sắp xếp(số nguyên dương)')) }}
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
@stop
