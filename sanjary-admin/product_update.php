<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
?>
<?php if (!empty ($_SESSION['admin_is_login'])){ ?>
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
				$product_id = $_GET['id'];
                $stmt= $conn->prepare("SELECT * FROM `product` WHERE id=?");                               
                $stmt->execute([$product_id]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                { 
					$image_id = $row['img_id'];
					$front_img = $row['front_img'];
					// echo "<pre>";
					// print_r($row);
					// echo "</pre>";

					if(!empty($image_id)){
						$image_id=$image_id;
						//$post_image="https://druggist.b-cdn.net/".$post_data_image['path'];
					}else{
						  $image_id=1;
					}
					// for image get
					$select_stmtPost_img=$conn->prepare("SELECT * FROM images WHERE id='".$image_id."'");
					$select_stmtPost_img->execute();
					$post_data_image=$select_stmtPost_img->fetch(PDO::FETCH_ASSOC);
					if(!empty($post_data_image['path'])){
						$image=$post_data_image['path'];
						$alt=$post_data_image['alt'];
						}else{
						$image="https://i.ibb.co/4fz1F7f/Getty-Images-974371976.jpg";
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
										<input type="text" class="form-control " id="pro_name"  name="pro_name" value="<?php echo $row['product_name'] ?>" > </div>
									<div class="form-group  w-100">
										<label for="horizontal-firstname-input">Product Slug</label>
										<input type="text" class="form-control" id="slug" name="slug" value="<?php echo $row['slug'] ?>"> </div>
									</div>
								<div class="d-flex my-4">
									<div class="form-group ml-3 w-100">
										<label class="form-label"> Select Category </label>
										<?php $stmt = $conn->prepare("SELECT * FROM `categories`");
            							$stmt->execute();
            							$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        									?>
											<select class="form-control sel_cat" id="category" name="category" title="Please select Category">
												<option value="">Pick a Category... </option>
												<?php foreach ($data as $data) {
            									?>
													<option value="<?php echo $data['cat_slug']; ?>" <?php if ($data['cat_slug']==$row['category']) echo ' selected="selected"'; ?> >
														          <?php echo $data['cat_name']; ?>
													</option>
													<?php } ?>
											</select>
									</div>
									<div class="form-group mx-3 w-100">
												<label>Color</label>
												<input type="text" class="form-control" id="color" name="color" value="<?php echo $row['product_color'] ?>">
											</div>
									
								</div>
								
								<div class="d-flex mt-4">
								
							<div class="form-group  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Description</label>
										<textarea class="form-control" id="" name="discription" cols="15" rows="5"><?php echo $row['description'] ?></textarea>
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
										        if(!empty($image_id)){ ?>
										       <div class="row">
										        <?php
										        $image=$conn->prepare("SELECT * FROM `images` WHERE id in($image_id)");                               
                                                $image->execute();
                                                while($ctaimage_data = $image->fetch(PDO::FETCH_ASSOC)){
                                                if ($ctaimage_data['id']==$front_img){
                                                                $ctastatus = "checked";
                                                            } else {
                                                                $ctastatus = "";
                                                            }
                                                            
                                                ?>
                                               <div class="col-sm-4 edit_ctaClass">
                                               <input type="radio" <?php echo $ctastatus ?> value="<?php echo $ctaimage_data['id'] ?>" name="front_img" id="<?php echo $ctaimage_data['id'] ?>" data-cta_id="<?php echo $ctaimage_data['id'] ?>" class="form-check-input">
                                                <label for="<?php echo $ctaimage_data['id']; ?>">
                                                 <img src="<?php echo $ctaimage_data['path']; ?>" alt="" class="image_path">
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
												</tr>
											</thead>
											<tbody>
												<?php
													 		$sql = "SELECT * FROM `product_price` WHERE product_id='$product_id';								";
															$stmt = $conn->prepare($sql);
															$stmt->execute();
															$i=1;
															$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
															if (!empty($data)) {
															foreach ($data as $data)
															{?>
													<tr class="odd">
														<td class="sorting_1 dtr-control" tabindex="0">
															<?php echo $i; ?>
														</td>
														
														<td><?php echo $data['size'] ?>
														</td>
														<td>
															<?php echo $data['price'] ?>
														</td>
														<td>
														<?php echo $data['d_price'] ?>
														</td>
													</tr>
													<?php $i++; } }?>
											</tbody>
										</table>





						
									
				<div class="submit-btns clearfix d-flex">       
				<input type="hidden" name="old_img_id" value="<?php echo $image_id ?>">    
				<input type="hidden" name="old_front_img" value="<?php echo $front_img ?>">    
				<input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
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
		$('#blog-img_url')[0].src = (window.URL ? URL : webkitURL).createObjectURL(input.files[0]);
	}
	</script>
	<?php
    include('include/footer.php');
						}else{
	echo "<script>window.location='http://localhost/admin/index.php'</script>";
	}
 ?>