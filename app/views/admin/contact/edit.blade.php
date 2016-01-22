@extends('admin.layout.default')

@section('title')
{{ $title='Sửa Contact' }}
@stop

@section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box box-primary">
			<!-- form start -->
			{{ Form::open(array('action' => array('AdminContactController@update', $id), 'method' => 'PUT')) }}
			<div class="box-body">
				<div class="form-group">
					<label for="name">Description Vietnamese</label>
					<div class="row">
						<div class="col-sm-12">
						   {{ Form::textarea('description', Common::objectLanguage('Contact', $id, 'vi')->description , array('class' => 'form-control',"rows"=>6, 'id' => 'editor1')) }}
						</div>
					</div>
					<label for="name">Description English</label>
					<div class="row">
						<div class="col-sm-12">
						   {{ Form::textarea('en_description', Common::objectLanguage('Contact', $id, 'en')->description , array('class' => 'form-control',"rows"=>6, 'id' => 'editor2')) }}
						</div>
					</div>
					<label for="name">Lat</label>
					<div class="row">
						<div class="col-sm-6">
							<input class="form-control" id="latitude" value="{{ Common::objectLanguage('Contact', $id, 'vi')->lat }}" name="lat" required>

						</div>
					</div>
					<label for="name">Long</label>
					<div class="row">
						<div class="col-sm-6">
							<input class="form-control" id="longitude" value="{{ Common::objectLanguage('Contact', $id, 'vi')->long }}" name="long" required>

						</div>
					</div>
					<div class = "form-group">
	                    <div id="mapview" style="width:100%;height:500px"></div>
	                </div>
					<div class="form-group">
						<label for="name">Trạng thái</label>
						<div class="row">
							<div class="col-sm-6">
							   {{ Form::select('status', [ 2=> 'Hiển thị', 1=> 'Không hiển thị'], Common::getValueLanguage('Contact', $id, 'status'), array('class' => 'form-control')) }}
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
@include('googlemap_script')
@stop
