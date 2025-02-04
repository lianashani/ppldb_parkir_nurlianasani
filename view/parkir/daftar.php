<?php
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $tempat_parkir = $_POST['tempat_parkir'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];
    $biaya = $_POST['biaya'];

    // Validasi agar semua data terisi
    if (empty($tempat_parkir) || empty($jam_masuk) || empty($jam_keluar) || empty($biaya)) {
        echo "<script>alert('Semua kolom harus diisi!'); window.location.href='daftar.php';</script>";
        exit;
    }

    // Query INSERT menggunakan prepared statement
    $query = "INSERT INTO parkir (tempat_parkir, jam_masuk, jam_keluar, biaya) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssi", $tempat_parkir, $jam_masuk, $jam_keluar, $biaya);
    $insert = mysqli_stmt_execute($stmt);

    if ($insert) {
        // Redirect ke index.php setelah berhasil
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menambahkan data: " . mysqli_error($conn);
    }

    // Tutup statement
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Parkir</title>
</head>
<body>
    <h2>Tambah Data Parkir</h2>
    <form method="post">
        <label>Tempat Parkir:</label>
        <input type="text" name="tempat_parkir" required><br>

        <label>Jam Masuk:</label>
        <input type="time" name="jam_masuk" required><br>

        <label>Jam Keluar:</label>
        <input type="time" name="jam_keluar" required><br>

        <label>Biaya:</label>
        <input type="number" name="biaya" required><br>

        <button type="submit">Simpan</button>
        <a href="index.php"><button type="button">Kembali</button></a>
    </form>
</body>
</html>
