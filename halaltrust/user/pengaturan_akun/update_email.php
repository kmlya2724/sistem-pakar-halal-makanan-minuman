<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Periksa apakah form di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $newEmail = $_POST['email'];
    $currentEmail = $_SESSION['email'];

    // Perbarui email di database
    $query = "UPDATE user SET email = ? WHERE email = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("ss", $newEmail, $currentEmail);

    if ($stmt->execute()) {
        // Update email di session
        $_SESSION['email'] = $newEmail;
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
    $connection->close();
}
?>