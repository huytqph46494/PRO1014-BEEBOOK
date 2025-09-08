<?php
require_once './models/AdminBaoCaoThongKe.php';

class AdminBaoCaoThongKeController {
    public function home() {
        $thongKe = new AdminBaoCaoThongKe();

        $soDonHang = $thongKe->countDonHang();
        $soDanhMuc = $thongKe->countDanhMuc();
        $soKhachHang = $thongKe->countKhachHang();
        $soSanPham = $thongKe->countSanPham();

        $doanhThuHomNay = $thongKe->doanhThuHomNay();
        $doanhThuTuan = $thongKe->doanhThuTuan();
        $doanhThuThang = $thongKe->doanhThuThang();
        $doanhThuNam = $thongKe->doanhThuNam();

        require_once './views/home.php';
    }
}