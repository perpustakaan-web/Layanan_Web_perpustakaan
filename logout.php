<?php
session_start();

// Logout hanya untuk admin
if (isset($_GET['logout_admin'])) {
    unset($_SESSION['admin']);
    echo "<script>
        sessionStorage.removeItem('session_active');
        window.location.href = 'login.php';
    </script>";
    exit();
}

// Logout hanya untuk petugas
if (isset($_GET['logout_petugas'])) {
    unset($_SESSION['petugas']);
    echo "<script>
        sessionStorage.removeItem('session_active');
        window.location.href = 'login.php';
    </script>";
    exit();
}

// Jika tidak ada parameter logout yang jelas, kembalikan ke login
header("location: login.php");
exit();
?>
