<?php
class AdminSanPhamController{

    public  $modelSanPham;
    public  $modelDanhMuc;
    public function __construct() 
    {

        $this->modelSanPham = new AdminSanPham();
        $this->modelDanhMuc = new AdminDanhMuc();
    }
    public function danhSachSanPham() 
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once './views/sanpham/listSanPham.php';
    }
    public function formAddSanPham (){
         // hàm này dùng để hiển thị form nhập 

         $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

         require_once './views/sanpham/addSanPham.php';
     }
     public function postAddSanPham(){
        // hàm này dùng để sử lý thêm dữ liệu


        //Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] =='POST') {
            // lấy ra dữ liệu
            $ten_san_pham = $_POST['ten_san_pham'];
            $gia_san_pham = $_POST['gia_san_pham'];
            $gia_khuyen_mai = $_POST['gia_khuyen_mai'];
            $so_luong = $_POST['so_luong'];
            $ngay_nhap = $_POST['ngay_nhap'];
            $danh_muc_id = $_POST['danh_muc_id'];
            $trang_thai = $_POST['trang_thai'];
            $mo_ta = $_POST['mo_ta'];

            $hinh_anh = $_FILES['hinh_anh'];

            // lưu hình ảnh vào 
            $file_thumb = uploadFile($hinh_anh, './uploads/');


            // mảng hình ảnh
            $img_array = $_FILES['img_array'];

             //tạo 1 mảng trống để chứa dữ liệu
             $errors = [];

if (empty($ten_san_pham)) {
    $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
}
if (empty($gia_san_pham)) {
    $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
}
if (empty($gia_khuyen_mai)) {
    $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
}
if (empty($so_luong)) {
    $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
}
if (empty($ngay_nhap)) {
    $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
}
if (empty($danh_muc_id)) {
    $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
}
if (empty($trang_thai)) {
    $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
}

                // mếu không có lỗi thì tiến hành thêm danh mục
             
             if (empty($errors)) {
                 // mếu không có lỗi thì tiến hành thêm danh mục
                
                // var_dump($_POST);
                $this->modelSanPham->insertSanPham(
                    $ten_san_pham,
                    $gia_san_pham,
                    $gia_khuyen_mai,
                    $so_luong,
                    $ngay_nhap,
                    $danh_muc_id,
                    $trang_thai,
                    $mo_ta,
                    $file_thumb
                );
                header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
                exit();
             }else{
                 require_once './views/sanpham/addSanPham.php';
                }
        }   
    }
}

//      public function formEditDanhmuc (){
//         // hàm này dùng để hiển thị form nhập 
//         $id = $_GET['id_danh_muc'];
//        $danhMuc = $this->modelDanhMuc->getDetailDanhmuc($id);
       
//        if ($danhMuc) {
//         require_once './views/danhmuc/editDanhMuc.php';

//        }else{
//          header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
//                 exit();

//        }
//     }
//     public function postEditDanhmuc(){
//         // hàm này dùng để sử lý thêm dữ liệu
        


//         //Kiểm tra xem dữ liệu có phải được submit lên không
//         if ($_SERVER['REQUEST_METHOD'] =='POST') {
//             // lấy ra dữ liệu
//              $id = $_POST['id'];
//             $ten_danh_muc = $_POST['ten_danh_muc'];
//              $mo_ta = $_POST['mo_ta'];

//              //tạo 1 mảng trống để chứa dữ liệu
//              $errors =[];
//              if (empty($ten_danh_muc)) {
//                 $errors['ten_danh_muc'] ='Tên danh mục không được để trống';
                
//              }
//              if (empty($errors)) {
//                 # code...
//                 // var_dump($_POST);
//                 $this->modelDanhMuc->updateDanhMuc($id, $ten_danh_muc, $mo_ta);
//                 // var_dump($_POST);
//                 // die();
//                 header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
//                 exit();
//              }else{
//                 $danhMuc =['id'=>$id, 'ten_danh_muc'=>$ten_danh_muc ,'mo_ta'=>$mo_ta];
//                  require_once './views/danhmuc/editDanhMuc.php';
//                 }
//         }   
//     }

//     public function deleteDanhMuc(){
//         $id = $_GET ['id_danh_muc'];
//            $danhMuc = $this->modelDanhMuc->getDetailDanhmuc($id);
//            if($danhMuc){
//             $this->modelDanhMuc->destroyDanhMuc($id);
//            }
//               header("Location: " . BASE_ADMIN_URL . '?act=danh-muc');
//                 exit();


        
//     }
// }