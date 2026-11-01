<?php
require_once APP_ROOT . '/app/libs/DbConnection.php';
require_once APP_ROOT . '/app/models/User.php';

class UserService {
    private $conn;

    public function __construct() {
        $db = new DbConnection();
        $this->conn = $db->getConnection();
    }

    public function findByEmail($email) {
        if ($this->conn == null || empty($email)) return null;

        $email = trim($email);
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => strtolower($email)]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User(
                $row['id'],
                $row['fullname'],
                $row['email'],
                $row['password'],
                $row['role'],
                $row['created_at']
            );
        }
        return null;
    }

    public function login($identifier, $password) {
        if ($this->conn == null) {
            return ['success' => false, 'message' => 'Không thể kết nối cơ sở dữ liệu! Vui lòng kiểm tra lại MySQL trong XAMPP.'];
        }

        $identifier = trim($identifier);
        if (empty($identifier) || empty($password)) {
            return ['success' => false, 'message' => 'Vui lòng nhập đầy đủ thông tin đăng nhập!'];
        }

        $user = $this->findByEmail($identifier);
        if (!$user) {
            return ['success' => false, 'message' => 'Tài khoản email quản trị viên không tồn tại!'];
        }

        if (!password_verify($password, $user->getPassword())) {
            return ['success' => false, 'message' => 'Mật khẩu quản trị viên không chính xác!'];
        }

        // Kiem tra phan quyen: Chi cho phep tai khoan co role 'admin'
        if ($user->getRole() !== 'admin') {
            return ['success' => false, 'message' => 'Tài khoản của bạn không có quyền truy cập vào Cổng Quản Trị Hệ Thống!'];
        }

        return [
            'success' => true,
            'message' => 'Đăng nhập thành công!',
            'user' => $user
        ];
    }
}
