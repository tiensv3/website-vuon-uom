<?php
session_start();
?>

<?php
if (isset($_POST['addProduct'])) {
    include("../connect.php");
    $nameProduct = $_POST['nameProduct'];
    $priceProduct = $_POST['priceProduct'];
    $descProduct = $_POST['descProduct'];
    $businessid = $_SESSION['businessid'];
    $categoryProduct = $_POST['categoryProduct'];

    // img
    $duongdan = "../uploadBS/";
    $duongdan = $duongdan . basename($_FILES["thumbnailProduct"]["name"]);
    $file_tam = $_FILES["thumbnailProduct"]["tmp_name"];
    move_uploaded_file($file_tam, $duongdan);

    $sql_insert_product = "INSERT INTO products (productname, price, thumbnail, description, businessid, categoryid) VALUES (?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_product);
    $stmt->bind_param("sissii", $nameProduct, $priceProduct, $duongdan, $descProduct, $businessid, $categoryProduct);
    $stmt->execute();
    $result = $stmt->get_result();
    $productid = $stmt->insert_id;

    $targetDirectory = "../uploadBS/";
    $i = 1;
    foreach ($_FILES["imgProduct"]["name"] as $key => $value) {
        $timestamp = time();
        $fileName = $timestamp . '_' . basename($_FILES["imgProduct"]["name"][$key]);
        $targetFilePath = $targetDirectory . $i . $fileName;
        if (file_exists($targetFilePath)) {
            echo "File đã tồn tại!";
        } else {
            if (move_uploaded_file($_FILES["imgProduct"]["tmp_name"][$key], $targetFilePath)) {
                $sql_insert_product = "INSERT INTO productimages (imageurl, productid) VALUES (?,?)";
                $stmt = $conn->prepare($sql_insert_product);
                $stmt->bind_param("si", $targetFilePath, $productid);
                $stmt->execute();
                $result = $stmt->get_result();
                $i++;
            }
        }
    }
    if ($stmt->affected_rows > 0) {
        // echo "<script language='JavaScript'> 
        //     alert('Thêm thông tin sản phẩm thành công');
        //     </script>";
        echo "<script language='JavaScript'> 
            window.location.href = './BSproduct.php';
            </script>";
    } else {
        // echo "<script language='JavaScript'> 
        //     alert('Lỗi!');
        //     </script>";
        // echo "<script language='JavaScript'> 
        //     window.location.href = './BSproduct.php';
        //     </script>";
        header("Location: ../../404.html");
        exit;
    }
    $conn->close();
} elseif (isset($_GET['action']) == "xoasp") {
    include("../connect.php");
    $id = $_GET['productimgid'];
    $sql_delete_img = "DELETE FROM productimages Where productid = '" . $id . "'";
    $result_delete_img = $conn->query($sql_delete_img);
    $sql_delete_product = "DELETE FROM products WHERE productid = ?";
    $stmt = $conn->prepare($sql_delete_product);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // echo "<script language='JavaScript'> 
        //         alert('Xóa thông tin sản phẩm thành công');
        //         </script>";
        echo "<script language='JavaScript'> 
                window.location.href = ' BSproduct.php';
                </script>";
    } else {
        // echo "<script language='JavaScript'> 
        //         alert('Không có sản phẩm nào được xóa');
        //         </script>";
        // echo "<script language='JavaScript'> 
        //         window.location.href = ' BSproduct.php';
        //         </script>";
        header("Location: ../../404.html");
        exit;
    }
    $conn->close();
}
?>