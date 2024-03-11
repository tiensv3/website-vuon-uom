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
                        <h2 class="text-uppercase">Hóa đơn của bạn</h2>
                        <ul class="list">
                            <li><a href="#">Sản phẩm<span>Tổng</span></a></li>
                            <?php
                            if (isset($_SESSION['cart'])) {
                                $subtotal = 0;
                                foreach ($_SESSION['cart'] as $itemCart) {
                                    $subtotal += $itemCart['quantity'] * $itemCart['price']

                            ?>
                                    <li><a href="#"><?php echo $itemCart['name'] ?> <span class="middle">x <?php echo $itemCart['quantity'] ?></span> <span class="last"><?php echo number_format($itemCart['total']) . ' VNĐ' ?></span></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                        <ul class="list list_2">
                            <li><a href="#">Tổng hóa đơn:<span><?php echo number_format($subtotal) . ' VNĐ' ?></span></a></li>
                            <li><a href="#">Phí giao hàng:<span>
                                        <?php
                                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                            $totalQuantity = 0;
                                            $total = $subtotal; // Bắt đầu với tổng số lượng

                                            // Tính tổng số lượng của tất cả các sản phẩm trong giỏ hàng
                                            foreach ($_SESSION['cart'] as $item) {
                                                $totalQuantity += $item['quantity'];
                                            }

                                            // Xác định chi phí vận chuyển dựa trên tổng số lượng
                                            if ($totalQuantity >= 8) {
                                                echo 'Miễn phí giao hàng';
                                            } elseif ($totalQuantity <= 7 && $totalQuantity >= 4) {
                                                $shippingFee = 40000;
                                                echo number_format($shippingFee) . ' VNĐ';
                                                $total += $shippingFee; // Cộng thêm phí giao hàng vào tổng
                                            } elseif ($totalQuantity < 4 && $totalQuantity > 0) {
                                                $shippingFee = 80000;
                                                echo number_format($shippingFee) . ' VNĐ';
                                                $total += $shippingFee; // Cộng thêm phí giao hàng vào tổng
                                            }
                                        }

                                        $_SESSION['total'] = $total;
                                        ?>
                                    </span></a></li>
                            <li><a href="#">Tổng:<span><?php echo number_format($total) . ' VNĐ' ?></span></a></li>
                        </ul>
                        <!-- <div class="creat_account">
                            <input type="checkbox" id="f-option4" name="selector">
                            <label for="f-option4">Vui lòng đọc</label>
                            <a href="#">Chính sách & dịch vụ *</a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

<?php
include("../user/TemplateUS/FooterUS.php")
?>