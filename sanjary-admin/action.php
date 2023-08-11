<?php include('include/config.php');
session_start();
session_regenerate_id();
date_default_timezone_set('Asia/Kolkata');
if(INR_POST['btn']=='loginUser'){
    INRusername = trim_data(INR_POST['username']);
    INRpass = trim_data(INR_POST['password']);
    INRstmt = INRconn->prepare("SELECT * FROM `user` WHERE username=?");
    INRstmt->execute([INRusername]);
    INRuserCount=INRstmt->rowCount();
    if(INRuserCount > 0){
      while(INRuser_data = INRstmt->fetch(PDO::FETCH_ASSOC)){
        INRemail = INRuser_data['username'];
        INRpassword = INRuser_data['password'];
        //if (password_verify(INRpass, INRpassword)) {
          INR_SESSION['admin_is_login'] = INRuser_data['username'];
          INR_SESSION['admin_is_login_id'] = INRuser_data['id'];
          INR_SESSION['admin_is_login_id'] = true;
          echo "done";            
        //}

      }
    }
  }
if(INR_POST['btn']=='image_update'){
  INRid = INR_POST['img_id'];
  INRalt = INR_POST['alt'];
  INRtitle = INR_POST['title'];
  INRstmt = INRconn->prepare("UPDATE images SET alt=?, title=? WHERE id=?");
  if(INRstmt->execute([INRalt, INRtitle, INRid])){
    echo "updated";
  }
}

if(INR_POST['btn']=='addCategory'){
  INRcat_name = INR_POST['cat_name'];
  INRtitle = INR_POST['cat_title'];
  INRslug = INR_POST['cat_slug'];
  INRdesc = INR_POST['cat_description'];
  INRimg_id = INR_POST['img_id'];
  INRstmt = INRconn->prepare("INSERT INTO categories(img_id, cat_name, cat_slug, cat_desc, cat_title, status) VALUES(?,?,?,?,?,?)");
  if(INRstmt->execute([INRimg_id, INRcat_name, INRslug, INRdesc, INRtitle, 1])){
    echo "inserted";
  }
}
if(INR_POST['btn']=='updateCategory'){
  INRcat_id = INR_POST['cat_id'];
  INRcat_name = INR_POST['cat_name'];
  INRtitle = INR_POST['cat_title'];
  INRslug = INR_POST['cat_slug'];
  INRdesc = INR_POST['cat_description'];
  if(empty(INR_POST['img_id'])){
    INRimg_id = INR_POST['old_img_id'];
  }else{
    INRimg_id = INR_POST['img_id'];
  }
  INRstmt = INRconn->prepare("UPDATE categories SET img_id=?, cat_name=?, cat_slug=?, cat_desc=?, cat_title=? WHERE id=?");
  if(INRstmt->execute([INRimg_id, INRcat_name, INRslug, INRdesc, INRtitle, INRcat_id])){
    echo "updated";
  }

}
if(INR_POST['btn']=='deleteCategory_id'){
    INRupdate = INRconn->prepare('DELETE FROM categories WHERE id=?');
    INRupdate->execute([INR_POST['deleteCategory_id']]);
    echo 'deleted';
    }

