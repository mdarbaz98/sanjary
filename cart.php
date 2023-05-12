<?php include('include/header.php'); ?>
<main id="content">
        <section class="py-3 bg-color-3">
            <div class="container">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb py-0">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="#"> Pages </a></li>
                        <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="pb-11 pb-lg-15 pt-10">
            <div class="container">
                <h2 class="fs-sm-40 mb-9 text-center">Shopping Cart</h2>
                <form>
                    <div class="row">
                        <div class="col-lg-9 mb-9 mb-lg-0 pr-lg-13">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td colspan="4" class="border-bottom pl-0 pb-3">
                                                <!-- <p class="fs-15 text-primary mb-0"><span
                                                        class="d-inline-block mr-2 fs-14"><i
                                                            class="far fa-check-circle"></i></span>
                                                    Your cart is saved for the next <span
                                                        class="font-weight-600">4m34s</span></p> -->
                                            </td>
                                        </tr>

                                        <?php  if(isset($_COOKIE[$cookie_name])){
                                            $cart_product=$conn->prepare("SELECT * FROM cart where userid=? order by id desc");
                                            $cart_product->execute([$_COOKIE[$cookie_name]]);
                                            $i=0;
                                            $total_cart_product = $cart_product->rowCount();
                                            if ($total_cart_product > 0) {
                                            $cartTotal = 0;
                                            while ($row = $cart_product->fetch(PDO::FETCH_ASSOC)){ ?>
                                        <tr>
                                       
                                            <td class="pl-0 py-6 align-middle"><a href="javascript:void(0)" class="d-block mr-4" onclick="deleteCart(<?php echo $row['id'] ?>)"><i
                                                        class="fal fa-times"></i></a></td>
                                            <td class="py-6 pl-0">
                                                <div class="media">
                                                    <div class="w-90px mr-4">
                                                        <img src="sanjar-admin/<?php echo $row['pro_img'] ?>" alt="<?php echo $row['pro_img'] ?>">
                                                    </div>
                                                    <div class="media-body">
                                                        <p
                                                            class="text-muted fs-12 mb-0 text-uppercase letter-spacing-05 lh-1 mb-1 font-weight-500">
                                                            chairs</p>
                                                        <a href="#" class="font-weight-bold mb-1 d-block"><?php echo $row["pro_name"] ?>
                                                            Stool</a>
                                                        <!-- <p class="fs-15 text-primary d-block mb-0">Black / 900 Diameter
                                                        </p> -->
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td class="pl-0 py-6">
                                                <div class="input-group position-relative w-100px">
                                                    <a href="javascript:void(0)" onclick="removeQuantity(<?php echo $row['id'] ?>,'<?php echo $row['userid'] ?>')" class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i
                                                            class="far fa-minus"></i></a>
                                                    <input name="number[]" type="number"
                                                        class="form-control form-control-sm w-100 px-6 fs-16 text-center input-quality bg-transparent h-35px"
                                                        value="<?php echo $row['pro_qty'] ?>">
                                                    <a href="javascript:void(0)" class="up position-absolute pos-fixed-right-center pr-2 z-index-2" onclick="addQuantity(<?php echo $row['id'] ?>,'<?php echo $row['userid'] ?>')"><i
                                                            class="far fa-plus"></i>
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="pl-0 py-6">
                                                <p class="mb-0 ml-12 text-primary"><span id="change_qty"><?php echo $row["pro_qty"] ?></span> x <span><?php echo $row["pro_price"] ?></span>.00</p>
                                            </td>
                                        </tr>
                                        <?php
                                        $cartTotal = $cartTotal + ($row["pro_price"] * $row["pro_qty"]);
                                        } }
                                        } ?>

                                        
                                    </tbody>
                                </table>
                            </div>
                            <p class="fs-15 text-primary pt-1 mb-0">
                                <span class="d-inline-block mr-2 fs-14"><i class="fas fa-info-circle"></i></span>
                                Special instruction for seller
                            </p>
                        </div>
                        <div class="col-lg-3">
                            <div class="card border-0">
                                <div class="card-header border-0 bg-transparent p-0">
                                    <h4 class="card-title fs-24 mb-0">Summary</h4>
                                </div>
                                <div class="card-body pt-6 px-0 pb-4">
                                    <div class="d-flex align-items-center mb-1">
                                        <span class="text-primary">Subtotal</span>
                                        <span class="d-block ml-auto text-primary" id="change_subtotal"><?php echo $cartTotal ?>.00</span>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <span class="text-primary">Shipping</span>
                                        <span class="d-block ml-auto text-primary">20.00</span>
                                    </div>
                                </div>
                                <div class="card-footer pt-4 px-0 bg-transparent">
                                    <div class="d-flex align-items-center font-weight-bold mb-7">
                                        <span class="text-primary">Total</span>
                                        <span class="d-block ml-auto text-primary" id="change_totalPrice"><?php echo $cartTotal+20; ?>.00</span>
                                    </div>
                                    <input type="text" name="coupon" class="form-control w-100 text-primary mb-3"
                                        placeholder="Enter coupon code here">
                                        <a href="checkout.php" class="btn btn-primary btn-block mb-2">CHECK OUT</a>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section class="pb-11 pb-lg-15">
            <div class="container">
                <h2 class="fs-sm-40 mb-9 text-center">May You Like This</h2>
                <div class="slick-slider"
                    data-slick-options='{"slidesToShow": 4,"infinite":true,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 769,"settings": {"slidesToShow":2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>
                    
                    <?php
                 $product=$conn->prepare("SELECT * FROM product order by id desc limit 8");
                 $product->execute();
                 $i=0;
                 $total_product = $product->rowCount();
                 if ($total_product > 0) {
                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
                        
                        if(!empty($row['subcat_id'])){
                            $cat_id = $row['subcat_id'];
                        }else{
                            $cat_id = 1;
                        }
                        $product_cat=$conn->prepare("SELECT * FROM categories WHERE id=?");
                        $product_cat->execute([$cat_id]);
                        $product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC);
                        // for image
                        $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
						$stmt_img->execute([$row['img_id']]);
						$img_data = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
						if (!empty($img_data)) {
							$image = $img_data[0]['path']; 
							$alt = $img_data[0]['alt'];
						}else{
                            $image="Not Found";
							$alt="Not Found";
						}			
                        
                        ?>

                    <div class="box">
                        <div class="card border-0 hover-change-content product">
                            <div class="card-img-top position-relative">
                                <div style="background-image: url('sanjar-admin/<?php echo $image ?>')"
                                    class="card-img ratio bg-img-cover-center ratio-1-1">
                                </div>
                                <div
                                    class="position-absolute pos-fixed-bottom px-4 px-sm-6 pb-5 d-flex w-100 justify-content-center content-change-horizontal">
                                    <a href="javascript:void(0)" data-toggle="tooltip" title="Add to card" onclick="addTocart(this)" data-proid="<?php echo $row['id']; ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $row['title'] ?>" data-category=<?php echo $product_cat_data['cat_name']; ?> data-price="<?php echo $row['prc'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>"
                                        class="add-to-cart d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mr-2 border">
                                        <i class="far fa-shopping-basket"></i>
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Add to favourite"
                                        class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mr-2 border">
                                        <i class="far fa-heart"></i>
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Add to compare"
                                        class="add-to-compare d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mr-2 border">
                                        <i class="far fa-random"></i>
                                    </a>
                                    <a href="#" data-toggle="tooltip" title="Preview"
                                        class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle border">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-4 pb-0 d-flex align-items-end">
                                <div class="mr-auto">
                                    <a href="#" class="text-uppercase text-muted letter-spacing-05 fs-12 d-block font-weight-500"><?php echo $product_cat_data['cat_name']; ?></a>
                                    <a href="<?php echo $row['slug']; ?>" class="font-weight-bold mt-1 d-block"><?php echo $row['title']; ?></a>
                                </div>
                                <p class="text-primary mb-0 font-weight-500"><?php echo number_format($row['prc'],2); ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                    }
                }
            ?>

                </div>
            </div>
        </section>
    </main>
<?php include('include/footer.php') ?>