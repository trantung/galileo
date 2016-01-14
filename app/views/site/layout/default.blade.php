<!DOCTYPE html>
<html>
	@include('site.common.header')
	<body>
		@include('site.common.top')

		@yield('content')

		@include('site.common.footer')
	</body>
</html>