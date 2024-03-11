<?php
if (isset($_POST["submitRepassword"])) {
    include("./connect.php");
    $token = $_POST["token"];
    $password = md5($_POST["password"]);

    $sql = "UPDATE users set password = ?, token = null WHERE token = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->affected_rows > 0) {
        echo '<script src="./user/assets/js/sweetalert.min.js"></script>';
        echo '<script>
                document.addEventListener("DOMContentLoaded", function() {
                    swal({
                        title: "ĐÃ ĐỔI MẬT KHẨU",
                        text: "Vui lòng đăng nhập lại",
                        icon: "success",
                        button: "Đồng ý"
                    }).then(() => {
                        window.location.href = "./login.php";
                    });
                });
              </script>';
    }
} else {
    echo "<script  language=javascript>
    window.location = './404.html';
</script>";
    exit();
}
?>
<?php
?>