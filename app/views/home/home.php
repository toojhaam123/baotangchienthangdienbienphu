<div class="image_title">
    <img src="./image/img-title.jpg" alt="Hình ảnh tiêu đề">
    <div class="box d-lg-block d-none">
        <h2 class="text-center text-white">KHÁM PHÁ <br> BẢO TÀNG CHIẾN THẮNG <br> ĐIỆN BIÊN PHỦ</h2>
    </div>
    <div class="box_btn text-center text-white fw-bold d-lg-block d-none">
        <a href="?request=artifact" class="nav-link">THAM QUAN NGAY</a>
    </div>
</div>
<!-- Thông tin giới thiệu -->
<div class="row introduct mt-4">
    <div class="col-md-6 col-sm-12 col-lg-6 border-bottom">
        <h4 class="text-center">Giới thiệu</h4>
        <div class="row">
            <p>Bảo tàng Chiến thắng Điện Biên Phủ là một địa chỉ văn hóa – lịch sử quan trọng, nơi lưu giữ và trưng bày hàng nghìn hiện vật, hình ảnh, tài liệu quý giá gắn liền với chiến dịch Điện Biên Phủ năm 1954 –
                một trong những mốc son chói lọi trong lịch sử kháng chiến của dân tộc Việt Nam. Bảo tàng không chỉ phản ánh chân thực quá trình đấu tranh gian khổ và tinh thần bất khuất của quân và dân ta, mà còn thể
                hiện sâu sắc tầm vóc và ý nghĩa lịch sử của chiến thắng "lừng lẫy năm châu, chấn động địa cầu".</p>
            <p>Thông qua các không gian trưng bày sinh động, hiện đại và khoa học, khách tham quan có thể hình dung rõ nét về những diễn biến then chốt của chiến dịch,
                vai trò của các vị tướng lĩnh, cũng như những đóng góp thầm lặng mà to lớn của nhân dân. Bảo tàng đồng thời là nơi giáo dục truyền thống yêu nước, khơi dậy niềm tự hào dân tộc,
                và truyền cảm hứng cho các thế hệ trẻ về tinh thần đoàn kết và ý chí vươn lên trong mọi hoàn cảnh.</p>
            <p>Với sự kết hợp giữa giá trị lịch sử và công nghệ hiện đại, Bảo tàng Chiến thắng Điện Biên Phủ ngày càng trở thành điểm đến hấp dẫn không chỉ với du khách trong nước mà còn với bạn bè quốc tế, góp phần
                quan trọng vào việc bảo tồn, phát huy di sản văn hóa và thúc đẩy du lịch lịch sử tại tỉnh Điện Biên.</p>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
        <img src="./image/Phao1nong.jpg" class="img-thumbnail" alt="Pháo 1 nòng">
    </div>
</div>
<div class="row introduct mt-4">
    <div class="col-md-6 col-6">
        <img src="./image/Sưu tầm lựu đạn.jpg" class="img-thumbnail" alt="">
    </div>
    <div class="col-md-6 col-6">
        <img src="./image/keo dan duoc.jpg" class="img-thumbnail" alt="" title="Đơn vị vận tải xe bò phục vụ chiến dịch Điện Biên Phủ">
    </div>
</div>

