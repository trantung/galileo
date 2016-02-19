<?php $types = Common::getObjectLanguageByStatus('TypeNew', getLang(), 2); ?>
@if(count($types) > 0)
	@foreach($types as $type)
		<?php $news = Common::getNews($type->id, getLang(), 3) ?>
		@if(count($news) > 0)
		<div class="homebox newsbox">
			<div class="container">
				<h2>{{ $type->name }}</h2>
				<div class="row">
					@foreach($news as $new)
					<div class="col-sm-4">
						<img src="{{ url(UPLOADIMG . '/news'.'/'. Common::getIdVi($new->id, 'AdminNew') . '/' . $new->image_url) }}" width="100%" height="auto" />
						<h3><a href="{{ action('SiteTypeController@showChildSlug', [$type->slug, $new->slug]) }}">{{ $new->name }}</a></h3>
						<p>
							{{ limit_text(removeTagsHtml($new->description), TEXTLENGH_DESCRIPTION) }}
						</p>
					</div>
					@endforeach
				</div>
			</div>
		</div>
		@endif
	@endforeach
@endif