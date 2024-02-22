<?php
include("../connect.php");


if (isset($_POST['addPackage'])) {

    $namePackage = $_POST['namePackage'];
    $pricePackage = $_POST['pricePackage'];
    $datePackage = $_POST['datePackage'];
    $descPackage = $_POST['descPackage'];

    $sql_insert_package = "INSERT INTO packages (name, price, packagedate, description) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_package);
    $stmt->bind_param("siss", $namePackage, $pricePackage, $datePackage, $descPackage);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($stmt->affected_rows > 0) {
        // Câu lệnh đã thực thi thành công, chuyển hướng trang
        echo "<script language='JavaScript'> 
            alert('Thêm thông tin gói thành công');
            </script>";
        echo "<script language='JavaScript'> 
            window.location.href = './ADpackages.php';
            </script>";
    } else {
        // Câu lệnh không thực thi thành công, in ra lỗi
        echo "Lỗi: " . $stmt->error;
    }
}
