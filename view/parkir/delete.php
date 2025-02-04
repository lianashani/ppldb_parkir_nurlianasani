<?php
include '../../config/koneksi.php';

// Periksa apakah ada ID yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus data
    $query = "DELETE FROM parkir WHERE id_parkir = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $delete = mysqli_stmt_execute($stmt);

    if ($delete) {
        header("Location: index.php"); // Redirect setelah hapus berhasil
        exit;
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
