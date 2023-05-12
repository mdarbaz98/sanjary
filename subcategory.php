<?php
include('include/db.php');
ini_set('display_errors', 1);
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if(isset($_GET['subcat'])){
    $category = $_GET['subcat'];
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
<section class="py-8 page-title border-top mt-1">
<div class="container">
<h1 class="fs-40 mb-1 text-capitalize text-center"><?php echo $cat_name ?></h1>
</div>
</section>
<section>
<div class="container container-xxl">
<div class="d-flex mb-7">
<div class="d-flex align-items-center text-primary font-weight-500" data-canvas="true" data-canvas-options='{"container":".filter-canvas"}'>
<button type="button" class="border-0 pl-0 pr-2 fs-12 bg-transparent">
<i class="far fa-align-left"></i>
</button>
Filter
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
<div class="row mb-7 overflow-hidden">
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


<div class="col-sm-6 col-lg-3 mb-6" data-animate="fadeInUp">
<div class="card border-0 hover-change-content product">
<div style="background-image: url('sanjar-admin/<?php echo $image ?>')" class="card-img ratio bg-img-cover-center ratio-1-1"></div>
<div class="card-img-overlay d-flex py-4 py-sm-5 pl-6 pr-4">
<div class="d-flex flex-column">
<a href="<?php echo $row['slug'] ?>" class="font-weight-bold mb-1 d-block lh-12"><?php echo $row['title']; ?></a>
<a href="<?php echo $product_cat_data['cat_slug'] ?>" class="text-uppercase text-muted letter-spacing-05 fs-12 font-weight-500"><?php echo $product_cat_data['cat_name'] ?></a>
<p class="mt-auto text-primary mb-0 font-weight-500">
<?php echo number_format($row['prc'],2); ?></p>
</div>
<div class="ml-auto d-flex flex-column">
<div class="my-auto content-change-vertical">
<a href="javascript:void(0)" data-toggle="tooltip" onclick="addTocart(this)" data-proid="<?php echo $row['id']; ?>" data-proimg="<?php echo $image ?>" data-name="<?php echo $row['title'] ?>" data-category=<?php echo $product_cat_data['cat_name']; ?> data-price="<?php echo $row['prc'] ?>" data-qty="<?php echo 1 ?>" data-userid="<?php echo $_COOKIE[$cookie_name]; ?>" data-placement="left" title="Add to card" class="add-to-cart d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
<i class="far fa-shopping-basket"></i>
</a>
<a href="#" data-toggle="tooltip" data-placement="left" title="Add to favourite" class="add-to-wishlist d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
<i class="far fa-heart"></i>
</a>
<a href="#" data-toggle="tooltip" data-placement="left" title="Add to compare" class="add-to-compare d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
<i class="far fa-random"></i>
</a>
<a href="#" data-toggle="tooltip" data-placement="left" title="Preview" class="preview d-flex align-items-center justify-content-center text-primary bg-white hover-white bg-hover-primary w-45px h-45px rounded-circle mb-2 border">
<i class="far fa-eye"></i>
</a>
</div>
</div>
</div>
</div>
</div>

<?php }
 }
 ?>
</div>

<nav class="pb-11 pb-lg-14 overflow-hidden">
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
</section>
</main>
<?php include('include/footer.php') ?>