<?php
session_start();
if (isset($_SESSION['users']['user_id'])) {
    unset($_SESSION['users']['user_id']); // Xóa sesion login
    session_destroy(); // Xóa hết session
    $location = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '../index.php';
    unset($_SESSION['redirect_url']); // Xóa đường dẫn sau khi sư dụng
    header("Location: $location"); // Chuyển hướng theo đường dẫn
}
