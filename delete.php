<?php
include 'koneksi.php';

// Ambil parameter 'id' yang dikirim dari URL index.php
$id = $_GET['id_laporan'] ?? '';

if (!empty($id)) {
    // Gunakan nama kolom database yang benar ('id_laporan') pada WHERE clause
    $sql = "DELETE FROM laporan_kerusakan WHERE id_laporan = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header("Location: index.php#daftar-laporan");
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit;
}
?>