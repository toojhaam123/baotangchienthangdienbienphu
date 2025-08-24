<?php
// Điều hướng cho lớp Comment
$cmtControl = new C_Comment();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm bình luận
    if (isset($_POST['post_cmt'])) {
        $errors = $cmtControl->postComment();

        // ✅ Nếu không có lỗi → redirect để reset URL, tránh mở lại modal lần nữa
        if (empty($errors)) {
            $redirect = $_SERVER["REQUEST_URI"]; // chỉ lấy path
            header("Location: $redirect");
            exit;
        }
    }

    // Xóa bình luận
    if (isset($_POST['delete_cmt'])) {
        $cmtControl->deleteComment();
    }
}

// Hiển thị tất cả bình luận
$allCmt = $cmtControl->viewAllComment();
