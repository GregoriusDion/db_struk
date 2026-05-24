<?php
include 'koneksi.php';

// Cek apakah request dari form (POST)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form, bersihkan dulu biar aman
    $nama_menu = mysqli_real_escape_string($koneksi, $_POST['nama_menu']);
    $kategori  = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $harga     = (int) $_POST['harga'];

    // Cek apakah ini mode EDIT atau TAMBAH BARU
    if (isset($_POST['id']) && !empty($_POST['id'])) {

        // ===== MODE EDIT =====
        $id = (int) $_POST['id'];

        $sql = "UPDATE struk 
                SET nama_menu='$nama_menu', kategori='$kategori', harga=$harga 
                WHERE id=$id";

        $hasil = mysqli_query($koneksi, $sql);

        if ($hasil) {
            header("Location: tampil.php?status=edit_berhasil");
        } else {
            header("Location: tampil.php?status=gagal");
        }

    } else {

        // ===== MODE TAMBAH BARU =====
        $sql = "INSERT INTO struk (nama_menu, kategori, harga) 
                VALUES ('$nama_menu', '$kategori', $harga)";

        $hasil = mysqli_query($koneksi, $sql);

        if ($hasil) {
            header("Location: index.php?status=berhasil");
        } else {
            header("Location: index.php?status=gagal");
        }
    }

} else {
    // Kalau diakses langsung tanpa form, kembalikan ke index
    header("Location: index.php");
}

mysqli_close($koneksi);
exit;
?>
