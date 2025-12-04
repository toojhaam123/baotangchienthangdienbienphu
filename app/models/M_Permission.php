<?php
class M_Permission
{

    private $conn;

    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();
    }

    // Cập nhật quyền người dùng vào bảng
    public function updatePermission(
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
    ) {
        // Câu lệnh SQL cập nhập
        $updatePermission = "UPDATE permissions SET 
        mana_artifact = :mana_artifact, add_artifact = :add_artifact, edit_artifact = :edit_artifact, delete_artifact = :delete_artifact,
        mana_news = :mana_news, add_news = :add_news, edit_news = :edit_news, delete_news = :delete_news, 
        mana_exhibition= :mana_exhibition, add_exhibition = :add_exhibition, edit_exhibition = :edit_exhibition, delete_exhibition = :delete_exhibition,
        mana_comment = :mana_comment, delete_comment = :delete_comment, 
        mana_introduction = :mana_introduction, add_introduction = :add_introduction, edit_introduction = :edit_introduction, delete_introduction = :delete_introduction,
        mana_user = :mana_user, add_user = :add_user, edit_user = :edit_user, delete_user = :delete_user
        WHERE user_id = :userId";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($updatePermission);

        // Liên kết giá trị
        $stmt->bindParam(':mana_artifact', $managerArtifact);
        $stmt->bindParam(':add_artifact', $addArtifact);
        $stmt->bindParam(':edit_artifact', $editArtifact);
        $stmt->bindParam(':delete_artifact', $deleteArtifact);
        $stmt->bindParam(':mana_news', $managerNews);
        $stmt->bindParam(':add_news', $addNews);
        $stmt->bindParam(':edit_news', $editNews);
        $stmt->bindParam(':delete_news', $deleteNews);
        $stmt->bindParam(':mana_introduction', $managerIntroduction);
        $stmt->bindParam(':add_introduction', $addIntroduction);
        $stmt->bindParam(':edit_introduction', $editIntroduction);
        $stmt->bindParam(':delete_introduction', $deleteIntroduction);
        $stmt->bindParam(':mana_comment', $managerComment);
        $stmt->bindParam(':delete_comment', $deleteComment);
        $stmt->bindParam(':mana_exhibition', $managerExhibition);
        $stmt->bindParam(':add_exhibition', $addExhibition);
        $stmt->bindParam(':edit_exhibition', $editExhibition);
        $stmt->bindParam(':delete_exhibition', $deleteExhibition);
        $stmt->bindParam(':mana_user', $managerUser);
        $stmt->bindParam(':add_user', $addUser);
        $stmt->bindParam(':edit_user', $editUser);
        $stmt->bindParam(':delete_user', $deleteUser);
        $stmt->bindParam(':userId', $userId);

        // Thực thi
        return $stmt->execute();
    }
}
