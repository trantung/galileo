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
          <input type="text" class="form-control" required id="fullname" placeholder="Họ và tên" name="fullname">
        </div>

        <!-- <div class="form-group">
          <label for="code">Mã học sinh</label>
          <input type="text" class="form-control" id="code" placeholder="Mã học sinh" name="code" hidden="hidden">
        </div> -->

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" required id="email" placeholder="Email" name="email">
        </div>

        <div class="form-group">
          <label for="username">Tên đăng nhập</label>
          <input type="text" class="form-control" required id="username" placeholder="Tên đăng nhập" name="username">
        </div>

        <div class="form-group">
          <label for="password">Mật khẩu</label>
          <input type="password" class="form-control" required id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Mật khẩu" name="password">
        </div>

        <div class="form-group">
          <label for="center_id">Trung tâm</label>
          {{  Form::select('center_id', [NULL => "--"] + $center, null, array('class' => 'form-control', 'required' => 'required' )) }}
        </div>

        <div class="form-group well well-sm">
          <fieldset>
            <legend>Chương trình đã học</legend>
            <div class="input-group inline-block">
              <label style="display: block;">Lớp</label>
              {{ Form::select('class_old_id', ['' => '--Tất cả--'] + Common::getClassList(), '', ['class' => 'form-control select-class']) }}
            </div>
            <div class="input-group inline-block">
              <label style="display: block;">Môn học</label>
              {{ Form::select('subject_old_id', ['' => '--Tất cả--'] + Common::getSubjectList(), '', ['class' => 'form-control select-subject', 'multiple' => true]) }}
            </div>
            <div class="input-group inline-block select-level-from-class-subject">
              <label style="display: block;">Trình độ</label>
              {{ Common::getLevelMultiDropdownList('level_old_id[]') }}
            </div>
          </fieldset>
        </div>

        <div class="form-group well well-sm">
          <fieldset>
            <legend>Chương trình đang học</legend>
            <div class="input-group inline-block">
              <label style="display: block;">Lớp</label>
              {{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), '', ['class' => 'form-control select-class', 'required' => true]) }}
            </div>
            <div class="input-group inline-block">
              <label style="display: block;">Môn học</label>
              {{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), '', ['class' => 'form-control select-subject', 'required' => true, 'multiple' => true]) }}
            </div>
            <div class="input-group inline-block select-level-from-class-subject">
              <label style="display: block;">Trình độ</label>
              {{ Common::getLevelMultiDropdownList('level_id[]') }}
            </div>
          </fieldset>
        </div>

        <div class="form-group">
          <label for="date_study">Ngày nhập học</label>
          <input type="date" class="form-control" id="date_study" placeholder="Ngày vào học" name="date_study">
        </div>

        <!-- <div class="form-group">
          <label for="model_id">model id</label>
          <input type="integer"  class="form-control" required id="model_id" placeholder="Model id" name="model_id">
        </div>

        <div class="form-group">
          <label for="model_name">model name</label>
          <input type="text"  class="form-control" required id="model_name" placeholder="Model name" name="model_name">
        </div> -->

        <div class="form-group">
          <label for="birthday">Ngày sinh</label>
          <input type="date" class="form-control" required id="birthday" placeholder="Ngày sinh" name="birthday">
        </div>

        <div class="form-group">
          <label for="gender">Giới tính</label>
          <input type="text"  class="form-control" required id="gender" placeholder="Giới tính" name="gender">
        </div>

        <div class="form-group">
          <label for="address">Địa chỉ</label>
          <input type="text"  class="form-control" required id="address" placeholder="Địa chỉ" name="address">
        </div>

        <div class="form-group">
          <label for="phone">Số điện thoại</label>
          <input type="text" class="form-control" required id="phone" placeholder="Phone number" name="phone">
        </div>

        <div class="form-group">
          <label for="school">Trường học</label>
          <input type="text" class="form-control" id="school" placeholder="Trường học" name="school">
        </div>

        <div class="form-group">
          <label for="dad_fullname">Họ tên cha</label>
          <input type="text" class="form-control" id="dad_fullname" placeholder="Họ tên cha" name="dad_fullname">
        </div>

        <div class="form-group">
          <label for="dad_phone">SĐT cha</label>
          <input type="text"  class="form-control" id="dad_phone" placeholder="Họ tên cha" name="dad_phone">
        </div>

        <div class="form-group">
          <label for="mom_fullname">Họ tên mẹ</label>
          <input type="text" class="form-control" id="mom_fullname" placeholder="Họ tên mẹ" name="mom_fullname">
        </div>

        <div class="form-group">
          <label for="mom_phone">SĐT mẹ</label>
          <input type="text" class="form-control" id="mom_phone" placeholder="SĐT mẹ" name="mom_phone">
        </div>

        <div class="form-group">
          <label for="link_fb">Link facebook</label>
          <input type="text" class="form-control" id="link_fb" placeholder="Link facebook" name="link_fb">
        </div>

        <div class="form-group">
          <label for="description">Mục tiêu</label>
          <input type="text" class="form-control" id="description" placeholder="Mục tiêu" name="description">
        </div>

        <div class="form-group">
          <label for="time_target">Thời gian để đạt mục tiêu</label>
          <input type="text" class="form-control" id="time_target" placeholder="Thời gian để đạt mục tiêu" name="time_target">
        </div>

        <div class="form-group">
          <label for="info_user">Thông tin người đón</label>
          <input type="text" class="form-control" id="info_user" placeholder="Thông tin người đón" name="info_user">
        </div>

        <div class="form-group">
          <label for="comment">Lưu ý về học sinh</label>
          {{ Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Lưu ý về học sinh' , 'rows'=>3]) }}
        </div>
<!-- 
        <div class="form-group">
          <label for="number_program">Số chương trình đã học</label>
          <input type="text"  class="form-control" required id="number_program" placeholder="Số chương trình đã học" name="number_program">
        </div>

        <div class="form-group">
          <label for="program_current">Chương trình đang học</label>
          <input type="text"  class="form-control" required id="program_curent" placeholder="Chương trình đang học" name="program_current">
        </div> -->

      </div>
      <!-- /.box-body -->
      <div class="clearfix clear"></div>
      <div class="box-footer">
        <input type="submit" class="btn btn-primary" value="Lưu lại" />
        <input type="reset" class="btn btn-default" value="Nhập lại" />
      </div>
      {{ Form::close() }}
    </div>
    <!-- /.box -->
  </div>
</div>

@stop
