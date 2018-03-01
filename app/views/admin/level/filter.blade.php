@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
	{{ Form::open(['action' => 'LevelController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		<div class="input-group inline-block">
			<label>Tiêu đề</label>
			{{ Form::text('name', Input::get('name'), ['class' => 'form-control', 'placeholder' => 'Tiêu đề']) }}
		</div>
		<div class="input-group inline-block">
			<label style="display: block;">Lớp</label>
		  	{{ Form::select('class_id', ['' => '--Tất cả--'] + Common::getClassList(), Input::get('class_id'), ['class' => 'form-control select-class']) }}
		</div>
		<div class="input-group inline-block">
			<label style="display: block;">Môn học</label>
		  	{{ Form::select('subject_id', ['' => '--Tất cả--'] + Common::getSubjectList(), Input::get('subject_id'), ['class' => 'form-control select-subject']) }}
		</div>{{-- 
		<div class="input-group inline-block select-level-from-class-subject">
			<label style="display: block;">Trình độ</label>
			{{ Common::getLevelDropdownList('level_id', Input::get('level_id')) }}
		</div> --}}
		{{-- <div class="input-group inline-block">
			<label style="display: block;">Trạng thái</label>
		  	{{ Form::select('status', ['' => '--Tất cả--', '0' => 'Chưa công bố', 1 => 'Đã công bố'], Input::get('status'), ['class' => 'form-control']) }}
		</div> --}}
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('LevelController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>