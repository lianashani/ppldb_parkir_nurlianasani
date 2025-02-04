<?php
include '../../config/koneksi.php';

// aambil ID kendaraan dari link
$id = $_GET['id'];

// ambl data kendaraan dri ID
$query = "SELECT * FROM kendaraan WHERE id_kendaraan = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location.href='index.php';</script>";
    exit;
}

// klo disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $plat_no = trim($_POST['plat_no']);
    $jenis_kendaraan = trim($_POST['jenis_kendaraan']);

    // update data
    $updateQuery = "UPDATE kendaraan SET plat_no = ?, jenis_kendaraan = ? WHERE id_kendaraan = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssi", $plat_no, $jenis_kendaraan, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kendaraan</title>
</head>
<body>
    <h2>Edit Kendaraan</h2>
    <form action="" method="post">
        <label>Plat Nomor:</label>
        <input type="text" name="plat_no" value="<?= $data['plat_no']; ?>" required><br>
        <label>Jenis Kendaraan:</label>
        <input type="text" name="jenis_kendaraan" value="<?= $data['jenis_kendaraan']; ?>" required><br>
        <button type="submit">Simpan Perubahan</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
</body>
</html>
