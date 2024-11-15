<?php include_once ($_SERVER['DOCUMENT_ROOT'] . "/aplikasipembayaranlistrikpascabayar/" . 'database/config.php'); ?>
<?php 
if(!isset($_SESSION)) {
    session_start(); 
}
?>
<html>

<head>
    <title><?php echo $title; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo MAIN_URL; ?>/assets/css/font-awesome.min.css" />
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center bg-success text-white">
                        <a href="<?php echo MAIN_URL; ?>/index.php" class="text-white"><i class="fas fa-home"></i></a> <?php echo $title; ?>
                    </div>
                    <div class="card-body">