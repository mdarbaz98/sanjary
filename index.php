<?php 
include('include/config.php');
include("include/header.php"); ?>
<!-- SLIDER-AREA START  -->
			<section class="slider-area slider-style-2">
				<div class="bend niceties preview-2">
					<div id="ensign-nivoslider" class="slides">	
						<img src="img/slider/slider-2/1.jpg" alt="" title="#slider-direction-1"  />
						<img src="img/slider/slider-2/2.jpg" alt="" title="#slider-direction-2"  />
						<img src="img/slider/slider-2/3.jpg" alt="" title="#slider-direction-3"  />
					</div>
					<!-- direction 1 -->
					<div id="slider-direction-1" class="t-cn slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb slider-1">
							<div class="title-container s-tb-c title-compress">
								<div class="layer-1">
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
										<h3 class="slider-title3 text-uppercase mb-0" >welcome to our</h3>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
										<h2 class="slider-title1 text-uppercase mb-0"><span class="d-none d-md-block">elegent </span>  furniture</h2>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="3s" data-wow-delay="0.5s">
										<h2 class="slider-title2 text-uppercase" >gallery 2021</h2>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="3.5s" data-wow-delay="0.5s">
										<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</div>
						</div>	
					</div>
					<!-- direction 2 -->
					<div id="slider-direction-2" class="slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb slider-1">
							<div class="title-container s-tb-c title-compress">
								<div class="layer-1">
									<div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
										<h3 class="slider-title3 text-uppercase mb-0" >welcome to our</h3>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
										<h2 class="slider-title1 text-uppercase"><span class="d-none d-md-block">elegent </span> furniture</h2>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
										<p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.  If you are going to use a  passage of Lorem Ipsum, you need to be sure there hidden in the middle of text.</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
										<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</div>
						</div>		
					</div>
					<!-- direction 3 -->
					<div id="slider-direction-3" class="slider-direction">
						<div class="slider-progress"></div>
						<div class="slider-content t-lfl s-tb slider-1">
							<div class="title-container s-tb-c title-compress">
								<div class="layer-1">
									<div class="wow fadeInUpBig" data-wow-duration="1s" data-wow-delay="0.5s">
										<h3 class="slider-title3 text-uppercase mb-0" >welcome to our</h3>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="1.5s" data-wow-delay="0.5s">
										<h2 class="slider-title1 text-uppercase mb-0"><span class="d-none d-md-block">elegent </span> furniture</h2>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2s" data-wow-delay="0.5s">
										<h2 class="slider-title2 text-uppercase" >gallery 2021</h2>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="2.5s" data-wow-delay="0.5s">
										<p class="slider-pro-brief">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.  If you are going to use a  passage of Lorem Ipsum, you need to be sure there hidden in the middle of text.</p>
									</div>
									<div class="wow fadeInUpBig" data-wow-duration="3s" data-wow-delay="0.5s">
										<a href="#" class="button-one style-2 text-uppercase mt-20" data-text="Shop now">Shop now</a>
									</div>
								</div>
							</div>
						</div>		
					</div>
				</div>
			</section>
			<!-- SLIDER-AREA END -->
			
			<!-- PRODUCT-AREA START -->
			<div class="product-area pt-80 pb-30 product-style-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2 class="title-border">Featured Products</h2>
							</div>
							<div class="product-slider style-2 arrow-left-right">
		<?php    
                 $product=$conn->prepare("SELECT * FROM product order by id desc limit 10");
                 $product->execute();
                 $i=0;
                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
                        $prod_id = $row['id'];
						$product_name = $row['product_name'];
						$category = $row['category'];
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



                                <div class="col-12">
									<div class="single-product">
										<div class="product-img">
											<span class="pro-label new-label">new</span>
											<span class="pro-price-2">$ <?php echo $price ?></span>
											<a href="<?php echo $row['slug']; ?>"><img src="sanjary-admin/<?php echo $image ?>" alt="<?php echo $image ?>" /></a>
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
												<a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
												<a href="javascript:void(0)" onclick="addProductToCart(this)" data-pro_id="<?php echo $prod_id ?>" data-pro_name="<?php echo $product_name ?>" data-category="<?php echo $category ?>"
													data-image="<?php echo $image ?>" data-price="<?php echo $price ?>" data-size="<?php echo $size ?>"  data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
											</div>
										</div>
									</div>
								</div>
