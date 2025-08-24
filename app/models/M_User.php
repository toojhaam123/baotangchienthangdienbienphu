<?php
class M_User
{
    private $conn;

    // Hàm kết nối đến SCDL
    public function __construct()
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/config/connect_db.php';
        $this->conn = getConnection();  // Gọi hàm để lấy đối tượng PDO
    }

    // Hàm đăng ký tài khoản
    public function register($fullName, $username, $email, $password, $phone, $address, $role, $created_at)
    {
        // Câu lệnh SQL để chèn dữ liệu người dùng vào cơ sở dữ liệu
        $insertUser = "INSERT INTO users (fullname, username, email, password, phone, address, role, created_at)
        VALUES (:fullname, :username, :email, :password, :phone, :address, :role, :created_at)";

        // Chuẩn bị chèn dữ liệu
        $stmt = $this->conn->prepare($insertUser);

        // Mã hóa mật khẩu bằng pp bcrypt
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Liên kết các tham số với các biến
        $stmt->bindParam(':fullname', $fullName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':created_at', $created_at);

        // Thực thi câu lệnh
        $result = $stmt->execute();

        $userId = $this->conn->lastInsertId(); // Lấy id vừa đc đăng ký

        // Chèn userId vào bảng phân quyền và các quyền mặc định tương ứng

        $insertUsserId = "INSERT INTO permissions (user_id)
        VALUES (:userId)";

        // Chuẩn bị chèn dữ liệu
        $stmt = $this->conn->prepare($insertUsserId);
        // Liên kết giá trị với tham số
        $stmt->bindParam(':userId', $userId);

        // Thực thi kết quả
        $stmt->execute();

        // Trả về kết quả
        return $result;
    }

    // Hàm kiểm tra usrname email và số điện thoại đã tồn tại hay chưa
    public function viewAllUser($keyWord, $filter)
    {
        // Dùng câu lệnh PDO để kiểm tra;
        $getAllUser = "SELECT * FROM users";

        // Điều kiện tìm kiếm
        $condition = [];

        // Nếu có từ khóa tìm kiếm thêm điều kiện vào mảng
        if (isset($keyWord) && $keyWord != '') {
            $condition[] = "(fullname LIKE :kw 
            OR username LIKE :kw 
            OR email LIKE :kw)";
        }

        // Nếu có từ khóa lọc, chèn thêm từ khóa lọc vào
        if (isset($filter) && $filter != '') {
            $condition[] = "role = :filter";
        }
        // Nếu tồn tại điều kiện, thêm chúng vào câu truy vấn
        if (isset($condition) && $condition != null) {
            $getAllUser .= " WHERE " . implode(' AND ', $condition);
        }

        // Chuẩn bị kết nối
        $stmt = $this->conn->prepare($getAllUser); // Chuẩn bị lệnh SQL

        // Liên kết giá trị với tham số
        if (isset($keyWord) && $keyWord != '') {
            $kw = "%" . $keyWord . "%";
            $stmt->bindParam(':kw', $kw);
        }

        if (isset($filter) && $filter != '') {
            $stmt->bindParam(':filter', $filter, PDO::PARAM_INT);
        }

        $stmt->execute();  // Thực thi câu lệnh truy vấn
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy dữ liệu từ cơ sở dữ liệu dưới dạng mảngmảng kết hợp

        return $result; // Trả về kết quả
    }

    // Hàm đănng nhập tài khoản
    public function login($username, $password)
    {
        // Câu lệnh SQL để đăng nhập
        $check = "SELECT * FROM users WHERE username = :username";
        // Chuẩn bị lệnh SQL
        $stmt = $this->conn->prepare($check);
        // Liên kết giá trị với nhau
        $stmt->bindParam(':username', $username);

        // Thực thi câu kệnh
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC); //Lưu kết quar dưới dạng mảng

        // Nếu có người dùng
        if ($result) {
            // So sánh mk gửi vào với mk trong csdl bằng hàm password_verify()
            if (password_verify($password, $result['password'])) {
                return array('user' => $result, 'password' => true);
            } else {
                return array('user' => $result, 'password' => false);
            }
        }
        return array('user' => null, 'password' => false); // Nếu khồn tìm thấy người dùng trả về kêt quả sai để thông báo
    }

    // Hàm cập nhật thông tin người dùng
    public function updateUser($fullName, $username, $email, $phone, $address, $role, $updated_at, $userId)
    {
        // Câu lệnh cập nhật user
        $updateUser = "UPDATE users SET fullname = :fullname, username = :username, email = :email, phone = :phone, 
        address = :address, role = :role, updated_at = :updated_at WHERE user_id = :userId";

        // Chuẩn bị câu lệnh SQL
        $stmt = $this->conn->prepare($updateUser);

        // Liên kết tham số với giá trị
        $stmt->bindParam(':fullname', $fullName);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->bindParam(':userId', $userId);  // Đảm bảo rằng tên tham số đúng là ':userId'

        // Thực thi câu lệnh
        return $stmt->execute();
    }

    // Hàm xóa người dùng
    public function deleteUser($userId)
    {
        // Câu lệnh SQL Xóa người dùng
        $deleteUser = "DELETE FROM users WHERE user_id = :userId";

        // Chuẩn bị câu lệnh
        $stmt = $this->conn->prepare($deleteUser);

        // Gắn liên keesy giá trị và tham số
        $stmt->bindParam(':userId', $userId);

        // Thực thi
        $stmt->execute();

        return $stmt;
    }

    // Hàm lấy tất cả quyền trong bảng
    public function viewAllPermission()
    {
        // Câu lệnh SQL lấy tất cả các bản ghi
        $permission = "SELECT * FROM permissions";

        $stmt = $this->conn->prepare($permission); // Chuẩn bị lệnh SQL
        $stmt->execute();  // Thực thi câu lệnh truy vấn
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Lấy dữ liệu từ cơ sở dữ liệu dưới dạng mảngmảng kết hợp

        return $result; // Trả về kết quả
    }

    // Hàm thay đổi mật khẩu
    public function changePass($email, $pass)
    {
        // Câu lệnh thay đổi mật khẩu
        $changePass = "UPDATE users SET password = :pass WHERE email = :email";

        // Chuẩn bị câu lệnh thay đổi
        $stmt = $this->conn->prepare($changePass);

        // Mã háo mật khẩu trước khi thay đổi
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);
        // Liên kêt giá trị 
        $stmt->bindParam(':pass', $hashedPassword);
        $stmt->bindParam(':email', $email);

        // Thực thi 
        $result = $stmt->execute();

        return $result;
    }

    // Hàm thay đổi trạng thái tài khoản người dùng
    public function changeStatus($userId, $status)
    {
        // Câu lệnh SQL thay đổi trạng thái
        $changeStt = "UPDATE users SET status = :stattus WHERE user_id = :userId";

        // Chuẩn bị câu lệnh kết nối
        $stmt = $this->conn->prepare($changeStt);

        // Liên kết giá trị
        $stmt->bindParam(':stattus', $status);
        $stmt->bindParam(':userId', $userId);

        // Thưc thi 
        $result = $stmt->execute();

        return $result;
    }
}
