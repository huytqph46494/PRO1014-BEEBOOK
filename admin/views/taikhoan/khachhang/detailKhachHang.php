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
                    <h1>Quản lý tài khoản khách hàng</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                     <img src="<?= BASE_URL . $khachHang['anh_dai_dien']?>" style="width: 70%" alt="">
                    
                </div>
                <div class="col-6">
                    <div class="container">
                     <table class="table table-borderless">
                        <tbody style="font-size: large;">
                            <tr>
                                <th>Họ Tên:</th>
                                <td><?= $khachHang['ho_ten'] ?? '' ?></td>
                            </tr>
                              <tr>
                                <th>Ngày sinh:</th>
                                <td><?= $khachHang['ngay_sinh'] ?? '' ?></td>
                            </tr>
                              <tr>
                                <th>Email:</th>
                                <td><?= $khachHang['email'] ?? '' ?></td>
                            </tr>
                              <tr>
                                <th>Số điện thoại:</th>
                                <td><?= $khachHang['so_dien_thoai'] ?? '' ?></td>
                            </tr>
                              <tr>
                                <th>Giới tính:</th>
                                <td><?= $khachHang['gioi_tinh'] == 1 ? 'Nam': 'Nữ'; ?></td>
                            </tr>
                              <tr>
                                <th>Địa chỉ:</th>
                                <td><?= $khachHang['dia_chi'] ?? '' ?></td>
                            </tr>
                              <tr>
                                <th>Trạng thái:</th>
                                <td><?= $khachHang['trang_thai'] == 1 ? 'Active' : 'Inactive' ?></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                   
                </div>
                <div class="col-12">
                    <hr>
                    <h2>Lịch sử mua hàng </h2>
                    <div>
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
                                        <td><?=$donHang['ngay_dat']?></td>
                                        <td><?=$donHang['tong_tien']?></td>
                                        <td><span class="badge text-bg-<?= $donHang['ten_trang_thai']?>"><?= $donHang['ten_trang_thai']?></span></td>
                                        

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
                            </table>
                    </div>
                </div>

                 <div class="col-12">
                    <hr>
                    <h2>Lịch sử bình luận</h2>
                    <div>
                         <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                       <th>Sản phẩm</th>
                                       <th>Nội dung</th>
                                       <th>Ngày bình luận</th>
                                        <th>Trạng thái</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listBinhLuan as $key => $binhLuan): ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td>
                                            <a target="_bank" href="<?= BASE_ADMIN_URL. '?act=chi-tiet-san-pham&id_san_pham=' . $binhLuan['san_pham_id'];?>"><?=$binhLuan['ten_san_pham']?>
                                    </a>
                                </td>
                                        <td><?=$binhLuan['noi_dung']?></td>
                                        <td><?=$binhLuan['ngay_dang']?></td>
                                        <td><?=$binhLuan['trang_thai'] == 1 ? 'Hiển thị' :'Ẩn' ?></td>
                                        <td>
                                        <form action="<?= BASE_ADMIN_URL . '?act=update-trang-thai-binh-luan'?>" method="POST">
                                            <input type="hidden" name="id_binh_luan" value="<?= $binhLuan['id'] ?>">
                                             <input type="hidden" name="name_view" value="detail_khach">
                                              <input type="hidden" name="id_khach_hang" value="<?= $binhLuan['tai_khoan_id'] ?>">
                                            <button type="submit" onclick="return confirm('Bạn có muốn ẩn bình luận không')" class="btn btn-warning">
                                                <?= $binhLuan['trang_thai'] == 1 ? 'Ẩn':'Bỏ ẩn' ?>
                                            </button>
                                        </form>
                                          </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            
            
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- footer -->
<?php include './views/layout/footer.php'; ?>
<!-- end footer-->

</body>
<script>
$(function() {
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,

    })
    $('#example2').DataTable({
        "lengthChange": false,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>


</html>