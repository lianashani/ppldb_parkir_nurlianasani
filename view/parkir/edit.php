<?php
include '../../config/koneksi.php';

// Periksa apakah ada ID yang dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data parkir berdasarkan ID
    $query = "SELECT * FROM parkir WHERE id_parkir = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $data = mysqli_fetch_assoc($result);

    // Jika data tidak ditemukan
    if (!$data) {
        echo "Data tidak ditemukan!";
        exit;
    }
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tempat_parkir = $_POST['tempat_parkir'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];
    $biaya = $_POST['biaya'];

    // Query update
    $query = "UPDATE parkir SET tempat_parkir=?, jam_masuk=?, jam_keluar=?, biaya=? WHERE id_parkir=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "sssdi", $tempat_parkir, $jam_masuk, $jam_keluar, $biaya, $id);
    $update = mysqli_stmt_execute($stmt);

    if ($update) {
        header("Location: index.php"); // Redirect setelah update berhasil
        exit;
    } else {
        echo "Gagal mengupdate data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Parkir</title>
</head>
<body>
    <h2>Edit Data Parkir</h2>
    <form method="post">
        <label>Tempat Parkir:</label>
        <input type="text" name="tempat_parkir" value="<?= $data['tempat_parkir']; ?>" required><br>

        <label>Jam Masuk:</label>
        <input type="time" name="jam_masuk" value="<?= $data['jam_masuk']; ?>" required><br>

        <label>Jam Keluar:</label>
        <input type="time" name="jam_keluar" value="<?= $data['jam_keluar']; ?>" required><br>

        <label>Biaya:</label>
        <input type="number" name="biaya" value="<?= $data['biaya']; ?>" required><br>

        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
