<?php

include 'koneksi.php';

$nama_toko = $_POST['nama_toko'];
$tanggal = $_POST['tanggal'];
$total = $_POST['total'];
$keterangan = $_POST['keterangan'];

mysqli_query($conn, "
    INSERT INTO struk
    VALUES(
        '',
        '$nama_toko',
        '$tanggal',
        '$total',
        '$keterangan'
    )
");

header("Location: tampil.php");

?>