<!-- Hiện vật mới nhấtnhất -->
<div class="row mt-4 artifacts">
    <div class="col-md-12 text-center border-bottom">
        <h4>Hiện vật mới nhất</h4>
    </div>
    <div class="col-12 mt-1">
        <div class="row">
            <?php
            $countId = 0;
            foreach ($newArtifacts as $newArtifact) {
                $countId += 1 ?>
                <div class="col-md-4 col-sm-4 col-6 col-lg-3 mt-2">
                    <div class="card">
                        <a class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#detail_artifact<?php echo $countId ?>">
                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $newArtifact['image'] ?>"
                                alt="<?php echo $newArtifact['name'] ?>" title="<?php echo $newArtifact['name'] ?>">
                            <div class="card-text text-center">
                                <p class="pt-1 "><b><?php echo mb_substr($newArtifact['name'], 0, 30) . '...' ?></b></p>
                            </div>
                        </a>
                        <!-- Xem chi tiết hiện vật -->
                        <div class="modal fade detail_artifact" id="detail_artifact<?php echo $countId ?>">
                            <div class="modal-dialog modal-lg modal-custom-responsive">
                                <div class="modal-content">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title">Chi tiết hiện vật</h5>
                                        <button class="btn-close" type="button" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="col-md-12 border-bottom mb-3">
                                        <h3 class="text-center"><?php echo $newArtifact['name'] ?></h3>
                                        <div class="modal-body">
                                            <img class="card-img-top" src="./public/uploads/imageArtifact/<?php echo $newArtifact['image'] ?>"
                                                alt="<?php echo $newArtifact['name'] ?>" title="<?php echo $newArtifact['name'] ?>">
                                            <div class="row">
                                                <div class="col-md-8"></div>
                                                <div class="col-md-4">
                                                    <i><b>Ngày đăng: </b> <?php echo $newArtifact['created_at'] ?></i>
                                                </div>
                                            </div>
                                            <p><?php echo $newArtifact['description'] ?></p>
                                        </div>
                                    </div>
                                    <div class="comment">
                                        <h5 class="ms-4"><i class='bx bxs-comment-detail'></i>Bình luận</h5>
                                        <div class="col-12 text-center my-1">
                                        </div>
                                        <form action="" method="post">
                                            <div class="col-12 text-center">
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
                                                <input type="hidden" name="object_id" value="<?php echo $newArtifact['artifact_id'] ?>">
                                                <input type="hidden" name="object_type" value="artifact">
                                                <button
                                                    name="post_cmt" type="submit" class="btn btn-primary">Gửi</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="row d-flex justify-content-center mb-3">
                                        <div class="col-md-12 border-bottom text-center w-50">
                                            <h5>Các bình luận về hiện vật</h5>
                                        </div>
                                        <!-- Danh sách bình luận -->
                                        <?php
                                        foreach ($allCmt as $cmt) {
                                            if ($cmt['object_id'] == $newArtifact['artifact_id']) { ?>
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
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
            ?>
        </div>
    </div>
    <div class="col-md-12 arrow_artifact">
        <a class="float-end" href="?request=artifact">Khám phá thêm</a>
    </div>
</div>
<!-- Tin tức - sự nổi bật bật -->
<div class="row news mt-2">
    <div class="col-md-12 text-center mb-2 border-bottom">
        <h4>Tin tức - sự kiện <b class="text-danger">hot</b></h4>
    </div>
    <?php
    foreach ($allMaxNewsViews as $maxNewsViews) { ?>
        <div class="col-md-6 col-lg-6 center new_news mb-3 ms-0">
            <div class="row card_news">
                <a class="img-thumbnail" href="?request=news_detail&news_id=<?php echo $maxNewsViews['news_id'] ?>">
                    <div class="d-lg-flex d-lg-block mt-2">
                        <div class="col-md-12 col-lg-5 col-12 img_news">
                            <img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $maxNewsViews['image'] ?>" alt="<?php echo $maxNewsViews['title'] ?>" title="<?php echo $maxNewsViews['title'] ?>">
                        </div>
                        <div class="col-lg-7 col-md-12 col-12 ms-2">
                            <p><b><?php echo mb_substr($maxNewsViews['title'], 0, 100) . '...'  ?></b></p>
                        </div>
                    </div>
                    <p><?php echo mb_substr($maxNewsViews['content'], 0, 70) . ' ...' ?></p>
                    <i><b>Ngày đăng: </b><?php echo $maxNewsViews['created_at'] ?></i>
                    <i class="float-end">Tin tức</i>
                </a>
            </div>
        </div>
    <?php  }
    ?>
    <div class="col-md-12 arrow_news">
        <a class="float-end" href="?request=news">Đọc nhiều hơn</a>
    </div>
</div>
<p class="text-center">----------Hết----------</p>