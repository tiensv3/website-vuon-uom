<?php
include("../connect.php");
?>
<?php
include("./Template/headerBS.php");
include("./Template/navbarAD.php");
include("./Template/sidebarAD.php");
?>
<div class="container">
    <div class="row">
        <?php
        if (isset($_SESSION["message"])) {
            echo "" . $_SESSION["message"] . "";
            unset($_SESSION["message"]);
        }
        ?>
    </div>
    <h2>Đơn đặt hàng</h2>
    <div class="row">
        <div class="col-lg-12">
            <?php
            $businessid = $_SESSION['businessid'];
            $sql_select_package = "SELECT * FROM orders ";
            $result_select_package = $conn->query($sql_select_package);

            ?>
            <table class="table">
                <thead>
                    <tr class="mt-5 bg-primary text-white">
                        <th scope="col">STT</th>
                        <th scope="col">Tên gói</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số danh mục</th>
                        <th scope="col">Số sản phẩm</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result_select_package)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td>
                                <?php echo number_format($row['price']) ?> Đồng
                            </td>
                            <td>
                                <?php echo $row['noc'] ?>
                            </td>
                            <td>
                                <?php echo $row['nop'] ?>
                            </td>
                            <td>
                                <?php $startdate = date("d/m/Y", strtotime($row['start_date']));
                                echo $startdate ?>
                            </td>
                            <td>
                                <?php $enddate = date("d/m/Y", strtotime($row['end_date']));
                                echo $enddate ?>
                            </td>
                            <td>
                                <?php
                                $current_date = date("Y-m-d");
                                if (DATE($row['end_date']) >= DATE($current_date)) {
                                    echo '<span class="btn btn-primary">Đang sử dụng</span>';
                                } else {
                                    echo '<span class="btn btn-danger">Đã hết hạn</span>';
                                }
                                ?>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include("./Template/footerAD.php");

?>