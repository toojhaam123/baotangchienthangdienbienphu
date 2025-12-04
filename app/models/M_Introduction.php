<?php
class M_Introduction
{
    private $conn;

    // Hàm khởi tạo kết nối đến cơ sở dữ liệu
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();
    }

    // Hàm thêm giới thiệu cho bảo tàng
    public function uploadIntroduction($title, $content, $category, $image)
    {
        // Câu lệnh insert
        $inserIntro = "INSERT INTO introductions (title, content, category, image ) VALUES (:title, :content, :category, :image)";

        // Chuẩn bị câu lện
        $stmt = $this->conn->prepare($inserIntro);

        // Liên kết giá trị với tham số
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':image', $image);

        // Thực thi
        $result = $stmt->execute();

        return $result;
    }

    // Hàm cập nhật nội dung giới thiệu
    public function updateIntroduction($title, $content, $category, $image)
    {
        // Câu lệnh update
        $updateIntro = "UPDATE introductions SET title = :title, content = :content, image = :image WHERE category = :category";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($updateIntro);

        // Liên kết giá trị
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':category', $category);

        // Thực thi
        $stmt->execute();

        return $stmt;
    }

    // Hàm xóa nội dung giới thiệu
    public function deleteIntroduction($category)
    {
        // Câu lệnh xóa
        $deleteIntro = "DELETE FROM introductions WHERE category = :category";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($deleteIntro);

        // Liên kết giá trị với tham số 
        $stmt->bindParam(':category', $category);

        // Thự thi
        $result = $stmt->execute();

        return $result;
    }

    // Hàm hiện thị nội dung giới thiệu
    public function viewIntroduction()
    {
        // Câu lệnh SQL lấy tất cả thông tin giới thiệu
        $getAllIntroduction = "SELECT * FROM introductions";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($getAllIntroduction);

        // Thực thi
        $stmt->execute();

        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
