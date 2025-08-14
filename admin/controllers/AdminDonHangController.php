<?php
class AdminDonHangController {

    public $modelDonHang;
    

    public function __construct() {
        $this->modelDonHang = new AdminDonHang();
        
    }

    public function danhSachDonHang() {
        $listDonHang = $this->modelDonHang->getAllDonHang();
        require_once './views/donhang/listDonHang.php';
    }


    // public function formEditSanPham() {
    //     // hàm này dùng để hiển thị form nhập 
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //     $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();

    //     if ($sanPham) {
    //         require_once './views/sanPham/editSanPham.php';
    //         deleteSessionError();
    //     } else {
    //         header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
    //         exit();
    //     }
    // }

    // public function postEditSanPham() {
    //     // hàm này dùng để sử lý thêm dữ liệu

    //     // Kiểm tra xem dữ liệu có phải được submit lên không
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         // lấy ra dữ liệu
    //         // lấy ra dl cũ của sp
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';
    //         // truy vấn 
    //         $sanPhamOld = $this->modelSanPham->getDetailSanPham($san_pham_id);
    //         $old_file = $sanPhamOld['hinh_anh'] ?? ''; // lấy ảnh cũ để phục vụ cho sửa ảnh

    //         $ten_san_pham = $_POST['ten_san_pham'] ?? '';
    //         $gia_san_pham = $_POST['gia_san_pham'] ?? '';
    //         $gia_khuyen_mai = $_POST['gia_khuyen_mai'] ?? '';
    //         $so_luong = $_POST['so_luong'] ?? '';
    //         $ngay_nhap = $_POST['ngay_nhap'] ?? '';
    //         $danh_muc_id = $_POST['danh_muc_id'] ?? '';
    //         $trang_thai = $_POST['trang_thai'] ?? '';
    //         $mo_ta = $_POST['mo_ta'] ?? '';

    //         $hinh_anh = $_FILES['hinh_anh'] ?? null;

    //         // tạo 1 mảng trống để chứa dữ liệu
    //         $errors = [];

    //         if (empty($ten_san_pham)) {
    //             $errors['ten_san_pham'] = 'Tên sản phẩm không được để trống';
    //         }
    //         if (empty($gia_san_pham)) {
    //             $errors['gia_san_pham'] = 'Giá sản phẩm không được để trống';
    //         }
    //         if (empty($gia_khuyen_mai)) {
    //             $errors['gia_khuyen_mai'] = 'Giá khuyến mãi sản phẩm không được để trống';
    //         }
    //         if (empty($so_luong)) {
    //             $errors['so_luong'] = 'Số lượng sản phẩm không được để trống';
    //         }
    //         if (empty($ngay_nhap)) {
    //             $errors['ngay_nhap'] = 'Ngày nhập sản phẩm không được để trống';
    //         }
    //         if (empty($danh_muc_id)) {
    //             $errors['danh_muc_id'] = 'Danh mục sản phẩm phải chọn';
    //         }
    //         if (empty($trang_thai)) {
    //             $errors['trang_thai'] = 'Trạng thái sản phẩm phải chọn';
    //         }

    //         $_SESSION['error'] = $errors;

    //         // logic sửa ảnh
    //         if (isset($hinh_anh) && $hinh_anh['error'] == 0) {
    //             $new_file = uploadFile($hinh_anh, './uploads/');
    //             if (!empty($old_file)) {
    //                 deleteFile($old_file); // xóa ảnh cũ nếu có
    //             }
    //         } else {
    //             $new_file = $old_file; // nếu không có ảnh mới thì giữ nguyên ảnh
    //         }

    //         // nếu có ảnh mới thì upload ảnh mới, nếu không thì giữ nguyên ảnh cũ
    //         // nếu không có lỗi thì tiến hành thêm danh mục
    //         if (empty($errors)) {
    //             // var_dump($_POST);
    //             $san_pham_id = $this->modelSanPham->updateSanPham(
    //                 $san_pham_id,
    //                 $ten_san_pham,
    //                 $gia_san_pham,
    //                 $gia_khuyen_mai,
    //                 $so_luong,
    //                 $ngay_nhap,
    //                 $danh_muc_id,
    //                 $trang_thai,
    //                 $mo_ta,
    //                 $new_file,
    //             );

    //             header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
    //             exit();
    //         } else {
    //             // đặt chỉ thị xóa session sau hiển thị form
    //             $_SESSION['flash'] = true;
    //             header("Location: " . BASE_ADMIN_URL . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
    //         }
    //     }   
    // }

    // // sửa album hình ảnh
    // // - sửa ảnh cũ 
    // //     + Thêm ảnh mới
    // //     + Không thêm ảnh mới
    // // - Không sửa ảnh cũ
    // //     + Thêm ảnh mới
    // //     + Không thêm ảnh mới
    // // - Xóa ảnh cũ
    // //     + Thêm ảnh mới
    // //     + Không thêm ảnh mới

