<?php
$countErr = 0;
foreach ($permissions as $per_adition) {
    if (isset($_SESSION['users']) && ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['mana_news'] == 1)) {
        $countErr += 1; ?>
        <div class="row manager">
            <div class="my-3 border-bottom col-md-12 text-center">
                <h2>Quản lý triển lãm </h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Bảng danh sách các triển lãm</h5>
                    </div>
                    <div class="col-md-2 text-center">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#add_gallery"
                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['add_exhibition'] != 1) ? 'disabled' : '' ?>>
                            <i class="bx bx-plus"></i> Thêm mới
                        </button>
                    </div>
                    <!-- Cửa sổ thêm mới hình ảnh và video -->
                    <div
                        class="modal fade"
                        id="add_gallery"
                        tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Thêm mới triển lãm
                                    </h5>
                                    <button
                                        type="button"
                                        class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form thêm mới hình ảnh và video -->
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group text-start">
                                            <label for="exhibition_file">Thêm hình ảnh triển lãm</label>
                                            <span>*<?php echo isset($errors['file']) ? $errors['file'] : '' ?></span>
                                            <input type="file" class="form-control" name="exhibition_file[]" multiple accept="image/*, video/*" id="exhibition_file">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="title">Tiêu đề triển lãm</label>
                                            <span>*<?php echo isset($errors['title']) ? $errors['title'] : '' ?></span>
                                            <input class="form-control" type="text" name="title" id="title"
                                                value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="description">Nội dung triển lãm</label>
                                            <span>*<?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
                                            <textarea class="form-control" name="description" id="description" rows="2"><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="type">Loại</label>
                                            <span>*<?php echo isset($errors['type']) ? $errors['type'] : '' ?></span>
                                            <select name="type" id="type" class="form-select bg-light">
                                                <option value="">Tùy chọn</option>
                                                <option value="image" <?php echo isset($_POST['type']) && $_POST['type'] == 'image' ? 'selected' : '' ?>>Ảnh</option>
                                                <option value="video" <?php echo isset($_POST['type']) && $_POST['type'] == 'video' ? 'selected' : '' ?>>Video</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="upload_exhibition" class="btn btn-primary mt-2 float-end">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="post">
                        <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
                        <button type="submit" class="btn <?php echo isset($_POST['image']) ? 'btn-primary' : '' ?>" name="image">Hình ảnh</button>
                        <button type="submit" class="btn <?php echo isset($_POST['video']) ? 'btn-primary' : '' ?>" name="video">Video</button>
                    </form>
                    <div class="col-md-12 mt-2">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Tên tư liệu</th>
                                    <th>Hình ảnh</th>
                                    <th>Loại</th>
                                    <th>Mô tả</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countId = 0;
                                foreach ($exhibitions as $exhibition) {
                                    $countId += 1;
                                    if (isset($_POST['image'])) {
                                        if ($exhibition['type'] == 'image') { ?>
                                            <tr>
                                                <td><?php echo $exhibition['exhibition_id'] ?></td>
                                                <td><?php echo $exhibition['title'] ?></td>
                                                <td> <?php
                                                        if ($exhibition['type'] == 'image') { ?>
                                                        <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $exhibition['img_video'] ?>"
                                                            alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>">
                                                    <?php } else { ?>
                                                        <video class="img-thumbnail" alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>" controls>
                                                            <source src="./public/videoGallery/<?php echo $exhibition['img_video'] ?>">
                                                        </video>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($exhibition['type'] == 'image') {
                                                        echo 'Hình ảnh';
                                                    } else {
                                                        echo 'Video';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($exhibition['description'], 0, 100) . '...' ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa triển lãm -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_exhibition<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_exhibition'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <!-- Nút ẩn hiện phần xóa triển lamx -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete_exhibition<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_exhibition'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } elseif (isset($_POST['video'])) {
                                        if ($exhibition['type'] == 'video') { ?>
                                            <tr>
                                                <td><?php echo $exhibition['exhibition_id'] ?></td>
                                                <td><?php echo $exhibition['title'] ?></td>
                                                <td> <?php
                                                        if ($exhibition['type'] == 'image') { ?>
                                                        <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $exhibition['img_video'] ?>"
                                                            alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>">
                                                    <?php } else { ?>
                                                        <video class="img-thumbnail" alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>" controls>
                                                            <source src="./public/videoGallery/<?php echo $exhibition['img_video'] ?>">
                                                        </video>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($exhibition['type'] == 'image') {
                                                        echo 'Hình ảnh';
                                                    } else {
                                                        echo 'Video';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($exhibition['description'], 0, 100) . '...' ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa triển lãm -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_exhibition<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_exhibition'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delete_exhibition<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_gallery'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td><?php echo $exhibition['exhibition_id'] ?></td>
                                            <td><?php echo $exhibition['title'] ?></td>
                                            <td> <?php
                                                    if ($exhibition['type'] == 'image') { ?>
                                                    <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $exhibition['img_video'] ?>"
                                                        alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>">
                                                <?php } else { ?>
                                                    <video class="img-thumbnail" alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>" controls>
                                                        <source src="./public/videoGallery/<?php echo $exhibition['img_video'] ?>">
                                                    </video>
                                                <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($exhibition['type'] == 'image') {
                                                    echo 'Hình ảnh';
                                                } else {
                                                    echo 'Video';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo mb_substr($exhibition['description'], 0, 100) . '...' ?></td>
                                            <td>
                                                <div class="col-md-12 mana_action text-center d-flex">
                                                    <!-- nút ẩn hiện phần chỉnh sửa triển lãm -->
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary d-flex"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#edit_exhibition<?php echo $countId ?>"
                                                        <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_exhibition'] != 1) ? 'disabled' : '' ?>>
                                                        <i class="bx bx-edit p-1"></i>Sửa
                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger d-flex"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delete_exhibition<?php echo $countId ?>"
                                                        <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_exhibition'] != 1) ? 'disabled' : '' ?>>
                                                        <i class="bx bx-trash p-1"></i>Xóa
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <!-- Cửa sổ chỉnh triển lãm -->
                                    <div
                                        class="modal fade"
                                        id="edit_exhibition<?php echo $countId ?>"
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
                                                    <!-- Form chỉnh sửa triển lãm -->
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <div class="form-group text-start">
                                                            <label for="exhibition_file">Thêm hình ảnh triển lãm</label>
                                                            <span>*<?php echo isset($errors['file']) ? $errors['file'] : '' ?></span>
                                                            <input type="file" class="form-control" name="exhibition_file[]" multiple accept="image/*, video/*" id="exhibition_file">
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="title">Tiêu đề triển lãm</label>
                                                            <span>*<?php echo isset($errors['title']) ? $errors['title'] : '' ?></span>
                                                            <input class="form-control" type="text" name="title" id="title"
                                                                value="<?php echo isset($exhibition['title']) ? $exhibition['title'] : '' ?>">
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="description">Nội dung triển lãm</label>
                                                            <span>*<?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
                                                            <textarea class="form-control" name="description" id="description" rows="2"><?php echo isset($exhibition['description']) ? $exhibition['description'] : '' ?></textarea>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="type">Loại</label>
                                                            <span>*<?php echo isset($errors['type']) ? $errors['type'] : '' ?></span>
                                                            <select name="type" id="type" class="form-select bg-light">
                                                                <option value="">Tùy chọn</option>
                                                                <option value="image" <?php echo isset($exhibition['type']) && $exhibition['type'] == 'image' ? 'selected' : '' ?>>Ảnh</option>
                                                                <option value="video" <?php echo isset($exhibition['type']) && $exhibition['type'] == 'video' ? 'selected' : '' ?>>Video</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="group_id" value="<?php echo $exhibition['group_id'] ?>">
                                                        <button type="submit" name="update_exhibition" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cửa sổ xóa triển lãm -->
                                    <div
                                        class="modal fade"
                                        id="delete_exhibition<?php echo $countId ?>"
                                        tabindex="-1">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-danger">
                                                        Bạn chắc chắn muốn xóa tư liệu này!
                                                    </h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="colmd-12 d-flex gap-3">
                                                        <?php
                                                        if ($exhibition['type'] == 'image') { ?>
                                                            <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $exhibition['img_video'] ?>"
                                                                alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>">
                                                        <?php } else { ?>
                                                            <video class="img-thumbnail" alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>" controls>
                                                                <source src="./public/videoGallery/<?php echo $exhibition['img_video'] ?>">
                                                            </video>
                                                        <?php } ?>
                                                        <p><b><?php echo $exhibition['title'] ?></b></p>
                                                    </div>
                                                    <p><?php echo mb_substr($exhibition['description'], 0, 100) . '...' ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <Xóa triể lãm -->
                                                    <form method="post">
                                                        <input type="hidden" name="group_id" value="<?php echo $exhibition['group_id'] ?>">
                                                        <button type="submit" name="delete_exhibitions" class="btn btn-danger d-flex">
                                                            <i class="bx bx-trash p-1"></i>Xóa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </tbody>
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
                    if ($pageExhibition > 1) { ?>
                        <li class="page-item">
                            <a href="?request=manage_exhibition&page=<?= $pageExhibition - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                        </li>
                    <?php }
                    for ($i = 1; $i <= $totalPageExhibition; $i++) { ?>
                        <li class="page-item">
                            <a href="?request=manage_exhibition&page=<?= $i ?>" class="page-link <?= $i == $pageExhibition ? 'active_page' : '' ?>"><?= $i ?></a>
                        </li>
                    <?php }
                    if ($pageExhibition < $totalPageExhibition) { ?>
                        <li class="page-item">
                            <a href="?request=manage_exhibition&page=<?= $pageExhibition + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
                        </li>
                    <?php }
                    ?>
                </ul>
            </form>
        </div>
    <?php  }
}
if ($countErr == 0) { ?>
    <p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
?>