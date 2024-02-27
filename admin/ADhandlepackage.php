<?php
include("../connect.php");
include("./Template/loadingpage.php");

if (isset($_POST['addPackage'])) {

    $namePackage = $_POST['namePackage'];
    $pricePackage = $_POST['pricePackage'];
    $datePackage = $_POST['datePackage'];
    $descPackage = $_POST['descPackage'];

    $sql_insert_package = "INSERT INTO packages (name, price, packagedate, description) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_package);
    $stmt->bind_param("siis", $namePackage, $pricePackage, $datePackage, $descPackage);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($stmt->affected_rows > 0) {
        // echo "<script language='JavaScript'> 
        //     alert('Thêm thông tin gói thành công');
        //     </script>";
        echo "<script language='JavaScript'> 
            window.location.href = './ADpackages.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
        // echo "<script language='JavaScript'> 
        //     window.location.href = './ADpackages.php';
        //     </script>";
    }
} else if (isset($_POST['editPackage'])) {
    $id = $_POST['packageid'];
    $namePackage = $_POST['namePackage'];
    $pricePackage = $_POST['pricePackage'];
    $datePackage = $_POST['datePackage'];
    $descPackage = $_POST['descPackage'];

    $sql_update_package = "UPDATE packages SET name = ?, price = ?, packagedate = ?, description = ?  WHERE packageid = ?";
    $stmt = $conn->prepare($sql_update_package);
    $stmt->bind_param("siisi", $namePackage, $pricePackage, $datePackage, $descPackage, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->affected_rows > 0) {

        // echo "<script language='JavaScript'> 
        //     alert('sửa thông tin gói thành công');
        //     </script>";
        echo "<script language='JavaScript'> 
            window.location.href = 'ADpackages.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
        // echo "<script language='JavaScript'> 
        //     window.location.href = 'ADpackages.php';
        //     </script>";
    }
} else if (isset($_GET['action']) == 'xoa') {
    $id = $_GET['id'];

    $sql_delete_package = "DELETE FROM packages WHERE packageid = ?";
    $stmt = $conn->prepare($sql_delete_package);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->affected_rows > 0) {
        // echo "<script language='JavaScript'> 
        //     alert('Xóa thông tin gói thành công');
        //     </script>";
        echo "<script language='JavaScript'> 
            window.location.href = 'ADpackages.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
    }
}
$conn->close();