<?php } ?>
								
                                
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- PRODUCT-AREA END -->
			<!-- PURCHASE-ONLINE-AREA START -->
			<div class="purchase-online-area pt-80 product-style-2">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="section-title text-center">
								<h2 class="title-border">Purchase Online on Sanjary</h2>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12  text-center">
							<!-- Nav tabs -->
							<ul class="tab-menu nav clearfix">
								<li><a class="active" href="#new-arrivals" data-bs-toggle="tab">New Arrivals</a></li>
								<li><a href="#best-seller"  data-bs-toggle="tab">Best Seller </a></li>
								<li><a href="#most-view" data-bs-toggle="tab">Most View </a></li>
								<li><a href="#discounts" data-bs-toggle="tab">Discounts</a></li>
							</ul>
						</div>	
						<div class="col-lg-12">
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="new-arrivals">
									<div class="row">
                                <?php
                                                 $product=$conn->prepare("SELECT * FROM product where category='office-chairs' order by id desc limit 10");
                                                 $product->execute();
                                                 $i=0;
                                                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
														$prod_id = $row['id'];
														$product_name = $row['product_name'];
														$category = $row['category'];
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

                                ?>

										<!-- Single-product start -->
										<div class="col-xl-3 col-lg-4 col-md-6">
											<div class="single-product">
												<div class="product-img">
													<span class="pro-label new-label">new</span>
													<span class="pro-price-2">INR <?php echo $price ?> </span>
													<a href="<?php echo $row['slug']; ?>"><img src="sanjary-admin/<?php echo $image ?>" alt="<?php echo $image ?>" /></a>
												</div>
												<div class="product-info clearfix text-center">
													<div class="fix">
														<h4 class="post-title"><a href="#"><?php echo $row['product_name']; ?></a></h4>
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
													<a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
													<a href="javascript:void(0)" onclick="addProductToCart(this)" data-pro_id="<?php echo $prod_id ?>" data-pro_name="<?php echo $product_name ?>" data-category="<?php echo $category ?>"
													data-image="<?php echo $image ?>" data-price="<?php echo $price ?>" data-size="<?php echo $size ?>"  data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
													</div>
												</div>
											</div>
										</div>
										<!-- Single-product end -->
                                <?php } ?>
				
									</div>
								</div>
								<div class="tab-pane" id="best-seller">
									<div class="row">
                                    <?php
                                                 $product=$conn->prepare("SELECT * FROM product where category='arm-chair' order by id desc limit 10");
                                                 $product->execute();
                                                 $i=0;
                                                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
														$prod_id = $row['id'];
														$product_name = $row['product_name'];
														$category = $row['category'];
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

                                ?>
										<!-- Single-product start -->
										<div class="col-xl-3 col-lg-4 col-md-6">
											<div class="single-product">
												<div class="product-img">
													<span class="pro-label new-label">new</span>
													<span class="pro-price-2">INR <?php echo $price ?></span>
                                                    <a href="<?php echo $row['slug']; ?>"><img src="sanjary-admin/<?php echo $image ?>" alt="<?php echo $image ?>" /></a>
												</div>
												<div class="product-info clearfix text-center">
													<div class="fix">
														<h4 class="post-title"><a href="#"><?php echo $row['product_name'] ?></a></h4>
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
													<a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
												<a href="javascript:void(0)" onclick="addProductToCart(this)" data-pro_id="<?php echo $prod_id ?>" data-pro_name="<?php echo $product_name ?>" data-category="<?php echo $category ?>"
													data-image="<?php echo $image ?>" data-price="<?php echo $price ?>" data-size="<?php echo $size ?>"  data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
													</div>
												</div>
											</div>
										</div>
										<!-- Single-product end -->		
                                        <?php } ?>			
									</div>					
								</div>
								<div class="tab-pane" id="most-view">
									<div class="row">
                                    <?php
                                                 $product=$conn->prepare("SELECT * FROM product where category='recliner-chair' order by id desc limit 10");
                                                 $product->execute();
                                                 $i=0;
                                                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
														$prod_id = $row['id'];
														$product_name = $row['product_name'];
														$category = $row['category'];
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

                                ?>
										<!-- Single-product start -->
										<div class="col-xl-3 col-lg-4 col-md-6">
											<div class="single-product">
												<div class="product-img">
													<span class="pro-label new-label">new</span>
													<span class="pro-price-2">INR <?php echo $price ?></span>
                                                    <a href="<?php echo $row['slug']; ?>"><img src="sanjary-admin/<?php echo $image ?>" alt="<?php echo $image ?>" /></a>
												</div>
												<div class="product-info clearfix text-center">
													<div class="fix">
														<h4 class="post-title"><a href="#"><?php echo $row['product_name'] ?></a></h4>
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
													<a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
												<a href="javascript:void(0)" onclick="addProductToCart(this)" data-pro_id="<?php echo $prod_id ?>" data-pro_name="<?php echo $product_name ?>" data-category="<?php echo $category ?>"
													data-image="<?php echo $image ?>" data-price="<?php echo $price ?>" data-size="<?php echo $size ?>"  data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
													</div>
												</div>
											</div>
										</div>
										<!-- Single-product end -->		
                                        <?php } ?>					
									</div>						
								</div>
								<div class="tab-pane" id="discounts">
									<div class="row">
                                    <?php
                                                 $product=$conn->prepare("SELECT * FROM product where category='love-seat-sofa' order by id desc limit 10");
                                                 $product->execute();
                                                 $i=0;
                                                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
														$prod_id = $row['id'];
														$product_name = $row['product_name'];
														$category = $row['category'];
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

                                ?>
										<!-- Single-product start -->
										<div class="col-xl-3 col-lg-4 col-md-6">
											<div class="single-product">
												<div class="product-img">
													<span class="pro-label new-label">new</span>
													<span class="pro-price-2">INR <?php echo $price ?></span>
                                                    <a href="<?php echo $row['slug']; ?>"><img src="sanjary-admin/<?php echo $image ?>" alt="<?php echo $image ?>" /></a>
												</div>
												<div class="product-info clearfix text-center">
													<div class="fix">
														<h4 class="post-title"><a href="#"><?php echo $row['product_name'] ?></a></h4>
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
													<a href="javascript:void(0)" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
												<a href="javascript:void(0)" onclick="addProductToCart(this)" data-pro_id="<?php echo $prod_id ?>" data-pro_name="<?php echo $product_name ?>" data-category="<?php echo $category ?>"
													data-image="<?php echo $image ?>" data-price="<?php echo $price ?>" data-size="<?php echo $size ?>"  data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
													</div>
												</div>
											</div>
										</div>
										<!-- Single-product end -->		
                                        <?php } ?>					
									</div>					
								</div>
							</div>
						</div>			
					</div>
				</div>
			</div>
			<!-- PURCHASE-ONLINE-AREA END -->
            <?php include("./include/footer.php") ?>
