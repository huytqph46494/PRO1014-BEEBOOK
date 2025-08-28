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
                    <h1>Quản lý danh sách đơn hàng: <?= $donHang['ma_don_hang'] ?></h1>
                </div>
                <div class="col-sm-6 d-flex justify-content-end align-items-center">
                    <label class="mr-2 font-weight-bold">Trạng thái:</label>
                    <span class="form-control"
                        style="width:auto; display:inline-block;"><?= $donHang['ten_trang_thai'] ?></span>
                </div>



            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <?php
           if ($donHang['trang_thai_id'] ==1 ){
               $colorAlerts = 'primary';
           }elseif($donHang['trang_thai_id'] >=2 && $donHang['trang_thai_id'] <= 9){
              $colorAlerts ='warning';
           }elseif($donHang['trang_thai_id'] == 10){
              $colorAlerts ='success';
           }else{
              $colorAlerts = 'danger';
           }
           ?>
                    <div class="alert alert-<?= $colorAlerts; ?>" role="alert">
                        Đơn Hàng: <?= $donHang['ten_trang_thai'] ?>
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="nav-icon fas fa-book"></i> BEE-BOOK - Nhóm 1
                                    <small class="float-right">Ngày đặt: <?= formatDate($donHang['ngay_dat']);?>
                                    </small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <div
                                    style="font-size: 1.2em; color: #B22222; font-weight: bold; text-decoration: underline; margin-bottom: 10px;">
                                    Thông tin người đặt
                                </div>
                                <address>
                                    <strong><?= $donHang['ho_ten'] ?></strong><br>
                                    Email: <?= $donHang['email'] ?><br>
                                    Số điện thoại: <?= $donHang['so_dien_thoai'] ?><br>
                                </address>
                            </div>

                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <div
                                    style="font-size: 1.2em; color: #B22222; font-weight: bold; text-decoration: underline; margin-bottom: 10px;">
                                    Người Nhận
                                </div>
                                <address>
                                    <strong><?= $donHang['ten_nguoi_nhan']?></strong><br>
                                    Email:<?= $donHang['email_nguoi_nhan']?><br>
                                    Số điện thoại: <?= $donHang['sdt_nguoi_nhan']?><br>
                                    Địa chỉ:<?= $donHang['dia_chi_nguoi_nhan']?> <br>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <div
                                    style="font-size: 1.2em; color: #B22222; font-weight: bold; text-decoration: underline; margin-bottom: 10px;">
                                    Thông tin
                                </div>
                                <address>
                                    <strong>Mã đơn hàng:<?= $donHang['ma_don_hang']?></strong><br>
                                    Tổng tiền: <?= number_format($donHang['tong_tien'], 0, ',', '.') ?> đ<br>
                                    Ghi chú: <?= $donHang['ghi_chu']?><br>
                                    Thanh toán:<?= $donHang['ten_phuong_thuc']?> <br>
                                </address>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $tong_tien = 0;  ?>
                                        <?php foreach($sanPhamDonHang as $key=>$sanPham):?>
                                        <tr>
                                            <td><?= $key+1 ?></td>
                                            <td><?= $sanPham['ten_san_pham'] ?></td>
                                            <td><?= number_format($sanPham['don_gia'], 0, ',', '.') ?> đ</td>
                                            <td><?= $sanPham['so_luong'] ?></td>
                                            <td><?= number_format($sanPham['thanh_tien'], 0, ',', '.') ?> đ</td>
                                        </tr>
                                        <?php $tong_tien += $sanPham['thanh_tien']; ?>
                                        <?php endforeach?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <!-- /.col -->
                            <div class="col-6">
                                <h4>
                                    <i class="fas fa-file-invoice"></i> Tổng hóa đơn
                                </h4>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Thành Tiền:</th>
                                            <td><?= number_format($tong_tien, 0, ',', '.') ?> đ</td>
                                        </tr>
                                        <tr>
                                            <th>Vận chuyển</th>
                                            <td><?= number_format(200000, 0, ',', '.') ?> đ</td>
                                        </tr>
                                        <tr>
                                            <th
                                                style="color: #B22222; font-weight: bold; font-size: 1.2em; text-decoration: underline;">
                                                Tổng tiền:
                                            </th>
                                            <td
                                                style="color: #B22222; font-weight: bold; font-size: 1.2em; text-decoration: underline;">
                                                <?= number_format($tong_tien + 200000, 0, ',', '.') ?> đ
                                            </td>
                                        </tr>

                                    </table>

                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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