<?php //section php connect and session
session_start();
include("../connect.php");
?>

<?php
include("../user/TemplateUS/HeaderUS.php");
include("../user/TemplateUS/NavbarUS.php");
?>


<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">

    <div class="container">
        <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
            <div class="col-first">
                <h1 class="text-uppercase text-black" style="color: #000;">Xác nhận thanh toán</h1>
                <nav class="d-flex align-items-center font-italic">
                    <a href="index.html" style="color: #000;">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                    <a href="../user/Cart.php" style="color: #000;">Giỏ hàng<span class="lnr lnr-arrow-right"></span></a>
                    <a href="../user/Checkout.php" style="color: #000;">Xác nhận thanh toán</a>
                </nav>
            </div>

        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================ Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="text-uppercase">Chi tiết hóa đơn</h2>
                    <form class="row contact_form" action="../user/HandleCheckout.php" method="post" novalidate="novalidate">
                        <?php
                        /* ----------------------------- load Info user ----------------------------- */
                        if (isset($_SESSION['info_user']) && is_array($_SESSION['info_user'])) {
                            $InforUser = $_SESSION['info_user'];
                        ?>
                            <div class="col-md-6 form-group p_star">
                                <label for="name" style="color: #000;" class="mb-2 font-italic">Họ và Tên:</label>
                                <input type="text" class="form-control" id="name" style="color: #000;" name="fullname" value="<?php echo $InforUser['fullname']; ?>" required>
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <label for="email" style="color: #000;" class="mb-2 font-italic">Email:</label>
                                <input type="email" class="form-control" id="email" style="color: #000;" name="email" value="<?php echo $InforUser['email']; ?>" required>
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <label for="phone" style="color: #000;" class="mb-2 font-italic">Số điện thoại:</label>
                                <input type="text" class="form-control" id="phone" style="color: #000;" name="phone" value="<?php echo $InforUser['phone']; ?>" required>
                            </div>

                            <div class="col-md-12 form-group p_star">
                                <label for="address" style="color: #000;" class="mb-2 font-italic">Địa chỉ:</label>
                                <input type="text" class="form-control" id="address" style="color: #000;" name="address" value="<?php echo $InforUser['address']; ?>" required>
                            </div>

                            <div class="col-md-6 form-group p_star">
                                <label for="method" style="color: #000;" class="mb-2 font-italic">Hình thức thanh toán:</label>
                                <select name="method" id="" class="form-control">
                                    <option value="1">Thanh toán tiền mặt khi nhận hàng (COD)</option>
                                    <option value="2">Thanh toán qua ngân hàng (ATM)</option>
                                </select>
                            </div>

                            <div class="col-md-12 ">
                                <input type="submit" name="ConfirmCheckout" value="Xác nhận thanh toán" class="btn btn-success w-100">
                            </div>
                        <?php
                        }
                        ?>
                    </form>

                </div>

                <div class="col-lg-4">
                    <div class="order_box">
                        <h2>Hóa đơn của bạn</h2>
                        <ul class="list">
                            <?php
                            if (isset($_POST['selected_product_cart']) && !empty($_POST['selected_product_cart'])) {
                                $selectedProductIds = $_POST['selected_product_cart'];

                                foreach ($selectedProductIds as $productId) {
                                    // Check if the product is in the cart
                                    foreach ($_SESSION['cart'] as $businessId => $items) {
                                        $productDetail = getProductDetailsFromCart($productId, $businessId, $conn);

                                        if ($productDetail) {
                            ?>
                                            <li><a href="#" style="color: #000;">Sản phẩm từ: <?php echo $productDetail['business_name'] ?> <span>Tổng</span></a></li>
                                            <li>
                                                <a href="#">
                                                    <?php echo $productDetail['product_name'] ?>
                                                    <span class="middle">x <?php echo $productDetail['product_quantity'] ?></span>
                                                    <span class="last"><?php echo number_format($productDetail['product_price']) ?> vnđ</span>
                                                </a>
                                            </li>
                            <?php
                                        }
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>




            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->
<?php
function getProductDetailsFromCart($productId, $businessId, $conn)
{
    // Kiểm tra xem giỏ hàng có tồn tại không và có sản phẩm được chọn không
    if (isset($_SESSION['cart'][$businessId]) && !empty($_SESSION['cart'][$businessId])) {
        foreach ($_SESSION['cart'][$businessId] as $item) {
            if ($item['product_id'] == $productId) {
                // lấy tên thông tin doanh nghiệp
                $item['business_name'] = getBusinessNameById($businessId, $conn);
                // Trả về thông tin sản phẩm từ giỏ hàng đã chọn
                return $item;
            }
        }
    }

    return false;
}


function getBusinessNameById($businessId, $conn)
{
    $sql_select_business = "SELECT businessname FROM businesses WHERE businessid = '" . $businessId . "'";
    $result_select_business = $conn->query($sql_select_business);

    if ($result_select_business) {
        $row_business = $result_select_business->fetch_assoc();
        return isset($row_business['businessname']) ? $row_business['businessname'] : 'Không xác định';
    }
}
?>


<?php
include("../user/TemplateUS/FooterUS.php")
?>