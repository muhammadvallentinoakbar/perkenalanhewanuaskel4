<?php
include 'config/koneksi.php';

// filter
$where = "";
if (isset($_GET['kategori']) && $_GET['kategori'] != "") {
    $kategori = $_GET['kategori'];
    $where = "WHERE kategori='$kategori'";
}

$query = mysqli_query($conn, "SELECT * FROM hewan $where ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perkenalan Hewan</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        .container {
            max-width: 1200px;
            margin: auto;
        }
        .filter {
            margin-bottom: 20px;
        }
        .filter a {
            padding: 8px 14px;
            border-radius: 20px;
            background: #e5e7eb;
            margin-right: 6px;
            font-size: 14px;
            color: #333;
        }
        .filter a.active {
            background: #2563eb;
            color: #fff;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px,1fr));
            gap: 20px;
        }
        .card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transition: transform .2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card-body {
            padding: 15px;
        }
        .card-body h3 {
            font-size: 18px;
            margin-bottom: 6px;
        }
        .badge {
            display: inline-block;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 12px;
            background: #f1f5f9;
            margin-bottom: 8px;
        }
        .card-body p {
            font-size: 14px;
            color: #555;
            line-height: 1.4;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="logo-title" style="display:flex; align-items:center; gap:15px; margin-bottom:20px;">
    <img src="https://i.imghippo.com/files/BsN6029cuo.png" alt="Logo Portfolio" style="height:50px;">
    <h2 style="margin:0; font-size:28px;">ZOO SURABAYA</h2>
</div>
    <a href="login.php" class="btn-login-admin">
    <span class="btn-text">Login Admin</span>
    <span class="btn-icon">
        <!-- Simple icon (user) -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="20" height="20">
            <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.9v2.4h19.2v-2.4c0-3.3-6.4-4.9-9.6-4.9z"/>
        </svg>
    </span>
</a>

<p style="margin-bottom: 20px; font-size: 16px; color: #2563eb; line-height:1.5;">
    Selamat datang di ZOO SURABAYA! Temukan keajaiban dunia hewan, pelajari habitat, kategori, dan fakta menarik dari setiap makhluk hidup. Yuk, jelajahi dunia satwa bersama kami!
</p>

</p>

    <!-- FILTER -->
    <div class="filter">
        <a href="index.php" class="<?= !isset($_GET['kategori']) ? 'active' : '' ?>">Semua</a>
        <a href="?kategori=Herbivora" class="<?= ($_GET['kategori'] ?? '')=='Herbivora'?'active':'' ?>">Herbivora</a>
        <a href="?kategori=Karnivora" class="<?= ($_GET['kategori'] ?? '')=='Karnivora'?'active':'' ?>">Karnivora</a>
        <a href="?kategori=Omnivora" class="<?= ($_GET['kategori'] ?? '')=='Omnivora'?'active':'' ?>">Omnivora</a>
    </div>

    <!-- LIST HEWAN -->
    <div class="grid">
        <?php if (mysqli_num_rows($query) == 0): ?>
            <p>Data hewan belum tersedia.</p>
        <?php endif; ?>

        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
            <div class="card">
                <img src="uploads/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>">
                <div class="card-body">
                    <span class="badge"><?= $row['kategori']; ?></span>
                    <h3><?= $row['nama']; ?></h3>
                    <p><strong>Habitat:</strong> <?= $row['habitat']; ?></p>
                    <p><?= substr($row['deskripsi'],0,90); ?>...</p>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
