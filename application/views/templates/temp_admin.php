<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>plugins/iCheck/all.css">
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- jvectormap -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/css/skins/_all-skins.min.css">
   <?php echo  $css; ?>


   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">



<!-- jQuery 3 -->
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<!-- jvectormap  -->
<!-- SlimScroll -->
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/pnotify/pnotify.min.js"></script>
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/ckeditor/ckeditor.js"></script>
<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>plugins/iCheck/icheck.min.js"></script>
<!-- ChartJS -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<?php echo  $js; ?>
</head>
<body class="hold-transition skin-blue">
  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>C</b>AT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>CAT</b></span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <li>
              <a href="<?php echo site_url('logout'); ?>" >Logout</a>
            </li>
          </ul>
        </div>

      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>Admin</p>
            <a href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- search form -->

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="<?php echo site_url('admin'); ?>">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li> 
          <li>
            <a href="<?php echo site_url('admin/kelola_pelajaran'); ?>">
              <i class="fa fa-file-text"></i> <span>Kelola Pelajaran</span>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('admin/kelola_soal?id_pel=all&status=all'); ?>">
              <i class="fa fa-book"></i> <span>Kelola Soal</span>
            </a>
          </li>
          <li>
            <a href="<?php echo site_url('admin/kelola_ujian'); ?>">
              <i class="fa fa-circle-thin"></i> <span>Kelola Ujian</span>
            </a>
          </li>
           <li>
            <a href="<?php echo site_url('admin/daftar_nilai/all/all'); ?>">
              <i class="fa fa-list"></i> <span>Daftar Nilai</span>
            </a>
          </li>

          
          
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          <?php echo $title; ?>
          <br>
          <small><?php echo $subtitle; ?></small>
        </h1>

      </section>

      <!-- Main content -->
      <section class="content">
        <?php echo  $content; ?>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">

      <strong>Copyright &copy; 2018 <a href="#">CAT</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   

 </div>
 <!-- ./wrapper -->


</body>
</html>
