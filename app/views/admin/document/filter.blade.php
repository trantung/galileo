@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">

	{{ Form::open(['action' => 'DocumentController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
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
		<div class="input-group inline-block">
			<label style="display: block;">Buổi số</label>
			{{ Form::select('lesson_code', ['' => '--Tất cả--'] + Common::getListLessonCode(), Input::get('lesson_code'), ['class' => 'form-control']) }}
		</div>
		<div class="input-group inline-block">
			<label style="display: block;">Trạng thái</label>
			{{ Form::select('status', ['' => '--Tất cả--', 1 => 'Đã kiểm duyệt', 2 => 'Chưa kiểm duyệt'], Input::get('status'), ['class' => 'form-control']) }}
		</div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('DocumentController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>