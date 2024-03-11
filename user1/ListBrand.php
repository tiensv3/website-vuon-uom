<?php
session_start();
include("../connect.php");
?>

<?php
include("../user/TemplateUS/HeaderUS.php");
include("../user/TemplateUS/NavbarUS.php");
?>
<!-- End Banner Area -->
<div class="container mt-5">
	<div class="row ">


		<!-- chọn sản phẩm từ sidebar lấy sản phẩm theo danh mục-->
		<?php
		if (isset($_GET['action']) && $_GET['action'] == 'thuonghieu') {
			$businessid = $_GET['id'];


		?>
			<div class="col-xl-12 col-lg-12 col-md-12 mt-5">
				<!-- start thanh lọc  -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select>
							<option value="#">Lọc theo kí tự</option>
							<option value="1">Kí tự từ A-Z</option>
							<option value="1">Kí tự từ Z-A</option>
						</select>
					</div>


				</div>
				<!-- End thanh lọc -->
				<!-- phần câu lệnh sql hiện thông tin sản phẩm -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<?php
						$limit = 6; //giới hạn sản phẩm 
						$page = isset($_GET['page']) ? $_GET['page'] : 1;
						$offset = ($page - 1) * $limit;



						$sql_select_id_business = "SELECT * FROM products WHERE products.businessid = '" . $businessid . "' LIMIT $limit OFFSET $offset";
						$result_select_id_business = $conn->query($sql_select_id_business);

						$total_pages_sql = "SELECT COUNT(*) FROM products WHERE products.businessid = '" . $businessid . "'";
						$total_pages_result = $conn->query($total_pages_sql);
						$total_pages = ceil($total_pages_result->fetch_assoc()['COUNT(*)'] / $limit);
						/* ---------------------------------- LOOP ---------------------------------- */
						while ($product_All_id_business = mysqli_fetch_array($result_select_id_business)) {
						?>
							<!-- Start hiển thị sản phẩm -->
							<div class="col-lg-4 col-md-6">
								<div class="single-product">
									<img class="" src="../<?php echo $product_All_id_business['thumbnail'] ?>" alt="" width="300" height="250">
									<div class="product-details">
										<h6><?php echo $product_All_id_business['productname'] ?></h6>
										<div class="price">
											<?php
											if ($product_All_id_business['sale']) {
											?>
												<h6><?php echo number_format($product_All_id_business['sale']) . ' VNĐ' ?></h6>
											<?php
											}
											?>
											<?php
											if (!$product_All_id_business['sale']) {
											?>
												<h6 class=""><?php echo number_format($product_All_id_business['price']) . ' VNĐ' ?></h6>
											<?php
											} else {
											?>
												<h6 class="l-through"><?php echo number_format($product_All_id_business['price']) . ' VNĐ' ?></h6>
											<?php
											}
											?>
										</div>
										<div class="prd-bottom">
											<div class="row">
												<div class="col-12 ">
													<form action="../user/HandleCart.php" method="post">
														<input type="hidden" name="product_id" value="<?php echo $product_All_id_business['productid'] ?>">
														<input type="hidden" name="product_name" value="<?php echo $product_All_id_business['productname'] ?>">
														<input type="hidden" name="product_price" value="<?php echo $product_All_id_business['price'] ?>">
														<input type="hidden" name="product_sale" value="<?php echo $product_All_id_business['sale'] ?>">
														<input type="hidden" name="product_quantity" id="" value="1">

														<input type="submit" name="addtocart" class="btn btn-primary w-100 mb-2" value="Thêm vào giỏ hàng">
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a href="" class="social-info">
														<span class="lnr lnr-heart"></span>
														<p class="hover-text">yêu thích</p>
													</a>
													<a href="./DetailPro.php?action=chitiet&id=<?php echo $product_All_id_business['productid'] ?>" class="social-info">
														<span class="lnr lnr-move"></span>
														<p class="hover-text">Chi tiết</p>
													</a>
												</div>

											</div>



										</div>
									</div>
								</div>
							</div>
							<!-- End hiển thị sản phẩm -->
						<?php
						}
						?>
					</div>
				</section>
				<!-- Start thanh số phân trang -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">

					</div>

					<div class="pagination">
						<?php for ($i = 1; $i <= $total_pages; $i++) : ?>
							<a href='./ListBrand.php?action=thuonghieu&id=<?php echo $businessid ?>&page=<?php echo $i; ?>'><?php echo $i; ?></a>
						<?php endfor; ?>
					</div>

				</div>
				<!-- End thanh số phân trang -->
			</div>


		<?php
		} else {
		?>
			<div class="col-xl-9 col-lg-8 col-md-7 mt-5">
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select>
							<option value="#">Lọc theo kí tự</option>
							<option value="1">Kí tự từ A-Z</option>
							<option value="1">Kí tự từ Z-A</option>
						</select>
					</div>


				</div>
				<!-- End Filter Bar -->

				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<?php
						$limit = 6; // Số bản ghi hiển thị trên mỗi trang
						$page = isset($_GET['page']) ? $_GET['page'] : 1; // Trang hiện tại, mặc định là trang 1 nếu không có giá trị
						$offset = ($page - 1) * $limit;


						$sql_select_product = "SELECT * FROM products LIMIT $limit OFFSET $offset";
						$result_select_product = $conn->query($sql_select_product);

						$total_pages_sql = "SELECT COUNT(*) FROM products";
						$total_pages_result = $conn->query($total_pages_sql);
						$total_pages = ceil($total_pages_result->fetch_assoc()['COUNT(*)'] / $limit);

						while ($product_All = mysqli_fetch_array($result_select_product)) {
						?>
							<div class="col-lg-4 col-md-6">
								<!-- single product -->
								<div class="single-product">
									<a href="./DetailPro.php?action=chitiet&id=<?php echo $product_All['productid'] ?>"><img class="" src="../<?php echo $product_All['thumbnail'] ?>" alt="" width="300" height="250"></a>
									<div class="product-details">
										<h6><a class="" style="color: #000;" href="./DetailPro.php?action=chitiet&id=<?php echo $product_All['productid'] ?>"><?php echo $product_All['productname'] ?></a></h6>
										<div class="price">
											<?php
											if ($product_All['sale']) {
											?>
												<h6><?php echo number_format($product_All['sale']) . ' VNĐ' ?></h6>
											<?php
											}
											?>
											<?php
											if (!$product_All['sale']) {
											?>
												<h6 class=""><?php echo number_format($product_All['price']) . ' VNĐ' ?></h6>
											<?php
											} else {
											?>
												<h6 class="l-through"><?php echo number_format($product_All['price']) . ' VNĐ' ?></h6>
											<?php
											}
											?>
										</div>
										<div class="prd-bottom">
											<div class="row">
												<div class="col-12 ">
													<form action="../user/HandleCart.php" method="post">
														<input type="hidden" name="product_id" value="<?php echo $product_All['productid'] ?>">
														<input type="hidden" name="product_name" value="<?php echo $product_All['productname'] ?>">
														<input type="hidden" name="product_price" value="<?php echo $product_All['price'] ?>">
														<input type="hidden" name="product_sale" value="<?php echo $product_All['sale'] ?>">
														<input type="hidden" name="product_quantity" id="" value="1">

														<input type="submit" name="addtocart" class="btn btn-success w-100 mb-2" value="Mua hàng">
													</form>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a href="" class="social-info">
														<span class="lnr lnr-heart"></span>
														<p class="hover-text">yêu thích</p>
													</a>
													<a href="./DetailPro.php?action=chitiet&id=<?php echo $product_All['productid'] ?>" class="social-info">
														<span class="lnr lnr-move"></span>
														<p class="hover-text">Chi tiết</p>
													</a>
												</div>

											</div>



										</div>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
				</section>

				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<div class="pagination">
						<?php for ($i = 1; $i <= $total_pages; $i++) : ?>
							<a href='./Listcategory.php?page=<?php echo $i; ?>'><?php echo $i; ?></a>
						<?php endfor; ?>
					</div>
				</div>
			</div>

		<?php
		}
		?>
	</div>
</div>



<!-- Modal Quick Product View -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="container relative">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
			<div class="product-quick-view">
				<div class="row align-items-center">
					<div class="col-lg-6">
						<div class="quick-view-carousel">
							<div class="item" style="background: url(img/organic-food/q1.jpg);">

							</div>
							<div class="item" style="background: url(img/organic-food/q1.jpg);">

							</div>
							<div class="item" style="background: url(img/organic-food/q1.jpg);">

							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="quick-view-content">
							<div class="top">
								<h3 class="head">Mill Oil 1000W Heater, White</h3>
								<div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
								<div class="category">Category: <span>Household</span></div>
								<div class="available">Availibility: <span>In Stock</span></div>
							</div>
							<div class="middle">
								<p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
									looking for something that can make your interior look awesome, and at the same time give you the pleasant
									warm feeling during the winter.</p>
								<a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
							</div>
							<div class="bottom">
								<div class="color-picker d-flex align-items-center">Color:
									<span class="single-pick"></span>
									<span class="single-pick"></span>
									<span class="single-pick"></span>
									<span class="single-pick"></span>
									<span class="single-pick"></span>
								</div>
								<div class="quantity-container d-flex align-items-center mt-15">
									Quantity:
									<input type="text" class="quantity-amount ml-15" value="1" />
									<div class="arrow-btn d-inline-flex flex-column">
										<button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
										<button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
									</div>

								</div>
								<div class="d-flex mt-20">
									<a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
									<a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
									<a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php
include("../user/TemplateUS/FooterUS.php");

?>