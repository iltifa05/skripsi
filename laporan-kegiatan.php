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
						<h4 class="page-title">Laporan Kegiatan</h4>
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
								<a href="armada">Laporan Kegiatan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card card-with-nav">
								<div class="card-header">
									<div class="row row-nav-line">
										<ul class="nav nav-tabs nav-line nav-color-secondary w-100 pl-3" role="tablist">
											<li class="nav-item"> <a class="nav-link active show" data-toggle="tab" href="#home" role="tab" aria-selected="true">Pertanggal</a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-selected="false">Perbulan</a> </li>
											<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab" aria-selected="false">Pertahun</a> </li>
										</ul>
									</div>
								</div>
								<div class="tab-content mt-3">
									<div class="tab-pane fade show active" id="home" role="tabpanel">
										<form action="print/c-kegiatan" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="tipe" value="pertanggal">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label for="dari" class="required-form"><b>Dari Tanggal</b></label>
															<input type="date" name="dari" class="form-control" required="" autocomplete="off" placeholder="Dari">
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label for="sampai" class="required-form"><b>Sampai Tanggal</b></label>
															<input type="date" name="sampai" class="form-control" required="" autocomplete="off" placeholder="Sampai">
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer">
												<div class="row">
													<div class="col-lg-12 col-md-12">
														<button type="submit" class="btn btn-primary btn-sm float-right">Cetak Laporan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel">
										<form action="print/c-kegiatan" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="tipe" value="perbulan">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label for="bulan" class="required-form"><b>Bulan</b></label>
															<select class="form-control selectric" name="bulan" required="" style="width: 100%;">
																<option value="">Pilih Bulan</option>
																<option value="01">Januari</option>
																<option value="02">Februari</option>
																<option value="03">Maret</option>
																<option value="04">April</option>
																<option value="05">Mei</option>
																<option value="06">Juni</option>
																<option value="07">Juli</option>
																<option value="08">Agustus</option>
																<option value="09">September</option>
																<option value="10">Oktober</option>
																<option value="11">November</option>
																<option value="12">Desember</option>
															</select>
														</div>
													</div>
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label for="tahun" class="required-form"><b>Tahun</b></label>
															<div class="select2-input">
																<select class="form-control select2" name="tahun" required="" style="width: 100%;">
																	<option value="">Pilih Tahun</option>
																	<?php
																	$mulai = date('Y') - 50;
																	for($i = $mulai; $i < $mulai + 100; $i++){
																		$sel = $i == date('Y') ? ' selected="selected"' : '';
																		?>
																		<option value="<?= $i;?>" <?= $sel;?>><?= $i;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer">
												<div class="row">
													<div class="col-lg-12 col-md-12">
														<button type="submit" class="btn btn-primary btn-sm float-right">Cetak Laporan</button>
													</div>
												</div>
											</div>
										</form>
									</div>
									<div class="tab-pane fade" id="settings" role="tabpanel">
										<form action="print/c-kegiatan" method="POST" enctype="multipart/form-data">
											<input type="hidden" name="tipe" value="pertahun">
											<div class="card-body">
												<div class="row">
													<div class="col-lg-6 col-md-12">
														<div class="form-group">
															<label for="tahun" class="required-form"><b>Tahun</b></label>
															<div class="select2-input">
																<select class="form-control select2" name="tahun" required="" style="width: 100%;">
																	<option value="">Pilih Tahun</option>
																	<?php
																	$mulai = date('Y') - 50;
																	for($i = $mulai; $i < $mulai + 100; $i++){
																		$sel = $i == date('Y') ? ' selected="selected"' : '';
																		?>
																		<option value="<?= $i;?>" <?= $sel;?>><?= $i;?></option>
																	<?php } ?>
																</select>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card-footer">
												<div class="row">
													<div class="col-lg-12 col-md-12">
														<button type="submit" class="btn btn-primary btn-sm float-right">Cetak Laporan</button>
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