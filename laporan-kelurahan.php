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
	<?php
	// if($online['level'] == "Checker") {
	// 	header("Location: " . getBaseURL());
	// 	exit();
	// }
	// if($online['level'] == "Transporter") {
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
						<h4 class="page-title">Laporan Pengaduan</h4>
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
								<a href="">Laporan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="kelurahan">Laporan Pengaduan</a>
							</li>
						</ul>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<ul class="nav nav-tabs" id="myTab" role="tablist">
													<li class="nav-item">
														<a class="nav-link <?php if(isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'pertahun') || empty($_GET['submit'])) { echo 'active show'; } ?>" id="pertahun-tab" data-toggle="tab" href="#pertahun" role="tab" aria-controls="pertahun" aria-selected="true">Pertahun</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-lg-12 col-md-12">
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade <?php if(isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'pertahun')|| empty($_GET['submit'])) { echo 'active show'; } ?>" id="pertahun" role="tabpanel" aria-labelledby="pertahun-tab">
														<div class="row">
															<div class="col-md-12">
																<form action="" method="GET" id="form_tambah">
																	<input type="hidden" name="tipe" id="tipe" value="pertahun">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="tahun">Tahun</label>
																				<select class="form-control select2" name="tahun" id="tahun" required="" style="width: 100%;">
																					<option value="">Pilih Tahun</option>
																					<?php
																					$mulai = date('Y') - 50;
																					for($i = $mulai; $i < $mulai + 100; $i++){

																						if((isset($_GET['tipe']) && $_GET['tipe'] == "pertahun") && (isset($_GET['tahun']) && !empty($_GET['tahun']))) {
																							$sel = $_GET['tahun'] == $i ? "selected='selected'" : '';
																						}else {
																							$sel = $i == date('Y') ? "selected=''" : '';
																						}
																						?>
																						<option value="<?= $i;?>" <?= $sel;?>><?= $i;?></option>
																					<?php } ?>
																				</select>
																			</div>
																		</div>
																		<div class="col-md-12">
																			<div class="form-group">
																				<button type="submit" class="btn btn-primary float-right" name="submit" value="show">Tampilkan Data</button>
																			</div>
																		</div>
																	</div>
																</form>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-lg-12 col-md-12">
												<?php if(isset($_GET['submit'])) { ?>

													<?php if(isset($_GET['tipe'])) { ?>

														<?php if($_GET['tipe'] == "pertahun") { 
															$tahun = $_GET['tahun'];
															?>
															<a href="print/c-kelurahan?tipe=pertahun&tahun=<?= $tahun; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else { ?>
															<a href="print/c-kelurahan" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php } ?>

													<?php }else { ?>
														<a href="print/c-kelurahan" target="_blank" class="btn btn-success">
															<i class="fas fa-print"></i>
														</a>
													<?php } ?>

												<?php }else { ?>
													<a href="print/c-kelurahan" target="_blank" class="btn btn-success">
														<i class="fas fa-print"></i>
													</a>
													<?php } ?>
													<a href="laporan-kelurahan" class="btn btn-warning">
														<i class="fas fa-arrow-left"></i>
													</a>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-lg-12 col-md-12">
												<div class="table-responsive">
												<table class="display table table-striped table-hover datatables"	>
													<thead>
														<tr>
															<th>No</th>
															<th>Nama Kecamatan</th>
															<th>Nama Kelurahan</th>
															<th>Jumlah Pengaduan</th>
															<th>Jumlah Di Proses</th>
															<th>Jumlah Selesai Pengerjaan</th>
														</tr>
													</thead>
													<tbody>
														<?php 
														$no = 1;
														$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_kecamatan WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan ORDER BY nama_kecamatan ASC");
														while($row = mysqli_fetch_array($query)) {
															if(isset($_GET['submit'])) {
																
																if(isset($_GET['tipe'])) {
																	if($_GET['tipe'] == "pertahun") {
																		$tahun = $_GET['tahun'];
															$query_jumlah1 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]'  AND tanggal_pengaduan LIKE '$tahun%'");
															$row_jumlah1 = mysqli_fetch_array($query_jumlah1);

															$query_jumlah2 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]'  AND tanggal_pengaduan LIKE '$tahun%' AND status_hasil='Proses'");
															$row_jumlah2 = mysqli_fetch_array($query_jumlah2);

															$query_jumlah3 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]'  AND tanggal_pengaduan LIKE '$tahun%' AND status_hasil='Selesai'");
															$row_jumlah3 = mysqli_fetch_array($query_jumlah3);

														}else {
															$query_jumlah1 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]'");
															$row_jumlah1 = mysqli_fetch_array($query_jumlah1);

															$query_jumlah2 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]' AND status_hasil='Proses'");
															$row_jumlah2 = mysqli_fetch_array($query_jumlah2);

															$query_jumlah3 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]' AND status_hasil='Selesai'");
															$row_jumlah3 = mysqli_fetch_array($query_jumlah3);
														}
														
													}else {
														$query_jumlah1 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]'");
														$row_jumlah1 = mysqli_fetch_array($query_jumlah1);

														$query_jumlah2 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]' AND status_hasil='Proses'");
														$row_jumlah2 = mysqli_fetch_array($query_jumlah2);

														$query_jumlah3 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]' AND status_hasil='Selesai'");
														$row_jumlah3 = mysqli_fetch_array($query_jumlah3);
													}
													
												}else {
													$query_jumlah1 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]'");
													$row_jumlah1 = mysqli_fetch_array($query_jumlah1);

													$query_jumlah2 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]' AND status_hasil='Proses'");
													$row_jumlah2 = mysqli_fetch_array($query_jumlah2);

													$query_jumlah3 = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_kelurahan, tb_jadwal, tb_pengaduan, tb_kecamatan, tb_pembagian, tb_hasil WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pembagian.id_jadwal=tb_jadwal.id_jadwal AND tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tb_kelurahan.id_kelurahan='$row[id_kelurahan]' AND status_hasil='Selesai'");
													$row_jumlah3 = mysqli_fetch_array($query_jumlah3);
												}
															?>
															<tr>
																<td><?= $no++;?></td>
																<td><?= $row['nama_kecamatan'];?></td>
																<td><?= $row['nama_kelurahan'];?></td>
																<td><?= $row_jumlah1['jumlah'];?></td>
																<td><?= $row_jumlah2['jumlah'];?></td>
																<td><?= $row_jumlah3['jumlah'];?></td>
															</tr>
														<?php } ?>
													</tbody>
												</table>
												</div>
											</div>
										</div>
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
		$('.select2').select2({
			theme: "bootstrap"
		});
	</script>
</body>
</html>