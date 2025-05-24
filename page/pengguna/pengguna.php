<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-success">
            <div class="panel-heading">
                Data Pengguna
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Nama</th>
                                <th>Level</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM user");

                            while ($data = $sql->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['username']; ?></td>
                                    <td><?php echo $data['password']; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td><?php echo $data['level']; ?></td>
                                    <td> 
                        <img src="assets/img/<?= $row['foto'] ?>" alt="Foto" width="100"> 
                    </td> 
                                    <td>
                                        <a href="?page=pengguna&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-info">
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>
                                        <a onclick="return confirm('Yakin ingin menghapus data ini...???')" href="?page=pengguna&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger">
                                            <i class="fa fa-trash"></i> Hapus
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <a href="?page=pengguna&akses=tambah" class="btn btn-primary" style="margin-top: 8px">
                    <i class="fa fa-plus"></i> Tambah Data
                </a>


            </div>
        </div>
    </div>
</div>