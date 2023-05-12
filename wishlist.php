
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
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </section>
        <section class="pb-11 pb-lg-12 pt-10">
            <div class="container">
                <h2 class="fs-sm-40 mb-11 text-center">Wishlist</h2>
                <div class="row no-gutters">
                    <div class="col-lg-9 mx-auto">
                        <div class="row">
                        <?php
                        $userid = $_COOKIE['userid'];
                 $product=$conn->prepare("SELECT * FROM wishlist WHERE userid=?");
                 $product->execute([$userid]);
                 $i=0;
                 $total_product = $product->rowCount();
                 if ($total_product > 0) {
                    while ($row = $product->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <div class="col-md-4 mb-6">
                                <div class="card border-0 hover-change-content product">
                                    <div class="card-img-top position-relative">
                                        <div style="background-image: url('sanjar-admin/<?php echo $row['pro_img'] ?>')"
                                            class="card-img ratio bg-img-cover-center ratio-1-1">
                                        </div>
                                        <div class="position-absolute pos-fixed-top-right pr-4 pt-4">
                                            <a href="#" data-toggle="tooltip" title="Delete" class="fs-20">
                                                <i class="fal fa-times"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card-body px-0 pt-4 pb-0">
                                        <div class="d-flex align-items-end mb-1">
                                            <a href="product-page-01.html" class="font-weight-bold d-block"><?php echo $row['pro_category'] ?></a>
                                            <p class="text-primary mb-0 ml-auto"><?php echo number_format($row['pro_price'],2); ?></p>
                                        </div>
                                        <p class="fs-15 text-primary d-block mb-4"><?php echo $row['pro_name'] ?></p>
                                        <a href="#" class="btn btn-outline-primary btn-block">add to cart</a>
                                    </div>
                                </div>
                            </div>
                            <?php } }else{
                                echo "There is no product in your wishlist";
                            } ?>
                         

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
include('include/footer.php')
?>