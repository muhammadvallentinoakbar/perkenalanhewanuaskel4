<?php
include '../config/koneksi.php';
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM hewan WHERE id='$id'");
header("Location: dashboard.php");
