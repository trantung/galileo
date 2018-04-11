@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
    {{ Form::open(['action' => 'LandingPageController@admin', 'method' => 'GET', 'class' => 'filter-document-form']) }}
        <div class="clearfix"></div>
        <div class="input-group inline-block">
            <label>Họ tên HS</label>
            {{ Form::text('fullname', Input::get('fullname'), ['class' => 'form-control', 'placeholder' => 'Họ tên HS']) }}
        </div>
        <div class="input-group inline-block">
            <label>Số điện thoại</label>
            {{ Form::text('phone', Input::get('phone'), ['class' => 'form-control', 'placeholder' => 'Số điện thoại']) }}
        </div>

        <div class="input-group inline-block">
            <label>Email</label>
            {{ Form::text('email', Input::get('email'), ['class' => 'form-control', 'placeholder' => 'email']) }}
        </div>

        <div class="input-group inline-block">
            <label>Đợt thi</label>
            {{  Form::select('period', CommonLanding::getPeriodName(), Input::get('period'), array('class' => 'form-control')) }}
        </div>
        <div class="input-group inline-block">
            <label>Địa điểm thi</label>
            {{  Form::select('address', CommonLanding::getAddress(), Input::get('address'), array('class' => 'form-control')) }}
        </div>

        <div class="input-group inline-block">
            <label>Lớp học</label>
            {{  Form::select('class', CommonLanding::getClass(), Input::get('class'), array('class' => 'form-control')) }}
        </div>

        <div class="input-group inline-block">
            <label>Môn kiểm tra</label>
            {{  Form::select('check_subject', CommonLanding::getSubject(), Input::get('check_subject'), array('class' => 'form-control')) }}
        </div>
        <div class="input-group inline-block">
            <label>Học ở Galileo</label>
            {{  Form::select('status', CommonLanding::getStatus(), Input::get('status'), array('class' => 'form-control')) }}
        </div>

        <div class="input-group inline-block" style="vertical-align: bottom;">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            {{ link_to_action('LandingPageController@admin', 'Reset', null, ['class' => 'btn btn-primary']) }}
        </div>
    {{ Form::close() }}
</div>