@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
	{{ Form::open(['action' => 'ScheduleController@course', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		
		<div class="input-group inline-block">
            <label>Chọn học sinh</label>
            {{ Form::select('student_id', ['' => '--Chọn--'] + Common::getStudentList(), null , ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required' => true]) }}
        </div>

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

        <div class="input-group inline-block">
			<label>Gói học</label>
			{{ Form::select('package_id', ['' => '-- Chọn --'] + Package::lists('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Gói học']) }}
		</div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('ScheduleController@course', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>