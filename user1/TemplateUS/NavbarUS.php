<!-- Start Header Area -->
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <a class="navbar-brand logo_h" href="index.php"><img src="./assets/img/logo.png" alt="" width="100"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto">
                        <li class="nav-item active"><a class="nav-link" href="index.php">Trang chủ</a></li>
                        <!-- <li class="nav-item submenu dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop</a>
                            <ul class="dropdown-menu">
                                <li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
                                <li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a></li>
                                <li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a></li>
                                <li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
                                <li class="nav-item"><a class="nav-link" href="confirmation.html">xml_error_string</a></li>
                            </ul>
                        </li> -->

                        <li class="nav-item"><a class="nav-link" href="../../user/Listcategory.php">Sản phẩm</a></li>
                        <li class="nav-item"><a class="nav-link" href="../user/Contact.php">Liên hệ</a></li>
                        <li class="nav-item submenu dropdown">
                            <?php
                            if (isset($_SESSION['account'])) {
                            ?>
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['account'] ?></a>
                                <ul class="dropdown-menu">
                                    <!-- Thêm các mục menu cho người dùng đã đăng nhập nếu cần -->
                                    <?php

                                    if (isset($_SESSION['business']) || isset($_SESSION['admin'])) {

                                    ?>
                                        <li class="nav-item"><a class="nav-link" href="../../admin/index.php">Quản lý</a></li>
                                    <?php
                                    }

                                    ?>
                                    <li class="nav-item"><a class="nav-link" href="../user/Cart.php">Giỏ hàng</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Hồ sơ</a></li>
                                    <li class="nav-item"><a class="nav-link" href="../../handleLogout.php">Đăng xuất</a></li>
                                </ul>
                            <?php
                            } else {
                            ?>
                                <a class="nav-link" href="../../login.php">Đăng nhập</a>
                            <?php
                            }
                            ?>
                        </li>


                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <div class="search_input" id="search_input_box">
        <div class="container">
            <form class="d-flex justify-content-between">
                <input type="text" class="form-control" id="search_input" placeholder="Search Here">
                <button type="submit" class="btn"></button>
                <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
            </form>
        </div>
    </div>
</header>