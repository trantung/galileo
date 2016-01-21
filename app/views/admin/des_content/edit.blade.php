@extends('admin.layout.default')

@section('title')
{{ $title='Cập nhật giới thiệu trang chủ' }}
@stop

@section('content')
<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('DesContentController@update', $viDes->id), 'method' => 'PUT', 'files' => true)) }}
			<div class="box-body">
				<div class="form-group">
					<label for="title">Tiêu đề Tiếng Việt</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('title', $viDes->title , textParentCategory('Tiêu đề vietnamese')) }}
						</div>
					</div>
					<label for="title">Tiêu đề English</label>
					<div class="row">
						<div class="col-sm-6">
						   {{ Form::text('en_title', $enDes->title , textParentCategory('Tiêu đề english')) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="description">Nội dung Việt</label>
					<div class="row">
						<div class="col-sm-12">	 
						   	{{ Form::textarea('description', $viDes->description  , array('class' => 'form-control',"rows"=>6, 'id' => 'editor1'  )) }}
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="description">Nội dung English</label>
					<div class="row">
						<div class="col-sm-12">	 
						   	{{ Form::textarea('en_description', $enDes->description  , array('class' => 'form-control',"rows"=>6, 'id' => 'editor2'  )) }}
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
