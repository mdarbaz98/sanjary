<?php 
include('include/config.php');
include("include/header.php") ?>
			<!-- PRODUCT-AREA START -->
			<div class="product-area pt-80 pb-80 product-style-2">
				<div class="container">
					<!-- Shop-Content End -->
					<div class="shop-content">
						<div class="row">
							<div class="col-md-12">
								<div class="product-option mb-30 clearfix">
									<!-- Categories start -->
									<div class="dropdown floatleft">
										<button class="option-btn" >
										Categories
										</button>
										<div class="dropdown-menu dropdown-width" >
											<!-- Widget-Categories start -->
											<aside class="widget widget-categories">
												<div class="widget-title">
													<h4>Categories</h4>
												</div>
												<div id="cat-treeview"  class="widget-info product-cat boxscrol2">
													<ul>
														<li><span>Chair</span>
															<ul>
																<li><a href="#">T-Shirts</a></li>
																<li><a href="#">Striped Shirts</a></li>
																<li><a href="#">Half Shirts</a></li>
																<li><a href="#">Formal Shirts</a></li>
																<li><a href="#">Bilazers</a></li>
															</ul>
														</li>          
														<li class="open"><span>Furniture</span>
															<ul>
																<li><a href="#">Men Bag</a></li>
																<li><a href="#">Shoes</a></li>
																<li><a href="#">Watch</a></li>
																<li><a href="#">T-shirt</a></li>
																<li><a href="#">Shirt</a></li>
															</ul>
														</li>          
														<li><span>Accessories</span>
															<ul>
																<li><a href="#">T-Shirts</a></li>
																<li><a href="#">Striped Shirts</a></li>
																<li><a href="#">Half Shirts</a></li>
																<li><a href="#">Formal Shirts</a></li>
																<li><a href="#">Bilazers</a></li>
															</ul>
														</li>
														<li><span>Top Brands</span>
															<ul>
																<li><a href="#">T-Shirts</a></li>
																<li><a href="#">Striped Shirts</a></li>
																<li><a href="#">Half Shirts</a></li>
																<li><a href="#">Formal Shirts</a></li>
																<li><a href="#">Bilazers</a></li>
															</ul>
														</li>
														<li><span>Jewelry</span>
															<ul>
																<li><a href="#">T-Shirts</a></li>
																<li><a href="#">Striped Shirts</a></li>
																<li><a href="#">Half Shirts</a></li>
																<li><a href="#">Formal Shirts</a></li>
																<li><a href="#">Bilazers</a></li>
															</ul>
														</li>
													</ul>
												</div>
											</aside>
											<!-- Widget-categories end -->
										</div>
									</div>	
									<!-- Categories end -->
									<!-- Price start -->
									<div class="dropdown floatleft">
										<button class="option-btn" >
										Price
										</button>
										<div class="dropdown-menu dropdown-width" >
											<!-- Shop-Filter start -->
											<aside class="widget shop-filter">
												<div class="widget-title">
													<h4>Price</h4>
												</div>
												<div class="widget-info">
													<div class="price_filter">
														<div class="price_slider_amount">
															<input type="submit"  value="You range :"/> 
															<input type="text" id="amount" name="price"  placeholder="Add Your Price" /> 
														</div>
														<div id="slider-range"></div>
													</div>
												</div>
											</aside>
											<!-- Shop-Filter end -->
										</div>
									</div>	
									<!-- Price end -->
									<!-- Color start -->
									<div class="dropdown floatleft">
										<button class="option-btn">
										Color
										</button>
										<div class="dropdown-menu dropdown-width" >
											<!-- Widget-Color start -->
											<aside class="widget widget-color">
												<div class="widget-title">
													<h4>Color</h4>
												</div>
												<div class="widget-info color-filter clearfix">
													<ul>
														<li><a href="#"><span class="color color-1"></span>LightSalmon<span class="count">12</span></a></li>
														<li><a href="#"><span class="color color-2"></span>Dark Salmon<span class="count">20</span></a></li>
														<li><a href="#"><span class="color color-3"></span>Tomato<span class="count">59</span></a></li>
														<li><a class="active" href="#"><span class="color color-4"></span>Deep Sky Blue<span class="count">45</span></a></li>
														<li><a href="#"><span class="color color-5"></span>Electric Purple<span class="count">78</span></a></li>
														<li><a href="#"><span class="color color-6"></span>Atlantis<span class="count">10</span></a></li>
														<li><a href="#"><span class="color color-7"></span>Deep Lilac<span class="count">15</span></a></li>
													</ul>
												</div>
											</aside>
											<!-- Widget-Color end -->
										</div>
									</div>
									<!-- Color end -->
									<!-- Size start -->
									<div class="dropdown floatleft">
										<button class="option-btn">
										Size
										</button>
										<div class="dropdown-menu dropdown-width" >
											<!-- Widget-Size start -->
											<aside class="widget widget-size">
												<div class="widget-title">
													<h4>Size</h4>
												</div>
												<div class="widget-info size-filter clearfix">
													<ul>
														<li><a href="#">M</a></li>
														<li><a class="active" href="#">S</a></li>
														<li><a href="#">L</a></li>
														<li><a href="#">SL</a></li>
														<li><a href="#">XL</a></li>
													</ul>
												</div>
											</aside>
											<!-- Widget-Size end -->
										</div>
									</div>	
									<!-- Size end -->								
									<div class="showing text-end">
										<p class="mb-0 d-none d-md-block">Showing 01-09 of 17 Results</p>
									</div>
								</div>						
							</div>	
							<div class="col-md-12">
								<div class="row">

                                <?php    
                 $product=$conn->prepare("SELECT * FROM product order by id desc limit 12");
                 $product->execute();
                 $i=0;
                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
                        $prod_id = $row['id'];
                    $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
					$stmt_img->execute([$row['front_img']]);
					$img_data = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
					if(!empty($img_data)) {
                            $image = $img_data[0]['path']; 
                            $alt = $img_data[0]['alt'];
					}else{
                            $image="Not Found";
                            $alt="Not Found";
						}    
                    $stmt_pro_price = $conn->prepare("SELECT * FROM `product_price` WHERE status=1 AND product_id=?");
					$stmt_pro_price->execute([$row['id']]);
					$stmt_pro_price_data = $stmt_pro_price->fetchAll(PDO::FETCH_ASSOC);
					if(!empty($stmt_pro_price_data)) {
						$size = $stmt_pro_price_data[0]['size']; 
						$price = $stmt_pro_price_data[0]['price'];
					}else{
                        $size="Not Found";
						$price="Not Found";
						}


                        // echo "<pre>";
                        // print_r($product);
                        // echo "</pre>";
                
                

