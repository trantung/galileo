<!DOCTYPE html>
<html>
@include('admin.common.header')
<body class="hold-transition skin-blue">


  <!-- Left side column. contains the logo and sidebar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="margin: 0">
    <!-- Main content -->
    <section class="content">
    	<!-- Notifications: message/alert/waring -->
    	<!-- @include('admin.common.message') -->
    	<!-- ./ notifications: message/alert/waring -->
		  <!-- Content -->
    	@yield('content')
    	<!-- ./ content -->
    </section>
    <!-- /.content -->
  </div>

<!-- ./wrapper -->

</body>
</html>