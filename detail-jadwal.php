<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_tujuan, tb_jadwal WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND id_jadwal = '$id'");
$row = mysqli_fetch_array($query);
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
						<h4 class="page-title">Detail Jadwal Survei</h4>
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
								<a href="">Transaksi</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="jadwal">Jadwal Survei</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-jadwal?id=<?= $id;?>">Detail Jadwal Survei</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Jadwal Survei</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_jadwal" value="<?= $row['id_jadwal'];?>">
									<input type="hidden" name="place_id" id="place_id" value="<?= $row['place_id'];?>">
									<div class="card-body">
										<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="id_pengaduan">Kecamatan - Kelurahan - Usulan - Permasalahan</label>
														<select class="form-control select2" name="id_pengaduan"
															id="id_pengaduan" required="" style="width: 100%;" autofocus>
															<option value="">Pilih Kecamatan - Kelurahan - Usulan - Permasalahan</option>
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang ORDER BY DATE(tanggal_pengaduan) DESC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_pengaduan'];?>" <?php if($row['id_pengaduan'] == $row2['id_pengaduan']) {echo "selected=''";} ?>><?php echo $row2['nama_kecamatan'];?> | <?php echo $row2['nama_kelurahan'];?> | <?php echo $row2['usulan'];?> | <?php echo $row2['permasalahan'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_jadwal">Tanggal Jadwal Asrama</label>
										<input type="date" name="tanggal_jadwal" id="tanggal_jadwal" class="form-control" required="" autocomplete="off" placeholder="Tanggal Jadwal Asrama" value="<?= $row['tanggal_jadwal'];?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="sampai_tanggal">Sampai Tanggal</label>
										<input type="date" name="sampai_tanggal" id="sampai_tanggal" class="form-control" required="" autocomplete="off" placeholder="Sampai Tanggal" value="<?= $row['sampai_tanggal'];?>">
									</div>
								</div>
								
											<!-- <div class="col-lg-12 col-md-12">
												<div class="form-group">
													<label for="keterangan" class="required-form"><b>Status Kelanjutan / Kebutuhan Survei</b></label>
													<textarea type="text" id="keterangan" name="keterangan" class="form-control" required="" autocomplete="off" minlength="1" maxlplaceholder="Status Kelanjutan / Kebutuhan Survei" rows="3"><?= $row['keterangan'];?></textarea>
												</div>
											</div> -->
											<div class="col-md-6">
													<div class="form-group">
														<label for="keterangan">Status</label>
														<select class="form-control select2" name="keterangan" id="keterangan" required="" style="width: 100%;">
															<option value="Mendesak" <?php if($row['keterangan'] == 'Mendesak') {echo "selected=''";} ?>>Mendesak</option>
															<option value="Prioritas" <?php if($row['keterangan'] == 'Prioritas') {echo "selected=''";} ?>>Prioritas</option>
															<option value="Di Pertimbangkan"<?php if($row['keterangan'] == 'Di Pertimbangkan') {echo "selected=''";} ?>>Di Pertimbangkan</option>
															<option value="Di Pantau"<?php if($row['keterangan'] == 'Di Pantau') {echo "selected=''";} ?>>Di Pantau</option>
														</select>
													</div>
												</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="jadwal" class="btn btn-danger btn-sm">Kembali</a>
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
					url: "proses/update-jadwal.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'jadwal');
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