<?php
include 'koneksi.php';
if(!isset($_SESSION['login'])) {
	header("Location: " . getBaseURL());
	exit();
}
?>
<?php
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM tb_kelurahan, tb_pengaduan, tb_kecamatan WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan AND tb_pengaduan.id_kelurahan = tb_kelurahan.id_kelurahan AND id_pengaduan = '$id'");
$row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php';?>
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
	<style type="text/css">

		#map {
			height: 100%;
		}

		#description {
			font-family: Roboto;
			font-size: 15px;
			font-weight: 300;
		}

		#infowindow-content .title {
			font-weight: bold;
		}

		#infowindow-content {
			display: none;
		}

		#map #infowindow-content {
			display: inline;
		}

		.pac-card {
			background-color: #fff;
			border: 0;
			border-radius: 2px;
			box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
			margin: 10px;
			padding: 0 0.5em;
			font: 400 18px Roboto, Arial, sans-serif;
			overflow: hidden;
			font-family: Roboto;
			padding: 0;
		}

		#pac-container {
			padding-bottom: 12px;
			margin-right: 12px;
		}

		.pac-controls {
			display: inline-block;
			padding: 5px 11px;
		}

		.pac-controls label {
			font-family: Roboto;
			font-size: 13px;
			font-weight: 300;
		}

		#pac-input {
			background-color: #fff;
			font-family: Roboto;
			font-size: 15px;
			font-weight: 300;
			margin-left: 12px;
			padding: 0 11px 0 13px;
			text-overflow: ellipsis;
			width: 400px;
		}

		#pac-input:focus {
			border-color: #4d90fe;
		}

		#title {
			color: #fff;
			background-color: #4d90fe;
			font-size: 25px;
			font-weight: 500;
			padding: 6px 12px;
		}

		#target {
			width: 345px;
		}


	</style>
