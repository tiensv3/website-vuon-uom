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
	$total = $_SESSION['total'];
	$status = 1;
	$userid = $_SESSION['userid'];

	/* -------------------------------------------------------------------------- */
	/*                             hàm insert hóa đơn                             */
	$randletter = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)); // chạy ngẫu nhiên chữ
	$randnumber = rand(0000000, 9999999); // chạy ngẫu nhiên số 
	$ordercode = $randletter . $randnumber;
	/* ----------------------------- insert in order ---------------------------- */
	$sql_insert_order = "INSERT INTO orders (ordercode, total, shipaddress, status, userid, method) VALUES ('$ordercode' , '$total', '$address', '$status' , '$userid', '$method' )";
	$result_insert_order = $conn->query($sql_insert_order);
	$orderid = $conn->insert_id;

	/* --------------------------- insert orderdetail --------------------------- */
	foreach ($_SESSION['cart'] as $cart) {
		$product_id = $cart['id'];
		$quantity = $cart['quantity'];
		$sql_insert_detail = "INSERT INTO orderdetails(quantityproduct, productid,orderid) VALUES ('$quantity' , '$product_id', '$orderid' )";
		$result_insert_order_detail = $conn->query($sql_insert_detail);
	}

	unset($_SESSION['cart']);
	if ($result_insert_order_detail == TRUE) {
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