//product
    if(INR_POST['btn']=='addProduct'){
    INRname=INR_POST['pro_name'];
    INRcat = INR_POST['category'];
    INRdescription = INR_POST['description']; 
    INRimg_id = INR_POST['img_id'];
    INRcolor = INR_POST['color'];
    INRPostDate = date("Y-m-d H:i");
    INRslug = strtolower(INRname);
    INRslug = str_replace(' ', '-', INRslug);
    INRslug = preg_replace('/[^A-Za-z0-9\-]/', '', INRslug);
    INRstmt = INRconn->prepare("INSERT INTO product(img_id, product_name, slug, category, description, product_color, PostDate, status) VALUES(?,?,?,?,?,?,?,?)");
    if(INRstmt->execute([INRimg_id, INRname, INRslug, INRcat, INRdescription, INRcolor, INRPostDate, 1])){
                INRlast_pro_id = INRconn->lastInsertId();
                if(!empty(INR_POST['size'][0])){ 
                INRtotal_price = count(INR_POST['size']);
                if(!empty(INRtotal_price)){    
                for(INRi=0;INRi<INRtotal_price;INRi++){ 
                     INRsize = INR_POST['size'][INRi];
                     INRprice =  INR_POST['price'][INRi];
                     INRd_price =  INR_POST['d_price'][INRi];
                     INRproduct_price = INRconn->prepare("INSERT INTO product_price(product_id, size, price, d_price, status) VALUES(?,?,?,?,?)");
                      if(INRproduct_price->execute([INRlast_pro_id, INRsize, INRprice, INRd_price, 1])){
                        
                      }
                }
              }
            }


              echo "inserted".INRlast_pro_id;


    }
  }

  if(INR_POST['btn']=='updateProduct'){
    INRproduct_id=INR_POST['product_id'];
    INRname = INR_POST['pro_name'];
    INRcat = INR_POST['category'];
    INRdesc = INR_POST['discription'];
    INRcolor = INR_POST['color'];
    if(empty(INR_POST['img_id'])){
      INRimg_id = INR_POST['old_img_id'];
    }else{
      INRimg_id = INR_POST['img_id'];
    }
    if(empty(INR_POST['front_img'])){
      INRfront_img = INR_POST['old_front_img'];
    }else{
      INRfront_img = INR_POST['front_img'];
    }

    INRslug = strtolower(INRname);
    INRslug = str_replace(' ', '-', INRslug);
    INRslug = preg_replace('/[^A-Za-z0-9\-]/', '', INRslug);
    INRstmt = INRconn->prepare("UPDATE product SET img_id=?, front_img=?, product_name=?, slug=?, category=?, description=?, product_color=? WHERE id=?");
    if(INRstmt->execute([INRimg_id, INRfront_img, INRname, INRslug, INRcat, INRdesc, INRcolor, INRproduct_id])){
    
      if(!empty(INR_POST['size'][0])){ 
      INRtotal_price = count(INR_POST['size']);
      if(!empty(INRtotal_price)){    
      for(INRi=0;INRi<INRtotal_price;INRi++){ 
           INRsize = INR_POST['size'][INRi];
           INRprice =  INR_POST['price'][INRi];
           INRd_price =  INR_POST['d_price'][INRi];
           INRproduct_price = INRconn->prepare("INSERT INTO product_price(product_id, size, price, d_price, status) VALUES(?,?,?,?,?)");
            if(INRproduct_price->execute([INRproduct_id, INRsize, INRprice, INRd_price, 1])){
              
            }
      }
    }
  }

     
      echo "updated";
    }
  }
//   upload product
if(INR_POST['btn']=='uploadProduct_id'){
    INRupdate = INRconn->prepare('UPDATE product SET status=1 WHERE id=?');
    INRupdate->execute([INR_POST['uploadProduct_id']]);
    echo 'uploaded';
    }

      // Trash product
  if(INR_POST['btn']=='trashProductprice_id'){
    INRupdate = INRconn->prepare('DELETE FROM product_price WHERE id=?');
    INRupdate->execute([INR_POST['trashProductprice_id']]);
    echo 'deleted';
    }
  // Trash product
  if(INR_POST['btn']=='trashProduct_id'){
    INRupdate = INRconn->prepare('DELETE FROM product WHERE id=?');
    INRupdate->execute([INR_POST['trashProduct_id']]);
    echo 'trashed';
    }

    // Permanent delete product
    if(INR_POST['btn']=='deleteProduct_id'){
        INRupdate = INRconn->prepare('DELETE FROM product WHERE id=?');
        INRupdate->execute([INR_POST['deleteProduct_id']]);
        echo 'deleted';
        }
