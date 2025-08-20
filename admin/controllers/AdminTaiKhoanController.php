<?php
class AdminTaiKhoanController{
    public $modelTaiKhoan;
     public $modelDonHang;
     public $modelSanPham;


    public function __construct()
    {
        $this->modelTaiKhoan = new AdminTaiKhoan();
         $this->modelDonHang = new AdminDonHang();
         $this->modelSanPham = new AdminSanPham();

    }

    public function danhSachQuanTri()
    {
        $listQuanTri = $this->modelTaiKhoan->getAllTaiKhoan(1);
        
        require_once './views/taikhoan/quantri/listQuantri.php';
    }

    public function formAddQuanTri(){
        require_once './views/taikhoan/quantri/addQuanTri.php';
        
        deleteSessionError();
    }

    public function postAddQuanTri() {
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy ra dữ liệu
    $ho_ten = $_POST['ho_ten'];
    $email = $_POST['email'];

    // Tạo 1 mảng trống để chứa dữ liệu
    $errors = [];
    if (empty($ho_ten)) {
        $errors['ho_ten'] = 'Tên không được để trống';
    }

    if (empty($email)) {
        $errors['email'] = 'Email không được để trống';
    }

    $_SESSION['error'] = $errors;

    if(empty($errors)){
        $password = password_hash('123@123ab', PASSWORD_BCRYPT);
         //var_dump($password);die;
        $chuc_vu_id = 1;
        $this->modelTaiKhoan->insertTaiKhoan($ho_ten, $email, $password, $chuc_vu_id);

        header("Location: " . BASE_ADMIN_URL . '?act=list-tai-khoan-quan-tri');
        exit();
    }else {
        $_SESSION[ 'flash' ] = true;

        header("Location: " . BASE_ADMIN_URL . '?act=form-them-quan-tri');
        exit();
    }
    }

    }

    public function formEditQuanTri(){

        $id_quan_tri = $_GET['id_quan_tri'];
        $quanTri = $this->modelTaiKhoan->getDetailTaiKhoan($id_quan_tri);
        
        require_once  './views/taikhoan/quantri/editQuanTri.php';
        deleteSessionError();

    }


   public function postEditQuanTri() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $quan_tri_id = $_POST['quan_tri_id'] ?? '';
        $ho_ten = $_POST['ho_ten'] ?? '';
        $email = $_POST['email'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $trang_thai = $_POST['trang_thai'] ?? '';

        $errors = [];

        if (empty($ho_ten)) {
            $errors['ho_ten'] = 'Tên người dùng không được để trống';
        }
        if (empty($email)) {
            $errors['email'] = 'Email người dùng không được để trống';
        }
        if (empty($trang_thai)) {
            $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
        }

        $_SESSION['error'] = $errors;

        if (empty($errors)) {
            $this->modelTaiKhoan->updateTaiKhoan(
                $quan_tri_id,
                $ho_ten,
                $email,
                $so_dien_thoai,
                $trang_thai
            );

            header("Location: " . BASE_ADMIN_URL . '?act=list-tai-khoan-quan-tri');
            exit();
        } else {
            $_SESSION['flash'] = true;
            header("Location: " . BASE_ADMIN_URL . '?act=form-sua-quan-tri&id_quan_tri=' . $quan_tri_id);
            exit();
        }
    }
}

 public function resetPassword(){
    // Lấy ID tài khoản từ URL
    $tai_khoan_id = $_GET['id_quan_tri'] ?? null;

    if (!$tai_khoan_id) {
        die('ID tài khoản không hợp lệ');
    }

    // Lấy thông tin tài khoản
    $tai_khoan = $this->modelTaiKhoan->getDetailTaiKhoan($tai_khoan_id);
    if (!$tai_khoan) {
        die('Tài khoản không tồn tại');
    }

    // Mật khẩu mới mặc định
    $password = password_hash('123@123ab', PASSWORD_BCRYPT);

    // Reset mật khẩu, trả về true/false
    $status = $this->modelTaiKhoan->resetPassword($tai_khoan_id, $password);

    if ($status) {
        // Redirect theo chuc_vu_id
        if ($tai_khoan['chuc_vu_id'] == 1) {
            header("Location: " . BASE_ADMIN_URL . '?act=list-tai-khoan-quan-tri');
        } else {
            header("Location: " . BASE_ADMIN_URL . '?act=list-tai-khoan-khach-hang');
        }
        exit();
    } else {
        die('Lỗi khi reset tài khoản');
    }
}


public function danhSachKhachHang()
    {
        $listKhachHang = $this->modelTaiKhoan->getAllTaiKhoan(2);
        
        require_once './views/taikhoan/khachhang/listKhachHang.php';
    }


    public function formEditKhachHang(){

        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        
        require_once  './views/taikhoan/khachhang/editKhachHang.php';
        deleteSessionError();

    }



     public function postEditKhachHang() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $khach_hang_id = $_POST['khach_hang_id'] ?? '';

         $ho_ten        = $_POST['ho_ten'] ?? '';
         $email         = $_POST['email'] ?? '';
         $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
         $ngay_sinh     = $_POST['ngay_sinh'] ?? '';
         $gioi_tinh     = $_POST['gioi_tinh'] ?? '';
         $dia_chi       = $_POST['dia_chi'] ?? '';
         $trang_thai    = $_POST['trang_thai'] ?? '';


        $errors = [];

        if (empty($ho_ten)) {
    $errors['ho_ten'] = 'Tên người dùng không được để trống';
}

