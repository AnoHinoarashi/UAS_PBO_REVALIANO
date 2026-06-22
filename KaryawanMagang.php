<?php
// KaryawanMagang.php
require_once 'koneksi.php';
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    // Properti Tambahan Spesifik Karyawan Magang
    private $uang_saku_bulanan;
    private $sertifikat_kampus_merdeka;

    // Constructor Kelas Anak
    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSaku, $sertifikat) {
        // Mengirimkan properti dasar ke parent constructor
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        
        // Inisialisasi properti spesifik kelas anak
        $this->uang_saku_bulanan         = $uangSaku;
        $this->sertifikat_kampus_merdeka = $sertifikat;
    }

    // Mengimplementasikan Abstract Method: HitungGajiBersih()
    public function hitungGajiBersih() {
        // Gaji bersih dihitung dari akumulasi uang harian ditambah uang saku bulanan tetap
        $gajiHarianTotal = $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
        return $gajiHarianTotal + $this->uang_saku_bulanan;
    }

    // Mengimplementasikan Abstract Method: tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN MAGANG ===" . PHP_EOL;
        echo "ID Karyawan     : " . $this->id_karyawan . PHP_EOL;
        echo "Nama            : " . $this->nama_karyawan . PHP_EOL;
        echo "Departemen      : " . $this->departemen . PHP_EOL;
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . " hari" . PHP_EOL;
        echo "Uang Makan/Hari : Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . PHP_EOL;
        echo "Uang Saku Bulanan: Rp " . number_format($this->uang_saku_bulanan, 0, ',', '.') . PHP_EOL;
        echo "Sertifikat KM   : " . $this->sertifikat_kampus_merdeka . PHP_EOL;
        echo "TOTAL GAJI BERSIH: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . PHP_EOL;
        echo "===============================" . PHP_EOL;
    }
}
?>