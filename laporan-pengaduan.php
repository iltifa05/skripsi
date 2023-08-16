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
								<a href="pengaduan">Laporan Pengaduan</a>
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
														<a class="nav-link <?php if( (isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'pertanggal')) || empty($_GET['submit']) ) { echo 'active show'; } ?>" id="pertanggal-tab" data-toggle="tab" href="#pertanggal" role="tab" aria-controls="pertanggal" aria-selected="false">Pertanggal</a>
													</li>
													<li class="nav-item">
														<a class="nav-link <?php if(isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'perbulan')) { echo 'active show'; } ?>" id="perbulan-tab" data-toggle="tab" href="#perbulan" role="tab" aria-controls="perbulan" aria-selected="true">Perbulan</a>
													</li>
													<li class="nav-item">
														<a class="nav-link <?php if(isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'pertahun')) { echo 'active show'; } ?>" id="pertahun-tab" data-toggle="tab" href="#pertahun" role="tab" aria-controls="pertahun" aria-selected="true">Pertahun</a>
													</li>
												</ul>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-lg-12 col-md-12">
												<div class="tab-content" id="myTabContent">
													<div class="tab-pane fade <?php if( (isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'pertanggal')) || empty($_GET['submit']) ) { echo 'active show'; } ?>" id="pertanggal" role="tabpanel" aria-labelledby="pertanggal-tab">
														<div class="row">
															<div class="col-md-12">
																<form action="" method="GET" id="form_tambah">
																	<input type="hidden" name="tipe" id="tipe" value="pertanggal">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="from">Dari Tanggal</label>
																				<input type="date" name="from" id="from" required="" class="form-control" <?php if( (isset($_GET['tipe']) && $_GET['tipe'] == "pertanggal") && (isset($_GET['from']) && !empty($_GET['from'])) ) {echo "value='".date('Y-m-d', strtotime($_GET['from']))."'";} ?>>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="to">Sampai Tanggal</label>
																				<input type="date" name="to" id="to" required="" class="form-control" <?php if( (isset($_GET['tipe']) && $_GET['tipe'] == "pertanggal") && (isset($_GET['to']) && !empty($_GET['to'])) ) {echo "value='".date('Y-m-d', strtotime($_GET['to']))."'";} ?>>
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
													<div class="tab-pane fade <?php if(isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'perbulan')) { echo 'active show'; } ?>" id="perbulan" role="tabpanel" aria-labelledby="perbulan-tab">
														<div class="row">
															<div class="col-md-12">
																<form action="" method="GET" id="form_tambah">
																	<input type="hidden" name="tipe" id="tipe" value="perbulan">
																	<div class="row">
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="bulan">Bulan</label>
																				<select class="form-control select2" name="bulan" id="bulan" required="" style="width: 100%;">
																					<option value="">Pilih Bulan</option>
																					<option value="01" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "01") { echo "selected='selected'"; }?>>Januari</option>
																					<option value="02" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "02") { echo "selected='selected'"; }?>>Februari</option>
																					<option value="03" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "03") { echo "selected='selected'"; }?>>Maret</option>
																					<option value="04" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "04") { echo "selected='selected'"; }?>>April</option>
																					<option value="05" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "05") { echo "selected='selected'"; }?>>Mei</option>
																					<option value="06" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "06") { echo "selected='selected'"; }?>>Juni</option>
																					<option value="07" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "07") { echo "selected='selected'"; }?>>Juli</option>
																					<option value="08" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "08") { echo "selected='selected'"; }?>>Agustus</option>
																					<option value="09" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "09") { echo "selected='selected'"; }?>>September</option>
																					<option value="10" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "10") { echo "selected='selected'"; }?>>Oktober</option>
																					<option value="11" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "11") { echo "selected='selected'"; }?>>November</option>
																					<option value="12" <?php if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['bulan']) && !empty($_GET['bulan'])) && $_GET['bulan'] == "12") { echo "selected='selected'"; }?>>Desember</option>
																				</select>
																			</div>
																		</div>
																		<div class="col-md-6">
																			<div class="form-group">
																				<label for="tahun">Tahun</label>
																				<select class="form-control select2" name="tahun" id="tahun" required="" style="width: 100%;">
																					<option value="">Pilih Tahun</option>
																					<?php
																					$mulai = date('Y') - 50;
																					for($i = $mulai; $i < $mulai + 100; $i++){

																						if((isset($_GET['tipe']) && $_GET['tipe'] == "perbulan") && (isset($_GET['tahun']) && !empty($_GET['tahun']))) {
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
													<div class="tab-pane fade <?php if(isset($_GET['submit']) && (isset($_GET['tipe']) && $_GET['tipe'] == 'pertahun')) { echo 'active show'; } ?>" id="pertahun" role="tabpanel" aria-labelledby="pertahun-tab">
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

														<?php if($_GET['tipe'] == "pertanggal") { 
															$from = $_GET['from'];
															$to = $_GET['to']; 
															?>
															<a href="print/c-pengaduan?tipe=pertanggal&from=<?= $from; ?>&to=<?= $to; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else if($_GET['tipe'] == "perbulan") { 
															$bulan = $_GET['bulan'];
															$tahun = $_GET['tahun'];
															?>
															<a href="print/c-pengaduan?tipe=perbulan&bulan=<?= $bulan; ?>&tahun=<?= $tahun; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else if($_GET['tipe'] == "pertahun") { 
															$tahun = $_GET['tahun'];
															?>
															<a href="print/c-pengaduan?tipe=pertahun&tahun=<?= $tahun; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else { ?>
															<a href="print/c-pengaduan" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php } ?>

													<?php }else { ?>
														<a href="print/c-pengaduan" target="_blank" class="btn btn-success">
															<i class="fas fa-print"></i>
														</a>
													<?php } ?>

												<?php }else { ?>
													<a href="print/c-pengaduan" target="_blank" class="btn btn-success">
														<i class="fas fa-print"></i>
													</a>
													<?php } ?>
													<a href="laporan-pengaduan" class="btn btn-warning">
														<i class="fas fa-arrow-left"></i>
													</a>
											</div>
										</div>
										<div class="row mt-4">
											<div class="col-lg-12 col-md-12">
												<div class="table-responsive">
													<table class="display table table-striped table-hover datatables" id="table-1">
														<thead>
															<tr>
																<th>No</th>
																<th>Tanggal </th>
																<th>Kecamatan</th>
																<th>Kelurahan</th>
																<th>Usulan</th>
																<th>Permasalahan</th>
																<th>Bidang</th>
																<th>Titik Lokasi</th>
															</tr>
														</thead>
														<tbody>
															<?php 
															$no = 1;
															if(isset($_GET['submit'])) {
																
																if(isset($_GET['tipe'])) {
																	
																	if($_GET['tipe'] == "pertanggal") {
																		$from = $_GET['from'];
																		$to = $_GET['to']; 
																		
																		$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND DATE(tanggal_pengaduan) BETWEEN '$from' AND '$to' ORDER BY tanggal_pengaduan ASC");
																	}else if($_GET['tipe'] == "perbulan") {
																		$bulan = $_GET['bulan'];
																		$tahun = $_GET['tahun'];
																		
																		$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tanggal_pengaduan LIKE '$tahun-$bulan%' ORDER BY tanggal_pengaduan ASC");
																	}else if($_GET['tipe'] == "pertahun") {
																		$tahun = $_GET['tahun'];

																		$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tanggal_pengaduan LIKE '$tahun%' ORDER BY tanggal_pengaduan ASC");
																	}else {
																		$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang ORDER BY tanggal_pengaduan ASC");
																	}
																	
																}else {
																	$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang ORDER BY tanggal_pengaduan ASC");
																}
																
															}else {
																$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang ORDER BY tanggal_pengaduan ASC");	
															}
															while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
																?>
																<tr>
																	<td><?= $no++;?></td>
																	<td><?php echo formatDateIndonesia(date('d F Y', strtotime($row['tanggal_pengaduan'])));?></td>
																	<td><?php echo $row['nama_kecamatan'];?></td>
																	<td><?php echo $row['nama_kelurahan'];?></td>
																	<td><?php echo $row['usulan'];?></td>
																	<td><?php echo $row['permasalahan'];?></td>
																	<td><?php echo $row['nama_bidang'];?></td>
																	<td>
																		<div class="badge badge-success" data-toggle="modal" data-target="#exampleModal" data-nama_lokasi="<?php echo $row['keterangan'];?>" data-lat="<?php echo $row['lat'];?>"  data-lng="<?php echo $row['lng'];?>" style="cursor: pointer;">Titik Lokasi</div>
																	</td>
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