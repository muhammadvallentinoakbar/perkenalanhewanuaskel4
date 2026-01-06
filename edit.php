<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
}

include '../config/koneksi.php';

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hewan WHERE id='$id'"));

if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $habitat = $_POST['habitat'];
    $deskripsi = $_POST['deskripsi'];

    if (!empty($_FILES['gambar']['name'])) {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "../uploads/" . $gambar);

        mysqli_query($conn, "UPDATE hewan SET
            nama='$nama',
            kategori='$kategori',
            habitat='$habitat',
            deskripsi='$deskripsi',
            gambar='$gambar'
            WHERE id='$id'
        ");
    } else {
        mysqli_query($conn, "UPDATE hewan SET
            nama='$nama',
            kategori='$kategori',
            habitat='$habitat',
            deskripsi='$deskripsi'
            WHERE id='$id'
        ");
    }

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Hewan</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="form-box">
<h2>Edit Hewan</h2>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="nama" value="<?= $data['nama']; ?>" required>

    <select name="kategori" required>
        <option value="Herbivora" <?= $data['kategori']=="Herbivora"?"selected":""; ?>>Herbivora</option>
        <option value="Karnivora" <?= $data['kategori']=="Karnivora"?"selected":""; ?>>Karnivora</option>
        <option value="Omnivora" <?= $data['kategori']=="Omnivora"?"selected":""; ?>>Omnivora</option>
    </select>

    <input type="text" name="habitat" value="<?= $data['habitat']; ?>" required>

    <textarea name="deskripsi" required><?= $data['deskripsi']; ?></textarea>

    <img src="../uploads/<?= $data['gambar']; ?>" width="120"><br><br>

    <input type="file" name="gambar">
    <button name="update">Update</button>
</form>
</div>

</body>
</html>
