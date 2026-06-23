<?php
require_once 'Karyawan.php'; // Menghubungkan ke file induk abstrak

class KaryawanTetap extends Karyawan {
    private $tunjangan_kesehatan;
    private $opsi_saham_id;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $tunjangan, $sahamId) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->tunjangan_kesehatan = $tunjangan;
        $this->opsi_saham_id       = $sahamId;
    }

    protected function hitungGajiBersih() {
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) + $this->tunjangan_kesehatan;
    }

    // Jembatan Enkapsulasi agar bisa dibaca di file luar (tampil.php)
    public function ambilGajiBersih() {
        return $this->hitungGajiBersih();
    }
}
?>