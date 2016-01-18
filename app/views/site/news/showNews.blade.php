@extends('site.layout.default', array('seoMeta' => CommonSite::getMetaSeo('AdminNew', $inputNew->id), 'seoImage' => FOLDER_SEO_NEWS . '/' . $inputNew->id))

@section('title')
	@if($title = CommonSite::getMetaSeo('AdminNew', $inputNew->id)->title_site)
		{{ $title= $title }}
	@else
		{{ $title = $inputNew->title }}
	@endif
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