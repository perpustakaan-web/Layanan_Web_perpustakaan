<?php
$id = $_GET['id'];

$sql = $koneksi->query("SELECT * FROM buku WHERE id='$id'");
$tampil = $sql->fetch_assoc();

$tahun2 = $tampil['tahun_terbit'];
$lokasi = $tampil['lokasi'];
?>

<div class="panel panel-primary">
    <div class="panel-heading">Ubah Data</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" value="<?php echo $tampil['judul'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" value="<?php echo $tampil['pengarang'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" value="<?php echo $tampil['penerbit'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun_terbit">
                            <?php
                            $tahun = date("Y");
                            for ($i = $tahun - 30; $i <= $tahun; $i++) {
                                echo '<option value="' . $i . '"' . ($i == $tahun2 ? ' selected' : '') . '>' . $i . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" value="<?php echo $tampil['isbn'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah_buku" value="<?php echo $tampil['jumlah_buku'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select class="form-control" name="lokasi">
                            <option value="rak1" <?php if ($lokasi == 'rak1') echo "selected"; ?>>Rak 1</option>
                            <option value="rak2" <?php if ($lokasi == 'rak2') echo "selected"; ?>>Rak 2</option>
                            <option value="rak3" <?php if ($lokasi == 'rak3') echo "selected"; ?>>Rak 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input class="form-control" type="date" name="tgl_input" value="<?php echo $tampil['tgl_input'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Foto Buku</label><br>
                        <?php if (!empty($tampil['foto'])): ?>
                            <img src="assets/img/<?php echo $tampil['foto']; ?>" style="width:100px; height:auto; margin-bottom:10px;">
                        <?php endif; ?>
                        <input type="file" class="form-control" name="foto">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                    </div>
                    <div>
                        <input type="submit" name="simpan" value="Update" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST['simpan'])) {
    $judul        = $_POST['judul'];
    $pengarang    = $_POST['pengarang'];
    $penerbit     = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $isbn         = $_POST['isbn'];
    $jumlah_buku  = $_POST['jumlah_buku'];
    $lokasi       = $_POST['lokasi'];
    $tgl_input    = $_POST['tgl_input'];

    $foto_update = "";
    $target_dir = "assets/img/";

    if (!empty($_FILES['foto']['name'])) {
        // Hapus foto lama jika ada
        if (!empty($tampil['foto']) && file_exists($target_dir . $tampil['foto'])) {
            unlink($target_dir . $tampil['foto']);
        }

        $foto_name = basename($_FILES["foto"]["name"]);
        $target_file = $target_dir . $foto_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["foto"]["tmp_name"]);

        if (
            $check !== false && $_FILES["foto"]["size"] <= 2000000 &&
            in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])
        ) {

            if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                $foto_update = ", foto='$foto_name'";
            } else {
                echo "<script>alert('Gagal mengupload foto.');</script>";
            }
        } else {
            echo "<script>alert('Format foto tidak valid atau melebihi 2MB');</script>";
        }
    }

    // Update data buku
    $sql = $koneksi->query("UPDATE buku SET 
        judul='$judul',
        pengarang='$pengarang',
        penerbit='$penerbit',
        tahun_terbit='$tahun_terbit',
        isbn='$isbn',
        jumlah_buku='$jumlah_buku',
        lokasi='$lokasi',
        tgl_input='$tgl_input'
        $foto_update
        WHERE id='$id'");

    if ($sql) {
        echo "<script>
            alert('Data berhasil diupdate');
            window.location.href='?page=buku';
        </script>";
    } else {
        echo "<script>alert('Gagal mengupdate data');</script>";
    }
}
?>