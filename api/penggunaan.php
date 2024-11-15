<?php 
    // Cek jika belum ada session atau jika session belum di inisiasi
    if(!isset($_SESSION)) {
        // Panggil fungsi session_start untuk memulai session di PHP
        session_start(); 
    }
?>


<?php 
    // Include file config.php yang berisi method untuk operasi database
    include_once ($_SERVER['DOCUMENT_ROOT'] . "/aplikasipembayaranlistrikpascabayar/" . "/database/config.php"); 
?>

<?php
// Inisialisasi nilai variabel action dari parameter GET dengan key "action"
$action = $_GET["action"];

// Cek jika metode request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Cek jika nilai variable $action adalah "create"
    if($action == "create") {
        // Deklarasi dan inisialisasi nilai variabel $id_pelanggan dari session dengan key "login_id_user"
        $id_pelanggan = $_SESSION["login_id_user"];

        // Deklarasi dan inisialisasi nilai variable $bulan dari request POST dengan key "bulan"
        $bulan = $_POST["bulan"];
        // Deklarasi dan inisialisasi tahun variable $bulan dari request POST dengan key "tahun"
        $tahun = $_POST["tahun"];
        // Deklarasi dan inisialisasi meter_awal variable $bulan dari request POST dengan key "meter_awal"
        $meter_awal = $_POST["meter_awal"];
        // Deklarasi dan inisialisasi meter_akhir variable $bulan dari request POST dengan key "meter_akhir"
        $meter_akhir = $_POST["meter_akhir"];

        // Query untuk menambahkan data baru ke table penggunaan
        $query = "INSERT INTO penggunaan(id_pelanggan, bulan, tahun, meter_awal, meter_akhir) VALUES($id_pelanggan, $bulan, $tahun, $meter_awal, $meter_akhir)";
        // Eksekusi Query
        $insertResult = insert_query($db, $query);

        // Cek return hasil eksekusi query berhasil (return true)
        if($insertResult) {
            // Redirect ke halaman /index.php
            header("location: ". MAIN_URL ."/index.php"); exit();
        }
    }
    // Cek jika nilai variable $action adalah "update"
    else if($action == "update") {
        // Deklarasi dan inisialisasi nilai variabel $id_pelanggan dari session dengan key "login_id_user"
        $id_pelanggan = $_SESSION["login_id_user"];

        // InisiDeklarasi dan inisialisasiasi nilai variable $id_penggunaan dari request POST dengan key "id_penggunaan"
        $id_penggunaan = $_POST["id_penggunaan"];
        // Deklarasi dan inisialisasi nilai variable $bulan dari request POST dengan key "bulan"
        $bulan = $_POST["bulan"];
        // Deklarasi dan inisialisasi nilai variable $tahun dari request POST dengan key "tahun"
        $tahun = $_POST["tahun"];
        // Deklarasi dan inisialisasi nilai variable $meter_awal dari request POST dengan key "meter_awal"
        $meter_awal = $_POST["meter_awal"];
        // Deklarasi dan inisialisasi nilai variable $meter_akhir dari request POST dengan key "meter_akhir"
        $meter_akhir = $_POST["meter_akhir"];

        // Query untuk mengubah data penggunaan sesuai dengan id_penggunaan yang dikirim
        $query = "UPDATE penggunaan SET bulan = $bulan, tahun = $tahun, meter_awal = $meter_awal, meter_akhir = $meter_akhir WHERE id_penggunaan = " . $id_penggunaan;
        // Eksekusi Query dan tampung hasil returnnya
        $updateResult = update_query($db, $query);

        // Cek return hasil eksekusi query berhasil (return true)
        if($updateResult) {
            // Redirect ke halaman /index.php
            header("location: ". MAIN_URL ."/index.php"); exit();
        }
    }
    // Cek jika nilai variable $action adalah "delete"
    else if($action == "delete") {
        // Deklarasi dan inisialisasi nilai variable $id_penggunaan dari request POST dengan key "id_penggunaan"
        $id_penggunaan = $_POST["id_penggunaan"];

        // Query untuk menghapus data penggunaan sesuai dengan id_penggunaan yang dikirim
        $queryPenggunaan = "DELETE FROM penggunaan WHERE id_penggunaan = " . $id_penggunaan;
        // Eksekusi Query dan tampung hasil returnnya
        $deletePenggunaanResult = delete_query($db, $queryPenggunaan);

        // Query untuk menghapus data tagihan yang memiliki niai id_penggunaan NULL
        $queryTagihan = "DELETE FROM tagihan WHERE id_penggunaan IS NULL";
        // Eksekusi Query dan tampung hasil returnnya
        $deleteTagihanResult = delete_query($db, $queryTagihan);

        // Cek return hasil eksekusi query (deletePenggunaanResult & deleteTagihanResult) berhasil (return true)
        if($deletePenggunaanResult && $deleteTagihanResult) {
            // Redirect ke halaman /index.php
            header("location: ". MAIN_URL ."/index.php"); exit();
        }
    }
}
?>