<?php require_once 'views/layout/header.php'; ?>

<?php require_once 'views/layout/menu.php'; ?>

<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">login</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- login register wrapper start -->
    <div class="login-register-wrapper section-padding">
        <div class="container" style="max-width: 40vw;">
            <div class="member-area-from-wrap">
                <div class="row">
                    <!-- Login Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap">
                            <h5 class="text-center">ĐĂNG NHẬP</h5>
                            <br>
                            <p class="login-box-msg text-center">Vui lòng đăng nhập</p>

                            <?php if (isset($_SESSION['error'])): ?>
                            <?php if (is_array($_SESSION['error'])): ?>
                            <?php foreach ($_SESSION['error'] as $err): ?>
                            <p class="text-danger login-box-msg text-center"><?= $err ?></p>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <p class="text-danger login-box-msg text-center"><?= $_SESSION['error'] ?></p>
                            <?php endif; ?>
                            <?php unset($_SESSION['error']); // hiển thị xong thì xóa để reload không hiện lại ?>
                            <?php endif; ?>

                            <form action="<?= BASE_URL . '?act=check_login' ?>" method="post">
                                <div class="single-input-item">
                                    <input type="email" placeholder="Nhập email của bạn..." name="email" required />
                                </div>
                                <div class="single-input-item">
                                    <input type="password" placeholder="Nhập password của bạn..." name="password"
                                        required />
                                </div>
                                <div class="single-input-item">
                                    <div class="login-reg-form-meta d-flex align-items-center justify-content-between">
                                        <a href="#" class="forget-pwd">Quên mật khẩu?</a>
                                    </div>

                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng nhập</button>
                                </div>
                                <div class="single-input-item">
                                    <p>Chưa có tài khoản? <a class="forget-pwd"
                                            href="<?= BASE_URL . '?act=register' ?>">Đăng ký</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Login Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>

<?php require_once 'views/layout/footer.php'; ?>