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
    <div class="container">
        <h2 class="text-uppercase text-center mb-5">Giỏ hàng của bạn</h2>

        <?php
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $subtotal = 0;
            foreach ($_SESSION['cart'] as $business_key => $items) {
                $sql_select_business = "SELECT * FROM Businesses WHERE businessid = '" . $business_key . "'";
                $result_select_business = $conn->query($sql_select_business);
                while ($namebusiness = mysqli_fetch_array($result_select_business)) {
        ?>

                    <div class="card mb-4">
                        <div class="card-header bg-primary ">
                            <h5 style="color: #fff;" class=""> Các sản phẩm từ: <?php echo $namebusiness['businessname'] ?></h5>
                        </div>
                        <div class=" card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="bg-success text-white">
                                        <tr>
                                            <th></th>
                                            <th scope="col">Sản phẩm</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Tổng</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($items as $item) {
                                            $subtotal = $item['product_price'] * $item['product_quantity'];

                                            $sql_select_stock = "SELECT quantity, businessid FROM products WHERE productid = '" . $item['product_id'] . "'";
                                            $result_select_stock = $conn->query($sql_select_stock);

                                            while ($row_stock = mysqli_fetch_array($result_select_stock)) {
                                        ?>
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="selected_products[]" value="<?php echo $item['product_id']; ?>" class="form-group mr-4">
                                                        <input type="hidden" name="business_ids[]" value="<?php echo $row_stock['businessid']; ?>">
                                                        <img src="../<?php echo $item['product_img'] ?>" alt="<?php echo $item['product_name'] ?>" width="80">
                                                    </td>
                                                    <td>
                                                        <span class="ml-2"><?php echo $item['product_name'] ?></span>
                                                    </td>
                                                    <td><?php echo number_format($item['product_price']) . ' vnđ' ?></td>
                                                    <td>

                                                        <form action="../user/HandleCart.php" method="post">
                                                            <?php
                                                            if ($item['product_quantity'] <= $row_stock['quantity']) {
                                                            ?>
                                                                <input type="number" name="product_quantity" id="" min="1" max="999" value="<?php echo $item['product_quantity'] ?>">
                                                            <?php
                                                            } else if ($item['product_quantity'] > $row_stock['quantity']) {
                                                            ?>
                                                                <input type="number" name="product_quantity" id="" min="1" max="999" value="<?php echo $row_stock['quantity'] ?>">
                                                            <?php
                                                            }
                                                            ?>
                                                            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                                            <input type="submit" name="submit-quantity" value="Cập nhật" class="btn btn-warning">
                                                        </form>
                                                    </td>
                                                    <td><?php echo number_format($subtotal) . ' vnđ' ?></td>
                                                    <td>
                                                        <a href="../user/HandleCart.php?action=delete_product_id&id=<?php echo $item['product_id'] ?>" class="btn btn-danger">Xóa</a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                        </div>

                    </div>

        <?php
                }
            }
        } else {
            echo '<div class="text-center text-uppercase m-5 text-danger">Không có sản phẩm trong giỏ hàng. Vui lòng mua hàng.</div>';
        }
        ?>

        <?php
        if (!empty($_SESSION['cart'])) {
        ?>
            <div class="row">
                <div class="col-md-3">
                    <a href="../user/HandleCart.php?action=xoaSP" class="btn btn-danger w-50 p-2 text-uppercase">Xóa tất cả</a>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-3">
                    <a href="" class="btn btn-warning p-2 w-100 text-uppercase">Tiếp tục mua hàng</a>
                </div>
                <div class="col-md-2">
                    <?php
                    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    ?>
                        <button onclick="checkoutSelectedProducts()" class="btn btn-success w-100 p-2 text-uppercase">Đặt hàng</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</section>

<script>
    function checkoutSelectedProducts() {
        // Thêm logic xử lý khi nút "Thanh toán" được nhấn
        var selectedProducts = document.querySelectorAll('input[name="selected_products[]"]:checked');

        // Kiểm tra xem có sản phẩm được chọn hay không
        if (selectedProducts.length === 0) {
            alert('Vui lòng chọn ít nhất một sản phẩm để thanh toán.');
            return; // Dừng hàm nếu không có sản phẩm được chọn
        }

        var selectedProductIds = Array.from(selectedProducts).map(item => item.value);

        // Gửi danh sách sản phẩm được chọn đến trang xử lý thanh toán
        // Thay đổi action và method của form theo đường dẫn và phương thức xử lý thanh toán của bạn
        var checkoutForm = document.createElement('form');
        checkoutForm.action = '../user/Checkout.php';
        checkoutForm.method = 'post';

        selectedProductIds.forEach(productId => {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'selected_product_cart[]';
            input.value = productId;
            checkoutForm.appendChild(input);

            // Lấy businessId tương ứng với sản phẩm và thêm vào form
            var businessIdInput = document.querySelector('input[name="business_ids[]"][value="' + productId + '"]');
            if (businessIdInput) {
                var businessId = businessIdInput.value;

                var inputBusinessId = document.createElement('input');
                inputBusinessId.type = 'hidden';
                inputBusinessId.name = 'business_id_cart[' + productId + ']';
                inputBusinessId.value = businessId;
                checkoutForm.appendChild(inputBusinessId);
            }
        });

        document.body.appendChild(checkoutForm);
        checkoutForm.submit();
    }
</script>

<!--================End Cart Area =================-->





<?php
include("../user/TemplateUS/FooterUS.php")
?>