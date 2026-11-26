<?php
include 'koneksi.php';


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

?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan Kerusakan Fasilitas Sekolah</title>
    <!-- TANTANGAN UI/UX: Tambahkan styling CSS, Bootstrap, atau Tailwind sendiri. -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Bagian ini merupakan starter HTML. Belum ada koneksi database ataupun query. -->
    <header>
        <h1>Sistem Pelaporan Kerusakan Fasilitas Sekolah</h1>
        <p>Catat dan pantau laporan kerusakan fasilitas sekolah.</p>
        <button class="menu-toggle" id="menu-toggle" aria-label="Toggle Navigation">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="nav-container">
            <nav aria-label="Navigasi utama">
                <a href="#form-laporan">Buat Laporan</a>
                <a href="#daftar-laporan">Daftar Laporan</a>
            </nav>
        </div>
        
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
                        <select class="kategori" id="id_kategori" name="id_kategori" required>
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
                        <select class="kategori" id="prioritas" name="prioritas" required>
                            <option value="">-- Pilih prioritas --</option>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </p>

                    <p><button class="btn-primary"type="submit">Kirim Laporan</button></p>
                </fieldset>
            </form>
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
            <div class="table-wrap">
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
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $laporan_kerusakan = mysqli_query($conn, "SELECT * FROM laporan_kerusakan");
                $no = 1;
                
                while ($data = mysqli_fetch_assoc($laporan_kerusakan)) {
                    $id = $data['id_laporan'] ?? '';
                    $status_sekarang = $data['status'] ?? 'Menunggu';
                    $nama_fasilitas = htmlspecialchars($data['nama_fasilitas'] ?? '');
                    $lokasi = htmlspecialchars($data['lokasi'] ?? '');
                    $nama_pelapor = htmlspecialchars($data['nama_pelapor'] ?? '');
                    $prioritas = htmlspecialchars($data['prioritas'] ?? '');
                    $tanggal = htmlspecialchars($data['tanggal_laporan'] ?? '');

                    echo "<tr>
                        <td data-label='No.'>" . $no++ . "</td>
                        <td data-label='Fasilitas'>" . $nama_fasilitas . "</td>
                        <td data-label='Lokasi'>" . $lokasi . "</td>
                        <td data-label='Pelapor'>" . $nama_pelapor . "</td>
                        <td data-label='Prioritas'>" . $prioritas . "</td>
                        <td data-label='Status'>" . htmlspecialchars($status_sekarang) . "</td>
                        <td data-label='Tanggal'>" . $tanggal . "</td>
                        <td data-label='Aksi'>
                            <form class='formupdate'action='update.php' method='POST'>
                                <input type='hidden' name='id_laporan' value='$id'>
                                <select class='selstat' name='status'>
                                    <option value='Menunggu' " . ($status_sekarang == 'Menunggu' ? 'selected' : '') . ">Menunggu</option>
                                    <option value='Diproses' " . ($status_sekarang == 'Diproses' ? 'selected' : '') . ">Diproses</option>
                                    <option value='Selesai' " . ($status_sekarang == 'Selesai' ? 'selected' : '') . ">Selesai</option>
                                </select>
                                <button class='update' type='submit'>Update</button>
                            </form> 
                            <button class='deletekey' onclick=\"if(confirm('Apakah Anda yakin ingin menghapus laporan ini?')) { window.location.href='delete.php?id_laporan=" . $id . "'; }\">Hapus</button>
                        </td>
                    </tr>";
                }
                ?>
                </tbody>
            </table>
            </div>
        </section>
    </main>

    <footer class = "ConFooter">
        <p>&copy; 2026 Sistem Pelaporan Kerusakan Fasilitas Sekolah.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>

<?php 
mysqli_close($conn);
?>