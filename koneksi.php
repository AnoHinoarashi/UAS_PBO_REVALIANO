<?php
// =======================================================================================
// FILENAME: koneksi.php
// Deskripsi: File koneksi murni database dengan atribut-atribut konfigurasinya
// =======================================================================================

class Koneksi Database {
    // Atribut / Properti Konfigurasi Database
    private $host     = "localhost";
    private $username = "root"; // Sesuaikan dengan username database Anda
    private $password = "";     // Sesuaikan dengan password database Anda
    private $database = "DB_UAS_PBO_TI1C_REVALIANO";
    protected $db;

    // Method untuk menghubungkan ke database
    public function hubungkan() {
        try {
            // Membuat string DSN (Data Source Name)
            $dsn = "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4";
            
            // Instansiasi objek PDO ke dalam properti db
            $this->db = new PDO($dsn, $this->username, $this->password);
            
            // Mengatur atribut error mode ke Exception
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Mengatur atribut default fetch mode menjadi associative array
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            return $this->db;
        } catch (PDOException $e) {
            // Jika koneksi gagal, hentikan skrip dan tampilkan pesan
            die("Koneksi database gagal: " . $e->getMessage());
        }
    }
}

// Menjalankan koneksi (bisa dipanggil/di-require oleh file class Karyawan nanti)
$koneksi = new KoneksiDatabase();
$db = $koneksi->hubungkan();
?>