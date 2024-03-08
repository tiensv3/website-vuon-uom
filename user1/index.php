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
                                    Website Vườn Ươm Doanh Nghiệp Phiên Bản 2.0 là nền tảng tiên tiến và đầy đủ chức năng, nhằm hỗ trợ các doanh nghiệp mới khởi nghiệp và phát triển. Phiên bản mới này được thiết kế với giao diện người dùng thân thiện, tối ưu hóa trải nghiệm người dùng, và tích hợp nhiều tính năng mới để cung cấp nguồn thông tin và tư vấn chuyên sâu cho doanh nghiệp.</div>

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
                                <p class="text-justify text-primary font-italic">Mua sắm tiện lợi là trải nghiệm mua sắm thuận lợi và nhanh chóng, giúp tiết kiệm thời gian cho người tiêu dùng. Với sự phát triển của mua sắm trực tuyến, việc chọn lựa và mua hàng trở nên dễ dàng từ bất kỳ đâu, mọi lúc. Các dịch vụ giao hàng nhanh giúp đảm bảo sản phẩm đến tay khách hàng một cách thuận lợi.</p>

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
                                <div class="overlay"></div>
                                <img class="rounded" src="../<?php echo  $business['image'] ?>" alt="" width="200" height="190">
                                <a href="<?php echo $business['image'] ?>" class="img-pop-up" target="_blank">
                                    <div class="deal-details">
                                        <h6 class="deal-title"><?php echo $business['businessname'] ?></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
                <div class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                        <a href='index.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
                    <?php endfor; ?>
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



<!-- Start exclusive deal Area -->
<section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>Các sản phẩm còn khuyến mãi!</h1>
                        <p>Chờ đợi gì nữa mua ngay.</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="row clock-wrap">
                            <div class="col clockinner1 clockinner">
                                <h1 class="days">7</h1>
                                <span class="smalltext">Days</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="hours">23</h1>
                                <span class="smalltext">Hours</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="minutes"></h1>
                                <span class="smalltext">Mins</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="seconds">59</h1>
                                <span class="smalltext">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="primary-btn">Shop Now</a>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">
                    <!-- single exclusive carousel -->
                    <div class="single-exclusive-slider">
                        <img class="img-fluid" src="img/product/e-p1.png" alt="">
                        <div class="product-details">
                            <div class="price">
                                <h6>$150.00</h6>
                                <h6 class="l-through">$210.00</h6>
                            </div>
                            <h4>addidas New Hammer sole
                                for Sports person</h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <a class="add-btn" href=""><span class="ti-bag"></span></a>
                                <span class="add-text text-uppercase">Add to Bag</span>
                            </div>
                        </div>
                    </div>
                    <!-- single exclusive carousel -->
                    <div class="single-exclusive-slider">
                        <img class="img-fluid" src="img/product/e-p1.png" alt="">
                        <div class="product-details">
                            <div class="price">
                                <h6>$150.00</h6>
                                <h6 class="l-through">$210.00</h6>
                            </div>
                            <h4>addidas New Hammer sole
                                for Sports person</h4>
                            <div class="add-bag d-flex align-items-center justify-content-center">
                                <a class="add-btn" href=""><span class="ti-bag"></span></a>
                                <span class="add-text text-uppercase">Add to Bag</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End exclusive deal Area -->

<!-- Start brand Area -->
<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="./user/assets/img/brand/1.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="./user/assets/img/brand/2.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="./user/assets/img/brand/3.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="./user/assets/img/brand/4.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="./user/assets/img/brand/5.png" alt="">
            </a>
        </div>
    </div>
</section>
<!-- End brand Area -->

<!-- Start related-product Area -->
<section class="related-product-area section_gap_bottom">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <div class="section-title">
                    <h3 class="text-uppercase">Sản phẩm khuyến mãi trong tuần</h3>
                    <p class="font-italic">Các sản phẩm khuyến mãi từ các thương hiệu nổi tiếng</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="./user/assets/img/r1.jpg" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Black lace Heels</a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="./user/assets/img/r2.jpg" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Black lace Heels</a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 mb-20">
                        <div class="single-related-product d-flex">
                            <a href="#"><img src="./user/assets/img/r3.jpg" alt=""></a>
                            <div class="desc">
                                <a href="#" class="title">Black lace Heels</a>
                                <div class="price">
                                    <h6>$189.00</h6>
                                    <h6 class="l-through">$210.00</h6>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-3">
                <div class="ctg-right">
                    <a href="#" target="_blank">
                        <img class="img-fluid d-block mx-auto" src="./user/assets/img/category/c5.jpg" alt="">
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