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
                            <?php
                            if (isset($_GET['token'])) {
                                include('./connect.php');
                                $token = $_GET['token'];
                                $sql = "SELECT userid FROM users WHERE token = ?";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("s", $token);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                if ($result->num_rows > 0) {
                            ?>
                                    <h4>Đặt lại mật khẩu</h4>

                                    <form class="pt-3" action="./handleRepassword.php" method="POST" onsubmit="return validatePassword()">
                                        <div class="form-group">
                                            <label for="" class="text text-black">Mật khẩu:</label>
                                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="" maxlength="16" minlength="8" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="" class="text text-black">Nhập lại mật khẩu:</label>
                                            <input type="password" name="repassword" class="form-control form-control-lg" id="repassword" placeholder="" maxlength="16" minlength="8" required>
                                        </div>

                                        <div class="form-group">
                                            <span id="passwordMatch" style="color: red;"></span>
                                        </div>

                                        <input type="hidden" value="<?php echo $token ?>" name="token">

                                        <div class="mt-3">
                                            <input type="submit" name="submitRepassword" value="Gửi" class="btn btn-success w-100">
                                        </div>
                                        <div class="my-2 d-flex justify-content-between align-items-center">
                                            <!-- <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="rememberMe"> Ghi nhớ
                                        </label>
                                    </div> -->
                                            <a href="./login.php" class="auth-link text-blue">Quay lại</a>
                                        </div>
                                    </form>
                                <?php
                                } else {
                                    echo '<script src="./user/assets/js/sweetalert.min.js"></script>';
                                    echo '<script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                swal({
                                                    title: "KHÔNG TÌM THẤY TRANG",
                                                    text: "Link đã hết hạn hoặc không tồn tại",
                                                    icon: "error",
                                                    button: "Đồng ý"
                                                }).then(() => {
                                                    window.location.href = "./login.php";
                                                });
                                            });
                                          </script>';
                                }
                            } else {


                                ?>
                                <h4>Quên mật khẩu</h4>
                                <form class="pt-3" action="./sendMailRepassword.php" method="POST">
                                    <div class="form-group">
                                        <label for="" class="text text-black">Email:</label>
                                        <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="" required>
                                    </div>
                                    <div class="mt-3">
                                        <input type="submit" name="resetPass" value="Gửi" class="btn btn-success w-100">
                                    </div>
                                    <div class="my-2 d-flex justify-content-between align-items-center">
                                        <!-- <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input" name="rememberMe"> Ghi nhớ
                                        </label>
                                    </div> -->
                                        <a href="./login.php" class="auth-link text-blue">Quay lại</a>
                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <script>
        function validatePassword() {
            const password = document.getElementById('password').value;
            const repassword = document.getElementById('repassword').value;
            const passwordMatch = document.getElementById('passwordMatch');
            const submitButton = document.querySelector('input[type="submit"]');

            // Kiểm tra mật khẩu có ít nhất 1 số, 1 chữ hoa và 1 chữ thường
            const hasNumber = /\d/.test(password);
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            if (!hasNumber || !hasUpperCase || !hasLowerCase) {
                passwordMatch.textContent = "Mật khẩu phải có ít nhất 1 số, 1 chữ hoa và 1 chữ thường!";
                // submitButton.disabled = true;
                return false;
            }

            // Kiểm tra mật khẩu và nhập lại mật khẩu trùng nhau
            if (password !== repassword) {
                passwordMatch.textContent = "Mật khẩu không khớp!";
                // submitButton.disabled = true;
                return false;
            }

            // Mật khẩu hợp lệ
            passwordMatch.textContent = "";
            // submitButton.disabled = false;
            return true;
        }
    </script>
</body>

</html>