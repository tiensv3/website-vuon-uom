<?php
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
                <h1 class="text-uppercase text-black" style="color: #000;">Chi tiết sản phẩm</h1>
                <nav class="d-flex align-items-center font-italic">
                    <a href="index.html" style="color: #000;">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
                    <a href="#" style="color: #000;">Sản phẩm<span class="lnr lnr-arrow-right"></span></a>
                    <a href="single-product.html" style="color: #000;">Chi tiết sản phẩm</a>
                </nav>
            </div>

        </div>
    </div>
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area mt-5">
    <h2 class="text-uppercase text-center">Giỏ hàng</h2>
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Tổng</th>
                            <th scope="col">Quản lý</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- load giỏ hàng -->
                        <?php
                        $totalPrice = 0;
                        $tempArray = array(); //mảng kiểm tra trùng lặp
                        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item) {
                                if (isset($tempArray[$item['id']])) {
                                    // Nếu đã thêm, cập nhật thông tin số lượng và tổng giá
                                    $tempArray[$item['id']]['quantity'] += $item['quantity'];
                                    $tempArray[$item['id']]['total'] += $item['total'];
                                } else {
                                    // Nếu chưa thêm, thêm vào mảng tạm và hiển thị thông tin
                                    $tempArray[$item['id']] = $item;
                                }
                            }

                            foreach ($tempArray as $item) {
                                $totalPrice += $item['total'];

                        ?>
                        <tr>
                            <td>
                                <div class="media">
                                    <!-- <div class="d-flex">
                                                    <img src="../user/assets/img/cart.jpg" alt="">
                                                </div> -->
                                    <div class="media-body">
                                        <p class="text-uppercase"><?php echo $item['name'] ?></p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5><?php echo number_format($item['price']) . ' VNĐ' ?></h5>
                            </td>
                            <td>
                                <form action="../user/HandleCart.php" method="POST">
                                    <div class="product_count">
                                        <input type=" text" name="qty" id="sst<?php echo $item['id']; ?>" maxlength="12"
                                            value="<?php echo $item['quantity'] ?>" title="Quantity:"
                                            class="input-text qty">
                                        <input type="hidden" name="product_id" value="<?php echo $item['id'] ?>">
                                        <!-- Thêm ID sản phẩm vào sự kiện JavaScript -->
                                        <button onclick="increaseQuantity(<?php echo $item['id']; ?>)"
                                            class="increase items-count" type="button"><i
                                                class="lnr lnr-chevron-up"></i></button>
                                        <button onclick="decreaseQuantity(<?php echo $item['id']; ?>)"
                                            class="reduced items-count" type="button"><i
                                                class="lnr lnr-chevron-down"></i></button>
                                    </div>
                                    <input type="submit" name="submit-quantity" class="btn btn-success"
                                        value="Cập nhật">
                                </form>
                            </td>
                            <td>
                                <h6 class="w-100"><?php echo number_format($item['total']) . ' VNĐ' ?></h6>
                            </td>
                            <td>
                                <form action="../user/HandleCart.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id'] ?>">
                                    <input type="submit" name="delete_product_id" value="Xóa" class="btn btn-danger">
                                </form>
                            </td>

                        </tr>
                        <?php
                            }
                        } else {
                            echo '<div class="text-center text-uppercase m-5 text-danger">Không có sản phẩm trong giỏ hàng vui lòng mua hàng </div>';
                        }
                        ?>

                        <tr class="bottom_button">
                            <td>
                                <a class="gray_btn p-3" href="../user/HandleCart.php?action=xoaSP">Xóa tất cả sản
                                    phẩm</a>
                            </td>
                            <td>
                            </td>
                            <td>

                            </td>
                            <td>
                                <h4>Tổng giá</h4>
                            </td>
                            <td>

                                <h4><?php echo number_format($totalPrice) ?> VNĐ</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>

                            </td>
                        </tr>

                        <tr class="shipping_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                            </td>
                            <td>
                                <h4 class="text-uppercase">Phí giao hàng</h4>

                            </td>
                            <td>
                                <div class="shipping_box">
                                    <ul class="list">
                                        <li><a href="#">
                                                <?php
                                                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                                    $totalQuantity = 0;

                                                    // Tính tổng số lượng của tất cả các sản phẩm trong giỏ hàng
                                                    foreach ($_SESSION['cart'] as $item) {
                                                        $totalQuantity += $item['quantity'];
                                                    }

                                                    // Xác định chi phí vận chuyển dựa trên tổng số lượng
                                                    if ($totalQuantity >= 8) {
                                                        echo 'Miễn phí giao hàng';
                                                    } elseif ($totalQuantity <= 7 && $totalQuantity >= 4) {
                                                        echo number_format(40000) . ' VNĐ';
                                                    } elseif ($totalQuantity < 4 && $totalQuantity > 0) {
                                                        echo number_format(80000) . ' VNĐ';
                                                    }
                                                }
                                                ?>

                                            </a></li>

                                    </ul>

                                </div>
                            </td>
                        </tr>
                        <tr class="out_button_area">
                            <td>

                            </td>
                            <td>

                            </td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn mr-5" href="./Listcategory.php">Tiếp tục mua hàng</a>
                                    <?php
                                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                                    ?>
                                    <a class="primary-btn" href="../user/Checkout.php">Thanh toán</a>
                                    <?php
                                    }
                                    ?>
                                </div>

                            </td>
                            <td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->





<?php
include("../user/TemplateUS/FooterUS.php")
?>