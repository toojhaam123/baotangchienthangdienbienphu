<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_Comment.php';
$countErr = 0;
foreach ($permissions as $per_adition) {
    if (isset($_SESSION['users']) && ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['mana_news'] == 1)) {
        $countErr += 1; ?>
        <div class="row manager">
            <h2 class="my-3 border-bottom col-md-12 text-center">Quản lý bình luận và phản hồi</h2>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-10">
                        <h5>Bảng danh sách các bình luận và phản hồi</h5>
                    </div>
                    <div class="col-md-12">
                        <form action="" method="post">
                            <button type="submit" class="btn <?php echo isset($_POST['comment']) ? 'btn-primary' : '' ?>" name="comment">Bình luận</button>
                            <button type="submit" class="btn <?php echo isset($_POST['feedback']) ? 'btn-primary' : '' ?>" name="feedback">Phản hồi</button>
                        </form>
                    </div>
                    <table class="table table-bordered mt-2">
                        <thead class="text-center">
                            <?php
                            if (isset($_POST['feedback'])) { ?>
                                <tr>
                                    <th>ID</th>
                                    <th>Nội dung</th>
                                    <th>Loại</th>
                                    <th>Người phản hồi</th>
                                    <th>Thao tác</th>
                                </tr>
                            <?php } else { ?>
                                <tr>
                                    <th>ID</th>
                                    <th>Nội dung</th>
                                    <th>Loại</th>
                                    <th>Người bình luận</th>
                                    <th>Đối tượng</th>
                                    <th>Thao tác</th>
                                </tr>
                            <?php  }
                            ?>
                        </thead>
                        <?php
                        $countId = 0;
                        foreach ($allCmt as $cmt) {
                            $countId += 1;
                            if (isset($_POST['feedback'])) {
                                if ($cmt['type'] == 'feedback') { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $cmt['comment_id'] ?></td>
                                            <td><?php echo $cmt['content'] ?></td>
                                            <td><?php
                                                if ($cmt['type'] == 'comment') {
                                                    echo 'Bình luận';
                                                }
                                                if ($cmt['type'] == 'feedback') {
                                                    echo 'Phản hồi';
                                                }
                                                ?></td>
                                            <td><?php echo $cmt['commenter'] ?></td>
                                            <td>
                                                <div class="col-md-12 mana_action text-center d-flex">
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger d-flex"
                                                        data-bs-toggle="modal"
                                                        <?php echo ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_comment'] != 1) ? 'disabled' : '' ?>
                                                        data-bs-target="#delete_comment<?php echo $countId ?>">
                                                        <i class="bx bx-trash p-1"></i>Xóa
                                                    </button>
                                                    <!-- Cửa sổ xóa hiện vật -->
                                                    <div
                                                        class="modal fade"
                                                        id="delete_comment<?php echo $countId ?>"
                                                        tabindex="-1">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-danger">
                                                                        Bạn chắc chắn muốn xóa bình luận này!
                                                                    </h5>
                                                                    <button
                                                                        type="button"
                                                                        class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="colmd-12 d-flex gap-3">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Nội dung bình luận</th>
                                                                                    <th>Người bình luận</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo $cmt['content'] ?></td>
                                                                                    <td><?php echo $cmt['commenter'] ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa hiện vật -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="cmt_id" value="<?php echo $cmt['comment_id'] ?>">
                                                                            <button type="submit" name="delete_cmt" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                <?php  }
                            } else {
                                if ($cmt['type'] == 'comment') { ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $cmt['comment_id'] ?></td>
                                            <td><?php echo $cmt['content'] ?></td>
                                            <td><?php
                                                if ($cmt['type'] == 'comment') {
                                                    echo 'Bình luận';
                                                }
                                                if ($cmt['type'] == 'feedback') {
                                                    echo 'Phản hồi';
                                                }
                                                ?></td>
                                            <td><?php echo $cmt['commenter'] ?></td>
                                            <td><?php
                                                if ($cmt['object_type'] == 'exhibition') {
                                                    echo "Triển lãm";
                                                } elseif ($cmt['object_type'] == 'artifact') {
                                                    echo "Hiện vật";
                                                } elseif ($cmt['object_type'] == 'news') {
                                                    echo "Tin tức";
                                                } else {
                                                    echo "Sự kiện";
                                                } ?>
                                            </td>
                                            <td>
                                                <div class="col-md-12 mana_action text-center d-flex">
                                                    <button
                                                        type="button"
                                                        class="btn btn-danger d-flex"
                                                        data-bs-toggle="modal"
                                                        <?php echo ($_SESSION['users']['user_id'] == $per_adition['user_id']) && ($per_adition['delete_comment'] != 1) ? 'disabled' : '' ?>
                                                        data-bs-target="#delete_comment<?php echo $countId ?>">
                                                        <i class="bx bx-trash p-1"></i>Xóa
                                                    </button>
                                                    <!-- Cửa sổ xóa bình luận -->
                                                    <div
                                                        class="modal fade"
                                                        id="delete_comment<?php echo $countId ?>"
                                                        tabindex="-1">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title text-danger">
                                                                        Bạn chắc chắn muốn xóa bình luận này!
                                                                    </h5>
                                                                    <button
                                                                        type="button"
                                                                        class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="colmd-12 d-flex gap-3">
                                                                        <table class="table table-bordered">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>Nội dung bình luận</th>
                                                                                    <th>Người bình luận</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td><?php echo $cmt['content'] ?></td>
                                                                                    <td><?php echo $cmt['commenter'] ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <!-- Form xóa bình luận hoặc phản hồi -->
                                                                        <form method="post">
                                                                            <input type="hidden" name="cmt_id" value="<?php echo $cmt['comment_id'] ?>">
                                                                            <button type="submit" name="delete_cmt" class="btn btn-danger d-flex">
                                                                                <i class="bx bx-trash p-1"></i>Xóa</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                        <?php }
                            }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    <?php }
}
if ($countErr == 0) { ?>
    <p class="text-center mt-5 text-danger border-bottom">Bạn không có quyền truy cập trang này!</p>
<?php }
?>