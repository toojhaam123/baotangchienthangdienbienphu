<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_News.php';
?>
<div class="row mb-4 center mt-5">
    <div class="row collapse" id="introduce">
        <div class="col-md-5 img-intro">
            <img src="./image/TintucSuKien.jpg" alt="">
        </div>
        <div class="col-md-7">
            <p>Trang Tin tức & Sự kiện của Bảo tàng Chiến thắng Điện Biên Phủ giúp bạn cập nhật những
                thông tin mới nhất về các triển lãm, hội thảo, sự kiện và các hoạt động văn hóa lịch sử quan trọng diễn ra tại bảo tàng.
                Chúng tôi luôn nỗ lực tổ chức các sự kiện nhằm tôn vinh những giá trị lịch sử, giáo dục cộng đồng và kết nối mọi người với
                di sản văn hóa dân tộc. Đừng bỏ lỡ cơ hội tham gia vào những hoạt động ý nghĩa này,
                nơi bạn có thể trực tiếp trải nghiệm và khám phá những câu chuyện lịch sử sống động từ cuộc kháng chiến của dân tộc Việt Nam.</p>
        </div>
    </div>
    <div class="col-md-12 btn_tronduce text-center">
        <button class="btn border-0" id="btn_introduce" data-bs-toggle="collapse" data-bs-target="#introduce">
            Bấm để hiện giới thiệu</button>
        <div class="col-md-8" id="fake_conten"></div>
    </div>
</div>
<!-- Các bản tin mới nhất -->
<div class="row news new_news mt-5">
    <div class="col-md-12 border-bottom text-center">
        <h4>Tin tức - Sự kiện mới nhất</h4>
    </div>
    <form action="" method="post">
        <button type="submit" class="btn <?php echo isset($_POST['all']) ? 'btn-primary' : '' ?>" name="all">Tất cả</button>
        <button type="submit" class="btn <?php echo isset($_POST['news']) ? 'btn-primary' : '' ?>" name="news">Tin tức</button>
        <button type="submit" class="btn <?php echo isset($_POST['event']) ? 'btn-primary' : '' ?>" name="event">Sự kiện</button>
    </form>
</div>
<div class="row news mt-2">
    <?php
    foreach ($allNews as $news) {
        if (isset($_POST['news'])) {
            if ($news['type'] == 'news') { ?>
                <div class="col-md-6 center new_news mb-3 ms-0 pb-2">
                    <div class="row card_news">
                        <a class="img-thumbnail" href="?request=news_detail&news_id=<?php echo $news['news_id'] ?>&type=<?= $news['type'] ?>">
                            <div class="d-lg-flex d-lg-block mt-2">
                                <div class="col-md-12 col-lg-5 col-12 img_news">
                                    <img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?>" title="<?php echo $news['title'] ?>">
                                </div>
                                <div class="col-lg-7 col-md-12 col-12 ms-1">
                                    <p><b><?php echo mb_substr($news['title'], 0, 100) . '...'  ?></b></p>
                                </div>
                            </div>
                            <p><?php echo mb_substr($news['content'], 0, 70) . ' ...' ?></p>
                            <i><b>Ngày đăng: </b><?php echo $news['created_at'] ?></i>
                            <i class="float-end">Tin tức</i>
                        </a>
                    </div>
                </div>
            <?php  }
        } elseif (isset($_POST['event'])) {
            if ($news['type'] == 'event') { ?>
                <div class="col-md-6 center new_news mb-3 ms-0 pb-2">
                    <div class="row card_news">
                        <a class="img-thumbnail" href="?request=news_detail&news_id=<?php echo $news['news_id'] ?>&type=<?= $news['type'] ?>">
                            <div class="d-lg-flex d-lg-block mt-2">
                                <div class="col-md-12 col-lg-5 col-12 img_news">
                                    <img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?>" title="<?php echo $news['title'] ?>">
                                </div>
                                <div class="col-lg-7 col-md-12 col-12 ms-1">
                                    <p><b><?php echo mb_substr($news['title'], 0, 100) . '...'  ?></b></p>
                                </div>
                            </div>
                            <p><?php echo mb_substr($news['content'], 0, 70) . ' ...' ?></p>
                            <i><b>Ngày đăng: </b><?php echo $news['created_at'] ?></i>
                            <i class="float-end">Sự kiện</i>
                        </a>
                    </div>
                </div>
            <?php  }
        } else { ?>
            <div class="col-md-6 center new_news mb-3 ms-0 pb-2">
                <div class="row card_news">
                    <a class="img-thumbnail" href="?request=news_detail&news_id=<?php echo $news['news_id'] ?>&type=<?= $news['type'] ?>">
                        <div class="d-lg-flex d-lg-block mt-2">
                            <div class="col-md-12 col-lg-5 col-12 img_news">
                                <img class="img-thumbnail" src="./public/uploads/imageNews/<?php echo $news['image'] ?>" alt="<?php echo $news['title'] ?>" title="<?php echo $news['title'] ?>">
                            </div>
                            <div class="col-lg-7 col-md-12 col-12 ms-1">
                                <p><b><?php echo mb_substr($news['title'], 0, 100) . '...'  ?></b></p>
                            </div>
                        </div>
                        <p><?php echo mb_substr($news['content'], 0, 70) . ' ...' ?></p>
                        <i><b>Ngày đăng: </b><?php echo $news['created_at'] ?></i>
                        <i class="float-end">
                            <?php
                            if ($news['type'] == 'news') {
                                echo "Tin tức";
                            } else {
                                echo "Sự kiện";
                            }
                            ?>
                        </i>
                    </a>
                </div>
            </div>
    <?php }
    }
    ?>
</div>
<!-- Phân trang -->
<div class="container">
    <form method="post">
        <ul class="pagination justify-content-center">
            <?php
            if ($pageNews > 1) { ?>
                <li class="page-item">
                    <a href="?request=news&page=<?= $pageNews - 1 ?>" class="page-link"><i class='bx bxs-left-arrow'></i></a>
                </li>
            <?php }
            for ($i = 1; $i <= $totalPageNews; $i++) { ?>
                <li class="page-item">
                    <a href="?request=news&page=<?= $i ?>" class="page-link <?= $i == $pageNews ? 'active_page' : '' ?>"><?= $i ?></a>
                </li>
            <?php }
            if ($pageNews < $totalPageNews) { ?>
                <li class="page-item">
                    <a href="?request=news&page=<?= $pageNews + 1 ?>" class="page-link"><i class='bx bxs-right-arrow'></i></a>
                </li>
            <?php }
            ?>
        </ul>
    </form>
</div>
<p class="text-center">----------Hết----------</p>