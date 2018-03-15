
<legend> Phiếu bổ sung </legend>
{{ Form::open(array('action' => array('ScheduleController@postAdditional', $lessonId, $studentId), 'files' => true)) }}
<div class="well well-sm">
    <fieldset>
        <div class="form-group">
            <label for="password">Câu hỏi bổ sung số 1</label>
            {{ Form::file('doc_new_file_p[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label for="password">Đáp án bổ sung số 1</label>
            {{ Form::file('doc_new_file_d[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <hr/>
    <fieldset>
        <div class="form-group">
            <label for="password">Câu hỏi bổ sung số 2</label>
            {{ Form::file('doc_new_file_p[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label for="password">Đáp án bổ sung số 2</label>
            {{ Form::file('doc_new_file_d[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <div class="box-footer">
        <input type="submit" class="btn btn-primary" value="Lưu lại" />
    </div>
</div>
{{ Form::close() }}