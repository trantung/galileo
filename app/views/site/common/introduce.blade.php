<div class="homebox introduce">
	<div class="container">
		<div class="row">
			@foreach($introduces as $introduce)
				@if(LaravelLocalization::setLocale() != 'en')
					<div class="col-sm-4">
						<div class="introduceInner">
							<p class="introduceP1">
								<i class="{{ returnObjectLanguage($introduce, 'vi', 'Introduce')->css }}"></i>
								{{ returnObjectLanguage($introduce, 'vi', 'Introduce')->title }}
							</p>
							<span>{{ returnObjectLanguage($introduce, 'vi', 'Introduce')->description }}
							</span>
						</div>
					</div>
				@else
					<div class="col-sm-4">
						<div class="introduceInner">
							<p class="introduceP1">
								<i class="{{ returnObjectLanguage($introduce, 'en', 'Introduce')->css }}"></i>
								{{ returnObjectLanguage($introduce, 'en', 'Introduce')->title }}
							</p>
							<span>{{ returnObjectLanguage($introduce, 'en', 'Introduce')->description }}</span>
						</div>
					</div>
				@endif
			@endforeach
		</div>
	</div>
</div>