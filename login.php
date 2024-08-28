<?php
session_start();

if (isset($_POST['nisn']) && isset($_POST['nama'])) {
    $nisn = $_POST['nisn'];
    $nama = $_POST['nama'];

    include 'koneksi.php';

    $query_validasi = mysqli_query($koneksi, "SELECT * FROM register WHERE nisn = '$nisn' AND nama = '$nama'");

    if (mysqli_num_rows($query_validasi) == 0) {
        echo '<script>';
        echo 'alert("Maaf, NISN/NIP atau Nama yang dimasukkan tidak sesuai.");';
        echo 'window.location.assign("login.php");';
        echo '</script>';
    } else {
        $data = mysqli_fetch_assoc($query_validasi);

        $_SESSION["nisn"] = $nisn;
        $_SESSION["nama"] = $nama;
        $status = $data['status']; 

        if ($status == 'guru') {
            header("Location: guru.php");
            exit();
        } elseif ($status == 'siswa') {
            header("Location: siswa.php");
            exit(); 
        } else {
            ?>
            <script>
                alert("Status tidak valid.");
                window.location.assign('login.php');
            </script>
            <?php
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css"
        integrity="sha384-dpuaG1suU0eT09tx5plTaGMLBsfDLzUCCUXOY2j/LSvXYuG6Bqs43ALlhIqAJVRb" crossorigin="anonymous">
</head>
<body class="bg-gradient-info">
    <!-- Tombol Info -->
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-6 col-md-6">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"></h1>
                                        <img src="lai.png" alt="" style="width: 200px; height: auto;">
                                        <h3>Silahkan Login</h3>
                                    </div>
                                    <form class="user" method="post" action="login.php">
                                        <div class="form-group">
                                            <input type="text" name="nisn" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Masukan NISN Atau NIP">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="nama" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Masukan Nama Lengkap">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <a href="register.php" class="btn btn-success btn-user btn-block">
                                            Anda Belum Mempunyai Akun? Silahkan Buat Akun Terlebih Dahulu</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>