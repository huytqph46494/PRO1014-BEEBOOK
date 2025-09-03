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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Đăng ký</li>
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
                    <!-- Register Content Start -->
                    <div class="col-lg-12">
                        <div class="login-reg-form-wrap sign-up-form">
                            <h5>Đăng ký tài khoản</h5>
                            <?php if (isset($_SESSION['error']) && $_SESSION['flash']) : ?>
                            <div class="alert alert-danger">
                                <?php echo $_SESSION['error']; ?>
                            </div>
                            <?php endif; ?>
                            <?php if (isset($_SESSION['success']) && $_SESSION['flash']) : ?>
                            <div class="alert alert-success">
                                <?php echo $_SESSION['success']; ?>
                            </div>
                            <?php endif; ?>
                            <form action="<?= BASE_URL . '?act=check_register' ?>" method="post">
                                <div class="single-input-item">
                                    <input type="text" name="ho_ten" placeholder="Họ và tên..." required />
                                </div>
                                <div class="single-input-item">
                                    <input type="email" name="email" placeholder="Nhập email của bạn..." required />
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" name="mat_khau" placeholder="Nhập mật khẩu..."
                                                required />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="single-input-item">
                                            <input type="password" name="confirm_mat_khau"
                                                placeholder="Xác nhận mật khẩu..." required />
                                        </div>
                                    </div>
                                </div>
                                <div class="single-input-item">
                                    <button class="btn btn-sqr">Đăng ký</button>
                                </div>
                                <div class="single-input-item">
                                    <p>Đã có tài khoản? <a class="forget-pwd" href="<?= BASE_URL . '?act=login' ?>">
                                            Đăng nhập</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Register Content End -->
                </div>
            </div>
        </div>
    </div>
    <!-- login register wrapper end -->
</main>

<?php require_once 'views/layout/footer.php'; ?>