<?php
include('../../connection/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nama_bahan = $_POST['nama_bahan'];
        $link = $_POST['link'];

        $sql = "UPDATE bahan_haram SET nama_bahan = ?, link = ? WHERE bahan_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssi", $nama_bahan, $link, $id);

        if ($stmt->execute()) {
            header("Location: dash_list_haram.php");
        } else {
            echo "Terjadi kesalahan saat mengedit data.";
        }

        $stmt->close();
        $connection->close();
        exit();
    } else {
        $sql = "SELECT * FROM bahan_haram WHERE bahan_id = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        $stmt->close();
    }
} else {
    header("Location: dash_list_haram.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Bahan Haram</title>
    <link href="https://cdn.tailwindcss.com" rel="stylesheet">
</head>
<body>
    <form action="edit_bahan.php?id=<?php echo $id; ?>" method="POST" class="p-8">
        <div>
            <label for="nama_bahan" class="block text-gray-700">Nama Bahan:</label>
            <input type="text" id="nama_bahan" name="nama_bahan" class="border p-2 w-full" value="<?php echo $data['nama_bahan']; ?>" required>
        </div>
        <div class="mt-4">
            <label for="link" class="block text-gray-700">Link:</label>
            <input type="text" id="link" name="link" class="border p-2 w-full" value="<?php echo $data['link']; ?>">
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-green-500 text-white p-2 rounded">Update</button>
        </div>
    </form>
</body>
</html>