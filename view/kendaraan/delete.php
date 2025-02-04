<?php
include '../../config/koneksi.php';

// ambil ID kendaraan dari URL
$id = $_GET['id'];

// apus kendaraan dr ID
$query = "DELETE FROM kendaraan WHERE id_kendaraan = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);

if (mysqli_stmt_execute($stmt)) {
    echo "<script>alert('Data berhasil dihapus!'); window.location.href='index.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
