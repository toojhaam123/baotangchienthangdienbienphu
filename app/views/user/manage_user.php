<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_User.php';
if (isset($_SESSION['users']) && (($_SESSION['users']['role'] == 1) || ($_SESSION['users']['role'] == 2))) {
    $countErr = 0;
    foreach ($permissions as $per_condition) {
        if (($per_condition['user_id'] == $_SESSION['users']['user_id']) && ($per_condition['mana_user'] == 1)) {
            $countErr += 1; ?>
            <div class="row manager">
                <div class="my-3 border-bottom col-md-12 text-center">
                    <h2>Quản lý người dùng </h2>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10">
                            <h5>Bảng danh sách những người dùng</h5>
                        </div>
                        <div class="col-md-2 text-center">
                            <button
                                type="button"
                                class="btn btn-success"
                                data-bs-toggle="modal"
                                data-bs-target="#add_user"
                                <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && ($per_condition['add_user'] != 1)) ? 'disabled' : '' ?>>
                                <i class="bx bx-plus"></i> Thêm mới
                            </button>
                        </div>
                        <!-- Cửa sổ thêm mới người dùng -->
                        <div
                            class="modal fade"
                            id="add_user"
                            tabindex="-1">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">
                                            Thêm người dùng mới
                                        </h5>
                                        <button
                                            type="button"
                                            class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Form thêm mới người dùng -->
                                        <form action="" method="post">
                                            <p class="text-center" style="color: red;">Dấu (*) là trường bắt buộc</p>
                                            <div class="form-group text-start">
                                                <label for="fullname">Họ và tên</label>
                                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?php isset($_POST['fullname']) ? $_POST['fullname'] : '' ?>" placeholder="Họ và tên">
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="username">Tên đăng nhập</label>
                                                <span>*<?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
                                                <input class="form-control" type="text" name="username" value="<?php isset($_POST['username']) ? $_POST['username'] : '' ?>" id="username" placeholder="Tên người dùng" require>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="password">Mật khẩu</label>
                                                <span>*<?php echo isset($errors['password']) ? $errors['password'] : '' ?></span>
                                                <input class="form-control" type="password" name="password" id="password" value="<?php isset($_POST['password']) ? $_POST['password'] : '' ?>" placeholder="Mật khẩu" require>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="re_password">Nhập lại mật khẩu</label>
                                                <span>*<?php echo isset($errors['re_password']) ? $errors['re_password'] : '' ?></span>
                                                <input class="form-control" type="password" name="re_password" id="re_password" value="<?php isset($_POST['re_password']) ? $_POST['re_password'] : '' ?>" placeholder="Nhập lại mật khẩu" require>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="email">Email</label>
                                                <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                                                <input class="form-control" type="email" name="email" id="email" value="<?php isset($_POST['email']) ? $_POST['email'] : '' ?>" placeholder="Email" require>
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="phone">Số điện thoại</label>
                                                <span><?php echo isset($errors['phone']) ? '*' . $errors['phone'] : '' ?></span>
                                                <input class="form-control" type="text" name="phone" id="phone" value="<?php isset($_POST['phone']) ? $_POST['phone'] : '' ?>" placeholder="Số điện thoại">
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="address">Đại chỉ</label>
                                                <input class="form-control" type="text" name="address" id="address" value="<?php isset($_POST['address']) ? $_POST['address'] : '' ?>" placeholder="Địa chỉ">
                                            </div>
                                            <div class="form-group text-start">
                                                <label for="role">Vai trò</label>
                                                <select name="role" id="role" class="form-select bg-light">
                                                    <option value="1" <?php echo isset($_POST['role']) && ($_POST['role'] == 1) ? 'selected' : '' ?>>Nhân viên</option>
                                                    <option value="2" <?php echo isset($_POST['role']) && ($_POST['role'] == 2) ? 'selected' : '' ?>>Quản trị viên</option>
                                                </select>
                                            </div>
                                            <button type="submit" name="register" class="btn btn-primary mt-2 float-end">Thêm mới</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <form action="" method="post">
                                <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
                                <button type="submit" class="btn <?php echo isset($_POST['staff']) ? 'btn-primary' : '' ?>" name="staff">Nhân viên</button>
                                <button type="submit" class="btn <?php echo isset($_POST['visitor']) ? 'btn-primary' : '' ?>" name="visitor">Khách tham quan</button>
                            </form>
                        </div>
                        <div class="col-md-12 mt-2">
                            <table class="table table-hover table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>ID</th>
                                        <th>Họ và tên</th>
                                        <th>Tên đăng nhập</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Trạng thái</th>
                                        <th>Vai trò</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <?php
                                $countId = 0;
                                foreach ($users as $user) {
                                    $countId += 1;
                                    if (isset($_POST['staff'])) {
                                        if ($user['role'] == 1) { ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo isset($user['user_id']) ? $user['user_id'] : '' ?></td>
                                                    <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                    <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                    <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                    <td><?php echo isset($user['phone']) ? $user['phone'] : '' ?></td>
                                                    <td>
                                                        <?php
                                                        if ($user['status'] == 1) { ?>
                                                            <p class="text-success">Hoạt động</p>
                                                        <?php } else { ?>
                                                            <p class="text-danger">Bị khóa</p>
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                        if ($user['role'] == 0) {
                                                            echo "Khách tham quan";
                                                        } elseif ($user['role'] == 1) {
                                                            echo "Nhân viên";
                                                        } elseif ($user['role'] == 2) {
                                                            echo "Quản trị viên";
                                                        }

                                                        ?></td>
                                                    <td>
                                                        <div class="dropdown dropdown-user">
                                                            <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                                                <i class="bx bx-cog"></i>Tùy chọn
                                                            </button>
                                                            <ul class="dropdown-menu col-md-12 mana_action">
                                                                <div class="dropdown-item">
                                                                    <!-- nút ẩn hiện phần chỉnh sửa người dùng -->
                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-secondary d-flex w-100 justify-content-center"
                                                                        data-bs-toggle="modal"
                                                                        <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && $per_condition['edit_user'] != 1) ? 'disabled' : '' ?>
                                                                        data-bs-target="#edit_user<?php echo $countId ?>">
                                                                        <i class="bx bx-edit p-1"></i>Sửa
                                                                    </button>
                                                                </div>
                                                                <div class="dropdown-item">
                                                                    <button
                                                                        type="button"
                                                                        class="btn btn-danger d-flex w-100 justify-content-center"
                                                                        data-bs-toggle="modal"
                                                                        <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && $per_condition['delete_user'] != 1) ? 'disabled' : '' ?>
                                                                        data-bs-target="#delete_user<?php echo $countId ?>">
                                                                        <i class="bx bx-trash p-1"></i>Xóa
                                                                    </button>
                                                                </div>
                                                                <!-- Khóa hoặc mở khóa tài khoản người dùng -->
                                                                <div class="dropdown-item">
                                                                    <form action="" method="post">
                                                                        <?php
                                                                        if ($_SESSION['users']['role'] == 2) {
                                                                            if ($user['status'] == 1) { ?>
                                                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                                                <input type="hidden" name="status" value="<?php echo $user['status'] ?>">
                                                                                <button type="submit" class="btn btn-warning d-flex w-100 justify-content-center"
                                                                                    name="change_status_user"><i class="bx bx-lock p-1"></i>Khóa</button>
                                                                            <?php } else { ?>
                                                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                                                <input type="hidden" name="status" value="<?php echo $user['status'] ?>">
                                                                                <button type="submit" class="btn btn-warning d-flex w-100 justify-content-center"
                                                                                    name="change_status_user"><i class="bx bx-lock-open p-1"></i>Mở</button>
                                                                        <?php  }
                                                                        }
                                                                        ?>
                                                                    </form>
                                                                </div>

                                                                <?php
                                                                if ($_SESSION['users']['role'] == 2) { ?>
                                                                    <div class="dropdown-item">
                                                                        <button type="button" class="btn btn-info d-flex w-100 justify-content-center"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#permissions<?php echo $countId ?>">
                                                                            <i class="bx bx-lock p-1"></i>Phân quyền</button>
                                                                    </div>
                                                                <?php   }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                        <!-- Cửa sổ chỉnh người dùng -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_user<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa thông tin người dùng
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa người dùng -->
                                                                        <form action="" method="post">
                                                                            <p class="text-center" style="color: red;">Dấu (*) là trường bắt buộc</p>
                                                                            <div class="form-group text-start">
                                                                                <label for="fullname">Họ và tên</label>
                                                                                <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo isset($user['fullname']) ? $user['fullname'] : '' ?>" placeholder="Họ và tên">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="username">Tên đăng nhập</label>
                                                                                <span>*<?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
                                                                                <input class="form-control" type="text" name="username" id="username" value="<?php echo isset($user['username']) ? $user['username'] : '' ?>" placeholder=" Tên người dùng" require>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="email">Email</label>
                                                                                <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                                                                                <input class="form-control" type="email" name="email" id="email" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" placeholder=" Email" require>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="phone">Số điện thoại</label>
                                                                                <span><?php echo isset($errors['phone']) ? '*' . $errors['phone'] : '' ?></span>
                                                                                <input class="form-control" type="text" name="phone" id="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : '' ?>" placeholder=" Số điện thoại">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="address">Đại chỉ</label>
                                                                                <input class="form-control" type="text" name="address" id="address" value="<?php echo isset($user['address']) ? $user['address'] : '' ?>" placeholder=" Địa chỉ">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="role">Vai trò</label>
                                                                                <select name="role" id="role" class="form-select">
                                                                                    <option value="0" <?php echo isset($user['role']) && ($user['role'] == 0) ? 'selected' : '' ?>>Khách tham quan</option>
                                                                                    <option value="1" <?php echo isset($user['role']) && ($user['role'] == 1) ? 'selected' : '' ?>>Nhân viên</option>
                                                                                    <option value="2" <?php echo isset($user['role']) && ($user['role'] == 2) ? 'selected' : '' ?>>Quản trị viên</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                                            <button type="submit" name="edit_user" class="btn btn-primary mt-2 float-end">Lưa chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Cửa sổ xóa người dùng -->
                                                        <div
                                                            class="modal fade"
                                                            id="delete_user<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa người dùng này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Họ và tên</th>
                                                                                        <th>Tên người dùng</th>
                                                                                        <th>Địa chỉ email</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                                                        <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                                                        <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa người dùng -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                                            <button type="submit" name="delete_users" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Cửa sổ phân quyền người dùng -->
                                                        <div
                                                            class="modal fade"
                                                            id="permissions<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog permissions-size" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Phân quyền người dùng
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Họ và tên</th>
                                                                                        <th>Tên người dùng</th>
                                                                                        <th>Địa chỉ email</th>
                                                                                        <th>Vai trò</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                                                        <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                                                        <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                                                        <td><?php
                                                                                            if (isset($user['role'])) {
                                                                                                if ($user['role'] == 0) {
                                                                                                    echo 'Khách tham quan';
                                                                                                } elseif ($user['role'] == 1) {
                                                                                                    echo 'Nhân viên';
                                                                                                } elseif ($user['role'] == 2) {
                                                                                                    echo 'Quản trị viên';
                                                                                                }
                                                                                            } else {
                                                                                                echo "";
                                                                                            }
                                                                                            ?></td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        <?php
                                                                        foreach ($permissions as $permission) {
                                                                            if ($permission['user_id'] == $user['user_id']) { ?>
                                                                                <div class="row border">
                                                                                    <form action="" class="d-flex gap-1" method="post">
                                                                                        <div class="col-md-2 border-end pe-2">
                                                                                            <div class="mb-3">
                                                                                                <label for="role">Chọn vai trò người dùng</label>
                                                                                                <select name="role" id="role" class="form-control">
                                                                                                    <option value="0" <?php echo isset($user['role']) && ($user['role'] == 0) ? 'selected' : '' ?>>Khách tham quan</option>
                                                                                                    <option value="1" <?php echo isset($user['role']) && ($user['role'] == 1) ? 'selected' : '' ?>>Nhân viên</option>
                                                                                                    <option value="2" <?php echo isset($user['role']) && ($user['role'] == 2) ? 'selected' : '' ?>>Quản trị viên</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-10">
                                                                                            <div class="row">
                                                                                                <div class="col-md-2 border-end">
                                                                                                    <p>Quyền người dùng</p>
                                                                                                    <div class="form-check">
                                                                                                        <input type="checkbox" class="form-check-input" id="comment"
                                                                                                            <?php echo isset($permission['comment']) && ($permission['comment'] == 1) ? 'checked' : '' ?>
                                                                                                            name="comment" value="1">
                                                                                                        <label for="" class="form-check">
                                                                                                            <p>Bình luận</p>
                                                                                                        </label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- Quyền quản lý -->
                                                                                                <div class="col-md-10">
                                                                                                    <p>Quyền quản lý</p>
                                                                                                    <!-- Hiện vật -->
                                                                                                    <div class="form-check d-flex border-bottom">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerArtifact"
                                                                                                                <?php echo isset($permission['mana_artifact']) && ($permission['mana_artifact'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_artifact" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý hiện vật</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="add_artifact" value="1"
                                                                                                                <?php echo isset($permission['add_artifact']) && ($permission['add_artifact'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Thêm</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="edit_artifact" value="1"
                                                                                                                <?php echo isset($permission['edit_artifact']) && ($permission['edit_artifact'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Sửa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_artifact" value="1"
                                                                                                                <?php echo isset($permission['delete_artifact']) && ($permission['delete_artifact'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- Tin tức -->
                                                                                                    <div class="form-check d-flex border-bottom">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerNews"
                                                                                                                <?php echo isset($permission['mana_news']) && ($permission['mana_news'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_news" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý tin tức - sự kiện</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="add_news" value="1"
                                                                                                                <?php echo isset($permission['add_news']) && ($permission['add_news'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Thêm</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="edit_news" value="1"
                                                                                                                <?php echo isset($permission['edit_news']) && ($permission['edit_news'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Sửa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_news" value="1"
                                                                                                                <?php echo isset($permission['delete_news']) && ($permission['delete_news'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="form-check d-flex border-bottom">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerGallery"
                                                                                                                <?php echo isset($permission['mana_gallery']) && ($permission['mana_gallery'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_gallery" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý hình ảnh - video</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="add_gallery" value="1"
                                                                                                                <?php echo isset($permission['add_gallery']) && ($permission['add_gallery'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Thêm</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="edit_gallery" value="1"
                                                                                                                <?php echo isset($permission['edit_gallery']) && ($permission['edit_gallery'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Sửa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_gallery" value="1"
                                                                                                                <?php echo isset($permission['delete_gallery']) && ($permission['delete_gallery'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- Giới thiệu -->
                                                                                                    <div class="form-check d-flex border-bottom">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerIntroduction"
                                                                                                                <?php echo isset($permission['mana_introduction']) && ($permission['mana_introduction'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_introduction" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý giới thiệu</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="add_introduction" value="1"
                                                                                                                <?php echo isset($permission['add_introduction']) && ($permission['add_introduction'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Thêm</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <div class="col-md-3">
                                                                                                                <input type="checkbox" class="form-check-input" name="edit_introduction" value="1"
                                                                                                                    <?php echo isset($permission['edit_introduction']) && ($permission['edit_introduction'] == 1) ? 'checked' : '' ?>>
                                                                                                                <label for="" class="form-check">
                                                                                                                    <p>Sửa</p>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_introduction" value="1"
                                                                                                                <?php echo isset($permission['delete_introduction']) && ($permission['delete_introduction'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- Bình luận -->
                                                                                                    <div class="form-check d-flex border-bottom">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerCommet"
                                                                                                                <?php echo isset($permission['mana_comment']) && ($permission['mana_comment'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_comment" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý bình luận</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3"></div>
                                                                                                        <div class="col-md-3"></div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_comment" value="1"
                                                                                                                <?php echo isset($permission['delete_comment']) && ($permission['delete_comment'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- Triển lãm -->
                                                                                                    <div class="form-check d-flex border-bottom">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerExhibition"
                                                                                                                <?php echo isset($permission['mana_exhibition']) && ($permission['mana_exhibition'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_exhibition" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý triển lãm</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <div class="col-md-3">
                                                                                                                <input type="checkbox" class="form-check-input" name="add_exhibition" value="1"
                                                                                                                    <?php echo isset($permission['add_exhibition']) && ($permission['add_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                                                                <label for="" class="form-check">
                                                                                                                    <p>Thêm</p>
                                                                                                                </label>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="edit_exhibition" value="1"
                                                                                                                <?php echo isset($permission['edit_exhibition']) && ($permission['edit_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Sửa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_exhibition" value="1"
                                                                                                                <?php echo isset($permission['delete_exhibition']) && ($permission['delete_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <!-- Người dùng -->
                                                                                                    <div class="form-check d-flex">
                                                                                                        <div class="col-md-4">
                                                                                                            <input type="checkbox" class="form-check-input" id="managerUser"
                                                                                                                <?php echo isset($permission['mana_user']) && ($permission['mana_user'] == 1) ? 'checked' : '' ?>
                                                                                                                name="mana_user" value="1">
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Quản lý người dùng</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="add_user" value="1"
                                                                                                                <?php echo isset($permission['add_user']) && ($permission['add_user'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Thêm</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="edit_user" value="1"
                                                                                                                <?php echo isset($permission['edit_user']) && ($permission['edit_user'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Sửa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                        <div class="col-md-3">
                                                                                                            <input type="checkbox" class="form-check-input" name="delete_user" value="1"
                                                                                                                <?php echo isset($permission['delete_user']) && ($permission['delete_user'] == 1) ? 'checked' : '' ?>>
                                                                                                            <label for="" class="form-check">
                                                                                                                <p>Xóa</p>
                                                                                                            </label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                                        <button type="submit" name="permissions_user" class="btn btn-primary d-flex">
                                                                            <i class='bx bxs-save p-1'></i>Lưu quyền
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                </form>
                                                            </div>
                                                    <?php }
                                                                        } ?>
                                                        </div>

                        </div>
                    </div>
                </div>
                </td>
                </tr>
                </tbody>
            <?php }
                                    } elseif (isset($_POST['visitor'])) {
                                        if ($user['role'] == 0) { ?>
                <tbody>
                    <tr>
                        <td><?php echo isset($user['user_id']) ? $user['user_id'] : '' ?></td>
                        <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                        <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                        <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                        <td><?php echo isset($user['phone']) ? $user['phone'] : '' ?></td>
                        <td>
                            <?php
                                            if ($user['status'] == 1) { ?>
                                <p class="text-success">Hoạt động</p>
                            <?php } else { ?>
                                <p class="text-danger">Bị khóa</p>
                            <?php }
                            ?>
                        </td>
                        <td><?php
                                            if ($user['role'] == 0) {
                                                echo "Khách tham quan";
                                            } elseif ($user['role'] == 1) {
                                                echo "Nhân viên";
                                            } elseif ($user['role'] == 2) {
                                                echo "Quản trị viên";
                                            }

                            ?></td>
                        <td>
                            <div class="dropdown dropdown-user">
                                <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                                    <i class="bx bx-cog"></i>Tùy chọn
                                </button>
                                <ul class="dropdown-menu col-md-12 mana_action">
                                    <div class="dropdown-item">
                                        <!-- nút ẩn hiện phần chỉnh sửa người dùng -->
                                        <button
                                            type="button"
                                            class="btn btn-secondary d-flex w-100 justify-content-center"
                                            data-bs-toggle="modal"
                                            <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && $per_condition['edit_user'] != 1) ? 'disabled' : '' ?>
                                            data-bs-target="#edit_user<?php echo $countId ?>">
                                            <i class="bx bx-edit p-1"></i>Sửa
                                        </button>
                                    </div>
                                    <div class="dropdown-item">
                                        <button
                                            type="button"
                                            class="btn btn-danger d-flex w-100 justify-content-center"
                                            data-bs-toggle="modal"
                                            <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && $per_condition['delete_user'] != 1) ? 'disabled' : '' ?>
                                            data-bs-target="#delete_user<?php echo $countId ?>">
                                            <i class="bx bx-trash p-1"></i>Xóa
                                        </button>
                                    </div>
                                    <!-- Khóa hoặc mở khóa tài khoản người dùng -->
                                    <div class="dropdown-item">
                                        <form action="" method="post">
                                            <?php
                                            if ($_SESSION['users']['role'] == 2) {
                                                if ($user['status'] == 1) { ?>
                                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                    <input type="hidden" name="status" value="<?php echo $user['status'] ?>">
                                                    <button type="submit" class="btn btn-warning d-flex w-100 justify-content-center"
                                                        name="change_status_user"><i class="bx bx-lock p-1"></i>Khóa</button>
                                                <?php } else { ?>
                                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                    <input type="hidden" name="status" value="<?php echo $user['status'] ?>">
                                                    <button type="submit" class="btn btn-warning d-flex w-100 justify-content-center"
                                                        name="change_status_user"><i class="bx bx-lock-open p-1"></i>Mở</button>
                                            <?php  }
                                            }
                                            ?>
                                        </form>
                                    </div>

                                    <?php
                                            if ($_SESSION['users']['role'] == 2) { ?>
                                        <div class="dropdown-item">
                                            <button type="button" class="btn btn-info d-flex w-100 justify-content-center"
                                                data-bs-toggle="modal"
                                                data-bs-target="#permissions<?php echo $countId ?>">
                                                <i class="bx bx-lock p-1"></i>Phân quyền</button>
                                        </div>
                                    <?php   }
                                    ?>
                                </ul>
                            </div>
                            <!-- Cửa sổ chỉnh người dùng -->
                            <div
                                class="modal fade"
                                id="edit_user<?php echo $countId ?>"
                                tabindex="-1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Chỉnh sửa thông tin người dùng
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Form chỉnh sửa người dùng -->
                                            <form action="" method="post">
                                                <p class="text-center" style="color: red;">Dấu (*) là trường bắt buộc</p>
                                                <div class="form-group text-start">
                                                    <label for="fullname">Họ và tên</label>
                                                    <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo isset($user['fullname']) ? $user['fullname'] : '' ?>" placeholder="Họ và tên">
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="username">Tên đăng nhập</label>
                                                    <span>*<?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
                                                    <input class="form-control" type="text" name="username" id="username" value="<?php echo isset($user['username']) ? $user['username'] : '' ?>" placeholder=" Tên người dùng" require>
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="email">Email</label>
                                                    <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                                                    <input class="form-control" type="email" name="email" id="email" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" placeholder=" Email" require>
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="phone">Số điện thoại</label>
                                                    <span><?php echo isset($errors['phone']) ? '*' . $errors['phone'] : '' ?></span>
                                                    <input class="form-control" type="text" name="phone" id="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : '' ?>" placeholder=" Số điện thoại">
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="address">Đại chỉ</label>
                                                    <input class="form-control" type="text" name="address" id="address" value="<?php echo isset($user['address']) ? $user['address'] : '' ?>" placeholder=" Địa chỉ">
                                                </div>
                                                <div class="form-group text-start">
                                                    <label for="role">Vai trò</label>
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="0" <?php echo isset($user['role']) && ($user['role'] == 0) ? 'selected' : '' ?>>Khách tham quan</option>
                                                        <option value="1" <?php echo isset($user['role']) && ($user['role'] == 1) ? 'selected' : '' ?>>Nhân viên</option>
                                                        <option value="2" <?php echo isset($user['role']) && ($user['role'] == 2) ? 'selected' : '' ?>>Quản trị viên</option>
                                                    </select>
                                                </div>
                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                <button type="submit" name="edit_user" class="btn btn-primary mt-2 float-end">Lưa chỉnh sửa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cửa sổ xóa người dùng -->
                            <div
                                class="modal fade"
                                id="delete_user<?php echo $countId ?>"
                                tabindex="-1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-danger">
                                                Bạn chắc chắn muốn xóa người dùng này!
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="colmd-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Họ và tên</th>
                                                            <th>Tên người dùng</th>
                                                            <th>Địa chỉ email</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                            <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                            <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <!-- Form xóa người dùng -->
                                            <form method="post">
                                                <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                                <button type="submit" name="delete_users" class="btn btn-danger d-flex">
                                                    <i class="bx bx-trash p-1"></i>Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Cửa sổ phân quyền người dùng -->
                            <div
                                class="modal fade"
                                id="permissions<?php echo $countId ?>"
                                tabindex="-1">
                                <div class="modal-dialog permissions-size" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">
                                                Phân quyền người dùng
                                            </h5>
                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="colmd-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Họ và tên</th>
                                                            <th>Tên người dùng</th>
                                                            <th>Địa chỉ email</th>
                                                            <th>Vai trò</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                            <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                            <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                            <td><?php
                                                                if (isset($user['role'])) {
                                                                    if ($user['role'] == 0) {
                                                                        echo 'Khách tham quan';
                                                                    } elseif ($user['role'] == 1) {
                                                                        echo 'Nhân viên';
                                                                    } elseif ($user['role'] == 2) {
                                                                        echo 'Quản trị viên';
                                                                    }
                                                                } else {
                                                                    echo "";
                                                                }
                                                                ?></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <?php
                                            foreach ($permissions as $permission) {
                                                if ($permission['user_id'] == $user['user_id']) { ?>
                                                    <div class="row border">
                                                        <form action="" class="d-flex gap-1" method="post">
                                                            <div class="col-md-2 border-end pe-2">
                                                                <div class="mb-3">
                                                                    <label for="role">Chọn vai trò người dùng</label>
                                                                    <select name="role" id="role" class="form-control">
                                                                        <option value="0" <?php echo isset($user['role']) && ($user['role'] == 0) ? 'selected' : '' ?>>Khách tham quan</option>
                                                                        <option value="1" <?php echo isset($user['role']) && ($user['role'] == 1) ? 'selected' : '' ?>>Nhân viên</option>
                                                                        <option value="2" <?php echo isset($user['role']) && ($user['role'] == 2) ? 'selected' : '' ?>>Quản trị viên</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="row">
                                                                    <div class="col-md-2 border-end">
                                                                        <p>Quyền người dùng</p>
                                                                        <div class="form-check">
                                                                            <input type="checkbox" class="form-check-input" id="comment"
                                                                                <?php echo isset($permission['comment']) && ($permission['comment'] == 1) ? 'checked' : '' ?>
                                                                                name="comment" value="1">
                                                                            <label for="" class="form-check">
                                                                                <p>Bình luận</p>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Quyền quản lý -->
                                                                    <div class="col-md-10">
                                                                        <p>Quyền quản lý</p>
                                                                        <!-- Hiện vật -->
                                                                        <div class="form-check d-flex border-bottom">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerArtifact"
                                                                                    <?php echo isset($permission['mana_artifact']) && ($permission['mana_artifact'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_artifact" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý hiện vật</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="add_artifact" value="1"
                                                                                    <?php echo isset($permission['add_artifact']) && ($permission['add_artifact'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Thêm</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="edit_artifact" value="1"
                                                                                    <?php echo isset($permission['edit_artifact']) && ($permission['edit_artifact'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Sửa</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_artifact" value="1"
                                                                                    <?php echo isset($permission['delete_artifact']) && ($permission['delete_artifact'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Tin tức -->
                                                                        <div class="form-check d-flex border-bottom">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerNews"
                                                                                    <?php echo isset($permission['mana_news']) && ($permission['mana_news'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_news" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý tin tức - sự kiện</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="add_news" value="1"
                                                                                    <?php echo isset($permission['add_news']) && ($permission['add_news'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Thêm</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="edit_news" value="1"
                                                                                    <?php echo isset($permission['edit_news']) && ($permission['edit_news'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Sửa</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_news" value="1"
                                                                                    <?php echo isset($permission['delete_news']) && ($permission['delete_news'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-check d-flex border-bottom">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerGallery"
                                                                                    <?php echo isset($permission['mana_gallery']) && ($permission['mana_gallery'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_gallery" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý hình ảnh - video</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="add_gallery" value="1"
                                                                                    <?php echo isset($permission['add_gallery']) && ($permission['add_gallery'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Thêm</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="edit_gallery" value="1"
                                                                                    <?php echo isset($permission['edit_gallery']) && ($permission['edit_gallery'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Sửa</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_gallery" value="1"
                                                                                    <?php echo isset($permission['delete_gallery']) && ($permission['delete_gallery'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Giới thiệu -->
                                                                        <div class="form-check d-flex border-bottom">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerIntroduction"
                                                                                    <?php echo isset($permission['mana_introduction']) && ($permission['mana_introduction'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_introduction" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý giới thiệu</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="add_introduction" value="1"
                                                                                    <?php echo isset($permission['add_introduction']) && ($permission['add_introduction'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Thêm</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="col-md-3">
                                                                                    <input type="checkbox" class="form-check-input" name="edit_introduction" value="1"
                                                                                        <?php echo isset($permission['edit_introduction']) && ($permission['edit_introduction'] == 1) ? 'checked' : '' ?>>
                                                                                    <label for="" class="form-check">
                                                                                        <p>Sửa</p>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_introduction" value="1"
                                                                                    <?php echo isset($permission['delete_introduction']) && ($permission['delete_introduction'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Bình luận -->
                                                                        <div class="form-check d-flex border-bottom">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerCommet"
                                                                                    <?php echo isset($permission['mana_comment']) && ($permission['mana_comment'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_comment" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý bình luận</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3"></div>
                                                                            <div class="col-md-3"></div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_comment" value="1"
                                                                                    <?php echo isset($permission['delete_comment']) && ($permission['delete_comment'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Triển lãm -->
                                                                        <div class="form-check d-flex border-bottom">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerExhibition"
                                                                                    <?php echo isset($permission['mana_exhibition']) && ($permission['mana_exhibition'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_exhibition" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý triển lãm</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <div class="col-md-3">
                                                                                    <input type="checkbox" class="form-check-input" name="add_exhibition" value="1"
                                                                                        <?php echo isset($permission['add_exhibition']) && ($permission['add_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                                    <label for="" class="form-check">
                                                                                        <p>Thêm</p>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="edit_exhibition" value="1"
                                                                                    <?php echo isset($permission['edit_exhibition']) && ($permission['edit_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Sửa</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_exhibition" value="1"
                                                                                    <?php echo isset($permission['delete_exhibition']) && ($permission['delete_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <!-- Người dùng -->
                                                                        <div class="form-check d-flex">
                                                                            <div class="col-md-4">
                                                                                <input type="checkbox" class="form-check-input" id="managerUser"
                                                                                    <?php echo isset($permission['mana_user']) && ($permission['mana_user'] == 1) ? 'checked' : '' ?>
                                                                                    name="mana_user" value="1">
                                                                                <label for="" class="form-check">
                                                                                    <p>Quản lý người dùng</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="add_user" value="1"
                                                                                    <?php echo isset($permission['add_user']) && ($permission['add_user'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Thêm</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="edit_user" value="1"
                                                                                    <?php echo isset($permission['edit_user']) && ($permission['edit_user'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Sửa</p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                <input type="checkbox" class="form-check-input" name="delete_user" value="1"
                                                                                    <?php echo isset($permission['delete_user']) && ($permission['delete_user'] == 1) ? 'checked' : '' ?>>
                                                                                <label for="" class="form-check">
                                                                                    <p>Xóa</p>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    </div>

                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                            <button type="submit" name="permissions_user" class="btn btn-primary d-flex">
                                                <i class='bx bxs-save p-1'></i>Lưu quyền
                                            </button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                        <?php }
                                            } ?>
                            </div>

            </div>
            </div>
            </div>
            </td>
            </tr>
            </tbody>

        <?php }
                                    } else { ?>
        <tbody>
            <tr>
                <td><?php echo isset($user['user_id']) ? $user['user_id'] : '' ?></td>
                <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                <td><?php echo isset($user['phone']) ? $user['phone'] : '' ?></td>
                <td>
                    <?php
                                        if ($user['status'] == 1) { ?>
                        <p class="text-success">Hoạt động</p>
                    <?php } else { ?>
                        <p class="text-danger">Bị khóa</p>
                    <?php }
                    ?>
                </td>
                <td><?php
                                        if ($user['role'] == 0) {
                                            echo "Khách tham quan";
                                        } elseif ($user['role'] == 1) {
                                            echo "Nhân viên";
                                        } elseif ($user['role'] == 2) {
                                            echo "Quản trị viên";
                                        }

                    ?></td>
                <td>
                    <div class="dropdown dropdown-user">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="bx bx-cog"></i>Tùy chọn
                        </button>
                        <ul class="dropdown-menu col-md-12 mana_action">
                            <div class="dropdown-item">
                                <!-- nút ẩn hiện phần chỉnh sửa người dùng -->
                                <button
                                    type="button"
                                    class="btn btn-secondary d-flex w-100 justify-content-center"
                                    data-bs-toggle="modal"
                                    <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && $per_condition['edit_user'] != 1) ? 'disabled' : '' ?>
                                    data-bs-target="#edit_user<?php echo $countId ?>">
                                    <i class="bx bx-edit p-1"></i>Sửa
                                </button>
                            </div>
                            <div class="dropdown-item">
                                <button
                                    type="button"
                                    class="btn btn-danger d-flex w-100 justify-content-center"
                                    data-bs-toggle="modal"
                                    <?php echo (($_SESSION['users']['user_id'] == $per_condition['user_id']) && $per_condition['delete_user'] != 1) ? 'disabled' : '' ?>
                                    data-bs-target="#delete_user<?php echo $countId ?>">
                                    <i class="bx bx-trash p-1"></i>Xóa
                                </button>
                            </div>
                            <!-- Khóa hoặc mở khóa tài khoản người dùng -->
                            <div class="dropdown-item">
                                <form action="" method="post">
                                    <?php
                                        if ($_SESSION['users']['role'] == 2) {
                                            if ($user['status'] == 1) { ?>
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                            <input type="hidden" name="status" value="<?php echo $user['status'] ?>">
                                            <button type="submit" class="btn btn-warning d-flex w-100 justify-content-center"
                                                name="change_status_user"><i class="bx bx-lock p-1"></i>Khóa</button>
                                        <?php } else { ?>
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                            <input type="hidden" name="status" value="<?php echo $user['status'] ?>">
                                            <button type="submit" class="btn btn-warning d-flex w-100 justify-content-center"
                                                name="change_status_user"><i class="bx bx-lock-open p-1"></i>Mở</button>
                                    <?php  }
                                        }
                                    ?>
                                </form>
                            </div>

                            <?php
                                        if ($_SESSION['users']['role'] == 2) { ?>
                                <div class="dropdown-item">
                                    <button type="button" class="btn btn-info d-flex w-100 justify-content-center"
                                        data-bs-toggle="modal"
                                        data-bs-target="#permissions<?php echo $countId ?>">
                                        <i class="bx bx-lock p-1"></i>Phân quyền</button>
                                </div>
                            <?php   }
                            ?>
                        </ul>
                    </div>
                    <!-- Cửa sổ chỉnh người dùng -->
                    <div
                        class="modal fade"
                        id="edit_user<?php echo $countId ?>"
                        tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Chỉnh sửa thông tin người dùng
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form chỉnh sửa người dùng -->
                                    <form action="" method="post">
                                        <p class="text-center" style="color: red;">Dấu (*) là trường bắt buộc</p>
                                        <div class="form-group text-start">
                                            <label for="fullname">Họ và tên</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?php echo isset($user['fullname']) ? $user['fullname'] : '' ?>" placeholder="Họ và tên">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="username">Tên đăng nhập</label>
                                            <span>*<?php echo isset($errors['username']) ? $errors['username'] : '' ?></span>
                                            <input class="form-control" type="text" name="username" id="username" value="<?php echo isset($user['username']) ? $user['username'] : '' ?>" placeholder=" Tên người dùng" require>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="email">Email</label>
                                            <span>*<?php echo isset($errors['email']) ? $errors['email'] : '' ?></span>
                                            <input class="form-control" type="email" name="email" id="email" value="<?php echo isset($user['email']) ? $user['email'] : '' ?>" placeholder=" Email" require>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="phone">Số điện thoại</label>
                                            <span><?php echo isset($errors['phone']) ? '*' . $errors['phone'] : '' ?></span>
                                            <input class="form-control" type="text" name="phone" id="phone" value="<?php echo isset($user['phone']) ? $user['phone'] : '' ?>" placeholder=" Số điện thoại">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="address">Đại chỉ</label>
                                            <input class="form-control" type="text" name="address" id="address" value="<?php echo isset($user['address']) ? $user['address'] : '' ?>" placeholder=" Địa chỉ">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="role">Vai trò</label>
                                            <select name="role" id="role" class="form-select">
                                                <option value="0" <?php echo isset($user['role']) && ($user['role'] == 0) ? 'selected' : '' ?>>Khách tham quan</option>
                                                <option value="1" <?php echo isset($user['role']) && ($user['role'] == 1) ? 'selected' : '' ?>>Nhân viên</option>
                                                <option value="2" <?php echo isset($user['role']) && ($user['role'] == 2) ? 'selected' : '' ?>>Quản trị viên</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                        <button type="submit" name="edit_user" class="btn btn-primary mt-2 float-end">Lưa chỉnh sửa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cửa sổ xóa người dùng -->
                    <div
                        class="modal fade"
                        id="delete_user<?php echo $countId ?>"
                        tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">
                                        Bạn chắc chắn muốn xóa người dùng này!
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="colmd-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Họ và tên</th>
                                                    <th>Tên người dùng</th>
                                                    <th>Địa chỉ email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                    <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                    <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- Form xóa người dùng -->
                                    <form method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                        <button type="submit" name="delete_users" class="btn btn-danger d-flex">
                                            <i class="bx bx-trash p-1"></i>Xóa</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cửa sổ phân quyền người dùng -->
                    <div
                        class="modal fade"
                        id="permissions<?php echo $countId ?>"
                        tabindex="-1">
                        <div class="modal-dialog permissions-size" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Phân quyền người dùng
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="colmd-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Họ và tên</th>
                                                    <th>Tên người dùng</th>
                                                    <th>Địa chỉ email</th>
                                                    <th>Vai trò</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo isset($user['fullname']) ? $user['fullname'] : '' ?></td>
                                                    <td><?php echo isset($user['username']) ? $user['username'] : '' ?></td>
                                                    <td><?php echo isset($user['email']) ? $user['email'] : '' ?></td>
                                                    <td><?php
                                                        if (isset($user['role'])) {
                                                            if ($user['role'] == 0) {
                                                                echo 'Khách tham quan';
                                                            } elseif ($user['role'] == 1) {
                                                                echo 'Nhân viên';
                                                            } elseif ($user['role'] == 2) {
                                                                echo 'Quản trị viên';
                                                            }
                                                        } else {
                                                            echo "";
                                                        }
                                                        ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php
                                        foreach ($permissions as $permission) {
                                            if ($permission['user_id'] == $user['user_id']) { ?>
                                            <div class="row border d-flex justify-content-center">
                                                <form action="" class="d-flex gap-1" method="post">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <!-- Quyền quản lý -->
                                                            <div class="col-md-12 p-5">
                                                                <p>Quyền quản lý</p>
                                                                <!-- Hiện vật -->
                                                                <div class="form-check d-flex border-bottom">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" class="form-check-input" id="managerArtifact"
                                                                            <?php echo isset($permission['mana_artifact']) && ($permission['mana_artifact'] == 1) ? 'checked' : '' ?>
                                                                            name="mana_artifact" value="1">
                                                                        <label for="" class="form-check">
                                                                            <p>Quản lý hiện vật</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="add_artifact" value="1"
                                                                            <?php echo isset($permission['add_artifact']) && ($permission['add_artifact'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Thêm</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="edit_artifact" value="1"
                                                                            <?php echo isset($permission['edit_artifact']) && ($permission['edit_artifact'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Sửa</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="delete_artifact" value="1"
                                                                            <?php echo isset($permission['delete_artifact']) && ($permission['delete_artifact'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Xóa</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- Tin tức -->
                                                                <div class="form-check d-flex border-bottom">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" class="form-check-input" id="managerNews"
                                                                            <?php echo isset($permission['mana_news']) && ($permission['mana_news'] == 1) ? 'checked' : '' ?>
                                                                            name="mana_news" value="1">
                                                                        <label for="" class="form-check">
                                                                            <p>Quản lý tin tức - sự kiện</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="add_news" value="1"
                                                                            <?php echo isset($permission['add_news']) && ($permission['add_news'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Thêm</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="edit_news" value="1"
                                                                            <?php echo isset($permission['edit_news']) && ($permission['edit_news'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Sửa</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="delete_news" value="1"
                                                                            <?php echo isset($permission['delete_news']) && ($permission['delete_news'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Xóa</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- Giới thiệu -->
                                                                <div class="form-check d-flex border-bottom">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" class="form-check-input" id="managerIntroduction"
                                                                            <?php echo isset($permission['mana_introduction']) && ($permission['mana_introduction'] == 1) ? 'checked' : '' ?>
                                                                            name="mana_introduction" value="1">
                                                                        <label for="" class="form-check">
                                                                            <p>Quản lý giới thiệu</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="add_introduction" value="1"
                                                                            <?php echo isset($permission['add_introduction']) && ($permission['add_introduction'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Thêm</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="col-md-3">
                                                                            <input type="checkbox" class="form-check-input" name="edit_introduction" value="1"
                                                                                <?php echo isset($permission['edit_introduction']) && ($permission['edit_introduction'] == 1) ? 'checked' : '' ?>>
                                                                            <label for="" class="form-check">
                                                                                <p>Sửa</p>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="delete_introduction" value="1"
                                                                            <?php echo isset($permission['delete_introduction']) && ($permission['delete_introduction'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Xóa</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- Bình luận -->
                                                                <div class="form-check d-flex border-bottom">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" class="form-check-input" id="managerCommet"
                                                                            <?php echo isset($permission['mana_comment']) && ($permission['mana_comment'] == 1) ? 'checked' : '' ?>
                                                                            name="mana_comment" value="1">
                                                                        <label for="" class="form-check">
                                                                            <p>Quản lý bình luận</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3"></div>
                                                                    <div class="col-md-3"></div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="delete_comment" value="1"
                                                                            <?php echo isset($permission['delete_comment']) && ($permission['delete_comment'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Xóa</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- Triển lãm -->
                                                                <div class="form-check d-flex border-bottom">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" class="form-check-input" id="managerExhibition"
                                                                            <?php echo isset($permission['mana_exhibition']) && ($permission['mana_exhibition'] == 1) ? 'checked' : '' ?>
                                                                            name="mana_exhibition" value="1">
                                                                        <label for="" class="form-check">
                                                                            <p>Quản lý triển lãm</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="col-md-3">
                                                                            <input type="checkbox" class="form-check-input" name="add_exhibition" value="1"
                                                                                <?php echo isset($permission['add_exhibition']) && ($permission['add_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                            <label for="" class="form-check">
                                                                                <p>Thêm</p>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="edit_exhibition" value="1"
                                                                            <?php echo isset($permission['edit_exhibition']) && ($permission['edit_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Sửa</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="delete_exhibition" value="1"
                                                                            <?php echo isset($permission['delete_exhibition']) && ($permission['delete_exhibition'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Xóa</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <!-- Người dùng -->
                                                                <div class="form-check d-flex">
                                                                    <div class="col-md-4">
                                                                        <input type="checkbox" class="form-check-input" id="managerUser"
                                                                            <?php echo isset($permission['mana_user']) && ($permission['mana_user'] == 1) ? 'checked' : '' ?>
                                                                            name="mana_user" value="1">
                                                                        <label for="" class="form-check">
                                                                            <p>Quản lý người dùng</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="add_user" value="1"
                                                                            <?php echo isset($permission['add_user']) && ($permission['add_user'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Thêm</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="edit_user" value="1"
                                                                            <?php echo isset($permission['edit_user']) && ($permission['edit_user'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Sửa</p>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <input type="checkbox" class="form-check-input" name="delete_user" value="1"
                                                                            <?php echo isset($permission['delete_user']) && ($permission['delete_user'] == 1) ? 'checked' : '' ?>>
                                                                        <label for="" class="form-check">
                                                                            <p>Xóa</p>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id'] ?>">
                                    <button type="submit" name="permissions_user" class="btn btn-primary d-flex">
                                        <i class='bx bxs-save p-1'></i>Lưu quyền
                                    </button>
                                </div>
                            </div>
                            </form>
                        </div>
                <?php }
                                        } ?>
                    </div>

                    </div>
                    </div>
                    </div>
                </td>
            </tr>
        </tbody>
    <?php } ?>
<?php }
?>
</table>
</div>
</div>
</div>
</div>
<?php }
    }
    if ($countErr == 0) { ?>
<p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
} else { ?>
<p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
?>