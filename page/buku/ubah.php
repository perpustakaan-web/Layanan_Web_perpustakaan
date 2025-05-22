
<?php 
    $id = $_GET['id'];

    $sql = $koneksi->query("select * from buku where id='$id'");

    $tampil = $sql->fetch_assoc();

    $tahun2 = $tampil['tahun_terbit'];

    $lokasi = $tampil['lokasi'];
?>

<div class="panel panel-primary">
    <div class="panel-heading">
        Ubah Data
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">

                <form method="POST">
                    <div class="form-group">
                        <label>Judul</label>
                        <input class="form-control" name="judul" value="<?php echo $tampil['judul']?>" />

                    </div>
                    <div class="form-group">
                        <label>Pengarang</label>
                        <input class="form-control" name="pengarang" value="<?php echo $tampil['pengarang']?>" />

                    </div>
                    <div class="form-group">
                        <label>Penerbit</label>
                        <input class="form-control" name="penerbit" value="<?php echo $tampil['penerbit']?>" />

                    </div>
                    <div class="form-group">
                        <label>Tahun Terbit</label>
                        <select class="form-control" name="tahun_terbit">
                            <?php

                                $tahun = date("Y");

                                for ($i=$tahun-30; $i <= $tahun ; $i++) {
                                
                                        if ($i==$tahun2) {
                                        echo'<option value="'.$i.'" selected>'.$i.'</option>';
                                }else{
                                        echo'<option value="'.$i.'">'.$i.'</option>';
                                }
                                    

                                }

                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>ISBN</label>
                        <input class="form-control" name="isbn" value="<?php echo $tampil['isbn']?>" />

                    </div>
                    <div class="form-group">
                        <label>Jumlah Buku</label>
                        <input class="form-control" type="number" name="jumlah_buku" value="<?php echo $tampil['jumlah_buku']?>" />

                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <select class="form-control" name="lokasi">
                            <option value="rak1" <?php if ($tampil['lokasi']=='rak1') {echo "selected";}?>>Rak 1</option>
                            <option value="rak2" <?php if ($tampil['lokasi']=='rak2') {echo "selected";}?>>Rak 2</option>
                            <option value="rak3" <?php if ($tampil['lokasi']=='rak3') {echo "selected";}?>>Rak 3</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Input</label>
                        <input class="form-control" type="date" name="tgl_input" value="<?php echo $tampil['tgl_input']?>"/>

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

    $judul =        @$_POST ['judul'];
    $pengarang =    @$_POST ['pengarang'];
    $penerbit =     @$_POST ['penerbit'];
    $tahun_terbit = @$_POST ['tahun_terbit'];
    $isbn =         @$_POST ['isbn'];
    $jumlah_buku =  @$_POST ['jumlah_buku'];
    $lokasi =       @$_POST ['lokasi'];
    $tgl_input =    @$_POST ['tgl_input'];

    $simpan =       @$_POST ['simpan'];

    if ($simpan) {
        $sql = $koneksi->query("update buku set judul='$judul',pengarang='$pengarang',penerbit='$penerbit',tahun_terbit='$tahun_terbit',isbn='$isbn',jumlah_buku='$jumlah_buku',lokasi='$lokasi',tgl_input='$tgl_input'
        where id='$id'");
       

        if ($sql) {
            ?>
                <script type="text/javascript">
                    alert ("Data Berhasil Diupdate");
                    window.location.href="?page=buku";

                </script>
                <?php
        }
    }

?>