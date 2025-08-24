<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_News.php';
$id = isset($_GET['news_id']) ? $_GET['news_id'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';
foreach ($detailsNews as $news) {
    if ($news['news_id'] == $id) { ?>
        <div class="row center news  mt-5">
            <div class="col-md-12 border-bottom">
                <h2 class="text-center"><?php echo $news['title'] ?></h2>
            </div>
            <div>
                <i><b>Ngày đăng: </b> <?php echo $news['created_at'] ?></i>
            </div>
            <div class="col-md-12 detail_img_news my-2">
                <img src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="Hình ảnh tiêu đề">
                <div class="row text-center">
                    <i><?php echo $news['image_name'] ?></i>
                </div>
            </div>
            <div class="col-md-12">
                <p><?php echo nl2br(htmlspecialchars($news['content'])) ?> </p>
            </div>
            <!-- Tin tức sự kiện khács -->
            <div class="row border-bottom">
                <div class="col-md-12 other_news mb-3">
                    <h5>Tin tức - sự kiện khác</h5>
                    <?php
                    $randomkeys = array_rand($allNews, 4);
                    foreach ($randomkeys as $keys) { ?>
                        <div class="row mt-1 card_news ms-1">
                            <div class="col-md-12">
                                <a href="?request=news_detail&news_id=<?php echo $allNews[$keys]['news_id'] ?>&type=<?php echo $allNews[$keys]['type'] ?>">
                                    <div class="d-flex">
                                        <div class="row">
                                            <div class="col-md-3 col-3">
                                                <img src="./public/uploads/imageNews/<?php echo $allNews[$keys]['image'] ?>" alt="">
                                            </div>
                                            <div class="col-md-9 col-9">
                                                <p><i><?php echo $allNews[$keys]['title'] ?></i></p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    <?php  }
                    ?>
                </div>
            </div>
            <!-- Bình luận -->
            <div class="comment">
                <h5 class="ms-4"><i class='bx bxs-comment-detail'></i>Bình luận</h5>
                <form action="" method="post">
                    <div class="col-12 text-center">
                        <textarea
                            class="form-control form-comment" rows="3" cols="10" name="comment" id="comment"
                            placeholder="<?php echo isset($errors['cmt']) ? $errors['cmt'] : 'Viết bình luận...' ?>"></textarea>
                    </div>
                    <?php
                    if (!isset($_SESSION['users'])) { ?>
                        <label class="form-label" for="fullname">Họ và tên</label>
                        <span>* <?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                        <input class="form-control" type="text" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" name="commenter">
                    <?php }
                    ?>
                    <div class="modal-footer border-0">
                        <input type="hidden" name="object_id" value="<?php echo $news['news_id'] ?>">
                        <input type="hidden" name="object_type" value="<?php echo $type ?>">
                        <button
                            name="post_cmt" type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-md-12 border-bottom text-center w-50">
                    <h5>Các bình luận về tin tức - sự kiện</h5>
                </div>
                <!-- Danh sách bình luận -->
                <?php
                $cmtId = 0;
                foreach ($allCmt as $cmt) {
                    if ($cmt['object_id'] == $news['news_id']) { ?>
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
?>