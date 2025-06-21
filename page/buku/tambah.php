<div class="panel panel-primary">
    <div class="panel-heading">
        Tambah Data
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="foto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" required>
                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" required>
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" required>
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun_terbit" required>
                            <?php
                            $tahun = date("Y");
                            for ($i = $tahun - 30; $i <= $tahun; $i++) {
                                echo '<option value="' . $i . '">' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah_buku" required>
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select class="form-control" name="lokasi" required>
                            <option value="rak1">Rak 1</option>
                            <option value="rak2">Rak 2</option>
                            <option value="rak3">Rak 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input class="form-control" type="date" name="tgl_input" required>
                    </div>
                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    // Direktori untuk menyimpan gambar
    $target_dir = "assets/img/";

    // Buat direktori jika belum ada
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Informasi file yang diupload
    $foto_name = basename($_FILES['foto']['name']);
    $target_file = $target_dir . $foto_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file gambar
    $check = getimagesize($_FILES['foto']['tmp_name']);
    if ($check === false) {
        die("<script>alert('File yang diupload bukan gambar.'); window.location.href='?page=buku&action=tambah';</script>");
    }

    // Cek ukuran file (maksimal 2MB)
    if ($_FILES['foto']['size'] > 2000000) {
        die("<script>alert('Ukuran gambar terlalu besar. Maksimal 2MB.'); window.location.href='?page=buku&action=tambah';</script>");
    }

    // Format file yang diizinkan
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("<script>alert('Hanya file JPG, JPEG, PNG & GIF yang diizinkan.'); window.location.href='?page=buku&action=tambah';</script>");
    }

    // Coba upload file
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $target_file)) {
        // Ambil data dari form
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $isbn = $_POST['isbn'];
        $jumlah_buku = $_POST['jumlah_buku'];
        $lokasi = $_POST['lokasi'];
        $tgl_input = $_POST['tgl_input'];

        // Simpan ke database
        $sql = $koneksi->query("INSERT INTO buku (foto, judul, pengarang, penerbit, tahun_terbit, isbn, jumlah_buku, lokasi, tgl_input)
            VALUES('$foto_name', '$judul', '$pengarang', '$penerbit', '$tahun_terbit', '$isbn', '$jumlah_buku', '$lokasi', '$tgl_input')");

        if ($sql) {
            echo "<script>alert('Data Berhasil Disimpan'); window.location.href='?page=buku';</script>";
        } else {
            // Jika gagal menyimpan ke database, hapus file yang sudah diupload
            unlink($target_file);
            echo "<script>alert('Gagal menyimpan data.'); window.location.href='?page=buku&action=tambah';</script>";
        }
    } else {
        echo "<script>alert('Gagal mengupload gambar.'); window.location.href='?page=buku&action=tambah';</script>";
    }
}
?>