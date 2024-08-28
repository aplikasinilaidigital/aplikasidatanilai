<?php
include 'koneksi.php';

if (isset($_GET['nisn'])) {
    $nisn = $_GET['nisn'];

    try {
        // Mengambil data siswa berdasarkan NISN
        $query = "SELECT * FROM tbl_nilai WHERE nisn = ?";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param('s', $nisn);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            throw new Exception("Data siswa tidak ditemukan.");
        }

        $data = [];
        $total_nilai_akhir = 0;
        $count = 0;

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
            $total_nilai_akhir += $row['nilai_akhir'];
            $count++;
        }

        $rata_rata_nilai_akhir = $count > 0 ? $total_nilai_akhir / $count : 0;

    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit;
    }
} else {
    echo "NISN tidak ditemukan.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nisn = $_POST['nisn'];
    $mata_pelajaran = $_POST['mata_pelajaran'];
    $nilai_harian = $_POST['nilai_harian'];
    $nilai_pat = $_POST['nilai_pat'];
    $nilai_pas = $_POST['nilai_pas'];
    $keterangan = $_POST['keterangan'];
    $catatan_walikelas = $_POST['catatan_walikelas'];

    try {
       
        $query = "UPDATE tbl_nilai SET nilai_harian = ?, nilai_pat = ?, nilai_pas = ?, nilai_akhir = ?, keterangan = ?, catatan_walikelas = ? WHERE nisn = ? AND mata_pelajaran = ?";
        $stmt = $koneksi->prepare($query);

        $rowsUpdated = 0; 

        foreach ($mata_pelajaran as $index => $mapel) {

            $nilai_akhir = ($nilai_harian[$index] + $nilai_pat[$index] + $nilai_pas[$index]) / 3;

            $stmt->bind_param(
                'sssdssss',
                $nilai_harian[$index],
                $nilai_pat[$index],
                $nilai_pas[$index],
                $nilai_akhir,
                $keterangan[$index],
                $catatan_walikelas,
                $nisn,
                $mapel
            );
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $rowsUpdated++;
            }
        }

        if ($rowsUpdated === 0) {
            throw new Exception("Tidak ada perubahan yang dilakukan.");
        }

        header('Location: data_siswa.php'); 
        exit;

    } catch (Exception $e) {
        echo "Terjadi kesalahan: " . $e->getMessage();
        exit;
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
    <title>Edit Nilai Siswa</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar Content Here -->
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Navbar Content Here -->
                </nav>
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Edit Nilai Siswa</h1>
                    <p>SMK PGRI 1 CIMAHI</p>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit Nilai</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="">
                                <input type="hidden" name="nisn" value="<?php echo htmlspecialchars($nisn); ?>">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Mata Pelajaran</th>
                                            <th>Nilai Harian</th>
                                            <th>Nilai PAT</th>
                                            <th>Nilai PAS</th>
                                            <th>Nilai Akhir</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="nilaiTableBody">
                                        <?php foreach ($data as $index => $item): ?>
                                        <tr>
                                            <td><input type="text" class="form-control" name="mata_pelajaran[]" value="<?php echo htmlspecialchars($item['mata_pelajaran']); ?>" required></td>
                                            <td><input type="number" class="form-control" name="nilai_harian[]" value="<?php echo htmlspecialchars($item['nilai_harian']); ?>" required oninput="calculateFinalScore(this)"></td>
                                            <td><input type="number" class="form-control" name="nilai_pat[]" value="<?php echo htmlspecialchars($item['nilai_pat']); ?>" required oninput="calculateFinalScore(this)"></td>
                                            <td><input type="number" class="form-control" name="nilai_pas[]" value="<?php echo htmlspecialchars($item['nilai_pas']); ?>" required oninput="calculateFinalScore(this)"></td>
                                            <td><input type="text" class="form-control" name="nilai_akhir[]" value="<?php echo htmlspecialchars($item['nilai_akhir']); ?>" readonly></td>
                                            <td><textarea class="form-control" name="keterangan[]" rows="3" required><?php echo htmlspecialchars($item['keterangan']); ?></textarea></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <label for="rata_rata_nilai_akhir">Rata-rata Nilai Akhir</label>
                                    <input type="text" class="form-control" id="rata_rata_nilai_akhir" value="<?php echo number_format($rata_rata_nilai_akhir, 2); ?>" readonly>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="catatan_walikelas">Catatan Walikelas</label>
                                        <input type="text" class="form-control" id="catatan_walikelas" name="catatan_walikelas">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="laporan.php" class="btn btn-secondary">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script>
    function calculateFinalScore(element) {
        const row = element.closest('tr');
        const nilaiHarian = parseFloat(row.querySelector('input[name="nilai_harian[]"]').value) || 0;
        const nilaiPat = parseFloat(row.querySelector('input[name="nilai_pat[]"]').value) || 0;
        const nilaiPas = parseFloat(row.querySelector('input[name="nilai_pas[]"]').value) || 0;

        
        const nilaiAkhir = (nilaiHarian + nilaiPat + nilaiPas) / 3;
        row.querySelector('input[name="nilai_akhir[]"]').value = nilaiAkhir.toFixed(2);

        
        let keterangan = "";
        if (nilaiAkhir > 90) {
            keterangan = "Sangat Baik";
        } else if (nilaiAkhir >= 80) {
            keterangan = "Baik";
        } else if (nilaiAkhir >= 70) {
            keterangan = "Cukup";
        } else {
            keterangan = "Kurang";
        }
        row.querySelector('textarea[name="keterangan[]"]').value = keterangan;
    }
</script>

</body>
</html>
