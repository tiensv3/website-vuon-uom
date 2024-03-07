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
    <div class="row">
        <div class="col-lg-12">
            <?php
            $sql_select_package = "SELECT * FROM packages";
            $stmt = $conn->prepare($sql_select_package);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <table class="table">
                <thead>
                    <tr class="mt-5 bg-primary text-white">
                        <th scope="col">STT</th>
                        <th scope="col">Tên gói</th>
                        <th scope="col">Giá gói</th>
                        <th scope="col">Thời gian gói</th>
                        <!-- <th scope="col">Mô tả gói</th> -->
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td>
                                <?php echo number_format($row['price']) ?> Đồng
                            </td>
                            <td>
                                <?php echo $row['packagedate'] ?> Tháng
                            </td>
                            <td>
                                <form method="post" action="./BShandleregisterpackages.php">
                                    <input type="hidden" name="packageid" value="<?php echo $row['packageid'] ?>">
                                    <button type="submit" value="Đăng ký" class="btn btn-success" name="btnDangky">Đăng
                                        ký</button>
                                </form>
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