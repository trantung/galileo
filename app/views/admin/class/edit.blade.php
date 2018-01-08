@extends('admin.layout.default')

@section('title')
Chỉnh sửa lớp học
@stop

@section('content')
    {{ Form::open(['action' => ['ClassController@update', $data->id], 'method' => 'PUT', 'class' => 'col-sm-6']) }}
        <div class="form-group">
            {{ Form::label('name', 'Tên lớp học') }}
            {{ Form::text('name', $data->name, ['class' => 'form-control', 'required' =>'']) }}

        </div>
        <div class="form-group">
            {{ Form::label('subject', 'Chọn các môn học') }}
            @if( count($subjects) )
                @include('ajax.select_subject_level', ['subjects' => $subjects, 'data' => $data])
            @else
                <a href="{{ action('SubjectController@create') }}">Tạo mới môn học</a>
            @endif
        </div>
        <div class="form-group">
            {{ Form::submit('submit', ['class'=>'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
    <div class="clear clearfix"></div>
@stop