<?php
session_start();
include("./Template/loadingpage.php");
?>

<?php
if (isset($_POST['addProduct'])) {
    include("../connect.php");
    $nameProduct = $_POST['nameProduct'];
    $priceProduct = $_POST['priceProduct'];
    $saleProduct = $_POST['saleProduct'];
    $trendingProduct = $_POST['trendingProduct'];
    $statusProduct = $_POST['statusProduct'];
    $quantityProduct = $_POST['quantityProduct'];
    $descProduct = $_POST['descProduct'];
    $businessid = $_SESSION['businessid'];
    $categoryProduct = $_POST['categoryProduct'];
    $imageDirectory = "../uploadBS/";
    $currentDateTime = date("YmdHis");
    $newFileName = $businessid . "_" . $currentDateTime . "_" . basename($_FILES["thumbnailProduct"]["name"]);
    $newFilePath = $imageDirectory . $newFileName;
    $tempFilePath = $_FILES["thumbnailProduct"]["tmp_name"];
    move_uploaded_file($tempFilePath, $newFilePath);

    $sql_insert_product = "INSERT INTO products (productname, price, sale, quantity, productstatus, trending, thumbnail, description, businessid, categoryid) VALUES (?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_product);
    $stmt->bind_param("siiiiissii", $nameProduct, $priceProduct, $saleProduct, $quantityProduct, $statusProduct, $trendingProduct, $newFilePath, $descProduct, $businessid, $categoryProduct);
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
} elseif (isset($_POST['editProduct'])) {
    include("../connect.php");
    $id = $_POST["idProduct"];
    $nameProduct = $_POST['nameProduct'];
    $priceProduct = $_POST['priceProduct'];
    $saleProduct = $_POST['saleProduct'];
    $quantityProduct = $_POST['quantityProduct'];
    $trendingProduct = $_POST['trendingProduct'];
    $statusProduct = $_POST['statusProduct'];
    $descProduct = $_POST['descProduct'];
    $businessid = $_SESSION['businessid'];
    $categoryProduct = $_POST['categoryProduct'];
    if (isset($_FILES['thumbnailProduct']) && $_FILES["thumbnailProduct"]["size"] / (1024 * 1024) < 5 && $_FILES["thumbnailProduct"]["size"] / (1024 * 1024) > 0) {
        $sql_select_old_thumbnail = "SELECT thumbnail FROM products WHERE productid = $id";
        $result_select_old_thumbnail = $conn->query($sql_select_old_thumbnail);
        if ($result_select_old_thumbnail->num_rows > 0) {

            while ($row = mysqli_fetch_assoc($result_select_old_thumbnail)) {
                $thumbnail = $row["thumbnail"];
                if (file_exists($thumbnail)) {
                    unlink($thumbnail);
                }
            }
        }

        $imageDirectory = "../uploadBS/";
        $currentDateTime = date("YmdHis");
        $newFileName = $businessid . "_" . "thumbnail" . $currentDateTime . "_" . basename($_FILES["thumbnailProduct"]["name"]);
        $newFilePath = $imageDirectory . $newFileName;
        $tempFilePath = $_FILES["thumbnailProduct"]["tmp_name"];
        move_uploaded_file($tempFilePath, $newFilePath);
        $sql_update_thumbnail = "UPDATE products SET thumbnail = ? WHERE productid = ?";
        $stmt_update_thumbnail = $conn->prepare($sql_update_thumbnail);
        $stmt_update_thumbnail->bind_param("si", $newFilePath, $id);
        $stmt_update_thumbnail->execute();
    }

    $sql_update_product = "UPDATE products SET productname = ?, price = ?, sale = ?, quantity = ?, productstatus = ?, trending = ?, description = ?, categoryid = ?
    WHERE productid = ?";
    $stmt = $conn->prepare($sql_update_product);
    $stmt->bind_param("siiiiisii", $nameProduct, $priceProduct, $saleProduct, $quantityProduct, $statusProduct, $trendingProduct, $descProduct, $categoryProduct, $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $targetDirectory = "../uploadBS/";
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    $i = 0;
    foreach ($_FILES["imageProduct"]["name"] as $key => $value) {
        $timestamp = time();
        $fileName = $businessid . $timestamp . $i . '_' . basename($_FILES["imageProduct"]["name"][$key]);
        $targetFilePath = $targetDirectory . $fileName;

        if (!empty($_FILES["imageProduct"]["tmp_name"][$key])) {
            if ($_FILES["imageProduct"]["size"][$key] <= $maxFileSize) {
                if (!file_exists($targetFilePath)) {
                    if (move_uploaded_file($_FILES["imageProduct"]["tmp_name"][$key], $targetFilePath)) {
                        $sql_insert_product = "INSERT INTO productimages (imageurl, productid) VALUES (?,?)";
                        $stmt = $conn->prepare($sql_insert_product);
                        $stmt->bind_param("si", $targetFilePath, $id);
                        $stmt->execute();
                        $i++;
                    }
                }
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
} elseif (isset($_GET['action']) && $_GET['action'] == "xoa") {
    include("../connect.php");
    $id = $_GET['id'];
    $sql_img = "SELECT productimages.imageurl,products.thumbnail 
    FROM productimages INNER JOIN products ON productimages.productid = products.productid  
    WHERE productimages.productid = $id";
    $result_image = $conn->query($sql_img);
    if ($result_image->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result_image)) {
            $image_url = $row["imageurl"];
            $thumbnail = $row["thumbnail"];
            if (file_exists($image_url)) {
                unlink($image_url);
            }
            if (file_exists($thumbnail)) {
                unlink($thumbnail);
            }
        }
    }
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