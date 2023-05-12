<?php include('db.php');
$cookie_name="userid";
if(!isset($_COOKIE[$cookie_name])) {
    $userid = uniqid();
    setcookie($cookie_name, $userid, time() + (86400 * 30), "/"); // 86400 = 1 day
    echo "<script>location.reload()</script>";
}else{
    setcookie($cookie_name, $_COOKIE[$cookie_name], time() + (86400 * 30), "/"); // 86400 = 1 day
}
?>
<!doctype html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
<base href="http://localhost/sanjary/">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Furniture Shop Html Template">
    <meta name="author" content="">
    <meta name="generator" content="Jekyll">
    <title>Furnitor</title>
    <script src="../cdn-cgi/apps/head/2oc_RD5SS6wgN5SiQnSEnWVNHg8.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="vendors/fontawesome-pro-5/css/all.css">
    <link rel="stylesheet" href="vendors/bootstrap-select/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="vendors/slick/slick.min.css">
    <link rel="stylesheet" href="vendors/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.min.css">
    <link rel="stylesheet" href="vendors/animate.css">
    <link rel="stylesheet" href="vendors/mapbox-gl/mapbox-gl.min.css">

    <link rel="stylesheet" href="css/themes.css">
    <link rel="stylesheet" href="css/style.css">

    <link rel="icon" href="images/favicon.html">

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:creator" content="@">
    <meta name="twitter:title" content="Home 02">
    <meta name="twitter:description" content="Furniture Shop Html Template">
    <meta name="twitter:image" content="images/logo_01.png">

    <meta property="og:url" content="home-02.html">
    <meta property="og:title" content="Home 02">
    <meta property="og:description" content="Furniture Shop Html Template">
    <meta property="og:type" content="website">
    <meta property="og:image" content="images/logo_01.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <style>
        .error{
            col-3or:red;
        }
    </style>
</head>

