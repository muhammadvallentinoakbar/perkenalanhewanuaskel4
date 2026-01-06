<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama      = $_POST['nama'];
    $kategori  = $_POST['kategori'];
    $habitat   = $_POST['habitat'];
    $deskripsi = $_POST['deskripsi'];

    // ==== UPLOAD GAMBAR ====
    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];

    // nama file unik biar tidak ketimpa
    $nama_gambar = time() . "_" . $gambar;

    // pindahkan file
    move_uploaded_file($tmp, "../uploads/" . $nama_gambar);

    // ==== INSERT DATABASE ====
    mysqli_query($conn, "INSERT INTO hewan 
        (nama, kategori, habitat, deskripsi, gambar)
        VALUES
        ('$nama','$kategori','$habitat','$deskripsi','$nama_gambar')
    ");

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Hewan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="form-box">
<h2>Tambah Hewan</h2>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="nama" placeholder="Nama Hewan" required>

    <select name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        <option value="Herbivora">Herbivora</option>
        <option value="Karnivora">Karnivora</option>
        <option value="Omnivora">Omnivora</option>
    </select>

    <input type="text" name="habitat" placeholder="Habitat" required>

    <textarea name="deskripsi" placeholder="Deskripsi Hewan" required></textarea>

    <input type="file" name="gambar" required>

    <button type="submit" name="simpan">Simpan</button>
</form>
</div>

</body>
</html>
