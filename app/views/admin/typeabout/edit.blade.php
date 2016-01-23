@extends('admin.layout.default')

@section('title')
{{ $title='Sửa' }}
@stop

@section('content')

@include('admin.typeabout.common')

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
						   {{ Form::text('name', Common::objectLanguage('TypeAboutUs', $id, 'vi')->name, textParentCategory('Tên Vietnamese')) }}
						</div>
					</div>
					<label for="name_shadow">Tên mờ Vietnamese</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('name_shadow', Common::objectLanguage('TypeAboutUs', $id, 'vi')->name_shadow , textParentCategory('Tên mờ Vietnamese')) }}
						</div>
					</div>
					<label for="name">Tên English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_name', Common::objectLanguage('TypeAboutUs', $id, 'en')->name, textParentCategory('Tên English')) }}
						</div>
					</div>
					<label for="en_name_shadow">Tên mờ English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_name_shadow', Common::objectLanguage('TypeAboutUs', $id, 'en')->name_shadow , textParentCategory('Tên mờ English')) }}
						</div>
					</div>
					<label for="name">Vị trí sắp xếp</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('position', Common::getValueLanguage('TypeAboutUs', $id, 'position'), textParentCategory('Vị trí sắp xếp(số nguyên dương)')) }}
						</div>
					</div>
					<label for="name">Kiểu hiển thị</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::select('status', [ 1 => 'Kiểu 1', 2 => 'Kiểu 2'], Common::getValueLanguage('TypeAboutUs', $id, 'status'), array('class' => 'form-control')) }}
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
