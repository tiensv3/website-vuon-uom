<?php
include '../connect.php';
?>

<?php
include("./Template/headerAD.php");
include("./Template/navbarAD.php");
include("./Template/sidebarAD.php");
?>
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <?php
            if (isset($_GET['action']) == 'sua') {
                $id = $_GET['id'];
                $sql_select_id = "SELECT * FROM packages WHERE packageid = ?";
                $stmt = $conn->prepare($sql_select_id);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = mysqli_fetch_array($result)) {
            ?>
                    <h2 class="text-center m-3 text-black text-uppercase">Sửa các gói</h2>
                    <form action="./ADhandlepackage.php" method="post">
                        <input type="hidden" name="packageid" value="<?php echo $id ?>">
                        <div class="form-group">
                            <label for="" class="text-black font-italic">Tên gói dịch vụ:</label>
                            <input type="text" name="namePackage" value="<?php echo $row['name'] ?>" id="" class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-black font-italic">Giá gói dịch vụ:</label>
                            <input type="text" name="pricePackage" value="<?php echo $row['price'] ?>" id="" class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-black font-italic">Thời gian gói dịch vụ:</label>
                            <input type="text" name="datePackage" value="<?php echo $row['packagedate']  ?>" id="" class="form-control rounded">
                        </div>
                        <div class="form-group">
                            <label for="" class="text-black font-italic">Mô tả:</label>
                            <textarea cols="30" name="descPackage" id="description" class="form-control rounded"><?php echo $row['description'] ?></textarea>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4">
                                </div>
                                <div class="col-4">
                                    <input type="submit" name="editPackage" value="Sửa" class="btn btn-success w-100">
                                </div>
                            </div>
                        </div>
                    </form>

                <?php
                }
            } else {
                ?>

                <h2 class="text-center m-3 text-black text-uppercase">Thêm các gói</h2>
                <form action="./ADhandlepackage.php" method="post">

                    <div class="form-group">
                        <label for="" class="text-black font-italic">Tên gói dịch vụ:</label>
                        <input type="text" name="namePackage" id="" class="form-control rounded">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-black font-italic">Giá gói dịch vụ:</label>
                        <input type="text" name="pricePackage" id="" class="form-control rounded">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-black font-italic">Thời gian gói dịch vụ:</label>
                        <input type="text" name="datePackage" id="" class="form-control rounded">
                    </div>
                    <div class="form-group">
                        <label for="" class="text-black font-italic">Mô tả:</label>
                        <textarea cols="30" name="descPackage" id="description" class="form-control rounded"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <input type="submit" name="addPackage" value="Thêm" class="btn btn-success w-100">
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            }
            ?>
        </div>
        <div class="col-md-6">
            <?php
            $sql = "SELECT * FROM packages   ORDER BY packageid DESC";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>

            <table class="table mt-5">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col">Stt</th>
                        <th scope="col">Tên gói</th>
                        <th scope="col">Giá </th>
                        <th scope="col">Thời gian </th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    while ($row = mysqli_fetch_array($result)) {
                        $i++;
                    ?>
                        <tr>
                            <th scope="row"><?php echo $i ?></th>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo number_format($row['price']) . ' VNĐ' ?></td>
                            <td><?php echo $row['packagedate'] . ' tháng' ?></td>
                            <td>
                                <a href="./ADpackages.php?action=sua&&id=<?php echo $row['packageid'] ?>" class="btn btn-warning">Sửa</a>
                                <a href="./ADhandlepackage.php?action=xoa&&id=<?php echo $row['packageid'] ?>" class="btn btn-danger ml-2">Xóa</a>
                            </td>
                        </tr>
                    <?php
                    $conn->close();
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