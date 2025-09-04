<?php 

class HomeController
{
    public $modelSanPham;   
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;


    public function __construct() {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();

    }

    public function home(){
          $this->loadMiniCartData(); // <== GỌI TRƯỚC KHI GỌI VIEW
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

       public function themBinhLuan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $san_pham_id = $_POST['san_pham_id'];
                $noi_dung = $_POST['noi_dung'];
                $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
                $tai_khoan_id = $user['id'];
                $ngay_dang = date('Y-m-d H:i:s');

                if (!empty($noi_dung)) {
                    $result = $this->modelSanPham->addBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_dang);
                    if ($result) {
                        $_SESSION['success'] = "Bình luận thành công!";
                    } else {
                        $_SESSION['error'] = "Bình luận thất bại, vui lòng thử lại!";
                    }
                } else {
                    $_SESSION['error'] = "Nội dung bình luận không được để trống!";
                }
                header("Location: " . BASE_URL . "?act=chi-tiet-san-pham&id_san_pham=" . $san_pham_id);
                exit();
            } else {
                $_SESSION['error'] = "Vui lòng đăng nhập để bình luận!";
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
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
            $donHangId = $this->modelDonHang->addDonHang($tai_khoan_id,
             $ten_nguoi_nhan,
              $email_nguoi_nhan, 
              $sdt_nguoi_nhan, 
              $dia_chi_nguoi_nhan,
               $ghi_chu, $tong_tien, 
               $phuong_thuc_thanh_toan_id, 
               $ngay_dat, $ma_don_hang,
            $trang_thai_id
        );
        //lấy giỏ hàng của người dùng
         $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);

         //lây sản phẩm chi tiết đơn hàng
         if ($donHangId) {
            //lấy ra toàn bộ sản phẩm trong giỏ hàng
           $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

           // thêm từng sp từ giỏ hàng vào bảng chi tiết đơn hàng
           foreach($chiTietGioHang as $item){
               $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham']; //ƯU tiên đơn giá sẽ lấy giá khuyến mãi

               $this->modelDonHang->addChiTietDonHang(
                $donHangId,
                $item['san_pham_id'],
                $donGia,
                $item['so_luong'],
                $donGia * $item['so_luong']

               );
           }
           $this->modelGioHang->clearDetailGioHang($gioHang['id']);

            $this->modelGioHang->clearGioHang($tai_khoan_id);

            //chuyển hướng về trang lịch sử mua hàng
            
            header("Location:" . BASE_URL . '?act=lich-su-mua-hang');
            exit;
         } else{
            var_dump('lỗi đặg hàng vui lòng thử lại sau!');
            die;
         }
          
        }
    }

    public function lichSuMuaHang(){
        if (isset($_SESSION['user_client'])) {
            //Lấy ra thông tin user
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            $tai_khoan_id = $user['id'];
            
            //Lấy ra danh sách trạng thái đơn hàng
            $arrtrangThaiDonHang = $this->modelDonHang->gettrangThaiDonHang();
            $trangThaiDonHang = array_column($arrtrangThaiDonHang, 'ten_trang_thai', 'id');

            //Lấy ra danh sách phương thức thanh toán
            $arrphuongThucThanhToan = $this->modelDonHang->getphuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrphuongThucThanhToan, 'ten_phuong_thuc', 'id');

            //Lấy ra danh sách tất cả đơn hàng của tài khoản
            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
            require_once "./views/lichSuMuaHang.php";
            }else{
            var_dump('Chưa đăng nhập');die;
        }
    }

    public function chiTietMuaHang(){
        
        if (isset($_SESSION['user_client'])) {
            //Lấy ra thông tin user
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            $tai_khoan_id = $user['id'];
            
            //lấy id đơn hàng chuyền từ url
            $donHangId = $_GET['id'];

            //Lấy ra danh sách trạng thái đơn hàng
            $arrtrangThaiDonHang = $this->modelDonHang->gettrangThaiDonHang();
            $trangThaiDonHang = array_column($arrtrangThaiDonHang, 'ten_trang_thai', 'id');

            //Lấy ra danh sách phương thức thanh toán
            $arrphuongThucThanhToan = $this->modelDonHang->getphuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrphuongThucThanhToan, 'ten_phuong_thuc', 'id');

            //Lấy ra thông tin đơn hàng theo ID
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            //Lấy thông tin sản phẩm của đơn hàng trong bảng tri tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);

            if ($donHang['tai_khoan_id']!= $tai_khoan_id){
                echo "Bạn không có quyền truy cập đơn hàng này.";
                exit;
            }
            require_once "./views/chiTietMuaHang.php";

            
            
            }else{
            var_dump('Chưa đăng nhập');die;
        }
    }
        

    public function huyDonHang(){
        if (isset($_SESSION['user_client'])) {
            //Lấy ra thông tin user
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
            $tai_khoan_id = $user['id'];
            
            //lấy id đơn hàng chuyền từ url
            $donHangId = $_GET['id'];

            //Kiểm tra đơn hàng
            $donHangs = $this->modelDonHang->getDonHangById($donHangId);

            if($donHangs['tai_khoan_id'] != $tai_khoan_id){
                echo "Bạn không có quyền hủy đơn hàng này!";
                exit;
            }
            if($donHangs['trang_thai_id'] != 1){
                echo "Chỉ đơn hàng ở trạng thái chưa xác nhận mới có thể hủy!";
                exit;
            }

            //Hủy đơn
            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);
             header("Location:" . BASE_URL . '?act=lich-su-mua-hang');
            exit;
            
            }else{
            var_dump('Chưa đăng nhập');die;
        }
    }

     public function loadMiniCartData() {
    global $chiTietGioHang;

    $chiTietGioHang = []; // mặc định trống

    if (isset($_SESSION['user_client'])) {
        $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']['email']);
        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

        if ($gioHang) {
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
        }
    }
}

