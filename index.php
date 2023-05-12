<?php
    ini_set('display_errors', 1);
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $page="category";
    $seoTitle = "Category";
    $seoDescription = "Druggist is a platform where people can find various solutions to dealing with situations that could make one anxious.";
    $canonical = $actual_link;
    $ogtype = "article";
    $ogtitle = $seoTitle;
    $ogdescription = "Druggist is a platform where people can find various solutions to dealing with situations that could make one anxious.";
    $ogcurrenturl = $actual_link;


include('include/header.php'); ?>
  <main id="content">
        <section class="overflow-hidden">
            <div class="slick-slider custom-slider-02 dots-white"
                data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":false,"dots":true,"arrows":false}'>

                <div class="box">
                    <div class="d-flex flex-column justify-content-center bg-img-cover-center vh-100 custom-height-sm"
                        style="background-image: url('images/bg-home-02.jpg')">
                        <div class="d-flex flex-column h-100 justify-content-center">
                            <div class="container container-xxl">
                                <p class="text-white font-weight-bold fs-20 mb-4" data-animate="fadeInUp">Modern Design
                                </p>
                                <h1 class="mb-6 fs-60 fs-xxl-100 lh-1 text-white" data-animate="fadeInUp">Sweet Home
                                </h1>
                                <a href="#" class="btn btn-white text-uppercase letter-spacing-05"
                                    data-animate="fadeInUp">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box">
                    <div class="d-flex flex-column justify-content-center bg-img-cover-center vh-100 custom-height-sm"
                        style="background-image: url('images/bg-home-02.jpg')">
                        <div class="d-flex flex-column h-100 justify-content-center">
                            <div class="container container-xxl">
                                <p class="text-white font-weight-bold fs-20 mb-4" data-animate="fadeInUp">Modern Design
                                </p>
                                <h2 class="mb-6 fs-60 fs-xxl-100 lh-1 text-white" data-animate="fadeInUp">Sweet Home
                                </h2>
                                <a href="#" class="btn btn-white text-uppercase letter-spacing-05"
                                    data-animate="fadeInUp">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="d-flex flex-column justify-content-center bg-img-cover-center vh-100 custom-height-sm"
                        style="background-image: url('images/bg-home-02.jpg')">
                        <div class="d-flex flex-column h-100 justify-content-center">
                            <div class="container container-xxl">
                                <p class="text-white font-weight-bold fs-20 mb-4" data-animate="fadeInUp">Modern Design
                                </p>
                                <h2 class="mb-6 fs-60 fs-xxl-100 lh-1 text-white" data-animate="fadeInUp">Sweet Home
                                </h2>
                                <a href="#" class="btn btn-white text-uppercase letter-spacing-05"
                                    data-animate="fadeInUp">Shop
                                    Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-12 py-lg-15">
            <div class="container">
                <div class="mxw-110px mx-auto mb-8" data-animate="fadeInUp">
                    <img src="images/Sanjari-Logo-300X200-Brown.png" alt="Logo circle">
                </div>
                <div class="mxw-924 mx-auto" data-animate="fadeInUp">
                    <h2 class="fs-30 fs-md-40 lh-14 mb-5 text-center">Having a place set aside for an activity you
                        love makes it more likely you’ll do it.</h2>
                    <p class="mb-6 fs-14 letter-spacing-05 text-uppercase text-primary text-center font-weight-bold">our
                        products</p>
                    <div class="text-center">
                        <a href="#section-next"
                            class="go-down d-inline-flex align-items-center justify-content-center w-50px h-50px rounded-circle border"><i
                                class="far fa-arrow-down"></i></a>
                    </div>
                </div>
            </div>
        </section>
        <?php
                 $category=$conn->prepare("SELECT * FROM categories WHERE parent_cat=0 order by id desc");
                 $category->execute();
                 $i=0;
                    while ($cat_row = $category->fetch(PDO::FETCH_ASSOC)){
                        ?>
        <section id="section-next" class="pb-11 pb-lg-15">
            <div class="container container-xxl">
                <h1 class="text-center pb-5"><?php echo $cat_row['cat_name'] ?></h1>
                <div class="row mb-6 overflow-hidden">
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
                <div class="arraydata"></div>
                <div class="col-sm-6 col-lg-3 mb-6" data-animate="fadeInUp">
                        
                        <div class="card border-0 hover-change-content home__Page product">
                            <div style="background-image: url('sanjar-admin/<?php echo $image ?>')" class="card-img ratio bg-img-cover-center ratio-1-1">
                        </div>
                        
                            <div class="card-img-overlay d-flex py-4 py-sm-5 pl-6 pr-4">
                            

                            </a>
                                <div class="ml-auto d-flex flex-column">
                                    <div class="my-auto content-change-vertical">
                                        <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Add to card" onclick="addTocart(this)" data-proid="<?php echo $row['id']; ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $row['title'] ?>" data-category=<?php echo $product_cat_data['cat_name']; ?> data-price="<?php echo $row['prc'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>"
                                            class="add-to-cart d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
                                            <i class="far fa-shopping-basket"></i>
                                        </a>
                                        <a href="javascript:void(0)" onclick="addTowishlist(this)" data-proid="<?php echo $row['id']; ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $row['title'] ?>" data-category=<?php echo $product_cat_data['cat_name']; ?> data-price="<?php echo $row['prc'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>" data-toggle="tooltip" data-placement="left" title="Add to favourite" 
                                            class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
                                            <i class="far fa-heart"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Add to compare"
                                            class="add-to-compare d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
                                            <i class="far fa-random"></i>
                                        </a>
                                        <a href="#" data-toggle="tooltip" data-placement="left" title="Preview"
                                            class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
                                            <i class="far fa-eye"></i>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card__body d-flex flex-column">
                                    <a href="<?php echo $row['slug'] ?>" class="font-weight-bold mb-1 d-block lh-12"><?php echo $row['title']; ?></a>
                                    <a href="<?php echo $row['slug'] ?>" class="text-uppercase text-muted letter-spacing-05 fs-13 font-weight-500"><?php echo $product_cat_data['cat_name']; ?></a>
                                    <p class="mt-auto text-primary mb-0 font-weight-500">
                                    <?php echo number_format($row['prc'],2); ?></p>
                                </div>
                        </div>
                    </div>
                
            <?php } } ?>

                </div>
                <div class="text-center">
                    <a href="category/<?php echo $cat_row['cat_slug'] ?>" class="btn btn-outline-primary text-uppercase letter-spacing-05">Shop
                        Now</a>
                </div>
            </div>
        </section>
