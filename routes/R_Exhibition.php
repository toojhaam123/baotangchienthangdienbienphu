<?php
// Điều hướng cho lớp triển lãm
$exhibitionControl = new C_Exhibition();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm triển lãm
    if (isset($_POST['upload_exhibition'])) {
        $errors = $exhibitionControl->uploadExhibition();
    }

    // Chỉnh sửa triển lãm
    if (isset($_POST['update_exhibition'])) {
        $errors = $exhibitionControl->updateExhibition();
    }

    // Xóa triển lãm
    if (isset($_POST['delete_exhibitions'])) {
        $exhibitionControl->deleteExhibition();
    }
}

// Hiển thị tất cả triển lãm
$exhibition_TotalPage = $exhibitionControl->viewAllExhibition();
$pageExhibition = $exhibition_TotalPage[0];
$totalPageExhibition = $exhibition_TotalPage[1];
$exhibitions = $exhibition_TotalPage[2];

// Hiển thị chi tiết triển lãm
$detailExhibition = $exhibitionControl->detailExhibition();

// Hiển thị tất cả ảnh trong triển lãm
$viewAllImage_TotalPage = $exhibitionControl->viewImageExhibition();
$pageImageExhibition = $viewAllImage_TotalPage[0];
$totalPageImageExbition = $viewAllImage_TotalPage[1];
$viewAllImageExhibition = $viewAllImage_TotalPage[2];
