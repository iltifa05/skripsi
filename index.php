<?php
include 'koneksi.php';
if(isset($_COOKIE['_ga_NP5R9ZCR7Z2']) && isset($_COOKIE['_ga_NZ0K2CYT673'])) {
	if($_COOKIE['_ga_NP5R9ZCR7Z2'] == md5('login')) {
		$kode = base64_decode($_COOKIE['_ga_NZ0K2CYT673']);
		$queryGet = mysqli_query($conn, "SELECT * FROM tb_pengguna WHERE kode = '$kode'");
		$rowGet = mysqli_fetch_array($queryGet);

		$_SESSION['kode'] = $rowGet['kode'];
		$_SESSION['username'] = $rowGet['username'];
		$_SESSION['nama_lengkap'] = $rowGet['nama_lengkap'];
		$_SESSION['level'] = $rowGet['level'];
		$_SESSION['is_active'] = $rowGet['is_active'];
		$_SESSION['id_pengguna'] = $rowGet['id_pengguna'];
		$_SESSION['time'] = date('Y-m-d H:i:s');
		$_SESSION['login'] = true;
		header("Location: beranda");
		exit();
	}
}
if(isset($_SESSION['login'])) {
	header("Location: beranda");
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="author" content="SISTEM INFORMASI MONITORING DAN EVALUASI (MONEV) KEWILAYAHAN BERBASIS WEB PADA BAPPEDA KOTA BANJARBARU">
	<meta name="description" content="SISTEM INFORMASI MONITORING DAN EVALUASI (MONEV) KEWILAYAHAN BERBASIS WEB PADA BAPPEDA KOTA BANJARBARU">
	<meta name="keywords" content="jafar, rizki karianata">
	<title>Bappeda</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="assets/img/logo.png" type="image/x-icon"/>
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.css">
	<link rel="stylesheet" type="text/css" href="<?= clearCacheFile('assets/css/main.css');?>">
</head>
<body class="login">
	<div class="wrapper wrapper-login wrapper-login-full p-0">
		<div class="login-aside w-50 d-flex flex-column align-items-center justify-content-center text-center" style="background-image: linear-gradient(rgba(0, 0, 0, 0.527),rgba(0, 0, 0, 0.5)) , url('assets/img/background.jpg'); object-fit: cover; background-size: cover;">
			<h1 class="title fw-bold text-white mb-3">BADAN PERENCANAAN PEMBANGUNAN PENELITIAN DAN PENGEMBANGAN DAERAH</h1>
			<p class="subtitle text-white op-7">SISTEM INFORMASI MONITORING DAN EVALUASI (MONEV) KEWILAYAHAN BERBASIS WEB PADA BAPPEDA KOTA BANJARBARU</p>
		</div>
		<div class="login-aside w-50 d-flex align-items-center justify-content-center" style="background-color: #adb5bd;">
			<div class="container container-login container-transparent animated fadeIn">
				<h3 class="text-center">Selamat Datang</h3>
				<form action="" enctype="multipart/form-data" id="data-form-login">
					<div class="login-form">
						<div class="form-group">
							<label for="username" class="placeholder required-form"><b>Nama Pengguna</b></label>
							<input type="text" name="username" id="username" class="form-control" required="" autocomplete="off" minlength="1" maxlength="20" placeholder="Nama Pengguna">
						</div>
						<div class="form-group">
							<label for="password" class="placeholder required-form"><b>Kata Sandi</b></label>
							<div class="position-relative">
								<input type="password" name="password" id="password" class="form-control" required="" autocomplete="off" minlength="1" placeholder="Kata Sandi">
								<div class="show-password">
									<i class="icon-eye"></i>
								</div>
							</div>
						</div>
						<div class="form-group form-action-d-flex mb-3">
							<!-- <div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="rememberme" name="remember">
								<label class="custom-control-label m-0" for="rememberme">Ingat Saya</label>
							</div> -->
							<button type="submit" class="btn btn-secondary col-md-12 float-right mt-3 mt-sm-0 fw-bold">Masuk</button>
						</div>
						<!-- <div class="login-account">
							<span class="msg">Belum mempunyai akun ?</span>
							<a id="show-signup" class="link link-pointer">Daftar Sekarang</a>
						</div> -->
					</div>
				</form>
			</div>

			<div class="container container-signup container-transparent animated fadeIn" style="width: -webkit-fill-available;">
				<h3 class="text-center">Pendaftaran Data pemohon</h3>
				<form action="" method="POST" enctype="multipart/form-data" id="data-form-register">
					<div class="login-form">
						<div class="row">
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label for="nama_pemohon" class="required-form"><b>Nama Pemohon</b></label>
									<input type="text" id="nama_pemohon" name="nama_pemohon" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Nama Pemohon">
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label for="alamat_pemohon" class="required-form"><b>Alamat Pemohon</b></label>
									<input type="text" id="alamat_pemohon" name="alamat_pemohon" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Alamat Pemohon">
								</div>
							</div>
							<input type="hidden" id="status" name="status" class="form-control" required="" autocomplete="off" minlength="10" maxlength="12" value="Belum Aktif">
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label for="telepon_pemohon" class="required-form"><b>No. Telepon</b></label>
									<input type="text" id="telepon_pemohon" name="telepon_pemohon" class="form-control" required="" autocomplete="off" minlength="10" maxlength="12" placeholder="No. Telepon" onkeypress="return hanyaAngka(event)">
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label for="ktp_pemohon" class="required-form"><b>KTP Pemohon</b></label>
									<div class="custom-file">
										<input type="file" name="ktp_pemohon" id="ktp_pemohon" class="custom-file-input" id="customFile" accept=".jpg, .jpeg, .png" title="Tidak ada foto dipilih" required="">
										<label class="custom-file-label" for="customFile">Pilih KTP Pemohon</label>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label for="username" class="required-form"><b>Username</b></label>
									<input type="text" id="username" name="username" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Username">
								</div>
							</div>
						</div>
					</div>
					<div class="row form-action">
						<div class="col-lg-6 col-md-12">
							<button type="submit" class="btn btn-secondary w-100 fw-bold">Daftar</button>
						</div>
					</div>
				</form>
				<div class="login-account">
					<span class="msg">Sudah mempunyai akun ?</span>
					<a id="show-signin" class="link link-pointer">Masuk</a>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
	<script src="assets/js/core/popper.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
	<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
	<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
	<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
	<script src="assets/js/plugin/datatables/datatables.min.js"></script>
	<script src="assets/plugins/selectric/public/jquery.selectric.min.js"></script>
	<script src="assets/js/atlantis.min.js"></script>
	<script src="assets/js/bs-custom-file-input.min.js"></script>
	<script src="<?= clearCacheFile('assets/js/main.js');?>"></script>
	<script type="text/javascript">
		document.querySelector('.custom-file-input').addEventListener('change',function(e){
			var fileName = document.getElementById("bukti_sk").files[0].name;
			var nextSibling = e.target.nextElementSibling
			nextSibling.innerText = fileName
		})
	</script>
	<script type="text/javascript">
		$('.select2').select2({
			theme: "bootstrap"
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form-login").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/login.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'beranda');
						}else {
							customSweetAlert('Peringatan', response.message, 'error', 'danger', null);
						}
					}
				});
				return false;
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form-register").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/register.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', '<?= getBaseURL();?>');
						}else {
							customSweetAlert('Peringatan', response.message, 'error', 'danger', null);
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>