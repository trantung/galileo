@extends('site.layout.default')

@section('title')
	{{ $title = trans('captions.contact'); }}
@stop

@section('content')

<div class="main contact">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<input id = "latitude" type="hidden" value="{{ $data->lat }}">
	            <input id = "longitude" type="hidden" value="{{ $data->long }}">
                <div class="map">
                    <div id="mapview" style="height: 400px; width: 100%; max-width: 100%;"></div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<h2>{{ trans('captions.address') }}</h2>
				<div class="contact-address">
					{{ $data->description }}
				</div>
			</div>
			<div class="col-sm-6">
				<h2>{{ trans('captions.contactform') }}</h2>
				<div class="contact-form">
					@include('message')
					{{ Form::open(array('action' => 'ContactController@contact', 'method' => 'POST', 'class' => 'form-horizontal')) }}
						<div class="row">
							<div class="col-sm-4">
								{{ Form::text('name', '', array('placeholder' => trans('captions.name'), 'class' => 'contact-input', 'required' => 'required')) }}
								{{ Form::text('email', '', array('placeholder' => trans('captions.email'), 'class' => 'contact-input', 'required' => 'required')) }}
								{{ Form::text('phone', '', array('placeholder' => trans('captions.phone'), 'class' => 'contact-input', 'required' => 'required')) }}
							</div>
							<div class="col-sm-8">
								{{ Form::textarea('message', '', array('placeholder' => trans('captions.message'), 'class' => 'form-control',"rows"=>5, 'class' => 'contact-input')) }}
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4">
								{{ Form::submit( trans('captions.submit') , array('class' => 'contact-submit')) }}
							</div>
						</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@include('googlemap_script')
@stop