<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman Ujian </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/font-awesome/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>plugins/iCheck/all.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/css/skins/_all-skins.min.css">

  	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">

		<header class="main-header">
			<nav class="navbar navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a href="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>index2.html" class="navbar-brand"><b>CAT </b>PMB</a>
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
							<i class="fa fa-bars"></i>
						</button>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->

					<!-- /.navbar-collapse -->
					<!-- Navbar Right Menu -->

					<!-- /.navbar-custom-menu -->
				</div>
				<!-- /.container-fluid -->
			</nav>
		</header>
		<!-- Full Width Column -->
		<div class="content-wrapper">
			<div class="container">
				<!-- Content Header (Page header) -->
				

				<!-- Main content -->
				<section class="content">
					<div class="row">
						<div class="col-md-12">
							<div class="box box-info">
								<div class="box-header with-border">
									<div class="col-md-7">
										<form class="form-horizontal">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">No Peserta</label>

												<div class="col-sm-8">
													<div class="form-control-static"><?php echo $dataPeserta['no_peserta'] ?></div>
												</div>
											</div>
											<div class="form-group">
												<label for="inputPassword3" class="col-sm-4 control-label">Nama Peserta</label>

												<div class="col-sm-8">
													<div class="form-control-static"><?php echo $dataPeserta['nama']; ?></div>
												</div>
											</div>
										</form>
									</div>
									<div class="col-md-5">
										<form class="form-horizontal">
											<div class="form-group">
												<label for="inputEmail3" class="col-sm-4 control-label">Jumlah Soal</label>

												<div class="col-sm-8">
													<div class="form-control-static"><?php echo $jumlahSoal ?></div>
												</div>
											</div>
											<div class="form-group">
												<label for="inputPassword3" class="col-sm-4 control-label">Durasi</label>

												<div class="col-sm-8">
													<div class="form-control-static" id="durasi"><div id="durasi"></div></div>
												</div>
											</div>
										</form>
									</div>
								</div>

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="box box-success">
								<div class="box-header with-border">
									<h3 class="box-title"></h3>

									<div class="box-tools pull-right"></div>
								</div>
								<!-- /.box-header -->
								<div class="box-body">
									<?php $num = $this->uri->segment(3) ? $this->uri->segment(3)  : 0; ?>
									<form class="form-horizontal">
										<?php foreach ($soals as $key => $soal_): ?>
											<div class="form-group ">
												<label for="inputEmail3" class="col-sm-2 control-label"><?php echo ++$num . ')'; ?></label>

												<div class="col-sm-8 ">
													<div class="col-md-12">
														<div class="form-control-static bg-muted"><?php echo $soal_['soal'] ?></div>
														
													</div>

													<table class="table">
														<tr>
															<td style="width: 5%"><input type="radio"  id="<?php echo $soal_['id'] . '-' . 'A';  ?>" data-jawaban="A" data-combine="<?php echo $soal_['id'] . '-' . 'A';  ?>" data-id="<?php echo $soal_['id']; ?>" name="<?php echo $soal_['id']; ?>" class="pilih flat-red"></td>
															<td><?php echo $soal_['pilihan_A'] ?></td>
														</tr>
														<tr>
															<td style="width: 5%"><input type="radio"  id="<?php echo $soal_['id'] . '-' . 'B';  ?>" data-jawaban="B" data-combine="<?php echo $soal_['id'] . '-' . 'B';  ?>"  data-id="<?php echo $soal_['id']; ?>" name="<?php echo $soal_['id']; ?>" class="pilih flat-red"></td>
															<td><?php echo $soal_['pilihan_B'] ?></td>
														</tr>
														<tr>
															<td style="width: 5%"><input type="radio"  id="<?php echo $soal_['id'] . '-' . 'C';  ?>" data-jawaban="C" data-combine="<?php echo $soal_['id'] . '-' . 'C';  ?>"  data-id="<?php echo $soal_['id']; ?>" name="<?php echo $soal_['id']; ?>" class="pilih flat-red"></td>
															<td><?php echo $soal_['pilihan_C'] ?></td>
														</tr>
														<tr>
															<td style="width: 5%"><input type="radio"  id="<?php echo $soal_['id'] . '-' . 'D';  ?>" data-combine="<?php echo $soal_['id'] . '-' . 'D';  ?>"  data-jawaban="D" data-id="<?php echo $soal_['id']; ?>" name="<?php echo $soal_['id']; ?>" class="pilih flat-red"></td>
															<td><?php echo $soal_['pilihan_D'] ?></td>
														</tr>
														<tr>
															<td style="width: 5%"><input type="radio"  id="<?php echo $soal_['id'] . '-' . 'E';  ?>" data-combine="<?php echo $soal_['id'] . '-' . 'E';  ?>"  data-jawaban="E" data-id="<?php echo $soal_['id']; ?>" name="<?php echo $soal_['id']; ?>" class="pilih flat-red"></td>
															<td><?php echo $soal_['pilihan_E'] ?></td>
														</tr>

													</table>

													<!-- <div class="col-md-1">
														<input type="radio" name="r3" class="flat-red" >

													</div>
													
													
													<label>

														<div class="col-md-11">
															<?php echo $soal_['pilihan_A']; ?>
														</div>
													</label>
													<br> -->



												</div>

											</div>
										<?php endforeach ?>


									</form>
									<!-- /.row -->
								</div>
								<!-- ./box-body -->
								<div class="box-footer">
									<button  type="button" id="btn-selesai" class="btn btn-sm btn-warning btn-flat pull-left">Selesai</button>
									<div class="pull-right">
										<?php echo $this->pagination->create_links(); ?>
									</div>

									<!-- /.row -->
								</div>
								<!-- /.box-footer -->
							</div>
							<!-- /.box -->
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->

				</section>
				<!-- /.content -->
			</div>
			<!-- /.container -->
		</div>
		<!-- /.content-wrapper -->
		<footer class="main-footer">
			<div class="container">

				<strong>Copyright &copy; 2018
					<!-- /.container -->
				</strong>
			</div>
		</footer>
	</div>

	<!-- ./wrapper -->

	<!-- jQuery 3 -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap 3.3.7 -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/fastclick/lib/fastclick.js"></script>
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/jquery.countdown-2.2.0/jquery.countdown.min.js"></script>
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>bower_components/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>plugins/iCheck/icheck.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo site_url('assets/templates/AdminLTE-2.4.5/'); ?>dist/js/adminlte.min.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script type="text/javascript">
		var id_peserta = <?php echo isset($dataPeserta) ? $dataPeserta['id'] : ''; ?>;
		var list_jawaban = <?php echo json_encode($listJawaban); ?>;
		var tanggal_selesai = "<?php echo $waktuSelesai ?>";

		checklist_jawaban(list_jawaban);
		$('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
			checkboxClass: 'icheckbox_flat-green',
			radioClass   : 'iradio_flat-green'
		});
		$(function() {

			$('#durasi').countdown(tanggal_selesai, {defer: true})
			.on('update.countdown', function(event) {
				var $this = $(this).html(event.strftime(''
					+ '<span>%H</span> Jam '
					+ '<span>%M</span> menit '
					+ '<span>%S</span> detik'));	
			}).on('finish.countdown', function(ev) {
				$.when(simpan_selesai(id_peserta)).then(function() {
					swal({
						title : 'Time Up !',
						text: "Terima Kasih Telah Mengikuti Ujian",
						icon: "success",
						button: false,
						timer : 3500,
						closeOnClickOutside: false,
					}).then((val) => {
						location.href="<?php echo site_url() ?>";
					});
				});
				

			})
			.countdown('start');


			$('.pilih').on('ifChanged', (function(ev) {
				id_soal = $(this).data('id');
				jawaban = $(this).data('jawaban');
				simpan_jawaban(id_peserta, id_soal, jawaban);
			}));


			$('#btn-selesai').click(function() {
				$.when(simpan_selesai(id_peserta)).then(function() {
					swal({
						title : 'Selesai !',
						text: "Terima Kasih Telah Mengikuti Ujian",
						icon: "success",
						button: false,
						timer : 3500,
						closeOnClickOutside: false,
					}).then((val) => {
						location.href="<?php echo site_url() ?>";
					});
				});
			})
		});
		

		function checklist_jawaban(listJawaban)
		{
			for (var i = 0; i < listJawaban.length; i++) {
				$('#' + listJawaban[i]['id'] + '-'+ listJawaban[i]['jawaban']).attr('checked', 'checked');
			}
		}
		function simpan_selesai(id)
		{
			$.ajax({
				url: '<?= site_url() . "peserta/hitung"; ?>',
				type: 'POST',
				data: {id_peserta : id},
			})
			.done(function(score) {

				console.log(score);
			});



		}
		function simpan_jawaban(id_peserta, id_soal, jawaban)
		{
			var formData = {
				id_peserta : id_peserta,
				id_soal : id_soal,
				jawaban : jawaban,
			};
			$.ajax({
				url: '<?= site_url() . "peserta/simpan_jawaban"; ?>',
				type: 'POST',
				data: formData,
			})
			.done(function(res) {
				console.log(res);
			});

		}
	</script>
</body>
</html>
