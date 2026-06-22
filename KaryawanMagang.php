<?php
// KaryawanMagang.php
require_once 'koneksi.php';
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uang_saku_bulanan; // Properti ini tetap ada sesuai struktur tabel awal Anda
    private $sertifikat_kampus_merdeka;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSaku, $sertifikat) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->uang_saku_bulanan         = $uangSaku;
        $this->sertifikat_kampus_merdeka = $sertifikat;
    }

    // OVERRIDING LOGIKA: Menerima potongan 20% (dikalikan 0.80) dari plafon harian untuk biaya program orientasi
    public function hitungGajiBersih() {
        $plafonHarian = $this->hari_kerja_masuk * $this->gaji_dasar_per_hari;
        return $plafonHarian * 0.80;
    }

    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN MAGANG ===" . PHP_EOL;
        echo "ID Karyawan     : " . $this->id_karyawan . PHP_EOL;
        echo "Nama            : " . $this->nama_karyawan . PHP_EOL;
        echo "Departemen      : " . $this->departemen . PHP_EOL;
        echo "Hari Kerja Masuk: " . $this->hari_kerja_masuk . " hari" . PHP_EOL;
        echo "Plafon/Hari     : Rp " . number_format($this->gaji_dasar_per_hari, 0, ',', '.') . " (Sebelum Potongan)" . PHP_EOL;
        echo "Sertifikat KM   : " . $this->sertifikat_kampus_merdeka . PHP_EOL;
        echo "TOTAL GAJI BERSIH: Rp " . number_format($this->hitungGajiBersih(), 0, ',', '.') . " (Setelah Potongan 20%)" . PHP_EOL;
        echo "===============================" . PHP_EOL;
    }
}
?>