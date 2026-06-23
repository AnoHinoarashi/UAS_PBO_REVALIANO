<?php
// Memanggil seluruh dependensi file secara modular
require_once 'koneksi.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanMagang.php';

// Menangkap input filter sortir dari URL
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'semua';

$kelompokTetap   = [];
$kelompokKontrak = [];
$kelompokMagang  = [];

try {
    $stmt = $db->query("SELECT * FROM tabel_karyawan");
    $semuaData = $stmt->fetchAll();

    foreach ($semuaData as $row) {
        // Proses pembentukan objek secara polimorfisme dari file subclass masing-masing
        if ($row['jenis_karyawan'] === 'tetap') {
            $kelompokTetap[] = new KaryawanTetap(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['tunjangan_kesehatan'], $row['opsi_saham_id']
            );
        } elseif ($row['jenis_karyawan'] === 'kontrak') {
            $kelompokKontrak[] = new KaryawanKontrak(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['durasi_kontrak_bulan'], $row['agensi_penyalur']
            );
        } elseif ($row['jenis_karyawan'] === 'magang') {
            $kelompokMagang[] = new KaryawanMagang(
                $row['id_karyawan'], $row['nama_karyawan'], $row['departemen'], 
                $row['hari_kerja_masuk'], $row['gaji_dasar_per_hari'],
                $row['uang_saku_bulanan'], $row['sertifikat_kampus_merdeka']
            );
        }
    }
} catch (PDOException $e) {
    die("<h3 style='color:red;'>SQL Error: " . $e->getMessage() . "</h3>");
}

$totalDataDb = count($kelompokTetap) + count($kelompokKontrak) + count($kelompokMagang);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Slip Gaji</title>
    <style>
        body { background-color: #111; color: #fff; font-family: sans-serif; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        header { text-align: center; padding: 20px; background: #FF6600; border: 3px solid #FFCC00; border-radius: 10px; margin-bottom: 20px;}
        .filter-wrapper { display: flex; justify-content: center; gap: 12px; margin-bottom: 25px; }
        .btn-filter { padding: 10px 20px; font-weight: bold; text-decoration: none; border-radius: 5px; text-transform: uppercase; font-size: 0.9rem; transition: all 0.2s ease; border: 2px solid transparent; }
        .btn-semua { background-color: #333; color: #fff; border-color: #555; }
        .btn-tetap { background-color: #FFCC00; color: #000; }
        .btn-kontrak { background-color: #FF6600; color: #fff; }
        .btn-magang { background-color: #a200ff; color: #fff; }
        .btn-filter:hover { transform: scale(1.05); }
        .active-btn { border: 2px solid #fff !important; box-shadow: 0 0 15px rgba(255,255,255,0.4); }
        .section { border: 2px solid #003399; padding: 20px; border-radius: 10px; margin-bottom: 20px; background: #1a1a1a; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px; margin-top: 15px;}
        .card { background: #222; border-left: 5px solid #FFCC00; padding: 15px; border-radius: 4px; }
        .card h3 { margin: 0 0 10px 0; }
        .amount { color: #00ff66; font-weight: bold; font-size: 1.2rem; }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h2>DAFTAR SLIP GAJI</h2>
        <p>Total Data Terload: <?= $totalDataDb; ?> Karyawan</p>
    </header>

    <div class="filter-wrapper">
        <a href="tampil.php?filter=semua" class="btn-filter btn-semua <?= $filter === 'semua' ? 'active-btn' : ''; ?>">✨ Semua</a>
        <a href="tampil.php?filter=tetap" class="btn-filter btn-tetap <?= $filter === 'tetap' ? 'active-btn' : ''; ?>">👑 Tetap</a>
        <a href="tampil.php?filter=kontrak" class="btn-filter btn-kontrak <?= $filter === 'kontrak' ? 'active-btn' : ''; ?>">🔥 Kontrak</a>
        <a href="tampil.php?filter=magang" class="btn-filter btn-magang <?= $filter === 'magang' ? 'active-btn' : ''; ?>">🔮 Magang</a>
    </div>

    <?php if (!empty($kelompokTetap) && ($filter === 'semua' || $filter === 'tetap')): ?>
    <div class="section">
        <h3 style="color:#FFCC00;">KARYAWAN TETAP</h3>
        <div class="grid">
            <?php foreach ($kelompokTetap as $kt): ?>
                <div class="card">
                    <h3><?= (fn() => $this->nama_karyawan)->call($kt); ?></h3>
                    <p>ID: <?= (fn() => $this->id_karyawan)->call($kt); ?> | Dept: <?= (fn() => $this->departemen)->call($kt); ?></p>
                    <p class="amount">Rp <?= number_format($kt->ambilGajiBersih(), 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($kelompokKontrak) && ($filter === 'semua' || $filter === 'kontrak')): ?>
    <div class="section" style="border-color:#FF6600;">
        <h3 style="color:#FF6600;">KARYAWAN KONTRAK</h3>
        <div class="grid">
            <?php foreach ($kelompokKontrak as $kk): ?>
                <div class="card" style="border-left-color:#FF6600;">
                    <h3><?= (fn() => $this->nama_karyawan)->call($kk); ?></h3>
                    <p>ID: <?= (fn() => $this->id_karyawan)->call($kk); ?> | Dept: <?= (fn() => $this->departemen)->call($kk); ?></p>
                    <p class="amount">Rp <?= number_format($kk->ambilGajiBersih(), 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($kelompokMagang) && ($filter === 'semua' || $filter === 'magang')): ?>
    <div class="section" style="border-color:#a200ff;">
        <h3 style="color:#cc66ff;">KARYAWAN MAGANG</h3>
        <div class="grid">
            <?php foreach ($kelompokMagang as $km): ?>
                <div class="card" style="border-left-color:#a200ff;">
                    <h3><?= (fn() => $this->nama_karyawan)->call($km); ?></h3>
                    <p>ID: <?= (fn() => $this->id_karyawan)->call($km); ?> | Dept: <?= (fn() => $this->departemen)->call($km); ?></p>
                    <p class="amount">Rp <?= number_format($km->ambilGajiBersih(), 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>