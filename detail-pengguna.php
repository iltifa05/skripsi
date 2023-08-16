<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pengguna, tb_kecamatan WHERE tb_pengguna.fk_kecamatan=tb_kecamatan.id_kecamatan AND id_pengguna = '$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php';?>
	<?php
	if($online['level'] <> "Administrator") {
		header("Location: " . getBaseURL());
		exit();
	}
	?>
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
						<h4 class="page-title">Detail Pengguna</h4>
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
								<a href="">Master</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="pengguna">Pengguna</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-pengguna?id=<?= $id;?>">Detail Pengguna</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Pengguna</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_pengguna" value="<?= $row['id_pengguna'];?>">
									<div class="card-body">
										<div class="row">
										<div class="col-md-6">
													<div class="form-group">
														<label for="fk_kecamatan">Kecamatan</label>
														<select class="form-control select2" name="fk_kecamatan" id="fk_kecamatan" required="" style="width: 100%;">
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_kecamatan ORDER BY nama_kecamatan ASC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_kecamatan'];?>" <?php if($row['fk_kecamatan'] == $row2['id_kecamatan']) {echo "selected=''";} ?>><?php echo $row2['nama_kecamatan'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="nama_lengkap" class="required-form"><b>Nama Lengkap</b></label>
													<input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Nama Lengkap" value="<?= $row['nama_lengkap'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="username" class="required-form"><b>Nama Pengguna</b></label>
													<input type="text" id="username" name="username" class="form-control" required="" autocomplete="off" minlength="1" maxlength="20" placeholder="Nama Pengguna" value="<?= $row['username'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="password"><b>Kata Sandi</b></label>
													<input type="password" id="password" name="password" class="form-control" autocomplete="off" minlength="1" placeholder="Kata Sandi">
													<small class="form-text text-muted text-danger">Kosongkan jika tidak ada perubahan <strong>Kata Sandi</strong>.</small>
												</div>
											</div>
											<!-- <div class="col-md-6">
													<div class="form-group">
														<label for="jenjang_pendidikan">Jenjang Pendidikan</label>
														<select class="form-control select2" name="jenjang_pendidikan" id="jenjang_pendidikan" required="" style="width: 100%;">
															<option value="KB" <?php if($row['jenjang_pendidikan'] == 'KB') {echo "selected=''";} ?>>KB</option>
															<option value="TK" <?php if($row['jenjang_pendidikan'] == 'TK') {echo "selected=''";} ?>>TK</option>
															<option value="SD"<?php if($row['jenjang_pendidikan'] == 'SD') {echo "selected=''";} ?>>SD</option>
															<option value="SMP"<?php if($row['jenjang_pendidikan'] == 'SMP') {echo "selected=''";} ?>>SMP</option>
															<option value="MTs"<?php if($row['jenjang_pendidikan'] == 'MTs') {echo "selected=''";} ?>>MTs</option>
															<option value="MI"<?php if($row['jenjang_pendidikan'] == 'MI') {echo "selected=''";} ?>>MI</option>
															<option value="Madin"<?php if($row['jenjang_pendidikan'] == 'Madin') {echo "selected=''";} ?>>Madin</option>
															<option value="Pondok Pesantren"<?php if($row['jenjang_pendidikan'] == 'Pondok Pesantren') {echo "selected=''";} ?>>Pondok Pesantren</option>
															<option value="TPA"<?php if($row['jenjang_pendidikan'] == 'TPA') {echo "selected=''";} ?>>TPA</option>
															<option value="TPQ"<?php if($row['jenjang_pendidikan'] == 'TPQ') {echo "selected=''";} ?>>TPQ</option>
															<option value="Rumah Tahfiz"<?php if($row['jenjang_pendidikan'] == 'Rumah Tahfiz') {echo "selected=''";} ?>>Rumah Tahfiz</option>
															<option value="Majelis Taklim"<?php if($row['jenjang_pendidikan'] == 'Majelis Taklim') {echo "selected=''";} ?>>Majelis Taklim</option>
														</select>
													</div>
												</div> -->
										</div>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="pengguna" class="btn btn-danger btn-sm">Kembali</a>
												<button type="submit" class="btn btn-primary btn-sm float-right">Simpan</button>
											</div>
										</div>
									</div>
								</form>
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
					url: "proses/update-pengguna.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'pengguna');
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