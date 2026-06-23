<?php
require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    private $uang_saku_bulanan;
    private $sertifikat_kampus_merdeka;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $uangSaku, $sertifikat) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->uang_saku_bulanan         = $uangSaku;
        $this->sertifikat_kampus_merdeka = $sertifikat;
    }

    // Overriding: Potongan biaya pelatihan 20% (hanya menerima 80%)
    protected function hitungGajiBersih() { 
        return ($this->hari_kerja_masuk * $this->gaji_dasar_per_hari) * 0.80; 
    }

    public function ambilGajiBersih() {
        return $this->hitungGajiBersih();
    }
}
?>