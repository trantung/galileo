@extends('admin.layout.default')

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('title')
Chỉnh sửa thành viên
@stop

@section('content')
{{ Form::open(['action' => ['ManagerUserController@update', $data->id], 'method' => 'PUT', 'class' => 'col-sm-6 user-edit-form user-form']) }}
    <div class="form-group">
        {{ Form::label('username', 'Tên đăng nhập') }}
        {{ Form::text('username', Common::getObject($data, 'username'), ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', Common::getObject($data, 'email'), ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('role_id', 'Phân quyền') }}
        {{ Form::select('role_id', ['' => '-- Chọn --'] + Common::getRoleUser(), Common::getObject($data, 'role_id'), ['class' => 'form-control', 'required' =>'']) }}
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thông tin thành viên</h3>
        </div>
        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('center_id', 'Trực thuộc trung tâm:') }}
                {{ Form::select('center_id', ['' => '-- Chọn --'] + Common::getAllCenter(), Common::getObject($listDatata, 'center_id'), ['class' => 'form-control select-center', 'required' =>'']) }}
            </div>
            <div class="get-list-level-by-center-wrap">
            	@include('ajax.get_level_by_center', $listData+['levelData' => $levelData])
            </div>
        </div>
    </div>

    <div class="form-group">
        {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
    </div>
{{ Form::close() }}
<div class="clear clearfix"></div>
@stop