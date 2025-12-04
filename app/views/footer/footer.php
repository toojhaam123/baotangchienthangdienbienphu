<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_Comment.php';
?>
<div class="border-danger">
    <div class="row text-white pt-3 border-bottom">
        <div class="col-md-2">
            <div class="logo text-center">
                <a class="nav-link" href="?request=home"><img src="./image/Logo bảo tàng.png" alt="Logo Bảo tàng chiến tháng Điện Biên Phủ"></a>
            </div>
        </div>
        <div class="col-md-3">
            <h5 class="text-center">Thông tin liên hệ</h5>
            <ul class="list-unstyled">
                <li><i class='bx bx-location-plus'></i>Địa chỉ: Tổ 1, Phường Mường Thanh, Điện Biên Phủ, Việt Nam</li>
                <li><i class='bx bx-phone-call'></i>Điện thoại: 0215 3831 345</li>
                <div class="feedback mt-2">
                    <button type="button"
                        data-bs-toggle="modal" data-bs-target="#feedback">
                        <i class='bx bxs-comment-add'></i>Phản hồi
                    </button>
                </div>
            </ul>
        </div>
        <div class="col-md-4">
            <h5 class="text-center">Liên kết quan trọng</h5>
            <div class="row mb-2">
                <div class="col-md-6">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $request == 'home' ? 'active' : '' ?>" href="?request=home"><i class='bx bxs-home'></i>Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $request == 'introduction' ? 'active' : '' ?>" href="?request=introduction"><i class='bx bxs-info-circle'></i>Giới thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $request == 'artifact' ? 'active' : '' ?>" href="?request=artifact"><i class='bx bx-box'></i>Hiện vật</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php echo $request == 'news' ? 'active' : '' ?>" href="?request=news"><i class='bx bx-news'></i>Tin tức - <i class='bx bx-calendar-event'></i>Sự kiện</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $request == 'gallery' ? 'active' : '' ?>" href="?request=gallery"><i class='bx bx-image'></i>Ảnh - <i class='bx bxs-videos'></i>Video</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo $request == 'exhibition' ? 'active' : '' ?>" href="?request=exhibition"><i class='bx bx-building'></i>Triển lãm</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <h5 class="text-center">Thông tin pháp lý</h5>
            <ul class="list-unstyled legal-infor">
                <li><a class="nav-link" href="./app/views/Privacy_Policy/Privacy_Policy.php" target="_blank"><i class="bx bx-lock"></i>Chính sách bảo mật</a></li>
                <li><a class="nav-link" href="./app/views/Terms_of_Use/Terms_of_Use.php" target="_blank"><i class="bx bx-file"></i>Điều khoản sử dụng</a></li>
            </ul>
        </div>
    </div>
    <div class="row pt-1">
        <?php $year = date('Y') ?>
        <p class="text-center text-white">Copyright: Bản quyền thuộc về Bảo tàng Chiến thắng Điện Biên Phủ (1994 - <?php echo $year ?>)</p>
    </div>
</div>
<div class="modal fade" id="feedback">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Phản hồi</h5>
                <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="feedback_comment">Nhận nội dung phản hồi</label>
                        <textarea class="form-control" name="comment" id="feedback_comment" rows="2" placeholder="Nội dung phản hồi của bạn..."><?php echo isset($errors['cmt']) ? $errors['cmt'] : '' ?></textarea>
                    </div>
                    <?php
                    if (!isset($_SESSION['users'])) { ?>
                        <label class="form-label" for="fullname">Họ và tên</label>
                        <span>* <?= isset($errors['name']) ? $errors['name'] : '' ?></span>
                        <input class="form-control" type="text" value="<?= isset($_POST['name']) ? $_POST['name'] : '' ?>" name="commenter">
                    <?php }
                    ?>
                    <button class="mt-2" type="submit" name="post_cmt">Gửi phản hồi</button>
                </form>
            </div>
        </div>
    </div>
</div>