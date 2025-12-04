<?php
class M_News
{
    private $conn;

    // Hàm khởi tạo
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();
    }

    // Hàm thêm tin tức và sự kiện
    public function createNews($title, $image_name, $content, $image, $type)
    {
        // Câu lệnh thêm tin tức - sự kiện
        $createNews = "INSERT INTO news (title, image_name, content, image, type) 
        VALUES (:title, :image_name, :content, :image, :type)";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($createNews);

        // Liên kết các giá trị với các tham số
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_name', $image_name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':type', $type);

        // Thực thi
        $result = $stmt->execute();

        return $result;
    }

    // Hàm cập nhập tin tức và sự kiện
    public function updateNews($title, $image_name, $content, $image, $type, $id)
    {
        // Câu lệnh cập nhật tin tức - sự kiện
        $updateNews = "UPDATE news SET title = :title, content = :content, image_name = :image_name, image = :image, type = :type WHERE news_id = :id";

        // Chuẩn bị câu lệnh để thực thi
        $stmt = $this->conn->prepare($updateNews);

        // Liên kết giá trị với các tham số
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':image_name', $image_name);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':id', $id);

        // thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // Hàm xóa tin tức và sự kiện
    public function deleteNews($id)
    {
        // Câu lệnh xóa các tin tức - sự kiện
        $deleteNews = "DELETE FROM news WHERE news_id = :id";

        // Chuẩn bị lệnh thực thi
        $stmt = $this->conn->prepare($deleteNews);

        // Liên kết giá trị với tham số
        $stmt->bindParam(':id', $id);

        // Thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // Hàm hiện thị tất cả tin tức và sự kiện
    public function viewAllNews($keyWord, $filter, $start, $limit)
    {
        // Câu lệnh lấy tất cả tin tức - sự kiện
        $getAllNews = "SELECT * FROM news";

        // Mảng điều kiện
        $condition = array();

        //nếu có từ khóa tìm kiếm hoặc lọc 
        if ($keyWord != '') {
            $condition[] = "(title LIKE :kw OR image_name LIKE :kw OR content LIKE :kw)";
        }

        if ($filter != '') {
            $condition[] = "type = :filter";
        }

        // Nếu có điều kiện 
        if ($condition != null) {
            $getAllNews .= " WHERE " . implode(" AND ", $condition);
        }

        $getAllNews .= " ORDER BY news_id ASC LIMIT :start, :limit";

        $stmt = $this->conn->prepare($getAllNews);
        // Chuẩn bị lệnh thực thi 

        // Liên kết giá trị nếu có
        if ($keyWord != '') {
            $kw = '%' . $keyWord . '%';
            $stmt->bindParam(':kw', $kw);
        }

        if ($filter != '') {
            $stmt->bindParam(':filter', $filter);
        }

        // Liên kết giá trị 
        $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

        // Thực thi
        $stmt->execute();

        // Lưu các bản ghi dưới dạng mảng
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    // Hàm thêm view cho tin tức sự kiện
    public function addViewNews($id)
    {
        // Câu lệnh thêm view 
        $addViewNews = "UPDATE news SET views = views + 1 WHERE news_id = :id";

        $stmt = $this->conn->prepare($addViewNews);

        // Liên kết giá trị
        $stmt->bindParam(':id', $id);

        // Thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // hiện thị các tin tức - sự kiện có view cao nhất
    public function getMAxView()
    {
        // Lệnh SQL lấy view cao nhất
        $getMaxView = "SELECT * FROM news ORDER BY views DESC LIMIT 4";

        // Chuẩn bị kết nối
        $stmt = $this->conn->prepare($getMaxView);

        // Thực thi 
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lưu kết quả dưới dangjh mảng 

        return $result;
    }

    // Hàm lấy tổng số tin tức - sự kiện hiện có trong CSDL 
    public function toltalNews()
    {
        // Hàm lấy tổng tin tức - sự kiện 
        $totalNews = "SELECT COUNT(*) as total FROM news";

        // Chuẩn bị câu lệnh kết nối CSDL 
        $stmt = $this->conn->prepare($totalNews);

        // Thực thi 
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }

    // hàm lấy chi tiết tin tức - sự kiện bằng id 
    public function detailNews($newsId)
    {
        // Câu lệnh lấy chi tiết bằng Id 
        $detailNews = "SELECT * FROM news WHERE news_id = :Id";

        // Chuẩn bị kết nối
        $stmt = $this->conn->prepare($detailNews);

        // Liên kết giá trị với tham số
        $stmt->bindParam(':Id', $newsId);

        // Thực thi 
        $stmt->execute();

        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hàm lấy tất cả các hình ảnh tin tức - sự kiện lên thư viện
    public function getAllImageNews($keyWord, $filter, $start, $limit)
    {
        // Câu lệnh lấy tất cả các ảnh trong bảng exhibitions
        $getAllImageNews = "SELECT * FROM news";

        // Mảng điều kiện
        $condition = array();

        // Nếu có từ khóa
        if (!empty($keyWord)) {
            $condition[] = "(title LIKE :kw OR content LIKE :kw OR image_name LIKE :kw)";
        }

        // Nếu tồn tại lọc
        if (!empty($filter)) {
            $condition[] = "type = :filter";
        }

        // Nếu có điều kiện thì thêm WHERE
        if (!empty($condition)) {
            $getAllImageNews .= " WHERE " . implode(" AND ", $condition);
        }

        // Nối câu lệnh
        $getAllImageNews .= " ORDER BY news_id DESC LIMIT :start, :limit";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($getAllImageNews);

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
