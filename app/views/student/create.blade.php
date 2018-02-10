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
        <div class="box box-primary"> <!-- form start -->
            {{ Form::open(array('action' => 'StudentController@store', 'class' => 'student-form')) }}
            <div class="box-body col-sm-6">
                <div class="form-group well well-sm">
                    <fieldset>
                        <legend>thông tin học sinh</legend>
                        <div class="form-group">
                            <label for="fullname">Họ và tên</label>
                            {{ Form::text('fullname', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Họ và tên' )) }}
                        </div>
                        <div class="form-group">
                            <label for="code">Mã học sinh</label>
                            {{ Form::text('code', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Mã học sinh' )) }}
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            {{ Form::email('email', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Email' )) }}
                        </div>
                        <div class="form-group">
                            <label for="username">Tên đăng nhập</label>
                            {{ Form::text('username', null, array('class' => 'form-control', 'required' => 'required', 'placeholder' => 'Tên đăng nhập' )) }}
                        </div>
                        <div class="form-group">
                            <label for="password">Mật khẩu</label>
                            <input type="password" class="form-control" required id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Mật khẩu" name="password">
                        </div>
                        <div class="form-group">
                            <label for="center_id">Trung tâm</label>
                            {{ Form::select('center_id', ['null' => '--chọn--'] +$center, null, array('class' => 'form-control', 'required' => 'required' )) }}
                        </div>
                        <div class="form-group">
                            <label for="date_study">Ngày nhập học</label>
                            <input type="date" class="form-control" id="date_study" placeholder="Ngày vào học" name="date_study">
                        </div>
                        <div class="form-group">
                            <label for="model_name">Nguồn</label>
                            {{ Form::text('model_name', null, array('class' => 'form-control', 'placeholder' => 'Người giới thiệu' )) }}
                        </div>
                        <div class="form-group inline-block">
                            <label for="birthday">Ngày sinh</label>
                            <input type="date" class="form-control" required id="birthday" placeholder="Ngày sinh" name="birthday">
                        </div>
                        <div class="form-group inline-block">
                            <label for="gender">Giới tính</label>
                            {{ Form::select('gender', ['null' => '--chọn--', '0' => 'nữ', '1' => 'nam'], null, ['class' => 'form-control']) }}
                        </div>
                      
                        <div class="form-group inline-block">
                            <label for="phone">Số điện thoại</label>
                            {{ Form::text('phone', null, array('class' => 'form-control', 'placeholder' => '0...' )) }}
                        </div>
                          <div class="form-group">
                            <label for="address">Địa chỉ</label>
                            {{ Form::text('address', null, array('class' => 'form-control', 'placeholder' => 'Địa chỉ' )) }}
                        </div>
                        <div class="form-group">
                            <label for="school">Trường học</label>
                            {{ Form::text('school', null, array('class' => 'form-control', 'placeholder' => 'Trường học' )) }}
                        </div>
                        <div class="form-group">
                            <label for="link_fb">Link facebook</label>
                            {{ Form::text('link_fb', null, array('class' => 'form-control', 'placeholder' => 'Link facebook' )) }}
                        </div>
                        <div class="form-group">
                            <label for="description">Mục tiêu</label>
                            {{ Form::text('description', null, array('class' => 'form-control', 'placeholder' => 'Mục tiêu' )) }}
                        </div>
                        <div class="form-group">
                            <label for="time_target">Thời gian để đạt mục tiêu</label>
                            {{ Form::text('time_target', null, array('class' => 'form-control', 'placeholder' => 'Thời gian để đạt mục tiêu' )) }}
                        </div>
                        <div class="form-group">
                            <label for="info_user">Thông tin người đón</label>
                            {{ Form::text('info_user', null, array('class' => 'form-control', 'placeholder' => 'Thông tin người đón' )) }}
                        </div>
                        
                    </fieldset>
                </div>
            </div>
            <div class="box-body col-sm-6">
                <div class="form-group well well-sm">
                    <fieldset>
                        <legend>Thông tin về mẹ</legend>
                        <div class="input-group inline-block">
                            <label for="mom_fullname">Họ tên mẹ</label>
                            {{ Form::text('mom_fullname', null, array('class' => 'form-control', 'placeholder' => 'Họ tên mẹ' )) }}
                        </div>
                        <div class="input-group inline-block">
                            <label for="mom_phone">Số điện thoại</label>
                            {{ Form::text('mom_phone', null, array('class' => 'form-control', 'placeholder' => 'Số điện thoại' )) }}
                        </div>
                    </fieldset>
                </div>
                <div class="form-group well well-sm">
                    <fieldset>
                        <legend>Thông tin về bố</legend>
                        <div class="input-group inline-block">
                            <label for="dad_fullname">Họ tên bố</label>
                            {{ Form::text('dad_fullname', null, array('class' => 'form-control', 'placeholder' => 'Họ tên bố' )) }}
                        </div>
                        <div class="input-group inline-block">
                            <label for="dad_phone">Số điện thoại</label>
                            {{ Form::text('dad_phone', null, array('class' => 'form-control', 'placeholder' => 'Số điện thoại' )) }}
                        </div>
                    </fieldset>
                </div>
                <div class="form-group well well-sm">
                    <fieldset>
                        <legend>Thông tin gói học</legend>
                        <div class="box alert filter-document-form">
                            <div class="input-group inline-block">
                            <label style="display: block;">Lớp</label>
                            {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), Input::get('class_id'), ['class' => 'form-control select-class']) }}
                            </div>
                            <div class="input-group inline-block">
                            <label style="display: block;">Môn học</label>
                            {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), Input::get('subject_id'), ['class' => 'form-control select-subject']) }}
                            </div>
                            <div class="input-group inline-block select-level-from-class-subject">
                                <label style="display: block;">Trình độ</label>
                                 {{ Common::getLevelDropdownList('level_id', Input::get('level_id')) }}
                            </div>
                        
                        </div>
                        <div class="form-group">
                            {{ Form::label('package','Gói học') }} 
                            {{ Form::select('package', $package, null, ['class' => 'form-control', 'requited'=>true]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('lesson_code', 'Bắt đầu học từ buổi', ['style' => 'display: block']) }}
                            {{ Form::select('lesson_code', ['' => '--chọn--'],[] ,['class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{ Form::label('number_manny', 'Số tiền đóng học') }} 
                            {{ Form::text('number_many','', ['class' => 'form-control','requited'=>true])}}
                        </div>
                        
                        <legend> thời gian học</legend>
                        <div class="input-group inline-block  col-sm-4" >
                            <label for="time_id">Chọn ngày học</label>
                            <input type="date" class="form-control" id="date_study" placeholder="Ngày vào học" name="time_id">
                        </div>
                       
                        <div class="input-group inline-block col-sm-4" >
                            <label for="hours">giờ băt đầu học</label>
                            {{ Form::text('hours', null, ['class' => 'form-control timepicker', 'requited'=>true ]) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('','chọn cố vấn học tập') }}
                            {{ Form::select('',['' => '-- chọn --'] + User::where('role_id', CVHT)->lists('username', 'id'), null,['class' => 'form-control']) }}
                        </div>
                    </fieldset> 
                         
                </div>
                <div class="form-group well well-sm">
                    <fieldset>
                        
                        <div class="form-group">
                            <label for="comment">Lưu ý về học sinh</label>
                            {{ Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Lưu ý về học sinh' , 'rows'=>6]) }}
                        </div> 
                    </fieldset>
                </div>

                <div class="form-group">
                    <label for="manual_user">Chọn CVHT</label>
                    {{ Form::text('manual_user', null, array('class' => 'form-control', 'id' => 'tags')) }}
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="clearfix clear">
        </div>
        <div class="box-footer">
            <input type="submit" class="btn btn-primary" value="Lưu lại"/>
            <input type="reset" class="btn btn-default" value="Nhập lại"/>
        </div>
         {{ Form::close() }}
    </div><!-- /.box -->
</div>

<script type="text/javascript">
  $( function() {

    var myJson = <?php echo json_encode($manualUser) ?>;

    $( "#tags" ).autocomplete({
      source: myJson
    });
  } );
  </script>
@stop
