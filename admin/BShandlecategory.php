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
    $duongdan = "../uploadBS/";
    $duongdan = $duongdan . basename($_FILES["imgCategory"]["name"]);
    $file_tam = $_FILES["imgCategory"]["tmp_name"];
    move_uploaded_file($file_tam, $duongdan);

    $sql_insert_category = "INSERT INTO categories (categoryname, categorystatus, categoryimage, businessid) VALUES (?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_category);
    $stmt->bind_param("sisi", $nameCategory, $statusCategory, $duongdan, $businessid);
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
        $duongdan = "../uploadBS/";
        $current_time = date("YmdHis");
        $file_extension = pathinfo($_FILES["categoryimage"]["name"], PATHINFO_EXTENSION);
        $new_file_name = $current_time . "." . $file_extension;
        $duongdan = $duongdan . $new_file_name;
        $file_tam = $_FILES["categoryimage"]["tmp_name"];
        move_uploaded_file($file_tam, $duongdan);
        $sql_update_cate = "UPDATE categories set categoryname = ?, categoryimage = ?, categorystatus = ? WHERE categoryid = ? and businessid = ?";
        $stmt = $conn->prepare($sql_update_cate);
        $stmt->bind_param("ssiii", $categoryname, $duongdan, $categorystatus, $id, $businessid);
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
} elseif (isset($_GET['action']) == 'xoa') {
    $id = $_GET['id'];

    $sql_delete_cate = "DELETE FROM categories WHERE categoryid = ?";
    $stmt = $conn->prepare($sql_delete_cate);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($stmt->affected_rows > 0) {
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
}
$conn->close();
?>