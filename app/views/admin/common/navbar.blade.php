<header class="main-header">
  <!-- Logo -->
  <a href="#" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">ABC</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">ABC-GROUP</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Menu</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

        <li class="user">
          <a href="#"><i class="fa fa-user"></i>{{ Common::getObject(Auth::admin()->get(), 'username') }}</a>
        </li>

      </ul>
    </div>
  </nav>
</header>