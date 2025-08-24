<!-- Navbar -->
<?php
$request = isset($_GET['request']) ? $_GET['request'] : 'home';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/controllers/C_User.php';
?>
<nav class="navbar navbar-expand-lg navbar-dark" id="sticky">
    <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="col-md-12 col-lg-9 ms-2">
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
                <li class="nav-item">
                    <a class="nav-link <?php echo $request == 'news' || $request == 'news_detail' ? 'active' : '' ?>" href="?request=news"><i class='bx bx-news'></i>Tin tức - <i class='bx bx-calendar-event'></i>Sự kiện</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $request == 'gallery' ? 'active' : '' ?>" href="?request=gallery"><i class='bx bx-image'></i>Ảnh - <i class='bx bxs-videos'></i>Video</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $request == 'exhibition' || $request == 'exhibition_detail' ? 'active' : '' ?>" href="?request=exhibition"><i class='bx bx-building'></i>Triển lãm</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $request == 'notification' ? 'active' : '' ?>" href="?request=notification"><i class='bx bxs-bell-ring'></i>Thông báo</a>
                </li>
                <?php
                if (isset($_SESSION['users']) && ($_SESSION['users']['role'] >= 1)) { ?>
                    <li class="nav-item text-white">
                        <div class="dropdown d-none d-lg-block">
                            <button type="button" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bx bx-cog"></i>Quản trị hệ thống</button>
                            <?php
                            foreach ($permissions as $per_adition) {
                                if ($per_adition['user_id'] == $_SESSION['users']['user_id']) { ?>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu">
                                            <a class="dropdown-item dropdown-toggle" href="#" onmouseover="toggleSubmenu()"><i class='bx bx-book-content'></i></i>Quản lý nội dung</a>
                                            <ul class="dropdown-menu">
                                                <?php
                                                if (($per_adition['mana_introduction'] == 1)) { ?>
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'manage_introduction' ? 'active' : ''; ?>" href="?request=manage_introduction"><i class='bx bx-book-content'></i>Quản lý giới thiệu Bảo tàng</a></li>
                                                <?php }
                                                if (($per_adition['mana_artifact'] == 1)) { ?>
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'manage_artifact' ? 'active' : ''; ?>" href="?request=manage_artifact"><i class="bx bx-package"></i>Quản lý hiện vật</a></li>
                                                <?php }
                                                if (($per_adition['mana_news'] == 1)) { ?>
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'manage_news' ? 'active' : ''; ?>" href="?request=manage_news"><i class="bx bx-calendar"></i>Quản lý hình tin tức - sự kiện</a></li>
                                                <?php }
                                                if (($per_adition['mana_exhibition'] == 1)) { ?>
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'manage_exhibition' ? 'active' : ''; ?>" href="?request=manage_exhibition"><i class='bx bxs-palette'></i>Quản lý triển lãm</a></li>
                                                <?php }
                                                if (($per_adition['mana_comment'] == 1)) { ?>
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'manage_comment_feedback' ? 'active' : ''; ?>" href="?request=manage_comment_feedback"><i class='bx bxs-comment-detail'></i>Quản lý bình luận và phản hồi</a></li>
                                                <?php }
                                                ?>
                                            </ul>
                                        </li>
                                        <?php
                                        if (($per_adition['mana_user'] == 1)) { ?>
                                            <li>
                                                <a class="dropdown-item" id="<?php echo $request == 'manage_user' ? 'active' : ''; ?>" href="?request=manage_user"><i class="bx bx-user"></i>Quản lý người dùng</a>
                                            </li>
                                        <?php }
                                        ?>
                                        <?php
                                        if ($_SESSION['users']['role'] == 2) { ?>
                                            <!-- Dropdown lồng nhau: Quản lý bảo mật -->
                                            <li class="dropdown-submenu">
                                                <a class="dropdown-item dropdown-toggle" onmouseover="toggleSubmenu()" href="#"><i class="bx bx-shield"></i>Quản lý bảo mật</a>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'secu_user' ? 'active' : ''; ?>" href="?request=secu_user"><i class="bx bx-user-check"></i>Bảo mật người dùng</a></li>
                                                    <li><a class="dropdown-item" id="<?php echo $request == 'other_secu' ? 'active' : ''; ?>" href="?request=other_secu"><i class="bx bx-lock"></i>Bảo mật hệ thống</a></li>
                                                </ul>
                                            </li>
                                        <?php   }
                                        ?>
                                    </ul>

                            <?php }
                            }
                            ?>
                        </div>
                    </li>
                <?php }
                ?>

            </ul>
        </div>
        <!-- Tìm kiếm -->
        <div class="col-md-12 col-lg-3">
            <form class="d-flex m-1 search" method="post">
                <input type="search" name="key_word" class="" value="<?php echo isset($_POST['key_word']) ? $_POST['key_word'] : '' ?>" placeholder="Tìm kiếm...">
                <button type="submit" class="btn border-0 text-white"><i class='bx bx-search-alt-2'></i></button>
                <div class="col-md-4 mt-3 filter-container">
                    <div class="text-white filter-icon">
                        <i class='bx bx-filter-alt'></i>
                    </div>
                    <select name="filter" id="filter" class="filter">
                        <div class="text-white text-center border-0">
                            <option value="">--Lọc--</option>
                            <?php
                            if ($request == 'artifact' || $request == 'manage_artifact') { ?>
                                <option class="select-item" value="costume" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'costume' ? 'selected' : '' ?>>Trang phục</option>
                                <option class="select_item" value="weapon" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'weapon' ? 'selected' : '' ?>>Vũ khí</option>
                                <option class="select-item" value="document" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'document' ? 'selected' : '' ?>>Tài liệu</option>
                                <option class="select-item" value="picture" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'picture' ? 'selected' : '' ?>>Tranh ảnh</option>
                                <option class="select-item" value="equiment" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'equiment' ? 'selected' : '' ?>>Dụng cụ</option>
                                <option class="select-item" value="models" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'models' ? 'selected' : '' ?>>Mô hình</option>
                            <?php } else if ($request == 'gallery' || $request == 'manage_gallery' || $request == 'manage_exhibition' || $request == 'exhibition') { ?>
                                <option class="select-item" value="image" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'image' ? 'selected' : '' ?>>Ảnh</option>
                                <option class="select-item" value="video" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'video' ? 'selected' : '' ?>>Video</option>
                            <?php   } else if ($request == 'manage_user') { ?>
                                <option class="select-item" value="visitor" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'visitor' ? 'selected' : '' ?>>Khách hàng</option>
                                <option class="select-item" value="staff" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'staff' ? 'selected' : '' ?>>Nhân viên</option>
                                <option class="select-item" value="admin" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                            <?php } elseif ($request == 'manage_news' || $request == 'news') { ?>
                                <option class="select-item" value="news" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'news' ? 'selected' : '' ?>>Tin tức</option>
                                <option class="select-item" value="event" <?php echo isset($_POST['filter']) && $_POST['filter'] == 'event' ? 'selected' : '' ?>>Sự kiện</option>
                            <?php }
                            ?>
                        </div>
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="d-block d-lg-none text-white ms-2 pt-2">
        <ul class="navbar-nav">
            <?php
            switch ($request) {
                case 'home': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'home' ? 'active' : '' ?>" href="?request=home"><i class='bx bxs-home'></i>Trang chủ</a>
                    </li>
                <?php break;
                case 'introduction': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'introduction' ? 'active' : '' ?>" href="?request=introduction"><i class='bx bxs-info-circle'></i>Giới thiệu</a>
                    </li>
                <?php break;
                case 'artifact': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'artifact' ? 'active' : '' ?>" href="?request=artifact"><i class='bx bx-box'></i>Hiện vật</a>
                    </li>
                <?php break;
                case 'news': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'news' || $request == 'news_detail' ? 'active' : '' ?>" href="?request=news"><i class='bx bx-news'></i>Tin tức - <i class='bx bx-calendar-event'></i>Sự kiện</a>
                    </li>
                <?php break;
                case 'gallery': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'gallery' ? 'active' : '' ?>" href="?request=gallery"><i class='bx bx-image'></i>Ảnh - <i class='bx bxs-videos'></i>Video</a>
                    </li>
                <?php break;
                case 'exhibition': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'exhibition' || $request == 'exhibition_detail' ? 'active' : '' ?>" href="?request=exhibition"><i class='bx bx-building'></i>Triển lãm</a>
                    </li>
                <?php break;
                case 'news_detail': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'news' || $request == 'news_detail' ? 'active' : '' ?>" href="?request=news"><i class='bx bx-news'></i>Tin tức - <i class='bx bx-calendar-event'></i>Sự kiện</a>
                    </li>
                <?php break;
                case 'exhibition_detail': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'exhibition' || $request == 'exhibition_detail' ? 'active' : '' ?>" href="?request=exhibition"><i class='bx bx-building'></i>Triển lãm</a>
                    </li>
                <?php break;
                case 'notification': ?>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $request == 'notification' ? 'active' : '' ?>" href="?request=notification"><i class='bx bxs-bell-ring'></i>Thông báo</a>
                    </li>
            <?php  }
            ?>
        </ul>
    </div>
    <ul class="navbar-nav me-4 profile">
        <?php
        if (!isset($_SESSION['users'])) { ?>
            <li class="nav-item position">
                <button onclick="login()" id="dropdownButton">
                    <i class="bx bx-user"></i>
                </button>
            </li>
        <?php } else { ?>
            <li class="nav-item position">
                <button onclick="login()" id="dropdownButton">
                    <i class="bx bx-user"></i>
                </button>
            </li>
        <?php }
        ?>
    </ul>
    <div class="row" id="menu_login">
        <?php
        if (isset($_SESSION['users'])) { ?>
            <div class="col-12 w-100" id="profile">
                <h5 class="text-center">Thông tin cá nhân</h5>
                <p>Họ và tên: <?= $_SESSION['users']['fullname'] ?></p>
                <p>Username: <?= $_SESSION['users']['username'] ?></p>
                <p>Sđt: <?= $_SESSION['users']['phone'] ?></p>
                <p>Email: <?= $_SESSION['users']['email'] ?></p>
                <p>ĐC: <?= $_SESSION['users']['address'] ?></p>
            </div>
            <div class="col-12">
                <ul class="navbar-nav">
                    <li class="nav-item logout">
                        <a class="nav-link" href="./public/logout.php" id="dropdownButton">
                            <i class='bx bx-log-out'></i>Đăng xuất
                        </a>
                    </li>
                </ul>
            </div>

        <?php } else { ?>
            <div class="col-md-12 d-flex justify-content-between">
                <a class="btn_menu_login" href="./app/views/login/login.php"><i class='bx bx-log-in'></i>Đăng nhập</a>
                <a class="btn_menu_register" href="./app/views/register/register.php"><i class='bx bx-registered'></i>Đăng ký</a>
            </div>
            <form action="./app/controllers/C_User.php" class="btn_menu_gg d-flex justify-content-center" method="post">
                <button type="submit" name="facebookLogin" class="text-center"><i class='bx bxl-google'></i>Đăng nhập với Google</button>
            </form>
        <?php }
        ?>
    </div>
</nav>