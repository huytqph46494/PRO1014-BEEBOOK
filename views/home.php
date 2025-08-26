<?php require_once 'layout/header.php'; ?>

<?php require_once 'layout/menu.php'; ?>

<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">

                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/banner.png">
                    <div class="container">
                        <div class="row">
                            <!-- nội dung slide 1 -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item end -->

            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">

                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/banner2.png">

                    <div class="container">
                        <div class="row">
                            <!-- nội dung slide 2 -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item end -->
        </div>
    </section>
    <!-- hero slider area end -->
</main>

<!-- service policy area start -->
<div class="service-policy section-padding">
    <div class="container">
        <div class="row mtn-30">
            <div class="col-sm-6 col-lg-3">
                <div class="policy-item">
                    <div class="policy-icon">
                        <i class="pe-7s-plane"></i>
                    </div>
                    <div class="policy-content">
                        <h6>Giao hàng</h6>
                        <p>Miễn phí giao hàng</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="policy-item">
                    <div class="policy-icon">
                        <i class="pe-7s-help2"></i>
                    </div>
                    <div class="policy-content">
                        <h6>Hỗ trợ</h6>
                        <p>Hỗ trợ 24/7</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="policy-item">
                    <div class="policy-icon">
                        <i class="pe-7s-back"></i>
                    </div>
                    <div class="policy-content">
                        <h6>Hoàn tiền</h6>
                        <p>Hoàn tiền trong 30 ngày khi lỗi</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="policy-item">
                    <div class="policy-icon">
                        <i class="pe-7s-credit"></i>
                    </div>
                    <div class="policy-content">
                        <h6>Thanh toán</h6>
                        <p>Bảo mật thanh toán</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- service policy area end -->

<!-- banner statistics area start -->
<div class="banner-statistics-area">
    <div class="container">
        <div class="row row-20 mtn-20">
            <div class="col-sm-6">
                <figure class="banner-statistics mt-20">
                    <a href="#">

                        <img src="assets/img/slider/banner.png" alt="product banner">
                    </a>
                </figure>
            </div>
            <div class="col-sm-6">
                <figure class="banner-statistics mt-20">
                    <a href="#">

                        <img src="assets/img/slider/banner2.png" alt="product banner">
                    </a>
                </figure>
            </div>

        </div>
    </div>
</div>
<!-- banner statistics area end -->

<!-- product area start -->
<section class="product-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">
                    <h2 class="title">Sản phẩm của chúng tôi</h2>

                    <p class="sub-title">"Một cuốn sách, ngàn tri thức."</p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-container">

                    <!-- product tab content start -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab1">
                            <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                <?php foreach($listSanPham as $key => $sanPham): ?>
                                <!-- product item start -->
                                <div class="product-item">
                                    <figure class="product-thumb">
                                        <a
                                            href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>">
                                            <img class="pri-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                alt="product">
                                            <img class="sec-img" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>"
                                                alt="product">
                                        </a>
                                        <div class="product-badge">

                                            <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                   if ($tinhNgay->days <= 7) {
                                                ?>
                                            <div class="product-label new">
                                                <span>Mới</span>
                                            </div>
                                            <?php
                                                 }
                                                ?>

                                            <?php if ($sanPham['gia_khuyen_mai']){ ?>
                                            <div class="product-label discount">
                                                <span>Giảm giá</span>
                                            </div>

                                            <?php }?>
                                        </div>
                                        <div class="cart-hover">
                                            <button class="btn btn-cart">Xem chi tiết</button>
                                        </div>
                                    </figure>
                                    <div class="product-caption text-center">

                                        <h6 class="product-name">
                                            <a
                                                href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id'] ?>"><?= $sanPham['ten_san_pham']  ?></a>
                                        </h6>
                                        <div class="price-box">
                                            <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                            <!-- Giá khuyến mãi -->
                                            <span style="color:red; font-weight:bold;">
                                                <?= formatPrice($sanPham['gia_khuyen_mai']) . 'đ' ?>
                                            </span>

                                            <!-- Giá gốc có gạch ngang -->
                                            <span style="text-decoration: line-through; color:#999; margin-left:8px;">
                                                <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                            </span>
                                            <?php } else { ?>
                                            <!-- Trường hợp không có khuyến mãi thì chỉ hiện giá gốc -->
                                            <span style="color:red; font-weight:bold;">
                                                <?= formatPrice($sanPham['gia_san_pham']) . 'đ' ?>
                                            </span>
                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>


                                <!-- product item end -->

                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                    <!-- product tab content end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product area end -->

<!-- product banner statistics area start -->

<!-- product banner statistics area end -->

<!-- featured product area start -->

<!-- featured product area end -->

<!-- testimonial area start -->
<section class="testimonial-area section-padding bg-img" data-bg="assets/img/testimonial/banner3.png">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- section title start -->
                <div class="section-title text-center">

                    <h2 class="title">Những Câu Nói Hay Về Sách</h2>
                    <p class="sub-title">- Từ những tác giả vĩ đại - </p>
                </div>
                <!-- section title start -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="testimonial-thumb-wrapper">
                    <div class="testimonial-thumb-carousel">
                        <div class="testimonial-thumb">

                            <img src="assets/img/testimonial/tacgia.jpg" alt="testimonial-thumb">
                        </div>
                        <div class="testimonial-thumb">
                            <img src="assets/img/testimonial/tacgia2.jpg" alt="testimonial-thumb">
                        </div>
                        <div class="testimonial-thumb">
                            <img src="assets/img/testimonial/tacgia3.jpg" alt="testimonial-thumb">
                        </div>
                        <div class="testimonial-thumb">
                            <img src="assets/img/testimonial/tacgia4.jpg" alt="testimonial-thumb">
                        </div>
                    </div>
                </div>
                <div class="testimonial-content-wrapper">
                    <div class="testimonial-content-carousel">
                        <div class="testimonial-content">

                            <p>“Một cuốn sách là giấc mơ mà bạn cầm trong tay, là nơi chứa đựng trí tuệ và tưởng tượng
                                vô hạn mà bất kỳ ai cũng có thể bước vào và sống cùng nó.”</p>
                            <div class="ratings">
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                            </div>

                            <h5 class="testimonial-author">Neil Gaiman</h5>
                        </div>
                        <div class="testimonial-content">
                            <p>“Không có người bạn nào trung thành và kiên nhẫn như một cuốn sách. Nó im lặng lắng nghe,
                                sẵn sàng đồng hành, và luôn mở ra cánh cửa tri thức bất cứ khi nào ta cần đến.”</p>
                            <div class="ratings">
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                            </div>

                            <h5 class="testimonial-author">Ernest Hemingway</h5>
                        </div>
                        <div class="testimonial-content">
                            <p>“Sách mở rộng tâm trí, bồi dưỡng tâm hồn, làm giàu trí tưởng tượng và đưa chúng ta đến
                                những chân trời chưa từng đặt chân đến.”</p>
                            <div class="ratings">
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                            </div>

                            <h5 class="testimonial-author">Voltaire</h5>
                        </div>
                        <div class="testimonial-content">
                            <p>“Người đọc sách được sống hàng ngàn cuộc đời trong mỗi trang giấy. Người không đọc sách
                                chỉ sống duy nhất cuộc đời của chính mình, nghèo nàn và hạn hẹp.”</p>
                            <div class="ratings">
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                                <span><i class="fa fa-star-o"></i></span>
                            </div>

                            <h5 class="testimonial-author">George R.R. Martin</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</main>

<?php require_once 'layout/miniCart.php'; ?>
<?php require_once 'layout/footer.php'; ?>