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

    $sql_check_email = "SELECT COUNT(email) as CE FROM users where email = '$email'";
    $result_check_email = $conn->query($sql_check_email);

    while ($row = $result_check_email->fetch_assoc()) {
        if ($row['CE'] > 0) {
            echo "<script  language=javascript>
            alert('Email đã tồn tại');
            window.location = './register.php';
        </script>";
            exit();
        }
    }

    $random_byte = random_bytes(16);
    $token = bin2hex($random_byte);

    $sql_insert_register = "INSERT INTO users (email,password,fullname,address,phone, token) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert_register);
    $stmt->bind_param("ssssss", $email, $password, $fullname, $address, $phone, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->affected_rows > 0) {
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;
        include("./sendmail.php");
    }
} elseif (isset($_POST['submitBusiness'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $role = 1;

    $sql_check_email = "SELECT COUNT(email) as CE FROM users where email = '$email'";
    $result_check_email = $conn->query($sql_check_email);

    while ($row = $result_check_email->fetch_assoc()) {
        if ($row['CE'] > 0) {
            echo "<script  language=javascript>
            alert('Email đã tồn tại');
            window.location = './registerBusiness.php';
        </script>";
            exit();
        }
    }

    $random_byte = random_bytes(16);
    $token = bin2hex($random_byte);

    $sql_insert_before = "INSERT INTO users (email,password,fullname, address,phone,role, token) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql_insert_before);
    $stmt->bind_param("sssssis", $email, $password, $fullname, $address, $phone, $role, $token);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($stmt->affected_rows > 0) {

        $userid = $conn->insert_id;
        $businessname = $_POST['businessname'];
        // upload file 
        $uniqueid = uniqid();
        $imageDirectory = "upload/";
        $currentDateTime = date("YmdHis");
        $newFileName = $uniqueid . "_" . $currentDateTime . "_" . basename($_FILES["logo"]["name"]);
        $newFilePath = $imageDirectory . $newFileName;
        $tempFilePath = $_FILES["logo"]["tmp_name"];
        move_uploaded_file($tempFilePath, $newFilePath);

        $sql_insert_after = "INSERT INTO businesses (businessname,image,userid) VALUES (?,?,?)";
        $stmt = $conn->prepare($sql_insert_after);
        $stmt->bind_param("ssi", $businessname, $newFilePath, $userid);
        $stmt->execute();
        $result = $stmt->get_result();


        if ($stmt->affected_rows > 0) {
            $_SESSION['token'] = $token;
            $_SESSION['email'] = $email;
            include("./sendmail.php");
        }
    }
}

?>