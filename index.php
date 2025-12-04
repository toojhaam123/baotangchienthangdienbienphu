<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['success_login'])) {
    echo '<script type="text/javascript">alert("' . $_SESSION['success_login'] . '");</script>';
    unset($_SESSION['success_login']);  // Xóa thông báo sau khi hiển thị
}
header("Content-Type: text/html; charset=UTF-8");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảo tàng Chiến thắng Điện Biên Phủ</title>
    <link rel="icon" href="./image/Logo bảo tàng.png" type="image/x-icon">
    <script src="./public/assets/scripts.js"></script>
    <link rel="stylesheet" href="public/assets/style.css">
    <!-- <link rel="stylesheet" href="public/assets/mobile.css"> -->
    <!-- <link rel="stylesheet" href="public/assets/ipad.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="container-fluid banner">
        <div class="row">
            <?php include './app/views/header/header.php' ?>
        </div>
    </div>
    <div class="container-fluid content-center">
        <div class="row">
            <?php include './app/views/header/nav.php' ?>
            <div class="col-md-12 col-lg-12">
                <div class="row">
                    <?php include './app/views/sidebar/left.php' ?>
                    <?php include './core/view_router.php' ?>
                    <?php include './app/views/sidebar/right.php' ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid footer">
        <div class="row">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/views/footer/footer.php'; ?>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>