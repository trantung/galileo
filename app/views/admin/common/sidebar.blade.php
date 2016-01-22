<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">Menu</li>
			<li><a href="{{ action('NewsController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Quản lý tin</span></a></li>
			<li><a href="{{ action('NewsTypeController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Quản thể loại tin</span></a></li>
			<li><a href=""><i class="fa fa-newspaper-o"></i> <span>Giới thiệu</span></a></li>
			<li><a href="{{ action('DesContentController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Giới thiệu trang chủ</span></a></li>
			<li><a href="{{ action('AdminIntroduceController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Introduce</span></a></li>
			<li><a href="{{ action('AdminContactController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Liên hệ</span></a></li>
			<li><a href=""><i class="fa fa-newspaper-o"></i> <span>Feedback</span></a></li>
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