@extends('site.layout.default')

@section('title')
{{ $title = 'Danh sách tin tức' }}
@stop

@section('content')

<div class="main">
<div class="container">

<div class="grid">

	{{-- <div class="title_center">
		<h1>Danh sách tin tức</h1>
	</div> --}}
	<div class="row">
		@foreach($inputListNews as $value)
			<div class="col-sm-4 grid-item">
				<div class="grid-image">
					<a href="{{ action('SiteNewsController@show', $value->slug) }}">
						<img src="{{ url(UPLOADIMG . '/news'.'/'. $value->id . '/' . $value->image_url) }}" />
					</a>
				</div>
				<div class="grid-text">
					<h3>
						<a href="{{ action('SiteNewsController@show', $value->slug) }}">
							{{ $value->name }}
						</a>
					</h3>
					<p>{{ limit_text(strip_tags($value->description), TEXTLENGH_DESCRIPTION) }}</p>
				</div>
				<div class="grid-seemore">
					<a href="{{ action('SiteNewsController@show', $value->slug) }}">Xem thêm</a>
				</div>
			</div>
		@endforeach
	</div>
</div>

@include('site.common.paginate', array('input' => $inputListNews))

</div>
</div>

@stop