<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_laporan'] ?? '';
    $status = $_POST['status'] ?? '';

    if (!empty($id) && !empty($status)) {
        // Query untuk mengupdate kolom status saja
        $sql = "UPDATE laporan_kerusakan SET status = '$status' WHERE id_laporan = '$id'";

        if (mysqli_query($conn, $sql)) {
            // Berhasil, kembalikan ke halaman daftar laporan
            header("Location: index.php#daftar-laporan");
            exit;
        } else {
            echo "Gagal mengubah status: " . mysqli_error($conn);
        }
    } else {
        header("Location: index.php#daftar-laporan");
        exit;
    }
}
?>