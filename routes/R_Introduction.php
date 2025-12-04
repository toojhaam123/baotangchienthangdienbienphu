<?php
// Điều hướng cho lớp giới thiệu bảo tàng
$introControl = new C_Introductiion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm phần giới thiệu
    if (isset($_POST['uploadIntroduction'])) {
        $errors = $introControl->uploadIntroduction();
    }

    // Sửa thông tin giới thiệu
    if (isset($_POST['edit_introduction'])) {
        $errors = $introControl->updateIntroduction();
    }

    // Xóa thông tin giới thiệu
    if (isset($_POST['delete_introductions'])) {
        $introControl->deleteIntroduction();
    }
}

// Lấy tất cả thông tin giới thiệu
$introductions = $introControl->viewIntroduction();