public function danhSachSanPham() {
        // Lấy danh sách danh mục
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
 
        // Lấy trang hiện tại
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 8;
        $offset = ($page - 1) * $limit;

        // Lọc danh mục
        $danh_muc_id = isset($_GET['danh_muc_id']) ? (int)$_GET['danh_muc_id'] : null;

        // Lọc giá
        $priceFilter = isset($_GET['price']) ? $_GET['price'] : null;
        $minPrice = null;
        $maxPrice = null;
        if ($priceFilter) {
            list($minPrice, $maxPrice) = explode('-', $priceFilter);
            $minPrice = (int)$minPrice;
            $maxPrice = (int)$maxPrice;
        }

        // Lấy sản phẩm theo filter & phân trang
        if ($danh_muc_id && $minPrice !== null) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMucVaGia($danh_muc_id, $minPrice, $maxPrice, $limit, $offset);
            $tongSanPham = $this->modelSanPham->countSanPhamByDanhMucVaGia($danh_muc_id, $minPrice, $maxPrice);
        } elseif ($danh_muc_id) {
            $listSanPham = $this->modelSanPham->getSanPhamByDanhMucPhanTrang($danh_muc_id, $limit, $offset);
            $tongSanPham = $this->modelSanPham->countSanPhamByDanhMuc($danh_muc_id);
        } elseif ($minPrice !== null) {
            $listSanPham = $this->modelSanPham->getSanPhamByGia($minPrice, $maxPrice, $limit, $offset);
            $tongSanPham = $this->modelSanPham->countSanPhamByGia($minPrice, $maxPrice);
        } else {
            $listSanPham = $this->modelSanPham->getSanPhamPhanTrang($limit, $offset);
            $tongSanPham = $this->modelSanPham->countAllSanPham();
        }

        $tongTrang = ceil($tongSanPham / $limit);

        require_once './views/danhSachSanPham.php';
    }

     public function logout() {
        if (isset($_SESSION['user_client'])) {
            session_unset();
            session_destroy();
        }
        header("Location: " . BASE_URL);
        exit();
    }

public function postRegister() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ho_ten = $_POST['ho_ten'];
        $email = $_POST['email'];
        $mat_khau = $_POST['mat_khau'];
        $confirm_mat_khau = $_POST['confirm_mat_khau'];

        if (empty($ho_ten) || empty($email) || empty($mat_khau)) {
            $_SESSION['error'] = "Vui lòng điền đầy đủ thông tin!";
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL . '?act=register');
            exit();
        }
        if ($mat_khau !== $confirm_mat_khau) {
            $_SESSION['error'] = "Mật khẩu xác nhận không khớp!";
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL . '?act=register');
            exit();
        }

        $existingUser = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);
        if ($existingUser) {
            $_SESSION['error'] = "Email đã được sử dụng!";
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL . '?act=register');
            exit();
        }

        $result = $this->modelTaiKhoan->addTaiKhoan($ho_ten, $email, $mat_khau);
        if ($result) {
            $_SESSION['success'] = "Đăng ký thành công! Vui lòng đăng nhập.";
            header("Location: " . BASE_URL . '?act=login');
            exit();
        } else {
            $_SESSION['error'] = "Đăng ký thất bại, vui lòng thử lại!";
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL . '?act=register');
            exit();
        }
    }
}
    public function formRegister() {
        require_once './views/auth/formRegister.php';
        deleteSessionError();
    }

    

}