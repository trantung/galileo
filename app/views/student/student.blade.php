<div class="box-body col-sm-6">
    <div class="form-group well well-sm">
        <fieldset>
            <legend>Thông tin học sinh</legend>
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
            <div class="form-group">
                <label for="comment">Lưu ý về học sinh</label>
                {{ Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Lưu ý về học sinh' , 'rows'=>3]) }}
            </div> 
            
        </fieldset>
    </div>
</div>