<?php
include("./connect.php");
?>

<?php //đăng ký cho khách hàng
if (isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = 0;

    $sql_insert_register = "INSERT INTO users (email,password,fullname,address,phone,role) VALUES ('$email','$password','$fullname','$address','$phone','$role')";
    $query_result_insert = mysqli_query($conn, $sql_insert_register);

    if ($query_result_insert) {
        echo "<script  language=javascript>
            alert('Đăng ký thành công!');
            window.location = './login.php';
        </script>";
    }
}
?>
<?php //đăng ký cho business
if (isset($_POST['submitBusiness'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = 1;

    $sql_insert_before = "INSERT INTO users (email,password,fullname, address,phone,role) VALUES ('$email','$password','$fullname','$address','$phone','$role')";
    if ($conn->query($sql_insert_before) === TRUE) {

        $userid = $conn->insert_id;
        $businessname = $_POST['businessname'];
        $premiumstatus = 0;

        // upload file 
        $duongdan = "upload/";
        $duongdan = $duongdan . basename($_FILES["logo"]["name"]);
        $file_tam = $_FILES["logo"]["tmp_name"];
        move_uploaded_file($file_tam, $duongdan);

        $sql_insert_after = "INSERT INTO businesses (businessname,image,premiumstatus,userid) VALUES ('$businessname' , '$duongdan' ,'$premiumstatus', '$userid')";

        if ($conn->query($sql_insert_after) === TRUE) {
            echo "<script  language=javascript>
            alert('Đăng ký tài khoản doanh nghiệp thành công!');
            window.location = './login.php';
        </script>";
        }
    }
}

?>
