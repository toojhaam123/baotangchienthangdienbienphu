<?php
class M_Comment
{
    private $conn;

    // Hàm khởi tạo
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();
    }

    // Hàm đăng bình luận và phản hồi
    public function postComment($commenter, $objectType, $objectId, $type, $content)
    {
        // Câu lệnh gửi nội dung bình luận
        $postCmt = "INSERT INTO comments (commenter, object_type, object_id, type, content )
        VALUES (:commenter, :objectType, :objectId, :type, :content)";

        // Chuẩn bị kết nối đến CSDL 
        $stmt = $this->conn->prepare($postCmt);

        // Liên kết giá trị
        $stmt->bindParam(':commenter', $commenter);
        $stmt->bindParam(':objectType', $objectType);
        $stmt->bindParam(':objectId', $objectId);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':content', $content);

        // Thực hiện truy vấn
        $result = $stmt->execute();

        return $result;
    }

    // Hàm xóa bình luận
    public function deleteComment($Id)
    {
        // Câu lệnh SQL xóa bình luận
        $deleteCmt = "DELETE FROM comments WHERE comment_id = :Id";

        // Chuẩn bị kết nối
        $stmt = $this->conn->prepare($deleteCmt);

        // Liên kết giá trị
        $stmt->bindParam(':Id', $Id);

        // thực hiện truy vấn
        $result = $stmt->execute();

        return $result;
    }

    // Hiện thị các bình luận theo đối tượng
    public function viewAllComment()
    {
        // Câu lệnh lấy các bình luận theo đối tượng
        $getAllComment = "SELECT * FROM comments ORDER BY comment_id DESC";

        // Chuẩn bị ruy vấn
        $stmt = $this->conn->prepare($getAllComment);

        // Thực hiện truy vấn
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy danh sách dạng mảng

        return $result;
    }
}
