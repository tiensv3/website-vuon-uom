<?php
include("../connect.php");
?>

<?php
include("./Template/headerAD.php");
include("./Template/navbarAD.php");
include("./Template/sidebarAD.php");
?>
<!-- main -->
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <?php
            if (isset($_GET["action"]) == "sua") {
            ?>
            <h3 class="text-uppercase text-center mt-5 mb-3">Sửa sản phẩm</h3>
            <form action="./BShandleproduct.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="" class="text-black ">Danh mục:</label>
                    <select name="categoryProduct" id="" class="form-control">
                        <?php
                            $id = $_GET["id"];
                            $sql_select_cate = "SELECT categoryid FROM products WHERE productid = $id ";
                            $result_select_cate = $conn->query($sql_select_cate);
                            $selected_category = mysqli_fetch_array($result_select_cate);

                            $sql = "SELECT categoryid, categoryname FROM categories
                    WHERE businessid = '" . $_SESSION['businessid'] . "' AND
                    categorystatus = 1 ORDER BY categoryid DESC";
                            $result = $conn->query($sql);

                            while ($row = mysqli_fetch_array($result)) {
                            ?>
                        <option value="<?php echo $row['categoryid']; ?>"
                            <?php echo ($row['categoryid'] == $selected_category['categoryid']) ? 'selected="selected"' : ''; ?>>
                            <?php echo $row['categoryname']; ?>
                        </option>
                        <?php
                            }
                            $conn->close();
                            ?>
                    </select>

                </div>

                <?php
                    include("../connect.php");
                    $id = $_GET["id"];
                    $sql_edit_product = "SELECT * FROM products
                  WHERE productid = $id";
                    $result_edit_product = $conn->query($sql_edit_product);
                    if ($row_edit_product = mysqli_fetch_array($result_edit_product)) {
                    ?>
                <div class="form-group">
                    <label for="" class="text-black font-italic">Tên sản phẩm:</label>
                    <input type="text" name="nameProduct" id="" value="<?php echo $row_edit_product['productname'] ?>"
                        class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Giá sản phẩm:</label>
                    <input type="text" name="priceProduct" id="" value="<?php echo $row_edit_product['price'] ?>"
                        class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Ảnh thu nhỏ:</label>
                    <input type="file" name="thumbnailProduct" id="" class="form-control form-control-lg" required>
                    <img src="<?php echo $row_edit_product['thumbnail'] ?>" width="200" alt="Lỗi">
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Hình ảnh sản phẩm:</label>
                    <input type="file" name="imgProduct[]" multiple accept="image/*" id=""
                        class="form-control form-control-lg" required>
                    <?php
                            $sql_product_images = "SELECT * FROM productimages where productid = $id";
                            $result_product_images = $conn->query($sql_product_images);
                            while ($row_product_images = mysqli_fetch_array($result_product_images)) {
                            ?>
                    <img src="<?php echo $row_product_images['imageurl'] ?>" alt="" width="80">
                    <a href="./BShandleimg.php?action=xoaimg&productimgid=<?php echo $row_product_images['productimageid'] ?>&productid=<?php echo $row_edit_product['productid'] ?>"
                        class="btn btn-danger">Xóa</a>
                    <?php
                            }
                            ?>
                </div>



                <div class="form-group">
                    <label for="" class="text-black font-italic">Mô tả:</label>
                    <textarea cols="30" name="descProduct" id="description" class="form-control rounded"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <input type="submit" name="addProduct" value="Sửa" class="btn btn-success w-100">
                        </div>
                    </div>
                </div>
                <?php
                    }
                    $conn->close();
                    ?>

            </form>
            <?php
            } else {
            ?>

            <h3 class="text-uppercase text-center mt-5 mb-3">Thêm sản phẩm</h3>
            <form action="./BShandleproduct.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="" class="text-black ">Danh mục:</label>
                    <?php
                        include('../connect.php');
                        $sql = "SELECT categoryid, categoryname FROM categories WHERE businessid = '" . $_SESSION['businessid'] . "' AND categorystatus = 1 ORDER BY categoryid desc";
                        $result = $conn->query($sql);
                        ?>
                    <select name="categoryProduct" id="" class="form-control">
                        <?php
                            while ($row = mysqli_fetch_array($result)) {

                            ?>
                        <option value="<?php echo $row['categoryid'] ?>"><?php echo $row['categoryname'] ?></option>
                        <?php
                            }
                            ?>
                    </select>
                    <?php
                        $conn->close();
                        ?>
                </div>
                <div class="form-group">
                    <label for="" class="text-black font-italic">Tên sản phẩm:</label>
                    <input type="text" name="nameProduct" id="" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Giá sản phẩm:</label>
                    <input type="text" name="priceProduct" id="" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Ảnh thu nhỏ:</label>
                    <input type="file" name="thumbnailProduct" id="" class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Hình ảnh sản phẩm:</label>
                    <input type="file" name="imgProduct[]" multiple accept="image/*" id=""
                        class="form-control form-control-lg" required>
                </div>

                <div class="form-group">
                    <label for="" class="text-black font-italic">Mô tả:</label>
                    <textarea cols="30" name="descProduct" id="description" class="form-control rounded"></textarea>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                        </div>
                        <div class="col-4">
                            <input type="submit" name="addProduct" value="Thêm" class="btn btn-success w-100">
                        </div>
                    </div>
                </div>

            </form>
            <?php
            }
            ?>
        </div>
        <div class="col-md-8">
            <?php
            include "../connect.php";
            $sql = "SELECT products.productid, products.productname, products.price, products.thumbnail, categories.categoryname 
            FROM products
            INNER JOIN categories ON categories.categoryid = products.categoryid
            Where products.businessid = '" . $_SESSION['businessid'] . "' ORDER BY productid DESC";
            $result = $conn->query($sql);
            ?>
            <table class="table mt-5">
                <thead>
                    <tr class="bg-primary text-white">
                        <th scope="col">Stt</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Ảnh thu nhỏ</th>
                        <!-- <th scope="col">Mô tả</th> -->
                        <th scope="col">Danh mục</th>
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
                        <td><?php echo $row['productname'] ?></td>
                        <td><?php echo number_format($row['price'])  . ' VNĐ' ?></td>
                        <td>
                            <img src="<?php echo $row['thumbnail'] ?>" alt="" srcset="">
                        </td>
                        <td>
                            <?php
                                echo $row['categoryname']
                                ?>
                        </td>
                        <td>
                            <a href="./BSproduct.php?action=sua&id=<?php echo $row['productid'] ?>"
                                class="btn btn-warning">Sửa</a>
                            <a href="./BShandleproduct.php?action=xoasp&id=<?php echo $row['productid'] ?>"
                                class="btn btn-danger">Xóa</a>
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