<?php } ?>

        <section class="pb-10 pb-lg-15 overflow-hidden">
            <div class="container container-xxl">
                <div class="row align-items-center no-gutters">
                    <div class="col-lg-3 mb-6 mb-lg-0 pr-xxl-8" data-animate="fadeInLeft">
                        <h2 class="fs-30 fs-md-56 mb-5">Shop By<br>
                            Category</h2>
                        <p class="mb-0 font-weight-500">Having a place set aside for an activity you love makes it more
                            likely you’ll do it.</p>
                        <div class="pt-8 pt-lg-11 d-flex custom-arrow">
                            <a href="#" class="arrow slick-prev"><i class="far fa-arrow-left"></i></a>
                            <a href="#" class="arrow slick-next"><i class="far fa-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="category-slider pl-xxl-9 pr-lg-6" data-animate="fadeInRight">
                        <div class="slick-slider custom-nav custom-slider-01"
                            data-slick-options='{"slidesToShow": 2,"infinite":true,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 1200,"settings": {"slidesToShow":2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>
                            <?php
                        $category=$conn->prepare("SELECT * FROM categories WHERE parent_cat=0 order by id desc");
                        $category->execute();
                        $i=0;
                    while ($cat_row = $category->fetch(PDO::FETCH_ASSOC)){
                        $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
						$stmt_img->execute([$cat_row['img_id']]);
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
                                <div class="card border-0">
                                    <a href="category/<?php echo $cat_row['cat_slug'] ?>">
                                    <img src="sanjar-admin/<?php echo $image ?>" alt="Chairs" class="card-img">
                                    <div class="card-img-overlay d-inline-flex flex-column px-7 pt-6 pb-7">
                                        <h3 class="card-title fs-20 fs-md-40"><?php echo $cat_row['cat_name'] ?></h3>
                                        <div class="mt-auto">
                                            <a href="category/<?php echo $cat_row['cat_slug'] ?>"
                                                class="text-uppercase fs-14 letter-spacing-05 border-bottom border-light-dark border-hover-primary font-weight-bold">Shop
                                                Now</a>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                    <?php } ?>    


                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-12 pb-lg-15 pt-2">
            <div class="container">
                <h2 class="fs-30 fs-md-40 mb-10 text-center">Happy Clients</h2>
                <div class="slick-slider custom-arrow-1"
                    data-slick-options='{"slidesToShow": 3,"infinite":true,"autoplay":false,"dots":false,"arrows":true,"responsive":[{"breakpoint": 1200,"settings": {"slidesToShow":2,"arrows":false,"dots":true}},{"breakpoint": 576,"settings": {"slidesToShow": 1,"arrows":false,"dots":true}}]}'>
                    <div class="box">
                        <div class="card border-0">
                            <div class="card-body px-3 py-0 text-center">
                                <div class="mxw-84px mb-6 mx-auto">
                                    <img src="images/tes_01.png" alt="Sampson Totton">
                                </div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                </ul>
                                <p class="card-text mb-4 font-weight-500">
                                    “These are beautiful, well made & comfortable! I bought them to wear to work &
                                    casually. I wore them immediately walking in the city & has no problem. “
                                </p>
                                <p class="card-text text-primary font-weight-bold mb-1 fs-15">Sampson Totton</p>
                                <p class="card-text text-muted fs-13 text-uppercase letter-spacing-05 font-weight-500">
                                    Golden Clock</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="card border-0">
                            <div class="card-body px-3 py-0 text-center">
                                <div class="mxw-84px mb-6 mx-auto">
                                    <img src="images/tes_02.png" alt="Alfie Wood">
                                </div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                </ul>
                                <p class="card-text mb-4 font-weight-500">
                                    “ Clothers are addicting! Love this brand and shoe. The arch support is wonderful
                                    and helps for long hours on your body. The narrow heel is wonderfully ! “
                                </p>
                                <p class="card-text text-primary font-weight-bold mb-1 fs-15">Alfie Wood</p>
                                <p class="card-text text-muted fs-13 text-uppercase letter-spacing-05 font-weight-500">
                                    Piper Bar</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="card border-0">
                            <div class="card-body px-3 py-0 text-center">
                                <div class="mxw-84px mb-6 mx-auto">
                                    <img src="images/tes_03.png" alt="Herse Hedman">
                                </div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                </ul>
                                <p class="card-text mb-4 font-weight-500">
                                    “Super class, cute, comfortable. You can wear them with just about anything.I will
                                    never sacrifice for style.”“
                                </p>
                                <p class="card-text text-primary font-weight-bold mb-1 fs-15">Herse Hedman</p>
                                <p class="card-text text-muted fs-13 text-uppercase letter-spacing-05 font-weight-500">
                                    Potato Chair</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="card border-0">
                            <div class="card-body px-3 py-0 text-center">
                                <div class="mxw-84px mb-6 mx-auto">
                                    <img src="images/tes_01.png" alt="Herse Hedman">
                                </div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                </ul>
                                <p class="card-text mb-4 font-weight-500">
                                    “Super class, cute, comfortable. You can wear them with just about anything.I will
                                    never sacrifice for style.”“
                                </p>
                                <p class="card-text text-primary font-weight-bold mb-1 fs-15">Herse Hedman</p>
                                <p class="card-text text-muted fs-13 text-uppercase letter-spacing-05 font-weight-500">
                                    Potato Chair</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="card border-0">
                            <div class="card-body px-3 py-0 text-center">
                                <div class="mxw-84px mb-6 mx-auto">
                                    <img src="images/tes_02.png" alt="Herse Hedman">
                                </div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                </ul>
                                <p class="card-text mb-4 font-weight-500">
                                    “Super class, cute, comfortable. You can wear them with just about anything.I will
                                    never sacrifice for style.”“
                                </p>
                                <p class="card-text text-primary font-weight-bold mb-1 fs-15">Herse Hedman</p>
                                <p class="card-text text-muted fs-13 text-uppercase letter-spacing-05 font-weight-500">
                                    Potato Chair</p>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="card border-0">
                            <div class="card-body px-3 py-0 text-center">
                                <div class="mxw-84px mb-6 mx-auto">
                                    <img src="images/tes_03.png" alt="Herse Hedman">
                                </div>
                                <ul class="list-inline mb-4">
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                    <li class="list-inline-item fs-14 text-primary mr-0"><i class="fas fa-star"></i>
                                    </li>
                                </ul>
                                <p class="card-text mb-4 font-weight-500">
                                    “Super class, cute, comfortable. You can wear them with just about anything.I will
                                    never sacrifice for style.”“
                                </p>
                                <p class="card-text text-primary font-weight-bold mb-1 fs-15">Herse Hedman</p>
                                <p class="card-text text-muted fs-13 text-uppercase letter-spacing-05 font-weight-500">
                                    Potato Chair</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <section class="py-8 border-bottom">
            <div class="container container-xxl">
                <div class="slick-slider"
                    data-slick-options='{"slidesToShow": 7,"infinite":true,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 1367,"settings": {"slidesToShow":5}},{"breakpoint": 992,"settings": {"slidesToShow":5}},{"breakpoint": 768,"settings": {"slidesToShow": 4}},{"breakpoint": 576,"settings": {"slidesToShow": 2}}]}'>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_01.png" alt="Client Logo 01"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_02.png" alt="Client Logo 02"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_03.png" alt="Client Logo 03"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_04.png" alt="Client Logo 04"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_05.png" alt="Client Logo 05"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_06.png" alt="Client Logo 06"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_07.png" alt="Client Logo 07"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_08.png" alt="Client Logo 08"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_09.png" alt="Client Logo 09"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                    <div class="box">
                        <a href="#" class="d-block px-3 px-xl-7">
                            <img src="images/client_logo_10.png" alt="Client Logo 10"
                                class="opacity-5 opacity-hover-10">
                        </a>
                    </div>
                </div>
            </div>
        </section>
        
    </main>
<?php
include('include/footer.php')
?>