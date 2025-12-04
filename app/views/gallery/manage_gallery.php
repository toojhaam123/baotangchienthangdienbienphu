<?php
$countErr = 0;
foreach ($permissions as $per_adition) {
    if (isset($_SESSION['users']) && ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['mana_news'] == 1)) {
        $countErr += 1; ?>
        <div class="row manager">
            <div class="my-3 border-bottom col-md-12 text-center">
                <h2>Quản lý hình ảnh và video </h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Bảng danh sách các hình ảnh và video</h5>
                    </div>
                    <div class="col-md-2 text-center">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#add_gallery"
                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['add_gallery'] != 1) ? 'disabled' : '' ?>>
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
                                        Thêm mới hình ảnh và video
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
                                            <label for="gallery_file">Thêm hình ảnh/video</label>
                                            <span>*<?php echo isset($errors['file']) ? $errors['file'] : '' ?></span>
                                            <input type="file" class="form-control" name="gallery_file[]" multiple accept="image/*, video/*" id="gallery_file">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="title">Tiêu đề</label>
                                            <span>*<?php echo isset($errors['title']) ? $errors['title'] : '' ?></span>
                                            <input class="form-control" type="text" name="title" id="title"
                                                value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="description">Mô tả hình ảnh/video</label>
                                            <span>*<?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
                                            <textarea class="form-control" name="description" id="description" rows="2"><?php echo isset($_POST['description']) ? $_POST['description'] : '' ?></textarea>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="gallery_type">Loại</label>
                                            <span>*<?php echo isset($errors['type']) ? $errors['type'] : '' ?></span>
                                            <select name="gallery_type" id="gallery_type" class="form-select bg-light">
                                                <option value="">Tùy chọn</option>
                                                <option value="image" <?php echo isset($_POST['gallery_type']) && $_POST['gallery_type'] == 'image' ? 'selected' : '' ?>>Ảnh</option>
                                                <option value="video" <?php echo isset($_POST['gallery_type']) && $_POST['gallery_type'] == 'video' ? 'selected' : '' ?>>Video</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="upload_gallery" class="btn btn-primary mt-2 float-end">Thêm mới</button>
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
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Loại</th>
                                    <th>Mô tả</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $countId = 0;
                                foreach ($galleries as $gallery) {
                                    $countId += 1;
                                    if ($gallery['tag'] == 'gallery') {
                                        if (isset($_POST['image'])) {
                                            if ($gallery['type'] == 'image') { ?>
                                                <tr>
                                                    <td><?php echo $gallery['gallery_id'] ?></td>
                                                    <td><?php echo $gallery['title'] ?></td>
                                                    <td> <?php
                                                            if ($gallery['type'] == 'image') { ?>
                                                            <img class="img-thumbnail" src="./public/imageGallery/<?php echo $gallery['img_video'] ?>"
                                                                alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>">
                                                        <?php } else { ?>
                                                            <video class="img-thumbnail" alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>" controls>
                                                                <source src="./public/videoGallery/<?php echo $gallery['img_video'] ?>">
                                                            </video>
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($gallery['type'] == 'image') {
                                                            echo 'Hình ảnh';
                                                        } else {
                                                            echo 'Video';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo mb_substr($gallery['description'], 0, 100) . '...' ?></td>
                                                    <td>
                                                        <div class="col-md-12 mana_action text-center d-flex">
                                                            <!-- nút ẩn hiện phần chỉnh sửa hình ảnh - video -->
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary d-flex"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit_gallery<?php echo $countId ?>"
                                                                <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_gallery'] != 1) ? 'disabled' : '' ?>>
                                                                <i class="bx bx-edit p-1"></i>Sửa
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-danger d-flex"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delet_gallery<?php echo $countId ?>"
                                                                <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_gallery'] != 1) ? 'disabled' : '' ?>>
                                                                <i class="bx bx-trash p-1"></i>Xóa
                                                            </button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } elseif (isset($_POST['video'])) {
                                            if ($gallery['type'] == 'video') { ?>
                                                <tr>
                                                    <td><?php echo $gallery['gallery_id'] ?></td>
                                                    <td><?php echo $gallery['title'] ?></td>
                                                    <td> <?php
                                                            if ($gallery['type'] == 'image') { ?>
                                                            <img class="img-thumbnail" src="./public/imageGallery/<?php echo $gallery['img_video'] ?>"
                                                                alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>">
                                                        <?php } else { ?>
                                                            <video class="img-thumbnail" alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>" controls>
                                                                <source src="./public/videoGallery/<?php echo $gallery['img_video'] ?>">
                                                            </video>
                                                        <?php }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($gallery['type'] == 'image') {
                                                            echo 'Hình ảnh';
                                                        } else {
                                                            echo 'Video';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td><?php echo mb_substr($gallery['description'], 0, 100) . '...' ?></td>
                                                    <td>
                                                        <div class="col-md-12 mana_action text-center d-flex">
                                                            <!-- nút ẩn hiện phần chỉnh sửa hình ảnh - video -->
                                                            <button
                                                                type="button"
                                                                class="btn btn-secondary d-flex"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#edit_gallery<?php echo $countId ?>"
                                                                <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_gallery'] != 1) ? 'disabled' : '' ?>>
                                                                <i class="bx bx-edit p-1"></i>Sửa
                                                            </button>
                                                            <button
                                                                type="button"
                                                                class="btn btn-danger d-flex"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#delet_gallery<?php echo $countId ?>"
                                                                <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_gallery'] != 1) ? 'disabled' : '' ?>>
                                                                <i class="bx bx-trash p-1"></i>Xóa
                                                            </button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td><?php echo $gallery['gallery_id'] ?></td>
                                                <td><?php echo $gallery['title'] ?></td>
                                                <td> <?php
                                                        if ($gallery['type'] == 'image') { ?>
                                                        <img class="img-thumbnail" src="./public/imageGallery/<?php echo $gallery['img_video'] ?>"
                                                            alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>">
                                                    <?php } else { ?>
                                                        <video class="img-thumbnail" alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>" controls>
                                                            <source src="./public/videoGallery/<?php echo $gallery['img_video'] ?>">
                                                        </video>
                                                    <?php }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($gallery['type'] == 'image') {
                                                        echo 'Hình ảnh';
                                                    } else {
                                                        echo 'Video';
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo mb_substr($gallery['description'], 0, 100) . '..' ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa hình ảnh - video -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_gallery<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_gallery'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delet_gallery<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_gallery'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                    <?php   }
                                    } ?>
                                    <!-- Cửa sổ chỉnh sửa hiện vật -->
                                    <div
                                        class="modal fade"
                                        id="edit_gallery<?php echo $countId ?>"
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
                                                    <!-- Form chỉnh sửa hình ảnh - video -->
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <div class="form-group text-start">
                                                            <label for="gallery_file">Thêm hình ảnh/video</label>
                                                            <span>*<?php echo isset($errors['file']) ? $errors['file'] : '' ?></span>
                                                            <input type="file" class="form-control" name="gallery_file" id="gallery_file">
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="title">Tiêu đề</label>
                                                            <span>*<?php echo isset($errors['title']) ? $errors['title'] : '' ?></span>
                                                            <input class="form-control" type="text" name="title" id="title"
                                                                value="<?php echo isset($gallery['title']) ? $gallery['title'] : '' ?>">
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="description">Mô tả hình ảnh/video</label>
                                                            <span>*<?php echo isset($errors['description']) ? $errors['description'] : '' ?></span>
                                                            <textarea class="form-control" name="description" id="description" rows="2"><?php echo isset($gallery['description']) ? $gallery['description'] : '' ?></textarea>
                                                        </div>
                                                        <div class="form-group text-start">
                                                            <label for="gallery_type">Loại</label>
                                                            <span>*<?php echo isset($errors['type']) ? $errors['type'] : '' ?></span>
                                                            <select name="gallery_type" id="gallery_type" class="form-select bg-light">
                                                                <option value="">Tùy chọn</option>
                                                                <option value="image" <?php echo isset($gallery['type']) && $gallery['type'] == 'image' ? 'selected' : '' ?>>Ảnh</option>
                                                                <option value="video" <?php echo isset($gallery['type']) && $gallery['type'] == 'video' ? 'selected' : '' ?>>Video</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="gallery_id" value="<?php echo $gallery['gallery_id'] ?>">
                                                        <button type="submit" name="update_gallery" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Cửa sổ xóa hình ảnh - video -->
                                    <div
                                        class="modal fade"
                                        id="delet_gallery<?php echo $countId ?>"
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
                                                        if ($gallery['type'] == 'image') { ?>
                                                            <img class="img-thumbnail" src="./public/imageGallery/<?php echo $gallery['img_video'] ?>"
                                                                alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>">
                                                        <?php } else { ?>
                                                            <video class="img-thumbnail" alt="<?php echo $gallery['title'] ?>" title="<?php echo $gallery['title'] ?>" controls>
                                                                <source src="./public/videoGallery/<?php echo $gallery['img_video'] ?>">
                                                            </video>
                                                        <?php } ?>
                                                        <p><b><?php echo $gallery['title'] ?></b></p>
                                                    </div>
                                                    <p><?php echo $gallery['description'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <!-- Form xóa hiện vật -->
                                                    <form method="post">
                                                        <input type="hidden" name="gallery_id" value="<?php echo $gallery['gallery_id'] ?>">
                                                        <button type="submit" name="delete_galleries" class="btn btn-danger d-flex">
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
                    if ($pageGallery > 1) { ?>
                        <li class="page-item">
                            <a href="?request=manage_gallery&page=<?= $pageGallery - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                        </li>
                    <?php }
                    for ($i = 1; $i <= $totalPageGallery; $i++) { ?>
                        <li class="page-item">
                            <a href="?request=manage_gallery&page=<?= $i ?>" class="page-link <?= $i == $pageGallery ? 'active_page' : '' ?>"><?= $i ?></a>
                        </li>
                    <?php }
                    if ($pageGallery < $totalPageGallery) { ?>
                        <li class="page-item">
                            <a href="?request=manage_gallery&page=<?= $pageGallery + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
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