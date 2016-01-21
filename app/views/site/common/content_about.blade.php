@if(LaravelLocalization::setLocale() != 'en')
<div class="homebox about">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="aboutInner">
					<h2>{{ $viDes->title }}</h2>
					<p>{{ $viDes->description }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@else
<div class="homebox about">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div class="aboutInner">
					<h2>{{ $enDes->title }}</h2>
					<p>{{ $enDes->description }}</p>
				</div>
			</div>
		</div>
	</div>
</div>
@endif
