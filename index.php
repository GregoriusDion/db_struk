<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Restoran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div>
                <h2>Menu Restoran</h2>
                <p>Tambah Data Menu Baru</p>
            </div>
        </div>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'berhasil'): ?>
            <div class="alert alert-success">Data menu berhasil disimpan.</div>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
            <div class="alert alert-error">Gagal menyimpan data. Coba lagi.</div>
        <?php endif; ?>

        <form action="simpan.php" method="POST" class="form">

            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input 
                    type="text" 
                    id="nama_menu" 
                    name="nama_menu" 
                    placeholder="Contoh: Nasi Goreng Spesial"
                    required
                >
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="" disabled selected>-- Pilih Kategori --</option>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                    <option value="Snack">Snack</option>
                    <option value="Dessert">Dessert</option>
                </select>
            </div>

            <div class="form-group">
                <label for="harga">Harga (Rp)</label>
                <input 
                    type="number" 
                    id="harga" 
                    name="harga" 
                    placeholder="Contoh: 25000"
                    min="0"
                    required
                >
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Simpan Menu</button>
                <a href="tampil.php" class="btn btn-secondary">Lihat Semua Menu</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>
