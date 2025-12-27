<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    // Validasi apakah password baru dan konfirmasi password sesuai
    if ($new_password !== $confirm_password) {
        echo "Password baru dan konfirmasi password tidak cocok.";
        exit();
    }

    // Ambil password saat ini dari database
    $query = "SELECT password FROM user WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($current_password);
    $stmt->fetch();
    $stmt->close();

    // Verifikasi apakah password lama benar
    if ($old_password !== $current_password) {
        echo "Password lama tidak sesuai.";
        exit();
    }

    // Perbarui password baru di database
    $update_query = "UPDATE user SET password = ? WHERE email = ?";
    $stmt = $connection->prepare($update_query);
    $stmt->bind_param("ss", $new_password, $email);
    
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Gagal memperbarui password.";
    }
    $stmt->close();
}
?>