@section('js_header')
@parent
{{ HTML::script( asset('custom/js/form-control.js') ) }}
{{ HTML::script( asset('custom/js/ajax.js') ) }}
@stop

<div class="box alert">
	{{ Form::open(['action' => 'LandingPageController@show', 'method' => 'GET', 'class' => 'filter-document-form']) }}
		<div class="clearfix"></div>
		
		<div class="input-group inline-block">
			<label>Họ tên mẹ</label>
			{{ Form::text('parent_name', Input::get('parent_name'), ['class' => 'form-control', 'placeholder' => 'Họ tên mẹ']) }}
		</div>

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
			<label>Lớp học</label>
			{{ Form::text('class', Input::get('class'), ['class' => 'form-control', 'placeholder' => 'Lớp học']) }}
		</div>

		<div class="input-group inline-block">
			<label>Môn kiểm tra</label>
			{{ Form::text('check_subject', Input::get('check_subject'), ['class' => 'form-control', 'placeholder' => 'Môn kiểm tra']) }}
		</div>

		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('LandingPageController@index', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>