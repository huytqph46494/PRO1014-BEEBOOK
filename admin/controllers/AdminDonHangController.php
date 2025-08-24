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

    public function detailDonHang(){
        $don_hang_id = $_GET['id_don_hang'];
        
        //lấy thông tin đơn hàng o0wr bảng don_hangs 
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        //lấy danh sách sản phẩm đã đặt của đơn hàng ở bảng chi_tiet_don_hangs
        
        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        require_once './views/donhang/detailDonHang.php';


    }


    public function formEditDonHang() {
        
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location: " . BASE_ADMIN_URL . '?act=san-pham');
            exit();
        }
    }

    public function postEditDonHang() {
        // hàm này dùng để sử lý thêm dữ liệu

        // Kiểm tra xem dữ liệu có phải được submit lên không
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy ra dữ liệu
            // lấy ra dl cũ của sp
            $don_hang_id = $_POST['don_hang_id'] ?? '';

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';




            // tạo 1 mảng trống để chứa dữ liệu
            $errors = [];


            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = 'Tên  người nhận không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = 'SDT người nhận không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = 'Email người nhận không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = 'Địa chỉ người nhận không được để trống';
            }
            if (empty($trang_thai_id)) {
                $errors['trang_thai_id'] = 'Trạng thái đơn hàng';
            }
            $_SESSION['error'] = $errors;
      


            // nếu không có lỗi thì tiến hành sửa
            if (empty($errors)) {
                // var_dump($_POST);
                $this->modelDonHang->updateDonHang(
                    $don_hang_id,
                    $ten_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $email_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $trang_thai_id
                );

                header("Location: " . BASE_ADMIN_URL . '?act=don-hang');
                exit();
            } else {
                // đặt chỉ thị xóa session sau hiển thị form
                $_SESSION['flash'] = true;
                header("Location: " . BASE_ADMIN_URL . '?act=form-sua-don-hang&id_don_hang=' . $don_hang_id);
            }
        }   
    }

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