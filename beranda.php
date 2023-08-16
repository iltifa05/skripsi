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
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Selamat Datang <?= $online['nama_lengkap'];?></h2>
								<!-- <h5 class="text-white op-7 mb-2">Sistem Informasi Monitoring Sub Kontraktor di PT HRS</h5> -->
							</div>
						</div>
					</div>
				</div>
						<!-- <div class="row mt-2" id="printableArea">
							<div class="col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body">
										<h2 align="center" id="judul">Grafik Jumlah Kapal Datang Tahun <?= date('Y'); ?></h2><br>
										<div id="chart-container" style="height: 350px;">
											<canvas id="totalIncomeChart2"></canvas>
										</div>
										</div>
									</div>
								</div>
							</div>

							<div class="row mt-2" id="printableArea">
							<div class="col-lg-12 col-md-12">
								<div class="card">
									<div class="card-body">
										<h2 align="center" id="judul">Grafik Jumlah Kapal Berangkat Tahun <?= date('Y'); ?></h2><br>
										<div id="chart-container" style="height: 350px;">
											<canvas id="totalIncomeChart3"></canvas>
										</div>
										</div>
									</div>
								</div>
							</div> -->

							<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Data Jadwal Survei Belum Di Kerjakan</h4>
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
													<th>Status Kelanjutan / Kebutuhan</th>
													<th>Titik Lokasi</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$no = 1;
												$dari = date('Y-m-d');

												$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal, tb_pembagian WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND tb_pembagian.id_jadwal = tb_jadwal.id_jadwal ORDER BY DATE(tanggal_pembagian) DESC");
												while($row = mysqli_fetch_array($query)) {
													$ambil[] = "'".$row['id_jadwal']."'";
												}
												$hasil_array = implode(", ",$ambil);

												$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND id_jadwal NOT IN ($hasil_array) ORDER BY DATE(tanggal_jadwal) DESC");
												// $query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan, tb_bidang, tb_jadwal WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND tb_pengaduan.id_bidang = tb_bidang.id_bidang AND tb_jadwal.id_pengaduan = tb_pengaduan.id_pengaduan AND (date(tanggal_jadwal) BETWEEN '$dari' AND '$dari') ORDER BY DATE(tanggal_jadwal) DESC");
												while($row = mysqli_fetch_array($query)) {
													?>
													<tr>
														<td><?= $no++;?></td>
														<td><?php echo formatDateIndonesia(date('d F Y', strtotime($row['tanggal_jadwal'])));?> s/d <?php echo formatDateIndonesia(date('d F Y', strtotime($row['sampai_tanggal'])));?></td>
														<td><?php echo $row['nama_kecamatan'];?></td>
														<td><?php echo $row['nama_kelurahan'];?></td>
														<td><?php echo $row['keterangan'];?></td>
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
		<?php
			$tahun = date('Y');

			$labels = ['"Jan"', '"Feb"', '"Mar"', '"Apr"', '"Mei"', '"Jun"', '"Jul"', '"Agu"', '"Sep"', '"Okt"', '"Nov"', '"Des"'];
			$colors = ["#155399", "#00FC37", "#8A2BE2", "#A52A2A", "#FF7F50"];
			$labeled = implode(", ", $labels);

			$myColumn3 = array();
			$myColumn4 = array();
				$queryChart3 = mysqli_query($conn, "SELECT tb_kapal.id_kapal, tb_kapal.nama_kapal, Months.m AS bulan, IFNULL(COUNT(tb_datang.id_datang), 0) AS jumlah FROM (SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m) as Months LEFT JOIN tb_datang ON Months.m = MONTH(DATE_FORMAT(tb_datang.tanggal_datang, '%Y-%m-%d')) AND tb_datang.tanggal_datang LIKE '$tahun%' LEFT JOIN tb_kapal ON tb_datang.id_kapal = tb_kapal.id_kapal GROUP BY tb_datang.id_kapal, Months.m ORDER BY Months.m ASC");


			while($rowChart3 = mysqli_fetch_array($queryChart3)) {
				if(isset($rowChart3['jumlah']) && $rowChart3['jumlah'] != 0) {
					$myColumn3[$rowChart3['bulan']]['data'][$rowChart3['id_kapal']]['jumlah'] = $rowChart3['jumlah'];
					$myColumn3[$rowChart3['bulan']]['data'][$rowChart3['id_kapal']]['id'] = $rowChart3['id_kapal'];
					$myColumn3[$rowChart3['bulan']]['data'][$rowChart3['id_kapal']]['nama_kapal'] = $rowChart3['nama_kapal'];
					if($rowChart3['id_kapal'] != null) {
						$myColumn4[$rowChart3['id_kapal']]['id_kapal'] = $rowChart3['id_kapal'];
						$myColumn4[$rowChart3['id_kapal']]['nama_kapal'] = $rowChart3['nama_kapal'];
					}
					if($rowChart3['jumlah'] != 0) {
						$arrBulanTarget[$rowChart3['bulan']] = $rowChart3['bulan'];
					}
					$myColumn3[$rowChart3['bulan']]['list'][] = $rowChart3['id_kapal'];
				}else {
					$myColumn3[$rowChart3['bulan']]['data'] = [];
					$myColumn3[$rowChart3['bulan']]['list'] = [];
				}
			}

			foreach ($myColumn4 as $keys => $values) {
				foreach ($myColumn3 as $key => $value) {
					if(!in_array($values['id_kapal'], $value['list'])) {
						$myColumn3[$key]['data'][$values['id_kapal']]['jumlah'] = "0";
						$myColumn3[$key]['data'][$values['id_kapal']]['id'] = $values['id_kapal'];
						$myColumn3[$key]['data'][$values['id_kapal']]['nama_kapal'] = $values['nama_kapal'];
					}
				}
			}

			foreach ($myColumn3 as $key => $value) {
				unset($myColumn3[$key]['list']);
			}

			$myColumnCustom = [];
			foreach ($myColumn4 as $keys => $values) {
				foreach ($myColumn3 as $key => $value) {
					if(isset($value['data']) && !empty($value['data'])) {
						foreach ($value['data'] as $keyy => $valuee) {
							if($values['id_kapal'] == $keyy) {
								$myColumnCustom[$values['id_kapal']]['type'] = "bar";
								$myColumnCustom[$values['id_kapal']]['label'] = $valuee['nama_kapal'];
								$myColumnCustom[$values['id_kapal']]['yAxisID'] = "A";
								$myColumnCustom[$values['id_kapal']]['borderColor'] = "rgb(23, 125, 255)";
								$myColumnCustom[$values['id_kapal']]['data'][] = $valuee['jumlah'];
							}
						}
					}
				}
			}

			$myColumnCustom = array_values($myColumnCustom);

			foreach ($myColumnCustom as $key => $value) {
				$myColumnCustom[$key]['backgroundColor'] = $colors[$key];
			}

		?>

		var totalIncomeChart = document.getElementById('totalIncomeChart2').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: [<?= $labeled;?>],
				datasets : <?= json_encode($myColumnCustom);?>,
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: true,
				},
				scales: {
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Jumlah Kapal Datang'
						},
						id: 'A',
						position: 'left',
						ticks: {
							display: true
						},
						gridLines : {
							drawBorder: false,
							display : true
						},
						ticks: {
							beginAtZero : true,
							fixedStepSize : 1,
							callback: function(value, index, ticks) {
								return value;
							}
						}
					}],
					xAxes : [ {
						scaleLabel: {
							display: true,
							labelString: 'Tanggal'
						},
						gridLines : {
							drawBorder: false,
							display : true
						}
					}]
				}
			}
		});
