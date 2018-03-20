@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
	{{ Form::open(['action' => 'ScheduleController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		
		<div class="input-group inline-block filter-document-form">
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
        <div class="clearfix"></div>
        <div class="input-group inline-block">
			<label>Ngày bắt đầu</label>
			<input type="date" class="lesson_date form-control" value="{{ Input::get('start_date') }}" placeholder="Ngày bắt đầu" name="start_date">
		</div>
		
		<div class="input-group inline-block">
			<label>Ngày kết thúc</label>
			<input type="date" class="lesson_date form-control" value="{{ Input::get('end_date') }}" placeholder="Ngày kết thúc" name="end_date">
		</div>
		<div class="clearfix"></div>
		<div class="input-group inline-block col-sm-2" >
            <label>Giờ băt đầu học</label>
            {{ Form::text('hour_start', Input::get('hour_start'), ['class' => 'form-control timepicker lesson_hour' ]) }}
        </div>
		<div class="input-group inline-block col-sm-2" >
            <label>Giờ kết thúc học</label>
            {{ Form::text('hour_end', Input::get('hour_end'), ['class' => 'form-control timepicker lesson_hour' ]) }}
        </div>
		<div class="clearfix"></div>
		<div class="input-group inline-block">
			<label>Cố vấn học tập</label>
            {{ Form::select('user_id', ['' => '-- chọn --'] + User::where('role_id', CVHT)->lists('username', 'id'), Input::get('user_id'),['class' => 'form-control selectpicker select-teacher', 'data-live-search' => 'true'])}}
		</div>
		
		<div class="input-group inline-block">
			<label>Số điện thoại</label>
			{{ Form::text('phone', Input::get('phone'), ['class' => 'form-control', 'placeholder' => 'Số điện thoại']) }}
		</div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('ScheduleController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>