<!DOCTYPE html>
<html>
<head>
    <title>Input Struk</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="container">

<h1>Input Data Struk</h1>

<form action="simpan.php" method="POST">

    <label>Nama Toko</label>
    <input type="text" name="nama_toko">

    <label>Tanggal</label>
    <input type="date" name="tanggal">

    <label>Total</label>
    <input type="number" name="total">

    <label>Keterangan</label>
    <textarea name="keterangan"></textarea>

    <button type="submit">Simpan</button>

</form>

<a href="tampil.php">Lihat Data</a>

</div>

</body>

</html>