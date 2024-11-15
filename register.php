<?php 
if(!isset($_SESSION)) {
    session_start(); 
}
?>

<?php
    $title = "Login";
?>

<?php include_once 'common/header.php';?>

<h3 class="text-center text-success mt-4 mb-4">Daftarkan diri anda sebagai pelanggan!</h3>
<div class="row">
    <div class="col mt-3 text-center">
        <h3>BAYAR</h3>
        <img class="w-75" src="<?= MAIN_URL; ?>/assets/img/img-bayar-tagihan-listrik.jpg" alt=""></img>
    </div>
    <div class="col mt-3">
        <form method="POST" action="api/user.php?action=register">
            <div class="mb-3">
                <label class="form-label">Nama Pelanggan</label>
                <input type="text" class="form-control <?= isset($_SESSION['error']['nama_pelanggan']) ? "is-invalid" : ""; ?>" name="nama_pelanggan" placeholder="" value="<?= isset($_SESSION['old']['nama_pelanggan']) ? $_SESSION['old']['nama_pelanggan'] : ""; ?>"/>
                <div id="validationServerNamaPelangganFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['nama_pelanggan']; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control <?= isset($_SESSION['error']['username']) ? "is-invalid" : ""; ?>" name="username" placeholder="" value="<?= isset($_SESSION['old']['username']) ? $_SESSION['old']['username'] : ""; ?>"/>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['username']; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Nomor KWH</label>
                <input type="number" class="form-control <?= isset($_SESSION['error']['nomor_kwh']) ? "is-invalid" : ""; ?>" name="nomor_kwh" placeholder="" value="<?= isset($_SESSION['old']['nomor_kwh']) ? $_SESSION['old']['nomor_kwh'] : ""; ?>"/>
                <div id="validationServerNomorKWHFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['nomor_kwh']; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control <?= isset($_SESSION['error']['password']) ? "is-invalid" : ""; ?>" name="password" placeholder="" value="<?= isset($_SESSION['old']['password']) ? $_SESSION['old']['password'] : ""; ?>"/>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['password']; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea type="text" class="form-control <?= isset($_SESSION['error']['alamat']) ? "is-invalid" : ""; ?>" name="alamat" placeholder="" /><?= isset($_SESSION['old']['alamat']) ? $_SESSION['old']['alamat'] : ""; ?></textarea>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['alamat']; ?>
                </div>
            </div>
            <div class="mb-3">
                <?php
                    $data_tarif = get_all_tarif($db);
                ?>
                <label class="form-label">Daya Listrik</label>
                <select class="form-select" name="id_tarif" aria-label="Default select example">
                    <option selected>Pilih Daya Listrik</option>
                    <?php foreach($data_tarif as $tarif) { ?>
                        <option value="<?= $tarif['id_tarif']; ?>"><?= $tarif["daya"]; ?></option>
                    <?php } ?>
                </select>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['password']; ?>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-success form-control">Daftar</button>
                <p class="text-center mt-2">Sudah punya akun? <a href="<?= MAIN_URL; ?>/login.php">Login disini!</a></p>
            </div>
        </form>
    </div>
</div>
<?php include_once 'common/foooter.php';?>