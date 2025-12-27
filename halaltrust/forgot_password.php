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
        .close-button:hover img {
            filter: brightness(0) saturate(100%) invert(28%) sepia(91%) saturate(4796%) hue-rotate(350deg) brightness(92%) contrast(105%);
        }
        .footer {
            background-color: #0F52BA;
            color: white;
            text-align: center;
            padding: 14px;
            border-radius: 0 0 4px 4px;
        }
        .footer a {
            color: white;
            text-decoration: none;
            transition: text-decoration 0.3s;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg w-full max-w-md" style="border-radius: 4px;">
        <!-- Header -->
        <div class="bg-[#F6F6F6] flex justify-between items-center" style="border-radius: 4px 4px 0 0; padding: 16px; height: 46px;">
            <h2 style="color: #0F52BA; margin-left: 14px;">Lupa Password</h2>
            <a href="login.php" class="close-button">
                <img src="assets/login/x_log.svg" alt="Close Icon" width="26" height="26">
            </a>
        </div>

        <!-- Konten Utama -->
        <div class="p-8">
            <div class="flex justify-center items-start">
                <div class="w-full">
                    <div class="mb-4 relative">
                        <input class="w-full px-10 py-2 border-2 rounded" type="email" id="email" placeholder="Email" style="border-color: #0F52BA;">
                        <img src="assets/login/email_log.svg" alt="Email Icon" class="absolute left-3 top-2.5 w-5 h-5">
                    </div>
                    <button class="w-full text-white py-2 btn-hover" style="background-color: #0F52BA; border-radius: 4px;">Atur Ulang Password</button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <a href="login.php">Kembali ke halaman login</a>
        </div>
    </div>
</body>
</html>