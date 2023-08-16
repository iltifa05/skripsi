<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_tujuan, tb_jadwal, tb_pembagian WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pembagian.id_jadwal = tb_jadwal.id_jadwal AND id_pembagian = '$id'");
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
						<h4 class="page-title">Detail Pembagian Tugas</h4>
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
								<a href="pembagian">Pembagian Tugas</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-pembagian?id=<?= $id;?>">Detail Pembagian Tugas</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Pembagian Tugas</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_pembagian" value="<?= $row['id_pembagian'];?>">
									<div class="card-body">
										<div class="row">
												<div class="col-lg-6 col-md-12">
													<div class="form-group">
														<label for="tanggal_pembagian" class="required-form"><b>Tanggal Tugas</b></label>
														<input type="date" name="tanggal_pembagian" class="form-control" required="" autocomplete="off" placeholder="Dari" autofocus="" value="<?= $row['tanggal_pembagian'];?>">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="id_jadwal">Kecamatan - Kelurahan - Usulan - Permasalahan</label>
														<select class="form-control select2" name="id_jadwal" id="id_jadwal" required="" style="width: 100%;">
															<option value="<?php echo $row['id_jadwal'];?>"><?php echo $row['keterangan'];?></option>
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan ORDER BY DATE(tanggal_jadwal) DESC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_jadwal'];?>" <?php if($row['id_jadwal'] == $row2['id_jadwal']) {echo "selected=''";} ?>><?php echo $row2['nama_kecamatan'];?> | <?php echo $row2['nama_kelurahan'];?> | <?php echo $row2['usulan'];?> | <?php echo $row2['permasalahan'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<h5>Data Filter Pembagian Tugas Petugas</h5>
												<div class="table-responsive">
													<table class="table table-bordered">
														<thead>
															<tr>
																<th>Nama Petugas</th>
																<th width="5%">
																	<button type="button" class="btn btn-primary btn-sm btn-tambah"><i class="fas fa-plus"></i></button>
																</th>
															</tr>
														</thead>
														<tbody id="data-pembagian"></tbody>
													</table>
												</div>
											</div>
										</div>
									</div>

									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="pembagian" class="btn btn-danger btn-sm">Kembali</a>
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
	</script>
	<script type="text/javascript">
		$("#id_kecamatan").on('change', function(){
			// var id_kecamatan = $(this).val();
      	var id_kecamatan = $("#id_kecamatan").val();
			$.ajax({
				type: 'POST',
				url: "proses/get-kelurahan.php",
				data: {id_kecamatan: id_kecamatan},
				cache: false,
				success: function(msg){
					$("#id_kelurahan").html(msg);
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-pembagian.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'pembagian');
						}else {
							customSweetAlert('Peringatan', response.message, 'error', 'danger', null);
						}
					}
				});
				return false;
			});
		});
	</script>
	<script type="text/javascript">
		function selectRefresh() {
			$('#data-pembagian .select2').select2({
				width: '100%',
				theme: "bootstrap"
			});
		}

		$(function(){
			var count = 0;
			var id_pembagian = $('#id_pembagian').val();

			<?php
			$id_pembagian = $row['id_pembagian'];
			$queryGetDetail = mysqli_query($conn, "SELECT * FROM tb_pembagianbantu WHERE id_pembagian = '$id_pembagian'");
			$count = mysqli_num_rows($queryGetDetail);
			if($count > 0) {
				while($rowGetDetail = mysqli_fetch_array($queryGetDetail)) { ?>
					count += 1;
						$('#data-pembagian').append(`
							<tr>

						<td>
						<div class="select2-input" style="margin-top: 13px !important;">
						<select class="form-control select2" name="id_petugas[]" id="id_petugas-`+count+`" required="">
							<option value="">Pilih Petugas</option>
							<?php
							$querySelect = mysqli_query($conn, "SELECT * FROM tb_petugas  ORDER BY nama_petugas ASC");
							while($rowSelect = mysqli_fetch_array($querySelect)) {
								if($rowGetDetail['id_petugas'] == $rowSelect['id_petugas']) {$pilih= "selected=''";}else{$pilih= "";}
								echo "<option value='".$rowSelect['id_petugas']."' ".$pilih.">".$rowSelect['nip_petugas']." | ".$rowSelect['nama_petugas']."</option>";
							}
							?>
						</select>
						</div>
						</td>
						
							<td>
							<button type="button" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash-alt"></i></button>
							</td>
							</tr>
							`);

					selectRefresh();

					$('.btn-hapus').on('click', function(){
						$(this).closest("tr").remove();
						count -= 1;
					})
				<?php } } ?>

			$('.btn-tambah').on('click', function(e){
				e.preventDefault();

				count += 1;
					$('#data-pembagian').append(`
						<tr>
						<td>
						<div class="select2-input" style="margin-top: 13px !important;">
						<select class="form-control select2" name="id_petugas[]" id="id_petugas-`+count+`" required="">
							<option value="">Pilih Petugas</option>
							<?php
							$querySelect = mysqli_query($conn, "SELECT * FROM tb_petugas WHERE status_petugas='0' ORDER BY nama_petugas ASC");
							while($rowSelect = mysqli_fetch_array($querySelect)) {
								echo "<option value='".$rowSelect['id_petugas']."'>".$rowSelect['nip_petugas']." | ".$rowSelect['nama_petugas']."</option>";
							}
							?>
						</select>
						</div>
						</td>

						<td>
						<button type="button" class="btn btn-danger btn-sm btn-hapus"><i class="fas fa-trash-alt"></i></button>
						</td>
						</tr>
						`);

				selectRefresh();

				$('.btn-hapus').on('click', function(){
					$(this).closest("tr").remove();
					count -= 1;
				})
			})
		})
	</script>
</body>
</html>