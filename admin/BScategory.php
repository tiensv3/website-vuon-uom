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
        <div class="col-lg-5">
            <?php
            if (isset($_GET['action']) == 'sua') {
                $cateid = $_GET['id'];
                $sql_select_id = "SELECT * FROM categories WHERE categoryid = ?";
                $stmt = $conn->prepare($sql_select_id);
                $stmt->bind_param("i", $cateid);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($row = mysqli_fetch_array($result)) {
            ?>
            <h2 class="text-black text-uppercase text-center mt-3">Sửa danh mục</h2>
            <form action="./BShandlecategory.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="categoryid" value="<?php echo $row['categoryid'] ?>">
                <div class="form-group">
                    <label for="" class="text-black font-italic">Tên danh mục:</label>
                    <input type="text" name="categoryname" class="form-control form-control-lg"
                        value="<?php echo $row['categoryname'] ?>">
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">trạng thái :</label>
                    <select name="categorystatus" id="" class="form-control">
                        <?php
                                if ($row['categorystatus'] == 1) {

                                ?>
                        <option value="0">Không hiển thị</option>
                        <option value="1" selected>Hiển thị</option>
                        <?php
                                } else if ($row['categorystatus'] == 0) {
                                ?>
                        <option value="0" selected>Không hiển thị</option>
                        <option value="1">Hiển thị</option>

                        <?php
                                }
                                ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Hình ảnh:</label>
                    <input type="file" name="categoryimage" class="form-control form-control-lg">
                    <img src="<?php echo '../uploadBS/' . $row['categoryimage'] ?>" alt="" srcset="" width="300"
                        class="mt-2">
                </div>


                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="submit" name="editCategory" value="Sửa" class="btn btn-success w-50">
                        </div>

                    </div>
                </div>
            </form>

            <?php
                }
            } else {
                ?>
            <h2 class="text-black text-uppercase text-center mt-3">Thêm danh mục</h2>
            <form action="./BShandlecategory.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="" class="text-black font-italic">Tên danh mục:</label>
                    <input type="text" name="nameCategory" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">trạng thái :</label>
                    <select name="statusCategory" id="" class="form-control">
                        <option value="0">Không hiển thị</option>
                        <option value="1" selected>Hiển thị</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Hình ảnh:</label>
                    <input type="file" name="imgCategory" class="form-control form-control-lg" required>
                </div>


                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="submit" name="addCategory" value="Thêm" class="btn btn-success w-50">
                        </div>

                    </div>
                </div>
            </form>
            <?php
            }
            ?>
        </div>
        <div class="col-lg-7">
            <?php
            $sql_select_cate = "SELECT * FROM categories INNER JOIN businesses ON categories.businessid = businesses.businessid 
            WHERE categories.businessid = '" . $_SESSION['businessid'] . "' ORDER BY categoryid desc";
            $stmt = $conn->prepare($sql_select_cate);
            $stmt->execute();
            $result = $stmt->get_result();
            ?>
            <table class="table">
                <thead>
                    <tr class="mt-5 bg-primary text-white">
                        <th scope="col">Stt</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Quản lý</th>
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
                        <td><?php echo $row['categoryname'] ?></td>
                        <td>
                            <img src="<?php echo '../uploadBS/' . $row['categoryimage'] ?>" alt="" srcset="">
                        </td>
                        <td>
                            <?php
                                if ($row['categorystatus'] == 1) {
                                    echo '<span class="text text-primary">Hiển thị</span>';
                                } elseif ($row['categorystatus'] == 0) {
                                    echo '<span class="text text-danger">Không hiển thị</span>';
                                }
                                ?>
                        </td>
                        <td>
                            <a href="./BScategory.php?action=sua&&id=<?php echo $row['categoryid'] ?>"
                                class="btn btn-warning">Sửa</a>
                            <a href="./BShandlecategory.php?action=thaydoitrangthai&&id=<?php echo $row['categoryid'] ?>"
                                class="btn btn-primary">
                                <?php
                                    if ($row['categorystatus'] == 1) {
                                        echo "Ẩn";
                                    } else {
                                        echo "Hiện";
                                    }

                                    ?>
                            </a>
                            <a href="./BShandlecategory.php?action=xoa&id=<?php echo $row['categoryid'] ?>"
                                class="btn btn-danger" onclick="return confirmDelete()">Xóa</a>
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