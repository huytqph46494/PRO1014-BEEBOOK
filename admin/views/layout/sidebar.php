<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="./assets/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Bee-Book</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= BASE_ADMIN_URL ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Trang chủ
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_ADMIN_URL . '?act=danh-muc' ?>" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Danh mục sản phẩm
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= BASE_ADMIN_URL . '?act=san-pham' ?>" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Sản phẩm
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= BASE_ADMIN_URL . '?act=don-hang' ?>" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice-dollar"></i>
                        <p>
                            Đơn Hàng
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Quản lý tài khoản
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= BASE_ADMIN_URL . '?act=list-tai-khoan-quan-tri' ?>" class="nav-link">
                                <i class="nav-icon far fa-user"></i>
                                <p>Tài khoản quản trị</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_ADMIN_URL . '?act=list-tai-khoan-khach-hang' ?>" class="nav-link">
                                <i class="nav-icon far fa-user"></i>
                                <p>Tài khoản khách hàng</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= BASE_ADMIN_URL . '?act=form-sua-thong-tin-ca-nhan-quan-tri' ?>"
                                class="nav-link">
                                <i class="nav-icon far fa-user"></i>
                                <p>Tài khoản cá nhân</p>
                            </a>
                        </li>
                    </ul>
                </li>



            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>