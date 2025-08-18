<?php
class AdminSanPham {
    public $conn;

    public function __construct() {
        $this->conn = connectDB();
    }

    // Lấy danh sách tất cả sản phẩm kèm tên danh mục
    public function getAllSanPham() {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Thêm sản phẩm mới, trả về ID sản phẩm vừa thêm
    public function insertSanPham(
        $ten_san_pham,
        $gia_san_pham,
        $gia_khuyen_mai,
        $so_luong,
        $ngay_nhap,
        $danh_muc_id,
        $trang_thai,
        $mo_ta,
        $hinh_anh
    ) {
        try {
            $sql = 'INSERT INTO san_phams 
                (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh)
                VALUES 
                (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :trang_thai, :mo_ta, :hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
            ]);
            
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Thêm ảnh album cho sản phẩm
    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh) {
        try {
            $sql = 'INSERT INTO hinh_anh_san_phams (san_pham_id, link_hinh_anh)
                    VALUES (:san_pham_id, :link_hinh_anh)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Lấy chi tiết một sản phẩm theo ID
    public function getDetailSanPham($id) {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE san_phams.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Lấy danh sách ảnh của sản phẩm theo ID sản phẩm
    public function getListAnhSanPham($id) {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Cập nhật thông tin sản phẩm
    public function updateSanPham(
        $san_pham_id,
        $ten_san_pham,
        $gia_san_pham,
        $gia_khuyen_mai,
        $so_luong,
        $ngay_nhap,
        $danh_muc_id,
        $trang_thai,
        $mo_ta,
        $hinh_anh
    ) {
        try {
            $sql = 'UPDATE san_phams
                    SET ten_san_pham = :ten_san_pham,
                        gia_san_pham = :gia_san_pham,
                        gia_khuyen_mai = :gia_khuyen_mai,
                        so_luong = :so_luong,
                        ngay_nhap = :ngay_nhap,
                        danh_muc_id = :danh_muc_id,
                        trang_thai = :trang_thai,
                        mo_ta = :mo_ta,
                        hinh_anh = :hinh_anh
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Lấy chi tiết 1 ảnh trong album theo ID ảnh
    public function getDetailAnhSanPham($id) {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Cập nhật link ảnh album
    public function updateAnhSanPham($id, $new_file) {
        try {
            $sql = 'UPDATE hinh_anh_san_phams
                    SET link_hinh_anh = :new_file
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':new_file' => $new_file,
                ':id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Xóa ảnh album theo ID ảnh
    public function destroyAnhSanPham($id) {
        try {
            $sql = 'DELETE FROM hinh_anh_san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function destroySanPham($id) {
        try {
            $sql = 'DELETE FROM san_phams WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getBinhLuanFromKhachHang($id) {
        try {
            $sql = 'SELECT binh_luans.*, san_phams.ten_san_pham
                    FROM binh_luans
                    INNER JOIN san_phams ON binh_luans.san_pham_id = san_phams.id 
                    WHERE binh_luans.tai_khoan_id = :id
                    
                    ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
  public function getBinhLuanFormSanPham($id) {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten 
                    FROM binh_luans
                    INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id 
                    WHERE binh_luans.san_pham_id = :id
                    
                    ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id'=>$id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
     public function getDetailBinhLuan($id) {
        try {
            $sql = 'SELECT * FROM binh_luans WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

       public function updateTrangThaiBinhLuan($id, $trang_thai) {
        try {
            $sql = 'UPDATE binh_luans
                    SET trang_thai = :trang_thai
                    WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':trang_thai' => $trang_thai,
                ':id' => $id,
            ]);
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}