<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_Permission.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_Permission
{
    private $permissModel;

    public function __construct()
    {
        $this->permissModel = new M_Permission();
    }

    // Hàm cấp quyền người dùng
    public function permissionsUser()
    {
        // Lấy thông tin từ form
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $comment = isset($_POST['comment']) ? 1 : 0;
        $managerArtifact = isset($_POST['mana_artifact']) ? 1 : 0;
        $addArtifact = isset($_POST['add_artifact']) ? 1 : 0;
        $editArtifact = isset($_POST['edit_artifact']) ? 1 : 0;
        $deleteArtifact = isset($_POST['delete_artifact']) ? 1 : 0;
        $managerNews = isset($_POST['mana_news']) ? 1 : 0;
        $addNews = isset($_POST['add_news']) ? 1 : 0;
        $editNews = isset($_POST['edit_news']) ? 1 : 0;
        $deleteNews = isset($_POST['delete_news']) ? 1 : 0;
        $managerIntroduction = isset($_POST['mana_introduction']) ? 1 : 0;
        $addIntroduction = isset($_POST['add_introduction']) ? 1 : 0;
        $editIntroduction = isset($_POST['edit_introduction']) ? 1 : 0;
        $deleteIntroduction = isset($_POST['delete_introduction']) ? 1 : 0;
        $managerExhibition = isset($_POST['mana_exhibition']) ? 1 : 0;
        $addExhibition = isset($_POST['add_exhibition']) ? 1 : 0;
        $editExhibition = isset($_POST['edit_exhibition']) ? 1 : 0;
        $deleteExhibition = isset($_POST['delete_exhibition']) ? 1 : 0;
        $managerComment = isset($_POST['mana_comment']) ? 1 : 0;
        $deleteComment = isset($_POST['delete_comment']) ? 1 : 0;
        $managerUser = isset($_POST['mana_user']) ? 1 : 0;
        $addUser = isset($_POST['add_user']) ? 1 : 0;
        $editUser = isset($_POST['edit_user']) ? 1 : 0;
        $deleteUser = isset($_POST['delete_user']) ? 1 : 0;


        // Gọi hàm cập nhập quyền người dùng
        $updatePermission = $this->permissModel->updatePermission(
            $userId,
            $managerArtifact,
            $addArtifact,
            $editArtifact,
            $deleteArtifact,
            $managerNews,
            $addNews,
            $editNews,
            $deleteNews,
            $managerIntroduction,
            $addIntroduction,
            $editIntroduction,
            $deleteIntroduction,
            $managerExhibition,
            $addExhibition,
            $editExhibition,
            $deleteExhibition,
            $managerComment,
            $deleteComment,
            $managerUser,
            $addUser,
            $editUser,
            $deleteUser
        );

        if ($updatePermission) {
            echo '<script language="javascript">alert("Đã cấp quyền thành công!");</script>';
        }
    }
}
