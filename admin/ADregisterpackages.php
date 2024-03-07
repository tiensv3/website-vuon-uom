<?php
include("../connect.php");
?>
<?php
include("./Template/headerAD.php");
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
            $sql_select_package = "SELECT businesses.businessname, businesspackages.businesspackageid,
            packages.name, packages.price, packages.packagedate, businesses.image,
            businesspackages.startdate, businesspackages.enddate
            FROM businesspackages INNER JOIN businesses ON
            businesspackages.businessid = businesses.businessid INNER JOIN packages ON
            businesspackages.packageid = packages.packageid
            ORDER BY businesspackages.businesspackageid DESC
            ";
            $stmt = $conn->prepare($sql_select_package);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <table class="table">
                <thead>
                    <tr class="mt-5 bg-primary text-white">
                        <th scope="col">STT</th>
                        <th scope="col">Doanh nghiệp</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Gói</th>
                        <th scope="col">Giá gói</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Ngày bắt đầu</th>
                        <th scope="col">Ngày kết thúc</th>
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
                            <td><?php echo $row['businessname'] ?></td>
                            <td>
                                <img src="../<?php echo $row['image'] ?>" alt="Lỗi">
                            </td>
                            <td>
                                <?php echo $row['name'] ?>
                            </td>
                            <td>
                                <?php echo number_format($row['price']) ?> Đồng
                            </td>
                            <td>
                                <?php echo $row['packagedate'] ?> Tháng
                            </td>

                            <form method="post" action="./ADhandleregisterpackages.php">
                                <input type="hidden" name="id" value="<?php echo $row['businesspackageid'] ?>">
                                <td>
                                    <input type="date" value="<?php echo $row['startdate'] ?>" name="startdate" required>

                                </td>
                                <td>

                                    <input type="date" value="<?php echo $row['enddate'] ?>" name="enddate" required>
                                </td>

                                <td>
                                    <button type="submit" name="btnSua" class="btn btn-success">Cập nhật</button>
                                </td>
                            </form>

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