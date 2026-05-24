<?php
include 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM struk");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Struk</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">

<h1>Data Struk</h1>

<a href="index.php">Tambah Data</a>

<table>

<tr>
    <th>ID</th>
    <th>Nama Toko</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Keterangan</th>
</tr>

<?php while($d = mysqli_fetch_array($data)){ ?>

<tr>
    <td><?php echo $d['id']; ?></td>
    <td><?php echo $d['nama_toko']; ?></td>
    <td><?php echo $d['tanggal']; ?></td>
    <td>Rp <?php echo number_format($d['total']); ?></td>
    <td><?php echo $d['keterangan']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>