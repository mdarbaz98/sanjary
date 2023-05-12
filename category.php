<?php
include('include/db.php');
ini_set('display_errors', 1);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(isset($_GET['cat'])){
    $category = $_GET['cat'];
    }

    $selectCatId = $conn->prepare('SELECT * FROM categories WHERE cat_slug=?');
    $selectCatId->execute([$category]);
    $countCat = $selectCatId->rowCount();
    if($countCat>0){ 
    while($row=$selectCatId->fetch(PDO::FETCH_ASSOC)){
            $catid = $row['id'];
            $description = $row['cat_desc'];
      }
    }
    $cat_name = str_replace("-"," ",$category);
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
<section class="py-8 page-title border-top">
<div class="container">
<h1 class="fs-40 my-1 text-capitalize text-center"></h1>
</div>
</section>
<div class="pt-6">
<div class="container-fluid">
<div class="slick-slider" data-slick-options='{"slidesToShow": 4, "autoplay":true,"dots":true,"arrows":false,"responsive":[{"breakpoint": 1200,"settings": {"slidesToShow":4}},{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 1}}]}'>

<?php
$product_cat=$conn->prepare("SELECT * FROM categories WHERE parent_cat=?");
$product_cat->execute([0]);
while($product_cat_data = $product_cat->fetch(PDO::FETCH_ASSOC)){
?>
<div class="box" data-animate="fadeInUp">
<div class="card border-0">
<img src="images/c_07.jpg" alt="Chairs" class="card-img">
<div class="card-img-overlay d-inline-flex flex-column px-6 py-4">
<h3 class="card-title fs-30"><?php echo $product_cat_data['cat_name'] ?></h3>
<div class="mt-auto">
<a href="category/<?php echo $product_cat_data['cat_slug'] ?>" class="text-uppercase fs-14 letter-spacing-05 border-bottom border-light-dark border-hover-primary font-weight-bold">Shop
Now</a>
</div>
</div>
</div>
</div>
<?php } ?>




</div>
</div>
</div>
<section class="pt-13 pb-11 pb-lg-14">
<div class="container">
<div class="row overflow-hidden">
<div class="col-md-3 mb-10 mb-md-0 primary-sidebar sidebar-sticky" id="sidebar">
<div class="primary-sidebar-inner">
<div class="card border-0 mb-7">
<div class="card-header bg-transparent border-0 p-0">
<h3 class="card-title fs-20 mb-0">
<?php echo $cat_name ?>
</h3>
</div>
<div class="card-body px-0 pt-4 pb-0">
<ul class="list-unstyled mb-0">
<?php
$product_subcat=$conn->prepare("SELECT * FROM categories WHERE parent_cat=?");
$product_subcat->execute([$catid]);
while($product_subcat_data = $product_subcat->fetch(PDO::FETCH_ASSOC)){
?>
<li class="mb-1">
<a href="javascript:void(0)" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12"><?php echo $product_subcat_data['cat_name'] ?></a>
</li>
<?php } ?>
</ul>
</div>
</div>
<div class="card border-0 mb-7">
<div class="card-header bg-transparent border-0 p-0">
<h3 class="card-title fs-20 mb-0">
Price
</h3>
</div>
<div class="card-body px-0 pt-4 pb-0">
<ul class="list-unstyled mb-0">
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">All
</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$10
- $100</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$100
- $200</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$200
- $300</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">$300
- $400</a>
</li>
</ul>
</div>
</div>
<div class="card border-0 mb-7">
<div class="card-header bg-transparent border-0 p-0">
<h3 class="card-title fs-20 mb-0">
Material
</h3>
</div>
<div class="card-body px-0 pt-4 pb-0">
<ul class="list-unstyled mb-0">
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">
Laminate
</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Acrylic</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Aluminium</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Cotton</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Leather</a>
</li>
<li class="mb-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Metal</a>
</li>
</ul>
</div>
</div>
<div class="card border-0 widget-color mb-7">
<div class="card-header bg-transparent border-0 p-0">
<h3 class="card-title fs-20 mb-0">
Colors
</h3>
</div>
<div class="card-body px-0 pt-4 pb-0">
<ul class="list-inline mb-0">
<li class="list-inline-item">
<a href="#" class="d-block item" style="background-color: #d0a272;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #68412d;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #000000;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #aa5959;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #8db4d2;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #c2c3a0;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #c7857d;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #e3e1e7;"></a>
</li>
<li class="list-inline-item"><a href="#" class="d-block item" style="background-color: #b490b0;"></a>
</li>
</ul>
</div>
</div>
<div class="card border-0">
<div class="card-header bg-transparent border-0 p-0">
<h3 class="card-title fs-20 mb-0">
Tags
</h3>
</div>
<div class="card-body px-0 pt-6 pb-0">
<ul class="list-inline mb-0">
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Vintage</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Awesome</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Summer</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Beachwear</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Sunglasses</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Winter</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Shorts</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Cool</a>
</li>
<li class="list-inline-item mr-2 py-1">
<a href="#" class="text-secondary hover-primary border-bottom border-white border-hover-primary d-inline-block lh-12">Nice</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="col-md-9">
<div class="d-flex mb-6">
<div class="d-flex align-items-center text-primary">
Showing 1-15 of 90 results
</div>
<div class="ml-auto">
<div class="dropdown">
<a href="#" class="dropdown-toggle fs-14" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Default Sorting
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton" style="">
<a class="dropdown-item text-primary fs-14" href="#">Price high to low</a>
<a class="dropdown-item text-primary fs-14" href="#">Price low to high</a>
<a class="dropdown-item text-primary fs-14" href="#">Random</a>
</div>
</div>
</div>
</div>
<div class="row">
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

