<?php
include '../../config/koneksi.php';

// Ambil data dari database
$query = "SELECT * FROM parkir";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data parkir</title>
</head>
<body>
    <h2>Daftar parkir</h2>
    <a href="daftar.php"><button>Tambah parkir</button></a>
    <br><br>
    <table border="1">
        <tr>
            <th>id parkir</th>
            <th>tempat parkir</th>
            <th>jam masuk</th>
            <th>jam keluar</th>
            <th>biaya</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $row['id_parkir']; ?></td>
            <td><?= $row['tempat_parkir']; ?></td>
            <td><?= $row['jam_masuk']; ?></td>
            <td><?= $row['jam_keluar']; ?></td>
            <td><?= $row['biaya']; ?></td>
            <td>
            <a href="edit.php?id=<?= $row['id_parkir']; ?>">Edit</a> |
            <a href="delete.php?id=<?= $row['id_parkir']; ?>" 
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
