<div class="footer">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<h3>{{ trans('captions.menu') }}</h3>
				<ul class="footerMenu">
					<li><a href="{{ url('/') }}">Trang chủ</a></li>
					<li><a href="">Giới thiệu</a></li>
					<li><a href="">Tin tức</a></li>
					<li><a href="">Tuyển dụng</a></li>
					<li><a href="">Liên hệ</a></li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h3>{{ trans('captions.follow') }}</h3>
				<ul class="footerFollow">
					<li><a href="">Facebook</a></li>
					<li><a href="">Google +</a></li>
				</ul>
			</div>
			<div class="col-sm-4">
				<h3>{{ trans('captions.address') }}</h3>
				<div class="footerAddress">
					{{ Common::objectLanguage('Contact', 1, getLang())->description }}
				</div>
			</div>
		</div>
	</div>
</div>
<div class="footerCopyright">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				&copy; Copyright 2016
			</div>
		</div>
	</div>
</div>