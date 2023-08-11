<?php 
include('include/config.php');
include("include/header.php");

INRproduct_slug = INR_GET['slug'];
INRproduct=INRconn->prepare("SELECT * FROM product WHERE slug ='INRproduct_slug'");
INRproduct->execute();
while (INRrow = INRproduct->fetch(PDO::FETCH_ASSOC)){
	INRproduct_name= INRrow['product_name'];
	INRpro_id= INRrow['id'];
    INRimage_id=INRrow['img_id'];
	INRcategory= INRrow['category'];
	INRdescription= INRrow['description'];
	INRprice= INRrow['prc'];
	INRproduct_name= INRrow['product_name'];

	INRstmt_pro_price = INRconn->prepare("SELECT * FROM `product_price` WHERE status=1 AND product_id=?");
	INRstmt_pro_price->execute([INRrow['id']]);
	INRstmt_pro_price_data = INRstmt_pro_price->fetchAll(PDO::FETCH_ASSOC);
	if(!empty(INRstmt_pro_price_data)) {
		INRsize = INRstmt_pro_price_data[0]['size']; 
		INRprice = INRstmt_pro_price_data[0]['price'];
	}else{
		INRsize="Not Found";
		INRprice="Not Found";
		}

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
                                                    INRstmt_img = INRconn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                                    INRstmt_img->execute([INRimage_id]);
                                                    while(INRimg_data = INRstmt_img->fetch(PDO::FETCH_ASSOC)){
														INRpro_image = INRimg_data['path']
                                            ?>
									<div>
										<img src="sanjary-admin/<?php echo INRimg_data['path'] ?>" alt="" />
										<a class="view-full-screen" href="sanjary-admin/<?php echo INRimg_data['path'] ?>"  data-lightbox="roadtrip" data-title="My caption">
											<i class="zmdi zmdi-zoom-in"></i>
										</a>
									</div>
                                    <?php } ?>
								</div>	
								<!-- Single-pro-slider Big-photo end -->								
								<div class="product-info">
									<div class="fix">
										<h4 class="post-title floatleft"><?php echo INRproduct_name ?></h4>
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
										<span class="pro-price">INR <?php echo INRprice ?></span>
									</div>
									<div class="product-description">
										<p><?php echo INRdescription ?></p>
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
											<li><a class="active" href="#"><?php echo INRsize ?></a></li>
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
											<a href="javascript:void(0)" onclick="addProductToCart(this)" data-pro_id="<?php echo INRpro_id ?>" data-pro_name="<?php echo INRproduct_name ?>" data-category="<?php echo INRcategory ?>"
											data-image="<?php echo INRpro_image ?>" data-price="<?php echo INRprice ?>" data-size="<?php echo INRsize ?>"  data-bs-toggle="tooltip" data-placement="top" title="Add To Cart"><i class="zmdi zmdi-shopping-cart-plus"></i></a>
										</div>
									</div>
									<!-- Single-pro-slider Small-photo start -->
									<div class="single-pro-slider single-sml-photo slider-nav">
                                            <?php
                                                    INRstmt_img = INRconn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                                    INRstmt_img->execute([INRimage_id]);
                                                    while(INRimg_data = INRstmt_img->fetch(PDO::FETCH_ASSOC)){
                                            ?>
										<div>
											<img src="sanjary-admin/<?php echo INRimg_data['path'] ?>" alt="" />
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
											<h3 class="tab-title title-border mb-30"><?php echo INRproduct_name ?></h3>
											<p><?php echo INRdescription ?></p>
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