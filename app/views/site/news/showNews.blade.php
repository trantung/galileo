@extends('site.layout.default')

@section('title')
	{{ $title = $inputNew->title }}
@stop

@section('content')

<div class="main">
	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-sm-push-3">
				<div class="detailTitle">
					<h1>{{ $inputNew->name }}</h1>
				</div>
				<div class="clearfix"></div>
				<div class="detailContent">
					{{ $inputNew->description }}
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="col-sm-3 col-sm-pull-9">
				<div class="detailImage">
					<img src="{{ url(UPLOADIMG . '/news'.'/'. $inputNew->id . '/' . $inputNew->image_url) }}" />
				</div>
				@if($inputRelated)
				<div class="related">
					<ul>
						@foreach($inputRelated as $value)
						<li><a href="{{ action('SiteNewsController@show', $value->slug) }}" title="{{ $value->name }}"> {{ $value->name }}</a></li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

@stop