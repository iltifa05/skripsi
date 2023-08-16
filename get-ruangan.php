<?php
    include("koneksi.php");
        if ($_GET['id_ruangan']==''){
            $data = array(
                'kapasitas_ruangan'      =>  '',
                'keterangan_ruangan'      =>  '',
                );
     echo json_encode($data);
     
        }else{
        $kueri = mysqli_query($conn, "SELECT * FROM tb_ruangan WHERE id_ruangan='$_GET[id_ruangan]'");
        $tampil = mysqli_fetch_array($kueri);

        $data = array(
                    'kapasitas_ruangan'      =>  $tampil['kapasitas_ruangan'],
                    'keterangan_ruangan'      =>  $tampil['keterangan_ruangan'],
                    );
         echo json_encode($data);
        }
?>