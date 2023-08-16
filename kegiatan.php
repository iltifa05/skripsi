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
						<h4 class="page-title">Kegiatan</h4>
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
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Kegiatan</h4>
										<a href="tambah-kegiatan" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i>
											Tambah
										</a>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table class="display table table-striped table-hover datatables"	>
											<thead>
												<tr>
													<th>No</th>
													<th>Tanggal Kegiatan</th>
													<th>Jam Kegiatan</th>
													<th>Nama Kegiatan</th>
													<th>Nama Dinas</th>
													<th style="text-align: center;">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$query = mysqli_query($conn, "SELECT * FROM tb_kegiatan, tb_jadwal, tb_dinas WHERE tb_kegiatan.id_jadwal=tb_jadwal.id_jadwal AND tb_dinas.id_dinas=tb_jadwal.id_dinas ORDER BY date(tanggal_kegiatan) DESC");
												while($row = mysqli_fetch_array($query)) {
													?>
													<tr>
														<td><?= $no++;?></td>
														<td><?= formatDateIndonesia(date('d F Y', strtotime($row['tanggal_kegiatan'])));?></td>
														<td><?= formatDateIndonesia(date('H:i', strtotime($row['jam_kegiatan'])));?> - <?= formatDateIndonesia(date('H:i', strtotime($row['sampai_kegiatan'])));?></td>
														<td><?= $row['nama_kegiatan'];?></td>
														<td><?= $row['nama_dinas'];?></td>
														<td align="center" style="white-space: nowrap;">
															<a href="detail-kegiatan?id=<?= $row['id_kegiatan'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
															<a href="" class="btn btn-danger btn-sm" id="delete-data" data-username="<?= $row['username'];?>" data-id="<?= $row['id_kegiatan'];?>"><i class="fas fa-trash-alt"></i></a>
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
								url: "proses/delete-kegiatan.php",
								data: {'id':id, 'username':username},
								success: function(result) {
									var response = JSON.parse(result);
									if(response.status == "1") {
										customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'kegiatan');
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
					url : 'proses/get-kegiatan.php',
					data :  'rowid='+ rowid,
					success : function(data){
						$('.fetched-data').html(data);
					}
				});
			});
		});
	</script>
</body>
</html>