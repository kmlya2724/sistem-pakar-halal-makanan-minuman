<?php
session_start();
include 'connection/connection.php';

$error = '';
if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Hapus error setelah ditampilkan
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validasi input
    if (!empty($email) && !empty($password)) {
        if (strlen($password) < 8 || !preg_match('/[a-z]/', $password) || !preg_match('/[A-Z]/', $password)) {
            $_SESSION['error'] = "Password harus minimal 8 karakter dan berisi huruf kecil dan huruf besar.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = "Format email tidak valid.";
        } else {
            // Cek apakah email sudah terdaftar
            $checkQuery = "SELECT * FROM `user` WHERE email = ?";
            $stmt = mysqli_prepare($connection, $checkQuery);
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($result && mysqli_num_rows($result) > 0) {
                $_SESSION['error'] = "Email sudah digunakan.";
            } else {
                // Simpan data pengguna baru ke database tanpa hashing password
                $insertQuery = "INSERT INTO `user` (username, password, email) VALUES (?, ?, ?)";
                $stmt = mysqli_prepare($connection, $insertQuery);
                $username = explode('@', $email)[0]; // Username default dari email
                mysqli_stmt_bind_param($stmt, "sss", $username, $password, $email);

                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['success'] = "Pendaftaran berhasil. Silakan login.";
                    header("Location: login.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Terjadi kesalahan saat mendaftar.";
                }
            }
        }
    } else {
        $_SESSION['error'] = "Silakan isi semua kolom.";
    }

    header("Location: register.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HalalTrust</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('assets/login/bg_log.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
        }
        .btn-hover {
            transition: box-shadow 0.3s ease;
        }
        .btn-hover:hover {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.25);
        }
        input::placeholder {
            color: #CCCCCC;
        }
        input:focus {
            border-color: #0F52BA;
            outline: none;
        }
        .border-separator {
            border-right-width: 2px;
            border-color: #CCCCCC;
        }
        .close-button:hover img {
            filter: brightness(0) saturate(100%) invert(28%) sepia(91%) saturate(4796%) hue-rotate(350deg) brightness(92%) contrast(105%);
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg w-full max-w-3xl" style="border-radius: 4px;">
        <!-- Header -->
        <div class="bg-[#F6F6F6] flex justify-between items-center" style="border-radius: 4px 4px 0 0; padding: 16px; height: 46px;">
            <h2 style="color: #0F52BA; margin-left: 14px;">Daftar</h2>
            <a href="login.php" class="close-button">
                <img src="assets/login/x_log.svg" alt="Close Icon" width="26" height="26">
            </a>
        </div>

        <!-- Konten Utama -->
        <div class="p-8">
            <form method="POST" action="register.php">
                <div class="flex justify-center items-start">
                    <!-- Masuk -->
                    <div class="w-1/2 pr-4 border-separator">
                        <div class="mb-4 relative">
                            <input class="w-full px-10 py-2 border-2 rounded" type="email" id="email" name="email" placeholder="Email" style="border-color: #0F52BA;">
                            <img src="assets/login/email_log.svg" alt="Email Icon" class="absolute left-3 top-2.5 w-5 h-5">
                        </div>
                        <div class="mb-4 relative">
                            <input class="w-full px-10 py-2 border-2 rounded" type="password" id="password" name="password" placeholder="Password" style="border-color: #0F52BA;">
                            <img src="assets/login/kunci_log.svg" alt="Password Icon" class="absolute left-3 top-2.5 w-5 h-5">
                            <button type="button" onclick="togglePassword()" class="absolute right-3 top-2.5">
                                <img src="assets/login/mata_log.svg" alt="Show Password Icon" id="toggleIcon" class="w-5 h-5">
                            </button>
                        </div>
                        <p class="text-sm" style="font-size: 10px; color: #999999; margin-top: -14px;">Minimal 8 karakter dan minimal berisi huruf kecil dan huruf besar</p>
                        <?php if (isset($error)): ?>
                            <p class="mt-2" style="color: #D1001F;"><?php echo $error; ?></p>
                        <?php endif; ?>
                        <button type="submit" class="w-full text-white py-2 btn-hover mt-6" style="background-color: #0F52BA; border-radius: 4px;">Daftar</button>
                    </div>

                    <script>
                        function togglePassword() {
                            const passwordField = document.getElementById('password');
                            const toggleIcon = document.getElementById('toggleIcon');
                            if (passwordField.type === 'password') {
                                passwordField.type = 'text';
                                toggleIcon.src = 'assets/login/mata_sembunyi_log.svg';
                            } else {
                                passwordField.type = 'password';
                                toggleIcon.src = 'assets/login/mata_log.svg';
                            }
                        }
                    </script>

                    <!-- Daftar -->
                    <div class="w-1/2 pl-4 flex flex-col items-center justify-center mt-10">
                        <p class="mb-4">Sudah punya akun?</p>
                        <a class="w-full text-white py-2 btn-hover flex items-center justify-center" style="background-color: #0F52BA; border-radius: 4px;" href="login.php">Masuk</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Hapus pesan error dari session saat halaman di-refresh
        window.onload = function() {
            <?php unset($_SESSION['error']); ?>
        }
    </script>
</body>
</html>
