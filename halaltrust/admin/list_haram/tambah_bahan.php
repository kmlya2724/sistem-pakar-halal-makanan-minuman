<?php
include('../../connection/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_bahan = $_POST['nama_bahan'];
    $link = $_POST['link'];

    $sql = "INSERT INTO bahan_haram (nama_bahan, link) VALUES (?, ?)";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $nama_bahan, $link);

    if ($stmt->execute()) {
        header("Location: dash_list_haram.php");
    } else {
        echo "Terjadi kesalahan saat menambah data.";
    }

    $stmt->close();
    $connection->close();
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Bahan Haram</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
    <form action="tambah_bahan.php" method="POST" class="p-8">
        <div>
            <label for="nama_bahan" class="block text-gray-700">Nama Bahan:</label>
            <input type="text" id="nama_bahan" name="nama_bahan" class="border p-2 w-full" required>
        </div>
        <div class="mt-4">
            <label for="link" class="block text-gray-700">Link:</label>
            <input type="text" id="link" name="link" class="border p-2 w-full">
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded">Simpan</button>
        </div>
    </form>
</body>
</html>