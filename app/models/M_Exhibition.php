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
        // Truy vấn chỉ lấy mỗi nhóm ảnh một ảnh duy nhất theo group_id
        $getAllExhibition = "SELECT ex.* FROM exhibitions ex JOIN (SELECT MIN(exhibition_id) as min_id FROM exhibitions";

        // mảng điều kiện
        $condition = array();

        // Nếu tồn tại từ khóa tìm kiếm
        if (!empty($keyWord)) {
            $condition[] = "(title LIKE :kw OR description LIKE :kw)";
        }

        // Nêu tồn tại từ khóa lọc
        if (!empty($filter)) {
            $condition[] = "type = :filter";
        }

        // nếu tồn tại điều kiện
        if (!empty($condition)) {
            $getAllExhibition .= " WHERE " . implode(" AND ", $condition);
        }

        // Nối câu lệnh
        $getAllExhibition .= " GROUP BY group_id) AS sub ON ex.exhibition_id = sub.min_id";

        // Sắp xếp + phân trang
        $getAllExhibition .= " ORDER BY ex.exhibition_id ASC LIMIT :start, :limit";

        // Chuẩn bị kết nối đến CSDL 
        $stmt = $this->conn->prepare($getAllExhibition);

        // Liên kết giá trị nếu tồn tại từ khóa
        if (!empty($keyWord)) {
            $kw = "%" . $keyWord . "%";
            $stmt->bindParam(':kw', $kw);
        }

        // Liên kết giá trị nếu tồn tại từ khóa lọc filter
        if (!empty($filter)) {
            $stmt->bindParam(':filter', $filter);
        }

        // Liên kết giá trị khoản hiện thị
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        // Thực thi 
        $stmt->execute();

        // Lưu kết quả về dạng mảng
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Hàm lấy tổng số lượng bản ghi trong cơ sở dữ liệu
    public function tatolGallery()
    {
        // Câu lệnh CSDL 
        $totalGallery = "SELECT COUNT(*) as total FROM exhibitions ex JOIN (SELECT MIN(exhibition_id) as min_id FROM exhibitions
        GROUP By group_id) AS SUB ON ex.exhibition_id = sub.min_id";

        // Chuẩn bị kết nối
        $stmt = $this->conn->prepare($totalGallery);

        // Thực thi 
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
