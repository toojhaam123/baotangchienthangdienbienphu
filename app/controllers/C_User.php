<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Chỉ bắt đầu session nếu chưa có session nào
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/app/models/M_User.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/BaoTangChienThangDienBienPhu/core/bootstrap.php';
class C_User
{
    private $userModel;
    public $errors = array();

    // Hàm khởi tạo
    public function __construct()
    {
        $this->userModel = new M_User();
    }

    // Hàm đăng ký tài khoản
    public function register()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Việt Nam
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
        // Lấy thông tin từ form đăng ký
        $fullName = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $rePassword = isset($_POST['re_password']) ? $_POST['re_password'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : 0;
        $created_at = date('Y-m-d H:i:s');

        // Kiêm tra tính hợp lẹ của các trường đăng ký
        if (empty($username)) {
            $this->errors['username'] = 'Không bỏ trống tên đăng nhập!';
        }
        if (empty($email)) {
            $this->errors['email'] = 'Không bỏ trống email!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Kiểm tra định dạng video
            $this->errors['email'] = 'Email phải là @gmail.com!';
        }
        if (empty($password)) {
            $this->errors['password'] = 'Không bỏ trống mật khẩu';
        }
        if (empty($rePassword)) {
            $this->errors['re_password'] = 'Nhập mật khẩu xác minh';
        } elseif ($rePassword != $password) {
            $this->errors['re_password'] = 'Mật khẩu không khớp';
        }
        // Nếu không có lỗi
        if (empty($this->errors)) {
            // Lấy thông tin người dùng
            $userInfor = $this->userModel->viewAllUser($keyWord, $filter);

            foreach ($userInfor as $user) {
                if ($user['username'] == $username) {
                    $this->errors['username'] = "Tên người dùng đã tồn tại!";
                }
                if ($user['email'] == $email) {
                    $this->errors['email'] = "Email đã tồn tại";
                }
                if (!empty($phone)) {
                    if ($user['phone'] == $phone)
                        $this->errors['phone'] = 'Số điện thoại đã tồn tại';
                }
            }
            if (empty($this->errors)) { // Nếu email và số điện thoại không trùng
                // Thêm người dùng vào cơ sở dữ liệu

                $insertUser = $this->userModel->register($fullName, $username, $email, $password, $phone, $address, $role, $created_at); // Gọi phương thức thêm người dùng vào csdl

                if ($insertUser) {
                    if (isset($_SESSION['users'])) {
                        echo '<script language="javascript">alert("Bạn đã thêm một nhân viên mới!");</script>';
                    } else {
                        // Nếu thực thi thành công
                        echo '<script language="javascript">alert("Bạn đã đăng ký thành công! Quay lại đăng nhập ngay!"); window.location="../login/login.php";</script>';
                    }
                } else {
                    echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý!"); window.location="../register/register.php";</script>';
                }
            }
        }
        return $this->errors; // Trả về lỗi nếu có
    }

    // Hàm đăng nhập tài khoản'
    public function login()
    {
        // Lấy thông tin đăngn nhập từ form đăng nhập
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';

        // Kiểm tra tính hợp lệ của các trường nhập
        if (empty($username)) {
            $this->errors['username'] = 'Không bỏ trống tên đăng nhập!';
        }
        if (empty($password)) {
            $this->errors['password'] = 'Không bỏ trống mật khẩu!';
        }

        if (empty($this->errors)) {
            // Gọi hàm lấy thông tin người dùng
            $check = $this->userModel->login($username, $password);
            // Kiểm tra 
            if ($check['user']) {
                if ($check['password']) {
                    // Mật khẩu và username đúng thì lưu id người dùng vào session
                    $_SESSION['users'] = $check['user'];
                    $_SESSION['success_login'] = 'Đã đăng nhập thành công!';

                    $location = isset($_SESSION['redirect_url']) ? $_SESSION['redirect_url'] : '../../../index.php';
                    header("Location: $location");
                    exit();
                } else {
                    $this->errors['password'] = "Mật khẩu không đúng";
                }
            } else {
                $this->errors['username'] = "Tên người dùng không tồn tại";
            }
        }
        return $this->errors; // Trả về lỗi nếu có
    }

    // Hàm hiện thị tất cả người dùng
    public function viewAllUser()
    {
        // Lấy từ khóa để tìm kiếm
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
        switch ($filter) {
            case 'visitor':
                $newFilter = 0;
                break;
            case 'staff':
                $newFilter = 1;
                break;
            case 'admin':
                $newFilter = 2;
                break;
            default:
                $newFilter = '';
                break;
        }
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        // echo $keyWord;
        // exit;
        // Gọi hàm hiện thị tất cả người dùng
        $users = $this->userModel->viewAllUser($keyWord, $newFilter);
        return $users;
    }

    // Hàm chỉnh sửa thông tin người dùng
    public function editUser()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh'); // Thiết lập múi giờ Việt Nam

