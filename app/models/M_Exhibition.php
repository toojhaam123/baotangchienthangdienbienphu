<?php

class M_Gallery
{
    private $conn;

    // Hàm khởi tạo
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();
    }

    // Hàm thêm hình ảnh - vieo 
    public function uploadExhibition($title, $description, $type, $file, $group_id)
    {
        // Câu lệnh SQL thêm triển lãm
        $insertGallery = "INSERT INTO exhibitions (title, description, type, group_id, img_video) 
        VALUES (:title, :description, :type, :group_id, :file)";

        // Chuẩn bị câu lệnh để thực thi 
        $stmt = $this->conn->prepare($insertGallery);

        // Liêm kết giá trị với các tham số
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':group_id', $group_id);
        $stmt->bindParam(':file', $file);

        // Thực thi 
        $result =  $stmt->execute();

        return $result;
    }

    // Hàm sửa thông tin hình nahr và video 
    public function updateExhibition($title, $description, $type, $file, $groupId)
    {
        // Câu lệnh cập nhập thông tin của hình ảnh hoặc Video 
        $updateGellery = "UPDATE exhibitions SET title = :title, description = :description, type = :type, img_video = :file
                            WHERE group_id = :group_id";

        // Chuẩn bị câu lệnh để truy vấn
        $stmt = $this->conn->prepare($updateGellery);

        // Liên kết giá trị với các tham số
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':file', $file);
        $stmt->bindParam(':group_id', $groupId);

        // Thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // Hàm xóa triển lãm 
    public function deleteExhibition($groupId)
    {
        // Câu lệnh xóa dựa trên id 
        $deleteGallery = "DELETE FROM exhibitions WHERE group_id = :group_id";

        // Chuẩn bị lệnh
        $stmt = $this->conn->prepare($deleteGallery);

        // Liêm kết giá trị
        $stmt->bindParam(':group_id', $groupId);

        // Thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // Hàm hiện thị tất cả triển lãm
    public function viewAllExhibition($keyWord, $filter, $start, $limit)
    {
        $sql = "
        SELECT 
            ex.*
        FROM exhibitions ex
        INNER JOIN (
            SELECT group_id, MIN(exhibition_id) AS min_id
            FROM exhibitions
            GROUP BY group_id
        ) AS sub ON ex.exhibition_id = sub.min_id
        WHERE 1 = 1
    ";

        if (!empty($keyWord)) {
            $sql .= " AND (ex.title LIKE :kw OR ex.description LIKE :kw) ";
        }

        if (!empty($filter)) {
            $sql .= " AND ex.type = :filter ";
        }

        $sql .= " ORDER BY ex.exhibition_id ASC LIMIT :start, :limit";

        $stmt = $this->conn->prepare($sql);

        if (!empty($keyWord)) {
            $kw = "%" . $keyWord . "%";
            $stmt->bindParam(':kw', $kw);
        }

        if (!empty($filter)) {
            $stmt->bindParam(':filter', $filter);
        }

        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Hàm lấy tổng số lượng bản ghi trong cơ sở dữ liệu
    public function tatolGallery()
    {
        $sql = "
        SELECT COUNT(*) AS total
        FROM (
            SELECT group_id 
            FROM exhibitions
            GROUP BY group_id
        ) AS temp
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }


    // Hàm xem chi tiết triển lãm 
    public function detailExhibition($groupId)
    {
        // Câu lệnh SQL lấy chi tiết triển lãm
        $detailExhibition = "SELECT * FROM exhibitions WHERE group_id = :group_id";

        // Chuẩn bị kết nối
        $stmt = $this->conn->prepare($detailExhibition);

        // Liên kết giá trị với tham số
        $stmt->bindParam(':group_id', $groupId);

        // Thực thi 
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Hàm hiện thị danh sách ảnh tại thư viện ảnh
    public function viewImageExhibition($keyWord, $filter, $start, $limit)
    {
        // Câu lệnh lấy tất cả các ảnh trong bảng exhibitions
        $viewAllPicture = "SELECT * FROM exhibitions";

        // Mảng điều kiện
        $condition = array();

        // Nếu có từ khóa
        if (!empty($keyWord)) {
            $condition[] = "(title LIKE :kw OR description LIKE :kw)";
        }

        // Nếu tồn tại lọc
        if (!empty($filter)) {
            $condition[] = "tag = :filter";
        }

        // Nếu có điều kiện thì thêm WHERE
        if (!empty($condition)) {
            $viewAllPicture .= " WHERE " . implode(" AND ", $condition);
        }

        // Nối câu lệnh
        $viewAllPicture .= " ORDER BY exhibition_id DESC LIMIT :start, :limit";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($viewAllPicture);

        // Nếu có từ khóa thì gán
        if (!empty($keyWord)) {
            $kw = "%" . $keyWord . "%";
            $stmt->bindParam(':kw', $kw);
        }

        // Nếu có filter
        if (!empty($filter)) {
            $stmt->bindValue(':filter', $filter);
        }

        // Gán phân trang
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        // Thực thi
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
