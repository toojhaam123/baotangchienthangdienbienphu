<?php
// Điều hướng cho lớp hiện vật
$artifactControl = new C_Artifact();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Thêm mới hiện vật
    if (isset($_POST['add_artifacts'])) {
        $errors = $artifactControl->createArtifact();
    }

    // Sửa hiện vật
    if (isset($_POST['edit_artifacts'])) {
        $errors = $artifactControl->updateArtifact();
    }

    // Xóa hiện vật
    if (isset($_POST['delete_artifacts'])) {
        $artifactControl->deleteArtifact();
    }
}

// Lấy tất cả các hiện vật để hiển thị
$artifact_TotalPage = $artifactControl->viewAllArtifact();
$pageArtifact = $artifact_TotalPage[0];
$totalPageArtifact = $artifact_TotalPage[1];
$artifacts = $artifact_TotalPage[2];

// Lấy các hiện vật mới nhất
$newArtifacts = $artifactControl->viewNewArtifact();
