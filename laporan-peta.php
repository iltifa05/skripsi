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
    <link rel="stylesheet" href="leaflet/leaflet.css" />
    <script src="leaflet/leaflet.js"></script>
     <link rel="stylesheet" href="leaflet/fullscreen/Control.FullScreen.css" />
     <script src="leaflet/fullscreen/Control.FullScreen.js"></script> 

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" />
    <link rel="stylesheet" href="rute/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="rute/index.css" />
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
						<h4 class="page-title">Laporan Grafik Gografis Pengaduan (Peta)</h4>
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
								<a href="pengaduan">Laporan Grafik Gografis Pengaduan (Peta)</a>
							</li>
						</ul>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
									<div id="map" style="width:100%;height:500px;"></div>
									<script src="rute/dist/leaflet-routing-machine.js"></script>
    <script src="rute/Control.Geocoder.js"></script>
    <script src="rute/config.js"></script>
    <script type="text/javascript">

  var watchID;
         var geoLoc;

         function showLocation(position) {
            var latitude = position.coords.latitude;
            var longitude = position.coords.longitude;
         }

         function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            }

            else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         }

        var map = L.map('map', {
            center: new L.LatLng(-3.827050, 114.799008),
            zoom: 10,
            fullscreenControl: true,
            fullscreenControlOptions: { // optional
                title:"Tampilkan FullScreen",
                titleCancel:"Tutup FullScreen"
            }
        });

        var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
        map.addLayer(layer);

    <?php 
    $arrBounds = [];
    $qmodal = mysqli_query($conn, "SELECT * FROM tb_pengaduan ORDER BY id_pengaduan ASC");
    while($tampil = mysqli_fetch_array($qmodal)){
        $arrBounds[] = [$tampil["lat"], $tampil["lng"]];
    ?>
        var myIcon = L.icon({
        iconUrl: 'pengaduan.png',
        iconSize: [40, 40], // size of the icon
        });
        var marker = L.marker([<?php echo $tampil["lat"] ?>,<?php echo $tampil["lng"] ?>], {icon: myIcon}).addTo(map);
		marker.bindPopup('Usulan : <?php echo $tampil["usulan"] ?>', {
			maxWidth : 560
        });

      <?php } ?>
      map.fitBounds(<?= json_encode($arrBounds);?>);

         function getLocationUpdate(){
            if(navigator.geolocation){
               // timeout at 60000 milliseconds (60 seconds)
               var options = {timeout:60000};
               geoLoc = navigator.geolocation;
               watchID = geoLoc.watchPosition(showLocation, errorHandler, options);

    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
	}).addTo(map);

		/*L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
		attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
		maxZoom: 18
		}).addTo(map);*/

		//   map.locate({setView: true, maxZoom: 16});
		function onLocationFound(e) {
			// var radius = e.accuracy / 2;
			L.marker(e.latlng).addTo(map)
				.bindPopup("Lokasi Anda").openPopup();
				// .bindPopup("You are within " + radius + " meters from this point").openPopup();
			L.circle(e.latlng, radius).addTo(map);
		}
		map.on('locationfound', onLocationFound);
				}
				else{
				alert("Sorry, browser does not support geolocation!");
				}
			}




	getLocationUpdate();
	</script>
	<style type="text/css">
		.ppcont{width: 300px; height: 250px;}
	</style>
						<!-- Batas Isi Form -->

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