<?php
session_start();
include("../connect.php");
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
						<li><a href="#"><span>Order number</span> : 60235</a></li>
						<li><a href="#"><span>Date</span> : Los Angeles</a></li>
						<li><a href="#"><span>Total</span> : USD 2210</a></li>
						<li><a href="#"><span>Payment method</span> : Check payments</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="details_item">
					<h4>Thông tin địa chỉ hóa đơn</h4>
					<ul class="list">
						<li><a href="#"><span>Street</span> : 56/8</a></li>
						<li><a href="#"><span>City</span> : Los Angeles</a></li>
						<li><a href="#"><span>Country</span> : United States</a></li>
						<li><a href="#"><span>Postcode </span> : 36952</a></li>
					</ul>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="details_item">
					<h4>Địa chỉ giao hàng</h4>
					<ul class="list">
						<li><a href="#"><span>Street</span> : 56/8</a></li>
						<li><a href="#"><span>City</span> : Los Angeles</a></li>
						<li><a href="#"><span>Country</span> : United States</a></li>
						<li><a href="#"><span>Postcode </span> : 36952</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="order_details_table">
			<h2>Order Details</h2>
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th scope="col">Product</th>
							<th scope="col">Quantity</th>
							<th scope="col">Total</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<p>Pixelstore fresh Blackberry</p>
							</td>
							<td>
								<h5>x 02</h5>
							</td>
							<td>
								<p>$720.00</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Pixelstore fresh Blackberry</p>
							</td>
							<td>
								<h5>x 02</h5>
							</td>
							<td>
								<p>$720.00</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Pixelstore fresh Blackberry</p>
							</td>
							<td>
								<h5>x 02</h5>
							</td>
							<td>
								<p>$720.00</p>
							</td>
						</tr>
						<tr>
							<td>
								<h4>Subtotal</h4>
							</td>
							<td>
								<h5></h5>
							</td>
							<td>
								<p>$2160.00</p>
							</td>
						</tr>
						<tr>
							<td>
								<h4>Shipping</h4>
							</td>
							<td>
								<h5></h5>
							</td>
							<td>
								<p>Flat rate: $50.00</p>
							</td>
						</tr>
						<tr>
							<td>
								<h4>Total</h4>
							</td>
							<td>
								<h5></h5>
							</td>
							<td>
								<p>$2210.00</p>
							</td>
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