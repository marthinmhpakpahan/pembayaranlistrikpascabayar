<?php 
if(!isset($_SESSION)) {
    session_start(); 
}
?>

<?php 
$dataabse_servername = "localhost";
$database_username = "root";
$database_password = "";
$database_name = "pembayaran_listrik_db";

const MAIN_URL = "http://localhost/aplikasipembayaranlistrikpascabayar";

// Create connection
$db = mysqli_connect($dataabse_servername, $database_username, $database_password, $database_name);

if( !$db ){
  die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

function get_all_penggunaan($db, $id_pelanggan="") {
  $data_mode = "administrator";
  $query = "SELECT penggunaan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh FROM penggunaan INNER JOIN pelanggan ON penggunaan.id_pelanggan = pelanggan.id_pelanggan";
  if($id_pelanggan != "") {
    $data_mode = "pelanggan";
    $query = "SELECT * FROM penggunaan WHERE id_pelanggan = " . $id_pelanggan;
  }
  $result = mysqli_query($db, $query);
  $all_penggunaan = [];
  $count = 0;

  $list_table_fields = [
    "administrator" => ["id_penggunaan", "nama_pelanggan", "nomor_kwh", "bulan", "tahun", "meter_awal", "meter_akhir"],
    "pelanggan" => ["id_penggunaan", "bulan", "tahun", "meter_awal", "meter_akhir"]
  ];

  while($row = mysqli_fetch_array($result)) {
    $filtered_data = [];
    foreach($list_table_fields[$data_mode] as $key) {
      $filtered_data[$key] = $row[$key];
    }
    array_push($all_penggunaan, $filtered_data);
  }
  return $all_penggunaan;
}

function get_all_tagihan($db, $id_pelanggan="") {
  $data_mode = "administrator";
  $query = "SELECT tagihan.*, tarif.daya, tarif.tarifperkwh, pelanggan.nama_pelanggan FROM tagihan
    INNER JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan
    INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif";
  if($id_pelanggan != "") {
    $data_mode = "pelanggan";
    $query = "SELECT tagihan.*, tarif.daya, tarif.tarifperkwh FROM tagihan
    INNER JOIN pelanggan ON tagihan.id_pelanggan = pelanggan.id_pelanggan
    INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
    WHERE tagihan.id_pelanggan = " . $id_pelanggan;
  }
  $result = mysqli_query($db, $query);
  $all_tagihan = [];
  
  $list_table_fields = [
    "administrator" => ["id_tagihan", "id_penggunaan", "id_pelanggan", "nama_pelanggan", "bulan", "tahun", "jumlah_meter", "status", "daya", "tarifperkwh"],
    "pelanggan" => ["id_tagihan", "id_penggunaan", "id_pelanggan", "bulan", "tahun", "jumlah_meter", "status", "daya", "tarifperkwh"]
  ];

  while($row = mysqli_fetch_array($result)) {
    $filtered_data = [];
    foreach($list_table_fields[$data_mode] as $key) {
      $filtered_data[$key] = $row[$key];
    }
    array_push($all_tagihan, $filtered_data);
  }
  return $all_tagihan;
}

function get_all_pembayaran($db, $id_pelanggan="") {
  $data_mode = "administrator";
  $query = "SELECT pembayaran.*, tarif.daya, tarif.tarifperkwh, pelanggan.nama_pelanggan, user.nama_admin, tagihan.jumlah_meter, tagihan.status FROM pembayaran
    INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan
    INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan
    INNER JOIN user ON pembayaran.id_user = user.id_user
    INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif";
  if($id_pelanggan != "") {
    $data_mode = "pelanggan";
    $query = "SELECT pembayaran.*, tarif.daya, tarif.tarifperkwh, pelanggan.nama_pelanggan, user.nama_admin, tagihan.jumlah_meter, tagihan.status FROM pembayaran
    INNER JOIN tagihan ON pembayaran.id_tagihan = tagihan.id_tagihan
    INNER JOIN pelanggan ON pembayaran.id_pelanggan = pelanggan.id_pelanggan
    INNER JOIN user ON pembayaran.id_user = user.id_user
    INNER JOIN tarif ON pelanggan.id_tarif = tarif.id_tarif
    WHERE pembayaran.id_pelanggan = " . $id_pelanggan;
  }
  $result = mysqli_query($db, $query);
  $all_tagihan = [];
  
  $list_table_fields = [
    "administrator" => ["id_pembayaran", "id_tagihan", "id_tagihan", "id_pelanggan", "nama_pelanggan", "tanggal_pembayaran", "bulan_bayar", "biaya_admin", "total_bayar", "id_user", "daya", "tarifperkwh", "nama_pelanggan", "nama_admin", "jumlah_meter", "status"],
    "pelanggan" => ["id_pembayaran", "id_tagihan", "id_tagihan", "id_pelanggan", "tanggal_pembayaran", "bulan_bayar", "biaya_admin", "total_bayar", "id_user", "daya", "tarifperkwh", "nama_admin", "jumlah_meter", "status"],
  ];

  while($row = mysqli_fetch_array($result)) {
    $filtered_data = [];
    foreach($list_table_fields[$data_mode] as $key) {
      $filtered_data[$key] = $row[$key];
    }
    array_push($all_tagihan, $filtered_data);
  }
  return $all_tagihan;
}

function get_all_tarif($db) {
  $query = "SELECT * FROM tarif";
  $result = mysqli_query($db, $query);
  $all_tarif = [];

  $list_table_fields = [ "id_tarif", "daya", "tarifperkwh" ];

  while($row = mysqli_fetch_array($result)) {
    $filtered_data = [];
    foreach($list_table_fields as $key) {
      $filtered_data[$key] = $row[$key];
    }
    array_push($all_tarif, $filtered_data);
  }
  return $all_tarif;
}

function insert_query($db, $query) {
  $result = mysqli_query($db, $query);
  return $result;
}

function update_query($db, $query) {
  $result = mysqli_query($db, $query);
  return $result;
}

function delete_query($db, $query) {
  $result = mysqli_query($db, $query);
  return $result;
}

?>