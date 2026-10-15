<?php
include 'koneksi.php';


// percobaan biar form nya bisa ngirim data ke database, tapi g bisa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $namapelapor = $_POST["nama_pelapor"] ?? "";
    $namafasilitas = $_POST["nama_fasilitas"] ?? "";
    $lokasikerusakan = $_POST["lokasi"] ?? "";
    $kategori = $_POST["id_kategori"] ?? "";;
    $deskripsi = $_POST["deskripsi"] ?? "";
    $prioritas = $_POST["prioritas"] ?? "";


    $sql = "INSERT INTO laporan_kerusakan (nama_pelapor, nama_fasilitas, lokasi, id_kategori, deskripsi, prioritas)
            VALUES ('$namapelapor', '$namafasilitas', '$lokasikerusakan', '$kategori', '$deskripsi', '$prioritas')";

}

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if (isset($_POST["nama"]) && !empty($namapelapor)) {
//         $laporan_kerusakan = mysqli_query($conn, "INSERT INTO laporan_kerusakan VALUE $namapelapor");
//     }
// }
// if (!empty($namapelapor) && !empty($namafasilitas) && !empty($lokasikerusakan) && !empty($kategori) && !empty($deskripsi) && !empty($prioritas)) {
//     echo "Nama : $namapelapor <br>";
//     echo "nama fasilitas : $namafasilitas <br>";
//     echo "lokasi : $lokasikerusakan <br>";
//     echo "kategori : $kategori <br>";
//     echo "deskripsi : $deskripsi <br>";
//     echo "prioritas : $prioritas <br>";
// }


?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Kerusakan Fasilitas Sekolah</title>
    <!-- TANTANGAN UI/UX: Tambahkan styling CSS, Bootstrap, atau Tailwind sendiri. -->

    <style>
        header {
            max-width: auto;
            margin: 0 auto;
            padding: 5px 30px 30px 30px;
            background-color: #bf7cc9;
            color: black;
            font-family: Arial, Helvetica, sans-serif;
        }
        header p {
            position: absolute;
            top: 50px;
        }
        body {
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        main {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 5px 30px 60px 30px;
            background-color: #f4f4f4;
        }
        table {
            outline: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .ConFooter {
            max-width: auto;
            margin: 0 auto;
            padding: 20px;
            background-color: purple;
            color: white;
        }
        button {
            background-color: #bf7cc9;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        a {
            color: black;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }
        a:hover {
            color: white;
            text-decoration: underline;
        }
        nav {
            position: absolute;
            top: 45px;
            right: 30px;
            font-family: Arial, Helvetica, sans-serif;
            font-weight: bold;
        }
        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }
        fieldset {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        legend {
            font-weight: bold;
        }
        label {
            display: block;
        }
        select {
            width: 100%;
            height: 25px;
        }
        input, textarea {
            width: 99.5%;
            height: 50px;

        }
    </style>
</head>
<body>
    <!-- Bagian ini merupakan starter HTML. Belum ada koneksi database ataupun query. -->
    <header>
        <h1>Sistem Pelaporan Kerusakan Fasilitas Sekolah</h1>
        <p>Catat dan pantau laporan kerusakan fasilitas sekolah.</p>
        <nav aria-label="Navigasi utama">
            <a href="#form-laporan">Buat Laporan</a>
            <a href="#daftar-laporan">Daftar Laporan</a>
        </nav>
    </header>

    <main>
        <section id="form-laporan" aria-labelledby="judul-form">
            <h2 id="judul-form">Form Pelaporan Kerusakan</h2>
            <p>Lengkapi data berikut untuk melaporkan fasilitas yang rusak.</p>

            <!-- TANTANGAN BONUS CREATE: Buat proses PHP agar POST menyimpan data. -->
            <form action="index.php#daftar-laporan" method="post">
                <fieldset>
                    <legend>Data Pelaporan</legend>

                    <p>
                        <label for="nama_pelapor">Nama pelapor</label>
                        <input type="text" id="nama_pelapor" name="nama_pelapor" maxlength="100" required>
                    </p>

                    <p>
                        <label for="nama_fasilitas">Nama fasilitas</label>
                        <input type="text" id="nama_fasilitas" name="nama_fasilitas" maxlength="100" required>
                    </p>

                    <p>
                        <label for="lokasi">Lokasi kerusakan</label>
                        <input type="text" id="lokasi" name="lokasi" maxlength="100" required>
                    </p>

                    <p>
                        <label for="id_kategori">Kategori fasilitas</label>
                        <select id="id_kategori" name="id_kategori" required>
                            <option value="">-- Pilih kategori --</option>
                            <!-- Nilai berikut sesuai dengan data awal kategori_fasilitas. -->
                            <option value="1">Elektronik</option>
                            <option value="2">Furnitur</option>
                            <option value="3">Jaringan</option>
                            <option value="4">Peralatan Kelas</option>
                        </select>
                    </p>

                    <p>
                        <label for="deskripsi">Deskripsi kerusakan</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4" required></textarea>
                    </p>

                    <p>
                        <label for="prioritas">Prioritas</label>
                        <select id="prioritas" name="prioritas" required>
                            <option value="">-- Pilih prioritas --</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </p>

                    <p><button type="submit">Kirim Laporan</button></p>
                </fieldset>
            </form>
            <p><small>Catatan: tombol Kirim Laporan belum menyimpan apa pun. Fitur Create merupakan tantangan bonus.</small></p>
        </section>

        <section id="daftar-laporan" aria-labelledby="judul-daftar" class="daftar-laporan">
            <h2 id="judul-daftar">Daftar Laporan Kerusakan</h2>
            <p>Seluruh laporan yang tercatat pada database ditampilkan di bagian ini.</p>

            <?php 
            if (isset($sql)) {
            if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }};
            ?>
            <!-- TANTANGAN WAJIB:
                 1. Buat sendiri koneksi PHP ke MySQL.
                 2. Jalankan query SELECT untuk mengambil data dari laporan_kerusakan.
                 3. Ganti baris placeholder pada tbody dengan perulangan hasil query.
                 4. Jangan mengetik data database secara manual di HTML.
            -->
            <table>
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Fasilitas</th>
                        <th scope="col">Lokasi</th>
                        <th scope="col">Pelapor</th>
                        <th scope="col">Prioritas</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tanggal</th>
                    </tr>
                </thead>
                <?php
                $laporan_kerusakan = mysqli_query($conn, "SELECT * FROM laporan_kerusakan");
                $no = 1;
                
                while ($data = mysqli_fetch_assoc($laporan_kerusakan)) {
                    echo "<tr>
                        <td>" . $no++ . "</td>
                        <td>" . $data['nama_fasilitas'] . "</td>
                        <td>" . $data['lokasi'] . "</td>
                        <td>" . $data['nama_pelapor'] . "</td>
                        <td>" . $data['prioritas'] . "</td>
                        <td>" . $data['status'] . "</td>
                        <td>" . $data['tanggal_laporan'] . "</td>
                    </tr>";
                }
                ?>
            </table>
        </section>
    </main>

    <footer class = "ConFooter">
        <p>&copy; 2024 Sistem Pelaporan Kerusakan Fasilitas Sekolah.</p>
    </footer>
</body>
</html>

<?php 
mysqli_close($conn);
?>