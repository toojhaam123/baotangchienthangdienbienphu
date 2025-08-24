<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_Exhibition.php';
?>
<div class="row list_gallery center mt-5 mb-3">
    <div class="row collapse" id="introduce">
        <div class="col-md-12 border-1">
            <p>Khám phá những hình ảnh và video độc đáo, giúp bạn hiểu rõ hơn về lịch sử vĩ đại của trận chiến Điện Biên Phủ và
                hành trình bảo tồn di sản lịch sử tại Bảo tàng Chiến thắng Điện Biên Phủ. Những tài liệu hình ảnh và video này sẽ đưa
                bạn trở lại những khoảnh khắc quan trọng,
                những sự kiện lịch sử đầy cảm hứng, từ đó tôn vinh những hy sinh và chiến công của dân tộc Việt Nam.</p>
        </div>
    </div>
    <div class="col-md-12 btn_tronduce text-center">
        <button class="btn border-0" id="btn_introduce" data-bs-toggle="collapse" data-bs-target="#introduce">
            Bấm để hiện giới thiệu</button>
        <div class="col-md-8" id="fake_conten"></div>
    </div>
    <div class="col-md-12 border-bottom text-center">
        <h4>Các hình ảnh - video</h4>
    </div>
    <div class="col-md-12 mb-2">
        <form action="" method="post">
            <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
            <button type="submit" class="btn <?php echo isset($_POST['image']) ? 'btn-primary' : '' ?>" name="image">Hình ảnh</button>
            <button type="submit" class="btn <?php echo isset($_POST['video']) ? 'btn-primary' : '' ?>" name="video">Video</button>
        </form>
    </div>
    <?php
    $max = max(count($viewAllImageExhibition), count($allImageNews));
    $maxPage = max($totalPageImageNews, $totalPageImageExbition);
    $countId = 0;
    for ($i = 0; $i < $max; $i++) {
        $countId += 1;
        if (isset($viewAllImageExhibition[$i])) {
            if (isset($_POST['image'])) {
                if ($viewAllImageExhibition[$i]['type'] == 'image') { ?>
                    <div class="col-md-4 col-lg-3 list_file col-6 mb-2">
                        <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $viewAllImageExhibition[$i]['img_video'] ?>"
                            alt="<?php echo $viewAllImageExhibition[$i]['title'] ?>" data-bs-toggle="modal" title="<?php echo $viewAllImageExhibition[$i]['title'] ?>"
                            data-bs-target="#detail_gallery<?php echo $countId ?>">
                    </div>
                <?php }
            } elseif (isset($_POST['video'])) {
                if ($viewAllImageExhibition[$i]['type'] == 'video') { ?>
                    <div class="col-md-6 col-lg-3 list_file col-12 mb-3">
                        <div class="video">
                            <video class="img-thumbnail" controls alt="<?php echo $viewAllImageExhibition[$i]['title'] ?>" title="<?php echo $viewAllImageExhibition[$i]['title'] ?>">
                                <source src="./public/videoExhibition/<?php echo $viewAllImageExhibition[$i]['img_video'] ?>">
                            </video>
                            <button data-bs-target="#detail_gallery<?php echo $countId ?>" class=" btn btn-primary w-100"
                                data-bs-toggle="modal">Chi tiết</button>
                        </div>
                    </div>
                <?php }
            } else {
                if ($viewAllImageExhibition[$i]['type'] == 'image') { ?>
                    <div class="col-md-4 col-lg-3 list_file col-6 mb-2">
                        <img class="img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $viewAllImageExhibition[$i]['img_video'] ?>"
                            alt="<?php echo $viewAllImageExhibition[$i]['title'] ?>" data-bs-toggle="modal" title="<?php echo $viewAllImageExhibition[$i]['title'] ?>"
                            data-bs-target="#detail_gallery<?php echo $countId ?>">
                    </div>
                <?php }
                if ($viewAllImageExhibition[$i]['type'] == 'video') { ?>
                    <div class="col-md-6 col-lg-3 list_file col-12 mb-3">
                        <div class="video">
                            <video class="img-thumbnail" controls alt="<?php echo $viewAllImageExhibition[$i]['title'] ?>" title="<?php echo $viewAllImageExhibition[$i]['title'] ?>">
                                <source src="./public/videoExhibition/<?php echo $viewAllImageExhibition[$i]['img_video'] ?>">
                            </video>
                            <button data-bs-target="#detail_gallery<?php echo $countId ?>" class=" btn btn-primary w-100"
                                data-bs-toggle="modal">Chi tiết</button>
                        </div>
                    </div>
                <?php }
            }
            // <!--  Hiện thị chi tiết hình ảnh -->
            if ($viewAllImageExhibition[$i]['type'] == 'image') { ?>
                <div class="modal fade" tabindex="-1" id="detail_gallery<?php echo $countId ?>">
                    <div class="modal-dialog modal-lg modal-custom-responsive">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    Chi tiết hình ảnh
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <h3 class="text-center">
                                <?php echo $viewAllImageExhibition[$i]['title'] ?>
                            </h3>
                            <div class="modal-body">
                                <img class="modal-img mb-3 img-thumbnail" src="./public/uploads/imageExhibition/<?php echo $viewAllImageExhibition[$i]['img_video'] ?>"
                                    alt="<?php echo $viewAllImageExhibition[$i]['title'] ?>" title="<?php echo $viewAllImageExhibition[$i]['title'] ?>">
                                <b>Mô tả: </b>
                                <a href="?request=exhibition_detail&type=<?php echo $viewAllImageExhibition[$i]['type'] ?>&group_id=<?= $viewAllImageExhibition[$i]['group_id'] ?>">Hình ảnh từ triển lãm</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <!-- Hiện thị chi tiết video triển lãm -->
                <div class="modal fade" tabindex="-1" id="detail_gallery<?php echo $countId ?>">
                    <div class="modal-dialog modal-lg modal-custom-responsive">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    Thông tin video
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <h3 class="text-center">
                                <?php echo $viewAllImageExhibition[$i]['title'] ?>
                            </h3>
                            <div class="modal-body">
                                <b>Mô tả: </b>
                                <a href="?request=exhibition_detail&type=<?php echo $viewAllImageExhibition[$i]['type'] ?>&group_id=<?= $viewAllImageExhibition[$i]['group_id'] ?>">Video từ triển lãm</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        }
        // Phần hiện thị hình ảnh từ trang tin tức
        if (isset($allImageNews[$i])) {
            if (!isset($_POST['video'])) { ?>
                <div class="col-md-4 col-lg-3 list_file col-6 mb-3">
                    <img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $allImageNews[$i]['image'] ?>"
                        alt="<?php echo $allImageNews[$i]['title'] ?>" data-bs-toggle="modal" title="<?php echo $allImageNews[$i]['title'] ?>"
                        data-bs-target="#detail_news<?php echo $countId ?>">
                </div>
                <!--  Hiện thị chi tiết hình Ảnh -->
                <div class="modal fade" tabindex="-1" id="detail_news<?php echo $countId ?>">
                    <div class="modal-dialog modal-lg modal-custom-responsive">
                        <div class="modal-content">
                            <div class="modal-header border-0">
                                <h5 class="modal-title">
                                    Chi tiết hình ảnh
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <h3 class="text-center">
                                <?php echo $allImageNews[$i]['title'] ?>
                            </h3>
                            <div class="modal-body">
                                <img class="modal-img mb-3 img-thumbnail" src="./public/uploads/imageNews/<?php echo $allImageNews[$i]['image'] ?>"
                                    alt="<?php echo $allImageNews[$i]['title'] ?>" title="<?php echo $allImageNews[$i]['title'] ?>">
                                <b>Mô tả: </b>
                                <a href="?request=news_detail&news_id=<?php echo $allImageNews[$i]['news_id'] ?>&type=<?= $allImageNews[$i]['type'] ?>">Hình ảnh từ tin tức - sự kiện</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
    <?php }
    } ?>
</div>
<!-- Phân trang -->
<div class="container">
    <form method="post">
        <ul class="pagination justify-content-center">
            <?php
            if ($pageExhibition > 1) { ?>
                <li class="page-item">
                    <a href="?request=gallery&page=<?= $pageExhibition - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                </li>
            <?php }
            for ($i = 1; $i <= $maxPage; $i++) { ?>
                <li class="page-item">
                    <a href="?request=gallery&page=<?= $i ?>" class="page-link <?= $i == $pageExhibition ? 'active_page' : '' ?>"><?= $i ?></a>
                </li>
            <?php }
            if ($pageExhibition < $maxPage) { ?>
                <li class="page-item">
                    <a href="?request=gallery&page=<?= $pageExhibition + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
                </li>
            <?php }
            ?>
        </ul>
    </form>
</div>
<p class="text-center">----------Hết----------</p>