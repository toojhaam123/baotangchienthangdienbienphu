<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_Comment.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_Comment
{
    private $cmtModel;
    private $errors = array();

    // hàm khởi tạo
    public function __construct()
    {
        $this->cmtModel = new M_Comment();
    }

    // Hàm thêm bình luận
    public function postComment()
    {
        // Lấy thông tin từ trường nhập bình luận
        if (isset($_SESSION['users'])) {
            $commenter = $_SESSION['users']['fullname'];
        } else {
            $commenter = isset($_POST['commenter']) ? $_POST['commenter'] : '';
        }

        $objectId = isset($_POST['object_id']) ? $_POST['object_id'] : '';
        $objectType = isset($_POST['object_type']) ? $_POST['object_type'] : '';
        $cmt = isset($_POST['comment']) ? $_POST['comment'] : '';

        if (!empty($objectId)) {
            $type = 'comment';
            // Kiểm tra tính hợp lệ
            if (empty($cmt)) {
                $this->errors['cmt'] = "Nhập nội dung trước khi gửi!";
            }
        } else {
            $type = 'feedback';
            if (empty($cmt)) {
                $this->errors['cmt'] = "Nhập nội dung trước khi gửi!";
            }
        }

        if (empty($commenter)) {
            $this->errors['name'] = "Nhận tên của bạn!";
        }

        // Nếu ko có lỗi
        if (empty($this->errors)) {
            // Gọi hàm thêm bình luận vào CSDL
            $postCmt = $this->cmtModel->postComment($commenter, $objectType, $objectId, $type, $cmt);
        }
        return $this->errors;
    }

    // Hàm xóa bình luận
    public function deleteComment()
    {
        //Xóa bình luận
        $id = isset($_POST['cmt_id']) ? $_POST['cmt_id'] : '';
        // Gọi phương thức xóa bình luận
        $deleteCmt = $this->cmtModel->deleteComment($id);
        if ($deleteCmt) {
            echo '<script language="javascript">alert("Đã xóa bình luận!");</script>';
        }
    }

    // hàm hiện thị tất cả comment 
    public function viewAllComment()
    {
        return $this->cmtModel->viewAllComment();
    }
}
