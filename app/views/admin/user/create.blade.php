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
<div class="row margin-bottom">
    <div class="col-xs-12">
        <a href="{{ action('ManagerUserController@index') }}" class="btn btn-primary"><i class="fa fa-list-ul"></i> Danh sách thành viên</a>
    </div>
</div>

<div class="box box-primary">
    <div class="box-body">
        {{ Form::open(['action' => ['ManagerUserController@store'], 'class' => 'user-create-form user-form']) }}
            <div class="col-sm-6">
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
                        <h3 class="panel-title">Trực thuộc trung tâm</h3>
                    </div>
                    <div class="panel-body row">
                        @foreach (Common::getAllCenter() as $centerId => $center)
                            <div class="form-group checkbox col-sm-6 margin0">
                                <label for="center-{{ $centerId }}">
                                    {{ Form::checkbox('center_id[]', $centerId, false, ['id' => 'center-'.$centerId] ) . $center }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Trình độ chuyên môn</h3>
                    </div>
                    <div class="panel-body">
                        <div class="get-list-level-by-center-wrap">
                            <?php $listData = Common::getClassSubjectLevel(); ?>
                            @include('ajax.get_level_list_by_subject_class', $listData)
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
                </div>
            </div>

            <div class="col-sm-6" style="margin-top: 25px">
                {{ Form::submit('Lưu', ['class'=>'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
</div>
<div class="clear clearfix"></div>
@stop