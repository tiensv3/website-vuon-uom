<?php
include("../connect.php");
session_start();
?>

<?php
include("../user/TemplateUS/HeaderUS.php");
include("../user/TemplateUS/NavbarUS.php");
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">

	<div class="container">
		<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
			<div class="col-first">
				<h1 class="text-uppercase text-black" style="color: #000;">Mua hàng thành công</h1>
				<!-- <nav class="d-flex align-items-center font-italic">
					<a href="index.html" style="color: #000;">Trang chủ<span class="lnr lnr-arrow-right"></span></a>
					<a href="../user/Cart.php" style="color: #000;">Giỏ hàng<span class="lnr lnr-arrow-right"></span></a>
					<a href="../user/Checkout.php" style="color: #000;">Xác nhận thanh toán</a>
				</nav> -->
			</div>

		</div>
	</div>
</section>
<!-- End Banner Area -->

<section class="order_details section_gap">
	<div class="container">
		<h3 class="title_confirmation">Cảm ơn bạn. Đơn đặt hàng của bạn sẽ được nhận trong thời gian sớm nhất.</h3>
		<div class="row order_d_inner">
			<div class="col-lg-4">
				<div class="details_item">
					<h4>Thông tin hóa đơn</h4>

					<ul class="list">
						<?php

						$sql_select_order = "SELECT * FROM orders WHERE userid = '" . $_SESSION['userid'] . "' ORDER BY orderid DESC LIMIT 1";
						$resule_select_order = $conn->query($sql_select_order);

						while ($info = mysqli_fetch_array($resule_select_order)) {
							$orderid = $info['orderid'];
						?>
							<li><a href="#"><span>Mã hóa đơn</span> : <?php echo $info['ordercode'] ?></a></li>
							<li><a href="#"><span>Ngày đặt</span> :
									<?php $orderdate = date("d/m/Y H:m:s", strtotime($info['orderdate']));
									echo $orderdate ?></a></li>
							<li><a href="#"><span>Tổng</span> : <?php echo number_format($info['total']) . ' VNĐ' ?></a></li>
							<li><a href="#"><span>Hình thức thanh toán</span> :
									<?php
									if ($info['method'] == 1) {
										echo "Thanh toán bằng tiền mặt";
									} elseif ($info['method'] == 2) {
										echo "Thanh toán qua ngân hàng";
									}
									?>
								</a></li>
						<?php
						}


						?>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="details_item">
					<h4>Thông tin địa chỉ hóa đơn</h4>
					<ul class="list">
						<?php
						$sql_select_order_user = "SELECT * FROM orders INNER JOIN users ON orders.userid = users.userid WHERE orders.userid = '" . $_SESSION['userid'] . "' ORDER BY orderid DESC LIMIT 1";
						$result_select_order_user = $conn->query($sql_select_order_user);

						while ($info_user = mysqli_fetch_array($result_select_order_user)) {
						?>
							<li><a href="#"><span>Địa chỉ</span> : <?php echo $info_user['address'] ?></a></li>
							<li><a href="#"><span>Họ tên</span> : <?php echo $info_user['fullname'] ?></a></li>
							<li><a href="#"><span>Số điện thoại</span> : <?php echo $info_user['phone'] ?></a></li>
							<li><a href="#"><span>Email</span> : <?php echo $info_user['email'] ?></a></li>

						<?php
						}

						?>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="details_item">
					<h4>Địa chỉ giao hàng</h4>
					<ul class="list">
						<?php

						if (isset($_SESSION['info_user']) && is_array($_SESSION['info_user'])) {
							$InforUser = $_SESSION['info_user'];
						?>
							<li><a href="#"><span>Họ tên</span> : <?php echo $InforUser['fullname'] ?></a></li>
							<li><a href="#"><span>Số điện thoại</span> : <?php echo $InforUser['phone'] ?></a></li>
							<li><a href="#"><span>Địa chỉ</span> : <?php echo $InforUser['address'] ?></a></li>
							<li><a href="#"><span>Email</span> : <?php echo $InforUser['email'] ?></a></li>

						<?php
						}
						?>
					</ul>

				</div>
			</div>
		</div>
		<div class="order_details_table">
			<h2 class="text-uppercase">Chi tiết hóa đơn</h2>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Sản phẩm</th>
							<th scope="col">Số lượng</th>
							<th scope="col">Giá</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql_select_detail = "SELECT * FROM orderdetails INNER JOIN products ON orderdetails.productid = products.productid INNER JOIN orders
						ON orderdetails.orderid = orders.orderid
						WHERE orderdetails.orderid = $orderid";
						$result_select_detail = $conn->query($sql_select_detail);

						$totalPro = 0;
						$subtotal = 0;
						while ($detail = mysqli_fetch_array($result_select_detail)) {
							if ($detail['sale']) {
								$totalPro = $detail['quantityproduct'] * $detail['sale'];
							} else if (!$detail['sale']) {
								$totalPro = $detail['quantityproduct'] * $detail['price'];
							}
							// tính tổng tất cả sản phẩm
							$subtotal += $totalPro;
						?>
							<tr>
								<td>
									<p><?php echo $detail['productname'] ?></p>
								</td>
								<td>
									<h5> x <?php echo $detail['quantityproduct'] ?></h5>
								</td>
								<td>
									<p><?php echo number_format($totalPro) . ' VNĐ' ?></p>
								</td>
							</tr>

						<?php
						}
						?>

						<tr>
							<td>
								<h6 class="text-uppercase">Tổng giá sản phẩm</h6>
							</td>
							<td>
								<h5></h5>
							</td>
							<td>
								<p><?php echo number_format($subtotal) . ' VNĐ' ?></p>
							</td>
						</tr>
						<tr>
							<td>
								<h4 class="text-uppercase">Phí giao hàng</h4>
							</td>

							<td>
								<p><?php
										$sql_order = "SELECT * FROM orders 
                          INNER JOIN orderdetails ON orders.orderid = orderdetails.orderid 
                          WHERE orders.orderid = $orderid";
										$result_order = $conn->query($sql_order);

										?></p>
							</td>

							<td>
								<?php
								while ($ship = mysqli_fetch_array($result_order)) {
									if ($ship['quantityproduct'] >= 8) {
										echo "<span> Miễn phí giao hàng </span>";
									} else if ($ship['quantityproduct'] <= 7 && $ship['quantityproduct'] >= 3) {
										echo "<span>" . number_format(40000) . " VNĐ</span>";
									} else if ($ship['quantityproduct'] <= 3 && $ship['quantityproduct'] >= 1) {
										echo "<span>" . number_format(80000) . " VNĐ</span>";
									}
								}
								?>
							</td>

						</tr>

						<tr>
							<td>
								<h5 class="text-uppercase">Tổng</h5>
							</td>

							<td></td>
							<?php
							$sql_total = "SELECT * FROM orders WHERE orders.orderid = $orderid";
							$result_total = $conn->query($sql_total);

							while ($total = mysqli_fetch_array($result_total)) {

							?>
								<td>
									<span><?php echo number_format($total['total']) . ' VNĐ' ?></span>
								</td>
							<?php
							}
							?>
						</tr>


					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<?php
include("../user/TemplateUS/FooterUS.php");
?>