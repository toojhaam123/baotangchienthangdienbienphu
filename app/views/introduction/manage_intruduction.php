<?php
$countErr = 0;
foreach ($permissions as $per_adition) {
    if (isset($_SESSION['users']) && ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['mana_introduction'] == 1)) {
        $countErr += 1; ?>
        <div class="row manager">
            <div class="my-3 border-bottom col-md-12 text-center">
                <h2>Quản lý giới thiệu bảo tàng</h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Bảng danh sách các giới thiệu</h5>
                    </div>
                    <div class="col-md-2 text-center">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#add_introduction"
                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['add_introduction'] != 1)) ? 'disabled' : '' ?>>
                            <i class="bx bx-plus"></i> Thêm mới
                        </button>
                    </div>
                    <!-- Cửa sổ thêm mới giới thiệu -->
                    <div
                        class="modal fade"
                        id="add_introduction"
                        tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Thêm mới giới thiệu
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form thêm mới giới thiệu -->
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group text-start">
                                            <label for="introduction_name">Tiêu đề</label>
                                            <span>*<?php echo isset($errors['title']) ? $errors['title'] : ''; ?></span>
                                            <input class="form-control" type="text" name="introduction_name" id="introduction_name"
                                                value="<?php echo isset($_POST['introduction_name']) ? $_POST['introduction_name'] : '' ?>">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="introduction_description">Nội dung</label>
                                            <span>*<?php echo isset($errors['content']) ? $errors['content'] : ''; ?></span>
                                            <textarea class="form-control" name="introduction_description" id="introduction_description" rows="10" placeholder="Nhập nội dung..."><?php echo isset($_POST['introduction_description']) ? htmlspecialchars($_POST['introduction_description']) : ''; ?></textarea>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="introduction_type">Loại</label>
                                            <span>*<?php echo isset($errors['category']) ? $errors['category'] : ''; ?></span>
                                            <select name="introduction_type" id="introduction_type" class="form-select bg-light">
                                                <option value="">Tùy chọn</option>
                                                <option value="introduction" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'introduction'  ? 'selected' : '' ?>>Giới thiệu</option>
                                                <option value="history" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'history'  ? 'selected' : '' ?>>Lịch sử</option>
                                                <option value="mission" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'mission'  ? 'selected' : '' ?>>Sứ mệnh</option>
                                                <option value="other" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'other'  ? 'selected' : '' ?>>Thông tin khác</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="introduction_file">Hình ảnh liên quan</label>
                                            <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                            <input type="file" class="form-control" name="introduction_file" id="introduction_file">
                                        </div>
                                        <button type="submit" name="uploadIntroduction" class="btn btn-primary mt-2 float-end">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-2">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Nội dung</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countId = 0;
                                foreach ($introductions as $introduction) {
                                    $countId += 1; ?>
                                    <tr>
                                        <td><?php echo $introduction['intro_id'] ?></td>
                                        <td><?php echo $introduction['title'] ?></td>
                                        <td class="text-center"><img class="img-thumbnail" src="./public/uploads/imageIntroduction/<?php echo $introduction['image'] ?>" alt=""></td>
                                        <td><?php echo mb_substr($introduction['content'], 0, 100) . '...' ?></td>
                                        <td>
                                            <div class="col-md-12 mana_action text-center d-flex">
                                                <!-- nút ẩn hiện phần chỉnh sửa giới thiệu -->
                                                <button
                                                    type="button"
                                                    class="btn btn-secondary d-flex"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#edit_introduction<?php echo $countId ?>">
                                                    <i class="bx bx-edit p-1"></i>Sửa
                                                </button>
                                                <!-- Cửa sổ chỉnh sửa giới thiệu -->
                                                <div
                                                    class="modal fade"
                                                    id="edit_introduction<?php echo $countId ?>"
                                                    tabindex="-1">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">
                                                                    Chỉnh sửa hình ảnh - video
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Form chỉnh sửa giới thiệu -->
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="form-group text-start">
                                                                        <label for="introduction_name">Tiêu đề</label>
                                                                        <span>*<?php echo isset($errors['title']) ? $errors['title'] : ''; ?></span>
                                                                        <input class="form-control" type="text" name="introduction_name" id="introduction_name"
                                                                            value="<?php echo $introduction['title'] ?>">
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label for="introduction_description">Nội dung</label>
                                                                        <span>*<?php echo isset($errors['content']) ? $errors['content'] : ''; ?></span>
                                                                        <textarea class="form-control" name="introduction_description" id="introduction_description" rows="10"><?php echo $introduction['content'] ?></textarea>
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label for="introduction_type">Loại</label>
                                                                        <span>*<?php echo isset($errors['category']) ? $errors['category'] : ''; ?></span>
                                                                        <select name="introduction_type" id="introduction_type" class="form-select bg-light">
                                                                            <option value="">Tùy chọn</option>
                                                                            <option value="introduction" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'introduction'
                                                                                                                || isset($introduction['category']) && $introduction['category'] == 'introduction'  ? 'selected' : '' ?>>Giới thiệu</option>
                                                                            <option value="history" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'history'
                                                                                                        || isset($introduction['category']) && $introduction['category'] == 'history'  ? 'selected' : '' ?>>Lịch sử</option>
                                                                            <option value="mission" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'mission'
                                                                                                        || isset($introduction['category']) && $introduction['category'] == 'mission'  ? 'selected' : '' ?>>Sứ mệnh</option>
                                                                            <option value="other" <?php echo isset($_POST['introduction_type']) && $_POST['introduction_type'] == 'other'
                                                                                                        || isset($introduction['category']) && $introduction['category'] == 'other'  ? 'selected' : '' ?>>Thông tin khác</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group text-start">
                                                                        <label for="introduction_file">Hình ảnh liên quan</label>
                                                                        <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                        <input type="file" class="form-control" name="introduction_file" id="introduction_file">
                                                                    </div>
                                                                    <button type="submit" name="edit_introduction" class="btn btn-primary mt-2 float-end">Lưu</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button
                                                    type="button"
                                                    class="btn btn-danger d-flex"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#delete_introduction<?php echo $countId ?>">
                                                    <i class="bx bx-trash p-1"></i>Xóa
                                                </button>
                                                <!-- Cửa sổ xóa giới thiệu -->
                                                <div
                                                    class="modal fade"
                                                    id="delete_introduction<?php echo $countId ?>"
                                                    tabindex="-1">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-danger">
                                                                    Bạn chắc chắn muốn xóa giới thiệu này!
                                                                </h5>
                                                                <button
                                                                    type="button"
                                                                    class="btn-close"
                                                                    data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="colmd-12 d-flex gap-3">
                                                                    <img class="img-thumbnail" src="./public/uploads/imageIntroduction/<?php echo $introduction['image'] ?>" alt="">
                                                                    <p><b><?php echo $introduction['title'] ?></b></p>
                                                                </div>
                                                                <p><?php echo mb_substr($introduction['content'], 0, 100) . '...' ?></p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <!-- Form xóa hiện vật -->
                                                                <form method="post">
                                                                    <input type="hidden" name="category" value="<?php echo $introduction['category'] ?>">
                                                                    <button type="submit" name="delete_introductions" class="btn btn-danger d-flex">
                                                                        <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php  }
}
if ($countErr == 0) { ?>
    <p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
?>