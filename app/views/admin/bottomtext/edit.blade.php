@extends('admin.layout.default')

@section('title')
{{ $title='Sửa bottomtext' }}
@stop

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('BottomTextController@update', $id), 'method' => 'PUT')) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Title Vietnamese</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('title', Common::objectLanguage('BottomText', $id, 'vi')->title, textParentCategory('Title Vietnamese')) }}
						</div>
					</div>
					<label for="name">Title English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_title', Common::objectLanguage('BottomText', $id, 'en')->title, textParentCategory('Title English')) }}
						</div>
					</div>
					<label for="name">Description Vietnamese</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('description', Common::objectLanguage('BottomText', $id, 'vi')->description, textParentCategory('Description Vietnamese')) }}
						</div>
					</div>
					<label for="name">Description English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_description', Common::objectLanguage('BottomText', $id, 'en')->description, textParentCategory('Description English')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="name">Trạng thái</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::select('status', [ 2=> 'Hiển thị', 1=> 'Không hiển thị'], Common::getValueLanguage('BottomText', $id, 'status'), array('class' => 'form-control')) }}
							</div>
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
