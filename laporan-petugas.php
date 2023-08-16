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
						<h4 class="page-title">Laporan Pekerjaan Petugas</h4>
						
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Petugas</h4>
										<a href="print/c-petugas" target="_blank" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-print"></i>
											Cetak
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover datatables"	>
											<thead>
												<tr>
													<th>No</th>
													<th>Jabatan</th>
													<th>NIP</th>
													<th>Nama Petugas</th>
													<th>Tempat Lahir</th>
													<th>Tanggal Lahir</th>
													<th>Nomor Telepon</th>
													<th>Foto</th>
													<th>Username</th>
													<th>Status</th>
													<th>Jumlah Tugas</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$query = mysqli_query($conn, "SELECT * FROM tb_petugas, tb_jabatan WHERE tb_petugas.id_jabatan=tb_jabatan.id_jabatan ORDER BY nama_petugas ASC");
												while($row = mysqli_fetch_array($query)) {
													$query_petugas = mysqli_query($conn, "SELECT *, COUNT(*) AS jumlah FROM tb_petugas, tb_pembagianbantu WHERE tb_pembagianbantu.id_petugas=tb_petugas.id_petugas AND tb_pembagianbantu.id_petugas='$row[id_petugas]' ORDER BY nama_petugas ASC");
													$row_petugas = mysqli_fetch_array($query_petugas);
													if ($row['username']=='0'){
														$status = 'Belum Selesai';
													}else{
														$status = 'Selesai';
													}
													?>
													<tr>
														<td><?= $no++;?></td>
														<td><?= $row['nama_jabatan'];?></td>
														<td><?= $row['nip_petugas'];?></td>
														<td><?= $row['nama_petugas'];?></td>
														<td><?= $row['tempat_lahir'];?></td>
														<td><?= formatDateIndonesia(date('d F Y', strtotime($row['tanggal_lahir'])));?></td>
														<td><?= $row['nomor_petugas'];?></td>
														<td align="center">
															<a target="_blank" href="assets/img/petugas/<?= $row['upload_foto'];?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a>
														</td>
														<td><?= $row['username'];?></td>
														<td><?= $status;?></td>
														<td><?= $row_petugas['jumlah'];?></td>
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