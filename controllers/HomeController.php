<?php 

class HomeController
{
    public $modelSanPham;   
    public $modelTaiKhoan;

    public function __construct() {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
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

        if (is_array($user)) {
            // Đăng nhập thành công, $user là mảng
            $_SESSION['user_client'] = $user; // lưu email hoặc id tùy bạn
            header("Location: " . BASE_URL);
            exit();
        } else {
            // $user là chuỗi lỗi
            $_SESSION['error'] = $user; // luôn là mảng để hiển thị
            $_SESSION['flash'] = true;
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
    }
}
}