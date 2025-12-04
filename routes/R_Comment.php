<?php
// Điều hướng cho lớp Comment
$cmtControl = new C_Comment();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm bình luận
    if (isset($_POST['post_cmt'])) {
        $errors = $cmtControl->postComment();
    }

    // Xóa bình luận
    if (isset($_POST['delete_cmt'])) {
        $cmtControl->deleteComment();
    }
}

// Hiển thị tất cả bình luận
$allCmt = $cmtControl->viewAllComment();
