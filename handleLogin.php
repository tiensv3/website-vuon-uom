<?php
session_start();
include("./connect.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql_check_login = "select * from users where email = ? and password = ?";
    $stmt = $conn->prepare($sql_check_login);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if ($row['active'] != 1) {
            echo '<script src="./user/assets/js/sweetalert.min.js"></script>';
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "Tài khoản chưa kích hoạt!",
                    text: "Vui lòng kiểm tra email của bạn để kích hoạt tài khoản!",
                    icon: "error",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./login.php";
                });
            });
          </script>';
        } else {

            if ($row['role'] == 0) {
                $_SESSION['customer'] = $row['email'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['account'] = $row['email'];
                $_SESSION['info_user'] = array(
                    'fullname' => $row['fullname'],
                    'address' => $row['address'],
                    'phone' => $row['phone'],
                    'email' => $row['email']
                );
                header('Location: ./user/index.php');
                exit();
            } elseif ($row['role'] == 1) {
                $_SESSION['business'] = $row['email'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['account'] = $row['email'];
                $sql_business = "SELECT * FROM businesses WHERE userid = " . $row['userid'];
                $result_business = $conn->query($sql_business);
                if ($row1 = $result_business->fetch_assoc()) {
                    $_SESSION['businessid'] = $row1['businessid'];
                }
                header('Location: ../admin/BSindex.php');
                exit();
            } elseif ($row['role'] == 2) {
                $_SESSION['admin'] = $row['email'];
                $_SESSION['userid'] = $row['userid'];
                $_SESSION['account'] = $row['email'];

                header('Location: ./admin/index.php');
                exit();
            }
        }
    } else {
        header("Location: ./login.php");
        exit();
    }
}
