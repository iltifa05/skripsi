<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND id_hasil = '$id'");
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
						<h4 class="page-title">Detail Hasil Kegiatan</h4>
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
								<a href="hasil">Hasil Kegiatan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-hasil?id=<?= $id;?>">Detail Hasil Kegiatan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Hasil Kegiatan</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_hasil" value="<?= $row['id_hasil'];?>">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="tanggal_hasil" class="required-form"><b>Tanggal Hasil Kegiatan</b></label>
													<input type="text" id="tanggal_hasil" name="tanggal_hasil" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Tanggal Hasil Kegiatan" value="<?= $row['tanggal_hasil'];?>" readonly>
												</div>
											</div>
											<!-- <div class="col-md-6">
													<div class="form-group">
														<label for="id_pembagian">Jadwal</label>
														<select class="form-control select2" name="id_pembagian" id="id_pembagian" required="" style="width: 100%;">
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal, tb_pembagian WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pembagian.id_jadwal = tb_jadwal.id_jadwal ORDER BY DATE(tanggal_pembagian) DESC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_pembagian'];?>" <?php if($row['id_pembagian'] == $row2['id_pembagian']) {echo "selected=''";} ?>><?php echo $row2['keterangan'];?></option>
															<?php } ?>
														</select>
													</div>
												</div> -->
												<div class="col-md-12">
													<div class="form-group">
														<label for="id_pembagian">Kecamatan - Kelurahan - Usulan - Permasalahan</label>
														<select class="form-control select2" name="id_pembagian"
															id="id_pembagian" required="" style="width: 100%;" autofocus>
															<option value="">Pilih Kecamatan - Kelurahan - Usulan - Permasalahan</option>
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal, tb_pembagian WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pembagian.id_jadwal = tb_jadwal.id_jadwal ORDER BY DATE(tanggal_pembagian) DESC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_pembagian'];?>" <?php if($row['id_pembagian'] == $row2['id_pembagian']) {echo "selected=''";} ?>><?php echo $row2['nama_kecamatan'];?> | <?php echo $row2['nama_kelurahan'];?> | <?php echo $row2['usulan'];?> | <?php echo $row2['permasalahan'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="volume">Volume</label>
										<input type="text" name="volume" id="volume" class="form-control" required="" autocomplete="off"  value="<?= $row['volume'];?>" placeholder="Volume">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="satuan">Satuan</label>
										<input type="text" name="satuan" id="satuan" class="form-control" required="" autocomplete="off"  value="<?= $row['satuan'];?>" placeholder="Satuan">
									</div>
								</div>
											<div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label for="keterangan_hasil" class="required-form"><b>Keterangan</b></label>
													<textarea type="text" id="keterangan_hasil" name="keterangan_hasil" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Keterangan" rows="4" autofocus><?= $row['keterangan_hasil'];?></textarea>
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="upload_foto" class="required-form"><b>Upload Foto</b></label>
													<div class="custom-file">
														<input type="file" name="upload_foto[]" id="upload_foto" class="custom-file-input" id="customFile" accept=".jpg, .jpeg, .png" title="Tidak ada foto dipilih" multiple>
														<label class="custom-file-label" for="customFile">Pilih Upload Foto</label>
													</div>
													<small class="form-text text-muted text-danger">Kosongkan jika tidak ada perubahan <strong>Upload Foto</strong>.</small>
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="hasil" class="btn btn-danger btn-sm">Kembali</a>
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
					url: "proses/update-hasil.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'hasil');
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