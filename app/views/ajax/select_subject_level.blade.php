@section('style_header')
@parent
{{ HTML::style( asset('custom/css/style.css') ) }}
@stop

@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="js-multi-field">
	<div class="input-wrap">
		<div class="item select-subject-wrapper" data-syn="#syn">
			{{ Form::select('subject[]', [''=>'-- Chọn --'] + $subjects, '', ['class' => 'form-control', 'id' => 'syn']) }}
			<button type="button" class="btn btn-danger remove"><i class="glyphicon glyphicon-remove"></i></button>
			<div class="select-level">
				
			</div>
		</div>
	</div>
	<button class="btn btn-success add-new" type="button"><i class="glyphicon glyphicon-plus"></i> Thêm mới</button>
</div>
