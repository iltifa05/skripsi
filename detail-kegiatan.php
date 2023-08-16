<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_kegiatan WHERE id_kegiatan = '$id'");
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
						<h4 class="page-title">Detail Kegiatan</h4>
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
								<a href="kegiatan">Kegiatan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-kegiatan?id=<?= $id;?>">Detail Kegiatan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Kegiatan</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_kegiatan" value="<?= $row['id_kegiatan'];?>">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="tanggal_kegiatan" class="required-form"><b>Tanggal Kegiatan</b></label>
													<input type="date" id="tanggal_kegiatan" name="tanggal_kegiatan" class="form-control" required="" autocomplete="off" placeholder="Tanggal Kegiatan" autofocus value="<?= $row['tanggal_kegiatan'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="jam_kegiatan" class="required-form"><b>Jam Kegiatan</b></label>
													<input type="time" id="jam_kegiatan" name="jam_kegiatan" class="form-control" required="" autocomplete="off" value="<?= $row['jam_kegiatan'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="sampai_kegiatan" class="required-form"><b>Sampai Kegiatan</b></label>
													<input type="time" id="sampai_kegiatan" name="sampai_kegiatan" class="form-control" required="" autocomplete="off" value="<?= $row['sampai_kegiatan'];?>">
												</div>
											</div>
											<div class="col-lg-6 col-md-12">
												<div class="form-group">
													<label for="nama_kegiatan" class="required-form"><b>Nama Kegiatan</b></label>
													<input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" required="" autocomplete="off" minlength="1" maxlength="100" placeholder="Nama Kegiatan" value="<?= $row['nama_kegiatan'];?>">
												</div>
											</div>
										</div>
										</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="kegiatan" class="btn btn-danger btn-sm">Kembali</a>
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
		function selectRefresh() {
			$('#data-petugas .select2').select2({
				width: '100%',
				theme: "bootstrap"
			});
		}

		$(function(){
			var count = 0;
			var id_kegiatan = $('#id_kegiatan').val();

			<?php
			$id_kegiatan = $row['id_kegiatan'];
			$queryGetDetail = mysqli_query($conn, "SELECT * FROM tb_kegiatanbantu WHERE id_kegiatan = '$id_kegiatan'");
			$count = mysqli_num_rows($queryGetDetail);
			if($count > 0) {
				while($rowGetDetail = mysqli_fetch_array($queryGetDetail)) { ?>
					count += 1;
						$('#data-petugas').append(`
							<tr>
						<td>
						<div class="select2-input" style="margin-top: 13px !important;">
						<select class="form-control select2" name="id_petugas[]" id="id_petugas-`+count+`" required="">
							<option value="">Pilih Nama Petugas</option>
							<?php
							$query2 = mysqli_query($conn, "SELECT * FROM tb_petugas ORDER BY nama_petugas ASC");
							while($row2 = mysqli_fetch_array($query2)) {
								?>
								<option value="<?php echo $row2['id_petugas'];?>" <?php if($row['id_petugas'] == $rowGetDetail['id_petugas']) {echo "selected=''";} ?>><?php echo $row2['nama_petugas'];?></option>
							<?php } ?>
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
					$('#data-petugas').append(`
					<tr>
						<td>
						<div class="select2-input" style="margin-top: 13px !important;">
						<select class="form-control select2" name="id_petugas[]" id="id_petugas-`+count+`" required="">
							<option value="">Pilih Nama Petugas</option>
							<?php
							$query = mysqli_query($conn, "SELECT * FROM tb_petugas ORDER BY nama_petugas ASC");
							while($row = mysqli_fetch_array($query)) {
								?>
								<option value="<?php echo $row['id_petugas'];?>"><?php echo $row['nama_petugas'];?></option>
							<?php } ?>
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
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-kegiatan.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'kegiatan');
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