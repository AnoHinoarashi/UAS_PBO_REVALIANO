<?php
class KoneksiDatabase {
    protected $host     = "localhost";
    protected $username = "root"; 
    protected $password = "";     
    protected $database = "DB_UAS_PBO_TI1C_REVALIANO";
    protected $db;

    protected function konfigurasiDanHubungkan() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            $this->db = new PDO($dsn, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->db;
        } catch (PDOException $e) {
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }

    public function dapatkanKoneksi() {
        return $this->konfigurasiDanHubungkan();
    }
}

$koneksi = new KoneksiDatabase();
$db = $koneksi->dapatkanKoneksi(); 
?>