    // public function postEditAnhSanPham() {
    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $san_pham_id = $_POST['san_pham_id'] ?? '';

    //         // Danh sách ảnh được gửi từ form
    //         $img_array = $_FILES['img_array'] ?? [];
    //         $img_delete = isset($_POST['img_delete']) ? explode(',', $_POST['img_delete']) : [];
    //         $current_img_ids = $_POST['current_img_ids'] ?? [];

    //         // Danh sách ảnh hiện tại từ DB
    //         $listAnhSanPhamCurrent = $this->modelSanPham->getListAnhSanPham($san_pham_id);

    //         $updated_file = []; // Dùng để chứa các ảnh mới hoặc update ảnh cũ

    //         // Xử lý upload ảnh mới / update ảnh cũ
    //         if (!empty($img_array['name'])) {
    //             foreach ($img_array['name'] as $key => $value) {
    //                 if ($img_array['error'][$key] == 0) {
    //                     // Chuẩn bị mảng dữ liệu ảnh
    //                     $file = [
    //                         'name' => $img_array['name'][$key],
    //                         'type' => $img_array['type'][$key],
    //                         'tmp_name' => $img_array['tmp_name'][$key],
    //                         'error' => $img_array['error'][$key],
    //                         'size' => $img_array['size'][$key]
    //                     ];

    //                     // Upload ảnh
    //                     $new_file = uploadFile($file, './uploads/');
    //                     if ($new_file) {
    //                         $updated_file[] = [
    //                             'id' => $current_img_ids[$key] ?? null, // null nếu là ảnh mới
    //                             'file' => $new_file
    //                         ];
    //                     }
    //                 }
    //             }
    //         }

    //         // Cập nhật hoặc thêm ảnh mới vào DB
    //         foreach ($updated_file as $file_info) {
    //             if (!empty($file_info['id'])) {
    //                 // Nếu có ID => update ảnh cũ
    //                 $anhCu = $this->modelSanPham->getDetailAnhSanPham($file_info['id']);
    //                 if ($anhCu) {
    //                     $old_file = $anhCu['link_hinh_anh'];
    //                     $this->modelSanPham->updateAnhSanPham($file_info['id'], $file_info['file']);
    //                     if (!empty($old_file)) {
    //                         deleteFile($old_file); // Xóa file cũ
    //                     }
    //                 }
    //             } else {
    //                 // Nếu không có ID => thêm mới ảnh
    //                 $this->modelSanPham->insertAlbumAnhSanPham($san_pham_id, $file_info['file']);
    //             }
    //         }

    //         // Xử lý xóa ảnh
    //         foreach ($listAnhSanPhamCurrent as $img) {
    //             if (in_array($img['id'], $img_delete)) {
    //                 $this->modelSanPham->deleteAnhSanPham($img['id']);
    //                 if (!empty($img['link_hinh_anh'])) {
    //                     deleteFile($img['link_hinh_anh']);
    //                 }
    //             }
    //         }

    //         header("Location: " . BASE_ADMIN_URL . '?act=form-sua-san-pham&id_san_pham=' . $san_pham_id);
    //         exit();
    //     }
    // }

    // public function xoaSanPham() {
    //     if (isset($_GET['id_san_pham'])) {
    //         $id_san_pham = $_GET['id_san_pham'];
    //         $sanPham = $this->modelSanPham->getDetailSanPham($id_san_pham);
    //         if ($sanPham) {
    //             // xóa ảnh đại diện
    //             if (!empty($sanPham['hinh_anh'])) {
    //                 deleteFile($sanPham['hinh_anh']);
    //             }

    //             // xóa album ảnh
    //             $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id_san_pham);
    //             foreach ($listAnhSanPham as $anh) {
    //                 if (!empty($anh['link_hinh_anh'])) {
    //                     deleteFile($anh['link_hinh_anh']);
    //                 }
    //             }
    //             // xóa bản ghi album ảnh
    //             $this->modelSanPham->deleteAlbumAnhSanPham($id_san_pham);

    //             // xóa bản ghi sản phẩm
    //             $this->modelSanPham->deleteSanPham($id_san_pham);
    //         }

    //         header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
    //         exit();
    //     }
    // }

    // public function deleteSanPham()
    // {
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);

    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

    //     if ($sanPham){
    //         deleteFile($sanPham['hinh_anh']);
    //         $this->modelSanPham->destroySanPham($id);
    //     }
    //     if ($listAnhSanPham){
    //         foreach($listAnhSanPham as $key=>$anhSP){
    //             deleteFile($anhSP['link_hinh_anh']);
    //             $this->modelSanPham->destroyAnhSanPham($anhSP['id']);
    //         }
    //     }
    //     header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
    //     exit();
    // }


    // public function detailSanPham() {
        
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

    //     if ($sanPham) {
    //         require_once './views/sanpham/detailSanPham.php';
    //     } else {
    //         header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
    //         exit();
    //     }
    // }
}