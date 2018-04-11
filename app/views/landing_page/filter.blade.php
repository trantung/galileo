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
			{{ Form::select('class', ['' => '--Chọn lớp--', '1' => 'Lớp 5', '2' => 'Lớp 9' ], ['class' => 'form-control']) }}
		</div>

		<div class="input-group inline-block">
			<label>Môn kiểm tra</label>
			{{ Form::select('check_subject', ['' => '--Chọn môn--', '1' => 'Môn Toán', '2' => 'Môn Ngữ văn/Tiếng việt', '3' => 'Cả 2 môn' ], ['class' => 'form-control']) }}
		</div>

		<div class="input-group inline-block" style="vertical-align: bottom;">
			<button type="submit" class="btn btn-primary">Tìm kiếm</button>
			{{ link_to_action('LandingPageController@show', 'Reset', null, ['class' => 'btn btn-primary']) }}
		</div>
	{{ Form::close() }}
</div>