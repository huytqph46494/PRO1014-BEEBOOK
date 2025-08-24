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
                 <!-- left column -->

                 <div class="col-md-4">
                     <div class="text-center">
                         <img src="<?= BASE_URL . $thongTin['anh_dai_dien'] ?>" class="avatar img-circle" alt="avatar"
                             style="width: 150px; height: 150px; object-fit: cover; border-radius: 50%;">
                     </div>
                 </div>

                 <!-- edit form column -->
                 <div class="col-md-6 personal-info">
                     <form action="<?= BASE_ADMIN_URL .'?act=sua-thong-tin-ca-nhan-quan-tri'?>" method="post">
                         <hr>
                         <h3>Thông tin cá nhân</h3>

                         <div class="form-group">
                             <label class="col-lg-3 control-label">Họ tên:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" name="ho_ten"
                                     value="<?= isset($thongTin['ho_ten']) ? htmlspecialchars($thongTin['ho_ten']) : '' ?>">
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="col-lg-3 control-label">Ngày sinh:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="date" name="ngay_sinh"
                                     value="<?= isset($thongTin['ngay_sinh']) ? htmlspecialchars($thongTin['ngay_sinh']) : '' ?>">

                             </div>
                         </div>

                         <div class="form-group">
                             <label class="col-lg-3 control-label">Email:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="email" name="email"
                                     value="<?= isset($thongTin['email']) ? htmlspecialchars($thongTin['email']) : '' ?>">
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="col-lg-3 control-label">Số điện thoại:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" name="so_dien_thoai"
                                     value="<?= isset($thongTin['so_dien_thoai']) ? htmlspecialchars($thongTin['so_dien_thoai']) : '' ?>">
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="col-lg-3 control-label">Địa chỉ:</label>
                             <div class="col-lg-12">
                                 <input class="form-control" type="text" name="dia_chi"
                                     value="<?= isset($thongTin['dia_chi']) ? htmlspecialchars($thongTin['dia_chi']) : '' ?>">
                             </div>
                         </div>

                         <div class="form-group">
                             <label class="col-md-3 control-label"></label>
                             <div class="col-md-12">
                                 <input type="button" class="btn btn-primary" value="Save Changes">
                             </div>

                     </form>
                     <hr>

                     <h3>Đổi mật khẩu</h3>
                     <?php if(isset($_SESSION['success'])) { ?>
                     <div class="alert alert-info alert-dismissable">
                         <a class="panel-close close" data-dismiss="alert">×</a>
                         <i class="fa fa-coffee"></i>
                         <?= $_SESSION['success']; ?>
                     </div>
                     <?php unset($_SESSION['success']); ?>
                     <?php } ?>




                     <form action="<?= BASE_ADMIN_URL . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="post">
                         <div class="form-group">
                             <label class="col-md-3 control-label">Mật khẩu cũ:</label>
                             <div class="col-md-12">
                                 <input class="form-control" type="text" name="old_pass" value="">
                                 <?php if(isset($_SESSION['error']['old_pass'])) { ?>
                                 <p class="text-danger"><?=$_SESSION['error']['old_pass'] ?> </p>
                                 <?php } ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-3 control-label">Mật khẩu mới:</label>
                             <div class="col-md-12">
                                 <input class="form-control" type="text" name="new_pass" value="">
                                 <?php if(isset($_SESSION['error']['new_pass'])) { ?>
                                 <p class="text-danger"><?=$_SESSION['error']['new_pass'] ?> </p>
                                 <?php } ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-3 control-label">Nhập lại mật khẩu mới:</label>
                             <div class="col-md-12">
                                 <input class="form-control" type="text" name="confirm_pass" value="">
                                 <?php if(isset($_SESSION['error']['confirm_pass'])) { ?>
                                 <p class="text-danger"><?=$_SESSION['error']['confirm_pass'] ?> </p>
                                 <?php } ?>
                             </div>
                         </div>
                         <div class="form-group">
                             <label class="col-md-3 control-label"></label>
                             <div class="col-md-12">
                                 <input type="submit" class="btn btn-primary" value="Save Changes">
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
         <hr>
     </section>
     <!-- /.content -->
 </div>
 <!-- /.content-wrapper -->
 <!-- footer -->
 <?php include './views/layout/footer.php'; ?>
 <!-- end footer-->

 </body>

 </html>