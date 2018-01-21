@extends('admin.layout.default')

@section('title')
{{ $title='Quản lý học sinh' }}
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
        {{ Form::open(array('action' => 'StudentController@store')) }}
          <div class="box-body">

            <div class="form-group">
              <label for="fullname">Họ và tên</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" required id="fullname" placeholder="Họ và tên" name="fullname">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="code">Mã học sinh</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" required id="code" placeholder="Mã học sinh" name="code" hidden="hidden">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email</label>
                <div class="row">
                  <div class="col-sm-6">
                    <input type="email" class="form-control" required id="email" placeholder="Email" name="email">
                  </div>
                </div>
            </div>

            <div class="form-group">
              <label for="username">Tên đăng nhập</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" required id="username" placeholder="Tên đăng nhập" name="username">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="password">Mật khẩu</label>
              <div class="row">
              	<div class="col-sm-6">
              		<input type="password" class="form-control" required id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Mật khẩu" name="password">
              	</div>
              </div>
            </div>

            <div class="form-group">
              <label for="center_id">Trung tâm</label>
              <div class="row">
                <div class="col-sm-6">
                  {{  Form::select('center_id', [NULL => "--"] + $center, null, array('class' => 'form-control', 'required' => 'required' )) }}
                </div>
              </div>
            </div>

              <div class="form-group">
                <label for="class_id">Lớp học</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{  Form::select('class_id', [NULL => "--"] + $class, null, array('class' => 'form-control', 'required' => 'required' )) }}
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="subject_id">Môn đang học</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{  Form::select('subject_id', [NULL => "--"] + $subject, null, array('class' => 'form-control', 'required' => 'required')) }}
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label for="program_learned">Chương trình đã học</label>
                <div class="row">
                  <div class="col-sm-6">
                    {{  Form::select('program_learned', [NULL => "--"] + $level, null, array('class' => 'form-control', 'required' => 'required' )) }}                                                              
                  </div>
                </div>
              </div>
         
            <div class="form-group">
              <label for="date_study">Ngày vào học</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="date" class="form-control" required id="date_study" placeholder="Ngày vào học" name="date_study">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="model_id">model id</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="integer"  class="form-control" required id="model_id" placeholder="Model id" name="model_id">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="model_name">model name</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="model_name" placeholder="Model name" name="model_name">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="birthday">Ngày sinh</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="date"  class="form-control" required id="birthday" placeholder="Ngày sinh" name="birthday">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="gender">Giới tính</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="gender" placeholder="Giới tính" name="gender">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="address">Địa chỉ</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="address" placeholder="Địa chỉ" name="address">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="phone">Số điện thoại</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text" class="form-control" required id="phone" placeholder="Phone number" name="phone">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="school">Trường học</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="school" placeholder="Trường học" name="school">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="dad_fullname">Họ tên cha</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="dad_fullname" placeholder="Họ tên cha" name="dad_fullname">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="dad_phone">SĐT cha</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="dad_phone" placeholder="Họ tên cha" name="dad_phone">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="mom_fullname">Họ tên mẹ</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="mom_fullname" placeholder="Họ tên mẹ" name="mom_fullname">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="mom_phone">SĐT mẹ</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="mom_phone" placeholder="SĐT mẹ" name="mom_phone">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="link_fb">Link facebook</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="link_fb" placeholder="Link facebook" name="link_fb">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="description">Mục tiêu</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="description" placeholder="Mục tiêu" name="description">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="time_target">Thời gian để đạt mục tiêu</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="time_target" placeholder="Thời gian để đạt mục tiêu" name="time_target">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="info_user">Thông tin người đón</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="info_user" placeholder="Thông tin người đón" name="info_user">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="comment">Lưu ý về học sinh</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="comment" placeholder="Lưu ý về học sinh" name="comment">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="number_program">Số chương trình đã học</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="number_program" placeholder="Số chương trình đã học" name="number_program">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="program_current">Chương trình đang học</label>
              <div class="row">
                <div class="col-sm-6">
                  <input type="text"  class="form-control" required id="program_curent" placeholder="Chương trình đang học" name="program_current">
                </div>
              </div>
            </div>

          </div>
          <!-- /.box-body -->

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
