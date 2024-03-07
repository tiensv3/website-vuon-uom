<?php
session_start();
include("../connect.php");
include("./Template/loadingpage.php");
?>

<?php
if (isset($_POST["btnDangky"])) {
    $packageid = $_POST["packageid"];
    $businessid = $_SESSION["businessid"];
    $sql_insert = "INSERT INTO businesspackages (businessid, packageid) VALUE (?,?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ii", $businessid, $packageid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($stmt->affected_rows > 0) {
        $_SESSION["message"] = "<span class = 'text-warning'>Đăng ký thành công! Liên hệ với quản trị viên để được kích hoạt gói!</span>";
        echo "<script language='JavaScript'> 
            window.location.href = './BSregisterpackages.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
    }
} else {
    echo "<script language='JavaScript'> 
            window.location.href = './BSregisterpackages.php';
            </script>";
}

$conn->close();
?>