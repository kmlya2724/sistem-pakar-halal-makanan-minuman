<?php
include('../../connection/connection.php'); // Pastikan file connection.php sudah terkoneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $komposisiInput = strtolower(trim($_POST['komposisi'])); // Konversi ke huruf kecil dan hapus spasi ekstra
    $bahanArray = array_map('trim', explode(",", $komposisiInput)); // Pecah input berdasarkan koma dan hapus spasi ekstra

    // Query untuk mendapatkan semua bahan haram beserta link-nya
    $query = "SELECT LOWER(REPLACE(nama_bahan, '_', ' ')) as nama_bahan, link FROM bahan_haram";
    $result = mysqli_query($connection, $query);

    $bahanHaramList = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $bahanHaramList[] = [
            'nama_bahan' => $row['nama_bahan'],
            'link' => $row['link']
        ];
    }

    // Cek apakah ada bahan haram dalam input
    $detectedHaram = [];
    foreach ($bahanArray as $bahan) {
        $bahan = trim($bahan); // Hilangkan spasi ekstra
        foreach ($bahanHaramList as $haramItem) {
            if ($haramItem['nama_bahan'] === $bahan) {
                $detectedHaram[] = $haramItem;
            }
        }
    }

    // Kirim hasil pengecekan dalam format JSON
    if (!empty($detectedHaram)) {
        echo json_encode(['status' => 'haram', 'bahan' => $detectedHaram]);
    } else {
        echo json_encode(['status' => 'halal']);
    }
}
?>