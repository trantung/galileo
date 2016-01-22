@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới bottomtext' }}
@stop

@section('content')

@include('admin.typenew.common')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('BottomTextController@store', 'files'=> true))) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Title</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('title', null , textParentCategory('Title')) }}
						</div>
					</div>
					<label for="name">Description</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('description', null , textParentCategory('Description')) }}
						</div>
					</div>
					<label for="name">Link</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('link', null , textParentCategory('Link')) }}
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
