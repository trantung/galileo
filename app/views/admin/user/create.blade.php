@extends('admin.layout.default')

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('title')
Tạo mới thành viên
@stop

@section('content')
{{ Form::open(['action' => ['ManagerUserController@store'], 'class' => 'col-sm-6 user-create-form user-form']) }}
    <div class="form-group">
        {{ Form::label('username', 'Tên đăng nhập') }}
        {{ Form::text('username', '', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'password') }}
        {{ Form::password('password', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('name', 'Fullname') }}
        {{ Form::text('full_name', '', ['class' => 'form-control', 'required' =>'', 'autocomplete' => 'off']) }}
    </div>
    <div class="form-group">
        {{ Form::label('role_id', 'Phân quyền') }}
        {{ Form::select('role_id', ['' => '-- Chọn --'] + Common::getRoleUser(), '', ['class' => 'form-control select-role-for-user', 'required' =>'']) }}
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">Thông tin thành viên</h3>
        </div>
        <div class="panel-body">
            @foreach (Common::getAllCenter() as $centerId => $center)
                <?php $listData = Common::getClassSubjectLevelOfCenter($centerId); ?>
                <div class="form-group checkbox">
                    <label for="center-{{ $centerId }}">
                        {{ Form::checkbox('center_id', $centerId, false, ['id' => 'center-'.$centerId] ) . $center }}
                    </label>

                    <div class="get-list-level-by-center-wrap">
                        @include('ajax.get_level_by_center', $listData+['centerId' => $centerId])
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group">
        {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
    </div>
{{ Form::close() }}
<div class="clear clearfix"></div>
@stop