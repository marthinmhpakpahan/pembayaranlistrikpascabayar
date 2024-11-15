<?php 
if(!isset($_SESSION)) {
    session_start(); 
}
?>
<?php include_once ($_SERVER['DOCUMENT_ROOT'] . "/aplikasipembayaranlistrikpascabayar/" . "/database/config.php"); ?>

<?php
$action = $_GET["action"];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if($action == "login") {
        $username = $_POST["username"] ?: "";
        $password = $_POST["password"] ?: "";

        $_SESSION['old']['username'] = $username;
        $_SESSION['old']['password'] = $password;

        if($username != "" && $password != "") {
            $valid = FALSE;
            unset($_SESSION['error']);
            unset($_SESSION['old']);
            $checkUserQuery = "SELECT * FROM user WHERE username = '" . $username . "' AND password = PASSWORD('" . $password . "') LIMIT 1";
            $checkUserResult = $db->query($checkUserQuery)->fetch_assoc();
            $checkPelangganQuery = "SELECT * FROM pelanggan WHERE username = '" . $username . "' AND password = PASSWORD('" . $password . "') LIMIT 1";
            $checkPelangganResult = $db->query($checkPelangganQuery)->fetch_assoc();
            if ($checkUserResult && $checkUserResult['id_user'] != "") {
                $valid = TRUE;
                $_SESSION['login_id_user'] = $checkUserResult["id_user"];
                $_SESSION['login_username'] = $checkUserResult["username"];
                $_SESSION['login_nama'] = $checkUserResult["nama_admin"];
                $_SESSION['login_id_level'] = $checkUserResult["id_level"];
            }
            if($checkPelangganResult && $checkPelangganResult['id_pelanggan'] != "") {
                $valid = TRUE;
                $_SESSION['login_id_user'] = $checkPelangganResult["id_pelanggan"];
                $_SESSION['login_username'] = $checkPelangganResult["username"];
                $_SESSION['login_nama'] = $checkPelangganResult["nama_pelanggan"];
                $_SESSION['login_id_level'] = $checkPelangganResult["id_level"];
            }

            if($valid) {
                unset($_SESSION["error"]);
                header("location: ". MAIN_URL ."/index.php"); exit();
            } else {
                // echo "USER NOT FOUND"; exit(); // hapus/comment code ini

                // tambahkan pesan error dan recirect ke halaman login
                $_SESSION['error']['login'] = "Username anda tidak terdaftar!";
                $_SESSION['old']['username'] = $username;
                $_SESSION['old']['password'] = $password;
                header("location: ". MAIN_URL ."/login.php"); exit();
            }
        } else {
            if($username == "") {
                $_SESSION['error']['username'] = "Username tidak boleh kosong";
            } else {
                unset($_SESSION['error']['username']);
            }
            if($password == "") {
                $_SESSION['error']['password'] = "Password tidak boleh kosong";
            } else {
                unset($_SESSION['error']['password']);
            }
            header("location: ". MAIN_URL ."/login.php"); exit();
        }
    }
    if($action == "register") {
        $nama_pelanggan = $_POST["nama_pelanggan"];
        $username = $_POST["username"];
        $nomor_kwh = $_POST["nomor_kwh"];
        $password = $_POST["password"];
        $id_tarif = $_POST["id_tarif"];
        $alamat = $_POST["alamat"];
        
        if($nama_pelanggan != "" && $username != "" && $nomor_kwh != "" && $password != "" && $alamat != "") {
            $queryInsert = "INSERT INTO pelanggan(username, password, nomor_kwh, nama_pelanggan, alamat, id_tarif) VALUES('$username', PASSWORD('$password'), $nomor_kwh, '$nama_pelanggan', '$alamat', $id_tarif)";
            $insertResult = insert_query($db, $queryInsert);
            if($insertResult) {
                header("location: ". MAIN_URL ."/login.php"); exit();
            }
        } else {
            if($username == "") {
                $_SESSION['error']['username'] = "Username tidak boleh kosong";
            } else {
                unset($_SESSION['error']['username']);
            }
            if($nama_pelanggan == "") {
                $_SESSION['error']['nama_pelanggan'] = "Nama Pelanggan tidak boleh kosong";
            } else {
                unset($_SESSION['error']['nama_pelanggan']);
            }
            if($nomor_kwh == "") {
                $_SESSION['error']['nomor_kwh'] = "Nomor KWH tidak boleh kosong";
            } else {
                unset($_SESSION['error']['nomor_kwh']);
            }
            if($alamat == "") {
                $_SESSION['error']['alamat'] = "Alamat tidak boleh kosong";
            } else {
                unset($_SESSION['error']['alamat']);
            }
            if($password == "") {
                $_SESSION['error']['password'] = "Password tidak boleh kosong";
            } else {
                unset($_SESSION['error']['password']);
            }
            header("location: ". MAIN_URL ."/register.php"); exit();
        }
    }
} else {
    if($action == "logout") {
        unset($_SESSION['login_id_user']);
        unset($_SESSION['login_username']);
        unset($_SESSION['login_nama']);
        unset($_SESSION['login_id_level']);
        unset($_SESSION['error']);
        session_destroy();
        header("location: ". MAIN_URL ."/index.php");
        exit();
    }
}
?>