@extends('admin.layout.default')

@section('css_header')
@parent
{{--  --}}
@stop

@section('title')
Tạo mới lớp học
@stop

@section('content')
    {{ Form::open(['action' => ['UserController@store'], 'method' => 'POST', 'class' => 'col-sm-6']) }}
        <div class="form-group">
            {{ Form::label('username', 'Tên đăng nhập') }}
            {{ Form::text('username', '', ['class' => 'form-control', 'required' =>'']) }}
        </div>
         <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', '', ['class' => 'form-control', 'required' =>'']) }}
        </div>
         <div class="form-group">
            {{ Form::label('name', 'Tên thành viên') }}
            {{ Form::text('name', '', ['class' => 'form-control', 'required' =>'']) }}
        </div>
        <div class="form-group">
            {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
    <div class="clear clearfix"></div>
@stop