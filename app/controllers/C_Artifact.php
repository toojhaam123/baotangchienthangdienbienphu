<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_Artifact.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_Artifact
{
    private $artifactModel;
    private $errors = array();

    // Hàm khởi Tạo
    public function __construct()
    {
        $this->artifactModel = new M_Artifact();
    }

    // Hàm thêm hiện vật
    public function createArtifact()
    {
        // Kiểm tra file ảnh đã được tải lên chưa
        if (isset($_FILES['artifact_img']) && $_FILES['artifact_img']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['artifact_img']['name'];
            $tmpPath = $_FILES['artifact_img']['tmp_name'];
            $targetDir = __DIR__ . "/../../public/uploads/imageArtifact/";
            $targetFile = $targetDir . basename($image);

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (!move_uploaded_file($tmpPath, $targetFile)) {
                $this->errors['image'] = "Không di chuyển được ảnh";
            }
        } else {
            // Báo lỗi
            $this->errors['image'] = "Vui lòng chọn ảnh";
        }

        // Kiểm tra file audio đã được tải lên chưa
        if (isset($_FILES['artifact_audio']) && $_FILES['artifact_audio']['error'] == UPLOAD_ERR_OK) {
            $audio = $_FILES['artifact_audio']['name'];
            $tmpAudio = $_FILES['artifact_audio']['tmp_name'];
            $audioDir = __DIR__ . "/../../public/uploads/audioArtifact/";
            $audioTargetFile = $audioDir . basename($audio);

            if (!file_exists($audioDir)) {
                mkdir($audioDir, 0777, true);
            }

            // Di chuyển audio vào thư mục
            if (!move_uploaded_file($tmpAudio, $audioTargetFile)) {
                $this->errors['audio'] = "Không di chuyển được audio";
            }
        } else {
            // Báo lỗi
            $this->errors['audio'] = "Vui lòng chọn âm thanh";
        }

        // Lấy thông tin từ các trường nhập
        $name = isset($_POST['artifact_name']) ? $_POST['artifact_name'] : '';
        $description = isset($_POST['artifact_description']) ? $_POST['artifact_description'] : '';
        $type = isset($_POST['artifact_type']) ? $_POST['artifact_type'] : '';

        // Kiểm tra tính hợp lệ
        if (empty($name)) {
            $this->errors['name'] = 'Nhập tên hiện vật!';
        }
        if (empty($description)) {
            $this->errors['description'] = "Nhập mô tả hiện vật!";
        }
        if (empty($type)) {
            $this->errors['type'] = "Lựa chọn danh mục hiện vật!";
        }

        // Nếu ko có lỗi gì thì isert vào CSDL
        if (empty($this->errors)) {
            // Gọi hàm thêm hiện vào cơ sở dữ liệu
            $insertArtifact = $this->artifactModel->createArtifact($name, $description, $type, $image, $audio);
            if ($insertArtifact) {
                echo '<script language="javascript">alert("Thêm hiện vật thành công!");</script>';
            }
        }
        return $this->errors;
    }

    // Hàm sửa thông tin hiện vật
    public function updateArtifact()
    {
        // Lấy thông tin khác từ form
        $artifactId = isset($_POST['artifact_id']) ? $_POST['artifact_id'] : '';
        $name = isset($_POST['artifact_name']) ? $_POST['artifact_name'] : '';
        $description = isset($_POST['artifact_description']) ? $_POST['artifact_description'] : '';
        $type = isset($_POST['artifact_type']) ? $_POST['artifact_type'] : '';

        // Kiểm tra file ảnh đã được tải lên chưa
        if (isset($_FILES['artifact_img']) && $_FILES['artifact_img']['error'] == UPLOAD_ERR_OK) {
            $image = $_FILES['artifact_img']['name'];
            $tmpPath = $_FILES['artifact_img']['tmp_name'];
            $targetDir = __DIR__ . "/../../public/uploads/imageArtifact/";
            $targetFile = $targetDir . basename($image);

            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (!move_uploaded_file($tmpPath, $targetFile)) {
                $this->errors['image'] = "Không di chuyển được ảnh";
            }
        } else {
            // Nếu không upload ảnh mới thì giữ ảnh cũ
            $image = isset($_POST['old_image']) ? $_POST['old_image'] : '';
        }

        // Kiểm tra file audio đã được tải lên chưa
        if (isset($_FILES['artifact_audio']) && $_FILES['artifact_audio']['error'] == UPLOAD_ERR_OK) {
            $audio = $_FILES['artifact_audio']['name'];
            $tmpAudio = $_FILES['artifact_audio']['tmp_name'];
            $audioDir = __DIR__ . "/../../public/uploads/audioArtifact/";
            $audioTargetFile = $audioDir . basename($audio);

            if (!file_exists($audioDir)) {
                mkdir($audioDir, 0777, true);
            }

            // Di chuyển audio vào thư mục
            if (!move_uploaded_file($tmpAudio, $audioTargetFile)) {
                $this->errors['audio'] = "Không di chuyển được audio";
            }
        } else {
            if (isset($_FILES['artifact_audio']) && $_FILES['artifact_audio']['error'] == UPLOAD_ERR_OK) {
                // Như cũ
                $audio = $_FILES['artifact_audio']['name'];
                $tmpAudio = $_FILES['artifact_audio']['tmp_name'];
                $audioDir = __DIR__ . "/../../public/uploads/audioArtifact/";
                $audioTargetFile = $audioDir . basename($audio);

                if (!file_exists($audioDir)) {
                    mkdir($audioDir, 0777, true);
                }

                if (!move_uploaded_file($tmpAudio, $audioTargetFile)) {
                    $this->errors['audio'] = "Không di chuyển được audio";
                }
            } else {
                $audio = isset($_POST['old_audio']) ? $_POST['old_audio'] : '';
            }
        }

        // Kiểm tra tính hợp lệ
        if (empty($name)) {
            $this->errors['name'] = 'Nhập tên hiện vật!';
        }
        if (empty($description)) {
            $this->errors['description'] = "Nhập mô tả hiện vật!";
        }
        if (empty($type)) {
            $this->errors['type'] = "Lựa chọn danh mục hiện vật!";
        }

        // Nếu không có lỗi
        if (empty($this->errors)) {
            // Gọi hàm cập nhật thông tin vào csdl (có thêm $audio)
            $updateArtifact = $this->artifactModel->updateArtifact($name, $description, $type, $image, $audio, $artifactId);
            if ($updateArtifact) {
                echo '<script language="javascript">alert("Chỉnh sửa hiện vật thành công!");</script>';
            }
        }

        return $this->errors;
    }

    // Hàm xóa hiện vật
    public function deleteArtifact()
    {
        // Lấy id để xóa theo id
        $id = isset($_POST['artifact_id']) ? $_POST['artifact_id'] : '';

        // Gọi hàm xóa theo id
        $deleteArtifact = $this->artifactModel->deleteArtifact($id);
        // echo var_dump($deleteArtifact);
        // exit;
        if ($deleteArtifact) {
            echo '<script language="javascript">alert("Đã xóa hiện vật thành công!");</script>';
        }
    }

    // Hàm hiện thị tất cả hiện vật
    public function viewAllArtifact()
    {
        //Mảng trả về
        $artifact_TotalPage = array();
        // Lấy phân trang 
        $limit = 12;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;
        $start = ($page - 1) * $limit;
        // Lấy từ khóa tìm kiếm và từ khóa lọc từ thanh tìm kiếm để tìm kiếm
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';


        // lấy tổng số hiện vậ trong CSDL 
        $total = $this->artifactModel->totalArtifact();
        if (!empty($keyWord) || !empty($filter)) {
            $start = 0;
            $limit = $total;
        }

        $totalPage = ceil($total / $limit);
        $getAllArtifacts = $this->artifactModel->viewAllArtifact($keyWord, $filter, $start, $limit);
        // Gắn các giá trị trả về vào mảng
        $artifact_TotalPage[] = $page;
        $artifact_TotalPage[] = $totalPage;
        $artifact_TotalPage[] = $getAllArtifacts;

        return $artifact_TotalPage;
    }

    // Hàm lấy ra các hiện vật mới nhất để hiện thị trang home 
    public function viewNewArtifact()
    {
        return $this->artifactModel->viewNewArtifact();
    }
}
