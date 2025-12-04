<div class="image_title">
    <img src="./image/Baotang.jpg" alt="Hình ảnh tiêu đề">
    <div class="box-intro d-lg-block d-none">
        <h2 class="text-center text-white mt-2">GIỚI THIỆU BẢO TÀNG <br> CHIẾN THẮNG ĐIỆN BIÊN PHỦ</h2>
    </div>
</div>
<div class="col-md-12 btn_tronduce text-center">
    <button class="btn border-0" id="btn_video_intro" data-bs-toggle="collapse" data-bs-target="#video_intro">
        Video intro</button>
    <div class="col-md-8" id="fake_conten"></div>
</div>
<!-- Giới thiệu -->
<?php
foreach ($introductions as $introduction) {
    if ($introduction['category'] == 'introduction') { ?>
        <div class="video_intro collapse" id="video_intro">
            <video controls autoplay muted playsinline>
                <source src="./public/uploads/imageIntroduction/<?= $introduction['image'] ?>" type="video/mp4">
            </video>
        </div>
        <div class="row introduction mt-2">
            <div class="col-md-12 text-center">
                <h4 class="text-center"><?php echo $introduction['title'] ?></h4>
            </div>
            <div class="text">
                <p><?php echo nl2br(htmlspecialchars($introduction['content'])) ?></p>
            </div>
        </div>
    <?php  }
}
// Lịch sử hình thành
foreach ($introductions as $introduction) {
    if ($introduction['category'] == 'history') { ?>
        <!-- Lịch sử hình thành -->
        <div class="row history">
            <div class="col-md-12">
                <h4 class="text-center"><?php echo $introduction['title'] ?></h4>
            </div>
            <div class="col-md-7">
                <p><?php echo $introduction['content'] ?></p>
            </div>
            <div class="col-md-5 img-intro">
                <img class="img-thumbnail" src="./public/uploads/imageIntroduction/<?php echo $introduction['image'] ?>"
                    alt="Hình ảnh phần giới thiệu lịch sử hình thành của bảo tàng"
                    title="Hình ản chiến thắng trên cứ điểm đồi A1">
            </div>
        </div>
    <?php }
}
foreach ($introductions as $introduction) {
    if ($introduction['category'] == 'mission') { ?>
        <!-- Sứ mệnh và tầm nhìn -->
        <div class="row mission mt-2">
            <div class="col-md-5"></div>
            <div class="col-md-7">
                <h4 class="text-center"><?php echo nl2br(htmlspecialchars($introduction['title'])) ?></h4>
            </div>
            <div class="col-md-5 img-intro">
                <img class="img-thumbnail" src="./public/uploads/imageIntroduction/<?php echo $introduction['image'] ?>" alt="">
            </div>
            <div class="col-md-7">
                <p><?php echo nl2br(htmlspecialchars($introduction['content'])) ?></p>
            </div>
        </div>
    <?php }
}
foreach ($introductions as $introduction) {
    if ($introduction['category'] == 'other') { ?>
        <!-- Thông tin khác -->
        <div class="row other_infor mt-2 mb-2">
            <div class="col-md-12">
                <h4 class="text-center"><?php echo $introduction['title'] ?></h4>
            </div>
            <div class="col-md-7">
                <p><?php echo nl2br(htmlspecialchars($introduction['content'])) ?></p>
            </div>
            <div class="col-md-5 img-intro">
                <img class="img-thumbnail" src="./public/uploads/imageIntroduction/<?php echo $introduction['image'] ?>" alt="">
            </div>
        </div>
<?php }
} ?>

<!-- Các khu vục trưng bày -->
<div class="row display my-2 pb-2">
    <div class="col-md-12">
        <h4 class="text-center">Khám phá khu vực trưng bày</h4>
    </div>
    <div class="col-md-7">
        <p>Bảo tàng chia thành nhiều khu vực trưng bày, mỗi khu vực mang một chủ đề riêng biệt, từ các hiện vật chiến tranh,
            hình ảnh về các chiến sĩ anh hùng, cho đến các công trình quân sự quan trọng trong trận chiến Điện Biên Phủ.
            Một trong những điểm nhấn nổi bật của bảo tàng là các mô hình chiến trường, mang lại cho du khách một cái nhìn
            trực quan về những trận đánh ác liệt trong chiến dịch Điện Biên Phủ. Bên cạnh đó, bảo tàng còn tổ chức các triển
            lãm đặc biệt về các nhân vật lịch sử,
            những cuộc họp, kế hoạch chiến đấu của các lãnh đạo quân sự, và các tài liệu quý giá về sự kiện lịch sử này.</p>
        <div class="box_btn_display text-center text-white fw-bold">
            <a href="?request=artifact" class="nav-link">KHÁM PHÁ KHU VỰC TRƯNG BÀY</a>
        </div>
    </div>
    <div class="col-md-5 img-intro">
        <img class="img-thumbnail" src="./image/Phao1nong.jpg" alt="">
    </div>
</div>
<p class="text-center">----------Hết----------</p>