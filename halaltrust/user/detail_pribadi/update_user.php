<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION['email'];
    $username = $_POST['username'];
    $agama = $_POST['agama']; // Sesuaikan dengan POST data yang benar
    $negara = $_POST['negara']; // Sesuaikan dengan POST data yang benar
    $jenis_kelamin = $_POST['jenis_kelamin']; // Sesuaikan dengan POST data yang benar

    // Lakukan update data pengguna berdasarkan email
    $query = "UPDATE `user` SET username = ?, agama = ?, negara = ?, jenis_kelamin = ? WHERE email = ?";
    $stmt = $connection->prepare($query);
    if ($stmt === false) {
        die('Kesalahan pada statement prepare: ' . $connection->error);
    }

    $stmt->bind_param('sssss', $username, $agama, $negara, $jenis_kelamin, $email);

    if ($stmt->execute()) {
        // Redirect jika berhasil
        header("Location: dash_detail_pribadi.php");
        exit();
    } else {
        echo "Gagal mengupdate data: " . $stmt->error;
    }

    $stmt->close();
}

$connection->close();
?>