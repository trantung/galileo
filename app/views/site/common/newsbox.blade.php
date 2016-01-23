<?php $types = Common::getObjectLanguageByStatus('TypeNew', getLang(), 2); ?>
@if(count($types) > 0)
	@foreach($types as $type)
		<?php $news = Common::getNews($type->id, getLang()) ?>
		@if(count($news) > 0)
		<div class="homebox newsbox">
			<div class="container">
				<h2>{{ $type->name }}</h2>
				<div class="row">
					@foreach($news as $new)
					<div class="col-sm-4">
						<?php 
							switch (getLang()) {
								case LANG_EN:
									$newsId = Common::getIdVi($new->id, 'AdminNew');
									break;
								default:
									$newsId = $new->id;
									break;
							}
						?>
						<img src="{{ url(UPLOADIMG . '/news'.'/'. $newsId . '/' . $new->image_url) }}" width="100%" height="200px" />
						<h3>{{ $new->name }}</h3>
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