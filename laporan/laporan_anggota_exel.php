<?php

$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

$filename = "anggota_exel-(" . date('d-m-y') . ").xls";

header("content-disposition: attachment; filename='$filename'");
header("content-type: application/vdn.ms-exel");


?>

<h2>Laporan Anggota</h2>

<table border="1">
    <tr>
        <th>No</th>
        <th>nisn</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tangal Lahir</th>
        <th>Jenis Kelamin</th>
        <th>kelas</th>

    </tr>
    <?php
    $no = 1;
    $sql = $koneksi->query("select * from anggota");

    while ($data = $sql->fetch_assoc()) {

        $jk = ($data['jk'] == 1) ? "Laki-Laki" : "Perempuan";
    ?>

        <tr>

            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nisn']; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['tempat_lahir']; ?></td>
            <td><?php echo $data['tgl_lahir']; ?></td>
            <td><?php echo $jk; ?></td>
            <td><?php echo $data['kelas']; ?></td>

        </tr>

    <?php } ?>
</table>