</script>

<script type="text/javascript">
		<?php
			$tahun = date('Y');

			$labels = ['"Jan"', '"Feb"', '"Mar"', '"Apr"', '"Mei"', '"Jun"', '"Jul"', '"Agu"', '"Sep"', '"Okt"', '"Nov"', '"Des"'];
			$colors = ["#155399", "#00FC37", "#8A2BE2", "#A52A2A", "#FF7F50"];
			$labeled = implode(", ", $labels);

			$myColumn3 = array();
			$myColumn4 = array();
				$queryChart3 = mysqli_query($conn, "SELECT tb_kapal.id_kapal, tb_kapal.nama_kapal, Months.m AS bulan, IFNULL(COUNT(tb_berangkat.id_berangkat), 0) AS jumlah FROM (SELECT 1 as m UNION SELECT 2 as m UNION SELECT 3 as m UNION SELECT 4 as m UNION SELECT 5 as m UNION SELECT 6 as m UNION SELECT 7 as m UNION SELECT 8 as m UNION SELECT 9 as m UNION SELECT 10 as m UNION SELECT 11 as m UNION SELECT 12 as m) as Months LEFT JOIN tb_berangkat ON Months.m = MONTH(DATE_FORMAT(tb_berangkat.tanggal_berangkat, '%Y-%m-%d')) AND tb_berangkat.tanggal_berangkat LIKE '$tahun%' LEFT JOIN tb_kapal ON tb_berangkat.id_kapal = tb_kapal.id_kapal GROUP BY tb_berangkat.id_kapal, Months.m ORDER BY Months.m ASC");


			while($rowChart3 = mysqli_fetch_array($queryChart3)) {
				if(isset($rowChart3['jumlah']) && $rowChart3['jumlah'] != 0) {
					$myColumn3[$rowChart3['bulan']]['data'][$rowChart3['id_kapal']]['jumlah'] = $rowChart3['jumlah'];
					$myColumn3[$rowChart3['bulan']]['data'][$rowChart3['id_kapal']]['id'] = $rowChart3['id_kapal'];
					$myColumn3[$rowChart3['bulan']]['data'][$rowChart3['id_kapal']]['nama_kapal'] = $rowChart3['nama_kapal'];
					if($rowChart3['id_kapal'] != null) {
						$myColumn4[$rowChart3['id_kapal']]['id_kapal'] = $rowChart3['id_kapal'];
						$myColumn4[$rowChart3['id_kapal']]['nama_kapal'] = $rowChart3['nama_kapal'];
					}
					if($rowChart3['jumlah'] != 0) {
						$arrBulanTarget[$rowChart3['bulan']] = $rowChart3['bulan'];
					}
					$myColumn3[$rowChart3['bulan']]['list'][] = $rowChart3['id_kapal'];
				}else {
					$myColumn3[$rowChart3['bulan']]['data'] = [];
					$myColumn3[$rowChart3['bulan']]['list'] = [];
				}
			}

			foreach ($myColumn4 as $keys => $values) {
				foreach ($myColumn3 as $key => $value) {
					if(!in_array($values['id_kapal'], $value['list'])) {
						$myColumn3[$key]['data'][$values['id_kapal']]['jumlah'] = "0";
						$myColumn3[$key]['data'][$values['id_kapal']]['id'] = $values['id_kapal'];
						$myColumn3[$key]['data'][$values['id_kapal']]['nama_kapal'] = $values['nama_kapal'];
					}
				}
			}

			foreach ($myColumn3 as $key => $value) {
				unset($myColumn3[$key]['list']);
			}

			$myColumnCustom = [];
			foreach ($myColumn4 as $keys => $values) {
				foreach ($myColumn3 as $key => $value) {
					if(isset($value['data']) && !empty($value['data'])) {
						foreach ($value['data'] as $keyy => $valuee) {
							if($values['id_kapal'] == $keyy) {
								$myColumnCustom[$values['id_kapal']]['type'] = "bar";
								$myColumnCustom[$values['id_kapal']]['label'] = $valuee['nama_kapal'];
								$myColumnCustom[$values['id_kapal']]['yAxisID'] = "A";
								$myColumnCustom[$values['id_kapal']]['borderColor'] = "rgb(23, 125, 255)";
								$myColumnCustom[$values['id_kapal']]['data'][] = $valuee['jumlah'];
							}
						}
					}
				}
			}

			$myColumnCustom = array_values($myColumnCustom);

			foreach ($myColumnCustom as $key => $value) {
				$myColumnCustom[$key]['backgroundColor'] = $colors[$key];
			}

		?>

		var totalIncomeChart = document.getElementById('totalIncomeChart3').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: [<?= $labeled;?>],
				datasets : <?= json_encode($myColumnCustom);?>,
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: true,
				},
				scales: {
					yAxes: [{
						scaleLabel: {
							display: true,
							labelString: 'Jumlah Kapal Berangkat'
						},
						id: 'A',
						position: 'left',
						ticks: {
							display: true
						},
						gridLines : {
							drawBorder: false,
							display : true
						},
						ticks: {
							beginAtZero : true,
							fixedStepSize : 1,
							callback: function(value, index, ticks) {
								return value;
							}
						}
					}],
					xAxes : [ {
						scaleLabel: {
							display: true,
							labelString: 'Tanggal'
						},
						gridLines : {
							drawBorder: false,
							display : true
						}
					}]
				}
			}
		});
</script>
</body>
</html>