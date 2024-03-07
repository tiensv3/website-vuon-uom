<?php
include("./connect.php");
?>
<?php

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $i = 1;
    $sqltoken = "SELECT * FROM users WHERE token = ? LIMIT ?";
    $stmt = $conn->prepare($sqltoken);
    $stmt->bind_param("si", $token, $i);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $sql = "UPDATE users SET active = ?, token = null WHERE token = ? ";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $i, $token);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<script  language=javascript>
            alert('Xác nhận thành công! Vui lòng đăng nhập lại');
            window.location = './login.php';
        </script>";
        }
    } else {
        echo "Tài khoản đã được kích hoạt hoặc không tồn tại";
    }
} else {
    echo "<script  language=javascript>
            alert('Tài khoản chưa xác nhận, vui lòng xác nhận để đăng nhập');
            window.location = './login.php';
        </script>";
}
?>