        // Lấy thông tin từ form đăng ký
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';

        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $fullName = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
        $address = isset($_POST['address']) ? $_POST['address'] : '';
        $role = isset($_POST['role']) ? $_POST['role'] : 0;
        $updated_at = date('Y-m-d H:i:s');
        // Kiêm tra tính hợp lẹ của các trường đăng ký
        if (empty($username)) {
            $this->errors['username'] = 'Không bỏ trống tên đăng nhập!';
        }
        if (empty($email)) {
            $this->errors['email'] = 'Không bỏ trống email!';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Kiểm tra định dạng video
            $this->errors['email'] = 'Emai phải chứa @!';
        }

        if (empty($this->errors)) {
            // Lấy thông tin người dùng
            $userInfor = $this->userModel->viewAllUser($keyWord, $filter);

            foreach ($userInfor as $user) {
                if ($user['user_id'] != $userId) {
                    if ($user['username'] == $username) {
                        $this->errors['username'] = "Tên người dùng đã tồn tại!";
                    }
                    if ($user['email'] == $email) {
                        $this->errors['email'] = "Email đã tồn tại";
                    }
                    if (!empty($phone)) {
                        if ($user['phone'] == $phone)
                            $this->errors['phone'] = 'Số điện thoại đã tồn tại';
                    }
                }
            }
            if (empty($this->errors)) {
                // nếu ko có lỗi gì thì tiến hành cập nhật
                $updateUser = $this->userModel->updateUser($fullName, $username, $email, $phone, $address, $role, $updated_at, $userId);

                if ($updateUser) {
                    echo '<script language="javascript">alert("Đã chỉnh sửa thành công!");</script>';
                }
            }
        }
        return $this->errors; // Trả về lỗi
    }

    // Hàm xóa người dùng
    public function deleteUser()
    {
        // Lấy thông tin từ phía người dùng
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';

        // Gọi phương thức xóa người dùng
        $deleteUser = $this->userModel->deleteUser($userId);
        // nếu xóa thành công thì thông báo
        if ($deleteUser) {
            echo '<script language="javascript">alert("Đã xóa thành công!");</script>';
        }
    }

    // Hàm hiện thị tất cả các quyền
    public function viewAllPermission()
    {
        // Gọi hàm hiện thị tất cả các quyền
        return $this->userModel->viewAllPermission();
    }

    // Hàm thay đổi đổi mật khẩu của nhười dùng
    public function changePass()
    {
        // Lấy dữ liệu cần thay đổi
        $filter = isset($_POST['filter']) ? $_POST['filter'] : '';
        $keyWord = isset($_POST['key_word']) ? $_POST['key_word'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $rePass = isset($_POST['re_password']) ? $_POST['re_password'] : '';
        // Kiểm tra tính hợp lệ
        if (empty($email)) {
            $this->errors['email'] = "Nhập email!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Email không hợp lệ!';
        }
        if (empty($password)) {
            $this->errors['password'] = "Nhập mật khẩu!";
        }
        if (empty($rePass)) {
            $this->errors['re_pass'] = "Nhập mật khẩu xác minh";
        } elseif ($password != $rePass) {
            $this->errors['re_pass'] = "Mật khẩu xác minh ko khớp";
        }

        // nếu không có lỗi gì
        if (empty($this->errors)) {
            // Kiểm tra thông tin người dùng
            $userInfor = $this->userModel->viewAllUser($keyWord, $filter);
            $countErr = 0;
            foreach ($userInfor as $user) {
                if ($user['email'] == $email) {
                    $countErr += 1;
                }
            }
            if ($countErr == 0) {
                $this->errors['email'] = 'Email không tồn tại';
            } else {
                // Gọi hàm thay đổi mật khẩu
                $changePass = $this->userModel->changePass($email, $password);
                if ($changePass) {
                    echo '<script language="javascript">alert("Đã thay đổi mật khẩu");</script>';
                }
            }
        }
        return $this->errors;
    }

    // Hàm thay đổi trang thái tài khoản người dùng dựa trên id 
    public function changeStatus()
    {
        // Lấy id người dùng và trạng thái người dùng
        $userId = isset($_POST['user_id']) ? $_POST['user_id'] : '';
        $status = isset($_POST['status']) ? $_POST['status'] : '';

        // Kiểm tra trạng thái tài khoản
        if ($status == 1) {
            $status = 0;
        } else {
            $status = 1;
        }
        // Gọi hàm cập nhập trạng thái
        $changeStt = $this->userModel->changeStatus($userId, $status);

        if ($changeStt) {
            if ($status == 0) {
                echo '<script language="javascript">alert("Đã khóa tài khoản người dùng");</script>';
            } else {
                echo '<script language="javascript">alert("Đã mở khóa tài khoản người dùng");</script>';
            }
        }
    }
}
