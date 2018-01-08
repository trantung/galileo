@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Tạo mới lớp học
@stop

@section('content')

    {{ Form::open(['action' => ['ClassController@store'], 'method' => 'POST', 'class' => 'col-sm-6']) }}
        <div class="form-group">
            {{ Form::label('name', 'Tên lớp học') }}
            {{ Form::text('name', '', ['class' => 'form-control', 'required' =>'']) }}

        </div>
        <div class="form-group">
            {{ Form::label('subject', 'Chọn các môn học') }}
            @if( count($subjects) )
                @include('ajax.select_subject_level', ['subjects' => $subjects])
            @else
                <a href="{{ action('SubjectController@create') }}">Tạo mới môn học</a>
            @endif
        </div>
        <div class="form-group">
            {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
    <div class="clear clearfix"></div>
@stop