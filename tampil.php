<?php
// =======================================================================================
// FILENAME: tampil.php (VERSI DIAGNOSTIK / LACAK ERROR)
// =======================================================================================

require_once 'koneksi.php';

// 1. CEK APAKAH VARIABEL KONEKSI $db ADA
if (!isset($db)) {
    die("<h3 style='color:red;'>Error: Variabel koneksi \$db tidak ditemukan! Periksa file koneksi.php Anda.</h3>");
}

// 2. ABSTRACT CLASS UTAMA
abstract class Karyawan {
    protected $id_karyawan;
    protected $nama_karyawan;
    protected $departemen;
    protected $hari_kerja_masuk;
    protected $gaji_dasar_per_hari;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar) {
        $this->id_karyawan         = $id;
        $this->nama_karyawan       = $nama;
        $this->departemen          = $dept;
        $this->hari_kerja_masuk    = $hariKerja;
        $this->gaji_dasar_per_hari = $gajiDasar;
    }

    abstract public function hitungGajiBersih();
}

// 3. KELAS TURUNAN
class KaryawanTetap extends Karyawan {
    private $tunjangan_kesehatan;
    private $opsi_saham_id;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjangan, $sahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->tunjangan_kesehatan = $tunjangan;
        $this->opsi_saham_id       = $sahamId;
    }
    public function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjangan_kesehatan;
    }
}

class KaryawanKontrak extends Karyawan {
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $durasi, $agensi) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_penyalur       = $agensi;
    }
    public function hitungGajiBersih() { return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari; }
}

class KaryawanMagang extends Karyawan {
    private $uang_saku_bulanan;
    private $sertifikat_kampus_merdeka;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSaku, $sertifikat) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->uang_saku_bulanan         = $uangSaku;
        $this->sertifikat_kampus_merdeka = $sertifikat;
    }
    public function hitungGajiBersih() { return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) * 0.80; }
}

// 4. PROSES AMBIL DATA DAN DIAGNOSA
$kelompokTetap   = [];
$kelompokKontrak = [];
$kelompokMagang  = [];

try {
    // Jalankan query ke database
    $stmt = $db->query("SELECT * FROM tabel_karyawan");
    $semuaData = $stmt->fetchAll();

    // --- DIAGNOSTIK SCREEN ---
    if (empty($semuaData)) {
        echo "<div style='background:#fff3cd; color:#856404; padding:15px; margin:20px; border-radius:5px; font-family:sans-serif;'>";
        echo "<h3>⚠️ Pemberitahuan Sistem:</h3>";
        echo "Koneksi ke database <b>DB_UAS_PBO_TI1C_REVALIANO</b> Berhasil! <br>";
        echo "Namun, <b>tidak ada data</b> yang ditemukan di dalam tabel <u>tabel_karyawan</u> (0 baris).<br>";
        echo "Silakan pastikan Anda sudah melakukan <i>Import / Insert data</i> ke dalam tabel tersebut di phpMyAdmin.";
        echo "</div>";
    }
    // -------------------------

    foreach ($semuaData as $row) {
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
    die("<h3 style='color:red;'>SQL Error: " . $e->getMessage() . "</h3><p>Periksa apakah nama tabel Anda benar-benar bernama <u>tabel_karyawan</u>.</p>");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar slip gaji</title>
    <style>
        body { background-color: #111; color: #fff; font-family: sans-serif; padding: 20px; }
        .container { max-width: 1200px; margin: 0 auto; }
        header { text-align: center; padding: 20px; background: #FF6600; border: 3px solid #FFCC00; border-radius: 10px; margin-bottom: 20px;}
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
        <p>Total Data Terload: <?= count($kelompokTetap) + count($kelompokKontrak) + count($kelompokMagang); ?> Karyawan</p>
    </header>

    <?php if (!empty($kelompokTetap)): ?>
    <div class="section">
        <h3 style="color:#FFCC00;">KARYAWAN TETAP</h3>
        <div class="grid">
            <?php foreach ($kelompokTetap as $kt): ?>
                <div class="card">
                    <h3><?= (fn() => $this->nama_karyawan)->call($kt); ?></h3>
                    <p>ID: <?= (fn() => $this->id_karyawan)->call($kt); ?> | Dept: <?= (fn() => $this->departemen)->call($kt); ?></p>
                    <p class="amount">Rp <?= number_format($kt->hitungGajiBersih(), 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($kelompokKontrak)): ?>
    <div class="section" style="border-color:#FF6600;">
        <h3 style="color:#FF6600;">KARYAWAN KONTRAK</h3>
        <div class="grid">
            <?php foreach ($kelompokKontrak as $kk): ?>
                <div class="card" style="border-left-color:#FF6600;">
                    <h3><?= (fn() => $this->nama_karyawan)->call($kk); ?></h3>
                    <p>ID: <?= (fn() => $this->id_karyawan)->call($kk); ?> | Dept: <?= (fn() => $this->departemen)->call($kk); ?></p>
                    <p class="amount">Rp <?= number_format($kk->hitungGajiBersih(), 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($kelompokMagang)): ?>
    <div class="section" style="border-color:#a200ff;">
        <h3 style="color:#cc66ff;">KARYAWAN MAGANG</h3>
        <div class="grid">
            <?php foreach ($kelompokMagang as $km): ?>
                <div class="card" style="border-left-color:#a200ff;">
                    <h3><?= (fn() => $this->nama_karyawan)->call($km); ?></h3>
                    <p>ID: <?= (fn() => $this->id_karyawan)->call($km); ?> | Dept: <?= (fn() => $this->departemen)->call($km); ?></p>
                    <p class="amount">Rp <?= number_format($km->hitungGajiBersih(), 0, ',', '.'); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
</body>
</html>