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
                    return $user; 
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
}
 public function getTaiKhoanFromEmail($email) {
        try {

            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

public function addTaiKhoan($ho_ten, $email, $mat_khau) {
    try {
        $sql = 'INSERT INTO tai_khoans (ho_ten, email, mat_khau, chuc_vu_id, trang_thai) VALUES (:ho_ten, :email, :mat_khau, :chuc_vu_id, :trang_thai)';
        $stmt = $this->conn->prepare($sql);
        $hashed_password = password_hash($mat_khau, PASSWORD_DEFAULT);
        $stmt->execute([
            ':ho_ten' => $ho_ten,
            ':email' => $email,
            ':mat_khau' => $hashed_password,
            ':chuc_vu_id' => 2,
            ':trang_thai' => 1
        ]);
        return true;
    } catch (Exception $e) {
        error_log("Lỗi thêm tài khoản: " . $e->getMessage(), 3, PATH_ROOT . '/logs/error.log');
        return false;
    }
}
    
}