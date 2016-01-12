<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">Menu</li>
			<li class="active"><a href="{{ action('NewsController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Quản lý tin</span></a></li>
			<li><a href="{{ action('NewsTypeController@index') }}"><i class="fa fa-newspaper-o"></i> <span>Quản thể loại tin</span></a></li>
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