</style>
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
						<h4 class="page-title">Detail Pengaduan</h4>
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
								<a href="pengaduan">Pengaduan</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="detail-pengaduan?id=<?= $id;?>">Detail Pengaduan</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Detail Pengaduan</h4>
									</div>
								</div>
								<form action="" method="POST" enctype="multipart/form-data" id="data-form">
									<input type="hidden" name="id_pengaduan" value="<?= $row['id_pengaduan'];?>">
									<input type="hidden" name="place_id" id="place_id" value="<?= $row['place_id'];?>">
									<div class="card-body">
										<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="id_kelurahan">Kecamatan - Kelurahan</label>
														<select class="form-control select2" name="id_kelurahan"
															id="id_kelurahan" required="" style="width: 100%;" autofocus>
															<option value="">Pilih Kecamatan - Kelurahan</option>
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_kelurahan,tb_kecamatan WHERE tb_kelurahan.fk_kecamatan=tb_kecamatan.id_kecamatan ORDER BY nama_kecamatan ASC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_kelurahan'];?>" <?php if($row['id_kelurahan'] == $row2['id_kelurahan']) {echo "selected=''";} ?>><?php echo $row2['nama_kecamatan'];?> | <?php echo $row2['nama_kelurahan'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="id_bidang">Bidang</label>
														<select class="form-control select2" name="id_bidang"
															id="id_bidang" required="" style="width: 100%;" autofocus>
															<option value="">Pilih Bidang</option>
															<?php
															$query2 = mysqli_query($conn, "SELECT * FROM tb_bidang ORDER BY nama_bidang ASC");
															while($row2 = mysqli_fetch_array($query2)) {
																?>
																<option value="<?php echo $row2['id_bidang'];?>" <?php if($row['id_bidang'] == $row2['id_bidang']) {echo "selected=''";} ?>><?php echo $row2['nama_bidang'];?></option>
															<?php } ?>
														</select>
													</div>
												</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="tanggal_pengaduan">Tanggal Pengaduan</label>
										<input type="date" name="tanggal_pengaduan" id="tanggal_pengaduan" class="form-control" required="" autocomplete="off" placeholder="Tanggal Pengaduan" value="<?= $row['tanggal_pengaduan'];?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="usulan">Usulan</label>
										<input type="text" name="usulan" id="usulan" class="form-control" required="" autocomplete="off"  value="<?= $row['usulan'];?>" placeholder="Usulan">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="permasalahan">Permasalahan</label>
										<input type="text" name="permasalahan" id="permasalahan" class="form-control" required="" autocomplete="off"  value="<?= $row['permasalahan'];?>" placeholder="Permasalahan">
									</div>
								</div>

											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label>Map</label>
													<div class="col-lg-12 col-md-12">
														<div class="form-group">
															<input id="pac-input" class="controls" type="text" name="alamat_tambahan" placeholder="Cari Alamat" value="<?= $row['alamat_tambahan'];?>" />
															<div id="map" style="height: 400px; width: 100%;"></div>
														</div>
													</div>
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label>Latitude</label>
													<input class="form-control" type="text" placeholder="Isi latitude" id="latitude" onchange="setLocalStorage();"name="lat" required oninvalid="this.setCustomValidity('latitude tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row['lat'];?>">
												</div>
											</div>
											<div class="col-md-6 col-sm-12">
												<div class="form-group">
													<label>Longtitude</label>
													<input class="form-control" type="text" placeholder="Isi longtitude" id="longitude" name="lng" onchange="setLocalStorage();" required oninvalid="this.setCustomValidity('longtitude tidak boleh kosong')" oninput="setCustomValidity('')" value="<?= $row['lng'];?>">
												</div>
											</div>
										</div>
									</div>
									<div class="card-footer">
										<div class="row">
											<div class="col-lg-12 col-md-12">
												<a href="pengaduan" class="btn btn-danger btn-sm">Kembali</a>
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
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/update-pengaduan.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(result) {
						var response = JSON.parse(result);
						if(response.status == "1") {
							customSweetAlert('Pemberitahuan', response.message, 'success', 'success', 'pengaduan');
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
		function updateMarkerPosition(latLng) {
			document.getElementById('latitude').value = [latLng.lat()]
			document.getElementById('longitude').value = [latLng.lng()]
		}

		function initMap() {
			var latitude_ = $('#latitude').val();
			var longitude_ = $('#longitude').val();

			if(typeof latitude_ != "undefined" && typeof longitude_ != "undefined") {
				defaultLatLong = {
					lat: parseFloat(latitude_),
					lng: parseFloat(longitude_)
				};
			} else {
				defaultLatLong = {
					lat: 40.7127753,
					lng: -74.0059728
				};
			}

			var map = new google.maps.Map(document.getElementById('map'), {
				center: defaultLatLong,
				zoom: 15,
				mapTypeId: "roadmap",
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				scaleControl: true,
				streetViewControl: true,
				overviewMapControl: true,
				rotateControl: true
			});

			var input = document.getElementById('pac-input');
			var autocomplete = new google.maps.places.Autocomplete(input);

			autocomplete.bindTo('bounds', map);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

			const icons = {
				url: "https://maps.gstatic.com/mapfiles/place_api/icons/v1/png_71/geocode-71.png",
				size: new google.maps.Size(71, 71),
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(17, 34),
				scaledSize: new google.maps.Size(25, 25),
			};

			var marker = new google.maps.Marker({
				map: map,
				icon: icons,
				position: defaultLatLong,
				draggable: true,
				clickable: true
			});

			if(typeof latitude_ == "undefined" && typeof longitude_ == "undefined") {
				if (navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(position) {
						initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
						map.setCenter(initialLocation);
						marker.setPosition(initialLocation);

						var geocoder = new google.maps.Geocoder;

						latitude = position.coords.latitude;
						longitude = position.coords.longitude
						var latlng = {lat: parseFloat(latitude), lng: parseFloat(longitude)};

						geocoder.geocode({'location': latlng}, function(results, status) {
							if (status === google.maps.GeocoderStatus.OK) {
								if (results[0]) {
									$('#place_id').val(results[0].place_id);
									$('#pac-input').val(results[0].formatted_address);
								} else {
									customSweetAlert('Peringatan', 'Alamat tidak ditemukan', 'error', 'danger', null);
								}
							} else {
								customSweetAlert('Peringatan', 'Gagal mendapatkan geocoder: ' + status, 'error', 'danger', null);
							}
						});

						$('#latitude').val(position.coords.latitude);
						$('#longitude').val(position.coords.longitude);
					});
				}
			}

			google.maps.event.addListener(marker, 'dragend', function(marker) {
				updateMarkerPosition(marker.latLng);
				var latLng = marker.latLng;
				currentLatitude = latLng.lat();
				currentLongitude = latLng.lng();
				var latlng = {
					lat: currentLatitude,
					lng: currentLongitude
				};
				var geocoder = new google.maps.Geocoder;
				geocoder.geocode({
					'location': latlng
				}, function(results, status) {
					if (status === 'OK') {
						if (results[0]) {
							$('#place_id').val(results[0].place_id);
							input.value = results[0].formatted_address;
						} else {
							customSweetAlert('Peringatan', 'Alamat tidak ditemukan', 'error', 'danger', null);
						}
					} else {
						customSweetAlert('Peringatan', 'Gagal mendapatkan geocoder: ' + status, 'error', 'danger', null);
					}
				});
			});

			autocomplete.addListener('place_changed', function() {
				var place = autocomplete.getPlace();
				if (!place.geometry) {
					return;
				}
				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
				}

				marker.setPosition(place.geometry.location);

				updateMarkerPosition(place.geometry.location);

				currentLatitude = place.geometry.location.lat();
				currentLongitude = place.geometry.location.lng();
			});
		}
	</script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1MgLuZuyqR_OGY3ob3M52N46TDBRI_9k&libraries=places&callback=initMap" type="text/javascript"></script>
</body>
</html>