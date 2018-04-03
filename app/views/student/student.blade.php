<div class="box-body col-sm-6">
    <div class="form-group well well-sm">
        <fieldset>
            <legend>Thông tin học sinh</legend>
            <div class="form-group">
                <label for="fullname">Họ và tên <span class="text-danger">(*)</span></label>
                {{ Form::text('fullname', Input::get('fullname'), array('class' => 'form-control', 'placeholder' => 'Họ và tên' )) }}
                @if( $errors->form->has('fullname') )
                    <p class="text-danger">{{ $errors->first('fullname') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group">
                <label for="code">Mã học sinh <span class="text-danger">(*)</span></label>
                {{ Form::text('code', Input::get('code'), array('class' => 'form-control', 'placeholder' => 'Mã học sinh' )) }}
                @if( $errors->form->has('code') )
                    <p class="text-danger">{{ $errors->first('code') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email <span class="text-danger">(*)</span></label>
                {{ Form::email('email', Input::get('email'), array('class' => 'form-control', 'placeholder' => 'Email' )) }}
                @if( $errors->form->has('email') )
                    <p class="text-danger">{{ $errors->first('email') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group">
                <label for="username">Tên đăng nhập <span class="text-danger">(*)</span></label>
                {{ Form::text('username', Input::get('username'), array('class' => 'form-control', 'placeholder' => 'Tên đăng nhập' )) }}
                @if( $errors->form->has('username') )
                    <p class="text-danger">{{ $errors->first('username') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group">
                <label for="password">Mật khẩu <span class="text-danger">(*)</span></label>
                <input type="password" class="form-control" id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Mật khẩu" name="password">
            </div>
            <div class="form-group">
                <label for="password">Xác nhận mật khẩu <span class="text-danger">(*)</span></label>
                <input type="password" class="form-control" id="password" pattern="[0-9a-fA-F]{4,12}" placeholder="Mật khẩu" name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="center_id">Trung tâm <span class="text-danger">(*)</span></label>
                {{ Form::select('center_id', ['null' => '--chọn--'] +$center, Input::get('center_id'), array('class' => 'form-control' )) }}
                @if( $errors->form->has('center_id') )
                    <p class="text-danger">{{ $errors->first('center_id') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group">
                <label for="date_study">Ngày nhập học</label>
                <input type="date" class="form-control" id="date_study" placeholder="Ngày vào học" name="date_study" value="{{Input::get('date_study')}}">
            </div>
            <div class="form-group">
                <label for="model_name">Nguồn</label>
                {{ Form::text('model_name', Input::get('model_name'), array('class' => 'form-control', 'placeholder' => 'Người giới thiệu' )) }}
            </div>
            <div class="form-group inline-block">
                <label for="birthday">Ngày sinh <span class="text-danger">(*)</span></label>
                <input type="date" class="form-control" id="birthday" placeholder="Ngày sinh" name="birthday" value="{{Input::get('birthday')}}">
                @if( $errors->form->has('birthday') )
                    <p class="text-danger">{{ $errors->first('birthday') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group inline-block">
                <label for="gender">Giới tính <span class="text-danger">(*)</span></label>
                {{ Form::select('gender', ['null' => '--chọn--', '0' => 'nữ', '1' => 'nam'], Input::get('gender'), ['class' => 'form-control']) }}
                @if( $errors->form->has('gender') )
                    <p class="text-danger">{{ $errors->first('gender') }} <i class="glyphicon glyphicon-alert"></i></p>
                @endif
            </div>
            <div class="form-group inline-block">
                <label for="phone">Số điện thoại</label>
                {{ Form::text('phone', Input::get('phone'), array('class' => 'form-control', 'placeholder' => '0...' )) }}
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ</label>
                {{ Form::text('address', Input::get('address'), array('class' => 'form-control', 'placeholder' => 'Địa chỉ' )) }}
            </div>
            <div class="form-group">
                <label for="school">Trường học</label>
                {{ Form::text('school', Input::get('school'), array('class' => 'form-control', 'placeholder' => 'Trường học' )) }}
            </div>
            <div class="form-group">
                <label for="link_fb">Link facebook</label>
                {{ Form::text('link_fb', Input::get('link_fb'), array('class' => 'form-control', 'placeholder' => 'Link facebook' )) }}
            </div>
            <div class="form-group">
                <label for="description">Mục tiêu</label>
                {{ Form::text('description', Input::get('description'), array('class' => 'form-control', 'placeholder' => 'Mục tiêu' )) }}
            </div>
            <div class="form-group">
                <label for="time_target">Thời gian để đạt mục tiêu</label>
                {{ Form::text('time_target', Input::get('time_target'), array('class' => 'form-control', 'placeholder' => 'Thời gian để đạt mục tiêu' )) }}
            </div>
            <div class="form-group">
                <label for="info_user">Thông tin người đón</label>
                {{ Form::text('info_user', Input::get('info_user'), array('class' => 'form-control', 'placeholder' => 'Thông tin người đón' )) }}
            </div>
            <div class="form-group">
                <label for="comment">Lưu ý về học sinh</label>
                {{ Form::textarea('comment', '', ['class' => 'form-control', 'placeholder' => 'Lưu ý về học sinh' , 'rows'=>3]) }}
            </div> 
        </fieldset>
    </div>
</div>


