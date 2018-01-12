{{ Form::open(array('action' => array('AdminController@postUpload'), 'files' => true)) }}
	<div class="form-group">
		<p>Kích thước</p>
		<div class="row">
			<div class="col-sm-6">
				{{ Form::file('url') }}
			</div>
		</div>
	</div>
	{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}