<?php
include 'koneksi.php';

$nisn = isset($_GET['nisn']) ? $koneksi->real_escape_string($_GET['nisn']) : '';

$query = "SELECT nisn, nama, kelas, jurusan, nama_sekolah, alamat_sekolah, tahun_ajaran, mata_pelajaran, nilai_harian, nilai_pat, nilai_pas, nilai_akhir, keterangan, catatan_walikelas
          FROM tbl_nilai 
          WHERE nisn = '$nisn'";

try {
    $result = $koneksi->query($query);
    
    if (!$result) {
        throw new Exception("Error fetching data: " . $koneksi->error);
    }

    
    $data = [];
    $total_nilai = 0;
    $jumlah_data = 0;

    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $total_nilai += $row['nilai_akhir'];
        $jumlah_data++;
    }

    $rata_rata = $jumlah_data > 0 ? $total_nilai / $jumlah_data : 0;
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header img {
            width: 60px;
            height: 60px;
            margin-right: 15px;
        }
        .header .text-content {
            flex-grow: 1;
            text-align: center;
        }
        .header .text-content h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .header .text-content p {
            margin: 0;
            font-size: 16px;
        }
        .details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .details .item {
            flex: 1 1 45%;
            margin: 8px 0;
            text-align: left;
        }
        .details p {
            margin: 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 16px;
            text-align: left;
        }
        table, th, td {
            border: 2px solid black;
        }
        th, td {
            padding: 10px;
        }
        th {
            background-color: #f4f4f4;
        }
        .catatan-walikelas {
            width: 100%;
            border-top: 1px solid #ddd;
            padding: 10px;
            box-sizing: border-box;
            text-align: left;
            font-style: italic;
            background-color: #f9f9f9;
        }
        .button {
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
        }
        .button:hover {
            background-color: #0056b3;
        }
        @media print {
            .button {
                display: none;
            }
            .container {
                width: 100%;
                margin: 0;
                padding: 0;
                border: none;
                box-shadow: none;
            }
            table {
                width: 100%;
                page-break-inside: auto;
            }
            th, td {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!empty($data)): ?>
            <div class="header">
                <img src="pgr.webp" alt="Logo">
                <div class="text-content">
                    <h1>Laporan Penilaian Belajar</h1>
                    <h1>SMK PGRI 1 CIMAHI</h1>
                    <p>SMEA PGRI 1, Jl Terusan Gg.Karya, Cimahi, Kec. Cimahi Tengah</p>
                </div>
                <img src="cmh.png" alt="Logo">
            </div>
            <?php
            $first_row = $data[0];
            $catatan_walikelas = $first_row['catatan_walikelas'];
            ?>
            <div class="details">
                <div class="item">
                    <p><strong>NISN:</strong> <?php echo htmlspecialchars($first_row['nisn']); ?></p>
                    <p><strong>Nama:</strong> <?php echo htmlspecialchars($first_row['nama']); ?></p>
                    <p><strong>Kelas:</strong> <?php echo htmlspecialchars($first_row['kelas']); ?></p>
                    <p><strong>Jurusan:</strong> <?php echo htmlspecialchars($first_row['jurusan']); ?></p>
                </div>
                <div class="item">
                    <p><strong>Nama Sekolah:</strong> <?php echo htmlspecialchars($first_row['nama_sekolah']); ?></p>
                    <p><strong>Alamat Sekolah:</strong> <?php echo htmlspecialchars($first_row['alamat_sekolah']); ?></p>
                    <p><strong>Tahun Ajaran:</strong> <?php echo htmlspecialchars($first_row['tahun_ajaran']); ?></p>
                    <p><strong>Semester : 4</strong></p>
                </div>
            </div>
            <table>
                <tr>
                    <th>Mata Pelajaran</th>
                    <th>Nilai Akhir</th>
                    <th>Keterangan</th>
                </tr>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['mata_pelajaran']); ?></td>
                        <td><?php echo htmlspecialchars($row['nilai_akhir']); ?></td>
                        <td><?php echo htmlspecialchars($row['keterangan']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <!-- Tabel Total dan Rata-Rata -->
            <table>
                <tr>
                    <th>Total Nilai Akhir</th>
                    <td><?php echo number_format($total_nilai, 2); ?></td>
                </tr>
                <tr>
                    <th>Rata-Rata</th>
                    <td><?php echo number_format($rata_rata, 2); ?></td>
                </tr>
            </table>

            <!-- Tabel Catatan Walikelas -->
            <table class="catatan-walikelas">
                <tr>
                    <th>Catatan Walikelas</th>
                </tr>
                <tr>
                    <td><?php echo htmlspecialchars($catatan_walikelas); ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>Data siswa dengan NISN tersebut tidak ditemukan.</p>
        <?php endif; ?>

        <a href="javascript:history.back()" class="button">Kembali</a>
        <button onclick="window.print()" class="button">Cetak</button>
    </div>
</body>
</html>