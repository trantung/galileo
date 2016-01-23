@extends('site.layout.default')

@section('title')
	{{ $title = trans('captions.contact'); }}
@stop

@section('content')

<div class="main about">
	<div class="container">
		<div class="row">
			@foreach(getTypeLanguage($viData, $enData) as $value)
			<div class="col-sm-4">
				<div class="about1">
					<h2>{{ $value->name }}</h2>
					<h3>{{ $value->name_shadow }}</h3>
					@foreach(AboutUs::where('type_id', $value->id) as $valueAbout)
						@if($valueAbout->image_url)
							<img src="{{ url('/assets/images/game5.png') }}" alt="" />
						@endif
						<strong>
							{{ $valueAbout->title }}
						</strong>
						{{ $valueAbout->description }}
					@endforeach
				</div>
			</div>
			@endforeach
			
		</div>
	</div>
</div>
@stop