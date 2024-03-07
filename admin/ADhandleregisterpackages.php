<?php
include("../connect.php");
include("./Template/loadingpage.php");
?>

<?php
if (isset($_POST["btnSua"])) {
    $startdate = $_POST["startdate"];
    $enddate = $_POST["enddate"];
    $id = $_POST['id'];

    $sql_update_package = "UPDATE businesspackages SET startdate = ?, enddate = ? WHERE businesspackageid = ? ";
    $stmt = $conn->prepare($sql_update_package);
    $stmt->bind_param("ssi", $startdate, $enddate, $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->affected_rows > 0) {
        $_SESSION["message"] = "<span class = 'text-warning'>Cập nhật gói thành công!</span>";
        echo "<script language='JavaScript'> 
            window.location.href = './ADregisterpackages.php';
            </script>";
    } else {
        header("Location: ../../404.html");
        exit;
    }
}
?>