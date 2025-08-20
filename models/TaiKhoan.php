<?php
class TaiKhoan{
    public $conn;

    public function __construct() 
    {
        $this->conn = connectDB();
    }
    public function checkLogin($email, $mat_khau) {
    try {
        $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($mat_khau, $user['mat_khau'])) {
            if ($user['chuc_vu_id'] == 2) { // là client
                if ($user['trang_thai'] == 1) {
                    return $user; // ✅ trả về mảng user đầy đủ
                } else {
                    return "Tài khoản đã bị cấm";
                }
            } else {
                return "Không phải tài khoản quản trị";
            }
        } else {
            return "Email hoặc mật khẩu không đúng";
        }
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
        return false;
    }
}}