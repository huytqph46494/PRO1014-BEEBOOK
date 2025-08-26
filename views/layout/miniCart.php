<!-- offcanvas mini cart start -->
<div class="offcanvas-minicart-wrapper">
    <div class="minicart-inner">
        <div class="offcanvas-overlay"></div>
        <div class="minicart-inner-content">
            <div class="minicart-close">
                <i class="pe-7s-close"></i>
            </div>
            <div class="minicart-content-box">
                <div class="minicart-item-wrapper">
                    <ul>
                        <?php 
                        $tongMiniCart = 0;
                        if (!empty($chiTietGioHang)):
                            foreach ($chiTietGioHang as $sanPham): 
                                $gia = (!empty($sanPham['gia_khuyen_mai']) && $sanPham['gia_khuyen_mai'] > 0)
                                        ? $sanPham['gia_khuyen_mai']
                                        : $sanPham['gia_san_pham'];
                                $thanhTien = $gia * $sanPham['so_luong'];
                                $tongMiniCart += $thanhTien;
                        ?>
                        <li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="product-details.html">
                                    <img src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h3 class="product-name">
<<<<<<< HEAD

=======
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                                    <a href="#"><?= $sanPham['ten_san_pham'] ?></a>
                                </h3>
                                <p>
                                    <span class="cart-quantity"><?= $sanPham['so_luong'] ?>
                                        <strong>&times;</strong></span>
                                    <span class="cart-price"><?= formatPrice($gia) . 'đ' ?></span>
                                </p>
                            </div>
                            <button class="minicart-remove"><i class="pe-7s-close"></i></button>
                        </li>
<<<<<<< HEAD

=======
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                        <?php endforeach; else: ?>
                        <li>Giỏ hàng của bạn đang trống.</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="minicart-pricing-box">
                    <ul>
                        <li>
<<<<<<< HEAD

=======
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                            <span>Tổng phụ</span>
                            <span><strong><?= formatPrice($tongMiniCart) . 'đ' ?></strong></span>
                        </li>
                        <li>
                            <span>Vận chuyển</span>
                            <span><strong>30.000đ</strong></span>
                        </li>
                        <li class="total">
                            <span>Tổng</span>
                            <span><strong><?= formatPrice($tongMiniCart + 30000) . 'đ' ?></strong></span>
                        </li>
                    </ul>
                </div>

                <div class="minicart-button">
                    <a href="<?= BASE_URL . '?act=gio-hang' ?>"><i class="fa fa-shopping-cart"></i> Xem giỏ hàng</a>
<<<<<<< HEAD

                    <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-share"></i> Thanh toán</a>

=======
                    <a href="<?= BASE_URL . '?act=thanh-toan' ?>"><i class="fa fa-share"></i> Thanh toán</a>
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                </div>
            </div>
        </div>
    </div>
</div>
<!-- offcanvas mini cart end -->