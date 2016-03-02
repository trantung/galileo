<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">Menu</li>
			<li><a href="{{ action('NewsController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Tin chi tiết</span></a></li>
			<li><a href="{{ action('NewsTypeController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Danh mục Tin</span></a></li>
			<li><a href="{{ action('AdminTypeAboutController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Trang giới thiệu</span></a></li>
			<li><a href="{{ action('AdminAboutUsController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Chi tiết trang giới thiệu</span></a></li>
			<li><a href="{{ action('DesContentController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Giới thiệu chung trang chủ</span></a></li>
			<li><a href="{{ action('AdminIntroduceController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Giới thiệu chi tiết trang chủ</span></a></li>
			<li><a href="{{ action('AdminContactController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Liên hệ</span></a></li>
			<li><a href="{{ action('AdminContactController@feedback') }}"><i class="fa fa-newspaper-o"></i> <span>Feedback</span></a></li>
			<li><a href="{{ action('AdminSlideController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Slide</span></a></li>
			<li><a href="{{ action('BottomTextController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Text bottom</span></a></li>
			@if(Admin::isAdmin())
			<li>
				<a href="{{ action('ManagerController@index') }}">
					<i class="fa fa-users"></i> <span>Quản lý thành viên</span>
				</a>
			</li>
			@endif
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>