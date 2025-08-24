<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_User.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống Bảo tàng chiến tháng Điện Biên Phủ</title>
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
            <h2 class="text-center text-light">ĐĂNG NHẬP</h2>
            <div class="row justify-content-around">
                <form action="" class="col-md-10 col-lg-6 px-5" method="post">
                    <p class="text-center" style="color: red;">Dấu (*) là trường bắt buộc</p>
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <span>*<?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
                        <input type="text" name="username" value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" id="username" class="text-white" placeholder="Tên đăng nhập">
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <span>*<?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
                        <input type="password" name="password" value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" id="password" class="text-white" placeholder="Mật khẩu">
                    </div>
                    <div class="login my-4">
                        <button type="submit" name="login">Đăng nhập</button>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="button" class="" id="btn_forget_pass" data-bs-toggle="collapse" data-bs-target="#forget_pass">
                                Quên mật khẩu</button>
                        </div>
                        <div class="col-md-3">
                            <a class="text-center" href="../../../index.php">Về trang chủ</a>
                        </div>
                        <div class="col-md-6 d-flex">
                            <p>Chưa có tài khoản? <a href="../register/register.php"> Đăng ký ngay?</a></p>
                        </div>
                    </div>

                    <div class="row collapse forget_pass" id="forget_pass">
                        <div class="form-group">
                            <label for="username">Email</label>
                            <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                            <input type="text" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" id="email" class="text-white" placeholder="Nhập email...">
                        </div>
                        <div class="login my-3">
                            <button type="submit" name="forget_pass">Gửi phản hồi</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

</html>