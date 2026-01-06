<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit;
}

include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<h2>Dashboard Admin</h2>

<div class="actions">
    <a href="tambah.php">➕ Tambah Hewan</a>
    <a href="logout.php" class="logout">🚪 Logout</a>
</div>


<table>
    <tr>
        <th>No</th>
        <th>Gambar</th>
        <th>Nama Hewan</th>
        <th>Kategori</th>
        <th>Habitat</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

<?php
$no = 1;
$query = mysqli_query($conn, "SELECT * FROM hewan ORDER BY id DESC");

if (mysqli_num_rows($query) == 0) {
    echo "<tr><td colspan='7' align='center'>Data belum ada</td></tr>";
}

while ($row = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td>
        <img src="../uploads/<?= $row['gambar']; ?>" width="70">
    </td>
    <td><?= $row['nama']; ?></td>
    <td><?= $row['kategori']; ?></td>
    <td><?= $row['habitat']; ?></td>
    <td class="deskripsi"><?= $row['deskripsi']; ?></td>
    <td>
        <a href="edit.php?id=<?= $row['id']; ?>" class="edit">✏️ Edit</a>
        <a href="hapus.php?id=<?= $row['id']; ?>" class="hapus"
   onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>

    </td>
</tr>
<?php } ?>

</table>

</body>
</html>
