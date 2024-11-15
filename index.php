<?php 
if(!isset($_SESSION)) {
    session_start(); 
}
?>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
    $title = "Homepage";
?>
<?php include_once 'database/config.php';?>
<?php include_once 'common/header.php';?>
<?php if(isset($_SESSION["login_id_user"]) && $_SESSION["login_id_user"] != "") {
    if($_SESSION["login_id_level"] == "") {
        include_once 'index-pelanggan.php';
    } else {
        include_once 'index-administrator.php';
    }
 } else { ?>
<h5 class="text-center mb-4 mt-4">Hello, Silahkan masuk atau daftar terlebih dahulu.</h5>
<div class="text-center mb-4">
    <a class="btn btn-success btn-md" href="<?php echo MAIN_URL; ?>/login.php">Login</a>
    &nbsp;
    <a class="btn btn-primary btn-md" href="<?php echo MAIN_URL; ?>/register.php">Register</a>
 </div>
<?php } ?>
<?php include_once 'common/modals.php';?>
<?php include_once 'common/footer.php';?>