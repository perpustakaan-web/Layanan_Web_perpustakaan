<?php

    $koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

    $filename = "anggota_exel-(".date('d-m-y').").xls";

    header("content-disposition: attachment; filename='$filename'");
    header("content-type: application/vdn.ms-exel");


?>

<h2>Laporan Anggota</h2>

<table border="1">
                                        <tr>
                                            <th>No</th>
                                            <th>Nim</th>
                                            <th>Nama</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tangal Lahir</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Prodi</th>
                                            
                                        </tr>
                                        <?php
                                            $no =1;
                                            $sql = $koneksi->query("select * from anggota");

                                            while ($data=$sql->fetch_assoc()) {

                                            $jk =($data['jk']==1)?"Laki-Laki":"Perempuan";
                                        ?>

<tr>

<td><?php echo $no++;?></td>
<td><?php echo $data['nim'];?></td>
<td><?php echo $data['nama'];?></td>
<td><?php echo $data['tempat_lahir'];?></td>
<td><?php echo $data['tgl_lahir'];?></td>
<td><?php echo $jk;?></td>
<td><?php echo $data['prodi'];?></td>

</tr>

<?php } ?>
</table>