?>

									<!-- Single-product start -->
									<div class="col-xl-3 col-md-4">
										<div class="single-product">
											<div class="product-img">
												<span class="pro-price-2">$ <?php echo $price ?></span>
												<a href="#1"><img src="sanjary-admin/<?php echo $image ?>" alt="<?php echo $image ?>" /></a>
											</div>
											<div class="product-info clearfix text-center">
												<div class="fix">
													<h4 class="post-title"><a href="<?php echo $row['slug']; ?>"><?php echo $row['product_name']; ?></a></h4>
												</div>
												<div class="fix">
													<span class="pro-rating">
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
														<a href="#"><i class="zmdi zmdi-star-half"></i></a>
													</span>
												</div>
												<div class="product-action clearfix">
												<div class="product-action clearfix">
													<a href="wishlist.html" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
													<a href="#" data-bs-toggle="modal"  data-bs-target="#productModal" title="Quick View"><i class="zmdi zmdi-zoom-in"></i></a>
													<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Compare"><i class="zmdi zmdi-refresh"></i></a>
													<a href="cart.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
												</div>
											</div>
										</div>
									</div>
									<!-- Single-product end -->

    <?php } ?>
								</div>
							</div>
							<div class="col-md-12">
								<!-- Pagination start -->
								<div class="shop-pagination  text-center">
									<div class="pagination">
										<ul>
											<li><a href="#"><i class="zmdi zmdi-long-arrow-left"></i></a></li>
											<li><a href="#">01</a></li>
											<li><a class="active" href="#">02</a></li>
											<li><a href="#">03</a></li>
											<li><a href="#">04</a></li>
											<li><a href="#">05</a></li>
											<li><a href="#"><i class="zmdi zmdi-long-arrow-right"></i></a></li>
										</ul>
									</div>
								</div>
								<!-- Pagination end -->
							</div>
						</div>
					</div>
					<!-- Shop-Content End -->
				</div>
			</div>
			<!-- PRODUCT-AREA END -->

<?php include("include/footer.php") ?>