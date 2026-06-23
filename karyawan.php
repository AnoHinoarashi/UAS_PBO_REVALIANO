<?php
// Abstract class berdiri sendiri di file terpisah sesuai aturan PBO
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

    // Menggunakan Protected Method sesuai aturan enkapsulasi keluarga class
    abstract protected function hitungGajiBersih();
}
?>