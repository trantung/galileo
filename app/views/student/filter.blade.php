@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
	{{ Form::open(['action' => 'StudentController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		
		<div class="input-group inline-block">
            <label>Chọn học sinh</label>
            {{ Form::select('student_id',['' => '--chọn--'] + Common::getStudentList(), Input::get('student_id') , ['class' => 'form-control selectpicker', 'data-live-search' => 'true', 'required' => true]) }}
        </div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('StudentController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>