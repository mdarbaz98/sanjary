<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
?>
<?php if (!empty (INR_SESSION['admin_is_login'])){ ?>
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid product_page">
				<!--     start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between">
							<div>
								<h4 class="mb-sm-0 font-size-18">Add Product</h4></div>
							<div class="page-title-right">
								<ol class="breadcrumb m-0">
									<li class="breadcrumb-item"><a href="javascript: void(0);">Blog</a></li>
									<li class="breadcrumb-item active">Add Product</li>
								</ol>
							</div>
						</div>
					</div>
				</div>
				<!-- end page title -->
				<form id="updateProduct">
				<?php 
				INRproduct_id = INR_GET['id'];
                INRstmt= INRconn->prepare("SELECT * FROM `product` WHERE id=?");                               
                INRstmt->execute([INRproduct_id]);
                INRresult = INRstmt->fetchAll(PDO::FETCH_ASSOC);
                foreach(INRresult as INRrow)
                { 
					INRimage_id = INRrow['img_id'];
					INRfront_img = INRrow['front_img'];
					// echo "<pre>";
					// print_r(INRrow);
					// echo "</pre>";

					if(!empty(INRimage_id)){
						INRimage_id=INRimage_id;
						//INRpost_image="https://druggist.b-cdn.net/".INRpost_data_image['path'];
					}else{
						  INRimage_id=1;
					}
					// for image get
					INRselect_stmtPost_img=INRconn->prepare("SELECT * FROM images WHERE id='".INRimage_id."'");
					INRselect_stmtPost_img->execute();
					INRpost_data_image=INRselect_stmtPost_img->fetch(PDO::FETCH_ASSOC);
					if(!empty(INRpost_data_image['path'])){
						INRimage=INRpost_data_image['path'];
						INRalt=INRpost_data_image['alt'];
						}else{
						INRimage="https://i.ibb.co/4fz1F7f/Getty-Images-974371976.jpg";
						}

					
					?>
					<div class="row">
						<div class="card">
							<!-- <div class="header">
								<h4 class="card-title mb-4">Features</h4> </div> -->
							<div class="card-body">
								<div class="d-flex  my-4">
									<div class="form-group mx-3  w-100">
										<label for="Title" class="form-label"> Product Name</label>
										<input type="text" class="form-control " id="pro_name"  name="pro_name" value="<?php echo INRrow['product_name'] ?>" > </div>
									<div class="form-group  w-100">
										<label for="horizontal-firstname-input">Product Slug</label>
										<input type="text" class="form-control" id="slug" name="slug" value="<?php echo INRrow['slug'] ?>"> </div>
									</div>
								<div class="d-flex my-4">
									<div class="form-group ml-3 w-100">
										<label class="form-label"> Select Category </label>
										<?php INRstmt = INRconn->prepare("SELECT * FROM `categories`");
            							INRstmt->execute();
            							INRdata = INRstmt->fetchAll(PDO::FETCH_ASSOC);
        									?>
											<select class="form-control sel_cat" id="category" name="category" title="Please select Category">
												<option value="">Pick a Category... </option>
												<?php foreach (INRdata as INRdata) {
            									?>
													<option value="<?php echo INRdata['cat_slug']; ?>" <?php if (INRdata['cat_slug']==INRrow['category']) echo ' selected="selected"'; ?> >
														          <?php echo INRdata['cat_name']; ?>
													</option>
													<?php } ?>
											</select>
									</div>
									<div class="form-group mx-3 w-100">
												<label>Color</label>
												<input type="text" class="form-control" id="color" name="color" value="<?php echo INRrow['product_color'] ?>">
											</div>
									
								</div>
								
								<div class="d-flex mt-4">
								
							<div class="form-group  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Description</label>
										<textarea class="form-control" id="" name="discription" cols="15" rows="5"><?php echo INRrow['description'] ?></textarea>
							  		</div>
									<div class="form-group w-100 m-5">
									<div class="blog-img-box mt-5" data-toggle="modal" data-target="#exampleModal"> <img src="https://spruko.com/demo/sash/sash/assets/plugins/fancyuploder/fancy_upload.png" alt="feature click image">
										<h5>Set Feature Image</h5></div>
										<input type="hidden" class="image_id" name="img_id" /> </div>
										<div class="float-right">
											<div class="set_images text-center"> <img src="" alt="" class="image_path"> </div>
										</div>
									
									</div>

									<?php
										        if(!empty(INRimage_id)){ ?>
										       <div class="row">
										        <?php
										        INRimage=INRconn->prepare("SELECT * FROM `images` WHERE id in(INRimage_id)");                               
                                                INRimage->execute();
                                                while(INRctaimage_data = INRimage->fetch(PDO::FETCH_ASSOC)){
                                                if (INRctaimage_data['id']==INRfront_img){
                                                                INRctastatus = "checked";
                                                            } else {
                                                                INRctastatus = "";
                                                            }
                                                            
                                                ?>
                                               <div class="col-sm-4 edit_ctaClass">
                                               <input type="radio" <?php echo INRctastatus ?> value="<?php echo INRctaimage_data['id'] ?>" name="front_img" id="<?php echo INRctaimage_data['id'] ?>" data-cta_id="<?php echo INRctaimage_data['id'] ?>" class="form-check-input">
                                                <label for="<?php echo INRctaimage_data['id']; ?>">
                                                 <img src="<?php echo INRctaimage_data['path']; ?>" alt="" class="image_path">
										        </label>
										        </div>
										       <?php } ?>
										       </div>
										       <?php } ?>

							</div>

									<div class="row" id="forAppend">
									<div class="col-sm-3">
											<div class="form-group">
											<label>Size</label>
												<input type="text" class="form-control" id="size" name="size[]" placeholder="Enter Size">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
											<label>Price</label>
												<input type="text" class="form-control" id="price" name="price[]" placeholder="Enter Price">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="form-group">
												<label for="Title" class="form-label">Discount Price</label>
												<input type="text" class="form-control " id="d_price" name="d_price[]" placeholder="Enter Discount Price">
											</div>
										</div>
										<div class="col-sm-3">
											<div class="submit-btn">
												<input type="button" class="post-btn" value="Add More" onclick="appendProductsize()">
                                            </div>
										</div>
									</div>



									<table id="datatable" class="table table-bordered">
											<thead>
												<tr role="row">
													<th>Sr No</th>
													<th>Size</th>
													<th>Price</th>
													<th>Discount Price</th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													 		INRsql = "SELECT * FROM `product_price` WHERE product_id='INRproduct_id';								";
															INRstmt = INRconn->prepare(INRsql);
															INRstmt->execute();
															INRi=1;
															INRdata = INRstmt->fetchAll(PDO::FETCH_ASSOC);
															if (!empty(INRdata)) {
															foreach (INRdata as INRdata)
															{ INRprice_id = INRdata['id']; ?>
													<tr class="odd">
														<td class="sorting_1 dtr-control" tabindex="0">
															<?php echo INRi; ?>
														</td>
														
														<td><?php echo INRdata['size'] ?>
														</td>
														<td>
															<?php echo INRdata['price'] ?>
														</td>
														<td>
														<?php echo INRdata['d_price'] ?>
														</td>
														<td><a href="javascript:void(0)" onclick="productPriceupdate(<?php echo INRprice_id ?>)" class="btn btn-success"><i class="fas fa-edit"></i></td>                                   
                                 						<td><a class="btn btn-danger" href="javascript:void(0)" onclick="deleteProductprice(<?php echo INRprice_id ?>)"><i class="fas fa-trash-alt"></i></a></td>
													</tr>
													<?php INRi++; } }?>
											</tbody>
										</table>





						
									
				<div class="submit-btns clearfix d-flex">       
				<input type="hidden" name="old_img_id" value="<?php echo INRimage_id ?>">    
				<input type="hidden" name="old_front_img" value="<?php echo INRfront_img ?>">    
				<input type="hidden" name="product_id" value="<?php echo INRrow['id'] ?>">
                <input type="hidden" name="btn" value="updateProduct">
                <input type="submit" class="post-btn float-left ml-4" name="blog_publish" value="Publish">
                <!-- <button class="discard-btn" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i>Discard</button> -->
                </div>
				
     
							</div>
						</div>
					</div>
					<!-- end card body -->
					<?php } ?>
				</form>
			</div>
			<!-- end card -->
		</div>
		<!-- end col -->
	</div>
	<!-- end row -->
	</div>
	<!-- container-fluid -->
	</div>
	<!-- End Page-content -->
	<script>
	function blog_img_pathUrl(input) {
		INR('#blog-img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
	}
	</script>
	<?php
    include('include/footer.php');
						}else{
	echo "<script>window.location='https://admin.sanjaryfurniture.com'</script>";
	}
 ?>