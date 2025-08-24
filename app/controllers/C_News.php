<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Chỉ bắt đầu session nếu chưa có session nào
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_News.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_News
{

    private $newsModel;
    private $errors = array();

    // Hàm khởi tạo 
    public function __construct()
    {
        $this->newsModel = new M_News();
    }

    // Hàm thêm tin tức và sự kiện
    public function createNews()
    {
        // Kiểm tra file ảnh đã laod được hay chưa
        if (isset($_FILES['news_image']) && $_FILES['news_image']['error'] == UPLOAD_ERR_OK) {
            // Lấy thông tin ảnh
            $img = $_FILES['news_image']['name']; // Lấy tên của ảnh
            $tmpPath = $_FILES['news_image']['tmp_name'];  //Lấy đường dẫn tạm thời của file ảnh

            // Thư mục sẽ lưu hình ảnh
            $directory = __DIR__ . '/../../public/imageNews/';
            $file = $directory . basename($img); // Loại bỏ đường dẫn nếu có

            // tạo thư mục nếu chưa tồn tại
            if (!file_exists($directory)) {
                mkdir($directory, 0700, true);
            }

            // Di chuyển ảnh vào thư mục
            if (move_uploaded_file($tmpPath, $file)) {
                // Lấy thông tin các trường nhập
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $content = isset($_POST['content']) ? $_POST['content'] : '';
                $image_name = isset($_POST['image_name']) ? $_POST['image_name'] : '';
                $type = isset($_POST['type']) ? $_POST['type'] : '';

                // Kiểm tra lỗi trống trường nhập
                if (empty($title)) {
                    $this->errors['title'] = "Điền tiêu đề!";
                }
                if (empty($content)) {
                    $this->errors['content'] = "Điền nội dung!";
                }
                if (empty($type)) {
                    $this->errors['type'] = 'Chọn loại danh mục!';
                }

                // Nếu không có lỗi gì
                if (empty($this->errors)) {
                    // Thêm các trường nhập vào cơ sở dữ liệu
                    $insertNews = $this->newsModel->createNews($title, $image_name, $content, $img, $type);

                    if ($insertNews) {
                        echo '<script language="javascript">alert("Đã thêm tin tức - sự kiện thành công!");</script>';
                    }
                }
            } else {
                $this->errors['image'] = "Không thể di chuyển được ảnh";
            }
        } else {
            $this->errors['image'] = 'Chưa chọn ảnh hoặc ảnh bị lỗi!';
        }
        return $this->errors;
    }

    // Hàm cập nhập tin tức và sự kiện
    public function updateNews()
    {
        // Kiểm tra file ảnh đã laod được hay chưa
        if (isset($_FILES['news_image']) && $_FILES['news_image']['error'] == UPLOAD_ERR_OK) {
            // Lấy thông tin ảnh
            $img = $_FILES['news_image']['name']; // Lấy tên của ảnh
            $tmpPath = $_FILES['news_image']['tmp_name'];  //Lấy đường dẫn tạm thời của file ảnh

            // Thư mục sẽ lưu hình ảnh
            $directory = __DIR__ . '/../../public/imageNews/';
            $file = $directory . basename($img); // Loại bỏ đường dẫn nếu có

            // tạo thư mục nếu chưa tồn tại
            if (!file_exists($directory)) {
                mkdir($directory, 0700, true);
            }

            // Di chuyển ảnh vào thư mục
            if (move_uploaded_file($tmpPath, $file)) {
                // Lấy thông tin các trường nhập
                $id = isset($_POST['news_id']) ? $_POST['news_id'] : '';
                $title = isset($_POST['title']) ? $_POST['title'] : '';
                $image_name = isset($_POST['image_name']) ? $_POST['image_name'] : '';
                $content = isset($_POST['content']) ? $_POST['content'] : '';
                $type = isset($_POST['type']) ? $_POST['type'] : '';

                // Kiểm tra lỗi trống trường nhập
                if (empty($title)) {
                    $this->errors['title'] = "Điền tiêu đề!";
                }
                if (empty($content)) {
                    $this->errors['content'] = "Điền nội dung!";
                }
                if (empty($type)) {
                    $this->errors['type'] = 'Chọn loại danh mục!';
                }

                // Nếu không có lỗi gì
                if (empty($this->errors)) {
                    // Gọi hàm cập nhập thông tin
                    $updateNews = $this->newsModel->updateNews($title, $image_name, $content, $img, $type, $id);

                    if ($updateNews) {
                        echo '<script language="javascript">alert("Đã cập nhật tin tức - sự kiện thành công!");</script>';
                    }
                }
            } else {
                $this->errors['image'] = "Không thể di chuyển được ảnh";
            }
        } else {
            $this->errors['image'] = 'Chưa chọn ảnh hoặc ảnh bị lỗi!';
        }
        return $this->errors;
    }

    // Hàm xóa tin tức và sự kiện
    public function deleteNews()
    {
        // Lấy id của tin tức hoặc sự kiện để xóa theo id
        $id = isset($_POST['news_id']) ? $_POST['news_id'] : '';

        // Gọi hãm xóa tin tức - sự kiện theo id 
        $deleteNews = $this->newsModel->deleteNews($id);

        if ($deleteNews) {
            echo '<script language="javascript">alert("Đã xóa tin tức - sự kiện thành công!");</script>';
        }
    }

    // Hàm cộng thêm view cho tin tức - sự kiện
    public function addViewNews()
    {
        // lấy id của tin tưc - sự kiện
        $id = isset($_GET['news_id']) ? $_GET['news_id'] : '';
        // Gọi hàm thêm view vào csdl 
        $addViewNew = $this->newsModel->addViewNews($id);
    }
    // Hàm hiện thị tất cả tin tức và sự kiện
    public function viewAllNews()
    {
        // Mảng trả về
        $newsTotlaPage = array();
        $limit = 6;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $start = ($page - 1) * $limit;


        // Lấy từ khóa tìm kiếm và lọc từ thanh tìm kiếm
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

        // Lấy tổng số tin tức - sự kiện hiện có trong CSDL 
        $total = $this->newsModel->toltalNews();
        if (!empty($keyWord) || !empty($filter)) {
            $start = 0;
            $limit = $total;
        }

        $totalPage = ceil($total / $limit);
        $allnews =  $this->newsModel->viewAllNews($keyWord, $filter, $start, $limit);

        // gắn các giá trị trả về với mảng
        $newsTotlaPage[] = $page;
        $newsTotlaPage[] = $totalPage;
        $newsTotlaPage[] = $allnews;

        return $newsTotlaPage;
    }

    // Hàm lấy các tin tức - sự kiên view cao nhất
    public function getMaxView()
    {
        return $this->newsModel->getMaxView();
    }

    // Lấy Hiện thị tin tức chi tiết
    public function detailNews()
    {
        // lấy id của tin tức
        $newsId = isset($_GET['news_id']) ? $_GET['news_id'] : '';

        return $this->newsModel->detailNews($newsId);
    }

    // Hàm lấy tất cả hình ảnh hiện thị lên thư viện
    public function getAllImageNews()
    {
        // Mảng trả về
        $newsTotlaPage = array();
        $limit = 8;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $start = ($page - 1) * $limit;


        // Lấy từ khóa tìm kiếm và lọc từ thanh tìm kiếm
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

        // Lấy tổng số tin tức - sự kiện hiện có trong CSDL 
        $total = $this->newsModel->toltalNews();
        if (!empty($keyWord) || !empty($filter)) {
            $start = 0;
            $limit = $total;
        }

        $totalPage = ceil($total / $limit);
        $allPictureNews =  $this->newsModel->getAllImageNews($keyWord, $filter, $start, $limit);

        // gắn các giá trị trả về với mảng
        $newsTotlaPage[] = $page;
        $newsTotlaPage[] = $totalPage;
        $newsTotlaPage[] = $allPictureNews;

        return $newsTotlaPage;
    }
}
