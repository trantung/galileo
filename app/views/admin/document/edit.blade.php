@extends('admin.layout.default')

@section('title')
{{ $title='Sửa học liệu | '. Common::getValueOfObject($document, 'classes', 'name'). ', '.Common::getValueOfObject($document, 'subjects', 'name'). ', '. Common::getValueOfObject($document, 'levels', 'name') . ', '. Common::getValueOfObject($document, 'lessons', 'name') }}
@stop

@section('content')

<a href="{{ action('DocumentController@index') }}" class="btn btn-primary">Danh sách học liệu</a>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            {{ Form::open(array('action' => array('DocumentController@update', $id), 'method' => 'PUT', 'files' => true, 'class' => 'box-body')) }}
                    {{ Form::hidden('lesson_id', Common::getValueOfObject($document, 'lessons', 'id')) }}
                    {{ Form::hidden('class_id', Common::getValueOfObject($document, 'classes', 'id')) }}
                    {{ Form::hidden('subject_id', Common::getValueOfObject($document, 'subjects', 'id')) }}
                    {{ Form::hidden('level_id', Common::getValueOfObject($document, 'levels', 'id')) }}
                    <div class="row">
                        @foreach( $groups as $parentId => $group )
                            {{ Form::hidden('parent_id[]', $parentId) }}
                            <div class="col-sm-6">
                                <div class="well well-sm">
                                    <fieldset>
                                        <legend>Phiếu câu hỏi</legend>
                                        <div class="form-group">
                                            <label>Tiêu đề</label>
                                            {{ Form::text('name[p]['.$parentId.']['. ((Common::getObject($group['P'], 'id')) ? Common::getObject($group['P'], 'id') : 'new') .']', Common::getObject($group['P'], 'name'), ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Upload</label><br>
                                            @if( Common::getObject($group['P'], 'file_url') )
                                                <a target="_blank" href="{{ asset($group['P']->file_url) }}">{{ $group['P']->code }}</a><br>
                                            @endif
                                            {{ Form::file('doc_file[p]['.$parentId.']['. ((Common::getObject($group['P'], 'id')) ? Common::getObject($group['P'], 'id') : 'new') .']', ['class' => 'form-control']) }}
                                        </div>
                                    </fieldset>
                                    <fieldset>
                                        <legend>Phiếu đáp án</legend>
                                        <div class="form-group">
                                            <label>Tiêu đề</label>
                                            {{ Form::text('name[d]['.$parentId.']['. ((Common::getObject($group['D'], 'id')) ? Common::getObject($group['D'], 'id') : 'new') .']', Common::getObject($group['D'], 'name'), ['class' => 'form-control']) }}
                                        </div>
                                        <div class="form-group">
                                            <label>Upload</label><br>
                                            @if( Common::getObject($group['D'], 'file_url') )
                                                <a target="_blank" href="{{ asset($group['D']->file_url) }}">{{ $group['D']->code }}</a><br>
                                            @endif
                                            {{ Form::file('doc_file[d]['.$parentId.']['. ((Common::getObject($group['D'], 'id')) ? Common::getObject($group['D'], 'id') : 'new') .']', ['class' => 'form-control']) }}
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                        @endforeach
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
