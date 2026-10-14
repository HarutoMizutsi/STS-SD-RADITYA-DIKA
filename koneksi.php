<?php
$conn = mysqli_connect("localhost", "root", "", "db_laporan_fasilitas");

if (!$conn) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

?>