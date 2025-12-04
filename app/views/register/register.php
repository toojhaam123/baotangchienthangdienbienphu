<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_User.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăngký tài khoản Bỏa tàng chiến thắng Điện Biên Phủ</title>
    <link rel="icon" href="../../../image/Logo bảo tàng.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../public/assets/style.css">
    <link rel="stylesheet" href="../../../public/assets/mobile.css">
    <link rel="stylesheet" href="../../../public/assets/ipad.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <div class="form p-4">
            <h2 class="text-center text-light">ĐĂNG KÝ</h2>
            <div class="row justify-content-around">
                <form action="" class="col-md-10 col-lg-6 px-5" method="post">
                    <p class="text-center" style="color: red;">Dấu (*) là trường bắt buộc</p>
                    <div class="form-group">
                        <label for="fullname">Họ và tên</label>
                        <input type="text" id="fullname" name="fullname" value="<?php echo isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" class="text-white" placeholder="Họ và tên">
                    </div>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <span>*<?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
                        <input type="text" name="username" id="username" class="text-white" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                        <input type="text" name="email" id="email" class="text-white" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <span>*<?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
                        <input type="password" name="password" id="password" class="text-white" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" placeholder="Mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="re_password">Nhập lại mật khẩu</label>
                        <span>*<?php echo isset($errors['re_password']) ? $errors['re_password'] : '' ?></span>
                        <input type="password" name="re_password" id="re_password" class="text-white" value="<?php echo isset($_POST['re_password']) ? $_POST['re_password'] : '' ?>" placeholder="Nhập lại mật khẩu">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <span><?php echo isset($errors['phone']) ? '*' . $errors['phone'] : '' ?></span>
                        <input type="text" name="phone" id="phone" class="text-white" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" placeholder="Số điện thoại">
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="text-white" value="<?php echo isset($_POST['address']) ? $_POST['address'] : '' ?>" placeholder="Địa chỉ">
                    </div>
                    <div class="register my-4">
                        <button type="submit" name="register">Đăng ký</button>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            <a href="../login/login.php">Trang đăng nhập</a>
                        </div>
                        <div class="col-md-4">
                            <a href="../../../index.php">Về trang chủ</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>