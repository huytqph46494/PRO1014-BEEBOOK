<?php
class SanPham {
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllSanPham(){
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            ';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

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

    public function getBinhLuanFormSanPham($id) {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten, tai_khoans.anh_dai_dien
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

    public function getListSanPhamCungDanhMuc($danh_muc_id){
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc 
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            WHERE san_phams.danh_muc_id = '. $danh_muc_id;
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function getAllDanhMuc() {
        try {
            $sql = 'SELECT * FROM danh_mucs';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // 1. Phân trang toàn bộ sản phẩm
public function getSanPhamPhanTrang($limit, $offset) {
    try {
        $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                LIMIT :limit OFFSET :offset';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// 2. Đếm tổng sản phẩm
public function countAllSanPham() {
    try {
        $sql = 'SELECT COUNT(*) FROM san_phams';
        $stmt = $this->conn->query($sql);
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// 3. Sản phẩm theo danh mục có phân trang
public function getSanPhamByDanhMucPhanTrang($danh_muc_id, $limit, $offset) {
    try {
        $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.danh_muc_id = :danh_muc_id
                LIMIT :limit OFFSET :offset';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':danh_muc_id', $danh_muc_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// 4. Đếm sản phẩm theo danh mục
public function countSanPhamByDanhMuc($danh_muc_id) {
    try {
        $sql = 'SELECT COUNT(*) FROM san_phams WHERE danh_muc_id = :danh_muc_id';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':danh_muc_id' => $danh_muc_id]);
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// 5. Lọc sản phẩm theo giá
public function getSanPhamByGia($minPrice, $maxPrice, $limit, $offset) {
    try {
        $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE IF(gia_khuyen_mai > 0, gia_khuyen_mai, gia_san_pham) BETWEEN :minPrice AND :maxPrice
                LIMIT :limit OFFSET :offset';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
        $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


// 6. Đếm sản phẩm theo khoảng giá
public function countSanPhamByGia($minPrice, $maxPrice) {
    try {
        $sql = 'SELECT COUNT(*) FROM san_phams 
                WHERE IF(gia_khuyen_mai > 0, gia_khuyen_mai, gia_san_pham) BETWEEN :minPrice AND :maxPrice';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':minPrice' => $minPrice,
            ':maxPrice' => $maxPrice
        ]);
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


// 7. Lọc theo danh mục + giá
public function getSanPhamByDanhMucVaGia($danh_muc_id, $minPrice, $maxPrice, $limit, $offset) {
    try {
        $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                WHERE san_phams.danh_muc_id = :danh_muc_id 
                AND IF(gia_khuyen_mai > 0, gia_khuyen_mai, gia_san_pham) BETWEEN :minPrice AND :maxPrice
                LIMIT :limit OFFSET :offset';
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':danh_muc_id', $danh_muc_id, PDO::PARAM_INT);
        $stmt->bindValue(':minPrice', $minPrice, PDO::PARAM_INT);
        $stmt->bindValue(':maxPrice', $maxPrice, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}


// 8. Đếm theo danh mục + giá
public function countSanPhamByDanhMucVaGia($danh_muc_id, $minPrice, $maxPrice) {
    try {
        $sql = 'SELECT COUNT(*) FROM san_phams 
                WHERE danh_muc_id = :danh_muc_id 
                AND IF(gia_khuyen_mai > 0, gia_khuyen_mai, gia_san_pham) BETWEEN :minPrice AND :maxPrice';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':danh_muc_id' => $danh_muc_id,
            ':minPrice' => $minPrice,
            ':maxPrice' => $maxPrice
        ]);
        return $stmt->fetchColumn();
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}

// public function getBinhLuanBySanPham($san_pham_id) {
//     try {
//         $sql = "SELECT b.noi_dung, b.ngay_tao, t.ho_ten
//                 FROM binh_luans b
//                 JOIN tai_khoans t ON b.tai_khoan_id = t.id
//                 WHERE b.san_pham_id = :san_pham_id
//                 ORDER BY b.id DESC";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute([':san_pham_id' => $san_pham_id]);
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     } catch (Exception $e) {
//         echo "Lỗi: " . $e->getMessage();
//     }
// }


public function addBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung, $ngay_dang) {
    try {
        $sql = "INSERT INTO binh_luans (san_pham_id, tai_khoan_id, noi_dung, ngay_dang) 
                VALUES (:san_pham_id, :tai_khoan_id, :noi_dung, :ngay_dang)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':san_pham_id', $san_pham_id);
        $stmt->bindParam(':tai_khoan_id', $tai_khoan_id);
        $stmt->bindParam(':noi_dung', $noi_dung);
        $stmt->bindParam(':ngay_dang', $ngay_dang);
        return $stmt->execute();
    } catch (PDOException $e) {
        return false;
    }
}






}