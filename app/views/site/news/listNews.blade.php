@extends('site.layout.default')

@section('title')
{{ $title = $typeName }}
@stop

@section('content')

<div class="main">
	<div class="container">
		<div class="grid">
			{{-- <div class="title_center">
				<h1> --}}
					{{-- {{ $typeName }} --}}
				{{-- </h1>
			</div> --}}
			<div class="row">
				@foreach($data as $value)
					<div class="col-sm-4 grid-item">
						<div class="grid-image">
							<a href="{{ action('SiteTypeController@showChildSlug', [$slug, $value->slug]) }}">
								<img src="{{ url(UPLOADIMG . '/news'.'/'. Common::getIdVi($value->id, 'AdminNew') . '/' . $value->image_url) }}" />
							</a>
						</div>
						<div class="grid-text">
							<h3>
								<a href="{{ action('SiteTypeController@showChildSlug', [$slug, $value->slug]) }}">
									{{ $value->name }}
								</a>
							</h3>
							<p>{{ limit_text(strip_tags($value->description), TEXTLENGH_DESCRIPTION) }}</p>
						</div>
						<div class="grid-seemore">
							<a href="{{ action('SiteTypeController@showChildSlug', [$slug, $value->slug]) }}">{{ trans('captions.seemore') }}</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@stop