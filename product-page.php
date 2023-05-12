<?php
include('include/db.php');
$slug = $_GET['slug'];
$product = $conn->prepare('SELECT * FROM product WHERE slug=?');
$product->execute([$slug]);
$proCount = $product->rowCount();

if ($proCount > 0) {

    $page = "post";
    while ($row = $product->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $title = $row['title'];
        $desc = $row['description'];
        $price = $row['prc'];
        if(!empty($row['subcat_id'])){
            $cat_id = $row['subcat_id'];
        }else{
            $cat_id = 1;
        }
        $product_cat=$conn->prepare("SELECT * FROM categories WHERE id=?");
        $product_cat->execute([$cat_id]);
        $product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC);    

        if(!empty($row['img_id'])){
            $img_id = $row['img_id'];
        }else{
            $img_id = 1;
        }




    }
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


include('include/header.php');
?>
  <main id="content">
        <section class="vh-100 bg-color-5 position-relative gallery-product-page-02 overflow-hidden">
            <div class="container container-xxl">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="slick-slider dots-inner-center"
                            data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":false,"dots":true,"arrows":false}'>
                        <?php
                        $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id in ($img_id)");
						$stmt_img->execute();
                        $i=1;
                        while ($img_data = $stmt_img->fetch(PDO::FETCH_ASSOC)){
                            // echo "<pre>";
                            // print_r($img_data);
                            // echo "</pre>";
                        
						if (!empty($img_data)) {
							$image = $img_data['path']; 
							$alt = $img_data['alt'];
						}else{
                            $image="Not Found";
							$alt="Not Found";
						}

                    
?>
                            <div class="box">
                                <div class="d-flex flex-column justify-content-center bg-img-cover-center vh-100 custom-height-sm"
                                    style="background-image: url('sanjar-admin/<?php echo $image ?>')">
                                </div>
                            </div>
                           
                    <?php }?>
                        
                        </div>
                    </div>
                    <div class="col-lg-4 product-details">
                        <div class="card border-0 mxw-435px mx-auto">
                            <div class="card-body px-5 pt-5 pb-8">
                                <p class="text-muted fs-12 font-weight-500 letter-spacing-05 text-uppercase">chairs</p>
                                <h2 class="fs-30 fs-lg-40 mb-5"><?php echo $title ?></h2>
                                <p class="fs-20 text-primary mb-5"><?php echo $price ?>.00</p>
                                <div class="d-flex align-items-center flex-wrap mb-3">
                                    <ul
                                        class="list-inline d-flex justify-content-sm-end justify-content-center mb-0 rating-result">
                                        <li class="list-inline-item">
                                            <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                        </li>
                                        <li class="list-inline-item">
                                            <span class="text-primary fs-12 lh-2"><i class="fas fa-star"></i></span>
                                        </li>
                                    </ul>
                                </div>
                                <p class="mb-6 d-none d-sm-block"><?php echo $desc ?></p>
                                <form>
                                    <div class="row align-items-end no-gutters mx-n2">
                                        <div class="col-sm-4 form-group px-2 mb-6">
                                            <label class="text-primary fs-16 font-weight-bold mb-3"
                                                for="number">Quantity: </label>
                                            <div class="input-group position-relative w-100">
                                                <a href="#"
                                                    class="down position-absolute pos-fixed-left-center pl-2 z-index-2"><i
                                                        class="far fa-minus"></i></a>
                                                <input name="number" type="number" id="number"
                                                    class="form-control w-100 px-6 text-center input-quality bg-transparent text-primary"
                                                    value="1" required>
                                                <a href="#"
                                                    class="up position-absolute pos-fixed-right-center pr-2 z-index-2"><i
                                                        class="far fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-sm-8 mb-6 w-100 px-2">
                                            <button type="submit" class="btn btn-primary btn-block "><a href="javascript:void(0)" class="text-white" title="Add to card" onclick="addTocart(this)" data-proid="<?php echo $id ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $title ?>" data-price="<?php echo $price ?>" data-qty="<?php echo 1 ?>">add to cart</a>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="d-flex align-items-center flex-wrap">
                                    <a href="#" class="text-uppercase font-weight-bold letter-spacing-05 fs-14 mr-6">
                                        <i class="fas fa-random fs-16"></i>
                                        <span class="ml-1">Compare</span>
                                    </a>
                                    <a href="#" class="text-uppercase font-weight-bold letter-spacing-05 fs-14">
                                        <i class="far fa-heart fs-16"></i>
                                        <span class="ml-1">Add to wishlist</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-11 py-lg-13">
            <div class="container">
                <div class="collapse-tabs">
                    <ul class="nav nav-pills mb-3 justify-content-center d-md-flex d-none" id="pills-tab"
                        role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active show fs-lg-32 fs-24 font-weight-600 p-0 mr-md-10 mr-4"
                                id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab"
                                aria-controls="pills-description" aria-selected="false">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-lg-32 fs-24 font-weight-600 p-0 mr-md-10 mr-4"
                                id="pills-infomation-tab" data-toggle="pill" href="#pills-infomation" role="tab"
                                aria-controls="pills-infomation" aria-selected="false">Infomation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-lg-32 fs-24 font-weight-600 p-0" id="pills-reviews-tab"
                                data-toggle="pill" href="#pills-reviews" role="tab" aria-controls="pills-reviews"
                                aria-selected="true">Reviews (3)</a>
                        </li>
                    </ul>
                    <div class="tab-content bg-white-md shadow-none py-md-5 p-0">
                        <div id="collapse-tabs-accordion-01">
                            <div class="tab-pane tab-pane-parent fade show active" id="pills-description"
                                role="tabpanel">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-header border-0 d-block d-md-none bg-transparent px-0 py-1"
                                        id="headingDetails-01">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn lh-2 fs-18 py-1 px-6 shadow-none w-100 collapse-parent border text-primary"
                                                data-toggle="false" data-target="#description-collapse-01"
                                                aria-expanded="true" aria-controls="description-collapse-01">
                                                Description
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="description-collapse-01" class="collapsible collapse show"
                                        aria-labelledby="headingDetails-01" data-parent="#collapse-tabs-accordion-01"
                                        style="">
                                        <div id="accordion-style-01"
                                            class="accordion accordion-01 border-md-0 border p-md-0 p-6">
                                            <div class="text-center pt-md-7">
                                                <img src="images/description-product.jpg" alt="Description Product">
                                            </div>
                                            <p class="mt-6 mt-md-10 mxw-830 mx-auto mb-0">Perfect for Equestrian homes
                                                or every horse
                                                lover.
                                                Designer premium signature aluminum alloy all Arthur Court is
                                                compliance with FDA regulations.
                                                Aluminum Serveware can be chilled in the freezer or refrigerator and
                                                warmed in the oven to 350. Wash by hand with mild dish soap and dry
                                                immediately – do not put in the dishwasher.
                                                Comes in Gift Box perfect for Equestrian home or Horse lover in your
                                                life.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane tab-pane-parent fade" id="pills-infomation" role="tabpanel">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-header border-0 d-block d-md-none bg-transparent px-0 py-1"
                                        id="headinginfomation-01">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn lh-2 fs-18 py-1 px-6 shadow-none w-100 collapse-parent border collapsed text-primary"
                                                data-toggle="collapse" data-target="#infomation-collapse-01"
                                                aria-expanded="false" aria-controls="infomation-collapse-01">
                                                Infomation
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="infomation-collapse-01" class="collapsible collapse"
                                        aria-labelledby="headinginfomation-01" data-parent="#collapse-tabs-accordion-01"
                                        style="">
                                        <div id="accordion-style-01-2"
                                            class="accordion accordion-01 border-md-0 border p-md-0 p-6 ">
                                            <div class="mxw-830 mx-auto pt-md-4">
                                                <div class="table-responsive mb-md-7">
                                                    <table class="table table-border-top-0 mb-0">
                                                        <tbody>
                                                            <tr>
                                                                <td class="pl-0">Material</td>
                                                                <td class="text-right pr-0">Steel, Wood, Marble</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pl-0">Dimensions</td>
                                                                <td class="text-right pr-0">55.1"W X 14.6"D X 23.6"H
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pl-0">Weight</td>
                                                                <td class="text-right pr-0">Weight 23 lbs</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pl-0">Origin</td>
                                                                <td class="text-right pr-0">Denmark</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="pl-0">Brand</td>
                                                                <td class="text-right pr-0">FLOYD</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-3 col-md-2 mb-6 mb-sm-0">
                                                        <img class="border" src="images/product-page-09.jpg"
                                                            alt="Image Product">
                                                    </div>
                                                    <div class="col-sm-9 col-md-10">
                                                        Perfect for Equestrian homes or every horse lover. Designer
                                                        premium
                                                        signature aluminum alloy all Arthur Court is compliance with FDA
                                                        regulations. Aluminum Serveware can be chilled in the freezer or
                                                        refrigerator and warmed in the oven to 350. Wash by hand with
                                                        mild dish
                                                        soap and dry immediately – do not put in the dishwasher. Comes
                                                        in Gift
                                                        Box perfect for Equestrian home or Horse lover in your life.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane tab-pane-parent fade" id="pills-reviews" role="tabpanel">
                                <div class="card border-0 bg-transparent">
                                    <div class="card-header border-0 d-block d-md-none bg-transparent px-0 py-1"
                                        id="headingreviews-01">
                                        <h5 class="mb-0">
                                            <button
                                                class="btn lh-2 fs-18 py-1 px-6 shadow-none w-100 collapse-parent border collapsed text-primary"
                                                data-toggle="collapse" data-target="#reviews-collapse-01"
                                                aria-expanded="false" aria-controls="reviews-collapse-01">
                                                Reviews (3)
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="reviews-collapse-01" class="collapsible collapse"
                                        aria-labelledby="headingreviews-01" data-parent="#collapse-tabs-accordion-01"
                                        style="">
                                        <div id="accordion-style-01-3"
                                            class="accordion accordion-01 border-md-0 border p-md-0 p-6">
                                            <div class="comment-product mxw-830 mx-auto pt-md-4">
                                                <ul
                                                    class="list-inline mb-3 d-flex justify-content-center rating-result">
                                                    <li class="list-inline-item fs-18 text-primary"><i
                                                            class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-18 text-primary"><i
                                                            class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-18 text-primary"><i
                                                            class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-18 text-primary"><i
                                                            class="fas fa-star"></i></li>
                                                    <li class="list-inline-item fs-18 text-primary"><i
                                                            class="fas fa-star"></i></li>
                                                </ul>
                                                <p class="text-center mb-9 fs-15 text-primary lh-1"><span
                                                        class="d-inline-block border-right pr-1 mr-1">5.0</span>Base on
                                                    3
                                                    Reviews</p>
                                                <div class="media border-bottom pb-6 mb-6 ">
                                                    <div class="w-70px d-block mr-6">
                                                        <img src="images/tes_01.png" alt="Dean. D">
                                                    </div>
                                                    <div class="media-body">
                                                        <div
                                                            class="row no-gutters mb-2 align-items-center rating-result">
                                                            <ul class="list-inline mb-0 mr-auto d-flex col-sm-6">
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                            </ul>
                                                            <div class="col-sm-6 text-sm-right"><span
                                                                    class="fs-12 text-primary">Nov 20, 2020</span></div>
                                                        </div>
                                                        <p class="text-gray-01 lh-175 mb-2">It has a really nice fit
                                                            however it loses many fluffs and is kind of see-through
                                                            because the fabric is quite wid-meshed. Nevertheless it's a
                                                            really good and comfy staple that goes with every kind.</p>
                                                        <span class="font-weight-600 text-primary d-block">Dean.
                                                            D</span>
                                                    </div>
                                                </div>
                                                <div class="media border-bottom pb-6 mb-6 ">
                                                    <div class="w-70px d-block mr-6">
                                                        <img src="images/tes_02.png" alt="Dean. D">
                                                    </div>
                                                    <div class="media-body">
                                                        <div
                                                            class="row no-gutters mb-2 align-items-center rating-result">
                                                            <ul class="list-inline mb-0 mr-auto d-flex col-sm-6">
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                            </ul>
                                                            <div class="col-sm-6 text-sm-right"><span
                                                                    class="fs-12 text-primary">Nov 20, 2020</span></div>
                                                        </div>
                                                        <p class="text-gray-01 lh-175 mb-2">It has a really nice fit
                                                            however it loses many fluffs and is kind of see-through
                                                            because the fabric is quite wid-meshed. Nevertheless it's a
                                                            really good and comfy staple that goes with every kind.</p>
                                                        <span class="font-weight-600 text-primary d-block">Dean.
                                                            D</span>
                                                    </div>
                                                </div>
                                                <div class="media ">
                                                    <div class="w-70px d-block mr-6">
                                                        <img src="images/tes_03.png" alt="Dean. D">
                                                    </div>
                                                    <div class="media-body">
                                                        <div
                                                            class="row no-gutters mb-2 align-items-center rating-result">
                                                            <ul class="list-inline mb-0 mr-auto d-flex col-sm-6">
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                                <li class="list-inline-item fs-12 text-primary"><i
                                                                        class="fas fa-star"></i></li>
                                                            </ul>
                                                            <div class="col-sm-6 text-sm-right"><span
                                                                    class="fs-12 text-primary">Nov 20, 2020</span></div>
                                                        </div>
                                                        <p class="text-gray-01 lh-175 mb-2">It has a really nice fit
                                                            however it loses many fluffs and is kind of see-through
                                                            because the fabric is quite wid-meshed. Nevertheless it's a
                                                            really good and comfy staple that goes with every kind.</p>
                                                        <span class="font-weight-600 text-primary d-block">Dean.
                                                            D</span>
                                                    </div>
                                                </div>
                                                <div class="text-center mt-6 mt-md-9">
                                                    <a href="#" class="btn btn-outline-primary write-review">write a
                                                        review</a>
                                                </div>
                                                <div class="card border-0 mt-9 form-review hide ">
                                                    <div class="card-body p-0">
                                                        <h3 class="fs-40 text-center mb-9">Write A Review</h3>
                                                        <form>
                                                            <div class="d-flex flex-wrap">
                                                                <p class="text-primary font-weight-bold mb-0 mr-2 mb-2">
                                                                    Your
                                                                    Rating</p>
                                                                <div
                                                                    class="form-group mb-6 d-flex justify-content-start">
                                                                    <div class="rate-input">
                                                                        <input type="radio" id="star5" name="rate"
                                                                            value="5">
                                                                        <label for="star5" title="text"
                                                                            class="mb-0 mr-1 lh-1">
                                                                            <i class="fal fa-star"></i>
                                                                        </label>
                                                                        <input type="radio" id="star4" name="rate"
                                                                            value="4">
                                                                        <label for="star4" title="text"
                                                                            class="mb-0 mr-1 lh-1">
                                                                            <i class="fal fa-star"></i>
                                                                        </label>
                                                                        <input type="radio" id="star3" name="rate"
                                                                            value="3">
                                                                        <label for="star3" title="text"
                                                                            class="mb-0 mr-1 lh-1">
                                                                            <i class="fal fa-star"></i>
                                                                        </label>
                                                                        <input type="radio" id="star2" name="rate"
                                                                            value="2">
                                                                        <label for="star2" title="text"
                                                                            class="mb-0 mr-1 lh-1">
                                                                            <i class="fal fa-star"></i>
                                                                        </label>
                                                                        <input type="radio" id="star1" name="rate"
                                                                            value="1">
                                                                        <label for="star1" title="text"
                                                                            class="mb-0 mr-1 lh-1">
                                                                            <i class="fal fa-star"></i>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-6">
                                                                        <input placeholder="Your Name*"
                                                                            class="form-control" type="text"
                                                                            name="name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-6">
                                                                    <div class="form-group mb-6">
                                                                        <input type="email" placeholder="Your Email*"
                                                                            name="email" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-8">
                                                                <textarea class="form-control" placeholder="Your Review"
                                                                    name="message" rows="5"></textarea>
                                                            </div>
                                                            <div class="text-center">
                                                                <button type="submit" class="btn btn-primary">submit now
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-11 pb-lg-15">
            <div class="container container-xxl">
                <h2 class="fs-md-40 fs-30 mb-9 text-center">May You Like This</h2>
                <div class="slick-slider"
                    data-slick-options='{"slidesToShow": 4, "autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>
                    
                    
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

<?php
include('include/footer.php');
}else{
echo "not found";
}
?>