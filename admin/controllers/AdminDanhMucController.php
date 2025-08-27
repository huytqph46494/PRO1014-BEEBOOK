<?php
class AdminDanhMucController {

    public $modelDanhMuc;

    public function __construct() {
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function danhSachDanhMuc() {
        $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
        require_once './views/danhmuc/listDanhMuc.php';
    }

    public function formAddDanhmuc() {
        // hàm này dùng để hiển thị form nhập 
        require_once './views/danhmuc/addDanhMuc.php';
    }

    public function postAddDanhmuc() {
        // hàm này dùng để sử lý thêm dữ liệu

        // Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            $ten_danh_muc = $_POST['ten_danh_muc'];
            $mo_ta = $_POST['mo_ta'];

            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];

            if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] = 'Tên danh mục không được để trống.';
            }

            if (empty($errors)) {
                $this->modelDanhMuc->insertDanhmuc($ten_danh_muc, $mo_ta);
                header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
                exit();
            } else {
                require_once './views/danhmuc/addDanhMuc.php';
            }
        }
    }

    public function formEditDanhmuc() {
        // hàm này dùng để hiển thị form nhập 
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhmuc($id);

        if ($danhMuc) {
            require_once './views/danhmuc/editDanhMuc.php';
        } else {
            header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
            exit();
        }
    }

    public function postEditDanhmuc(){
        // hàm này dùng để sử lý thêm dữ liệu
        //Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] =='POST') {
            // lấy ra dữ liệu
             $id = $_POST['id'];
            $ten_danh_muc = $_POST['ten_danh_muc'];
             $mo_ta = $_POST['mo_ta'];
             //tạo 1 mảng trống để chứa dữ liệu
             $errors =[];
             if (empty($ten_danh_muc)) {
                $errors['ten_danh_muc'] ='Tên danh mục không được để trống';
             }
             if (empty($errors)) {
                # code...
                // var_dump($_POST);
                $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
                // var_dump($_POST);
                // die();
                header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
                exit();
             }else{
                $danhMuc =['id'=>$id, 'ten_danh_muc'=>$ten_danh_muc ,'mo_ta'=>$mo_ta];
                 require_once './views/danhmuc/editDanhMuc.php';
                }
        }   
    }

    public function deleteDanhMuc() {
        $id = $_GET['id_danh_muc'];
        $danhMuc = $this->modelDanhMuc->getDetailDanhmuc($id);

        if ($danhMuc) {
            $this->modelDanhMuc->destroyDanhMuc($id);
        }

        header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
        exit();
    }
}