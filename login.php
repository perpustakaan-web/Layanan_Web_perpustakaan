<?php
ob_start();
session_start();
$koneksi = new mysqli("localhost", "root", "", "db_perpustakaan");

// Mengecek sesi admin atau petugas tanpa mengganggu sesi lain
if (!isset($_SESSION['admin']) && !isset($_SESSION['petugas'])) {
    echo "<script>
        if (!sessionStorage.getItem('session_active')) {
            window.location.href = 'login.php';
        }
    </script>";
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halaman Login</title>
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2>Halaman Login</h2>
                <br />
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Masukan Username & Password</strong>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Your Username" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Your Password" />
                            </div>
                            <input type="submit" name="login" value="Login" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (!sessionStorage.getItem('session_active')) {
            sessionStorage.setItem('session_active', 'true');
        }
    </script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/custom.js"></script>
</body>
</html>

<?php
if (isset($_POST['login'])) {
    session_regenerate_id(true);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $koneksi->query("SELECT * FROM user WHERE username='$username' AND password='$password'");
    $data = $sql->fetch_assoc();
    $ketemu = $sql->num_rows;

    if ($ketemu >= 1) {
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['session_tab'] = session_id();

        echo "<script>sessionStorage.setItem('session_active', 'true');</script>";

        if ($data['level'] == "admin") {
            $_SESSION['admin'] = session_id();
            header("location:index_admin.php");
            exit();
        } elseif ($data['level'] == "petugas") {
            $_SESSION['petugas'] = session_id();
            header("location:index.php");
            exit();
        }
    } else {
        echo '<script>alert("Login Gagal! Username atau Password Salah");</script>';
    }
}

// Logout untuk admin
if (isset($_GET['logout_admin'])) {
    unset($_SESSION['admin']);
    echo "<script>sessionStorage.removeItem('session_active'); window.location.href = 'login.php';</script>";
}

// Logout untuk petugas
if (isset($_GET['logout_petugas'])) {
    unset($_SESSION['petugas']);
    echo "<script>sessionStorage.removeItem('session_active'); window.location.href = 'login.php';</script>";
}
?>
