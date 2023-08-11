<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');

?><?php if (!empty (INR_SESSION['admin_is_login'])){ ?>   
<!--
 <div class="card-body">

<form id="add_category" name="add_category" method="post">
<div class="mb-3">
   <input type="text" class="form-control" id="cat" name="cat"
	placeholder="Enter Category Name..." onkeyup="copytext_cat()">

   </div>
   <div class="mb-3">
   <input type="text" class="form-control" id="sub_cat" name ="sub_cat" id="horizontal-firstname-input"
	   placeholder="Enter Sub Category">
	</div>
	<div class="mb-3"> 
   <input type="text" class="form-control" id="cat_slug" name ="cat_slug" id="horizontal-email-input"
	   placeholder="Category Slug">
   </div>
   <div class="submit-btns">
   <input type="submit" class="post-btn" name="category_add" value="Add"> 
   </div>

   </form>        
   </div>-->
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<!-- start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between">
							<h4 class="mb-sm-0">Categories<span style="color:black;margin-left:10px">Listing</span></h4>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-body">
								<div class="header-content d-flex flex-wrap">
									<div class="admin-main-p">
										<div class="admin-p d-flex flex-wrap">
											<div class="category-1  d-flex  flex-wrap">
												<p class="author-n">Search category</p>
												
											</div>
										</div>
									</div>
									<div class="header-input d-flex flex-wrap">
										<div class="header-btn">
											<a href="add_cat.php" class="search-b">Add Category<span>
                                              <i class="fas fa-plus"></i>
                                            </span> </a>
										</div>
									</div>
								</div>
								<div id="datatable_wrapper" class="bloglisting dataTables_wrapper dt-bootstrap4 no-footer">
									<div class="row">
										<div class="col-sm-12" style="overflow-y:auto;">
											<table id="datatable" class="table table-bordered dt-responsive nowrap w-100 dataTable no-footer dtr-inline" role="grid" aria-describedby="datatable_info" style="width: 1292px;">
												<thead>
													<tr role="row">
                                                        
														<th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 206.5px;" aria-sort="ascending" aria-label="Name: activate to sort column descending">Sr No</th>
														<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 307.5px;" aria-label="Position: activate to sort column ascending">Image</th>
														<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 307.5px;" aria-label="Position: activate to sort column ascending">Category</th>
														<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 151.5px;" aria-label="Office: activate to sort column ascending">Edit</th>
														<th class="sorting" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" style="width: 93.5px;" aria-label="Age: activate to sort column ascending">Delete</th>
													</tr>
												</thead>
												<tbody>
												<?php

															INRper_page = 10;
															INRstmt = INRconn->prepare("SELECT * FROM `categories` ORDER BY id DESC");
															INRstmt->execute();
															INRnumber_of_rows = INRstmt->fetchColumn();
															INRpage = ceil(INRnumber_of_rows/INRper_page);
															INRstart=0;	
															INRcurrent_page=1;
															if(isset(INR_GET['start'])){
																INRstart= INR_GET['start'];
																INRcurrent_page=INRstart;	
																INRstart--;
																INRstart = INRstart*INRper_page;
															}
								


									INRsql = "SELECT * FROM `categories` ORDER BY id DESC LIMIT INRstart,INRper_page";
									INRstmt = INRconn->prepare(INRsql);
                                    INRstmt->execute();
									//  INRnumber_of_rows = INRstmt->fetchColumn(); 



									INRi=1;
                                    INRdata = INRstmt->fetchAll(PDO::FETCH_ASSOC);
                                   
                                    ?> 
                                      <?php if (!empty(INRdata)) {
                                           foreach (INRdata as INRdata)
                                           {

											if(!empty(INRdata['img_id'])){
												INRimage_id=INRdata['img_id'];
												//INRpost_image="https://druggist.b-cdn.net/".INRpost_data_image['path'];
											}else{
												  INRimage_id=1;
											}
											// for image get
											INRselect_stmtPost_img=INRconn->prepare("SELECT * FROM images WHERE id='".INRimage_id."'");
											INRselect_stmtPost_img->execute();
											INRpost_data_image=INRselect_stmtPost_img->fetch(PDO::FETCH_ASSOC);
											if(!empty(INRpost_data_image['path'])){
												INRcta_image=INRpost_data_image['path'];
												INRcta_alt=INRpost_data_image['alt'];
												}else{
												INRcta_image="https://i.ibb.co/4fz1F7f/Getty-Images-974371976.jpg";
												}

                                    ?>   
													<tr class="odd">
													<td class="sorting_1 dtr-control" tabindex="0"><?php echo INRi; ?></td>
														<td><img src="<?php echo INRcta_image ?>" alt="<?php echo INRcta_alt ?>" style="width:60px;"></td>
														<td><?php echo INRdata['cat_name'] ?></td>
														<td>
															<a href="categoryUpdate.php?id=<?php echo INRdata['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i>
														</td>
														
														<td>
														<a class="btn btn-danger" href="javascript:void(0)" onclick="deleteCategory(<?php echo INRdata['id']; ?>)">
														<i class="fas fa-trash-alt"></i></a>	
														</td>
													</tr>
									<?php
                                        INRi++;
                                        }
								
									}
									 ?>				
												</tbody>
											</table>
										</div>

										<p class="pagination_status">Showing 1 to 10 of 10 entries</p>
										<ul class="pagination pagination justify-content-end mt-3">
										<li class="page-item <?php if(INRcurrent_page <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="category_listing.php?start=<?php echo INRcurrent_page-1 ?>" class='button'>Previous</a></li>
											<?php 
													for(INRj=1; INRj<=INRpage; INRj++){
													INRclass="";
													if(INRcurrent_page == INRj){
														INRclass = "active";
												?>
													<li class="page-item <?php echo INRclass; ?>">
													<a class="page-link" href="category_listing.php?start=<?php echo INRj; ?>">
														<?php echo INRj ?>
													</a>
												</li>			
														<?php
														}
														?>

												<?php } ?>
												<li class="page-item <?php if(INRcurrent_page >= INRpage) { echo 'disabled'; } ?>"><a class="page-link" href="category_listing.php?start=<?php echo INRcurrent_page+1 ?>" class='button'>NEXT</a></li>
										</ul>
									
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end col -->
				</div>
			</div>
			<!-- end row -->
		</div>
		<!-- container-fluid -->
	</div>
	<?php
include('include/footer.php');
    }else{
         echo "<script>window.location='https://practicalanxietysolutions.com/admin/index.php'</script>";
        }
?>