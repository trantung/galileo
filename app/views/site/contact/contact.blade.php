@extends('site.layout.default')

@section('title')
	{{ $title = trans('captions.contact'); }}
@stop

@section('content')

<div class="main contact">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				map code
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h2>{{ trans('captions.address') }}</h2>
				<h3>{{ trans('captions.howtofind') }}</h3>
				<div class="contact-address">
					<p>Công ty Cổ phần truyền thông ABC</p>
					<p>Địa chỉ: P501, Tầng 5, Tòa nhà văn phòng, Số 5B/55, Huỳnh Thúc Kháng, Phường Láng Hạ, Quận Đống Đa, Hà Nội</p>
					<p>Tel: (84-4) 3.775.4334 - Fax: (84-4) 3512 1804</p>
				</div>
			</div>
			<div class="col-sm-6">
				<h2>{{ trans('captions.contactform') }}</h2>
				<h3>{{ trans('captions.contactus') }}</h3>
				<div class="contact-form">
					{{ Form::open(array('action' => 'ContactController@store', 'method' => 'POST', 'class' => 'form-horizontal')) }}
						<div class="row">
							<div class="col-sm-4">
								{{ Form::text('name', '', array('placeholder' => trans('captions.name'), 'class' => 'contact-input')) }}
								{{ Form::text('email', '', array('placeholder' => trans('captions.email'), 'class' => 'contact-input')) }}
								{{ Form::text('phone', '', array('placeholder' => trans('captions.phone'), 'class' => 'contact-input')) }}
							</div>
							<div class="col-sm-8">
								{{ Form::textarea('message', '', array('placeholder' => trans('captions.message'), 'class' => 'form-control',"rows"=>5, 'class' => 'contact-input')) }}
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								{{ Form::submit( trans('captions.submit') , array('class' => 'contact-submit')) }}
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

@stop