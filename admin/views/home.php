<!-- Thêm liên kết đến Font Awesome trong phần <head> -->

<!-- header -->
<?php include './views/layout/header.php' ?>
<!-- Navbar -->
<?php include './views/layout/navbar.php' ?>
<!-- Sidebar -->
<?php include './views/layout/sidebar.php' ?>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1 class="m-0">Báo cáo thống kê</h1>
            <br>
            <div class="row">

                <!-- Đơn hàng -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?= number_format($soDonHang) ?></h3>
                            <p>Đơn hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="<?= BASE_ADMIN_URL . '?act=don-hang' ?>" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Danh mục sản phẩm -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3><?= number_format($soDanhMuc) ?></h3>
                            <p>Danh mục sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-th-list"></i>
                        </div>
                        <a href="<?= BASE_ADMIN_URL . '?act=danh-muc' ?>" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Khách hàng -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?= number_format($soKhachHang) ?></h3>
                            <p>Khách hàng</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="<?= BASE_ADMIN_URL . '?act=list-tai-khoan-khach-hang' ?>" class="small-box-footer">Xem
                            chi tiết <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Sản phẩm -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3><?= number_format($soSanPham) ?></h3>
                            <p>Sản phẩm</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box-open"></i>
                        </div>
                        <a href="<?= BASE_ADMIN_URL . '?act=san-pham' ?>" class="small-box-footer">Xem chi tiết <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>

            <!-- Doanh thu dạng biểu đồ -->
            <div class="row">
                <div class="col-12">
                    <canvas id="doanhThuChart" width="400" height="150"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Thêm thư viện Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('doanhThuChart').getContext('2d');
const doanhThuChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Hôm nay', 'Tuần', 'Tháng', 'Năm'],
        datasets: [{
            label: 'Doanh thu (đ)',
            data: [
                <?= $doanhThuHomNay ?>,
                <?= $doanhThuTuan ?>,
                <?= $doanhThuThang ?>,
                <?= $doanhThuNam ?>
            ],
            backgroundColor: [
                'rgba(54, 162, 235, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(255, 99, 132, 0.7)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(255, 99, 132, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: function(value) {
                        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + " đ";
                    }
                }
            }
        }
    }
});
</script>


<!-- Footer -->
<?php include './views/layout/footer.php'; ?>