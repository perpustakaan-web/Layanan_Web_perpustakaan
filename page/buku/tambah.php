<div class="panel panel-primary">
<div class="panel-heading" >
        Tambah Data
</div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Judul</label>
                                            <input class="form-control" name="judul" />
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Pengarang</label>
                                            <input class="form-control" name="pengarang" />
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Penerbit</label>
                                            <input class="form-control" name="penerbit" />
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Terbit</label>
                                            <select class="form-control" name="tahun_terbit">
                                               <?php

                                                    $tahun = date("Y");

                                                    for ($i=$tahun-30; $i <= $tahun ; $i++) {
                                                        echo'
                                                        
                                                            <option value="'.$i.'">'.$i.'</option>
                                                        ';
                                                    }

                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ISBN</label>
                                            <input class="form-control" name="isbn" />
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah Buku</label>
                                            <input class="form-control" type="number" name="jumlah_buku" />
                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <select class="form-control" name="lokasi">
                                                <option value="rak1">Rak 1</option>
                                                <option value="rak2">Rak 2</option>
                                                <option value="rak3">Rak 3</option>
                                          </select>
                                                </div>
                                                <div class="form-group">
                                            <label>Tanggal Input</label>
                                            <input class="form-control" type="date" name="tgl_input" />
                                            
                                        </div>

                                        <div>
                                          <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
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
        $sql = $koneksi->query("insert into buku (judul,pengarang,penerbit,tahun_terbit,isbn,jumlah_buku,lokasi,tgl_input)
        values('$judul','$pengarang','$penerbit','$tahun_terbit','$isbn',' $jumlah_buku','$lokasi',' $tgl_input')");

        if ($sql) {
            ?>
                <script type="text/javascript">
                    alert ("Data Berhasil Disimpan");
                    window.location.href="?page=buku";

                </script>
                <?php
        }
    }

?>