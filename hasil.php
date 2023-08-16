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
						<h4 class="page-title">Hasil Kegiatan</h4>
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
								<a href="hasil">Hasil Kegiatan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Hasil Kegiatan</h4>
										<?php if($online['level'] <> "Kecamatan") { ?>
										<a href="tambah-hasil" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i>
											Tambah
										</a>
										<?php } ?>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover datatables"	>
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
													<?php if($online['level'] <> "Kecamatan") { ?>
													<th style="text-align: center;">Aksi</th>
													<?php } ?>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$query = mysqli_query($conn, "SELECT * FROM tb_pembagian, tb_hasil WHERE tb_pembagian.id_pembagian=tb_hasil.id_pembagian ORDER BY date(tanggal_pembagian) DESC");
												while($row = mysqli_fetch_array($query)) {
													?>
													<tr>
														<td><?= $no++;?></td>
														<td><?= formatDateIndonesia(date('d F Y', strtotime($row['tanggal_pembagian'])));?></td>
														<td>
															<div class="badge badge-warning" data-toggle="modal" data-target="#exampleModal" data-id="<?php echo $row['id_pembagian'];?>" style="cursor: pointer;">Lihat Petugas</div>
														</td>
														<td>
															<div class="badge badge-warning" data-toggle="modal" data-target="#exampleModal2" data-id2="<?php echo $row['id_hasil'];?>" style="cursor: pointer;">Lihat Kegiatan</div>
														</td>
														<td><?php echo $row['volume'];?></td>
														<td><?php echo $row['satuan'];?></td>
														<td><?= $row['status_hasil'];?></td>
														<td><?= $row['keterangan_hasil'];?></td>
														<?php if($online['level'] <> "Kecamatan") { ?>
														<td align="center" style="white-space: nowrap;">
															<a href="detail-hasil?id=<?= $row['id_hasil'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
															<a href="" class="btn btn-danger btn-sm" id="delete-data" data-username="<?= $row['username'];?>" data-id="<?= $row['id_hasil'];?>"><i class="fas fa-trash-alt"></i></a>
														</td>
														<?php } ?>
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
		$(document).on('click','#delete-data', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var username = $(this).data('username');
			var SweetAlert2Demo = function() {
				var initDemos = function() {
					swal({
						title: 'Peringatan',
						text: "Apakah Anda yakin ingin menghapus data ini??",
						type: 'warning',
						icon: 'warning',
						buttons:{
							cancel: {
								visible: true,
								text : 'Tidak!',
								className: 'btn btn-danger'
							},
							confirm: {
								text : 'Ya, Hapus Saja!',
								className : 'btn btn-success'
							}
						}
					}).then((willDelete) => {
						if (willDelete) {
							$.ajax({
								type: "POST",
								url: "proses/delete-hasil.php",
								data: {'id':id, 'username':username},
								success: function(result) {
									var response = JSON.parse(result);
									if(response.status == "1") {
										customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'hasil');
									}else {
										customSweetAlert('Peringatan', response.message, 'error', 'danger');
									}
								}
							});
						} else {
							customSweetAlert('Pemberitahuan', 'Data tidak jadi dihapus', 'success', 'success');
						}
					});

				};
				return {
					init: function() {
						initDemos();
					},
				};
			}();
			jQuery(document).ready(function() {
				SweetAlert2Demo.init();
			});
		});
	</script>


<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">List Petugas</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="fetched-data"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#exampleModal').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('id');
				$.ajax({
					type : 'post',
					url : 'proses/get-petugas.php',
					data :  'rowid='+ rowid,
					success : function(data){
						$('.fetched-data').html(data);
					}
				});
			});
		});
	</script>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">List Foto Hasil Kegiatan</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container-fluid">
						<div class="fetched-data2"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$('#exampleModal2').on('show.bs.modal', function (e) {
				var rowid = $(e.relatedTarget).data('id2');
				$.ajax({
					type : 'post',
					url : 'proses/get-hasil.php',
					data :  'rowid='+ rowid,
					success : function(data){
						$('.fetched-data2').html(data);
					}
				});
			});
		});
	</script>
</body>
</html>