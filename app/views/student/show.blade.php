
@extends('admin.layout.default')
@section('title')
{{ $title='Quản lý học sinh' }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')

<div class="row margin-bottom">
  <div class="col-xs-12">
    <a href="{{ action('StudentController@index') }}" class="btn btn-success">Danh sách học sinh</a>
</div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
          <!-- form start -->
            {{ Form::open(array('action' => 'StudentController@store', 'class' => 'student-form')) }}
            <div class="box-body col-sm-6">

                <div class="form-group">
                    <label for="fullname">Họ và tên</label>
                    {{  Form::text('fullname', $student->fullname, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="code">Mã học sinh</label>
                    {{  Form::text('code', $student->code, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    {{  Form::text('email', $student->email, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    {{  Form::text('username', $student->username, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="phone">Số điện thoại</label>
                    {{  Form::text('phone', $student->phone, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="birthday">Ngày sinh</label>
                    <input type="date" class="form-control" id="birthday" disabled="" name="birthday" value="{{ $student->birthday }}">
                </div>

                <div class="form-group">
                    <label for="gender">Giới tính</label>
                    {{ Form::text('gender', Common::getNameGender($student->gender), ['class' => 'form-control', 'disabled' => 'disabled' ]) }}
                </div>

                <div class="form-group">
                    <label for="address">Địa chỉ</label>
                    {{  Form::text('address', $student->address, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="center_id">Trung tâm</label>
                    {{  Form::text('center_id', $student->center_id, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="date_study">Ngày nhập học</label>
                    <input type="date" class="form-control" id="date_study" disabled="" name="date_study" value="{{ $student->date_study }}">
                </div>

                <div class="form-group">
                    <label for="model_name">Người nhập thông tin</label>
                    {{  Form::text('model_name', $student->model_name, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="school">Trường học</label>
                    {{  Form::text('school', $student->school, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="link_fb">Link facebook</label>
                    {{  Form::text('link_fb', $student->link_fb, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="description">Mục tiêu</label>
                    {{  Form::text('description', $student->description, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="time_target">Thời gian để đạt mục tiêu</label>
                    {{  Form::text('time_target', $student->time_target, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="info_user">Thông tin người đón</label>
                    {{  Form::text('info_user', $student->info_user, array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                </div>

                <div class="form-group">
                    <label for="comment">Lưu ý về học sinh</label>
                    {{ Form::textarea('comment', $student->comment, ['class' => 'form-control', 'rows'=>3, 'disabled' => 'disabled' ]) }}
                </div>

                <div class="form-group well well-sm">
                    <fieldset>
                        <legend>Thông tin về mẹ</legend>
                        <div class="input-group inline-block">
                            <label for="mom_fullname">Họ tên mẹ</label>
                            {{  Form::text('mom_fullname', Common::getObject($parents['mom'], 'fullname'), array('class' => 'form-control', 'disabled' => 'disabled' )) }} 
                        </div>
                        <div class="input-group inline-block">
                            <label for="mom_phone">Số điện thoại</label>
                            {{  Form::text('mom_phone', Common::getObject($parents['mom'], 'phone'), array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                        </div>
                    </fieldset>
                </div>

                <div class="form-group well well-sm">
                    <fieldset>
                        <legend>Thông tin về bố</legend>
                        <div class="input-group inline-block">
                            <label for="dad_fullname">Họ tên bố</label>
                            {{  Form::text('dad_fullname', Common::getObject($parents['dad'], 'fullname'), array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                        </div>
                        <div class="input-group inline-block">
                            <label for="dad_phone">Số điện thoại</label>
                            {{  Form::text('dad_phone', Common::getObject($parents['dad'], 'phone'), array('class' => 'form-control', 'disabled' => 'disabled' )) }}
                        </div>
                    </fieldset>
                </div>

            </div>
<!-- /.box-body -->
        <div class="clearfix clear"></div>
        {{ Form::close() }}
        </div>
<!-- /.box -->
    </div>
</div>

@stop
