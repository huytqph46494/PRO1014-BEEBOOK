<?php 

class HomeController
{
    public $modelSanPham;   

    public function __construct() {
        $this->modelSanPham = new SanPham();
    }

    public function home(){
        echo "Chào mừng bạn đến Home!";
    }

    public function trangChu(){
        echo "Chào mừng bạn đến với Trang Chủ!";
    }
    public function danhSachSanPham(){
        // Lấy danh sách sản phẩm từ model
        $listProduct = $this->modelSanPham->getAllProduct();
        // var_dump($listProduct);die();
        require_once './views/listProduct.php';
    }
}