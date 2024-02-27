<?php
if (isset($_GET["action"]) == "xoaimg" && isset($_GET["productimgid"])) {
    include("../connect.php");
    $productimageid = $_GET["productimgid"];
    $productid = $_GET["productid"];
    $sql_delete_product_img = "DELETE FROM productimages where productimageid = $productimageid";
    $result = $conn->query($sql_delete_product_img);
    if ($result) {
        echo "<script language='JavaScript'>
    alert('Xóa hình ảnh sản phẩm thành công');
</script>";
        echo "<script language='JavaScript'>
    window.location.href = 'BSproduct.php?action=sua&id=$productid';
</script>";
    } else {
        echo "<script language='JavaScript'>
    alert('Không có hình ảnh nào được xóa');
</script>";
        echo "<script language='JavaScript'>
    window.location.href = 'BSproduct.php?action=sua&id=$productid';
</script>";
    }
} else {
    echo "<script language='JavaScript'>
    alert('Không có hình ảnh nào được xóa');
</script>";
    echo "<script language='JavaScript'>
    window.location.href = 'BSproduct.php?action=sua&id=$productid';
</script>";
}
$conn->close();
