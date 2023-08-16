<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php';?>
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<?php include 'menu/navbar.php';?>
		</div>
		<div class="sidebar sidebar-style-2">
			<?php include 'menu/sidebar.php';?>
		</div>
		<div class="main-panel">
			<div class="container">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Akun</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="beranda">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="armada">Akun</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-8">
							<div class="card card-with-nav">
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="level" value="<?= $online['level'];?>">
									<input type="hidden" id="id_pengguna" name="id_pengguna" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Nama Berita" value="<?= $id_pengguna; ?>">
									<div class="card-body">
											<div class="row">
												<div class="col-lg-6 col-md-12">
													<div class="form-group">
														<label for="nama_lengkap" class="required-form"><b>Nama Lengkap</b></label>
														<input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Nama Lengkap" value="<?= $online['nama_lengkap'];?>">
													</div>
												</div>
												<div class="col-lg-6 col-md-12">
													<div class="form-group">
														<label for="username" class="required-form"><b>Nama Pengguna</b></label>
														<input type="text" id="username" name="username" class="form-control" required="" autocomplete="off" minlength="1" maxlength="20" placeholder="Nama Pengguna" value="<?= $online['username'];?>">
														<input type="hidden" id="username_awal" name="username_awal" class="form-control" required="" autocomplete="off" minlength="1" maxlength="20" placeholder="Nama Pengguna" value="<?= $online['username'];?>">
													</div>
												</div>
												<div class="col-lg-6 col-md-12">
													<div class="form-group">
														<label for="password"><b>Kata Sandi</b></label>
														<input type="password" id="password" name="password" class="form-control" autocomplete="off" minlength="1" placeholder="Kata Sandi">
														<small class="form-text text-muted text-danger">Kosongkan jika tidak ada perubahan <strong>Kata Sandi</strong>.</small>
													<input type="checkbox" onclick="myFunction2()"> Tampilkan Kata Sandi
													<hr>
													</div>
												</div>
											</div>
										<div class="text-right mt-3 mb-3">
											<button class="btn btn-success">Simpan Perubahan</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card card-profile">
								<div class="card-header" style="background-image: url('../assets/img/blogpost.jpg')">
									<div class="profile-picture">
										<div class="avatar avatar-xl">
											<img src="assets/img/avatar.png" alt="Logo Avatar" class="avatar-img rounded-circle">
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="user-profile text-center">
										<div class="name"><?= $online['nama_lengkap'];?></div>
										<div class="job"><?= $online['level'];?></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<?php include 'menu/footer.php';?>
			</footer>
		</div>
	</div>
	<?php include 'menu/script.php';?>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-akun.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'akun');
						}else {
							customSweetAlert('Peringatan', response.message, 'error', 'danger', null);
						}
					}
				});
				return false;
			});
		});
	</script>
<script>
        function myFunction() {
            var x = document.getElementById("sandi");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        function myFunction2() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</body>
</html>