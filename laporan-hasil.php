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
						<h4 class="page-title">Laporan Hasil Kegiatan</h4>
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
								<a href="hasil">Laporan Hasil Kegiatan</a>
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
															<a href="print/c-hasil?tipe=pertanggal&from=<?= $from; ?>&to=<?= $to; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else if($_GET['tipe'] == "perbulan") { 
															$bulan = $_GET['bulan'];
															$tahun = $_GET['tahun'];
															?>
															<a href="print/c-hasil?tipe=perbulan&bulan=<?= $bulan; ?>&tahun=<?= $tahun; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else if($_GET['tipe'] == "pertahun") { 
															$tahun = $_GET['tahun'];
															?>
															<a href="print/c-hasil?tipe=pertahun&tahun=<?= $tahun; ?>" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php }else { ?>
															<a href="print/c-hasil" target="_blank" class="btn btn-success">
																<i class="fas fa-print"></i>
															</a>
														<?php } ?>

													<?php }else { ?>
														<a href="print/c-hasil" target="_blank" class="btn btn-success">
															<i class="fas fa-print"></i>
														</a>
													<?php } ?>

												<?php }else { ?>
													<a href="print/c-hasil" target="_blank" class="btn btn-success">
														<i class="fas fa-print"></i>
													</a>
													<?php } ?>
													<a href="laporan-hasil" class="btn btn-warning">
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
																<th>Tanggal Kegiatan</th>
																<th>List Petugas</th>
																<th>Foto Kegiatan</th>
																<th>Volume</th>
																<th>Satuan</th>
																<th>Status</th>
																<th>Keterangan</th>
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
																		
																		$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND DATE(tanggal_hasil) BETWEEN '$from' AND '$to' ORDER BY tanggal_hasil ASC");
																	}else if($_GET['tipe'] == "perbulan") {
																		$bulan = $_GET['bulan'];
																		$tahun = $_GET['tahun'];
																		
																		$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tanggal_hasil LIKE '$tahun-$bulan%' ORDER BY tanggal_hasil ASC");
																	}else if($_GET['tipe'] == "pertahun") {
																		$tahun = $_GET['tahun'];

																		$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian AND tanggal_hasil LIKE '$tahun%' ORDER BY tanggal_hasil ASC");
																	}else {
																		$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian ORDER BY tanggal_hasil ASC");
																	}
																	
																}else {
																	$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian ORDER BY tanggal_hasil ASC");
																}
																
															}else {
																$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian ORDER BY tanggal_hasil ASC");	
															}
															while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
																$id = $row['id_pembagian'];
																$nama_petugas = array();
																$kueri_jadwal = mysqli_query($conn, "SELECT * FROM tb_petugas,tb_pembagian,tb_pembagianbantu WHERE tb_pembagianbantu.id_petugas=tb_petugas.id_petugas AND tb_pembagianbantu.id_pembagian=tb_pembagian.id_pembagian AND tb_pembagianbantu.id_pembagian = '$id'");
																$nama_petugas = array();
																while($row_jadwal = mysqli_fetch_array($kueri_jadwal)){
																	$nama_petugas[] = $row_jadwal['nama_petugas'];
																}
																$nama_petugas = implode("<br>", $nama_petugas);

																$pisahdata=array();
																$pisahdata = explode(", " , $row['upload_foto']);
																?>
																<tr>
																	<td><?= $no++;?></td>
																	<td><?= formatDateIndonesia(date('d F Y', strtotime($row['tanggal_pembagian'])));?></td>
																	<td><?php echo $nama_petugas;?></td>
																	<td>
																	<img src="assets/img/hasil/<?php echo $pisahdata[0];?>" alt="profil" class="img-thumbnail elevation-2" style="width: 5rem;">
																	</td>
																	<td><?php echo $row['volume'];?></td>
																	<td><?php echo $row['satuan'];?></td>
																	<td><?= $row['status_hasil'];?></td>
																	<td><?= $row['keterangan_hasil'];?></td>
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