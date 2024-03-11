<?php
session_start();
include("../connect.php");

/* ------------------------------- Check login ------------------------------ */
if (!isset($_SESSION['account'])) {
    echo "<script language='JavaScript'>
        alert('Vui lòng đăng nhập tài khoản để mua hàng');
        window.location.href = '../login.php';
    </script>";
    exit();
} else {

    /* -------------------------------- Add to cart ------------------------------ */
    if (isset($_POST['addtocart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_sale = $_POST['product_sale'];
        $product_img = $_POST['product_img'];
        $product_quantity = $_POST['product_quantity'];
        $business_id = $_POST['businessid'];

        // Kiểm tra nếu giỏ hàng đã tồn tại và có sản phẩm từ doanh nghiệp đó
        if (isset($_SESSION['cart'][$business_id]) && !empty($_SESSION['cart'][$business_id])) {
            $item_array_id = array_column($_SESSION['cart'][$business_id], "product_id");

            if (!in_array($product_id, $item_array_id)) {
                // Kiểm tra số lượng tồn kho
                $sql_check_stock = "SELECT quantity FROM products WHERE productid = '$product_id'";
                $result_check_stock = $conn->query($sql_check_stock);

                if ($result_check_stock && $row_stock = mysqli_fetch_assoc($result_check_stock)) {
                    $limit_stock = $row_stock['quantity'];
                    $id_pro = $row_stock['productid'];

                    if ($product_quantity <= $limit_stock) {
                        // Số lượng mua không vượt quá số lượng tồn kho, thêm vào giỏ hàng
                        $item_array = array(
                            'product_id' => $product_id,
                            'product_name' => $product_name,
                            'product_price' => $product_price,
                            'product_sale' => $product_sale,
                            'product_img' => $product_img,
                            'product_quantity' => $product_quantity
                        );
                        $_SESSION['cart'][$business_id][] = $item_array;
                        header("Location: ../user/Cart.php");
                    } else {
                        echo "<script language='javascript'>
                        alert('Vui lòng đặt sản phẩm nhỏ hơn số lượng tồn');
                        </script>";
                        echo "<script language='javascript'>
                        window.location.href = '../user/DetailPro.php?action=chitiet&id=" . $product_id . "';
                        </script>";
                    }
                } else {
                    echo "<script language='javascript'>
                        alert('Lỗi kiểm tra số lượng');
                    </script>";
                    echo "<script language='javascript'>
                    window.location.href = '../user/DetailPro.php?action=chitiet&id=" . $product_id . "';
                    </script>";
                }
            } else {
                // Sản phẩm đã tồn tại trong giỏ hàng, cập nhật số lượng
                foreach ($_SESSION['cart'][$business_id] as &$item) {
                    if ($item['product_id'] === $product_id) {
                        $item['product_quantity'] += $product_quantity;
                        break;
                    }
                }
                header("Location: ../user/Cart.php");
            }
        } else {
            // Giỏ hàng chưa tồn tại, tạo mới giỏ hàng
            $item_array = array(
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'product_sale' => $product_sale,
                'product_img' => $product_img,
                'product_quantity' => $product_quantity
            );

            // Kiểm tra số lượng tồn kho
            $sql_check_stock = "SELECT quantity FROM products WHERE productid = '$product_id'";
            $result_check_stock = $conn->query($sql_check_stock);

            if ($result_check_stock && $row_stock = mysqli_fetch_assoc($result_check_stock)) {
                $limit_stock = $row_stock['quantity'];
                $id_pro = $row_stock['productid'];

                if ($product_quantity <= $limit_stock) {
                    // Số lượng mua không vượt quá số lượng tồn kho, thêm vào giỏ hàng
                    $_SESSION['cart'][$business_id][] = $item_array;
                    header("Location: ../user/Cart.php");
                } else {
                    echo "<script language='javascript'>
                        alert('Vui lòng đặt sản phẩm nhỏ hơn số lượng tồn');
                    </script>";
                    echo "<script language='javascript'>
                    window.location.href = '../user/DetailPro.php?action=chitiet&id=" . $product_id . "';
                    </script>";
                }
            } else {
                // Lỗi khi kiểm tra số lượng tồn kho
                echo "Lỗi khi kiểm tra số lượng tồn kho";
            }
        }

        // Chuyển hướng người dùng đến trang giỏ hàng

        exit(); // Ngăn chặn mã PHP tiếp tục chạy
    }
?>





    <!-- update quantity in cart -->
    <?php
    if (isset($_POST['submit-quantity'])) {
        $product_id = $_POST['product_id'];
        $new_quantity = $_POST['qty'];

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['id'] == $product_id) {
                    // Update the quantity
                    $_SESSION['cart'][$key]['quantity'] = $new_quantity;

                    // Recalculate the total
                    $_SESSION['cart'][$key]['total'] = $new_quantity * $_SESSION['cart'][$key]['price'];
                }
            }
        }
        header("Location: ./cart.php");
    }
    ?>


    <!-- Delete id in cart -->
    <?php
    if (isset($_GET['action']) && $_GET['action'] == "delete_product_id") {
        $product_id_to_delete = $_GET['id'];

        if (!empty($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $business_id => $items) {
                foreach ($items as $key => $value) {
                    if ($value['product_id'] == $product_id_to_delete) {
                        unset($_SESSION['cart'][$business_id][$key]);

                        // Nếu giỏ hàng của doanh nghiệp trở thành rỗng, xóa cả doanh nghiệp khỏi giỏ hàng
                        if (empty($_SESSION['cart'][$business_id])) {
                            unset($_SESSION['cart'][$business_id]);
                        }

                        echo "Sản phẩm đã được xóa khỏi giỏ hàng.";
                        header("Location: ./cart.php");
                        exit(); // Ngăn chặn mã PHP tiếp tục chạy sau khi chuyển hướng
                    }
                }
            }
        }

        echo "Không thể xóa sản phẩm khỏi giỏ hàng. Sản phẩm không tồn tại.";
        header("Location: ./cart.php");
        exit(); // Ngăn chặn mã PHP tiếp tục chạy sau khi chuyển hướng
    }
    ?>

    <!-- Delete all in cart -->
<?php
    if (isset($_GET['action']) && $_GET['action'] == 'xoaSP') {
        unset($_SESSION['cart']);
        header('Location: ./Cart.php');
    }
}
?>