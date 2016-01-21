@extends('admin.layout.default')

@section('title')
{{ $title='Thêm mới introduce' }}
@stop

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('AdminIntroduceController@update', $introduce->model_id), 'method' => 'PUT')) }}
				<div class="box-body">
					<div class="form-group">
						<label for="title">Tiêu đề Vietnamese</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('title', Common::getValue($introduce->model_id, 'Introduce', 'title') , textParentCategory('Tiêu đề introduce')) }}
							</div>
						</div>
						<label for="title">Tiêu đề English</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::text('en_title', Common::getValue($introduce->relate_id, 'Introduce', 'title') , textParentCategory('Tiêu đề introduce english')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Thể loại css</label>
						<div class="row">
							<div class="col-sm-6">
							   {{  Form::select('css', returnCss(),Common::getValue($introduce->model_id, 'Introduce', 'css'),array('class' => 'form-control' )) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="name">Vị trí</label>
						<div class="row">
							<div class="col-sm-6">
							   {{  Form::select('position', returnPosition(),Common::getValue($introduce->model_id, 'Introduce', 'position'),array('class' => 'form-control' )) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="description">Nội dung Vietnamese</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('description', Common::getValue($introduce->model_id, 'Introduce', 'description'), array('class' => 'form-control',"rows"=>6, 'id' => 'editor1')) }}
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="description">Nội dung English</label>
						<div class="row">
							<div class="col-sm-12">
							   {{ Form::textarea('en_description', Common::getValue($introduce->relate_id, 'Introduce', 'description'), array('class' => 'form-control',"rows"=>6, 'id' => 'editor2')) }}
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
