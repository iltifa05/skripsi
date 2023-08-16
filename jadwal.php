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
	if($online['level'] <> "Administrator") {
		header("Location: " . getBaseURL());
		exit();
	}
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
						<h4 class="page-title">Jadwal Survei</h4>
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
								<a href="jadwal">Jadwal Survei</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Jadwal Survei</h4>
										<a href="tambah-jadwal" class="btn btn-primary btn-round ml-auto">
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
													<th>Tanggal </th>
													<th>Kecamatan</th>
													<th>Kelurahan</th>
													<th>Usulan</th>
													<th>Permasalahan</th>
													<th>Bidang</th>
													<th>Status Kelanjutan / Kebutuhan</th>
													<th>Titik Lokasi</th>
													<th style="text-align: center;">Aksi</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan ORDER BY DATE(tanggal_jadwal) DESC");
												while($row = mysqli_fetch_array($query)) {
													?>
													<tr>
														<td><?= $no++;?></td>
														<td><?php echo formatDateIndonesia(date('d F Y', strtotime($row['tanggal_jadwal'])));?> s/d <?php echo formatDateIndonesia(date('d F Y', strtotime($row['sampai_tanggal'])));?></td>
														<td><?php echo $row['nama_kecamatan'];?></td>
														<td><?php echo $row['nama_kelurahan'];?></td>
														<td><?php echo $row['usulan'];?></td>
														<td><?php echo $row['permasalahan'];?></td>
														<td><?php echo $row['nama_bidang'];?></td>
														<td><?php echo $row['keterangan'];?></td>
														<td>
															<div class="badge badge-success" data-toggle="modal" data-target="#exampleModal" data-nama_lokasi="<?php echo $row['keterangan'];?>" data-lat="<?php echo $row['lat'];?>"  data-lng="<?php echo $row['lng'];?>" style="cursor: pointer;">Titik Lokasi</div>
														</td>
														<td align="center" style="white-space: nowrap;">
															<a href="detail-jadwal?id=<?= $row['id_jadwal'];?>" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
															<a href="" class="btn btn-danger btn-sm" id="delete-data" data-id="<?= $row['id_jadwal'];?>"><i class="fas fa-trash-alt"></i></a>
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
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Titik Koordinat</h5>
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
				var nama = $(e.relatedTarget).data('keterangan');
				var lat = $(e.relatedTarget).data('lat');
				var lng = $(e.relatedTarget).data('lng');
				$.ajax({
					type : 'post',
					url : 'proses/get-titik.php',
					// data :  'rowid='+ rowid, 
					data: {'nama':nama, 'lat':lat, 'lng':lng},
					success : function(data){
						$('.fetched-data').html(data);
					}
				});
			});
		});
	</script>
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
								url: "proses/delete-jadwal.php",
								data: {'id':id},
								success: function(result) {
									var response = JSON.parse(result);
									if(response.status == "1") {
										customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'jadwal');
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