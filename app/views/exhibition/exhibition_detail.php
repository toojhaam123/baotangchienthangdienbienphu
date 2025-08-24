<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_Exhibition.php';
$groupId = isset($_GET['group_id']) ? $_GET['group_id'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
if (isset($groupId)) {
    $exhibition = $detailExhibition[0];
    if (isset($exhibition)) {
        if ($exhibition['group_id'] == $groupId) {
            if ($type == 'image') { ?>
                <div class="row center exhibition_detail mt-5">
                    <div class="col-md-12 border-bottom">
                        <h2 class="text-center"><?php echo $exhibition['title']  ?></h2>
                    </div>
                    <div>
                        <i><b>Ngày đăng: </b><?php echo $exhibition['created_at'] ?></i>
                    </div>
                    <?php
                    $countId = 0;
                    foreach ($detailExhibition as $images) {
                        $countId += 1 ?>
                        <div class="col-md-4 col-lg-3 col-6 detail_img mt-4">
                            <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_image_exhibition<?php echo $countId ?>">
                                <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $images['img_video'] ?>"
                                    alt="<?php echo $exhibition['title']  ?>"
                                    title="<?php echo $exhibition['title']  ?>">
                            </a>
                        </div>
                        <div class="modal fade detail_image_exibition" id="detail_image_exhibition<?php echo $countId ?>">
                            <div class="modal-dialog modal-lg modal-custom-responsive">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $images['img_video'] ?>"
                                            alt="<?php echo $exhibition['title']  ?>"
                                            title="<?php echo $exhibition['title']  ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="col-md-12 mt-3 border-bottom">
                        <p><?php echo nl2br(htmlspecialchars($exhibition['description'])) ?></p>
                    </div>
                    <!-- Bình luận -->
                    <div class="comment">
                        <h5 class="ms-4"><i class='bx bxs-comment-detail'></i>Bình luận</h5>
                        <form action="" method="post">
                            <div class="col-12">
                                <textarea
                                    class="form-control form-comment" rows="3" cols="10" name="comment" id="comment"
                                    placeholder="<?php echo isset($errors['cmt']) ? $errors['cmt'] : 'Viết bình luận...' ?>"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?></textarea>
                            </div>
                            <?php
                            if (!isset($_SESSION['users'])) { ?>
                                <label class="form-label" for="fullname">Họ và tên</label>
                                <span>* <?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                                <input class="form-control" type="text" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" name="commenter">
                            <?php }
                            ?>
                            <div class="modal-footer border-0">
                                <input type="hidden" name="object_id" value="<?php echo $exhibition['group_id'] ?>">
                                <input type="hidden" name="object_type" value="exhibition">
                                <button
                                    name="post_cmt" type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-md-12 border-bottom text-center w-50">
                            <h5>Các bình luận về triển lãm</h5>
                        </div>
                        <!-- Danh sách bình luận -->
                        <?php
                        foreach ($allCmt as $cmt) {
                            if ($cmt['object_id'] == $exhibition['group_id']) { ?>
                                <div class="col-md-12 mt-3 created_at_cmt">
                                    <i class="float-end"><?php echo $cmt['created_at'] ?></i>
                                    <div class="list-comment text-dark">
                                        <h5><?php echo $cmt['commenter'] ?></h5>
                                        <p><?php echo $cmt['content'] ?></p>
                                    </div>
                                </div>
                        <?php   }
                        }
                        ?>
                    </div>
                </div>
            <?php } elseif ($type == 'video') { ?>
                <div class="row center exhibition_detail mt-5">
                    <div class="col-md-12 border-bottom">
                        <h2 class="text-center"><?php echo $exhibition['title']  ?></h2>
                    </div>
                    <div>
                        <i><b>Ngày đăng: </b><?php echo $exhibition['created_at'] ?></i>
                    </div>
                    <div class="col-md-12 detail_image mt-4">
                        <video controls title="<?php echo $exhibition['title'] ?>">
                            <source src="./public/videoExhibition/<?= $exhibition['img_video'] ?>">
                        </video>
                    </div>
                    <div class="col-md-12 mt-3 border-bottom">
                        <p><?php echo nl2br(htmlspecialchars($exhibition['description'])) ?></p>
                    </div>
                    <!-- Bình luận -->
                    <div class="comment">
                        <h5 class="ms-4"><i class='bx bxs-comment-detail'></i>Bình luận</h5>
                        <form action="" method="post">
                            <div class="col-12">
                                <textarea
                                    class="form-control form-comment" rows="3" cols="10" name="comment" id="comment"
                                    placeholder="<?php echo isset($errors['cmt']) ? $errors['cmt'] : 'Viết bình luận...' ?>"><?php echo isset($_POST['comment']) ? $_POST['comment'] : ''; ?></textarea>
                            </div>
                            <?php
                            if (!isset($_SESSION['users'])) { ?>
                                <label class="form-label" for="fullname">Họ và tên</label>
                                <span>* <?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                                <input class="form-control" type="text" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" name="commenter">
                            <?php }
                            ?>
                            <div class="modal-footer border-0">
                                <input type="hidden" name="object_id" value="<?php echo $exhibition['group_id'] ?>">
                                <input type="hidden" name="object_type" value="exhibition">
                                <button name="post_cmt" type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
                    </div>
                    <div class="row d-flex justify-content-center mb-3">
                        <div class="col-md-12 border-bottom text-center w-50">
                            <h5>Các bình luận về triển lãm</h5>
                        </div>
                        <!-- Danh sách bình luận -->
                        <?php
                        foreach ($allCmt as $cmt) {
                            if ($cmt['object_id'] == $exhibition['group_id']) { ?>
                                <div class="col-md-12 mt-3 created_at_cmt">
                                    <i class="float-end"><?php echo $cmt['created_at'] ?></i>
                                    <div class="list-comment text-dark">
                                        <h5><?php echo $cmt['commenter'] ?></h5>
                                        <p><?php echo $cmt['content'] ?></p>
                                    </div>
                                </div>
                        <?php   }
                        }
                        ?>
                    </div>
                </div>
<?php }
        }
    }
} else {
    echo "Không tìm được id nhóm!";
}
?>