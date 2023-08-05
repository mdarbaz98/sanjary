<?php 
include('include/config.php');
include("include/header.php");

$product_slug = $_GET['slug'];
$product=$conn->prepare("SELECT * FROM product WHERE slug ='$product_slug'");
$product->execute();
while ($row = $product->fetch(PDO::FETCH_ASSOC)){
	$product_name= $row['product_name'];
	$pro_id= $row['id'];
    $image_id=$row['img_id'];
	$category= $row['category'];
	$description= $row['description'];
	$price= $row['prc'];
	$product_name= $row['product_name'];
}

?>

			<!-- PRODUCT-AREA START -->
			<div class="product-area single-pro-area pt-80 pb-80 product-style-2">
				<div class="container">	
					<div class="row shop-list single-pro-info no-sidebar">
						<!-- Single-product start -->
						<div class="col-lg-12">
							<div class="single-product clearfix">
								<!-- Single-pro-slider Big-photo start -->
								<div class="single-pro-slider single-big-photo view-lightbox slider-for">
                                <?php
                                                    $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                                    $stmt_img->execute([$image_id]);
                                                    while($img_data = $stmt_img->fetch(PDO::FETCH_ASSOC)){
                                            ?>
									<div>
										<img src="sanjary-admin/<?php echo $img_data['path'] ?>" alt="" />
										<a class="view-full-screen" href="sanjary-admin/<?php echo $img_data['path'] ?>"  data-lightbox="roadtrip" data-title="My caption">
											<i class="zmdi zmdi-zoom-in"></i>
										</a>
									</div>
                                    <?php } ?>
								</div>	
								<!-- Single-pro-slider Big-photo end -->								
								<div class="product-info">
									<div class="fix">
										<h4 class="post-title floatleft"><?php echo $product_name ?></h4>
										<span class="pro-rating floatright">
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star"></i></a>
											<a href="#"><i class="zmdi zmdi-star-half"></i></a>
											<a href="#"><i class="zmdi zmdi-star-half"></i></a>
											<span>( 27 Rating )</span>
										</span>
									</div>
									<div class="fix mb-20">
										<span class="pro-price">$ 56.20</span>
									</div>
									<div class="product-description">
										<p><?php echo $description ?></p>
									</div>
									<!-- color start -->								
									<div class="color-filter single-pro-color mb-20 clearfix">
										<ul>
											<li><span class="color-title text-capitalize">color</span></li>
											<li><a class="active" href="#"><span class="color color-1"></span></a></li>
											<li><a href="#"><span class="color color-2"></span></a></li>
											<li><a href="#"><span class="color color-7"></span></a></li>
											<li><a href="#"><span class="color color-3"></span></a></li>
											<li><a href="#"><span class="color color-4"></span></a></li>
										</ul>
									</div>
									<!-- color end -->
									<!-- Size start -->
									<div class="size-filter single-pro-size mb-35 clearfix">
										<ul>
											<li><span class="color-title text-capitalize">size</span></li>
											<li><a href="#">M</a></li>
											<li><a class="active" href="#">S</a></li>
											<li><a href="#">L</a></li>
											<li><a href="#">SL</a></li>
											<li><a href="#">XL</a></li>
										</ul>
									</div>
									<!-- Size end -->
									<div class="clearfix">
										<div class="cart-plus-minus">
											<input type="text" value="02" name="qtybutton" class="cart-plus-minus-box">
										</div>
										<div class="product-action clearfix">
											<a href="wishlist.html" data-bs-toggle="tooltip" data-placement="top" title="Wishlist"><i class="zmdi zmdi-favorite-outline"></i></a>
											<a href="#" data-bs-toggle="modal"  data-bs-target="#productModal" title="Quick View"><i class="zmdi zmdi-zoom-in"></i></a>
											<a href="#" data-bs-toggle="tooltip" data-placement="top" title="Compare"><i class="zmdi zmdi-refresh"></i></a>
											<a href="cart.html" data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
										</div>
									</div>
									<!-- Single-pro-slider Small-photo start -->
									<div class="single-pro-slider single-sml-photo slider-nav">
                                            <?php
                                                    $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                                    $stmt_img->execute([$image_id]);
                                                    while($img_data = $stmt_img->fetch(PDO::FETCH_ASSOC)){
                                            ?>
										<div>
											<img src="sanjary-admin/<?php echo $img_data['path'] ?>" alt="" />
										</div>
										
                                        <?php } ?>
									</div>
									<!-- Single-pro-slider Small-photo end -->
								</div>
							</div>
						</div>
						<!-- Single-product end -->
					</div>
					<!-- single-product-tab start -->
					<div class="single-pro-tab">
						<div class="row">
							<div class="col-md-3">
								<div class="single-pro-tab-menu">
									<!-- Nav tabs -->
									<ul class="nav d-block">
										<li><a href="#description" data-bs-toggle="tab">Description</a></li>
										<li><a class="active" href="#reviews"  data-bs-toggle="tab">Reviews</a></li>
										<li><a href="#information" data-bs-toggle="tab">Information</a></li>
										<li><a href="#tags" data-bs-toggle="tab">Tags</a></li>
									</ul>
								</div>
							</div>
							<div class="col-md-9">
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane" id="description">
										<div class="pro-tab-info pro-description">
											<h3 class="tab-title title-border mb-30"><?php echo $product_name ?></h3>
											<p><?php echo $description ?></p>
										</div>
									</div>
									<div class="tab-pane active" id="reviews">
										<div class="pro-tab-info pro-reviews">
											<div class="customer-review mb-60">
												<h3 class="tab-title title-border mb-30">Customer review</h3>
												<ul class="product-comments clearfix">
													<li class="mb-30">
														<div class="pro-reviewer">
															<img src="img/reviewer/1.jpg" alt="" />
														</div>
														<div class="pro-reviewer-comment">
															<div class="fix">
																<div class="floatleft mbl-center">
																	<h5 class="text-uppercase mb-0"><strong>Gerald Barnes</strong></h5>
																	<p class="reply-date">27 Jun, 2021 at 2:30pm</p>
																</div>
																<div class="comment-reply floatright">
																	<a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
																	<a href="#"><i class="zmdi zmdi-close"></i></a>
																</div>
															</div>
															<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
														</div>
													</li>
													<li class="threaded-comments">
														<div class="pro-reviewer">
															<img src="img/reviewer/1.jpg" alt="" />
														</div>
														<div class="pro-reviewer-comment">
															<div class="fix">
																<div class="floatleft mbl-center">
																	<h5 class="text-uppercase mb-0"><strong>Gerald Barnes</strong></h5>
																	<p class="reply-date">27 Jun, 2021 at 2:30pm</p>
																</div>
																<div class="comment-reply floatright">
																	<a href="#"><i class="zmdi zmdi-mail-reply"></i></a>
																	<a href="#"><i class="zmdi zmdi-close"></i></a>
																</div>
															</div>
															<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
														</div>
													</li>
												</ul>
											</div>
											<div class="leave-review">
												<h3 class="tab-title title-border mb-30">Leave your reviw</h3>
												<div class="your-rating mb-30">
													<p class="mb-10"><strong>Your Rating</strong></p>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
													<span class="separator">|</span>
													<span>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
														<a href="#"><i class="zmdi zmdi-star-outline"></i></a>
													</span>
												</div>
												<div class="reply-box">
													<form action="#">
														<div class="row">
															<div class="col-md-6">
																<input type="text" placeholder="Your name here..." name="name" />
															</div>
															<div class="col-md-6">
																<input type="text" placeholder="Subject..." name="name" />
															</div>
														</div>
														<div class="row">
															<div class="col-md-12">
																<textarea class="custom-textarea" name="message" placeholder="Your review here..." ></textarea>
																<button type="submit" data-text="submit review" class="button-one submit-button mt-20">submit review</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>		
									</div>
									<div class="tab-pane" id="information">
										<div class="pro-tab-info pro-information">
											<h3 class="tab-title title-border mb-30">Product information</h3>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
										</div>											
									</div>
									<div class="tab-pane" id="tags">
										<div class="pro-tab-info pro-information">
											<h3 class="tab-title title-border mb-30">tags</h3>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
											<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer accumsan egestas elese ifend. Phasellus a felis at est bibendum feugiat ut eget eni Praesent et messages in con sectetur posuere dolor non.</p>
										</div>											
									</div>
								</div>									
							</div>
						</div>
					</div>
					<!-- single-product-tab end -->
				</div>
			</div>
			<!-- PRODUCT-AREA END -->

<?php include('include/footer.php'); ?>