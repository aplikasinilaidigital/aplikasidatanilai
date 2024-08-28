<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Input Nilai</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .form-row {
            margin-bottom: 1rem;
        }
        .form-group {
            margin-bottom: 0;
        }
        .table-info {
            background-color: #f8f9fc;
            font-weight: bold;
        }
    </style>
</head>
<body id="page-top">
    <div id="wrapper">
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Navbar Content -->
                </nav>

                <div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">INPUT NILAI SISWA</h1>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Input Data Siswa</h6>
        </div>
        <div class="card-body">
            <form action="proses_input.php" method="post">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="kelas">Kelas</label>
                    <select class="form-control" id="kelas" name="kelas" required>
                        <option value="">Pilih Kelas</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                    <div class="form-group col-md-6">
                        <label for="jurusan">Jurusan</label>
                        <select class="form-control" id="jurusan" name="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                            <option value="PPLG">PPLG</option>
                            <option value="PPLG 1">PPLG 1</option>
                            <option value="PPLG 2">PPLG 2</option>
                            <option value="AKL">AKL</option>
                            <option value="AKL 1">AKL 1</option>
                            <option value="AKL 2">AKL 2</option>
                            <option value="MPLB">MPLB</option>
                            <option value="MPLB 1">MPLB 1</option>
                            <option value="MPLB 2">MPLB 2</option>
                            <option value="MPLB 3">MPLB 3</option>
                            <option value="PM">PM</option>
                            <option value="PM 1">PM 1</option>
                            <option value="PM 2">PM 2</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nama_sekolah">Nama Sekolah</label>
                        <input type="text" class="form-control" id="nama_sekolah" name="nama_sekolah" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="alamat_sekolah">Alamat Sekolah</label>
                        <input type="text" class="form-control" id="alamat_sekolah" name="alamat_sekolah" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" required>
                    </div>
                </div>
                <table class="table table-bordered">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Input Nilai Siswa</h6>
                    </div>
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
                    <tbody id="nilai-table-body">
                        <?php
                        $mataPelajaran = ['AGAMA', 'BAHASA INDONESIA', 'BAHASA INGGRIS', 'SEJARAH INDONESIA', 'BAHASA JEPANG', 'MATEMATIKA', 'SENI BUDAYA', 'OLAHRAGA', 'PPKN', 'BAHASA SUNDA', 'IPAS'];
                        foreach ($mataPelajaran as $mp) {
                            echo "<tr>
                                <td><input type='hidden' name='mata_pelajaran[]' value='" . htmlspecialchars($mp) . "'>" . htmlspecialchars($mp) . "</td>
                                <td><input type='number' class='form-control' name='nilai_harian[]' min='0' max='100' oninput='calculateNilaiAkhir(this)'></td>
                                <td><input type='number' class='form-control' name='nilai_pat[]' min='0' max='100' oninput='calculateNilaiAkhir(this)'></td>
                                <td><input type='number' class='form-control' name='nilai_pas[]' min='0' max='100' oninput='calculateNilaiAkhir(this)'></td>
                                <td><input type='number' class='form-control' name='nilai_akhir[]' readonly></td>
                                <td><input type='text' class='form-control' name='keterangan[]'></td>
                            </tr>";
                        }
                        ?>
                        <!-- Baris untuk rata-rata nilai -->
                        <tr>
                            <td colspan="4" class="table-info">Rata-rata Nilai</td>
                            <td><input type="text" class="form-control" id="rata_rata" readonly></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="catatan_walikelas">Catatan Walikelas</label>
                        <input type="text" class="form-control" id="catatan_walikelas" name="catatan_walikelas">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="javascript:history.back()" class="button btn btn-danger">Kembali</a>
            </form>
        </div>
    </div>
</div>

            </div>
        </div>
    </div>
    <!-- JavaScript Files -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script>
function calculateNilaiAkhir(element) {
    
    var row = element.closest('tr');
   
    var nilaiHarian = parseFloat(row.querySelector('input[name="nilai_harian[]"]').value) || 0;
    var nilaiPAT = parseFloat(row.querySelector('input[name="nilai_pat[]"]').value) || 0;
    var nilaiPAS = parseFloat(row.querySelector('input[name="nilai_pas[]"]').value) || 0;
    
   
    var nilaiAkhir = (nilaiHarian * 0.3) + (nilaiPAT * 0.3) + (nilaiPAS * 0.4);
    
    
    var nilaiAkhirInput = row.querySelector('input[name="nilai_akhir[]"]');
    nilaiAkhirInput.value = nilaiAkhir.toFixed(2);
    

    var keterangan;
    if (nilaiAkhir > 90) {
        keterangan = "Sangat Baik";
    } else if (nilaiAkhir >= 80) {
        keterangan = "Baik";
    } else if (nilaiAkhir >= 70) {
        keterangan = "Cukup";
    } else {
        keterangan = "Kurang";
    }
    
   
    var keteranganInput = row.querySelector('input[name="keterangan[]"]');
    keteranganInput.value = keterangan;
    
    
    calculateRataRata();
}

function calculateRataRata() {
    var nilaiAkhirInputs = document.querySelectorAll('input[name="nilai_akhir[]"]');
    var totalNilai = 0;
    var count = 0;

    nilaiAkhirInputs.forEach(function(input) {
        var nilaiAkhir = parseFloat(input.value) || 0;
        totalNilai += nilaiAkhir;
        count++;
    });

    var rataRata = count > 0 ? (totalNilai / count).toFixed(2) : 0;
    document.getElementById('rata_rata').value = rataRata;
}
</script>


</body>
</html>
