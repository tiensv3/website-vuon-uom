<?php
session_start();
include('../connect.php');
?>

<?php
include("../user/TemplateUS/HeaderUS.php");
include("../user/TemplateUS/NavbarUS.php");
?>

<!-- start banner Area -->
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class="active-banner-slider owl-carousel">
                    <!-- single-slide -->
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content  p-5 ml-4">
                                <h4 class="text-uppercase">Vườn ươm doanh nghiệp<br>Phiên bản 2.0!</h4>
                                <div class="text text-primary text-justify font-italic">
                                    Website Vườn Ươm Doanh Nghiệp Phiên Bản 2.0 là nền tảng tiên tiến và đầy đủ chức
                                    năng, nhằm hỗ trợ các doanh nghiệp mới khởi nghiệp và phát triển. Phiên bản mới này
                                    được thiết kế với giao diện người dùng thân thiện, tối ưu hóa trải nghiệm người
                                    dùng, và tích hợp nhiều tính năng mới để cung cấp nguồn thông tin và tư vấn chuyên
                                    sâu cho doanh nghiệp.</div>

                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="./assets/img/banner/icon_1.gif" alt="">
                            </div>
                        </div>
                    </div>

                    <!-- single-slide -->
                    <div class="row single-slide align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content p-5 ml-4">
                                <h4 class="text-uppercase">Nơi mua sắm tiện lợi!</h4>
                                <p class="text-justify text-primary font-italic">Mua sắm tiện lợi là trải nghiệm mua sắm
                                    thuận lợi và nhanh chóng, giúp tiết kiệm thời gian cho người tiêu dùng. Với sự phát
                                    triển của mua sắm trực tuyến, việc chọn lựa và mua hàng trở nên dễ dàng từ bất kỳ
                                    đâu, mọi lúc. Các dịch vụ giao hàng nhanh giúp đảm bảo sản phẩm đến tay khách hàng
                                    một cách thuận lợi.</p>

                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="./assets/img/banner/icon_2.gif" alt="">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="./assets/img/features/f-icon1.png" alt="">
                    </div>
                    <h6 class="text-uppercase">Vận chuyển</h6>
                    <p class="font-italic">Giao hàng nhanh và tiết kiệm</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="./assets/img/features/f-icon2.png" alt="">
                    </div>
                    <h6 class="text-uppercase">Chính sách đổi trả</h6>
                    <p class="font-italic">Đổi trả trong vòng 72 giờ</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="./assets/img/features/f-icon3.png" alt="">
                    </div>
                    <h6 class="text-uppercase">Hỗ trợ 24/7</h6>
                    <p class="font-italic">Mọi lúc, mọi nơi.</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="./assets/img/features/f-icon4.png" alt="">
                    </div>
                    <h6 class="text-uppercase">Chính sách bảo mật</h6>
                    <p class="font-italic">An toàn tuyệt đối</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->

