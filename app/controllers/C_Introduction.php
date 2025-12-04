<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Chỉ bắt đầu session nếu chưa có session nào
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_Introduction.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_Introductiion
{
    private $introModel;
    public $errors = array();

    // Hàm khởi tạo
    public function __construct()
    {
        $this->introModel = new M_Introduction();
    }

    // Hàm thêm giới thiệu cho bảo tàng
    public function uploadIntroduction()
    {
        // Kiểm tra nếu tệp ảnh đã được chọn
        if (isset($_FILES['introduction_file']) && $_FILES['introduction_file']['error'] === UPLOAD_ERR_OK) {
            // Lấy thông tin ảnh
            $image = $_FILES['introduction_file']['name'];
            $tmpPath = $_FILES['introduction_file']['tmp_name'];

            // Thư mục lưu ảnh
            $targetDir = __DIR__ . "/../../public/imageIntroduction/";
            $targetFile = $targetDir . basename($image);

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            // Di chuyển ảnh vào thư mục 
            if (move_uploaded_file($tmpPath, $targetFile)) {
                // Lấy thông tin từ các trường upload
                $title = isset($_POST['introduction_name']) ? $_POST['introduction_name'] : '';   // Tiêu đề
                $content = isset($_POST['introduction_description']) ? $_POST['introduction_description'] : ''; //Mô tả
                $category = isset($_POST['introduction_type']) ? $_POST['introduction_type'] : ''; // Loại giới thiệu

                // Kiểm tra lỗi
                if (empty($title)) {
                    $this->errors['title'] = 'Nhập tiêu đề!';
                }
                if (empty($content)) {
                    $this->errors['content'] = 'Nhập nội dung giới thiệu!';
                }
                if (empty($category)) {
                    $this->errors['category'] = 'Chọn danh mục giới thiệu';
                }

                // Không có lỗi gì thì insert vào CSDL
                if (empty($this->errors)) {
                    // Kiểm tra xem loại giới thiệu đã tồn tại hay chưa
                    $getType = $this->introModel->viewIntroduction();
                    if ($getType) {
                        // Xóa trường giới thiệu cũ trước khi insert mới vào
                        foreach ($getType as $type) {
                            if ($type['category'] == $category) {
                                $deleteIntro = $this->introModel->deleteIntroduction($category);
                            }
                        }
                    }
                    // Gọi hàm insert
                    $insertIntro = $this->introModel->uploadIntroduction($title, $content, $category, $image);
                    if ($insertIntro) {
                        echo '<script language="javascript">alert("Thêm thành công!");</script>';
                    }
                }
            } else {
                $this->errors['image'] = 'Không di chuyển đc file!';
            }
        } else {
            $this->errors['image'] = 'Chưa chọn ảnh hoặc ảnh bị lỗi!';
        }
        return $this->errors;
    }

    // Hàm cập nhật nội dung giới thiệu
    public function updateIntroduction()
    {
        // Kiểm tra nếu tệp ảnh đã được chọn
        if (isset($_FILES['introduction_file']) && $_FILES['introduction_file']['error'] === UPLOAD_ERR_OK) {
            // Lấy thông tin ảnh
            $image = $_FILES['introduction_file']['name'];
            $tmpPath = $_FILES['introduction_file']['tmp_name'];

            // Thư mục lưu ảnh
            $targetDir = __DIR__ . "/../../public/imageIntroduction/";
            $targetFile = $targetDir . basename($image);

            // Tạo thư mục nếu chưa tồn tại
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            // Di chuyển ảnh vào thư mục 
            if (move_uploaded_file($tmpPath, $targetFile)) {
                // Lấy thông tin từ các trường upload
                $title = isset($_POST['introduction_name']) ? $_POST['introduction_name'] : '';   // Tiêu đề
                $content = isset($_POST['introduction_description']) ? $_POST['introduction_description'] : ''; //Mô tả
                $category = isset($_POST['introduction_type']) ? $_POST['introduction_type'] : ''; // Loại giới thiệu

                // Kiểm tra lỗi
                if (empty($title)) {
                    $this->errors['title'] = 'Nhập tiêu đề!';
                }
                if (empty($content)) {
                    $this->errors['content'] = 'Nhập nội dung giới thiệu!';
                }
                if (empty($category)) {
                    $this->errors['category'] = 'Chọn danh mục giới thiệu';
                }

                // Không có lỗi gì thì insert vào CSDL
                if (empty($this->errors)) {
                    // Gọi hàm update để update vào bảng
                    $updateIntro = $this->introModel->updateIntroduction($title, $content, $category, $image);
                    if ($updateIntro) {
                        echo '<script language="javascript">alert("Cập nhập thành công!");</script>';
                    }
                }
            } else {
                $this->errors['image'] = 'Không di chuyển đc file!';
            }
        } else {
            $this->errors['image'] = 'Chưa chọn ảnh hoặc ảnh bị lỗi!';
        }
        return $this->errors;
    }

    // Hàm xóa nội dung giới thiệu
    public function deleteIntroduction()
    {
        // Lấy id của bảo thogn tin để xóa
        $category = isset($_POST['category']) ? $_POST['category'] : '';

        // Gọi phương thức xóa 
        $deleteIntro = $this->introModel->deleteIntroduction($category);
        if ($deleteIntro) {
            echo '<script language="javascript">alert("Xóa giới thiệu thành công!");</script>';
        }
    }

    // Hàm hiện thị nội dung giới thiệu
    public function viewIntroduction()
    {
        return $this->introModel->viewIntroduction();
    }
}
