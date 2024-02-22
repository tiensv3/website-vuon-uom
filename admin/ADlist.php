<?php
include("./Template/headerAD.php");
include("./Template/navbarAD.php");
include("./Template/sidebarAD.php");
?>
<?php
include("../connect.php");
$businessrole = 1;
$sql = "SELECT * FROM users INNER JOIN businesses WHERE role = ? and users.userid = businesses.userid ORDER BY businessid DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $businessrole);
$stmt->execute();
$result = $stmt->get_result();
?>
<div class="container-fluid">
    <div class="h3 mb-2 text-gray-800 text-center mt-3 text-black text-uppercase">Danh sách doanh nghiệp</div>
    <hr>

    <table class="table table-bordered" id="dataTableexample" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th scope="col">Stt </th>
                <th scope="col">Tên doanh nghiệp</th>
                <th scope="col">Logo</th>
                <th scope="col">Họ tên</th>
                <th scope="col">Email</th>
                <th scope="col">Địa Chỉ</th>
                <th scope="col">SĐT</th>
                <th scope="col">Trạng thái gói</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($row = mysqli_fetch_array($result)) {
                $i++;
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row['businessname']  ?></td>
                    <td>
                        <img src="<?php echo '../' . $row['image'] ?>" alt="" srcset="">
                    </td>
                    <td>
                        <?php echo $row['fullname'] ?>
                    </td>
                    <td>
                        <?php echo $row['email'] ?>
                    </td>
                    <td>
                        <?php echo $row['address'] ?>
                    </td>
                    <td>
                        <?php echo $row['phone'] ?>
                    </td>
                    <td>
                        <?php
                        if ($row['premiumstatus'] == 0) {
                            echo '<span class="btn btn-danger">Không hoạt động</span>';
                        } elseif ($row['premiumstatus'] == 1) {
                            echo '<span class="btn btn-success">Hoạt động</span>';
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
<?php
include("./Template/footerAD.php")
?>