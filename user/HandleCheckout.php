<?php
session_start();
include("../connect.php");
?>

<?php
if (isset($_POST['ConfirmCheckout'])) {
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$method = $_POST['method'];
	$total = $_SESSION['alltotal'];
	$status = 1;
	$userid = $_SESSION['userid'];

	/* -------------------------------------------------------------------------- */
	/*                             hàm insert hóa đơn                             */
	$orderCode = rand(00000, 99999); // cho mã code ngẫu nhiên

	// $sql_insert_order = "INSERT INTO `order` (ordercode, email, phone, total, method, status, userid) VALUES ('$orderCode' ,'$email', '$phone', '$total', '$method', '$status', '$userid')";
	$result_insert_order = $conn->query($sql_insert_order);


	if ($result_insert_order == TRUE) {
		echo "<script  language=javascript>
            alert('Đặt hàng thành công! Chúng tôi sẽ giao hàng cho bạn sớm nhất');
        </script>";
		echo "<script language=javascript>
			window.location = '../user/Thank.php';
		</script>";
	}

	/* -------------------------------------------------------------------------- */
}
?>