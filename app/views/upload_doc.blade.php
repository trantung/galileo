{{ Form::open(array('action' => array('AdminController@postUpload'), 'files' => true)) }}
<div class="form-group">
    <label for="email">Lớp</label>
    <div class="row">
        <div class="col-sm-6">
           {{ Form::text('class', '', array('class' => 'form-control')) }}
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email">Môn</label>
    <div class="row">
        <div class="col-sm-6">
           {{ Form::text('subject', '', array('class' => 'form-control')) }}
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email">Chương trình học(level)</label>
    <div class="row">
        <div class="col-sm-6">
           {{ Form::text('level_code', '', array('class' => 'form-control')) }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    {{ Form::file('files[]', array('multiple'=>true)) }}
</div>
{{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
{{ Form::close() }}