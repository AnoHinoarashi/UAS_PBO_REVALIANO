<?php
// KaryawanKontrak.php
require_once 'koneksi.php';
require_once 'Karyawan.php'; // Pastikan file abstract class Karyawan sudah di-require

class KaryawanKontrak extends Karyawan {
    // Properti Tambahan Spesifik Karyawan Kontrak
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;

    // Constructor Kelas Anak
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $durasiKontrak, $agensi) {
        // Mengirimkan properti dasar ke constructor milik Parent Class (Karyawan)
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        
        // Inisialisasi properti spesifik kelas anak
        $this->durasi_kontrak_bulan = $durasiKontrak;
        $this->agensi_penyalur       = $agensi;
    }

    // Mengimplementasikan Abstract Method: HitungGajiBersih()
    public function hitungGajiBersih() {
        // Gaji bersih dihitung dari akumulasi hari kerja dikali gaji dasar per hari
        return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
    }

    // Mengimplementasikan Abstract Method: tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN KONTRAK ===" . PHP_EOL;
        echo "ID Karyawan     : " . $this->id_karyawan . PHP_EOL;
        echo "Nama            : " . $this->nama_karyawan . PHP_EOL;
        echo "Departemen      : " . $this->departemen . PHP_EOL;
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . " hari" . PHP_EOL;
        echo "Gaji Dasar/Hari : Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . PHP_EOL;
        echo "Durasi Kontrak  : " . $this->durasi_kontrak_bulan . " Bulan" . PHP_EOL;
        echo "Agensi Penyalur : " . $this->agensi_penyalur . PHP_EOL;
        echo "TOTAL GAJI BERSIH: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . PHP_EOL;
        echo "=================================" . PHP_EOL;
    }
}
?>