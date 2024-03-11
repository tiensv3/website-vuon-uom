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
	$status = 1;
	$userid = $_SESSION['userid'];

	// Generate a unique order code
	$randletter = chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));
	$randnumber = rand(0000000, 9999999);
	$ordercode = $randletter . $randnumber;

	// Insert order information using prepared statements
	$sql_insert_order = "INSERT INTO orders (ordercode, shipaddress, status, userid, method) VALUES (?, ?, ?, ?, ?)";
	$stmt_insert_order = $conn->prepare($sql_insert_order);
	$stmt_insert_order->bind_param("ssiii", $ordercode, $address, $status, $userid, $method);

	if ($stmt_insert_order->execute()) {
		$orderid = $stmt_insert_order->insert_id;

		// Insert order details using prepared statements
		$sql_insert_detail = "INSERT INTO orderdetails(quantityproduct, productid, orderid, businessid) VALUES (?, ?, ?, ?)";
		$stmt_insert_detail = $conn->prepare($sql_insert_detail);
		$stmt_insert_detail->bind_param("iiii", $quantity, $productid, $orderid, $businessId);

		foreach ($_SESSION['cart'] as $businessId => $products) {
			foreach ($products as $productid => $productDetails) {
				$quantity = $productDetails['product_quantity'];
				$productid = $productDetails['product_id'];

				$stmt_insert_detail->execute();
			}
		}

		unset($_SESSION['cart']);

		echo "<script  language=javascript>
                 alert('Đặt hàng thành công! Chúng tôi sẽ giao hàng cho bạn sớm nhất');
             </script>";
		echo "<script language=javascript>
                 window.location = '../user/Thank.php';
             </script>";
	} else {
		echo "<script  language=javascript>
                 alert('Có lỗi xảy ra khi xử lý đặt hàng. Vui lòng thử lại sau.');
             </script>";
	}

	$stmt_insert_order->close();
	$stmt_insert_detail->close();
}
?>