if (empty($email)) {
    $errors['email'] = 'Email người dùng không được để trống';
}

if (empty($ngay_sinh)) {
    $errors['ngay_sinh'] = 'Ngày sinh người dùng không được để trống';
}

if (empty($gioi_tinh)) {
    $errors['gioi_tinh'] = 'Giới tính người dùng không được để trống';
}

if (empty($trang_thai)) {
    $errors['trang_thai'] = 'Vui lòng chọn trạng thái';
}


        $_SESSION['error'] = $errors;

        if (empty($errors)) {
           $this->modelTaiKhoan->updateKhachHang(
    $khach_hang_id,
    $ho_ten,
    $email,
    $so_dien_thoai,
    $ngay_sinh,
    $gioi_tinh,
    $dia_chi,
    $trang_thai
);


            header("Location: " . BASE_ADMIN_URL . '?act=list-tai-khoan-khach-hang');
            exit();
        } else {
            $_SESSION['flash'] = true;
            header("Location: " . BASE_ADMIN_URL . '?act=form-sua-khach-hang&id_khach_hang=' . $khach_hang_id);
            exit();
        }
    }
}
        
     public function detailKhachHang(){
        $id_khach_hang = $_GET['id_khach_hang'];
        $khachHang = $this->modelTaiKhoan->getDetailTaiKhoan($id_khach_hang);
        
        $listDonHang = $this->modelDonHang->getDonHangFromKhachHang($id_khach_hang);
        $listBinhLuan = $this->modelSanPham->getBinhLuanFromKhachHang($id_khach_hang);

        require_once './views/taikhoan/khachhang/detailKhachHang.php';

     }

     public function formLogin() {
        
        require_once './views/auth/formLogin.php';
        deleteSessionError();
     }

   public function login(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = $this->modelTaiKhoan->checkLogin($email, $password);

        if (is_array($user)) {
            // Đăng nhập thành công, $user là mảng
            $_SESSION['user_admin'] = $user['email']; // lưu email hoặc id tùy bạn
            header("Location: " . BASE_ADMIN_URL);
            exit();
        } else {
            // $user là chuỗi lỗi
            $_SESSION['error'] = [$user]; // luôn là mảng để hiển thị
            $_SESSION['flash'] = true;
            header("Location: " . BASE_ADMIN_URL . '?act=login-admin');
            exit();
        }
    }
}

     
     public function logout() {
    if (isset($_SESSION['user_admin'])) {
        unset($_SESSION['user_admin']);
                header("Location: " . BASE_ADMIN_URL . '?act=login-admin');
        exit();
        return true; 
    }
}
      public function formEditCaNhanQuanTri(){
    if (isset($_SESSION['user_admin'])) {
        $email = $_SESSION['user_admin'];
        $thongTin = $this->modelTaiKhoan->getTaiKhoanformEmail($email);
        require_once './views/taikhoan/canhan/editCaNhan.php';
        deleteSessionError();
    } else {
        // Chưa đăng nhập -> chuyển về trang login
        header("Location: " . BASE_ADMIN_URL . '?act=login-admin');
        exit();
    }
}
public function postEditMatKhauCaNhan(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $old_pass = trim($_POST['old_pass'] ?? '');
        $new_pass = trim($_POST['new_pass'] ?? '');
        $confirm_pass = trim($_POST['confirm_pass'] ?? '');

        // Kiểm tra session
        if (!isset($_SESSION['user_admin'])) {
            header("location: " . BASE_ADMIN_URL . '?act=login-admin');
            exit();
        }

        $user = $this->modelTaiKhoan->getTaiKhoanformEmail($_SESSION['user_admin']);
        if (!$user) {
            die('Người dùng không tồn tại');
        }

        $errors = [];

        if (empty($old_pass)) {
            $errors['old_pass'] = 'Vui lòng điền mật khẩu cũ';
        } elseif (!password_verify($old_pass, $user['mat_khau'])) {
            $errors['old_pass'] = 'Mật khẩu cũ không đúng';
        }

        if (empty($new_pass)) {
            $errors['new_pass'] = 'Vui lòng điền mật khẩu mới';
        }

        if (empty($confirm_pass)) {
            $errors['confirm_pass'] = 'Vui lòng xác nhận mật khẩu';
        } elseif ($new_pass !== $confirm_pass) {
            $errors['confirm_pass'] = 'Mật khẩu xác nhận không trùng';
        }

        $_SESSION['error'] = $errors;

        if (empty($errors)) {
            $hashPass = password_hash($new_pass, PASSWORD_BCRYPT);
            $status = $this->modelTaiKhoan->resetPassword($user['id'], $hashPass);
            if ($status) {
                $_SESSION['success'] = "Đã đổi mật khẩu thành công";
                $_SESSION['flash'] = true;
                header("location: " . BASE_ADMIN_URL . '?act=sua-mat-khau-ca-nhan-quan-tri');
                exit();
            } else {
                die('Lỗi khi cập nhật mật khẩu');
            }
        } else {
            $_SESSION['flash'] = true;
            header("location: " . BASE_ADMIN_URL . '?act=sua-mat-khau-ca-nhan-quan-tri');
            exit();
        }
    }
}


}

