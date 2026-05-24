<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Menu Restoran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
include 'koneksi.php';

// ===== PROSES HAPUS =====
if (isset($_GET['hapus'])) {
    $id_hapus = (int) $_GET['hapus'];
    $sql_hapus = "DELETE FROM struk WHERE id=$id_hapus";
    mysqli_query($koneksi, $sql_hapus);
    header("Location: tampil.php?status=hapus_berhasil");
    exit;
}

// ===== AMBIL DATA EDIT =====
$data_edit = null;
if (isset($_GET['edit'])) {
    $id_edit = (int) $_GET['edit'];
    $sql_edit = "SELECT * FROM struk WHERE id=$id_edit";
    $hasil_edit = mysqli_query($koneksi, $sql_edit);
    $data_edit = mysqli_fetch_assoc($hasil_edit);
}
?>

<div class="container">

    <!-- Form Edit -->
    <?php if ($data_edit): ?>
    <div class="card">
        <div class="card-header">
            <div>
                <h2>Edit Menu</h2>
                <p>Ubah data menu yang dipilih</p>
            </div>
        </div>

        <form action="simpan.php" method="POST" class="form">
            <input type="hidden" name="id" value="<?= $data_edit['id'] ?>">

            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input 
                    type="text" 
                    id="nama_menu" 
                    name="nama_menu" 
                    value="<?= htmlspecialchars($data_edit['nama_menu']) ?>"
                    required
                >
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <?php
                    $pilihan = ['Makanan', 'Minuman', 'Snack', 'Dessert'];
                    foreach ($pilihan as $p):
                        $selected = ($data_edit['kategori'] == $p) ? 'selected' : '';
                    ?>
                        <option value="<?= $p ?>" <?= $selected ?>><?= $p ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input 
                    type="number" 
                    id="harga" 
                    name="harga" 
                    value="<?= $data_edit['harga'] ?>"
                    min="0"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Update Menu</button>
                <a href="tampil.php" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
    <?php endif; ?>

    <!-- Notifikasi Status -->
    <?php if (isset($_GET['status'])): ?>
        <?php if ($_GET['status'] == 'edit_berhasil'): ?>
            <div class="alert alert-success">Data berhasil diupdate.</div>
        <?php elseif ($_GET['status'] == 'hapus_berhasil'): ?>
            <div class="alert alert-success">Data berhasil dihapus.</div>
        <?php elseif ($_GET['status'] == 'gagal'): ?>
            <div class="alert alert-error">Operasi gagal. Coba lagi.</div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Tabel Data -->
    <div class="card">
        <div class="card-header">
            <h2>Daftar Menu Restoran</h2>
            <a href="index.php" class="btn btn-secondary">+ Tambah Menu</a>
        </div>

        <?php
        $sql   = "SELECT * FROM struk ORDER BY id DESC";
        $hasil = mysqli_query($koneksi, $sql);
        $jumlah = mysqli_num_rows($hasil);
        ?>

        <?php if ($jumlah == 0): ?>
            <div class="empty-state">
                <p>Belum ada data menu. Tambah menu terlebih dahulu.</p>
                <a href="index.php" class="btn btn-primary">Tambah Sekarang</a>
            </div>
        <?php else: ?>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($baris = mysqli_fetch_assoc($hasil)):
                        ?>
                        <tr>
                            <td class="center"><?= $no++ ?></td>
                            <td><?= htmlspecialchars($baris['nama_menu']) ?></td>
                            <td>
                                <span class="badge badge-<?= strtolower($baris['kategori']) ?>">
                                    <?= $baris['kategori'] ?>
                                </span>
                            </td>
                            <td class="harga">Rp <?= number_format($baris['harga'], 0, ',', '.') ?></td>
                            <td class="center">
                                <a href="tampil.php?edit=<?= $baris['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="tampil.php?hapus=<?= $baris['id'] ?>" 
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus menu ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
            <p class="total-data">Total: <strong><?= $jumlah ?> menu</strong></p>
        <?php endif; ?>
    </div>

</div>

<?php mysqli_close($koneksi); ?>
</body>
</html>
