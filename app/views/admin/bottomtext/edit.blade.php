@extends('admin.layout.default')

@section('title')
{{ $title='Sửa bottomtext' }}
@stop

@section('content')

@include('admin.bottomtext.common')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('BottomTextController@update', $id), 'method' => 'PUT')) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Title</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('title', Common::objectLanguage('BottomText', $id, 'vi')->title, textParentCategory('Title')) }}
						</div>
					</div>
					<label for="name">Description</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('description', Common::objectLanguage('BottomText', $id, 'en')->description, textParentCategory('Description')) }}
						</div>
					</div>
					<label for="name">Link</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('link', Common::objectLanguage('BottomText', $id, 'en')->link, textParentCategory('Link')) }}
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
