<?php
include '../../config/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $plat_no = trim($_POST['plat_no']);
    $jenis_kendaraan = trim($_POST['jenis_kendaraan']);

    // Validasi input tidak boleh kosong
    if (empty($plat_no) || empty($jenis_kendaraan)) {
        echo "<script>alert('Semua kolom harus diisi!'); window.location.href='daftar.php';</script>";
        exit;
    }

    // Query Insert
    $query = "INSERT INTO kendaraan (plat_no, jenis_kendaraan) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $plat_no, $jenis_kendaraan);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kendaraan</title>
</head>
<body>
    <h2>Tambah Kendaraan</h2>
    <form action="daftar.php" method="post">
        <label>Plat Nomor:</label>
        <input type="text" name="plat_no" required><br>
        <label>Jenis Kendaraan:</label>
        <input type="text" name="jenis_kendaraan" required><br>
        <button type="submit">Simpan</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>
