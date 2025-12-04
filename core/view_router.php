    <div class="col-lg-8 main">
        <?php
        // Kiểm tra nếu không tồn tạo request thì gắn mặc định là home
        $request = isset($_GET['request']) ? $_GET['request'] : 'home';

        // Thực hiện điều hướng theo request
        switch ($request) {
            case 'home':
                include './app/views/home/home.php';
                break;
            case 'introduction':
                include './app/views/introduction/introduction.php';
                break;
            case 'artifact':
                include './app/views/artifact/artifact.php';
                break;
            case 'news':
                include './app/views/news/news.php';
                break;
            case 'gallery':
                include './app/views/gallery/gallery.php';
                break;
            case 'exhibition':
                include './app/views/exhibition/exhibition.php';
                break;
            case 'news_detail':
                include './app/views/news/news_detail.php';
                break;
            case 'manage_artifact':
                include "./app/views/artifact/manage_artifact.php";
                break;
            case 'manage_gallery':
                include './app/views/gallery/manage_gallery.php';
                break;
            case 'manage_news':
                include './app//views/news/manage_news.php';
                break;
            case 'manage_user':
                include './app/views/user/manage_user.php';
                break;
            case 'manage_introduction':
                include './app/views/introduction/manage_intruduction.php';
                break;
            case 'secu_user':
                include './app/views/user/secu_user.php';
                break;
            case 'manage_comment_feedback':
                include './app/views/comment_feedback/mange_comment_feedback.php';
                break;
            case 'exhibition_detail':
                include './app/views/exhibition/exhibition_detail.php';
                break;
            case 'manage_exhibition':
                include './app/views/exhibition/manage_exhibition.php';
                break;
            case 'notification':
                include './app/views/notification/notification.php';
                break;
            default:
                // nếu requesst không hợp lệ trả về trang chủ
                include './app/views/home/home.php';
                break;
        } ?>
    </div>