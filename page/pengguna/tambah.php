<div class="panel panel-primary">
    <div class="panel-heading">
        Tambah Data
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" />

                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" />

                    </div>
                    <div class="form-group">
                        <label>nama</label>
                        <input class="form-control" />

                    </div>
                    <div class="form-group">
                        <label>level</label>
                        <input class="form-control" />

                    </div>
                    <div class="form-group">
                        <label>foto</label>
                        <input class="form-control" type="file" type />

                    </div>

                    <div>
                        <input type="submit" value="Simpan" class="btn btn-primary">
                    </div>

            </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php

    $username =        @$_POST ['username'];
    $password =    @$_POST ['password'];
    $nama =     @$_POST ['nama'];
    $level = @$_POST ['level'];
    $foto =         @$_POST ['foto'];
   
    $simpan =       @$_POST ['simpan'];

    if ($simpan) {
        // Upload Foto 
    $foto = $_FILES['foto']['name']; 
    $target_dir = "assets/img/"; 
    $target_file = $target_dir . basename($foto); 
    move_uploaded_file($_FILES['foto']['tmp_name'], $target_file); 
        $sql = $koneksi->query("insert into user (username, password,nama,level,foto)
        values('$username','$password','$nama','$level','$foto')");

        if ($sql) {
            ?>
                <script type="text/javascript">
                    alert ("Data Berhasil Disimpan");
                    window.location.href="?page=pengguna";

                </script>
                <?php
        }
    }

?>