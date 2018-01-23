@extends('admin.layout.default')

@section('title')
{{ $title='Sửa học liệu | '. Common::getValueOfObject($document, 'classes', 'name'). ', '.Common::getValueOfObject($document, 'subjects', 'name'). ', '. Common::getValueOfObject($document, 'levels', 'name') . ', '. Common::getValueOfObject($document, 'lessons', 'name') }}
@stop

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            {{ Form::open(array('action' => array('DocumentController@update', $id), 'method' => 'PUT', 'files' => true)) }}
                    {{ Form::hidden('lesson_id', Common::getValueOfObject($document, 'lessons', 'id')) }}
                    {{ Form::hidden('class_id', Common::getValueOfObject($document, 'classes', 'id')) }}
                    {{ Form::hidden('subject_id', Common::getValueOfObject($document, 'subjects', 'id')) }}
                    {{ Form::hidden('level_id', Common::getValueOfObject($document, 'levels', 'id')) }}
                    <div class="col-sm-6 box-body">
                        <fieldset>
                            <legend>Phiếu câu hỏi: </legend>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                {{ Form::text('name_p', $group[$id]['P']->name, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Upload</label><br>
                                @if( !empty($group[$id]['P']->file_url) )
                                    {{ Form::hidden('doc_p_id', $group[$id]['P']->id) }}
                                    <a target="_blank" href="{{ asset($group[$id]['P']->file_url) }}">{{ $group[$id]['P']->code }}</a><br>
                                @endif
                                {{ Form::file('doc_file_p', ['class' => 'form-control']) }}
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-sm-6 box-body">
                        <fieldset>
                            <legend>Phiếu đáp án</legend>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                {{ Form::text('name_d', $group[$id]['D']->name, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group">
                                <label>Upload</label><br>
                                @if( !empty($group[$id]['D']->file_url) )
                                    {{ Form::hidden('doc_d_id', $group[$id]['D']->id) }}
                                    <a target="_blank" href="{{ asset($group[$id]['D']->file_url) }}">{{ $group[$id]['D']->code }}</a><br>
                                @endif
                                {{ Form::file('doc_file_d', ['class' => 'form-control']) }}
                            </div>
                        </fieldset>
                    </div>

                    <div class="clear clearfix"></div>
                    <div class="box-footer">
                        {{ Form::submit('Lưu lại', array('class' => 'btn btn-primary')) }}
                    </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@stop
