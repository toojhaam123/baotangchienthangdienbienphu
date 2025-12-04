<?php
$countErr = 0;
foreach ($permissions as $per_adition) {
    if (isset($_SESSION['users']) && ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['mana_introduction'] == 1)) {
        $countErr += 1; ?>
        <div class="row manager">
            <div class="col-md-12 my-3 border-bottom">
                <h2 class="text-center">
                    Quản lý hiện vật
                </h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Bảng danh sách các hiện vật</h5>
                    </div>
                    <div class="col-md-2 text-center">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#add_artifact"
                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['add_artifact'] != 1)) ? 'disabled' : '' ?>>
                            <i class="bx bx-plus"></i> Thêm mới
                        </button>
                    </div>
                    <!-- Cửa sổ thêm mới hiện vật -->
                    <div
                        class="modal fade"
                        id="add_artifact"
                        tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Thêm mới hiện vật
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form thêm hiện vật -->
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group text-start">
                                            <label for="artifact_img">Hình ảnh</label>
                                            <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                            <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="artifacr_name">Tên hiện vật</label>
                                            <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                            <input class="form-control" type="text" name="artifact_name" id="artifac_name"
                                                value="<?php echo isset($_POST['artifact_name']) ? $_POST['artifact_name'] : '' ?>">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="artifact_description">Mô tả hiện vật</label>
                                            <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                            <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($_POST['artifact_description']) ? $_POST['artifact_description'] : '' ?></textarea>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="artifact_type">Loại hiện vật</label>
                                            <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                            <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                <option value="">Tùy chọn</option>
                                                <option value="weapon" <?php echo (isset($_POST['artifact_type']) && $_POST['artifact_type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                <option value="costume" <?php echo (isset($_POST['artifact_type']) && $_POST['artifact_type'] == 'custume') ? 'selected' : '' ?>>Trang phục</option>
                                                <option value="document" <?php echo (isset($_POST['artifact_type']) && $_POST['artifact_type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                <option value="picture" <?php echo (isset($_POST['artifact_type']) && $_POST['artifact_type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                <option value="equiment" <?php echo (isset($_POST['type']) && $_POST['artifact_type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                <option value="models" <?php echo (isset($_POST['type']) && $_POST['artifact_type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="add_artifacts" class="btn btn-primary mt-2 float-end">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="" method="post">
                            <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
                            <button type="submit" class="btn <?php echo isset($_POST['weapon']) ? 'btn-primary' : '' ?>" name="weapon">Vũ khí</button>
                            <button type="submit" class="btn <?php echo isset($_POST['costume']) ? 'btn-primary' : '' ?>" name="costume">Trang phục</button>
                            <button type="submit" class="btn <?php echo isset($_POST['document']) ? 'btn-primary' : '' ?>" name="document">Tài liệu</button>
                            <button type="submit" class="btn <?php echo isset($_POST['equiment']) ? 'btn-primary' : '' ?>" name="equiment">Dụng cụ</button>
                            <button type="submit" class="btn <?php echo isset($_POST['models']) ? 'btn-primary' : '' ?>" name="models">Mô hình</button>
                        </form>
                    </div>
                    <div class="col-md-12 mt-2">
                        <table class="table table-bordered">
                            <thead class="text-center" id="table_static">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên hiện vật</th>
                                    <th>Hình ảnh</th>
                                    <th>Loại</th>
                                    <th>Mô tả</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <?php
                            $countId = 0;
                            foreach ($artifacts as $artifact) {
                                $countId += 1;
                                if (isset($_POST['weapon'])) {
                                    if ($artifact['type'] == 'weapon') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $artifact['artifact_id'] ?></td>
                                                <td><?php echo $artifact['name'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($artifact['type'] == 'weapon') {
                                                        echo "Vũ khí";
                                                    }
                                                    if ($artifact['type'] == 'costume') {
                                                        echo "Trang phục";
                                                    }
                                                    if ($artifact['type'] == 'document') {
                                                        echo "Tài liệu";
                                                    }
                                                    if ($artifact['type'] == 'picture') {
                                                        echo 'Tranh ảnh';
                                                    }
                                                    if ($artifact['type'] == 'equiment') {
                                                        echo 'Dụng cụ';
                                                    }
                                                    if ($artifact['type'] == 'models') {
                                                        echo 'Mô hình';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa hiện vật
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa hiện vật -->
                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_img">Hình ảnh</label>
                                                                                <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                                <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_name">Tên hiện vật</label>
                                                                                <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                                <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                    value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_description">Mô tả hiện vật</label>
                                                                                <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                                <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_type">Loại hiện vật</label>
                                                                                <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                                <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                    <option value="">Tùy chọn</option>
                                                                                    <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                    <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                    <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                    <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                    <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                    <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                        <!-- Cửa sổ xóa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="delet_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa hiện vật này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12 d-flex gap-3">
                                                                            <img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                            <p><b><?php echo $artifact['name'] ?></b></p>
                                                                        </div>
                                                                        <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php  }
                                } elseif (isset($_POST['costume'])) {
                                    if ($artifact['type'] == 'costume') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $artifact['artifact_id'] ?></td>
                                                <td><?php echo $artifact['name'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($artifact['type'] == 'weapon') {
                                                        echo "Vũ khí";
                                                    }
                                                    if ($artifact['type'] == 'costume') {
                                                        echo "Trang phục";
                                                    }
                                                    if ($artifact['type'] == 'document') {
                                                        echo "Tài liệu";
                                                    }
                                                    if ($artifact['type'] == 'picture') {
                                                        echo 'Tranh ảnh';
                                                    }
                                                    if ($artifact['type'] == 'equiment') {
                                                        echo 'Dụng cụ';
                                                    }
                                                    if ($artifact['type'] == 'models') {
                                                        echo 'Mô hình';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa hiện vật
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa hiện vật -->
                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_img">Hình ảnh</label>
                                                                                <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                                <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_name">Tên hiện vật</label>
                                                                                <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                                <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                    value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_description">Mô tả hiện vật</label>
                                                                                <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                                <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_type">Loại hiện vật</label>
                                                                                <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                                <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                    <option value="">Tùy chọn</option>
                                                                                    <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                    <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                    <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                    <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                    <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                    <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                        <!-- Cửa sổ xóa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="delet_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa hiện vật này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12 d-flex gap-3">
                                                                            <img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                            <p><b><?php echo $artifact['name'] ?></b></p>
                                                                        </div>
                                                                        <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php }
                                } elseif (isset($_POST['document'])) {
                                    if ($artifact['type'] == 'document') { ?>

                                        <tbody>
                                            <tr>
                                                <td><?php echo $artifact['artifact_id'] ?></td>
                                                <td><?php echo $artifact['name'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($artifact['type'] == 'weapon') {
                                                        echo "Vũ khí";
                                                    }
                                                    if ($artifact['type'] == 'costume') {
                                                        echo "Trang phục";
                                                    }
                                                    if ($artifact['type'] == 'document') {
                                                        echo "Tài liệu";
                                                    }
                                                    if ($artifact['type'] == 'picture') {
                                                        echo 'Tranh ảnh';
                                                    }
                                                    if ($artifact['type'] == 'equiment') {
                                                        echo 'Dụng cụ';
                                                    }
                                                    if ($artifact['type'] == 'models') {
                                                        echo 'Mô hình';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa hiện vật
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa hiện vật -->
                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_img">Hình ảnh</label>
                                                                                <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                                <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_name">Tên hiện vật</label>
                                                                                <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                                <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                    value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_description">Mô tả hiện vật</label>
                                                                                <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                                <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_type">Loại hiện vật</label>
                                                                                <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                                <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                    <option value="">Tùy chọn</option>
                                                                                    <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                    <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                    <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                    <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                    <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                    <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                        <!-- Cửa sổ xóa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="delet_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa hiện vật này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12 d-flex gap-3">
                                                                            <img class="img-thumbnail" src="./public/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                            <p><b><?php echo $artifact['name'] ?></b></p>
                                                                        </div>
                                                                        <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php }
                                } elseif (isset($_POST['picture'])) {
                                    if ($artifact['type'] == 'picture') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $artifact['artifact_id'] ?></td>
                                                <td><?php echo $artifact['name'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($artifact['type'] == 'weapon') {
                                                        echo "Vũ khí";
                                                    }
                                                    if ($artifact['type'] == 'costume') {
                                                        echo "Trang phục";
                                                    }
                                                    if ($artifact['type'] == 'document') {
                                                        echo "Tài liệu";
                                                    }
                                                    if ($artifact['type'] == 'picture') {
                                                        echo 'Tranh ảnh';
                                                    }
                                                    if ($artifact['type'] == 'equiment') {
                                                        echo 'Dụng cụ';
                                                    }
                                                    if ($artifact['type'] == 'models') {
                                                        echo 'Mô hình';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa hiện vật
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa hiện vật -->
                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_img">Hình ảnh</label>
                                                                                <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                                <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_name">Tên hiện vật</label>
                                                                                <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                                <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                    value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_description">Mô tả hiện vật</label>
                                                                                <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                                <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_type">Loại hiện vật</label>
                                                                                <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                                <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                    <option value="">Tùy chọn</option>
                                                                                    <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                    <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                    <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                    <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                    <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                    <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                        <!-- Cửa sổ xóa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="delet_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa hiện vật này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12 d-flex gap-3">
                                                                            <img class="img-thumbnail" src="./public/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                            <p><b><?php echo $artifact['name'] ?></b></p>
                                                                        </div>
                                                                        <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php }
                                } elseif (isset($_POST['equiment'])) {
                                    if ($artifact['type'] == 'equiment') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $artifact['artifact_id'] ?></td>
                                                <td><?php echo $artifact['name'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($artifact['type'] == 'weapon') {
                                                        echo "Vũ khí";
                                                    }
                                                    if ($artifact['type'] == 'costume') {
                                                        echo "Trang phục";
                                                    }
                                                    if ($artifact['type'] == 'document') {
                                                        echo "Tài liệu";
                                                    }
                                                    if ($artifact['type'] == 'picture') {
                                                        echo 'Tranh ảnh';
                                                    }
                                                    if ($artifact['type'] == 'equiment') {
                                                        echo 'Dụng cụ';
                                                    }
                                                    if ($artifact['type'] == 'models') {
                                                        echo 'Mô hình';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa hiện vật
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa hiện vật -->
                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_img">Hình ảnh</label>
                                                                                <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                                <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_name">Tên hiện vật</label>
                                                                                <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                                <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                    value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_description">Mô tả hiện vật</label>
                                                                                <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                                <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_type">Loại hiện vật</label>
                                                                                <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                                <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                    <option value="">Tùy chọn</option>
                                                                                    <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                    <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                    <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                    <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                    <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                    <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                        <!-- Cửa sổ xóa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="delet_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa hiện vật này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12 d-flex gap-3">
                                                                            <img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                            <p><b><?php echo $artifact['name'] ?></b></p>
                                                                        </div>
                                                                        <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php }
                                } elseif (isset($_POST['models'])) {
                                    if ($artifact['type'] == 'models') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $artifact['artifact_id'] ?></td>
                                                <td><?php echo $artifact['name'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                                <td>
                                                    <?php
                                                    if ($artifact['type'] == 'weapon') {
                                                        echo "Vũ khí";
                                                    }
                                                    if ($artifact['type'] == 'costume') {
                                                        echo "Trang phục";
                                                    }
                                                    if ($artifact['type'] == 'document') {
                                                        echo "Tài liệu";
                                                    }
                                                    if ($artifact['type'] == 'picture') {
                                                        echo 'Tranh ảnh';
                                                    }
                                                    if ($artifact['type'] == 'equiment') {
                                                        echo 'Dụng cụ';
                                                    }
                                                    if ($artifact['type'] == 'models') {
                                                        echo 'Mô hình';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="edit_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">
                                                                            Chỉnh sửa hiện vật
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Form chỉnh sửa hiện vật -->
                                                                        <form action="" method="post" enctype="multipart/form-data">
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_img">Hình ảnh</label>
                                                                                <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                                <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_name">Tên hiện vật</label>
                                                                                <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                                <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                    value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_description">Mô tả hiện vật</label>
                                                                                <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                                <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                            </div>
                                                                            <div class="form-group text-start">
                                                                                <label for="artifact_type">Loại hiện vật</label>
                                                                                <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                                <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                    <option value="">Tùy chọn</option>
                                                                                    <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                    <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                    <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                    <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                    <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                    <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                                </select>
                                                                            </div>
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                            data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                        <!-- Cửa sổ xóa hiện vật -->
                                                        <div
                                                            class="modal fade"
                                                            id="delet_artifact<?php echo $countId ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-danger">
                                                                            Bạn chắc chắn muốn xóa hiện vật này!
                                                                        </h5>
                                                                        <button
                                                                            type="button"
                                                                            class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="colmd-12 d-flex gap-3">
                                                                            <img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                            <p><b><?php echo $artifact['name'] ?></b></p>
                                                                        </div>
                                                                        <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                            <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
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
                                            <td><?php echo $artifact['artifact_id'] ?></td>
                                            <td><?php echo $artifact['name'] ?></td>
                                            <td><img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt=""></td>
                                            <td>
                                                <?php
                                                if ($artifact['type'] == 'weapon') {
                                                    echo "Vũ khí";
                                                }
                                                if ($artifact['type'] == 'costume') {
                                                    echo "Trang phục";
                                                }
                                                if ($artifact['type'] == 'document') {
                                                    echo "Tài liệu";
                                                }
                                                if ($artifact['type'] == 'picture') {
                                                    echo 'Tranh ảnh';
                                                }
                                                if ($artifact['type'] == 'equiment') {
                                                    echo 'Dụng cụ';
                                                }
                                                if ($artifact['type'] == 'models') {
                                                    echo 'Mô hình';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo mb_substr($artifact['description'], 0, 100) . '...'  ?></td>
                                            <td>
                                                <div class="col-md-12 mana_action text-center d-flex">
                                                    <!-- nút ẩn hiện phần chỉnh sửa hiện vật -->
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary d-flex"
                                                        data-bs-toggle="modal"
                                                        <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['edit_artifact'] != 1)) ? 'disabled' : '' ?>
                                                        data-bs-target="#edit_artifact<?php echo $countId ?>">
                                                        <i class="bx bx-edit p-1"></i>Sửa
                                                    </button>
                                                    <!-- Cửa sổ chỉnh sửa hiện vật -->
                                                    <div
                                                        class="modal fade"
                                                        id="edit_artifact<?php echo $countId ?>"
                                                        tabindex="-1">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        Chỉnh sửa hiện vật
                                                                    </h5>
                                                                    <button
                                                                        type="button"
                                                                        class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <!-- Form chỉnh sửa hiện vật -->
                                                                    <form action="" method="post" enctype="multipart/form-data">
                                                                        <div class="form-group text-start">
                                                                            <label for="artifact_img">Hình ảnh</label>
                                                                            <span>*<?php echo isset($errors['image']) ? $errors['image'] : ''; ?></span>
                                                                            <input type="file" class="form-control" name="artifact_img" id="artifact_img">
                                                                        </div>
                                                                        <div class="form-group text-start">
                                                                            <label for="artifact_name">Tên hiện vật</label>
                                                                            <span>*<?php echo isset($errors['name']) ? $errors['name'] : ''; ?></span>
                                                                            <input class="form-control" type="text" name="artifact_name" id="artifact_name"
                                                                                value="<?php echo isset($artifact['name']) ? $artifact['name'] : '' ?>">
                                                                        </div>
                                                                        <div class="form-group text-start">
                                                                            <label for="artifact_description">Mô tả hiện vật</label>
                                                                            <span>*<?php echo isset($errors['description']) ? $errors['description'] : ''; ?></span>
                                                                            <textarea class="form-control" name="artifact_description" id="artifact_description" rows="2"><?php echo isset($artifact['description']) ? $artifact['description'] : '' ?></textarea>
                                                                        </div>
                                                                        <div class="form-group text-start">
                                                                            <label for="artifact_type">Loại hiện vật</label>
                                                                            <span>*<?php echo isset($errors['type']) ? $errors['type'] : ''; ?></span>
                                                                            <select name="artifact_type" id="artifact_type" class="form-select bg-light">
                                                                                <option value="">Tùy chọn</option>
                                                                                <option value="weapon" <?php echo (isset($artifact['type']) && $artifact['type'] == 'weapon') ? 'selected' : '' ?>>Vũ khí</option>
                                                                                <option value="costume" <?php echo (isset($artifact['type']) && $artifact['type'] == 'costume') ? 'selected' : '' ?>>Trang phục</option>
                                                                                <option value="document" <?php echo (isset($artifact['type']) && $artifact['type'] == 'document') ? 'selected' : '' ?>>Tài liệu</option>
                                                                                <option value="picture" <?php echo (isset($artifact['type']) && $artifact['type'] == 'picture') ? 'selected' : '' ?>>Tranh ảnh</option>
                                                                                <option value="equiment" <?php echo (isset($artifact['type']) && $artifact['type'] == 'equiment') ? 'selected' : '' ?>>Dụng cụ</option>
                                                                                <option value="models" <?php echo (isset($artifact['type']) && $artifact['type'] == 'models') ? 'selected' : '' ?>>Mô hình</option>
                                                                            </select>
                                                                        </div>
                                                                        <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                        <button type="submit" name="edit_artifacts" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger d-flex"
                                                        data-bs-toggle="modal"
                                                        <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_artifact'] != 1)) ? 'disabled' : '' ?>
                                                        data-bs-target="#delet_artifact<?php echo $countId ?>">
                                                        <i class="bx bx-trash p-1"></i>Xóa
                                                    </button>
                                                    <!-- Cửa sổ xóa hiện vật -->
                                                    <div
                                                        class="modal fade"
                                                        id="delet_artifact<?php echo $countId ?>"
                                                        tabindex="-1">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-danger">
                                                                        Bạn chắc chắn muốn xóa hiện vật này!
                                                                    </h5>
                                                                    <button
                                                                        type="button"
                                                                        class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="colmd-12 d-flex gap-3">
                                                                        <img class="img-thumbnail" src="./public/uploads/imageArtifact/<?php echo $artifact['image'] ?>" alt="">
                                                                        <p><b><?php echo $artifact['name'] ?></b></p>
                                                                    </div>
                                                                    <p><?php echo mb_substr($artifact['description'], 0, 100) ?></p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <!-- Form xóa hiện vật -->
                                                                    <form method="post">
                                                                        <input type="hidden" name="artifact_id" value="<?php echo $artifact['artifact_id'] ?>">
                                                                        <button type="submit" name="delete_artifacts" class="btn btn-danger d-flex">
                                                                            <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                            <?php }
                            }  ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Phân trang -->
        <div class="container">
            <form method="post">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pageArtifact > 1) { ?>
                        <li class="page-item">
                            <a href="?request=manage_artifact&page=<?= $pageArtifact - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                        </li>
                    <?php }
                    for ($i = 1; $i <= $totalPageArtifact; $i++) { ?>
                        <li class="page-item">
                            <a href="?request=manage_artifact&page=<?= $i ?>" class="page-link  <?= $i == $pageArtifact ? 'active_page' : '' ?>"><?= $i ?></a>
                        </li>
                    <?php }
                    if ($pageArtifact < $totalPageArtifact) { ?>
                        <li class="page-item">
                            <a href="?request=manage_artifact&page=<?= $pageArtifact + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </form>
        </div>
    <?php }
    ?>
<?php  }
if ($countErr == 0) { ?>
    <p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
?>