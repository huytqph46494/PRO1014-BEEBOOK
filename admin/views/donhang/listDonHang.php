<!-- header -->
<?php include './views/layout/header.php'?>
<!-- Navbar -->
<?php include './views/layout/navbar.php'?>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
<<<<<<< HEAD

=======
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                    <h1>Quản lý danh sách đơn hàng</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã Đơn Hàng</th>
                                        <th>Tên người nhận</th>
                                        <th>Số điện thoại</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listDonHang as $key => $donHang): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?=$donHang['ma_don_hang']?></td>
                                        <td><?=$donHang['ten_nguoi_nhan']?></td>
                                        <td><?=$donHang['sdt_nguoi_nhan']?></td>
<<<<<<< HEAD

=======
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                                        <td><?= date('d/m/Y', strtotime($donHang['ngay_dat'])) ?></td>
                                        <td><?= number_format($donHang['tong_tien'], 0, ',', '.') ?> đ</td>
                                        <td>
                                            <span
                                                class="badge border border-danger text-danger"><?= $donHang['ten_trang_thai'] ?></span>
                                        </td>

<<<<<<< HEAD
=======

>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
                                        <td>
                                            <div class="btn-group"></div>
                                            <a
                                                href="<?= BASE_ADMIN_URL . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>">
                                                <button class="btn btn-primary"><i class="fas fa-eye"></i></button>
                                            </a>

                                            <a
                                                href="<?= BASE_ADMIN_URL . '?act=form-sua-don-hang&id_don_hang=' . $donHang['id'] ?>">
                                                <button class="btn btn-warning"><i class="fas fa-wrench"></i></button>
                                            </a>

                                        </td>
                        </div>
                        </tr>
                        <?php endforeach ?>
                        </tbody>
                        <tfoot>

                            <tr>
                                <th>STT</th>
                                <th>Mã Đơn Hàng</th>
                                <th>Tên người nhận</th>
                                <th>Số điện thoại</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái</th>
                                <th>Thao tác</th>
                            </tr>

                        </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
<<<<<<< HEAD
>>>>>>> origin/main
=======
>>>>>>> 19a595c5928eb53e7141de2b811f07186e38dbc3
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer-->
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>
</body>

</html>