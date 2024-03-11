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
    <title>Vườn ươm doanh nghiệp Trà Vinh</title>
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

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5">
                            <div class="brand-logo">
                                <img src="../admin/assets/images/logo-dark.svg">
                            </div>
                            <h4>Xin chào! Hãy bắt đầu</h4>
                            <h6 class="font-weight-light">Đăng nhập để tiếp tục.</h6>
                            <form class="pt-3" action="./handleLogin.php" method="POST">
                                <div class="form-group">
                                    <label for="" class="text text-black">Email:</label>
                                    <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="example@gmail.com">
                                </div>
                                <div class="form-group">
                                    <label for="" class="text text-black">Mật khẩu:</label>
                                    <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="******">
                                </div>
                                <div class="mt-3">
                                    <input type="submit" name="login" value="Đăng nhập" class="btn btn-success w-100">
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <!-- <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="rememberMe"> Ghi nhớ
                                        </label>
                                    </div> -->
                                    <a href="#" class="auth-link text-blue">Kích hoạt tài khoản</a>
                                    <a href="./rePassword.php" class="auth-link text-danger">Quên mật khẩu?</a>
                                </div>
                                <div class="mb-2">
                                    <button type="button" class="btn btn-block btn-google auth-form-btn">
                                        <i class="mdi mdi-google mr-2"></i>Liên kết với Google </button>
                                </div>
                                <div class="text-center mt-4 font-weight-light"> Chưa có tài khoản? <a href="./register.php" class="text-primary">Đăng ký</a><span> ngay</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

</body>

</html>