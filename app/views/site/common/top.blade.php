<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="row">
			<div class="col-sm-3">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Menu</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="logo" href="{{ url('/') }}">
					<img src="{{ url('/assets/images/logo.png') }}" />
				</a>
			</div>
			<div class="col-sm-9">
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav navbar-right">
						<li {{ checkActive() }}><a href="{{ url('/') }}">Trang chủ</a></li>
						<li {{ checkActive('gioi-thieu') }}><a href="./">Giới thiệu</a></li>
						<li {{ checkActive('tin-tuc') }}><a href="./">Tin tức</a></li>
						<li {{ checkActive('tuyen-dung') }}><a href="./">Tuyển dụng</a></li>
						<li {{ checkActive('lien-he') }}><a href="./">Liên hệ</a></li>
					</ul>
				</div>
				<div class="language_bar_chooser">
				    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
			            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
			                {{{ $properties['native'] }}}
			            </a>
				    @endforeach
				</div>
			</div>
		</div>
	</div>
</nav>