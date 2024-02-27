<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connect Plus</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../admin/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../admin/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../admin/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../admin/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../admin/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../admin/assets/images/favicon.png" />
</head>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="../admin/assets/images/logo-dark.svg">
                        </div>
                        <h4>Đăng ký tài khoản cho doanh nghiệp?</h4>
                        <h6 class="font-weight-light">Đăng ký rất dễ dàng. Nó chỉ mất một vài bước</h6>
                        <form class="pt-3" action="./handleRegister.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="" class="text-black">Họ và tên:</label>
                                <input type="text" name="fullname" class="form-control form-control-lg"
                                    id="exampleInputUsername1" placeholder="Ví dụ: Nguyễn Văn A" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-black">Email:</label>
                                <input type="email" name="email" class="form-control form-control-lg"
                                    id="exampleInputEmail1" placeholder="example@gmail.com" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-black">Mật khẩu:</label>
                                <input type="password" name="password" class="form-control form-control-lg"
                                    id="exampleInputPassword1" placeholder="******" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-black">Địa chỉ:</label>
                                <input type="text" name="address" id="" class="form-control form-control-lg "
                                    placeholder="Ví dụ: 123, đường quang trung, Quận 1 , HCM" required>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-black">Số điện thoại:</label>
                                <input type="number" name="phone" id="" class="form-control form-control-lg "
                                    placeholder="Ví dụ: 0911096648" required>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-black">Tên thương hiệu:</label>
                                <input type="text" name="businessname" id="" class="form-control form-control-lg "
                                    placeholder="Ví dụ: abc" required>
                            </div>

                            <div class="form-group">
                                <label for="">Logo thương hiệu:</label>
                                <input type="file" name="logo" id="" class="form-control">
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input" required> Tôi đồng ý với chính
                                        sách và dịch vụ </label>
                                </div>

                            </div>
                            <div class="mt-3">
                                <input type="submit" name="submitBusiness" value="Đăng ký"
                                    class="btn btn-success w-100">
                            </div>


                        </form>
                        <div class="text-center mt-4 font-weight-light"> Đã có tài khoản? <a href="./login.php"
                                class="text-primary">Đăng nhập</a></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- plugins:js -->
<script src="../admin/assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- Plugin js for this page -->

<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="../admin/assets/js/off-canvas.js"></script>
<script src="../admin/assets/js/hoverable-collapse.js"></script>
<script src="../admin/assets/js/misc.js"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="../admin/assets/js/dashboard.js"></script>
<!-- End custom js for this page -->
</body>

</html>