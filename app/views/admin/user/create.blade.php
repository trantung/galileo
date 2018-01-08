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
        {{ Form::text('username', '', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::text('email', '', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'password') }}
        {{ Form::password('password', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password_confirm', 'Nhập lại password') }}
        {{ Form::password('password_confirm', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('role_id', 'Phân quyền') }}
        {{ Form::select('role_id', ['' => '-- Chọn --'] + Common::getListRole(), '', ['class' => 'form-control', 'required' =>'']) }}
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thông tin thành viên</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('center_id', 'Trực thuộc trung tâm:') }}
                {{ Form::select('center_id', ['' => '-- Chọn --'] + Common::getListRole(), '', ['class' => 'form-control', 'required' =>'']) }}
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
    </div>
{{ Form::close() }}
<div class="clear clearfix"></div>
@stop