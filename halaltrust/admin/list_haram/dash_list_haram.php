<?php
session_start();
include('../../connection/connection.php');

if (!isset($_SESSION['email'])) {
    header("Location: ../../login.php");
    exit();
}

// Ambil username dari database
$email = $_SESSION['email'];
$sql = "SELECT username FROM `admin` WHERE email = ?";
$stmt = $connection->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row['username'];
} else {
    $username = "Admin"; // Default jika username tidak ditemukan
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HalalTrust</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Acme&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-size: 16px;
            overflow: ;
        }
        html {
                scroll-behavior: smooth;
        }
        .btn-hover {
            transition: box-shadow 0.3s ease;
        }

        .btn-hover:hover {
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.25);
        }
        .scrollable-container {
            overflow-x: auto;
            overflow-y: auto;
            max-height: 300px;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="container mx-auto flex justify-between items-center" style="background-color: #8ACEF1; height: 80px; width: 100%; z-index: 1000;">
        <div class="flex items-center">
            <img alt="Logo HalalTrust" style="margin-left: 64px;" width="48" height="48" src="../../assets/landing_page/logo_halaltrust_land.svg"/>
            <span style="font-family: 'Acme', sans-serif; font-size: 32px; color: #0F52BA; margin-left: 16px;">HalalTrust</span>
        </div>
    </header>

    <!-- Main Content -->
    <div class="flex p-8">
        <!-- Sidebar -->
        <div style="margin-left: 20px; margin-top: 20px;">
            <div class="flex items-center mb-4">
                <img src="../../assets/dashboard/ikon_user_dash.svg" alt="Ikon User" width="48"/>
                <h2 style="font-size: 26px; color: #0F52BA; margin-left: 18px;"><?php echo htmlspecialchars($username); ?></h2>
            </div>
            <div class="shadow-md bg-[#D9D9D9]" style="border-radius: 4px; width: 588px;">
                <a href="#" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style=" border-top: 4px solid #0F52BA; height: 52px;">
                    <img src="../../assets/dashboard/list_haram_dash.svg" alt="Ikon Cek Produk" width="24"/>
                    <span class="ml-4 text-lg">List Haram</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="kirim_pertanyaan/dash_kirim_pertanyaan.php" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="height: 52px;">
                    <img src="../../assets/dashboard/pertanyaan_user_dash.svg" alt="Ikon Kirim Pertanyaan" width="24"/>
                    <span class="ml-4 text-lg">Pertanyaan User</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="detail_pribadi/dash_detail_pribadi.php" class="flex items-center p-4 border-b-4 border-[#999999] hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="height: 52px;">
                    <img src="../../assets/dashboard/detail_pribadi_dash.svg" alt="Ikon Detail Pribadi" width="24"/>
                    <span class="ml-4 text-lg">Detail Pribadi</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
                <a href="pengaturan_akun/dash_pengaturan_akun.php" class="flex items-center p-4 hover:bg-[#B4E4FB] focus:bg-[#B4E4FB]" style="width: px; height: 44px;">
                    <img src="../../assets/dashboard/pengaturan_akun_dash.svg" alt="Ikon Pengaturan Akun" width="24"/>
                    <span class="ml-4 text-lg">Pengaturan Akun</span>
                    <img src="../../assets/dashboard/chevron_dash.svg" alt="Ikon Chevron" class="ml-auto" width="16"/>
                </a>
            </div>
            <button class="mt-4 text-white py-2 px-4 btn-hover" style="background-color: #D1001F; border-radius: 4px;" onclick="logout()">Keluar</button>
            <script>
                function logout() {
                    // Kirim permintaan logout ke logout.php
                    window.location.href = '../../logout.php';
                }
            </script>
        </div>

        <!-- Main Panel -->
        <div class="w-3/4" style="margin-right: 20px; margin-left: 24px;">
            <div class="text-center" style="font-size: 26px; color: #0F52BA; margin-top: 28px;">
                <p>List Haram</p>
            </div>
            <hr style="border: none; border-top: 4px solid #0F52BA; margin: 17px 0;">
            <div class="bg-white p-8 shadow-md" style="border-radius: 4px; margin-top: -10px; width: 820px; height: 352px;">
                `<!-- Ikon Tambah Data di Pojok Kanan Atas -->
                <div class="flex justify-end">
                    <a href="javascript:void(0);" id="addData" style="margin-bottom: 12px;">
                        <img src="../../assets/dashboard/tambah_data_dash.svg" alt="Tambah" class="w-6 h-6 cursor-pointer">
                    </a>
                </div>
                
                <!-- Container untuk Tabel Data -->
                <div class="scrollable-container" style="padding-bottom: 12px; overflow-x: auto; overflow-y: auto; max-height: 260px;">
                    <!-- Tambahkan overflow-x, overflow-y, dan max-height di sini -->
                    <style>
                        /* Tambahkan CSS untuk mengontrol pemecahan teks */
                        table {
                            table-layout: fixed; /* Membuat kolom tabel memiliki lebar tetap */
                            width: 100%; /* Memastikan tabel menggunakan lebar maksimum yang diizinkan */
                        }

                        td, th {
                            word-wrap: break-word; /* Pecah kata yang panjang */
                            word-break: break-word; /* Pecah kata panjang yang tidak sesuai lebar */
                            white-space: normal; /* Teks bisa turun ke baris baru */
                        }
                    </style>
                    <table class="min-w-full bg-white border text-center">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-r" style="width: 10%;">ID</th>
                                <th class="px-6 py-3 border-b border-r">Nama Bahan</th>
                                <th class="px-6 py-3 border-b border-r" style="width: 15%;">Link</th>
                                <th class="px-6 py-3 border-b" style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil data dari tabel bahan_haram
                            $sql = "SELECT * FROM bahan_haram";
                            $result = $connection->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td class='px-6 py-4 border-b border-r' style='width: 10%;'>{$row['bahan_id']}</td>";
                                    echo "<td class='px-6 py-4 border-b border-r'>{$row['nama_bahan']}</td>";
                                    echo "<td class='px-6 py-4 border-b border-r' style='width: 15%; color: #0F52BA;'><a href='{$row['link']}' target='_blank'>Lihat</a></td>";
                                    echo "<td class='px-6 py-4 border-b' style='width: 15%;'>";
                                    echo "<a href='javascript:void(0);' class='editData' data-id='{$row['bahan_id']}'>
                                            <img src='../../assets/dashboard/edit_data_dash.svg' alt='Edit' class='w-5 h-5 inline-block cursor-pointer'>
                                        </a>";
                                    echo "<a href='hapus_bahan.php?id={$row['bahan_id']}' class='ml-2'>
                                            <img src='../../assets/dashboard/hapus_data_dash.svg' alt='Hapus' class='w-5 h-5 inline-block cursor-pointer'>
                                        </a>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center py-4'>Tidak ada data.</td></tr>";
                            }

                            $connection->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <script>
                // Script untuk membuka form tambah data
                document.getElementById('addData').addEventListener('click', function() {
                    window.location.href = 'tambah_bahan.php';
                });

                // Script untuk mengedit data langsung di tabel
                document.querySelectorAll('.editData').forEach(function(element) {
                    element.addEventListener('click', function() {
                        const id = this.getAttribute('data-id');
                        window.location.href = `edit_bahan.php?id=${id}`;
                    });
                });
            </script>
        </div>
    </div>

    <!-- Footer -->
    <footer class="container mx-auto flex items-center py-4 px-6" style="background-color: #8ACEF1; height: 256px; width: 100%;">
        <div class="flex items-center w-full">
            <div class="flex items-center">
                <img alt="Logo HalalTrust" style="margin-left: 40px;" width="160" height="160" src="../../assets/landing_page/logo_halaltrust_land.svg"/>
            </div>
            <div class="flex space-x-16" style="margin-left: 120px;">
                <div>
                    <h3 style="font-size: 26px; margin-bottom: 8px;">Tautan Penting</h3>
                    <hr style="border: none; border-bottom: 4px solid #0F52BA; width: 176%; margin-bottom: 12px;"/>
                    <ul class="space-y-2">
                        <li><a class="hover:underline" href="#">Syarat Penggunaan</a></li>
                        <li><a class="hover:underline" href="#">Kebijakan Privasi</a></li>
                        <li><a class="hover:underline" href="#">Kirim Masukan</a></li>
                    </ul>
                </div>
                <div style="margin-left: 274px;">
                    <h3 style="font-size: 26px; margin-bottom: 8px;">Kontak</h3>
                    <hr style="border: none; border-bottom: 4px solid #0F52BA; width: 160%; margin-bottom: 12px;"/>
                    <ul class="space-y-2">
                        <li>
                            <img src="../../assets/landing_page/telfon_land.svg" alt="Ikon Telepon" class="inline-block mr-2" width="24"/>
                            021-xxxxxxxx
                        </li>
                        <li>
                            <img src="../../assets/landing_page/email_land.svg" alt="Ikon Email" class="inline-block mr-2" width="24"/>
                            Kelompok6@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>