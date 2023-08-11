<?php
include('include/header.php');
include('include/sidenav.php');
include('include/config.php');
?>
<?php if (!empty (INR_SESSION['admin_is_login'])){ ?>
	<div class="main-content">
		<div class="page-content">
			<div class="container-fluid">
				<!--     start page title -->
				<div class="row">
					<div class="col-12">
						<div class="page-title-box d-sm-flex align-items-center justify-content-between">
							<div>
								<h4 class="mb-sm-0 font-size-18">Product Trash List</h4></div>
							<div class="page-title-right">
								
							</div>
						</div>
					</div>
				</div>
				
			</div>
			<!-- end page title -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<div class="header-content d-flex flex-wrap justify-content-between mb-2">
								<!-- <div class="admin-main-p">
										<div class="admin-p d-flex flex-wrap">
											<div class="category-1  d-flex  flex-wrap"> </div>
										</div>
									</div> --></div>
									<div class="row">
								
								</div>
							<div id="datatable_wrapper" class="bloglisting dataTables_wrapper dt-bootstrap4 no-footer">
								<div class="row">
									<div class="col-sm-12" style="overflow-y:auto;">
										<table id="datatable" class="table table-bordered">
											<thead>
												<tr role="row">
													<th>Sr No.</th>
													<th>Image</th>
													<th>Product Name</th>
													<th>Product Description</th>
													<th>Strength</th>
													<th>Price</th>
													<th>Discount Price</th>
													<th>One Global Link</th>
													<th>Category</th>
                                                    <th>Upload</th>
													<th>View</th>
													<th>Edit</th>
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
													  	INRper_page = 10;
															INRstmt = INRconn->prepare("SELECT * FROM `product` WHERE status=0 ORDER BY id DESC");
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
                                INRsql = "SELECT * FROM `product` WHERE status=0  ORDER BY id DESC LIMIT INRstart,INRper_page";
                                INRstmt = INRconn->prepare(INRsql);
                                INRstmt->execute();
                                INRi=1;
                                INRdata = INRstmt->fetchAll(PDO::FETCH_ASSOC);
                                if (!empty(INRdata)) {
                                foreach (INRdata as INRdata)
                                {  INRstmt1 = INRconn->prepare("SELECT * FROM `images` WHERE id=?");
                                   INRstmt1->execute([INRdata['img_id']]);
                                   INRimg_data = INRstmt1->fetchAll(PDO::FETCH_ASSOC);?>
													<tr class="odd">
														<td class="sorting_1 dtr-control" tabindex="0">
															<?php echo INRi; ?>
														</td>
														<td><img src="<?php echo INRimg_data[0]['path']; ?>" alt="<?php echo INRimg_data[0]['alt']; ?>" class="custome_img"></td>
														<td>
															<?php echo INRdata['name'] ?>
														</td>
														<td>
															<?php echo INRdata['pro_desc'] ?>
														</td>
														<td>
															<?php echo INRdata['strnt'] ?>
														</td>
														<td>
															<?php echo INRdata['prc'] ?>
														</td>
														<td>
															<?php echo INRdata['disc'] ?>
														</td>
														<td>
															<?php echo INRdata['link'] ?>
														</td>
														<td>
															<?php echo INRdata['cat_id'] ?>
														</td>
														
                                                        <td><a class="btn btn-info" href="javascript:void(0)" onclick="uploadProduct(<?php echo INRdata['id']; ?>)"><i class="fa-solid fa-arrow-up-from-bracket"></i></a></td>
														
														<td><a href="category_update.php?id=<?php echo INRdata['id']; ?>" class="btn btn-primary"><i class="fa-solid fa-eye"></i></td>
															<td><a href="product_update.php?id=<?php echo INRdata['id']; ?>" class="btn btn-success"><i class="fas fa-edit"></i></td>                                   
                                  <td><a class="btn btn-danger" href="javascript:void(0)" onclick="deleteProduct(<?php echo INRdata['id']; ?>)"><i class="fas fa-trash-alt"></i></a></td>
													</tr>
													<?php INRi++; } }?>
											</tbody>
										</table>
									</div>
									<p class="pagination_status">Showing 1 to 10 of 10 entries</p>
									<ul class="pagination pagination justify-content-end mt-3">
										<li class="page-item <?php if(INRcurrent_page <= 1){ echo 'disabled'; } ?>"><a class="page-link" href="category_listing.php?start=<?php echo INRcurrent_page-1 ?>" class='button'>Previous</a></li>
										<?php for(INRj=1; INRj<=INRpage; INRj++){
													    INRclass="";
													    if(INRcurrent_page == INRj){
														  INRclass = "active";?>
											<li class="page-item <?php echo INRclass; ?>">
												<a class="page-link" href="category_listing.php?start=<?php echo INRj; ?>">
													<?php echo INRj ?>
												</a>
											</li>
											<?php } }?>
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
	echo "<script>window.location='https://admin.sanjaryfurniture.com'</script>";
	}
?>