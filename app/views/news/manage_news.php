<?php
$countErr = 0;
foreach ($permissions as $per_adition) {
    if (isset($_SESSION['users']) && ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['mana_news'] == 1)) {
        $countErr += 1; ?>
        <div class="row manager">
            <div class="my-3 border-bottom col-md-12 text-center">
                <h2>Quản lý tin tức và sự kiện </h2>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Bảng danh sách các tin tức và sự kiện</h5>
                    </div>
                    <div class="col-md-2 text-center">
                        <button
                            type="button"
                            class="btn btn-success"
                            data-bs-toggle="modal"
                            data-bs-target="#add_news"
                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['add_news'] != 1) ? 'disabled' : '' ?>>
                            <i class="bx bx-plus"></i> Thêm mới
                        </button>
                    </div>
                    <!-- Cửa sổ thêm mới tin tức và sự kiện -->
                    <div
                        class="modal fade"
                        id="add_news"
                        tabindex="-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">
                                        Thêm mới hình ảnh
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
                                            <label for="news_image">Thêm hình ảnh</label>
                                            <span>*<?php echo isset($errors['image']) ? $errors['image'] : '' ?></span>
                                            <input type="file" class="form-control" name="news_image" id="news_file">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="title">Tên hình ảnh</label>
                                            <span>*<?php isset($errors['image_name']) ? $errors['image_name'] : '' ?></span>
                                            <input class="form-control" type="text" name="image_name" id="image_name"
                                                value="<?php echo isset($_POST['image_name']) ? $_POST['image_name'] : '' ?>">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="title">Tên tin tức/sự kiện</label>
                                            <span>*<?php isset($errors['title']) ? $errors['title'] : '' ?></span>
                                            <input class="form-control" type="text" name="title" id="title"
                                                value="<?php echo isset($_POST['title']) ? $_POST['title'] : '' ?>">
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="content">Nội dung tin tức/sự kiện</label>
                                            <span>*<?php isset($errors['content']) ? $errors['content'] : '' ?></span>
                                            <textarea class="form-control" name="content" id="content" rows="10"><?php echo isset($_POST['content']) ? $_POST['content'] : '' ?></textarea>
                                        </div>
                                        <div class="form-group text-start">
                                            <label for="type">Loại</label>
                                            <span>*<?php isset($errors['type']) ? $errors['type'] : '' ?></span>
                                            <select name="type" id="type" class="form-select bg-light">
                                                <option value="">Tùy chọn</option>
                                                <option value="news" <?php echo isset($_POST['type']) && ($_POST['type'] == 'news') ? 'selected' : '' ?>>Tin tức</option>
                                                <option value="event" <?php echo isset($_POST['type']) && ($_POST['type'] == 'event') ? 'selected' : '' ?>>Sự kiện</option>
                                            </select>
                                        </div>
                                        <button type="submit" name="creat_news" class="btn btn-primary mt-2 float-end">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form action="" method="post">
                            <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
                            <button type="submit" class="btn <?php echo isset($_POST['news']) ? 'btn-primary' : '' ?>" name="news">Tin tức</button>
                            <button type="submit" class="btn <?php echo isset($_POST['event']) ? 'btn-primary' : '' ?>" name="event">Sự kiện</button>
                        </form>
                    </div>
                    <div class="col-md-12 mt-2">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Hình ảnh</th>
                                    <th>Tên hình</th>
                                    <th>Nội dung</th>
                                    <th>Loại</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <?php
                            $countId = 0;
                            foreach ($allNews as $news) {
                                $countId += 1;
                                if (isset($_POST['news'])) {
                                    if ($news['type'] == 'news') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $news['news_id']; ?></td>
                                                <td><?php echo $news['title'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?>" title="<?php echo $news['title'] ?>"></td>
                                                <td><?php echo mb_substr($news['image_name'], 0, 100) . '...' ?></td>
                                                <td><?php echo mb_substr($news['content'], 0, 100) . '...' ?></td>
                                                <td><?php if ($news['type']  == 'news') {
                                                        echo 'Tin tức';
                                                    } else {
                                                        echo 'Sự kiện';
                                                    } ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa tin tức - sự kiện -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_news<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_news'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delet_news<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_news'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php }
                                } elseif (isset($_POST['event'])) {
                                    if ($news['type'] == 'event') { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $news['news_id']; ?></td>
                                                <td><?php echo $news['title'] ?></td>
                                                <td><img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?>" title="<?php echo $news['title'] ?>"></td>
                                                <td><?php echo mb_substr($news['image_name'], 0, 100) . '...' ?></td>
                                                <td><?php echo mb_substr($news['content'], 0, 100) . '...' ?></td>
                                                <td><?php if ($news['type']  == 'news') {
                                                        echo 'Tin tức';
                                                    } else {
                                                        echo 'Sự kiện';
                                                    } ?></td>
                                                <td>
                                                    <div class="col-md-12 mana_action text-center d-flex">
                                                        <!-- nút ẩn hiện phần chỉnh sửa tin tức - sự kiện -->
                                                        <button
                                                            type="button"
                                                            class="btn btn-secondary d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#edit_news<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_news'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-edit p-1"></i>Sửa
                                                        </button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger d-flex"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#delet_news<?php echo $countId ?>"
                                                            <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_news'] != 1) ? 'disabled' : '' ?>>
                                                            <i class="bx bx-trash p-1"></i>Xóa
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php }
                                } else { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $news['news_id']; ?></td>
                                            <td><?php echo $news['title'] ?></td>
                                            <td><img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?>" title="<?php echo $news['title'] ?>"></td>
                                            <td><?php echo mb_substr($news['image_name'], 0, 100) . '...' ?></td>
                                            <td><?php echo mb_substr($news['content'], 0, 100) . '...' ?></td>
                                            <td><?php if ($news['type']  == 'news') {
                                                    echo 'Tin tức';
                                                } else {
                                                    echo 'Sự kiện';
                                                } ?></td>
                                            <td>
                                                <div class="col-md-12 mana_action text-center d-flex">
                                                    <!-- nút ẩn hiện phần chỉnh sửa tin tức - sự kiện -->
                                                    <button
                                                        type="button"
                                                        class="btn btn-secondary d-flex"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#edit_news<?php echo $countId ?>"
                                                        <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['edit_news'] != 1) ? 'disabled' : '' ?>>
                                                        <i class="bx bx-edit p-1"></i>Sửa
                                                    </button>

                                                    <button
                                                        type="button"
                                                        class="btn btn-danger d-flex"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#delet_news<?php echo $countId ?>"
                                                        <?php echo (($_SESSION['users']['user_id'] == $per_adition['user_id']) && $per_adition['delete_news'] != 1) ? 'disabled' : '' ?>>
                                                        <i class="bx bx-trash p-1"></i>Xóa
                                                    </button>

                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php } ?>
                                <!-- Cửa sổ chỉnh tin tức - sự kiện -->
                                <div
                                    class="modal fade"
                                    id="edit_news<?php echo $countId ?>"
                                    tabindex="-1">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Chỉnh sửa tin tức - sự kiện
                                                </h5>
                                                <button
                                                    type="button"
                                                    class="btn-close"
                                                    data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form chỉnh sửa tin tức - sự kiện -->
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <div class="form-group text-start">
                                                        <label for="news_image">Thêm hình ảnh</label>
                                                        <span>*<?php echo isset($errors['image']) ? $errors['image'] : '' ?></span>
                                                        <input type="file" class="form-control" name="news_image" id="news_file">
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label for="title">Tên hình ảnh</label>
                                                        <span>*<?php isset($errors['image_name']) ? $errors['image_name'] : '' ?></span>
                                                        <input class="form-control" type="text" name="image_name" id="image_name"
                                                            value="<?php echo isset($news['image_name']) ? $news['image_name'] : '' ?>">
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label for="title">Tên tin tức/sự kiện</label>
                                                        <span>*<?php isset($errors['title']) ? $errors['title'] : '' ?></span>
                                                        <input class="form-control" type="text" name="title" id="title"
                                                            value="<?php echo isset($news['title']) ? $news['title'] : '' ?>">
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label for="content">Nội dung tin tức/sự kiện</label>
                                                        <span>*<?php isset($errors['content']) ? $errors['content'] : '' ?></span>
                                                        <textarea class="form-control" name="content" id="content" rows="10"><?php echo isset($news['content']) ? $news['content'] : '' ?></textarea>
                                                    </div>
                                                    <div class="form-group text-start">
                                                        <label for="type">Loại</label>
                                                        <span>*<?php isset($errors['type']) ? $errors['type'] : '' ?></span>
                                                        <select name="type" id="type" class="form-select bg-light">
                                                            <option value="">Tùy chọn</option>
                                                            <option value="news" <?php echo isset($news['type']) && ($news['type'] == 'news') ? 'selected' : '' ?>>Tin tức</option>
                                                            <option value="event" <?php echo isset($news['type']) && ($news['type'] == 'event') ? 'selected' : '' ?>>Sự kiện</option>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="news_id" value="<?php echo $news['news_id'] ?>">
                                                    <button type="submit" name="update_news" class="btn btn-primary mt-2 float-end">Lưu chỉnh sửa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Cửa sổ xóa hiện vật -->
                                <div
                                    class="modal fade"
                                    id="delet_news<?php echo $countId ?>"
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
                                                    <img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?> " title="<?php echo $news['title'] ?>">
                                                    <p><b><?php echo $news['title'] ?></b></p>
                                                </div>
                                                <p><?php echo mb_substr($news['content'], 0, 100) . '...' ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <!-- Form xóa hiện vật -->
                                                <form method="post">
                                                    <input type="hidden" name="news_id" value="<?php echo $news['news_id'] ?>">
                                                    <button type="submit" name="del_news" class="btn btn-danger d-flex">
                                                        <i class="bx bx-trash p-1"></i>Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
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
                    if ($pageNews > 1) { ?>
                        <li class="page-item">
                            <a href="?request=manage_news&page=<?= $pageNews - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                        </li>
                    <?php }
                    for ($i = 1; $i <= $totalPageNews; $i++) { ?>
                        <li class="page-item">
                            <a href="?request=manage_news&page=<?= $i ?>" class="page-link <?= $i == $pageNews ? 'active_page' : '' ?>"><?= $i ?></a>
                        </li>
                    <?php }
                    if ($pageNews < $totalPageNews) { ?>
                        <li class="page-item">
                            <a href="?request=manage_news&page=<?= $pageNews + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
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