//   product ends here
//user
if(INR_POST['btn']=='addUser'){
    INRname = trim_data(INR_POST['name']);
    INRusername = trim_data(INR_POST['username']);
    INRpwd = trim_data(INR_POST['pwd']);
    INRoptions = ['cost' => 12];  
    INRpassword_hash = password_hash(INRpwd, PASSWORD_DEFAULT, INRoptions);
    INRstmt = INRconn->prepare("INSERT INTO user(name ,username,password,status) VALUES(?,?,?,?)");
    if(INRstmt->execute([INRname, INRusername, INRpassword_hash, 1])){
      echo "inserted";
    }
  }
//   UPDATE
  if(INR_POST['btn']=='updateUser'){
    INRuser_id=INR_POST['user_id'];
    INRname = INR_POST['name'];
    INRusername = INR_POST['username'];
    INRpwd = INR_POST['pwd'];  
    INRstmt = INRconn->prepare("UPDATE user SET name=?, username=?, password=?, status=? WHERE id=?");
    if(INRstmt->execute([INRname, INRusername,  INRpwd, 1, INRuser_id])){
      echo "updated";
    }
  }


//   DELETE
  if(INR_POST['btn']=='deleteUser_id'){
    INRupdate = INRconn->prepare('DELETE FROM user WHERE id=?');
    INRupdate->execute([INR_POST['deleteUser_id']]);
    echo 'deleted';
    }
//   user ends here


 // post start here
// delete post
if(INR_POST['btn']=='delete_pro_id'){
    INRupdate = INRconn->prepare('DELETE FROM images WHERE id=?');
    INRupdate->execute([INR_POST['pro_id']]);
    echo 'deleted';
    }
 //   upload post
if(INR_POST['btn']=='uploadPost_id'){
    INRupdate = INRconn->prepare('UPDATE post SET status=1 WHERE id=?');
    INRupdate->execute([INR_POST['uploadPost_id']]);
    echo 'uploaded';
    }

    if(INR_POST['btn']=="productPriceupdate"){
    

      INRgetAddress=INRconn->prepare("SELECT * FROM product_price WHERE id=?");
      INRgetAddress->execute([INR_POST['productPriceupdate']]);
      while(INRrow=INRgetAddress->fetch(PDO::FETCH_ASSOC)){
          echo json_encode(array(
              "price"=>INRrow['price'],
              "dprice"=>INRrow['d_price'],
              "size"=>INRrow['size'],
              "updateProductprice_id"=>INRrow['id'],
          ));    
      }
  }

  if(INR_POST['btn']=='updateProductprice'){
    INRupdate = INRconn->prepare('UPDATE product_price SET size=?, price=?, d_price=? WHERE id=?');
    INRupdate->execute([INR_POST['size'], INR_POST['price'], INR_POST['dprice'], INR_POST['updateProductprice_id']]);
    echo 'updated';
    }

  
    
   
// trash post
if(INR_POST['btn']=='trashPost_id'){
    INRupdate = INRconn->prepare('UPDATE post SET status=0 WHERE id=?');
    INRupdate->execute([INR_POST['trashPost_id']]);
    echo 'trashed';
    }
    function trim_data(INRtext) {
       INRtext = trim(INRtext); //<-- LINE 31
       if(is_array(INRtext)) {
           return array_map('trim_data', INRtext);
       }

       INRtext = preg_replace("/(\r\n|\n|\r)/", "\n", INRtext); // cross-platform newlines
       INRtext = preg_replace("/\n\n\n\n+/", "\n", INRtext); // take care of duplicates 
      
       INRtext = htmlspecialchars(INRtext, ENT_QUOTES, 'UTF-8');
       INRtext = stripslashes(INRtext);
      
       INRtext = str_replace ( "\n", " ", INRtext );
       INRtext = str_replace ( "\t", " ", INRtext );
      
       return INRtext;
   }
?>