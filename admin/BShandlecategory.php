<?php
session_start();
include("../connect.php");
include("./Template/loadingpage.php");
?>


<?php
if (isset($_POST['addCategory'])) {
    $nameCategory = $_POST['nameCategory'];
    $statusCategory = $_POST['statusCategory'];
    $businessid = $_SESSION['businessid'];
    // img
    $imageDirectory = "../uploadBS/";
    $currentDateTime = date("YmdHis");
    $newFileName = $businessid . "_" . $currentDateTime . "_" . basename($_FILES["imgCategory"]["name"]);
    $newFilePath = $imageDirectory . $newFileName;
    $tempFilePath = $_FILES["imgCategory"]["tmp_name"];
    move_uploaded_file($tempFilePath, $newFilePath);

    $sql_insert_category = "INSERT INTO categories (categoryname, categorystatus, categoryimage, businessid) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_category);
    $stmt->bind_param("sisi", $nameCategory, $statusCategory, $newFilePath, $businessid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($stmt->affected_rows > 0) {
        // echo "<script language='JavaScript'> 
        //     alert('Thêm thông tin danh mục thành công');
        //     </script>";
        echo "<script language='JavaScript'> 
            window.location.href = './BScategory.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
    }
} elseif (isset($_POST['editCategory'])) {
    $id = $_POST['categoryid'];
    $businessid = $_SESSION['businessid'];
    $categoryname = $_POST['categoryname'];
    $categorystatus = $_POST['categorystatus'];
    if (isset($_FILES["categoryimage"]) && $_FILES["categoryimage"]["size"] / (1024 * 1024) > 0 && $_FILES["categoryimage"]["size"] / (1024 * 1024) < 5) {
        $filepath = "../uploadBS/";
        $current_time = date("YmdHis");
        $file_extension = pathinfo($_FILES["categoryimage"]["name"], PATHINFO_EXTENSION);
        $new_file_name = $current_time . "." . $file_extension;
        $filepath = $filepath . $new_file_name;
        $file_tam = $_FILES["categoryimage"]["tmp_name"];
        move_uploaded_file($file_tam, $filepath);
        $sql_update_cate = "UPDATE categories set categoryname = ?, categoryimage = ?, categorystatus = ? WHERE categoryid = ? and businessid = ?";
        $stmt = $conn->prepare($sql_update_cate);
        $stmt->bind_param("ssiii", $categoryname, $filepath, $categorystatus, $id, $businessid);
    } else {
        $sql_update_cate = "UPDATE categories set categoryname = ?, categorystatus = ? WHERE categoryid = ? and businessid = ?";
        $stmt = $conn->prepare($sql_update_cate);
        $stmt->bind_param("siii", $categoryname, $categorystatus, $id, $businessid);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    if ($stmt->affected_rows > 0) {
        echo "<script language='JavaScript'> 
            window.location.href = './BScategory.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
    }
} elseif (isset($_GET['action']) && $_GET['action'] == 'xoa') {
    $id = $_GET['id'];
    $sql_img = "SELECT categories.categoryimage as a, products.thumbnail as b, productimages.imageurl as c
            FROM categories
            LEFT JOIN products ON categories.categoryid = products.categoryid
            LEFT JOIN productimages ON products.productid = productimages.productid
            WHERE categories.categoryid = $id";
    $result_image = $conn->query($sql_img);
    if ($result_image->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result_image)) {
            $cate_image_url = $row["a"];
            $thumbnail_image_url = $row["b"];
            $product_image_url = $row["c"];
            if (file_exists($cate_image_url)) {
                unlink($cate_image_url);
            }
            if (file_exists($thumbnail_image_url)) {
                unlink($thumbnail_image_url);
            }
            if (file_exists($product_image_url)) {
                unlink($product_image_url);
            }
        }
    }
    $sql_delete_product_img = "DELETE FROM productimages
    WHERE productid IN (SELECT productid FROM products WHERE categoryid = $id)";
    $result_delete_image = $conn->query($sql_delete_product_img);

    $sql_delete_thumbnail = "DELETE FROM products
    WHERE categoryid = $id";
    $result_delete_thumbnail = $conn->query($sql_delete_thumbnail);

    $sql_delete_categoryimage = "DELETE FROM categories
    WHERE categoryid = $id";
    $result_delete_categoryimage = $conn->query($sql_delete_categoryimage);
    if ($result_delete_image && $result_delete_thumbnail && $result_delete_categoryimage) {
        // echo "<script language='JavaScript'> 
        //     alert('Xóa thông tin danh mục thành công');
        //     </script>";
        echo "<script language='JavaScript'> 
            window.location.href = './BScategory.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
    }
} elseif (isset($_GET['action']) == 'thaydoitrangthai') {
    $id = $_GET['id'];
    $sql_select_status = "SELECT categorystatus FROM categories where categoryid = $id";
    $result_select_status = $conn->query($sql_select_status);
    if ($row = mysqli_fetch_assoc($result_select_status)) {
        if ($row["categorystatus"] == "1") {
            $sqlstatuscategory = "UPDATE categories SET categorystatus = 0 where categoryid = $id";
            $sqlstatusproduct = "UPDATE products SET productstatus = 0 where categoryid = $id";
            $resultstatuscategory = $conn->query($sqlstatuscategory);
            $resultstatusproduct = $conn->query($sqlstatusproduct);
        } else {
            $sqlstatuscategory = "UPDATE categories SET categorystatus = 1 where categoryid = $id";
            $sqlstatusproduct = "UPDATE products SET productstatus = 1 where categoryid = $id";
            $resultstatuscategory = $conn->query($sqlstatuscategory);
            $resultstatusproduct = $conn->query($sqlstatusproduct);
        }
        echo "<script language='JavaScript'> 
            window.location.href = './BScategory.php';
            </script>";
    }
}
$conn->close();
?>