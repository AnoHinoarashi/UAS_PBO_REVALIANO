<?php
require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    private $durasi_kontrak_bulan;
    private $agensi_penyalur;

    public function __construct($id, $nama, $dept, $hariKerja, $gajiDasar, $durasi, $agensi) {
        parent::__construct($id, $nama, $dept, $hariKerja, $gajiDasar);
        $this->durasi_kontrak_bulan = $durasi;
        $this->agensi_penyalur       = $agensi;
    }

    protected function hitungGajiBersih() { 
        return $this->hari_kerja_masuk * $this->gaji_dasar_per_hari; 
    }

    public function ambilGajiBersih() {
        return $this->hitungGajiBersih();
    }
}
?>