<?php
// KaryawanTetap.php
require_once 'koneksi.php';
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    private $tunjangan_kesehatan;
    private $opsi_saham_id;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjangan, $sahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->tunjangan_kesehatan = $tunjangan;
        $this->opsi_saham_id       = $sahamId;
    }

    // OVERRIDING LOGIKA: Akumulasi harian ditambah tunjangan kesehatan tetap
    public function hitungGajiBersih() {
        $gajiPokokTotal = $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
        return $gajiPokokTotal + $this->tunjangan_kesehatan;
    }

    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN TETAP ===" . PHP_EOL;
        echo "ID Karyawan     : " . $this->id_karyawan . PHP_EOL;
        echo "Nama            : " . $this->nama_karyawan . PHP_EOL;
        echo "Departemen      : " . $this->departemen . PHP_EOL;
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . " hari" . PHP_EOL;
        echo "Gaji Dasar/Hari : Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . PHP_EOL;
        echo "Tunjangan Sehat : Rp " . number_format($this->tunjangan_kesehatan, 0, ',', '.') . PHP_EOL;
        echo "Opsi Saham ID   : " . $this->opsi_saham_id . PHP_EOL;
        echo "TOTAL GAJI BERSIH: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . PHP_EOL;
        echo "===============================" . PHP_EOL;
    }
}
?>