{{ Form::open(array('action' => array('AdminController@postUpload'), 'files' => true)) }}

<div class="form-group">
	<label for="name">Image</label>
	<p>Kích thước: Banner: 1350x500 / đối tác: 250x130 / Dung lượng < 1Mb</p>
	<div class="row">
		<div class="col-sm-6">
			{{ Form::file('url') }}
		</div>
	</div>
</div>

<div class="box-footer">
{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
</div>
{{Form::close()}}