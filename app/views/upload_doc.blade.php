{{ Form::open(array('action' => array('AdminController@postUpload'), 'files' => true)) }}
<div class="col-sm-6">
	{{ Form::file('files[]', array('multiple'=>true)) }}
</div>
{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}