<?php 

class HomeController
{
    public $modelSanPham;   

    public function __construct() {
        $this->modelSanPham = new SanPham();
    }

    public function home(){
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function trangChu(){
        echo "Chào mừng bạn đến với Trang Chủ!";
    
}
}