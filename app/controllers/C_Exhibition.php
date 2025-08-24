<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_Exhibition.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_Exhibition
{
    private $exhibitionModel;
    private $errors = array();

    // Hàm khởi tạo
    public function __construct()
    {
        $this->exhibitionModel = new M_Gallery();
    }

    // Hàm thêm triển lãm 
    public function uploadExhibition()
    {
        // Lấy thông tin triển lãm từ các trường nhập
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';

        // Kiểm tra lỗi trống trường nhập
        if (empty($type)) {
            $this->errors['type'] = 'Chọn loại danh mục!';
        }
        // Kiểm tra lỗi trống trường nhập
        if (empty($title)) {
            $this->errors['title'] = "Điền tiêu đề!";
        }
        if (empty($description)) {
            $this->errors['description'] = "Điền nội dung!";
        }

        // Kiểm tra triển lãm đã được chọn hay chưa
        if (empty($this->errors) && isset($_FILES['exhibition_file'])) {
            // Lấy thông tin tệp
            $totalFile = count($_FILES['exhibition_file']['name']); // lấy phần tên của file 

            // Tạo group_id để nhóm các ảnh thuộc triển lãm
            $group_id = uniqid('group_');

            for ($i = 0; $i < $totalFile; $i++) {
                if ($_FILES['exhibition_file']['error'] == UPLOAD_ERR_OK) {
                    continue;
                }

                $file = $_FILES['exhibition_file']['name'][$i];
                $tmpPath = $_FILES['exhibition_file']['tmp_name'][$i]; // Lấy đường dã tạm thời của file


                // kiểm nếu thư mục chưa tồn tại thì tạo mới
                if ($type == 'image') {
                    $imagDir = __DIR__ . '/../../public/imageExhibition/';
                    $filePath = $imagDir . basename($file);

                    // Kiểm tra thư mục tồn tại hay chưa
                    if (!file_exists($imagDir)) {
                        mkdir($imagDir, 0777, true);
                    }
                }
                if ($type == 'video') {
                    $videoDir = __DIR__ . '/../../public/videoExhibition/';
                    $filePath = $videoDir . basename($file);

                    // kiểm tra thư mục đã tồn tại hay chưa
                    if (!file_exists($videoDir)) {
                        mkdir($videoDir, 0777, true);
                    }
                }

                // Di chuyển file 
                if (move_uploaded_file($tmpPath, $filePath)) {
                    // các trường nhập vào cơ sở dữ liệu
                    $insertExhibition = $this->exhibitionModel->uploadExhibition($title, $description, $type, $file, $group_id);
                } else {
                    $this->errors['file'] = "Không di chuyển được file";
                }
            }
            if ($insertExhibition) {
                echo '<script language="javascript">alert("Thêm hình triển lãm thành công!");</script>';
            }
        } else {
            $this->errors['file'] = 'Chưa chọn tệp hoặc tệp bị lỗi hoặc chưa chọn danh mục';
        }
        return $this->errors;
    }

    // Hàm sửa thông tin triển lãmlãm
    public function updateExhibition()
    {
        // Lấy thông tin triển lãm từ các trường nhập
        $groupId = isset($_POST['group_id']) ? $_POST['group_id'] : '';
        $title = isset($_POST['title']) ? $_POST['title'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $type = isset($_POST['type']) ? $_POST['type'] : '';

        // Kiểm tra lỗi trống trường nhập
        if (empty($title)) {
            $this->errors['title'] = "Điền tiêu đề!";
        }
        if (empty($description)) {
            $this->errors['description'] = "Điền nội dung!";
        }
        if (empty($type)) {
            $this->errors['type'] = 'Chọn loại danh mục!';
        }

        // Kiểm tra triển lãm đã được chọn hay chưa
        if (empty($this->errors) && isset($_FILES['exhibition_file'])) {
            // Lấy thông tin tệp
            $totalFile = count($_FILES['exhibition_file']['name']); // lấy phần tên của file 

            for ($i = 0; $i < $totalFile; $i++) {
                if ($_FILES['exhibition_file']['error'] == UPLOAD_ERR_OK) {
                    continue;
                }

                $file = $_FILES['exhibition_file']['name'][$i];
                $tmpPath = $_FILES['exhibition_file']['tmp_name'][$i]; // Lấy đường dã tạm thời của file


                // kiểm nếu thư mục chưa tồn tại thì tạo mới
                if ($type == 'image') {
                    $imagDir = __DIR__ . '/../../public/imageExhibition/';
                    $filePath = $imagDir . basename($file);

                    // Kiểm tra thư mục tồn tại hay chưa
                    if (!file_exists($imagDir)) {
                        mkdir($imagDir, 0777, true);
                    }
                }
                if ($type == 'video') {
                    $videoDir = __DIR__ . '/../../public/videoExhibition/';
                    $filePath = $videoDir . basename($file);

                    // kiểm tra thư mục đã tồn tại hay chưa
                    if (!file_exists($videoDir)) {
                        mkdir($videoDir, 0777, true);
                    }
                }

                // Di chuyển file 
                if (move_uploaded_file($tmpPath, $filePath)) {
                    // các trường nhập vào cơ sở dữ liệu
                    $updateExhibition = $this->exhibitionModel->updateExhibition($title, $description, $type, $file, $groupId);
                } else {
                    $this->errors['file'] = "Không di chuyển được file";
                }
            }
            if ($updateExhibition) {
                echo '<script language="javascript">alert("Cập nhập triển lãm thành công!");</script>';
            }
        } else {
            $this->errors['file'] = 'Chưa chọn tệp hoặc tệp bị lỗi hoặc chưa chọn danh mục';
        }
        return $this->errors;
    }

    // Hàm xóa triển lãm 
    public function deleteExhibition()
    {
        // lấy id để xóa theo id 
        $groupId = isset($_POST['group_id']) ? $_POST['group_id'] : '';

        // gọi hàm xóa theo id 
        $deleteExhibition = $this->exhibitionModel->deleteExhibition($groupId);

        if ($deleteExhibition) {
            echo '<script language="javascript">alert("Đã xóa một ảnh triển lãm!");</script>';
        }
    }

    // Hàm hiện thị tất cả triển lãm
    public function viewAllExhibition()
    {
        // Mảng trả về 
        $exhibition_TotalPag = array();

        $limit = 12;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $start = ($page - 1) * $limit;
        // Lấy từ khóa tìm kiếm và lọc
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

        // Tổng số ảnh trong cơ sở dữ liệu 
        $total = $this->exhibitionModel->tatolGallery();

        if (!empty($keyWord) || !empty($filter)) {
            $start = 0;
            $limit = $total;
        }

        $totalPage = ceil($total / $limit);
        $getExhibition =  $this->exhibitionModel->viewAllExhibition($keyWord, $filter, $start, $limit);

        $exhibition_TotalPag[] = $page;
        $exhibition_TotalPag[] = $totalPage;
        $exhibition_TotalPag[] = $getExhibition;

        return $exhibition_TotalPag;
    }

    // Hàm Lấy chi tiết triển lãm bằng Id 
    public function detailExhibition()
    {
        // hiện thị chi tiết thoeo nhóm Id
        $groupId = isset($_GET['group_id']) ? $_GET['group_id'] : '';
        return $this->exhibitionModel->detailExhibition($groupId);
    }

    // Hàm lấy tất cả các ảnh triển lãm hiện thị trên thư viện
    public function viewImageExhibition()
    {
        // Mảng trả về 
        $exhibition_TotalPag = array();

        $limit = 8;
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $start = ($page - 1) * $limit;
        // Lấy từ khóa tìm kiếm và lọc
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

        // Tổng số ảnh trong cơ sở dữ liệu 
        $total = $this->exhibitionModel->tatolGallery();

        if (!empty($keyWord) || !empty($filter)) {
            $start = 0;
            $limit = $total;
        }

        $totalPage = ceil($total / $limit);
        $viewImageExhibition = $this->exhibitionModel->viewImageExhibition($keyWord, $filter, $start, $limit);

        $exhibition_TotalPag[] = $page;
        $exhibition_TotalPag[] = $totalPage;
        $exhibition_TotalPag[] = $viewImageExhibition;

        return $exhibition_TotalPag;
    }
}
