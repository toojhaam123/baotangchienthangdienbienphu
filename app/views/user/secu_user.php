<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_Exhibition.php';
if (isset($_SESSION['users']) && $_SESSION['users']['role'] == 2) { ?>
    <div class="row security mt-5">
        <h2 class="text-center">Quản lý bảo mật người dùng</h2>
        <div class="col-md-12">
            <div class="row mt-4">
                <form class="w-50" action="" method="post">
                    <h3 class="text-center mt-2">Thay đổi mật khẩu</h3>
                    <div class="form-group text-start">
                        <label for="email">Email đăng ký tài khoản</label>
                        <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                        <input type="text" class="form-control" name="email" id="email"
                            value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"
                            placeholder="Nhập email">
                    </div>
                    <div class="form-group text-start">
                        <label for="password">Nhập mật khẩu</label>
                        <span>*<?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
                        <input type="password" class="form-control" name="password" id="password"
                            value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>"
                            placeholder="Nhập mật khẩu">
                    </div>
                    <div class="form-group text-start">
                        <label for="re_password">Nhập lại mật khẩu</label>
                        <span>*<?php echo isset($errors['re_pass']) ? $errors['re_pass'] : '' ?></span>
                        <input type="password" class="form-control" name="re_password" id="re_password"
                            value="<?php echo isset($_POST['re_password']) ? $_POST['re_password'] : '' ?>"
                            placeholder="Nhập lại mật khẩu">
                    </div>
                    <button type="submit" name="changePass" class="btn btn-primary w-100 my-2">Thay đổi mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
<?php  } else { ?>
    <p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
?>