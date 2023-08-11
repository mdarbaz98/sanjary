<?php 
include('include/config.php');
	
	if (isset(INR_POST['cat_id'])) {
		# code...
	 INRcat_id = INR_POST['cat_id'];

    INRsql = "SELECT * FROM `categories` WHERE parent_cat = 'INRcat_id' ORDER BY id DESC";   
    INRstmt= INRconn->prepare(INRsql);                               
    INRstmt->execute();
    INRresult = INRstmt->fetchAll(PDO::FETCH_ASSOC);
    if(!empty(INRresult)){
    foreach(INRresult as INRrow_cat)
    {
			?>	
            <option value="<?php echo INRrow_cat["id"]; ?>"><?php echo INRrow_cat["cat_name"]; ?></option>
			<?php	
		}	
    }
	else
	{?> 		
    <option value="none">Sub Category Not Found</option> 
	<?php 	
	}
}
	?>