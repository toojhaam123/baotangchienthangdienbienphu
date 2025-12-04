<?php
class M_Artifact
{
    private $conn;

    // Hàm khởi tạo
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();
    }

    // Hàm thêm hiện vật
    public function createArtifact($name, $description, $type, $image)
    {
        // Câu lệnh SQL Insert
        $insertArtifact = "INSERT INTO artifacts (name, type, description, image)
        VALUES (:name,:type, :description,  :image)";

        // Chuẩn bị cho câu lệnh
        $stmt = $this->conn->prepare($insertArtifact);

        // Liên kết giá trị với tham số
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);

        // Thực thi 
        $result = $stmt->execute();
        return $result;
    }

    // Hàm sửa thông tin hiện vật
    public function updateArtifact($name, $description, $type, $image, $artifactId)
    {

        // Câu lệnh SQL Insert
        $updateArtifact = "UPDATE artifacts SET name = :name, type = :type, description = :description, image = :image
        WHERE artifact_id = :artifact_id";

        // Chuẩn bị cho câu lệnh
        $stmt = $this->conn->prepare($updateArtifact);

        // Liên kết giá trị với tham số
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':artifact_id', $artifactId);

        // Thực thi 
        $result = $stmt->execute();
        return $result;
    }

    // Hàm xóa hiện vật
    public function deleteArtifact($id)
    {
        // Câu lệnh xóa hiện vật theo id
        $deleteArtifact = "DELETE FROM artifacts WHERE artifact_id = :id";

        // Chuẩn bị câu lệnh xóa
        $stmt = $this->conn->prepare($deleteArtifact);

        // Liên kết giá trị
        $stmt->bindParam(':id', $id);

        // Thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // Hàm hiện thị tất cả hiện vật
    public function viewAllArtifact($keyWord, $filter, $start, $limit)
    {
        // Câu lênh SQL lấy tất cả các hiện vật
        $getAllArtifact = "SELECT * FROM artifacts"; // sắp xếp mới nhất trước

        // ORDER BY created_at DESCs

        // Thêm điều kiện nếu có từ khóa tìm kiếm hoặc lọc
        $condition = array();

        // nếu có từ khóa thì thêm từ khóa vào
        if (isset($keyWord) && $keyWord != '') {
            $condition[] = "(name LIKE :kw OR description LIKE :kw OR type LIKE :kw)";
        }

        // nếu có từ khóa từ lọc thì thêm từ khóa vào
        if (isset($filter) && $filter != '') {
            $condition[] = "type = :filter";
        }

        // Nếu có điều kienj thì thêm vào câu lệnh
        if (isset($condition) && $condition != null) {
            $getAllArtifact .= " WHERE " . implode(" AND ", $condition);
        }

        // thêm điều kiện sắp xếp theo ngày mới nhất
        $getAllArtifact .= " ORDER BY artifact_id ASC LIMIT :start, :limit";

        // Chuẩn bị kết nối đến CSDL
        $stmt = $this->conn->prepare($getAllArtifact);

        // Liên kết giá trị nếu có
        if (isset($keyWord) && $keyWord != '') {
            $kw = "%" . $keyWord . "%";
            $stmt->bindParam(':kw', $kw);
        }

        if (isset($filter) && $filter != '') {
            $stmt->bindParam(':filter', $filter);
        }

        // Liên kết giá trị
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        // Thực thi
        $stmt->execute();

        // Lưu danh sách dưới dạng mảng
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    // Hàm lấy ra các hiện vật mới nhất
    public function viewNewArtifact()
    {
        // Câu lệnh SQL 
        $newArtifact = "SELECT * FROM artifacts ORDER BY created_at DESC LIMIT 4"; // Lấy 4 hiện vật mới nhất

        $stmt = $this->conn->prepare($newArtifact);

        // thực thi 
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lưu các bản ghi dưới dạng mảng 

        return $result;
    }

    // Hàm lấy tổng số lượng hiện vật hiện có trong CSDL 
    public function totalArtifact()
    {
        // Câu lệnh lấy số lương hiện vật trong CSDL 
        $totalArtifact = "SELECT COUNT(*) as total FROM artifacts";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($totalArtifact);

        // Thực thi 
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }
}
