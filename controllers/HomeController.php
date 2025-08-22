<?php 

class HomeController
{
    public $modelSanPham;   
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modeDonHang;

    public function __construct() {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modeDonHang = new DonHang();
    }

    public function home(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function chiTietSanPham() {
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);
        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFormSanPham($id);
        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamCungDanhMuc($sanPham['danh_muc_id']);
        
        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    
    public function formLogin() {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
    }

    public function postLogin(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $this->modelTaiKhoan->checkLogin($email, $password);

        // checkLogin() nên trả về thông tin user nếu đúng
        if (is_array($user)) {
            $_SESSION['user_client'] = $user; // ✅ lưu toàn bộ thông tin user
            header("Location: " . BASE_URL);
            exit();
        } else {
            $_SESSION['error'] = $user;
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
    }
}



public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaikhoanFromEmail($_SESSION['user_client']['email']);
                //Lấy dữ liệu giỏ hàng của người dùng

                // var_dump($mail['id']);die();
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);

                    $gioHang = ['id' =>$gioHangId];

                 

                } else {

                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

                }
                //    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];


                $checkSanPham = false;
                foreach ($chiTietGioHang as $detail) {
                    if ($detail['san_pham_id'] == $san_pham_id) {
                        $newSoLuong = $detail['so_luong'] + $so_luong;
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoLuong);
                        $checkSanPham = true;
                        break;
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
                }
                // var_dump('Thêm giỏ hàng thành công');die;
                header("Location: " . BASE_URL . '?act=gio-hang');
            } else {
                // var_dump('Chưa đăng nhập');
                // die;

            }
        }
    }


          public function gioHang(){
            if (isset($_SESSION['user_client'])) {

                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);

                //Lấy dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gioHang) {

                    $gioHangId = $this->modelGioHang->addGioHang($mail['id']);

                    $gioHang = ['id'=>$gioHangId];

                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

                } else {

                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

                }

                require_once './views/gioHang.php';

                }else{
                header("Location: " . BASE_URL . '?act=login');
            }
    }
    
    public function thanhToan(){
            if (isset($_SESSION['user_client'])) {

                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
                //Lấy dữ liệu giỏ hàng của người dùng
                $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
                if (!$gioHang) {
                    $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                    $gioHang = ['id'=>$gioHangId];
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                } else {
                    $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
                }
                require_once './views/thanhToan.php';

                }else{
                var_dump('Chưa đăng nhập');die;
            }
    }

    public function postThanhToan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            
            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1; // Giả sử trạng thái đơn hàng là "Đang xử lý"
            
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH - ' . rand(1000,9999); // Tạo mã đơn hàng duy nhất

            //thêm thông tin vào db 
            $this->modeDonHang->addDonHang($tai_khoan_id, $ten_nguoi_nhan, $email_nguoi_nhan, $sdt_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $tong_tien, $phuong_thuc_thanh_toan_id, $ngay_dat, $ma_don_hang);
            var_dump('Đặt hàng thành công');die;
        }
    }
}