<?php 
if(!isset($_SESSION)) {
    session_start(); 
}
?>

<?php
    $title = "Login";
?>

<?php include_once 'common/header.php';?>
<h3 class="text-center text-success mt-4 mb-4">Masukkan usernamd & password untuk masuk ke dashboard anda!</h3>
<div class="row">
    <div class="col mt-3 text-center">
        <h3>BAYAR</h3>
        <img class="w-50" src="<?= MAIN_URL; ?>/assets/img/img-bayar-tagihan-listrik.jpg" alt=""></img>
    </div>
    <div class="col mt-4">
        <form method="POST" action="api/user.php?action=login">
            <?php if(isset($_SESSION['error']) && isset($_SESSION['error']['login'])) { ?>
            <div class="mb-3">
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <div>
                        <i class="fas fa-exclamation-triangle"></i> <?= $_SESSION['error']['login']; ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text"
                    class="form-control <?= isset($_SESSION['error']['username']) ? "is-invalid" : ""; ?>"
                    name="username" placeholder=""
                    value="<?= isset($_SESSION['old']['username']) ? $_SESSION['old']['username'] : ""; ?>"></input>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['username']; ?>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password"
                    class="form-control <?= isset($_SESSION['error']['password']) ? "is-invalid" : ""; ?>"
                    name="password" placeholder=""
                    value="<?= isset($_SESSION['old']['password']) ? $_SESSION['old']['password'] : ""; ?>"></input>
                <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    <?= $_SESSION['error']['password']; ?>
                </div>
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-success form-control">Login</button>
                <p class="text-center mt-2">Belum punya akun? <a href="<?= MAIN_URL; ?>/register.php">Daftar disini!</a>
                </p>
            </div>
        </form>
    </div>
</div>
<?php include_once 'common/footer.php';?>