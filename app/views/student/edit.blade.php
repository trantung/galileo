@extends('admin.layout.default')
@section('title')
{{ $title='thay đổi thông tin' }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }} 
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

@section('content')
    <div class="row margin-bottom bg-faded">
        <div class="col-xs-12">
            <a href="{{ action('StudentController@index') }}" class="btn btn-success">Danh sách học sinh</a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary ">
                <!-- form start -->
                 {{ Form::open(['action' =>['StudentController@update', $student->id], 'method' => "PUT" ,'class' => 'student-form']) }}
                <div class="box-body col-sm-6">
                    <div class="form-group well well-sm">
                        <fieldset>
                            <legend>Thông tin học sinh</legend>
                            <div class="form-group">
                                <label for="fullname">Họ và tên <span class="text-danger">(*)</span></label>
                                {{ Form::text('fullname', $student->fullname, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label for="code">Mã học sinh <span class="text-danger">(*)</span></label>
                                {{ Form::text('code', $student->code, array('class' => 'form-control' )) }}
                            </div>
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">(*)</span></label>
                                {{ Form::email('email', $student->email, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label for="username">Tên đăng nhập <span class="text-danger">(*)</span></label>
                                {{ Form::text('username', $student->username, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label for="password">Mật khẩu <span class="text-danger">(*)</span></label>
                                <input type="password" class="form-control" id="password" pattern="[0-9a-fA-F]{4,12}"  name="password">
                            </div>
                            <div class="form-group">
                                <label for="password">Xác nhận mật khẩu <span class="text-danger">(*)</span></label>
                                <input type="password" class="form-control" id="password" pattern="[0-9a-fA-F]{4,12}"  name="password_confirmation">
                            </div>
                            <div class="form-group">
                                <label for="center_id">Trung tâm <span class="text-danger">(*)</span></label>
                                {{ Form::select('center_id', ['' => '-- chọn --'] + $center, Common::getObject($student->centers, 'name'), array('class' => 'form-control' )) }}
                            </div>
                            <div class="form-group">
                                <label for="date_study">Ngày nhập học</label>
                                <input type="date" class="form-control" id="date_study" value="{{ $student->date_study }}" name="date_study">
                            </div>
                            <div class="form-group">
                                <label for="model_name">Nguồn</label>
                                {{ Form::text('model_name', $student->model_name, array('class' => 'form-control' )) }}
                            </div>
                            <div class="form-group inline-block">
                                <label for="birthday">Ngày sinh <span class="text-danger">(*)</span></label>
                                <input type="date" class="form-control" id="birthday" value="{{ $student->birthday }}" name="birthday">
                            </div>
                            <div class="form-group inline-block">
                                <label for="gender">Giới tính <span class="text-danger">(*)</span></label>
                                {{ Form::select('gender', ['' => '--chọn--', '0' => 'nữ', '1' => 'nam'], $student->gender, ['class' => 'form-control']) }}
                            </div>
                            <div class="form-group inline-block">
                                <label for="phone">Số điện thoại</label>
                                {{ Form::text('phone', $student->phone, array('class' => 'form-control')) }}
                            </div>
                              <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                {{ Form::text('address', $student->address, array('class' => 'form-control' )) }}
                            </div>
                            <div class="form-group">
                                <label for="school">Trường học</label>
                                {{ Form::text('school', $student->school, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label for="link_fb">Link facebook</label>
                                {{ Form::text('link_fb', $student->link_fb, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label for="description">Mục tiêu</label>
                                {{ Form::text('description', $student->description, array('class' => 'form-control' )) }}
                            </div>
                            <div class="form-group">
                                <label for="time_target">Thời gian để đạt mục tiêu</label>
                                {{ Form::text('time_target', $student->time_target, array('class' => 'form-control')) }}
                            </div>
                            <div class="form-group">
                                <label for="info_user">Thông tin người đón</label>
                                {{ Form::text('info_user', $student->info_user, array('class' => 'form-control' )) }}
                            </div>
                            <div class="form-group">
                                <label for="comment">Lưu ý về học sinh</label>
                                {{ Form::textarea('comment', $student->comment, ['class' => 'form-control' , 'rows'=>3]) }}
                            </div> 
                        </fieldset>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="clearfix clear">
                </div>
                <div class="box-footer">
                    <input type="submit" class="btn btn-primary" value="Lưu lại"/><input type="reset" class="btn btn-default" value="Nhập lại"/>
                </div>
                 {{ Form::close() }}
            </div>
            <!-- /.box -->
        </div>
    </div>
 @stop
