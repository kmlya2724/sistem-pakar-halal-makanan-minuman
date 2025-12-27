<?php
include('../../connection/connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM bahan_haram WHERE bahan_id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: dash_list_haram.php");
    } else {
        echo "Terjadi kesalahan saat menghapus data.";
    }

    $stmt->close();
    $connection->close();
}
?>