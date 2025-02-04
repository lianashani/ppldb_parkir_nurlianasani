<?php
include '../../config/koneksi.php';

// Ambil data dari database
$query = "SELECT * FROM kendaraan";
$result = mysqli_query($conn, $query);

// Cek jika query error
if (!$result) {
    die("Query error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kendaraan</title>
</head>
<body>
    <h2>Daftar Kendaraan</h2>
    <a href="daftar.php"><button>Tambah Kendaraan</button></a>
    <br><br>
    <table border="1">
        <tr>
            <th>Id Kendaraan</th>
            <th>Plat Nomor</th>
            <th>Jenis Kendaraan</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id_kendaraan']); ?></td>
            <td><?= htmlspecialchars($row['plat_no']); ?></td>
            <td><?= htmlspecialchars($row['jenis_kendaraan']); ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id_kendaraan']; ?>">Edit</a> |
                <a href="delete.php?id=<?= $row['id_kendaraan']; ?>" 
                   onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                   Delete
                </a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>

<?php mysqli_close($conn); ?>
