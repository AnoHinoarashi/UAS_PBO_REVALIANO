<?php
// KaryawanTetap.php
require_once 'koneksi.php';
require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    // Properti Tambahan Spesifik Karyawan Tetap
    private $tunjangan_kesehatan;
    private $opsi_saham_id;

    // Constructor Kelas Anak
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjangan, $sahamId) {
        // Mengirimkan properti dasar ke parent constructor
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        
        // Inisialisasi properti spesifik kelas anak
        $this->tunjangan_kesehatan = $tunjangan;
        $this->opsi_saham_id       = $sahamId;
    }

    // Mengimplementasikan Abstract Method: HitungGajiBersih()
    public function hitungGajiBersih() {
        // Gaji bersih dihitung dari gaji harian ditambah tunjangan kesehatan tetap
        $gajiDasarTotal = $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
        return $gajiDasarTotal + $this->tunjangan_kesehatan;
    }

    // Mengimplementasikan Abstract Method: tampilkanProfilKaryawan()
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