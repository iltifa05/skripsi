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
						<h4 class="page-title">Bidang</h4>
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
								<a href="bidang">Bidang</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Bidang</h4>
										<a href="tambah-bidang" class="btn btn-primary btn-round ml-auto">
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
													<th>Nama Bidang</th>
													<th style="text-align: center;">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$query = mysqli_query($conn, "SELECT * FROM tb_bidang ORDER BY nama_bidang ASC");
												while($row = mysqli_fetch_array($query)) {
													?>
													<tr>
														<td><?= $no++;?></td>
														<td><?= $row['nama_bidang'];?></td>
														<td align="center" style="white-space: nowrap;">
															<a href="detail-bidang?id=<?= $row['id_bidang'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
															<a href="" class="btn btn-danger btn-sm" id="delete-data" data-id="<?= $row['id_bidang'];?>"><i class="fas fa-trash-alt"></i></a>
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
								url: "proses/delete-bidang.php",
								data: {'id':id},
								success: function(result) {
									var response = JSON.parse(result);
									if(response.status == "1") {
										customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'bidang');
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
</body>
</html>