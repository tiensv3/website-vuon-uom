<?php
session_start();
include("../connect.php");
?>

<!-- thêm giỏ hàng  -->
<?php
/* -------------------- Hàm để thêm sản phẩm vào giỏ hàng ------------------- */
function addToCart($id, $name, $quantity, $price_sell)
{
    // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới
    $_SESSION['cart'][] = array(
        'id' => $id,
        'name' => $name,
        'quantity' => $quantity,
        'price' => $price_sell,
        'total' => $quantity * $price_sell
    );
}
?>

<!-- Xử lý Thêm vào Giỏ hàng -->
<?php
if (!isset($_SESSION['account'])) {
    echo ("<script language=javascript>
        alert('Vui lòng đăng nhập để sử dụng tính năng này!');
        </script> ");
    echo ("<script language=javascript>
        window.location='../login.php';
        </script> ");
} else {

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Xử lý khi người dùng click vào nút để thêm sản phẩm vào giỏ hàng
    if (isset($_POST['addtocart'])) {
        if (isset($_POST['product_id']) && isset($_POST['product_name']) && isset($_POST['product_quantity']) && isset($_POST['product_price']) && isset($_POST['product_sale'])) {
            // Lấy thông tin sản phẩm từ form
            $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_quantity = $_POST['product_quantity'];
            $product_price = $_POST['product_price'];
            $product_sale = $_POST['product_sale'];

            if (isset($product_sale) > 0) {
                addToCart($product_id, $product_name, $product_quantity, $product_sale);
            } else {
                addToCart($product_id, $product_name, $product_quantity, $product_price);
            }
            // Thêm sản phẩm vào giỏ hàng
        }
        header("Location: ./Cart.php");
    }
}

?>


<!-- Delete id in cart -->
<?php
if (isset($_POST['delete_product_id'])) {
    $product_id_to_delete = $_POST['product_id'];

    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $product_id_to_delete) {
                unset($_SESSION['cart'][$key]);
            }
        }
    }
    header("Location: ./cart.php");
}
?>

<!-- Delete all in cart -->
<?php
if (isset($_GET['action']) && $_GET['action'] == 'xoaSP') {
    unset($_SESSION['cart']);
    header('Location: ./Cart.php');
}
?>