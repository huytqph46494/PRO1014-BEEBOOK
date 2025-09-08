<?php
class AdminBaoCaoThongKe {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    public function countDonHang() {
        $sql = "SELECT COUNT(*) FROM don_hangs";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function countDanhMuc() {
        $sql = "SELECT COUNT(*) FROM danh_mucs";
        return $this->conn->query($sql)->fetchColumn();
    }

   public function countKhachHang() {
    $sql = "SELECT COUNT(*) FROM tai_khoans WHERE chuc_vu_id = 2 AND trang_thai = 1";
    // trang_thai = 1 giả sử là đang hoạt động (bạn có thể chỉnh nếu khác)
    return $this->conn->query($sql)->fetchColumn();
}


    public function countSanPham() {
        $sql = "SELECT COUNT(*) FROM san_phams";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function doanhThuHomNay() {
        $sql = "SELECT SUM(tong_tien) FROM don_hangs WHERE DATE(ngay_dat) = CURDATE()";
        return $this->conn->query($sql)->fetchColumn() ?? 0;
    }

    public function doanhThuTuan() {
        $sql = "SELECT SUM(tong_tien) FROM don_hangs WHERE WEEK(ngay_dat, 1) = WEEK(CURDATE(), 1) AND YEAR(ngay_dat) = YEAR(CURDATE())";
        return $this->conn->query($sql)->fetchColumn() ?? 0;
    }

    public function doanhThuThang() {
        $sql = "SELECT SUM(tong_tien) FROM don_hangs WHERE MONTH(ngay_dat) = MONTH(CURDATE()) AND YEAR(ngay_dat) = YEAR(CURDATE())";
        return $this->conn->query($sql)->fetchColumn() ?? 0;
    }

    public function doanhThuNam() {
        $sql = "SELECT SUM(tong_tien) FROM don_hangs WHERE YEAR(ngay_dat) = YEAR(CURDATE())";
        return $this->conn->query($sql)->fetchColumn() ?? 0;
    }
}