<div class="col-sm-6 col-lg-4 mb-8" data-animate="fadeInUp">
<div class="card border-0 hover-change-content product">
<div class="card-img-top position-relative">
<div style="background-image: url('sanjar-admin/<?php echo $image ?>')" class="card-img ratio bg-img-cover-center ratio-1-1">
</div>
<div class="position-absolute pos-fixed-bottom px-4 px-sm-6 pb-5 d-flex w-100 justify-content-center content-change-horizontal">
<a href="javascript:void(0)" data-toggle="tooltip" title="Add to cart" onclick="addTocart(this)" data-proid="<?php echo $row['id']; ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $row['title'] ?>" data-category=<?php echo $product_cat_data['cat_name']; ?> data-price="<?php echo $row['prc'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>" data-placement="left" title="Add to card" class="add-to-cart d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border" class="add-to-cart d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mr-2 border">
<i class="far fa-shopping-basket"></i>
</a>
<a href="#" data-toggle="tooltip" title="Add to favourite" class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mr-2 border">
<i class="far fa-heart"></i>
</a>
<a href="#" data-toggle="tooltip" title="Add to compare" class="add-to-compare d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mr-2 border">
<i class="far fa-random"></i>
</a>
<a href="#" data-toggle="tooltip" title="Preview" class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle border">
<i class="far fa-eye"></i>
</a>
</div>
</div>
<div class="card-body px-0 pt-4 pb-0 d-flex align-items-end">
<div class="mr-auto">
<a href="#" class="text-uppercase text-muted letter-spacing-05 fs-12 d-block font-weight-500"><?php echo $product_cat_data['cat_name'] ?></a>
<a href="<?php echo $row['slug'] ?>" class="font-weight-bold mt-1 d-block"><?php echo $row['title']; ?></a>
 </div>
<p class="text-primary mb-0 font-weight-500"><?php echo number_format($row['prc'],2); ?></p>
</div>
</div>
</div>
<?php }
    } ?>
</div>
<nav class="pt-4 overflow-hidden">
<ul class="pagination justify-content-center align-items-center mb-0">
<li class="page-item fs-12 d-none d-sm-block">
<a class="page-link" href="#" tabindex="-1"><i class="far fa-angle-double-left"></i></a>
</li>
<li class="page-item"><a class="page-link" href="#">1</a></li>
<li class="page-item active" aria-current="page"><a class="page-link" href="#">2</a></li>
<li class="page-item"><a class="page-link" href="#">3</a></li>
<li class="page-item"><a class="page-link" href="#">...</a></li>
<li class="page-item"><a class="page-link" href="#">6</a></li>
<li class="page-item fs-12 d-none d-sm-block">
<a class="page-link" href="#"><i class="far fa-angle-double-right"></i></a>
</li>
</ul>
</nav>
</div>
</div>
</div>
</section>
</main>
<?php include('include/footer.php') ?>