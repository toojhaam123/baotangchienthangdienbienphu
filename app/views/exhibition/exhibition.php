<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_Exhibition.php';
?>
<div class="row exhibition center mt-5">
    <div class="row collapse" id="introduce">
        <div class="col-md-4">
            <p>Trang Triển lãm của Bảo tàng Chiến thắng Điện Biên Phủ là không gian trực tuyến tuyệt vời, mang đến cho bạn
                cơ hội khám phá những triển lãm lịch sử quan trọng về trận chiến Điện Biên Phủ – một chiến thắng vang dội trong
                cuộc kháng chiến chống Pháp và là một phần không thể thiếu trong di sản lịch sử dân tộc. Tại đây, bạn có thể tìm hiểu
                về các hiện vật lịch sử, tài liệu, hình ảnh và video tái hiện lại những khoảnh khắc hào hùng của cuộc chiến.</p>
        </div>
        <div class="col-md-4 image_exhibition">
            <img class="img-thumbnail" src="./image/Triển lãm  2.jpg" alt="Hình ảnh về một triển lãm">
        </div>
        <div class="col-md-4">
            <p>Trong trang triển lãm, bạn sẽ được chiêm ngưỡng các hiện vật gắn liền với lịch sử trận Điện Biên Phủ và các chiến sĩ anh hùng.
                Các tài liệu quý báu, hình ảnh và video sẽ giúp bạn hiểu rõ hơn về quá trình đấu tranh,
                những hy sinh cao cả và những đóng góp lớn lao của các chiến sĩ cũng như nhân dân Việt Nam trong cuộc kháng chiến.</p>
        </div>
        <div class="col-md-12">
            <p>Triển lãm không chỉ là nơi để hiểu thêm về trận chiến Điện Biên Phủ, mà còn là không gian tôn vinh những hy sinh
                cao cả của các chiến sĩ, những người đã cống hiến cả tuổi trẻ và sinh mệnh để bảo vệ độc lập dân tộc.
                Đây là cơ hội để bạn tham gia vào một hành trình lịch sử sống động, ghi nhớ những chiến công và bài học lịch sử quý giá.</p>
        </div>
    </div>
    <div class="col-md-12 btn_intronduce text-center">
        <button class="btn border-0" id="btn_introduce" data-bs-toggle="collapse" data-bs-target="#introduce">
            Bấm để hiện giới thiệu</button>
        <div class="col-md-8" id="fake_conten"></div>
    </div>
    <div class="col-md-12 border-bottom mt-2 text-center">
        <h4>Các triển lãm</h4>
    </div>
    <div class="col-md-12">
        <form action="" method="post">
            <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
            <button type="submit" class="btn <?php echo isset($_POST['image']) ? 'btn-primary' : '' ?>" name="image">Hình ảnh</button>
            <button type="submit" class="btn <?php echo isset($_POST['video']) ? 'btn-primary' : '' ?>" name="video">Video</button>
        </form>
    </div>
    <div class="row list_exhibition mb-3">
        <?php
        foreach ($exhibitions as $exhibition) {
            if (isset($_POST['image'])) {
                if ($exhibition['type'] == 'image') { ?>
                    <div class="col-md-6 col-12 col-lg-3 my-2 center p-1">
                        <div class="row card">
                            <a class="w-100 img-thumbnail" href="?request=exhibition_detail&exhibition_id=<?php echo $exhibition['exhibition_id'] ?>&type=<?php echo $exhibition['type'] ?>&group_id=<?= $exhibition['group_id'] ?>">
                                <div class="col-12">
                                    <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $exhibition['img_video'] ?>"
                                        alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>">
                                </div>
                                <div class="col-12 card-text ms-1 mt-1">
                                    <p><b><?php echo mb_substr($exhibition['title'], 0, 65) . '...'  ?></b></p>
                                </div>
                                <i><b>Ngày đăng:</b> <?php echo $exhibition['created_at'] ?></i>
                            </a>
                        </div>
                    </div>
                <?php }
            } elseif (isset($_POST['video'])) {
                if ($exhibition['type'] == 'video') { ?>
                    <div class="col-md-6 col-12 col-lg-3 my-2 center p-1">
                        <div class="row card">
                            <a class="w-100 img-thumbnail" href="?request=exhibition_detail&exhibition_id=<?php echo $exhibition['exhibition_id'] ?>&type=<?php echo $exhibition['type'] ?>&group_id=<?= $exhibition['group_id'] ?>">
                                <div class="col-12">
                                    <video class="img-thumbnail" controls title="<?php echo $exhibition['title'] ?>">
                                        <source src="./public/videoExhibition/<?= $exhibition['img_video'] ?>">
                                    </video>
                                </div>
                                <div class="col-12 card-text ms-1 mt-1">
                                    <p><b><?php echo mb_substr($exhibition['title'], 0, 65) . '...'  ?></b></p>
                                </div>
                                <i><b>Ngày đăng:</b> <?php echo $exhibition['created_at'] ?></i>
                            </a>
                        </div>
                    </div>
                <?php }
            } else {
                if ($exhibition['type'] == 'image') { ?>
                    <div class="col-md-6 col-12 col-lg-3 my-2 center p-1">
                        <div class="row card">
                            <a class="w-100 img-thumbnail" href="?request=exhibition_detail&exhibition_id=<?php echo $exhibition['exhibition_id'] ?>&type=<?php echo $exhibition['type'] ?>&group_id=<?= $exhibition['group_id'] ?>">
                                <div class="col-12">
                                    <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $exhibition['img_video'] ?>"
                                        alt="<?php echo $exhibition['title'] ?>" title="<?php echo $exhibition['title'] ?>">
                                </div>
                                <div class="col-12 card-text ms-1 mt-1">
                                    <p><b><?php echo mb_substr($exhibition['title'], 0, 65) . '...'  ?></b></p>
                                </div>
                                <i><b>Ngày đăng:</b> <?php echo $exhibition['created_at'] ?></i>
                            </a>
                        </div>
                    </div>
                <?php  } else { ?>
                    <div class="col-md-6 col-12 col-lg-3 my-2 center p-1">
                        <div class="row card">
                            <a class="w-100 img-thumbnail" href="?request=exhibition_detail&exhibition_id=<?php echo $exhibition['exhibition_id'] ?>&type=<?php echo $exhibition['type'] ?>&group_id=<?= $exhibition['group_id'] ?>">
                                <div class="col-12 p-2">
                                    <video class="img-thumbnail" controls title="<?php echo $exhibition['title'] ?>">
                                        <source src="./public/videoExhibition/<?= $exhibition['img_video'] ?>">
                                    </video>
                                </div>
                                <div class="col-12 card-text ms-1 mt-1">
                                    <p><b><?php echo mb_substr($exhibition['title'], 0, 65) . '...'  ?></b></p>
                                </div>
                                <i><b>Ngày đăng:</b> <?php echo $exhibition['created_at'] ?></i>
                            </a>
                        </div>
                    </div>
        <?php  }
            }
        }
        ?>
    </div>
</div>
<!-- Phân trang -->
<div class="container">
    <form method="post">
        <ul class="pagination justify-content-center">
            <?php
            if ($pageExhibition > 1) { ?>
                <li class="page-item">
                    <a href="?request=exhibition&page=<?= $pageExhibition - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                </li>
            <?php }
            for ($i = 1; $i <= $totalPageExhibition; $i++) { ?>
                <li class="page-item">
                    <a href="?request=exhibition&page=<?= $i ?>" class="page-link <?= $i == $pageExhibition ? 'active_page' : '' ?>"><?= $i ?></a>
                </li>
            <?php }
            if ($pageExhibition < $totalPageExhibition) { ?>
                <li class="page-item">
                    <a href="?request=exhibition&page=<?= $pageExhibition + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
                </li>
            <?php }
            ?>
        </ul>
    </form>
</div>
<p class="text-center">----------Hết----------</p>