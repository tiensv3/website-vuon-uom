<?php
session_start();
include("./connect.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql_check_login = "select * from users where email = '" . $email . "' and password = '" . $password . "' ";
    $result = $conn->query($sql_check_login);

    if ($row = mysqli_fetch_array($result)) {
        if ($row['role'] == 0) {
            $_SESSION['customer'] = $row['email'];
            $_SESSION['userid'] = $row['userid'];
            header('Location: ./index.php');
        } else if ($row['role'] == 1) {
            $_SESSION['business'] = $row['email'];
            $_SESSION['userid'] = $row['userid'];
            $sql_business = "SELECT * FROM businesses WHERE userid = " . $row['userid'];
            $result_business = $conn->query($sql_business);
            if ($row1 = mysqli_fetch_array($result_business)) {
                $_SESSION['businessid'] = $row1['businessid'];
            }
            header('Location: ../admin/index.php');
        } else if ($row['role'] == 2) {
            $_SESSION['admin'] = $row['email'];
            $_SESSION['userid'] = $row['userid'];
            header('Location: ./admin/index.php');
        }
    } else {
        header("Location: ./login.php");
    }
}
