<?php
    $id = $_GET ['id'];

    $koneksi->query("delete from user where id='$id'");
?>

<script type="text/javascript">
    window.location.href="?page=pengguna";
</script>