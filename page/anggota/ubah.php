<?php
$nisn = $_GET['id'];
$sql = $koneksi->query("select * from anggota where nisn = '$nisn'");
$tampil = $sql->fetch_assoc();
$jk1 = $tampil['jk'];

?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Ubah Anggota
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <form method="POST">
                    <div class="form-group">
                        <label>Nisn</label>
                        <input class="form-control" name="nisn" value="<?php echo $tampil['nisn'] ?>" readonly />

                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" value="<?php echo $tampil['nama'] ?>" />

                    </div>
                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input class="form-control" name="tempat_lahir" value="<?php echo $tampil['tempat_lahir'] ?>" />

                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control" type="date" type name="tgl_lahir" value="<?php echo $tampil['tgl_lahir'] ?>" />

                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label> <br />
                        <label class="checkbox-inline">
                            <input type="checkbox" value="1" name="jk" <?php echo ($jk1 == 1) ? "checked" : ""; ?> /> Laki-Laki
                        </label>
                        <label class="checkbox-inline">
                            <input type="checkbox" value="2" name="jk" <?php echo ($jk1 == 2) ? "checked" : ""; ?> /> Perempuan
                        </label>

                    </div>
                    <div class="form-group">
                        <label>Kelas</label>
                        <input class="form-control" name="kelas" value="<?php echo $tampil['kelas'] ?>" />

                    </div>


                    <div>
                        <input type="submit" name="simpan" value="Update" class="btn btn-primary">
                    </div>

            </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php

$nisn =        @$_POST['nisn'];
$nama =    @$_POST['nama'];
$tempat_lahir =     @$_POST['tempat_lahir'];
$tgl_lahir = @$_POST['tgl_lahir'];
$jk =         @$_POST['jk'];
$kelas =  @$_POST['kelas'];

$simpan =       @$_POST['simpan'];

if ($simpan) {
    $sql = $koneksi->query("update anggota set nama='$nama',tempat_lahir='$tempat_lahir',tgl_lahir='$tgl_lahir',jk='$jk',kelas='$kelas'
        where nisn='$nisn'");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Data Berhasil Diupdate");
            window.location.href = "?page=anggota";
        </script>
<?php
    }
}

?>