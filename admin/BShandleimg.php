<?php
include("./Template/loadingpage.php");
?>
<?php
if (isset($_GET["action"]) == "xoaimg" && isset($_GET["productimgid"])) {
    include("../connect.php");
    $productimageid = $_GET["productimgid"];
    $productid = $_GET["productid"];
    $sql_img = "SELECT imageurl FROM productimages where productimageid = $productimageid";
    $result_image = $conn->query($sql_img);
    if ($result_image->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result_image)) {
            $image_url = $row["imageurl"];
            if (file_exists($image_url)) {
                unlink($image_url);
            }
        }
        $sql_delete_product_img = "DELETE FROM productimages where productimageid = $productimageid";
        $result = $conn->query($sql_delete_product_img);
        if ($result) {
            $_SESSION["message"] = "<span class = 'text-warning'>Đã xóa ảnh!</span>";
            echo "<script language='JavaScript'>
    window.location.href = 'BSproduct.php?action=sua&id=$productid';
</script>";
        } else {
            header("Location: ../../404.html");
            exit;
        }
    } else {
        header("Location: ../../404.html");
        exit;
    }
    $conn->close();
}