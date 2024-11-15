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

        // Cek jika nilai variable $action adalah "paid"
        if($action == "paid") {
            // Deklarasi dan inisialisasi nilai variable $id_tagihan dari request POST dengan key "id_tagihan"
            $id_tagihan = $_POST["id_tagihan"];
            
            // Deklarasi dan inisialisasi nilai variable $id_pelanggan dari request POST dengan key "id_pelanggan"
            $id_pelanggan = $_POST["id_pelanggan"];
            
            // Deklarasi dan inisialisasi nilai variable $total_biaya dari request POST dengan key "total_biaya"
            $total_biaya = $_POST["total_biaya"];

            // Deklarasi dan inisialisasi nilai variabel $id_user dari session dengan key "login_id_user"
            $id_user = $_SESSION['login_id_user'];

            // panggil fungsi PHP untuk memulai commit transaction
            mysqli_autocommit($db, FALSE);

            // Query untuk mengubah data tagihan sesuai dengan id_tagihan yang dikirim
            $queryUpdateTagihan = "UPDATE tagihan SET status = 'Sudah Dibayar' WHERE id_tagihan = " . $id_tagihan;
            // Eksekusi Query dan tampung hasil returnnya
            $updateTagihanResult = update_query($db, $queryUpdateTagihan);

            // Query untuk mengubah data pembayaran sesuai dengan id_tagihan yang dikirim
            $queryUpdatePembayaran = "UPDATE pembayaran SET id_user = " . $id_user . " WHERE id_tagihan = " . $id_tagihan;
            // Eksekusi Query dan tampung hasil returnnya
            $updatePembayaranResult = update_query($db, $queryUpdatePembayaran);

            // Cek jika ada kegagalan dalam commit transaksi
            if (!mysqli_commit($db)) {
                // Redirect ke halaman /index.php
                header("location: ". MAIN_URL ."/index.php"); exit();
                exit();
            }

            if($updateTagihanResult && $updatePembayaranResult) {
                header("location: ". MAIN_URL ."/index.php"); exit();
            }
        } else if($action == "confirm") {
            // Deklarasi dan inisialisasi nilai variable $id_tagihan dari request POST dengan key "id_tagihan"
            $id_tagihan = $_POST["id_tagihan"];

            // Deklarasi dan inisialisasi nilai variable $id_pelanggan dari request POST dengan key "id_pelanggan"
            $id_pelanggan = $_POST["id_pelanggan"];

            // Deklarasi dan inisialisasi nilai variable $total_biaya dari request POST dengan key "total_biaya"
            $total_biaya = $_POST["total_biaya"];

            // Deklarasi dan inisialisasi nilai variable $tanggal_pembayaran dari fungsi date() untuk mendapatkan tanggal dan waktu realtime dengan format Y-m-d H:i:s
            // Contoh Data : 2024-11-14 10:00:00
            $tanggal_pembayaran = date('Y-m-d H:i:s');

            // Deklarasi dan inisialisasi nilai variable $bulan_bayar dari fungsi date() untuk mendapatkan bulan realtime
            // Contoh Data : 11
            $bulan_bayar = date('m');

            // Deklarasi dan inisialisasi nilai variable $biaya_admin dengan mengkalkulasikan 10% dari $total_biaya
            $biaya_admin = (10/100) * $total_biaya;

            // Deklarasi dan inisialisasi nilai variable $total_bayar dari hasil penjumlahan total biaya dan biaya admin
            $total_bayar = $total_biaya + $biaya_admin;

            // panggil fungsi PHP untuk memulai commit transaction
            mysqli_autocommit($db, FALSE);
            // Query untuk mengubah data tagihan sesuai dengan id_tagihan yang dikirim
            $query = "UPDATE tagihan SET status = 'Konfirmasi Pembayaran' WHERE id_tagihan = " . $id_tagihan;
            // Eksekusi Query dan tampung hasil returnnya
            $updateResult = update_query($db, $query);
            // Query untuk menambahkan data pembayaran baru
            $queryInsertPembayaran = "INSERT INTO pembayaran(id_tagihan, id_pelanggan, tanggal_pembayaran, bulan_bayar, biaya_admin, total_bayar, id_user) VALUES($id_tagihan, $id_pelanggan, '$tanggal_pembayaran', $bulan_bayar, $biaya_admin, $total_bayar, 1)";
            // Eksekusi Query dan tampung hasil returnnya
            $insertPembayaranResult = insert_query($db, $queryInsertPembayaran);
            
            // Cek jika ada kegagalan dalam commit transaksi
            if (!mysqli_commit($db)) {
                // Redirect ke halaman /index.php
                header("location: ". MAIN_URL ."/index.php"); exit();
                exit();
            }

            if($updateResult && $insertPembayaranResult) {
                // Redirect ke halaman /index.php
                header("location: ". MAIN_URL ."/index.php"); exit();
            }
        }
    }
?>