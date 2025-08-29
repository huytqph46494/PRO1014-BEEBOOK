<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main>
    <div class="shop-area section-padding">
        <div class="container">
            <div class="row">
                <!-- Sidebar Start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="shop-sidebar p-3 bg-light rounded shadow-sm">
                        <!-- Categories -->
                        <div class="widget widget-categories mb-30">
                            <h4 class="widget-title border-bottom pb-2 mb-3">Danh mục sản phẩm</h4>
                            <ul class="list-unstyled">
                                <?php foreach ($listDanhMuc as $danhMuc): ?>
                                <li class="mb-2">
                                    <a href="<?= BASE_URL . '?act=danh-sach-san-pham&danh_muc_id=' . $danhMuc['id'] ?>"
                                        class="text-decoration-none text-dark fw-semibold d-block p-1 rounded hover-cat">
                                        <?= $danhMuc['ten_danh_muc'] ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Price Filter -->
                        <div class="widget widget-price mb-30">
                            <h4 class="widget-title border-bottom pb-2 mb-3">Lọc theo giá</h4>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="<?= BASE_URL . '?act=danh-sach-san-pham&price=0-100000' ?>"
                                        class="filter-link">Dưới 100.000đ</a></li>
                                <li class="mb-2"><a
                                        href="<?= BASE_URL . '?act=danh-sach-san-pham&price=100000-500000' ?>"
                                        class="filter-link">100.000 - 500.000đ</a></li>
                                <li class="mb-2"><a
                                        href="<?= BASE_URL . '?act=danh-sach-san-pham&price=500000-1000000' ?>"
                                        class="filter-link">500.000 - 1.000.000đ</a></li>
                                <li class="mb-2"><a
                                        href="<?= BASE_URL . '?act=danh-sach-san-pham&price=1000000-10000000' ?>"
                                        class="filter-link">Trên 1.000.000đ</a></li>
                            </ul>
                        </div>
                    </aside>
                </div>
                <!-- Sidebar End -->

                <!-- Product List Start -->
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="row mb-30">
                        <div class="col-12">
                            <div class="section-title text-center">
                                <h2 class="title fw-bold">✨ Danh sách sản phẩm ✨</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <?php if (!empty($listSanPham)): ?>
                        <?php foreach ($listSanPham as $sanPham): ?>
                        <div class="col-sm-6 col-lg-4 mb-30">
                            <div class="product-card rounded overflow-hidden shadow-sm bg-white position-relative">
                                <!-- Badge -->
                                <div class="position-absolute top-0 start-0 p-2">
                                    <?php
                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                    $ngayHienTai = new DateTime();
                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);
                                    if ($tinhNgay->days <= 7): ?>
                                    <span class="badge bg-success px-2 py-1 me-1">Mới</span>
                                    <?php endif; ?>
                                    <?php if ($sanPham['gia_khuyen_mai']): ?>
                                    <span class="badge bg-danger px-2 py-1">Giảm giá</span>
                                    <?php endif; ?>
                                </div>

                                <!-- Hình ảnh -->
                                <div class="product-img overflow-hidden">
                                    <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                            alt="<?= $sanPham['ten_san_pham'] ?>" class="w-100 img-fluid product-hover">
                                    </a>
                                </div>

                                <!-- Nội dung -->
                                <div class="p-3 text-center">
                                    <h6 class="fw-semibold text-truncate mb-2">
                                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"
                                            class="text-dark text-decoration-none">
                                            <?= $sanPham['ten_san_pham'] ?>
                                        </a>
                                    </h6>

                                    <div class="price-box mb-2">
                                        <?php if ($sanPham['gia_khuyen_mai']): ?>
                                        <span
                                            class="text-danger fw-bold fs-5"><?= formatPrice($sanPham['gia_khuyen_mai']) ?>đ</span>
                                        <span
                                            class="text-muted text-decoration-line-through ms-2"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
                                        <?php else: ?>
                                        <span
                                            class="text-danger fw-bold fs-5"><?= formatPrice($sanPham['gia_san_pham']) ?>đ</span>
                                        <?php endif; ?>
                                    </div>

                                    <a class="btn btn-cart2"
                                        href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                        Xem chi tiết
                                    </a>

                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <p class="text-center">Hiện tại chưa có sản phẩm nào.</p>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination Start -->
                    <?php if ($tongTrang > 1): ?>
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination justify-content-center mt-20">
                                <?php for ($i = 1; $i <= $tongTrang; $i++): ?>
                                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                                    <a class="page-link"
                                        href="<?= BASE_URL . '?act=danh-sach-san-pham&page=' . $i ?>"><?= $i ?></a>
                                </li>
                                <?php endfor; ?>
                            </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                    <!-- Pagination End -->
                </div>
                <!-- Product List End -->
            </div>
        </div>
    </div>
</main>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>

<style>
/* Card sản phẩm */
.product-card {
    transition: all 0.3s ease;
    border: 1px solid #eee;
}

.product-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
}

/* Ảnh sản phẩm */
.product-hover {
    transition: transform 0.4s ease;
}

.product-card:hover .product-hover {
    transform: scale(1.05);
}

/* Nút thêm giỏ */
.add-cart-btn {
    opacity: 0;
    transition: opacity 0.3s ease, transform 0.3s ease;
    transform: translateY(10px);
}

.product-card:hover .add-cart-btn {
    opacity: 1;
    transform: translateY(0);
}

/* Sidebar */
.hover-cat:hover {
    background: #ffe8e8;
    color: #d60000 !important;
}

.filter-link {
    text-decoration: none;
    color: #333;
    font-weight: 500;
}

.filter-link:hover {
    color: #d60000;
}

/* Badge */
.badge {
    font-size: 0.75rem;
    border-radius: 6px;
}
</style>



<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>