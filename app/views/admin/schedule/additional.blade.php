
<legend> Phiếu bổ sung </legend>
@if($value = Common::checkCreateOrUpdateDocAdd($lessonId, $studentId))
    {{ Form::open(array('action' => array('ScheduleController@postUpdateAdditional', $lessonId, $studentId), 'files' => true)) }}
@else
    {{ Form::open(array('action' => array('ScheduleController@postAdditional', $lessonId, $studentId), 'files' => true)) }}
@endif
<div class="well well-sm">
    <fieldset>
        <div class="form-group">
            <label for="password">Câu hỏi bổ sung số 1</label>
            @if($docP1 = Common::getDocAdd($lessonId, $studentId, P, 0))
                <a target="_blank" href="{{ $docP1->file_url }}">{{ $docP1->code }}</a><br>
            @endif 
            {{ Form::file('doc_new_file_p[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label for="password">Đáp án bổ sung số 1</label>
            @if($docD1 = Common::getDocAdd($lessonId, $studentId, D, 0))
                <a target="_blank" href="{{ $docD1->file_url }}">{{ $docD1->code }}</a><br>
            @endif
            {{ Form::file('doc_new_file_d[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <hr/>
    <fieldset>
        <div class="form-group">
            <label for="password">Câu hỏi bổ sung số 2</label>
            @if($docP2 = Common::getDocAdd($lessonId, $studentId, P, 1))
                <a target="_blank" href="{{ $docP2->file_url }}">{{ $docP2->code }}</a><br>
            @endif 
            {{ Form::file('doc_new_file_p[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <fieldset>
        <div class="form-group">
            <label for="password">Đáp án bổ sung số 2</label>
            @if($docD2 = Common::getDocAdd($lessonId, $studentId, D, 1))
                <a target="_blank" href="{{ $docD2->file_url }}">{{ $docD2->code }}</a><br>
            @endif 
            {{ Form::file('doc_new_file_d[]', null, array('class' => 'form-control')) }}
        </div>
    </fieldset>
    <div class="box-footer">
        <input type="submit" class="btn btn-primary" value="Lưu lại" />
    </div>
</div>
{{ Form::close() }}