<body>
    <header class="main-header navbar-dark header-sticky header-sticky-smart position-absolute fixed-top">
        <div class="sticky-area">
            <div class="container container-xxl">
                <div class="d-none d-xl-block">
                    <nav class="navbar navbar-expand-xl px-0 py-2 py-xl-0 row no-gutters">
                        <div class="col-3-xl-3"><a class="navbar-brand mr-0" href="">
                                <img src="images/Sanjari-Logo-300X200.png" alt="Furnitor" class="normal-logo">
                                <img src="images/Sanjari-Logo-300X200-Brown.png" alt="Furnitor" class="sticky-logo">
                            </a></div>
                        <div class="mx-auto col-3-xl-6 d-flex justify-content-center position-static">
                            <ul class="navbar-nav hover-menu main-menu px-0 mx-xl-n4">
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-5 px-0 px-xl-4">
                                    <a class="nav-link dropdown-toggle p-0" href="store.html" data-toggle="dropdown">
                                        Chair
                                        <span class="caret"></span>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 py-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl">
                                            <div class="row no-gutters w-100">

                                            <?php
                                            $product_cat=$conn->prepare("SELECT * FROM categories where parent_cat=?");
                                            $product_cat->execute([7]);
                                            while($product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC)){

                                            
                                            // for image
                                            $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                            $stmt_img->execute([$product_cat_data['img_id']]);
                                            $img_data = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
                                            if (!empty($img_data)) {
                                                $cat_image = $img_data[0]['path']; 
                                                $cat_alt = $img_data[0]['alt'];
                                            }else{
                                                $image="Not Found";
                                                $alt="Not Found";
                                            }
                                            ?>
                                                <div class="col-3" style="border: 1px solid #ddd;">
                                                <a href="chair/<?php echo $product_cat_data['cat_slug'] ?>">
                                                <div class=" d-flex align-items-center">
                                                <img src="sanjar-admin/<?php echo $cat_image ?>" alt="" class="image_category">
                                                <p class="text-center"><?php echo $product_cat_data['cat_name'] ?></p>
                                                </div>
                                                </a>
                                        </div>

                                            <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-5 px-0 px-xl-4">
                                    <a class="nav-link dropdown-toggle p-0" href="store.html" data-toggle="dropdown">
                                        Sofa
                                        <span class="caret"></span>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 py-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl">
                                            <div class="row no-gutters w-100">
                                                
                                            <?php
                                            $product_cat=$conn->prepare("SELECT * FROM categories where parent_cat=?");
                                            $product_cat->execute([6]);
                                            while($product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC)){

                                            
                                            // for image
                                            $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                            $stmt_img->execute([$product_cat_data['img_id']]);
                                            $img_data = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
                                            if (!empty($img_data)) {
                                                $cat_image = $img_data[0]['path']; 
                                                $cat_alt = $img_data[0]['alt'];
                                            }else{
                                                $image="Not Found";
                                                $alt="Not Found";
                                            }
                                            ?>
                                                <div class="col-3" style="border: 1px solid #ddd;">
                                                <a href="sofa/<?php echo $product_cat_data['cat_slug'] ?>">
                                                <div class=" d-flex align-items-center">
                                                    <img src="sanjar-admin/<?php echo $cat_image ?>" alt="" class="image_category">
                                                    <p class="text-center"><?php echo $product_cat_data['cat_name'] ?></p>    
                                                </div>
                                            </a>    
                                        </div>

                                            <?php } ?>
                                            <div class="col-3" style="border: 1px solid #ddd;">
                                            <a href="category/sofa">    
                                                <div class=" d-flex align-items-center">
                                                <img src="sanjar-admin/uploads/Fabric Sofa Cum Beds.webp" alt="" class="image_category">
                                                <p class="text-center">View All Sofa</p>    
                                                </div>
                                            </a>
                                        </div>


                                                
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-5 px-0 px-xl-4">
                                    <a class="nav-link dropdown-toggle p-0" href="store.html" data-toggle="dropdown">
                                        Bedroom
                                        <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-xl px-0 py-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl">
                                            <div class="row no-gutters w-100">
                                            <?php
                                            $product_cat=$conn->prepare("SELECT * FROM categories where parent_cat=?");
                                            $product_cat->execute([4]);
                                            while($product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC)){

                                            
                                            // for image
                                            $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                            $stmt_img->execute([$product_cat_data['img_id']]);
                                            $img_data = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
                                            if (!empty($img_data)) {
                                                $cat_image = $img_data[0]['path']; 
                                                $cat_alt = $img_data[0]['alt'];
                                            }else{
                                                $image="Not Found";
                                                $alt="Not Found";
                                            }
                                            ?>
                                                <div class="col-3" style="border: 1px solid #ddd;">
                                                <a href="bedroom/<?php echo $product_cat_data['cat_slug'] ?>">
                                                <div class="d-flex align-items-center">
                                                <img src="sanjar-admin/<?php echo $cat_image ?>" alt="" class="image_category">
                                                <p class="text-center"><?php echo $product_cat_data['cat_name'] ?></p>    
                                                </div>
                                                </a>
                                        </div>

                                            <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li aria-haspopup="true" aria-expanded="false"
                                    class="nav-item dropdown-item-shop dropdown py-2 py-xl-5 px-0 px-xl-4">
                                    <a class="nav-link dropdown-toggle p-0" href="store.html" data-toggle="dropdown">
                                        Dining
                                        <span class="caret"></span>
                                    </a>
                                    <div
                                        class="dropdown-menu dropdown-menu-xl px-0 py-5 dropdown-menu-listing overflow-hidden x-animated x-fadeInUp">
                                        <div class="container container-xxl">
                                            <div class="row no-gutters w-100">
                                            <?php
                                            $product_cat=$conn->prepare("SELECT * FROM categories where parent_cat=?");
                                            $product_cat->execute([5]);
                                            while($product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC)){

                                            
                                            // for image
                                            $stmt_img = $conn->prepare("SELECT * FROM `images` WHERE status=1 AND id=?");
                                            $stmt_img->execute([$product_cat_data['img_id']]);
                                            $img_data = $stmt_img->fetchAll(PDO::FETCH_ASSOC);
                                            if (!empty($img_data)) {
                                                $cat_image = $img_data[0]['path']; 
                                                $cat_alt = $img_data[0]['alt'];
                                            }else{
                                                $image="Not Found";
                                                $alt="Not Found";
                                            }
                                            ?>
                                                <div class="col-3">
                                                <a href="dining/<?php echo $product_cat_data['cat_slug'] ?>">
                                                <div class="c-card m-3 d-flex align-items-center">
                                                <img src="sanjar-admin/<?php echo $cat_image ?>" alt="" class="image_category">
                                                <p class="text-center"><?php echo $product_cat_data['cat_name'] ?></p>    
                                                </div>
                                                </a>
                                        </div>

                                            <?php } ?>

                                            </div>
                                        </div>
                                    </div>
                                </li>

                                                            </ul>
                        </div>
                        <div class="col-3-xl-3 position-relative">
                            <div class="d-flex align-items-center justify-content-end">
                                <a href="#search-popup" data-gtf-mfp="true"
                                    data-mfp-options='{"type":"inline","focus": "#keyword","mainClass": "mfp-search-form mfp-move-from-top mfp-align-top"}'
                                    class="nav-search d-block py-0 pr-2" title="Search"><i
                                        class="far fa-search"></i></a>
                                <ul
                                    class="navbar-nav flex-row justify-content-xl-end d-flex flex-wrap text-body py-0 navbar-right">
                                    <li class="nav-item">
                                        <a class="nav-link pr-3 py-0" href="#">
                                            <i class="far fa-user-alt"></i>
                                        </a>
                                    </li>
                                    <?php 
                                    $product_wish = $conn->prepare("SELECT count(*) FROM `wishlist` where userid=?");
                                    $product_wish->execute([$_COOKIE[$cookie_name]]);
                                    $product_wish_count = $product_wish->fetchColumn();
                                    ?>
                                    <li class="nav-item">
                                        <a class="nav-link position-relative px-3 py-0" href="wishlist.php"><i class="far fa-heart"></i>
                                            <span class="position-absolute number"><?php echo $product_wish_count ?></span></a>
                                    </li>
                                    <?php 
                                    $product = $conn->prepare("SELECT count(*) FROM `cart` where userid=?");
                                    $product->execute([$_COOKIE[$cookie_name]]);
                                    $product_row = $product->fetchColumn();
                                    ?>

                                    <li class="nav-item">
                                        <a class="nav-link position-relative px-3 menu-cart py-0" href="javascript:void(0)"
                                            data-canvas="true" data-canvas-options='{"container":".cart-canvas"}'>
                                            <i class="far fa-shopping-basket"></i>
                                            <span class="position-absolute number" id="total_product_count"><?php echo $product_row ?></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="d-block d-xl-none">
                    <nav class="navbar navbar-expand-xl px-0 py-2 py-xl-0 w-100 align-items-center">
                        <button class="navbar-toggler border-0 px-0 canvas-toggle" type="button" data-canvas="true"
                            data-canvas-options='{"width":"250px","container":".sidenav"}'>
                            <span class="fs-24 toggle-icon"></span>
                        </button>
                        <a class="navbar-brand d-inline-block mx-auto" href="index.html">
                            <img src="images/logo-white.png" alt="Furnitor" class="normal-logo">
                            <img src="images/logo.png" alt="Furnitor" class="sticky-logo">
                        </a>
                        <a href="#search-popup" data-gtf-mfp="true"
                            data-mfp-options='{"type":"inline","focus": "#keyword","mainClass": "mfp-search-form mfp-move-from-top mfp-align-top"}'
                            class="nav-search d-block py-0" title="Search"><i class="far fa-search"></i></a>
                    </nav>
                </div>
            </div>
        </div>
    </header>