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
				<form id="product_form">
				<?php 
                $stmt= $conn->prepare("SELECT * FROM `product` WHERE id=?");                               
                $stmt->execute([$_GET['id']]);
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row)
                { ?>
					<div class="row">
						<div class="card">
							<!-- <div class="header">
								<h4 class="card-title mb-4">Features</h4> </div> -->
							<div class="card-body">
								<div class="d-flex  my-4">
									<div class="form-group mx-3  w-100">
										<label for="Title" class="form-label"> Product Name</label>
										<input type="text" class="form-control " id="pro_name"  name="pro_name" value="<?php echo $row['title'] ?>" > </div>
									<div class="form-group  w-100">
										<label for="horizontal-firstname-input">Product Slug</label>
										<input type="text" class="form-control" id="slug" name="slug" value="<?php echo $row['slug'] ?>"> </div>
									</div>
								<div class="d-flex my-4">
									<div class="form-group  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Price</label>
										<input type="text" class="form-control" id="prc" name="prc" value="<?php echo $row['prc'] ?>">
									</div>
									<div class="form-group  mx-3  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Discount Price</label>
										<input type="text" class="form-control" id="disc" name="desc" value="<?php echo $row['disc_prc'] ?>">
									</div>
								</div>
								<div class="d-flex mt-4">
								<div class="form-group ml-3 w-100">
										<label class="form-label"> Select Category </label>
										<?php $stmt = $conn->prepare("SELECT * FROM `categories` WHERE parent_cat=?");
            							$stmt->execute([0]);
            							$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        									?>
											<select class="form-control sel_cat" id="category" name="category" title="Please select Category">
												<option value="">Pick a Category... </option>
												<?php foreach ($data as $data) {
            									?>
													<option value="<?php echo $data['id']; ?>" <?php if ($data['id']==$row['cat_id']) echo ' selected="selected"'; ?> >
														          <?php echo $data['cat_name']; ?>
													</option>
													<?php } ?>
											</select>
									</div>

									<div class="form-group ml-3 w-100">
										<label class="form-label"> Select Sub Category </label>
											<select class="form-control sel_cat" id="subcategory" name="subcategory" title="Please Select Subcategory">
											<option value="<?php echo $data['id']; ?>" <?php if ($data['id']==$row['subcat_id']) echo ' selected="selected"'; ?> >
												<?php echo $data['cat_name']; ?>
											</option>
										</select>
									</div>
								</div>

								<div class="d-flex mt-4">
								
								<div class="form-group  w-100">
										<label for="horizontal-firstname-input" class="col-form-label">Description</label>
										<textarea class="form-control" id="" name="discription" cols="30" rows="10"><?php echo $row['description'] ?></textarea>
								</div>
									<div class="blog-img-box  w-100 mx-3" data-toggle="modal" data-target="#exampleModal"> <img src="https://spruko.com/demo/sash/sash/assets/plugins/fancyuploder/fancy_upload.png" alt="feature click image">
										<h5>Set Feature Image</h5> </div>
										<input type="hidden" class="image_id" name="img_id" />
									</div>
							<div class="w-50 h-50 float-right">
							<div class="customefeature_image1">
											<?php
														$img_id=1;
														if($row['img_id']){
														$img_id=$row['img_id'];
														}else{
														$img_id=1;
														}
														$sql1 = "SELECT * FROM `images` WHERE status=1 AND id IN ($img_id)";
														$stmt1 = $conn->prepare($sql1);
														$stmt1->execute();
														$img_data = $stmt1->fetchAll(PDO::FETCH_ASSOC);
													?>
												<?php if(!empty($img_data)){
													$i=1;
													foreach ($img_data as $img_val1){ ?>
											<label for="d<?php echo $i ?>">Set As Front</label>
											<input type="radio" id="d<?php echo $i ?>" name="front_img" value="<?php echo $img_val1['id'] ?>" <?php if($row['front_img']==$img_val1['id']){echo "checked";} ?>>


											<!-- <a href="javascript:void(0)" class="text-center text-danger" onclick="setFrontproductimage(<?php echo $img_val1['id'] ?>)">Set As Front</a> -->
												<img src="<?php echo $img_val1['path']; ?>" alt="<?php echo $img_val1['alt'] ?>" class="image_path">
												<div class=" d-flex justify-content-center"><button type="button" id="remove_btn" class="btn btn-danger float-center my-3" onclick="removeproductimage(<?php echo $img_val1['id'] ?>,<?php echo $row['id'] ?>)">Remove Image</button> </div>									
										<?php $i++; } }else{echo "no images"; } ?>
									</div>
									
				<div class="submit-btns clearfix d-flex">           
				<input type="hidden" name="product_id" value="<?php echo $row['id'] ?>">
				<input type="hidden" name="old_img_id" value="<?php echo $row['img_id'] ?>">
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