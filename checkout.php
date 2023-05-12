<?php
include('include/header.php')
?>
  <main id="content">
        <section class="py-3 bg-color-3">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb py-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#"> Pages </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="pb-11 pb-lg-15 pt-10">
            <div class="container">
                <h2 class="fs-sm-40 mb-9 text-center">Check Out</h2>
                <p class="mb-6">Have a coupon? <a href="#"
                        class="d-inline-block fs-15 border-bottom lh-12 border-primary enter-coupon">Click
                        here to enter your code</a></p>
                <div class="card bg-color-3 mxw-510 border-0 rounded-0 box-coupon mb-8">
                    <div class="card-body pt-6 px-5 pb-7">
                        <p class="card-text text-primary mb-5">If you have a coupon code, please apply it below.</p>
                        <form id="checkout_form11">
                            <div class="input-group">
                                <input type="email" class="form-control" placeholder="Your Email*">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">apply coupon</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <form id="checkout_form">
                    <div class="row">
                        <div class="col-lg-6 mb-9 mb-lg-0">
                            <h3 class="fs-24 mb-7">Billing details</h3>
                            <div class="form-group mb-5">
                                <label for="first-name" class="mb-2 text-primary font-weight-500">Full Name<abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                                <input type="text" id="first-name" class="form-control" name="full_name">
                            </div>
                            <div class="form-group mb-5">
                                <label for="email" class="mb-2 text-primary font-weight-500">Email <abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                                <input type="text" id="email" class="form-control" name="email">
                            </div>
                            <div class="form-group mb-9">
                                <label for="phone" class="mb-2 text-primary font-weight-500">Phone <abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                                <input type="text" id="phone" class="form-control" name="phone">
                            </div>
                            <div class="form-group mb-5">
                            <label for="address" class="mb-2 text-primary font-weight-500">Street address <abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                            <textarea id="address" cols="20" rows="5" class="form-control mb-5" name="address" placeholder="House number and street name"></textarea>
                            </div>
                            <div class="form-group mb-5">
                                <label for="state" class="mb-2 text-primary font-weight-500">State<abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                                <input type="text" id="state" class="form-control"name="state">
                            </div>
                            <div class="form-group mb-5">
                                <label for="city" class="mb-2 text-primary font-weight-500">City<abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                                <input type="text" id="city" class="form-control"name="city">
                            </div>
                            <div class="form-group mb-5">
                                <label for="postCode" class="mb-2 text-primary font-weight-500">Post code <abbr
                                        class="text-danger text-decoration-none" title="required">*</abbr></label>
                                <input type="text" id="postCode" class="form-control" name="post_code">
                            </div>
                            <h3 class="fs-24 mb-7">Additional Information</h3>
                            <div class="form-group mb-5">
                                <label for="note" class="mb-2 text-primary font-weight-500">Order
                                    notes(optional)</label>
                                <textarea id="note" class="form-control" name="notes"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 pl-lg-13">
                            <h3 class="fs-24 mb-7">Your order</h3>
                            <div class="card border-0 rounded-0 bg-color-3">
                                <div class="card-body px-6 py-7">
                                    <div class="d-flex pb-3">
                                        <div class="text-primary font-weight-bold">Product</div>
                                        <div class="text-primary font-weight-bold ml-auto">Total</div>
                                    </div>
                                  <?php  if(isset($_COOKIE[$cookie_name])){
                                            $cart_product=$conn->prepare("SELECT * FROM cart where userid=? order by id desc");
                                            $cart_product->execute([$_COOKIE[$cookie_name]]);
                                            $i=0;
                                            $total_cart_product = $cart_product->rowCount();
                                            if ($total_cart_product > 0) {
                                            $cartTotal = 0;
                                            while ($row = $cart_product->fetch(PDO::FETCH_ASSOC)){ ?>
                                    <div class="pb-3 mb-3 border-bottom d-flex">
                                        <img style="width:100px;" src="sanjar-admin/<?php echo $row['pro_img'] ?>" alt="<?php echo $row['pro_img'] ?>">
                                        <div style="padding-top: 15px;padding-left: 15px;" class="text-primary"><?php echo $row['pro_name'] ?> × <?php echo $row['pro_qty'] ?></div>
                                        <div class="text-primary ml-auto"><?php echo $row['sub_total'] ?>.00</div>
                                    </div>
                                    

                                    <?php
                                          $cartTotal = $cartTotal + ($row["pro_price"] * $row["pro_qty"]);
                                        } }
                                        } ?>

                                    <div class="pb-8 mb-3 border-bottom d-flex">
                                        <div class="text-primary">Total</div>
                                        <div class="text-primary font-weight-bolder ml-auto"><?php echo $cartTotal ?>.00</div>
                                    </div>
                                    
                                    <div class="form-check pl-0 border-bottom pb-3 mb-3">
                                        
                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="payment-method"
                                                id="cheque" value="online">
                                            <label class="custom-control-label text-primary ml-2" for="cheque">
                                                Cheque Payment
                                            </label>
                                        </div>

                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="payment-method"
                                                id="cash" value="cod">
                                            <label class="custom-control-label text-primary ml-2" for="cash">
                                                Cash On Delivery
                                            </label>
                                        </div>
                                    </div>
                                    <input type="hidden" value="<?php echo 230 ?>.00" name="pay_total" id="pay_total">
                                    <input type="hidden" value="<?php echo $_COOKIE[$cookie_name] ?>" name="userid"/>
                                    <input type="hidden" value="checkout_details" name="btn"/>
                                    <button class="btn btn-outline-primary btn-block" type="submit">
                                        Place Oder
                                    </button>
                                    <div id="paypal-button-container"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
<?php
include('include/footer.php')
?>