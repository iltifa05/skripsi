<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_petugas WHERE id_petugas = '$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php';?>
	<?php
	// if($online['level'] <> "Administrator") {
	// 	header("Location: " . getBaseURL());
	// 	exit();
	// }
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
						<h4 class="page-title">Detail Petugas</h4>
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
								<a href="petugas">Petugas</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-petugas?id=<?= $id;?>">Detail Petugas</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Petugas</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_petugas" value="<?= $row['id_petugas'];?>">
									<div class="card-body">
										<div class="row">
										<div class="col-md-6">
												<div class="form-group">
													<label for="id_jabatan">Jabatan</label>
													<select class="form-control select2" name="id_jabatan" id="id_jabatan" required="" style="width: 100%;">
														<?php
														$query2 = mysqli_query($conn, "SELECT * FROM tb_jabatan ORDER BY nama_jabatan ASC");
														while($row2 = mysqli_fetch_array($query2)) {
															?>
															<option value="<?php echo $row2['id_jabatan'];?>" <?php if($row['id_jabatan'] == $row2['id_jabatan']) {echo "selected=''";} ?>><?php echo $row2['nama_jabatan'];?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="nip_petugas" class="required-form"><b>NIP Petugas</b></label>
													<input type="text" id="nip_petugas" name="nip_petugas" class="form-control" required="" autocomplete="off" minlength="18" maxlength="18" placeholder="NIP Petugas" onkeypress="return hanyaAngka(event)" value="<?= $row['nip_petugas'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="nama_petugas" class="required-form"><b>Nama Petugas</b></label>
													<input type="text" id="nama_petugas" name="nama_petugas" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Nama Petugas" value="<?= $row['nama_petugas'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="tempat_lahir" class="required-form"><b>Tempat Lahir</b></label>
													<input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Tempat Lahir" value="<?= $row['tempat_lahir'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="tanggal_lahir" class="required-form"><b>Tanggal Lahir</b></label>
													<input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" required="" autocomplete="off" value="<?= $row['tanggal_lahir'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="upload_foto" class="required-form"><b>Upload Foto</b></label>
													<div class="custom-file">
														<input type="file" name="upload_foto" id="upload_foto" class="custom-file-input" id="customFile" accept=".jpg, .jpeg, .png" title="Tidak ada foto dipilih">
														<label class="custom-file-label" for="customFile">Pilih Upload Foto</label>
													</div>
													<small class="form-text text-muted text-danger">Kosongkan jika tidak ada perubahan <strong>Upload Foto</strong>.</small>
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="nomor_petugas" class="required-form"><b>Nomor Telepon</b></label>
													<input type="text" id="nomor_petugas" name="nomor_petugas" class="form-control" required="" autocomplete="off" minlength="10" maxlength="12" placeholder="Nomor Telepon" onkeypress="return hanyaAngka(event)" value="<?= $row['nomor_petugas'];?>">
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="petugas" class="btn btn-danger btn-sm">Kembali</a>
												<button type="submit" class="btn btn-primary btn-sm float-right">Ubah</button>
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
		$('.select2').select2({
			theme: "bootstrap"
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-petugas.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'petugas');
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