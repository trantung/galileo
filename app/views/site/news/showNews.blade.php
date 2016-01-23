@extends('site.layout.default')

@section('title')
	{{ $title = $data->title }}
@stop

@section('content')

<div class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-sm-push-3">
				<div class="detailTitle">
					<h1>{{ $data->name }}</h1>
				</div>
				<div class="clearfix"></div>
				<div class="detailContent">
					{{ $data->description }}
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-sm-3 col-sm-pull-9">
				<div class="detailImage">
					<img src="{{ url(UPLOADIMG . '/news'.'/'. Common::getIdVi($data->id, 'AdminNew') . '/' . $data->image_url) }}" />
				</div>
				@if($related)
				<div class="related">
					<ul>
						@foreach($related as $value)
						<li>
							<a href="{{ action('SiteTypeController@showChildSlug', [$slug, $value->slug]) }}">{{ $value->name }}</a>
						</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

@stop