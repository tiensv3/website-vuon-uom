<?php
session_start();
include("../connect.php");
include("./Template/loadingpage.php");
?>


<?php
if (isset($_POST['addCategory'])) {
    $businessid = $_SESSION['businessid'];
    $current_date = date("Y-m-d");
    $status = 1;

    $sql = "SELECT COUNT(businesspackages.businesspackageid) AS total_count, businesspackages.packageid AS pid
    FROM businesspackages INNER JOIN businesses
    ON businesspackages.businessid = businesses.businessid
    WHERE businesspackages.status = $status AND DATE(businesspackages.enddate) >= DATE('$current_date')
    AND businesspackages.businessid = $businessid";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        $pid = $row['pid'];
        if ($row['total_count'] == 0) {
            echo '<script src="./assets/js/sweetalert.min.js"></script>';
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "BẠN CHƯA CÓ GÓI DỊCH VỤ NÀO!",
                    text: "Vui lòng nâng cấp gói để sử dụng dịch vụ!",
                    icon: "warning",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./BScategory.php";
                });
            });
          </script>';
            exit();
        }

        $sql_noc = "SELECT numberofcategories FROM packages WHERE packageid = $pid";
        $result_noc = $conn->query($sql_noc);
        $sql_count_cate = "SELECT COUNT(categoryid) as count_id FROM categories WHERE businessid = $businessid";
        $result_count_cate = $conn->query($sql_count_cate);

        if ($row1 = $result_noc->fetch_assoc()) {
            $noc =  $row1['numberofcategories'];
        }
        if ($row2 =  $result_count_cate->fetch_assoc()) {
            $count_cate = $row2['count_id'];
        }

        if ($noc <= $count_cate) {
            echo '<script src="./assets/js/sweetalert.min.js"></script>';
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "GÓI KHÔNG KHẢ THI!",
                    text: "Vui lòng nâng cấp gói để sử dụng dịch vụ!",
                    icon: "warning",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./BScategory.php";
                });
            });
          </script>';
            exit();
        }

        $nameCategory = $_POST['nameCategory'];
        $statusCategory = $_POST['statusCategory'];
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
            echo '<script src="./assets/js/sweetalert.min.js"></script>';
            echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "ĐÃ THÊM!",
                    text: "Danh mục của bạn đã được thêm!",
                    icon: "success",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./BScategory.php";
                });
            });
          </script>';
            exit();
        } else {
            header("Location: ../../404.html");
            exit;
        }
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
        echo '<script src="./assets/js/sweetalert.min.js"></script>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "ĐÃ CẬP NHẬT!",
                    text: "Danh mục của bạn đã được cập nhật!",
                    icon: "success",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./BScategory.php";
                });
            });
          </script>';
        exit();
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
        echo '<script src="./assets/js/sweetalert.min.js"></script>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "ĐÃ XÓA!",
                    text: "Danh mục của bạn đã được xóa!",
                    icon: "success",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./BScategory.php";
                });
            });
          </script>';
        exit();
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
        echo '<script src="./assets/js/sweetalert.min.js"></script>';
        echo '<script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "ĐÃ CẬP NHẬT!",
                    text: "Trạng thái đã được cập nhật!",
                    icon: "success",
                    button: "Đồng ý"
                }).then(() => {
                    window.location.href = "./BScategory.php";
                });
            });
          </script>';
        exit();
    }
}
$conn->close();
?>