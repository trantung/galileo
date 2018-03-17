@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
	{{ Form::open(['action' => 'StudentController@index', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		
		<div class="input-group inline-block">
            <label>Chọn học sinh</label>
            {{ Form::select('fullname', ['' => '--Chọn--'] + Common::getStudentNameList(), null , ['class' => 'form-control selectpicker', 'data-live-search' => 'true']) }}
        </div>

        <div class="input-group inline-block">
			<label>Chọn Email</label>
			{{ Form::select('email', ['' => '-- Chọn --'] + Common::getEmailStudentList(), null, ['class' => 'form-control']) }}
		</div>
		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('StudentController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>