<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CAT</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>/bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>/bower_components/Ionicons/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>/dist/css/AdminLTE.min.css">
	<!-- iCheck -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>/plugins/iCheck/square/blue.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
	<div class="register-box">
		<div class="register-logo">
			<a href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>/index2.html"><b>CAT</b> PMB</a>
		</div>

		<div id="notif-error"></div>


		<div class="register-box-body">
			<p class="login-box-msg">Daftar Untuk Ikut Ujian</p>

			<form id="form-daftar" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="no_peserta" placeholder="No Peserta">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap">
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="token" placeholder="Token">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>

				<div class="row">
					<div class="col-xs-8">

					</div>
					<!-- /.col -->
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Ujian</button>
					</div>
					<!-- /.col -->
				</div>
			</form>

			<div class="social-auth-links text-center">
				<p>- OR -</p>
				<a href="<?php echo site_url('login') ?>" class="btn btn-warning btn-flat">Login sebagai Admin</a>

			</div>

		</div>
		<!-- /.form-box -->
	</div>
	<!-- /.register-box -->

	<!-- jQuery 3 -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/pnotify/pnotify.min.js"></script>
	<!-- iCheck -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>plugins/iCheck/icheck.min.js"></script>
	<script>

	</script>
	<script type="text/javascript">
		$(function() {
			$('#form-daftar').submit(function(ev) {
				ev.preventDefault();


				var formData = $(this).serialize();

				$.ajax({
					url: '<?= site_urL() . "peserta/cek_ujian"; ?>',
					type: 'POST',
					data: formData,
				})
				.done(function(res) {
					var response = JSON.parse(res);
					console.log(res);
					if (!response['success'])
					{
						var text = '';
						for (var i = 0; i < response['error'].length; i++) {
							text += '<span>' + response['error'][i]['msg'] + '</span>' + '<br>';
						}

						

						
						if (response['msg']) {
							text += '<span>' + response['msg'] + '</span>' + '<br>';
							

						}
						$('#notif-error').html('');
						$('#notif-error').html('<div class="alert alert-danger alert-dismissible"> \
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> \
							' + text +'</div>');
					}
					else
					{
						location.href  = "<?php echo site_url('peserta/ujian'); ?>";
					}
				});

			}) ;
		});
	</script>
</body>
</html>
