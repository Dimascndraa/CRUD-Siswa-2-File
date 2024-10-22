<?php
require 'functions.php'; // Panggil logic

// Tambah siswa
if (isset($_POST['tambah'])) {
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $alamat = htmlspecialchars($_POST['alamat']);
    tambahSiswa($nama, $kelas, $alamat);
    header("Location: index.php");
}

// Hapus siswa
if (isset($_GET['hapus'])) {
    hapusSiswa($_GET['hapus']);
    header("Location: index.php");
}

// Edit siswa
if (isset($_POST['edit'])) {
    $id = htmlspecialchars($_POST['id']);
    $nama = htmlspecialchars($_POST['nama']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $alamat = htmlspecialchars($_POST['alamat']);
    editSiswa($id, $nama, $kelas, $alamat);
    header("Location: index.php");
}

// Ambil data siswa (jika ada ID untuk edit)
$siswaEdit = isset($_GET['edit']) ? getSiswaById($_GET['edit']) : null;
$siswaList = getAllSiswa();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Sederhana - Siswa</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Data Siswa</h1>

        <!-- Form Tambah / Edit -->
        <form action="" method="post" class="mb-4">
            <input type="hidden" name="id" value="<?= $siswaEdit['id'] ?? ''; ?>">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?= $siswaEdit['nama'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kelas" class="form-label">Kelas</label>
                <input type="text" class="form-control" name="kelas" id="kelas" placeholder="Kelas" value="<?= $siswaEdit['kelas'] ?? ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat" required><?= $siswaEdit['alamat'] ?? ''; ?></textarea>
            </div>
            <button type="submit" name="<?= $siswaEdit ? 'edit' : 'tambah'; ?>" class="btn btn-primary">
                <?= $siswaEdit ? 'Edit' : 'Tambah'; ?>
            </button>
        </form>

        <!-- Tabel Data Siswa -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                foreach ($siswaList as $siswa): ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $siswa['nama']; ?></td>
                        <td><?= $siswa['kelas']; ?></td>
                        <td><?= $siswa['alamat']; ?></td>
                        <td>
                            <a href="index.php?edit=<?= $siswa['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="index.php?hapus=<?= $siswa['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Link JS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>