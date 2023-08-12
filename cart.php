<?php  include('include/config.php');
        include("include/header.php"); ?>

			<!-- SHOPPING-CART-AREA START -->
			<div class="shopping-cart-area  pt-80 pb-80">
				<div class="container">	
					<div class="row">
						<div class="col-lg-12">
							<div class="shopping-cart">
								<!-- Nav tabs -->
								<ul class="cart-page-menu nav row clearfix mb-30">
									<li><a class="active" href="#shopping-cart" data-bs-toggle="tab">shopping cart</a></li>
									<li><a href="#check-out" data-bs-toggle="tab">check out</a></li>
									<li><a href="#order-complete" data-bs-toggle="tab">order complete</a></li>
								</ul>

								<!-- Tab panes -->
								<div class="tab-content">
									<!-- shopping-cart start -->
									<div class="tab-pane active" id="shopping-cart">
										<form action="#">
											<div class="shop-cart-table">
												<div class="table-content table-responsive">
													<table>
														<thead>
															<tr>
																<th class="product-thumbnail">Product</th>
																<th class="product-price">Price</th>
																<th class="product-quantity">Quantity</th>
																<th class="product-subtotal">Total</th>
																<th class="product-remove">Remove</th>
															</tr>
														</thead>
														<tbody class="cartProductlisting">

														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="col-md-6">
												</div>
												<div class="col-md-6">
													<div class="customer-login payment-details mt-30">
														<h4 class="title-1 title-border text-uppercase">payment details</h4>
														<table>
															<tbody>
																<tr>
																	<td class="text-left">Cart Subtotal</td>
																	<td class="text-end cart_subtotal">00</td>
																</tr>
																<tr>
																	<td class="text-left">Order Total</td>
																	<td class="text-end final_cartTotal">$170.00</td>
																</tr>
															</tbody>
														</table>
                                                        <ul class="cart-page-menu nav row mb-30">
                                                            <li><a href="#check-out" data-bs-toggle="tab">check out</a></li>
                                                        </ul>

													</div>
												</div>
											</div>
										</form>		
									</div>
									<!-- shopping-cart end -->
									<!-- check-out start -->
									<div class="tab-pane" id="check-out">
										<form name="userOrderplace">
											<div class="shop-cart-table check-out-wrap">
												<div class="row">
													<div class="col-md-6">
														
													</div>
													<div class="col-md-6 mt-xs-30">
														<div class="billing-details pl-20">
															<h4 class="title-1 title-border text-uppercase mb-30">ship to different address</h4>
															<input type="text" placeholder="Your name here..." name="name">
															<input type="text" placeholder="Email address here..." name="email">
															<input type="text" placeholder="Phone here..." name="phone">
                                                            <textarea class="custom-textarea" placeholder="Your address here..." name="address"></textarea>
                                                            <input type="text" placeholder="Postal Code here..." name="pincode">
                                                            <select class="custom-select mb-15" name="state">
																<option>State</option>
																<option>Dhaka</option>
																<option>New York</option>
																<option>London</option>
																<option>Melbourne</option>
																<option>Ottawa</option>
															</select>
															<select class="custom-select mb-15" name="city">
																<option>Town / City</option>
																<option>Dhaka</option>
																<option>New York</option>
																<option>London</option>
																<option>Melbourne</option>
																<option>Ottawa</option>
															</select>
                                                            
														</div>
													</div>

													<!-- payment-method -->
													<div class="col-md-6">
														<div class="payment-method pl-10">
															<div class="payment-accordion">
																<!-- Accordion start -->
																
																<!-- Accordion end --> 
																<button class="button-one submit-button mt-15" data-text="place order" type="submit">place order</button>			
															</div>															
														</div>
													</div>
												</div>
											</div>
											<input type="hidden" name="btn" value="addUseraddress"/>
										</form>											
									</div>
									<!-- check-out end -->
									<!-- order-complete start -->
									<div class="tab-pane" id="order-complete">
										<form>
											<div class="thank-recieve bg-white mb-30">
												<p>Thank you. Your order has been received.</p>
											</div>
											<div class="order-info bg-white text-center clearfix mb-30">
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">order no</h4>
													<p class="text-uppercase text-light-black mb-0"><strong>m 2653257</strong></p>
												</div>
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">Date</h4>
													<p class="text-uppercase text-light-black mb-0"><strong>june 15, 2021</strong></p>
												</div>
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">Total</h4>
													<p class="text-uppercase text-light-black mb-0"><strong>$ 170.00</strong></p>
												</div>
												<div class="single-order-info">
													<h4 class="title-1 text-uppercase text-light-black mb-0">payment method</h4>
													<p class="text-uppercase text-light-black mb-0"><a href="#"><strong>check payment</strong></a></p>
												</div>
											</div>
											<div class="shop-cart-table check-out-wrap">
												<div class="row">
													<div class="col-md-6">
														<div class="our-order payment-details pr-20">
															<h4 class="title-1 title-border text-uppercase mb-30">our order</h4>
															<table>
																<thead>
																	<tr>
																		<th><strong>Product</strong></th>
																		<th class="text-end"><strong>Total</strong></th>
																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>Dummy Product Name  x 2</td>
																		<td class="text-end">$86.00</td>
																	</tr>
																	<tr>
																		<td>Dummy Product Name  x 1</td>
																		<td class="text-end">$69.00</td>
																	</tr>
																	<tr>
																		<td>Cart Subtotal</td>
																		<td class="text-end">$155.00</td>
																	</tr>
																	<tr>
																		<td>Shipping and Handing</td>
																		<td class="text-end">$15.00</td>
																	</tr>
																	<tr>
																		<td>Vat</td>
																		<td class="text-end">$00.00</td>
																	</tr>
																	<tr>
																		<td>Order Total</td>
																		<td class="text-end">$170.00</td>
																	</tr>
																</tbody>
															</table>
														</div>
													</div>
													<!-- payment-method -->
													<div class="col-md-6 mt-xs-30">
														<div class="payment-method  pl-20">
															<h4 class="title-1 title-border text-uppercase mb-30">payment method</h4>
															<div class="payment-accordion">
																<!-- Accordion start  -->
																<h3 class="payment-accordion-toggle active">Direct Bank Transfer</h3>
																<div class="payment-content default">
																	<p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won't be shipped until the funds have cleared in our account.</p>
																</div> 
																<!-- Accordion end -->
																<!-- Accordion start -->
																<h3 class="payment-accordion-toggle">Cheque Payment</h3>
																<div class="payment-content">
																	<p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
																</div>
																<!-- Accordion end -->
																<!-- Accordion start -->
																<h3 class="payment-accordion-toggle">PayPal</h3>
																<div class="payment-content">
																	<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
																	<a href="#"><img src="img/payment/1.png" alt="" /></a>
																	<a href="#"><img src="img/payment/2.png" alt="" /></a>
																	<a href="#"><img src="img/payment/3.png" alt="" /></a>
																	<a href="#"><img src="img/payment/4.png" alt="" /></a>
																</div>
																<!-- Accordion end --> 
																<button class="button-one submit-button mt-15" data-text="place order" type="submit">place order</button>			
															</div>															
														</div>
													</div>
												</div>
											</div>
										</form>										
									</div>
									<!-- order-complete end -->
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- SHOPPING-CART-AREA END -->

<?php include('include/footer.php'); ?>