<a href="?page=buku&aksi=tambah" class="btn btn-primary" style="margin-bottom: 5px">Tambah Data</a>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-success">
            <div class="panel-heading">
                Data Buku
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>ISBN</th>
                                <th>Jumlah Buku</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                                            $no =1;
                                            $sql = $koneksi->query("select * from buku");

                                            while ($data=$sql->fetch_assoc()) {
                                        ?>

                                            
                                        <tr>

                                            <td><?php echo $no++;?></td>
                                            <td><?php echo $data['judul'];?></td>
                                            <td><?php echo $data['pengarang'];?></td>
                                            <td><?php echo $data['penerbit'];?></td>
                                            <td><?php echo $data['isbn'];?></td>
                                            <td><?php echo $data['jumlah_buku'];?></td>
                                            <td>
                                                <a href="?page=buku&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-info" ><i class="fa fa-edit"></i>Ubah</a>
                                                <a onclick="return confirm('Yakin ingin menghapus data ini...???')" href="?page=buku&aksi=hapus&id=<?php echo $data['id']; ?>" class="btn btn-danger" ><i class="fa fa-trash"></i>Hapus</a>
                                            </td>
                                        </tr>

                                        <?php } ?>
                        </tbody>
                </div>
            </div>
        </div>
    </div>
</div>