<!-- Start category Area -->
<section class="category-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <?php
                    /* ------------------------------- pagination ------------------------------- */
                    $limit = 6;
                    $page = isset($_GET['page']) ? $_GET['page'] : 1;

                    $offset = ($page - 1) * $limit;

                    $sql_select_business = "SELECT * FROM businesses LIMIT  $limit OFFSET $offset";
                    $result_select_business = mysqli_query($conn, $sql_select_business);

                    // Truy vấn SQL để lấy tổng số lượng danh mục (để tính toán phân trang)
                    $total_pages_sql = "SELECT COUNT(*) FROM businesses";
                    $total_pages_result = $conn->query($total_pages_sql);
                    $total_pages = ceil($total_pages_result->fetch_assoc()['COUNT(*)'] / $limit);


                    while ($business = mysqli_fetch_array($result_select_business)) {
                    ?>
                    <div class="col-lg-4 col-md-4">
                        <div class="single-deal">
                            <img class="rounded" src="../<?php echo $business['image'] ?>" alt="" width="200"
                                height="190">
                            <a href="./ListBrand.php?action=thuonghieu&id=<?php echo $business['businessid'] ?>"
                                target="_blank">
                                <div class="deal-details">
                                    <h6 class="deal-title" style="color: #000;"><?php echo $business['businessname'] ?>
                                    </h6>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
                <div class="row ">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-6">

                        <div class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <a href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single-deal">
                    <div class="overlay"></div>
                    <img class="img-fluid w-100" src="./assets/img/category/c5.jpg" alt="">
                    <a href="img/category/c5.jpg" class="img-pop-up" target="_blank">
                        <div class="deal-details">
                            <h6 class="deal-title">THƯƠNG HIỆU NỔI TIẾNG</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End category Area -->

<!-- list All product -->

<!-- start product Area -->
<section class="owl-carousel active-product-area section_gap">
    <!-- single product slide -->

    <?php
    $sql_select_by_business_product = "SELECT * FROM businesses GROUP BY businesses.businessid";
    $result_select_by_business_product = $conn->query($sql_select_by_business_product);

    while ($product_business = mysqli_fetch_array($result_select_by_business_product)) {
    ?>
    <div class="single-product-slider">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1><?php echo $product_business['businessname'] ?></h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                    $business_id = $product_business['businessid']; // lấy id của doanh nghiệp
                    $sql_select_product_business = "SELECT * FROM products WHERE businessid = $business_id ORDER BY products.productid DESC LIMIT 8";
                    $result_select_product_business = $conn->query($sql_select_product_business);

                    while ($product = mysqli_fetch_array($result_select_product_business)) {
                    ?>
                <!-- single product -->
                <div class="col-lg-3 col-md-6">
                    <div class="single-product">
                        <img class="" src="../<?php echo $product['thumbnail'] ?>" alt="" height="300">
                        <div class="product-details">
                            <h6><?php echo $product['productname'] ?></h6>
                            <div class="price">
                                <?php
                                        if ($product['sale']) {
                                        ?>
                                <h6><?php echo number_format($product['sale']) . ' VNĐ' ?></h6>
                                <h6 class="l-through"><?php echo number_format($product['price']) . ' VNĐ' ?></h6>
                                <?php
                                        } else {
                                        ?>
                                <h6 class=""><?php echo number_format($product['price']) . ' VNĐ' ?></h6>
                                <?php
                                        }
                                        ?>
                            </div>
                            <div class="prd-bottom">
                                <div class="row">
                                    <div class="col-12 ">
                                        <form action="../user/HandleCart.php" method="post">
                                            <input type="hidden" name="product_id"
                                                value="<?php echo $product['productid'] ?>">
                                            <input type="hidden" name="product_name"
                                                value="<?php echo $product['productname'] ?>">
                                            <input type="hidden" name="product_price"
                                                value="<?php echo $product['price'] ?>">
                                            <input type="hidden" name="product_sale"
                                                value="<?php echo $product['sale'] ?>">
                                            <input type="hidden" name="business_id" id=""
                                                value="<?php echo $product['businessid'] ?>">
                                            <input type="hidden" name="product_quantity" id="" value="1">

                                            <input type="submit" name="addtocart" class="btn btn-success w-100 mb-2"
                                                value="Mua hàng">
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- <a href="" class="social-info">
                                                <span class="lnr lnr-heart"></span>
                                                <p class="hover-text">Wishlist</p>
                                            </a>
                                        <a href="" class="social-info">
                                            <span class="lnr lnr-sync"></span>
                                            <p class="hover-text">compare</p>
                                        </a> -->
                                    <a href="../user/DetailPro.php?action=chitiet&id=<?php echo $product['productid'] ?>"
                                        class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">chi tiết</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <?php
    }
    ?>


</section>
<!-- end product Area -->


<!-- Start exclusive deal Area -->
<section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>Exclusive Hot Deal Ends Soon!</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="row clock-wrap">
                            <div class="col clockinner1 clockinner">
                                <h1 class="days">3</h1>
                                <span class="smalltext">Ngày</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="hours">23</h1>
                                <span class="smalltext">Giờ</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="minutes">47</h1>
                                <span class="smalltext">Phút</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="seconds">59</h1>
                                <span class="smalltext">Giây</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="primary-btn">Mua ngay</a>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">
                    <?php
                    $sql_select_pro_sell = "SELECT COUNT(orderdetails.productid) AS soluongdaban, 
                    orderdetails.productid, 
                    products.productid AS product_id, 
                    products.productname, 
                    products.price, 
                    products.sale, 
                    products.thumbnail 
                    FROM orderdetails 
                    INNER JOIN products ON products.productid = orderdetails.productid 
                    GROUP BY orderdetails.productid 
                    ORDER BY soluongdaban DESC 
                    LIMIT 6;";
                    $result_select_pro_sell = $conn->query($sql_select_pro_sell);
                    while ($pro_trending_sell = mysqli_fetch_array($result_select_pro_sell)) {
                    ?>
                    <!-- single exclusive carousel -->
                    <div class="single-exclusive-slider">
                        <img class="img-fluid rounded" src="../<?php echo $pro_trending_sell['thumbnail'] ?>" alt="">
                        <div class="product-details mt-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <p>Đã bán :
                                        <span><?php echo number_format($pro_trending_sell['soluongdaban']) . ' sản phẩm' ?></span>
                                    </p>
                                </div>
                                <div class="col-md-6">

                                </div>
                            </div>
                            <div class="price">
                                <?php
                                    if ($pro_trending_sell['sale']) {
                                    ?>
                                <h5><?php echo number_format($pro_trending_sell['sale']) . ' VNĐ' ?></h5>
                                <h6 class="l-through"><?php echo number_format($pro_trending_sell['price']) . ' VNĐ' ?>
                                </h6>
                                <?php
                                    } else if (!$pro_trending_sell['sale']) {
                                    ?>

                                <h5><?php echo number_format($pro_trending_sell['price']) . ' VNĐ' ?></h5>
                                <?php
                                    }
                                    ?>
                            </div>
                            <h4><?php echo $pro_trending_sell['productname'] ?></h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <form action="../user/HandleCart.php" method="post">
                                    <input type="hidden" name="product_id"
                                        value="<?php echo $pro_trending_sell['productid'] ?>">
                                    <input type="hidden" name="product_name"
                                        value="<?php echo $pro_trending_sell['productname'] ?>">
                                    <input type="hidden" name="product_price"
                                        value="<?php echo $pro_trending_sell['price'] ?>">
                                    <input type="hidden" name="product_sale"
                                        value="<?php echo $pro_trending_sell['sale'] ?>">
                                    <input type="hidden" name="product_quantity" id="" value="1">

                                    <input type="submit" name="addtocart" class="btn btn-success w-100 mb-2"
                                        value="Mua hàng">
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End exclusive deal Area -->

<!-- Start đối tác Area -->
<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="../user/assets/img/brand/1.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="../user/assets/img/brand/2.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="../user/assets/img/brand/3.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="../user/assets/img/brand/4.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="../user/assets/img/brand/5.png" alt="">
            </a>
        </div>
    </div>
</section>
<!-- End đối tác Area -->

<!-- Start sản phẩm sale trong  Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h1>Giảm giá trong tuần</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore
                        magna aliqua.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <?php
                    $trending = 1;
                    $sql_select_hot = "SELECT * FROM products WHERE trending = '" . $trending . "'";
                    $result_select_hot = $conn->query("$sql_select_hot");

                    while ($row_trending = mysqli_fetch_array($result_select_hot)) {
                    ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="../<?php echo $row_trending['thumbnail']   ?>" alt="" width="80"></a>
                            <div class="desc">
                                <a href="#" class="title"><?php echo $row_trending['productname'] ?></a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="../user/assets/img/category/c5.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End related-product Area -->

<?php
include("../user/TemplateUS/FooterUS.php");
?>