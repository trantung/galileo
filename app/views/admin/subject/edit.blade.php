@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('js_header')
@parent
{{--  --}}
@stop

@section('title')
Chỉnh sửa môn học
@stop

@section('content')
    {{ Form::open(['action' => ['SubjectController@update', $data->id], 'method' => 'PUT', 'class' => 'col-sm-6']) }}
        <div class="form-group">
            {{ Form::label('name', 'Tên môn học') }}
            {{ Form::text('name', $data->name, ['class' => 'form-control', 'required' =>'']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
@stop