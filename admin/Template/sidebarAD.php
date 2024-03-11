<div class="container-fluid page-body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION["admin"])) {
                ?>
                    <a class="nav-link" href="../admin/index.php">
                        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                        <span class="menu-title">Trang chủ</span>
                    </a>
                <?php
                } elseif (isset($_SESSION["business"])) {
                ?>
                    <a class="nav-link" href="../admin/BSindex.php">
                        <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                        <span class="menu-title">Trang chủ</span>
                    </a>
                <?php
                }
                ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <span class="icon-bg"><i class="mdi mdi-clipboard-text menu-icon"></i></span>
                    <span class="menu-title">Quản lý</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <?php
                        if (isset($_SESSION['admin'])) {
                        ?>
                            <li class="nav-item"> <a class="nav-link" href="/admin/ADlist.php">Danh sách doanh nghiệp</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="/admin/ADpackages.php">Quản lý gói dịch vụ</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="/admin/ADregisterpackages.php">Danh sách
                                    đăng ký gói</a></li>

                        <?php
                        } elseif (isset($_SESSION['business'])) {
                        ?>
                            <li class="nav-item"> <a class="nav-link" href="/admin/BScategory.php">Danh sách danh mục</a>
                            </li>
                            <li class="nav-item"> <a class="nav-link" href="/admin/BSproduct.php">Quản lý sản phẩm</a></li>
                            <li class="nav-item"> <a class="nav-link" href="/admin/BSmypackage.php">Gói của tôi</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION['business'])) {
                ?>
                    <a class="nav-link" href="/admin/BSregisterpackages.php">
                        <span class="icon-bg"><i class="mdi mdi-clock menu-icon"></i></span>
                        <span class="menu-title">Gói dịch vụ</span>
                    </a>
                <?php
                } elseif (isset($_SESSION['admin'])) {
                ?>
                    <a class="nav-link" href="/admin/ADregisterpackages.php">
                        <span class="icon-bg"><i class="mdi mdi-contacts menu-icon"></i></span>
                        <span class="menu-title">Danh sách đăng ký gói</span>
                    </a>
                <?php
                }
                ?>
            </li>
            <li class="nav-item">
                <?php
                if (isset($_SESSION['business'])) {
                ?>
                    <a class="nav-link" href="/admin/BSorders.php">
                        <span class="icon-bg"><i class="mdi mdi-truck menu-icon"></i></span>
                        <span class="menu-title">Đơn đặt hàng</span>
                    </a>
                <?php
                } elseif (isset($_SESSION['admin'])) {
                ?>
                    <a class="nav-link" href="/admin/ADregisterpackages.php">
                        <span class="icon-bg"><i class="mdi mdi-truck menu-icon"></i></span>
                        <span class="menu-title">Thống kê đơn đặt hàng</span>
                    </a>
                <?php
                }
                ?>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="pages/charts/chartjs.html">
                    <span class="icon-bg"><i class="mdi mdi-chart-bar menu-icon"></i></span>
                    <span class="menu-title">Charts</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/tables/basic-table.html">
                    <span class="icon-bg"><i class="mdi mdi-table-large menu-icon"></i></span>
                    <span class="menu-title">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                    <span class="icon-bg"><i class="mdi mdi-lock menu-icon"></i></span>
                    <span class="menu-title">User Pages</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="auth">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/blank-page.html"> Blank Page </a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/register.html"> Register </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/error-404.html"> 404 </a></li>
                        <li class="nav-item"> <a class="nav-link" href="pages/samples/error-500.html"> 500 </a></li>
                    </ul>
                </div>
            </li>
            <!-- <li class="nav-item documentation-link">
                <a class="nav-link" href="http://www.bootstrapdash.com/demo/connect-plus-free/jquery/documentation/documentation.html" target="_blank">
                    <span class="icon-bg">
                        <i class="mdi mdi-file-document-box menu-icon"></i>
                    </span>
                    <span class="menu-title">Documentation</span>
                </a>
            </li>
            <li class="nav-item sidebar-user-actions">
                <div class="user-details">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="d-flex align-items-center">
                                <div class="sidebar-profile-img">
                                    <img src="assets/images/faces/face28.png" alt="image">
                                </div>
                                <div class="sidebar-profile-text">
                                    <p class="mb-1">Henry Klein</p>
                                </div>
                            </div>
                        </div>
                        <div class="badge badge-danger">3</div>
                    </div>
                </div>
            </li>
            <li class="nav-item sidebar-user-actions">
                <div class="sidebar-user-menu">
                    <a href="#" class="nav-link"><i class="mdi mdi-settings menu-icon"></i>
                        <span class="menu-title">Settings</span>
                    </a>
                </div>
            </li>
            <li class="nav-item sidebar-user-actions">
                <div class="sidebar-user-menu">
                    <a href="#" class="nav-link"><i class="mdi mdi-speedometer menu-icon"></i>
                        <span class="menu-title">Take Tour</span></a>
                </div>
            </li>
            <li class="nav-item sidebar-user-actions">
                <div class="sidebar-user-menu">
                    <a href="#" class="nav-link"><i class="mdi mdi-logout menu-icon"></i>
                        <span class="menu-title">Log Out</span></a>
                </div>
            </li> -->
        </ul>
    </nav>