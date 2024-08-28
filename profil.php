<?php
session_start();

include 'koneksi.php';

$nama = isset($_SESSION['nama']) ? $_SESSION['nama'] : 'Nama Pengguna';
$nisn = isset($_SESSION['nisn']) ? $_SESSION['nisn'] : 'NISN Pengguna';


$status = 'Status';


if ($nisn !== 'NISN Pengguna') {
   
    $query = "SELECT status FROM register WHERE nisn = ?";
    if ($stmt = $koneksi->prepare($query)) {
        $stmt->bind_param('s', $nisn); 
        $stmt->execute();
        $stmt->bind_result($status); 
        $stmt->fetch();
        $stmt->close();
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya</title>
    <style>
        body {
            background-image: url('biru.jpg'); 
            font-family: Arial, sans-serif; 
            font-size: 30px;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-size: cover; 
        }
        .container {
            width: 100%;
            max-width: 600px;
            text-align: left;
            padding: 20px; 
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 12px;
            background-color: #fff;
            box-shadow:  4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px; 
        }
        .card-body {
            padding: 10px;
        }
        .btn-logout {
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 6px;
            display: inline-block;
            font-size: 18px;
        }
        .btn-logout:hover {
            background-color: #00BFFF;
        }
        .logo {
            max-width: 100px; 
            display: block;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card mt-5">
        <div class="card-body">
            <img src="profile.png" alt="Logo" class="logo">
            <h5 class="card-title">Profil Saya</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>NISN:</strong> <?php echo htmlspecialchars($nisn); ?></li>
                <li class="list-group-item"><strong>Nama:</strong> <?php echo htmlspecialchars($nama); ?></li>
                <li class="list-group-item"><strong>Status:</strong> <?php echo htmlspecialchars($status); ?></li>
            </ul>
            <a href="siswa.php" class="btn-logout mt-3">Kembali</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
