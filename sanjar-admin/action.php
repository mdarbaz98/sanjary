<?php include('include/config.php');
session_start();
date_default_timezone_set('Asia/Kolkata');
if($_POST['btn']=='loginUser'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE username=? AND password=?");
    $stmt->execute([$username, $password]);
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $id= $user_data[0]['id'];
    $userCount=$stmt->rowCount();
    if($userCount > 0){
        echo "login";
        $_SESSION['admin_is_login'] = $username;
        $_SESSION['admin_is_login_id'] = $id;
    }
  }
if($_POST['btn']=='image_update'){
  $id = $_POST['img_id'];
  $alt = $_POST['alt'];
  $title = $_POST['title'];
  $stmt = $conn->prepare("UPDATE images SET alt=?, title=? WHERE id=?");
  if($stmt->execute([$alt, $title, $id])){
    echo "updated";
  }
}

if($_POST['btn']=='addCategory'){
  $cat_name = $_POST['cat_name'];
  $cat_parent = $_POST['parent_cat'];
  $title = $_POST['cat_title'];
  $slug = $_POST['cat_slug'];
  $desc = $_POST['cat_description'];
  $img_id = $_POST['img_id'];
  $stmt = $conn->prepare("INSERT INTO categories(img_id, parent_cat, cat_name, cat_slug, cat_desc, cat_title, status) VALUES(?,?,?,?,?,?,?)");
  if($stmt->execute([$img_id, $cat_parent, $cat_name, $slug, $desc, $title, 1])){
    echo "inserted";
  }
}
if($_POST['btn']=='updateCategory'){
  $cat_id = $_POST['cat_id'];
  $cat_name = $_POST['cat_name'];
  $cat_parent = $_POST['parent_cat'];
  $title = $_POST['cat_title'];
  $slug = $_POST['cat_slug'];
  $desc = $_POST['cat_description'];
  if(empty($_POST['img_id'])){
    $img_id = $_POST['old_img_id'];
  }else{
    $img_id = $_POST['img_id'];
  }
  $stmt = $conn->prepare("UPDATE categories SET img_id=?, parent_cat=?, cat_name=?, cat_slug=?, cat_desc=?, cat_title=? WHERE id=?");
  if($stmt->execute([$img_id, $cat_parent, $cat_name, $slug, $desc, $title, $cat_id])){
    echo "updated";
  }

}
if($_POST['btn']=='deleteCategory_id'){
    $update = $conn->prepare('DELETE FROM categories WHERE id=?');
    $update->execute([$_POST['deleteCategory_id']]);
    echo 'deleted';
    }

//product
if($_POST['btn']=='addProduct'){
    $name="";
    if(isset($_POST['pro_name'])){
        $name=$_POST['pro_name'];
    }else{
        $name="";
    }
    $prc = $_POST['prc'];
    $disc = $_POST['disc'];
    $slug = $_POST['slug'];
    $cat = $_POST['category'];
    $subcat = $_POST['subcategory'];
    $description = $_POST['description']; 
    $img_id = $_POST['img_id'];
    $PostDate = date("Y-m-d H:i");
    $stmt = $conn->prepare("INSERT INTO product(img_id, title, prc, disc_prc, slug, cat_id, subcat_id, description, PostDate, status) VALUES(?,?,?,?,?,?,?,?,?,?)");
    if($stmt->execute([$img_id, $name, $prc, $disc, $slug, $cat, $subcat, $description, $PostDate, 1])){
      echo "inserted";
    }
  }

  if($_POST['btn']=='updateProduct'){
    $product_id=$_POST['product_id'];
    $name = $_POST['pro_name'];
    $d_prc = $_POST['desc'];
    $prc = $_POST['prc'];
    $disc = $_POST['discription'];
    $slug = $_POST['slug'];
    $cat = $_POST['category'];
    $subcat = $_POST['subcategory'];   
    if(empty($_POST['front_img'])){
        $front_img = 1;
    }else{
        $front_img = $_POST['front_img'];
    }
    if(empty($_POST['img_id'])){
        $img_id = $_POST['old_img_id'];
    }else{
        $img_id = $_POST['img_id'];
    }
    $stmt = $conn->prepare("UPDATE product SET img_id=?, front_img=?, title=?, prc=?, disc_prc=?, slug=?, cat_id=?, subcat_id=?, description=? WHERE id=?");
    if($stmt->execute([$img_id, $front_img, $name, $prc, $d_prc, $slug, $cat, $subcat, $disc, $product_id])){
      echo "updated";
    }
  }
//   upload product
if($_POST['btn']=='uploadProduct_id'){
    $update = $conn->prepare('UPDATE product SET status=1 WHERE id=?');
    $update->execute([$_POST['uploadProduct_id']]);
    echo 'uploaded';
    }
  // Trash product
  if($_POST['btn']=='trashProduct_id'){
    $update = $conn->prepare('UPDATE product SET status=0 WHERE id=?');
    $update->execute([$_POST['trashProduct_id']]);
    echo 'trashed';
    }

    // Permanent delete product
    if($_POST['btn']=='deleteProduct_id'){
        $update = $conn->prepare('DELETE FROM product WHERE id=?');
        $update->execute([$_POST['deleteProduct_id']]);
        echo 'deleted';
        }
//   product ends here
//user
if($_POST['btn']=='addUser'){
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];  
    $img_id = $_POST['img_id'];
    $stmt = $conn->prepare("INSERT INTO user(img_id, name ,username,password,status) VALUES(?,?,?,?,?)");
    if($stmt->execute([$img_id, $name, $username,  $pwd,1])){
      echo "inserted";
    }
  }
//   UPDATE
  if($_POST['btn']=='updateUser'){
    $user_id=$_POST['user_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];  
    $img_id = $_POST['img_id'];
    $stmt = $conn->prepare("UPDATE user SET img_id=?, name=?, username=?, password=?, status=? WHERE id=?");
    if($stmt->execute([$img_id, $name, $username,  $pwd, 1, $user_id])){
      echo "updated";
    }
  }


//   DELETE
  if($_POST['btn']=='deleteUser_id'){
    $update = $conn->prepare('DELETE FROM user WHERE id=?');
    $update->execute([$_POST['deleteUser_id']]);
    echo 'deleted';
    }
//   user ends here


 // post start here
// delete post
if($_POST['btn']=='deletePost_id'){
    $update = $conn->prepare('DELETE FROM post WHERE id=?');
    $update->execute([$_POST['deletePost_id']]);
    echo 'deleted';
    }
 //   upload post
if($_POST['btn']=='uploadPost_id'){
    $update = $conn->prepare('UPDATE post SET status=1 WHERE id=?');
    $update->execute([$_POST['uploadPost_id']]);
    echo 'uploaded';
    }

   
// trash post
if($_POST['btn']=='trashPost_id'){
    $update = $conn->prepare('UPDATE post SET status=0 WHERE id=?');
    $update->execute([$_POST['trashPost_id']]);
    echo 'trashed';
    }

    
    if($_POST['btn']=="addPost"){
        $title="";
        if(isset($_POST['title'])){
            $title = trim_data($_POST['title']);
        }
        else{
            $title="";
        }
        $seo_title="";
        if(isset($_POST['seo_title'])){
            $seo_title = trim_data($_POST['seo_title']);
        }
        else{
            $seo_title="";
        }
        $slug="";
        if(isset($_POST['slug'])){
            $slug = strtolower(str_replace(" ","-",$_POST['slug']));
        }
        else{
            $slug="";
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        else{
            $meta_desc="";
        }
        $content="";
        if(isset($_POST['content'])){
            $content = trim_data($_POST['content']);
        }else{
            $content="";
        }
        if(isset($_POST['bot_robot'])){
            $bot_robot = ($_POST['bot_robot']);
        }
        $bot_robot_value="";
        if(!empty($bot_robot)){
            $bot_robot_value  = implode(", ",$bot_robot);            
        }
        else{
            $bot_robot_value = "0";
        }
        if(isset($_POST['max_snippet'])){
            $max_snippet = $_POST['max_snippet'];
        }
        else{
             $max_snippet = "max-snippet:";
        }
        if(isset($_POST['max_video'])){
        $max_video =($_POST['max_video']);
        }
        else{
            $max_video = "max-video:";
        }

        if(isset($_POST['max_image'])){
        $max_image=$_POST['max_image'];
        }
        else{
            $max_image="max-image:";
        }
            $max_snippet_value =$_POST['max_snippet_value'];   
            $concat_snippet = $max_snippet.$max_snippet_value;
            $max_video_value =$_POST['max_video_value'];
            $concat_video = $max_video.$max_video_value;    
            $max_image_value =$_POST['max_image_value'];
            $concat_image = $max_image.$max_image_value;
            $advance_bot = $bot_robot_value.", ".$concat_snippet.", ".$concat_video.", ".$concat_image;
            
            $img_id=0;
            if(isset($_POST['img_id'])){
                $img_id = $_POST['img_id'];
            }
            else{
                $img_id=0;
            }
            $cat_id="";
            if(isset($_POST['category'])){
                $cat_id = $_POST['category'];
            }
            else{
                $cat_id="";
            }

            $description="";
            if(isset($_POST['description'])){
                $description = trim_data($_POST['description']);
            }
            else{
                $description="";
            }
            $PostDate="";
            if(isset($_POST['PostDate'])){
                $PostDate = date("Y-m-d H:i", strtotime($_POST['PostDate']));
            }
            else{
                $PostDate="";
            }
            $draft=1;
            if(isset($_POST['draft'])){
                $draft = $_POST['draft'];
            }
            else{
                $draft = 1;
            }
                $stmt1 = $conn->prepare("INSERT INTO post(title, seo_title, slug, meta_desc, content, img_id, cat_id, bot_rank, description, uploaded_on, status) 
                VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                if($stmt1->execute([$title, $seo_title, $slug, $meta_desc, $content, $img_id, $cat_id, $advance_bot, $description, $PostDate, $draft]))
                {
                            echo "inserted";
                }
            
    }//add post end

    // trash 

    // update post start
    if($_POST['btn']=="updatePost"){
        $post_id=$_POST['post_id'];
        $title="";
        if(isset($_POST['title'])){
            $title = trim_data($_POST['title']);
        }
        else{
            $title="";
        }
        $seo_title="";
        if(isset($_POST['seo_title'])){
            $seo_title = trim_data($_POST['seo_title']);
        }
        else{
            $seo_title="";
        }
        $slug="";
        if(isset($_POST['slug'])){
            $slug = strtolower(str_replace(" ","-",$_POST['slug']));
        }
        else{
            $slug="";
        }
        $meta_desc="";
        if(isset($_POST['meta_desc'])){
            $meta_desc = trim_data($_POST['meta_desc']);
        }
        else{
            $meta_desc="";
        }
        $content="";
        if(isset($_POST['content'])){
            $content = trim_data($_POST['content']);
        }else{
            $content="";
        }
        if(isset($_POST['bot_robot'])){
            $bot_robot = ($_POST['bot_robot']);
        }
        $bot_robot_value="";
        if(!empty($bot_robot)){
            $bot_robot_value  = implode(", ",$bot_robot);            
        }
        else{
            $bot_robot_value = "0";
        }
        if(isset($_POST['max_snippet'])){
            $max_snippet = $_POST['max_snippet'];
        }
        else{
             $max_snippet = "max-snippet:";
        }
        if(isset($_POST['max_video'])){
        $max_video =($_POST['max_video']);
        }
        else{
            $max_video = "max-video:";
        }
        if(isset($_POST['max_image'])){
        $max_image=$_POST['max_image'];
        }
        else{
            $max_image="max-image:";
        }
            $max_snippet_value =$_POST['max_snippet_value'];   
            $concat_snippet = $max_snippet.$max_snippet_value;
            $max_video_value =$_POST['max_video_value'];
            $concat_video = $max_video.$max_video_value;    
            $max_image_value =$_POST['max_image_value'];
            $concat_image = $max_image.$max_image_value;
            $advance_bot = $bot_robot_value.", ".$concat_snippet.", ".$concat_video.", ".$concat_image;
            $img_id=0;
            if(isset($_POST['img_id'])){
                $img_id = $_POST['img_id'];
            }
            else{
                $img_id=0;
            }
            $cat_id="";
            if(isset($_POST['category'])){
                $cat_id = $_POST['category'];
            }
            else{
                $cat_id="";
            }
            $description="";
            if(isset($_POST['description'])){
                $description = trim_data($_POST['description']);
            }
            else{
                $description="";
            }
            $PostDate="";
            if(isset($_POST['PostDate'])){
                $PostDate = date("Y-m-d H:i", strtotime($_POST['PostDate']));
            }
            else{
                $PostDate="";
            }
            $draft=1;
            if(isset($_POST['draft'])){
                $draft = $_POST['draft'];
            }
            else{
                $draft = 1;
            }

  $stmt = $conn->prepare("UPDATE post SET title=?, seo_title=?, slug=?, meta_desc=?, content=?, img_id=?, cat_id=?, bot_rank=?, description=?, uploaded_on=?, status=? WHERE id=?");
  if($stmt->execute([$title, $seo_title, $slug, $meta_desc, $content, $img_id, $cat_id, $advance_bot, $description, $PostDate, $draft, $post_id])){
    echo "updated";
  }

//   $stmt = $conn->prepare("UPDATE category SET img_id=?, name=?, title=?, slug=?, content=?, description=?, status=? WHERE id=?");
//   if($stmt->execute([$img_id, $cat_name, $title, $slug, $content, $desc, 1, $cat_id])){
//     echo "updated";
//   }

                // $stmt1 = $conn->prepare("INSERT INTO post(title, seo_title, slug, meta_desc, content, img_id, cat_id, bot_rank, description, uploaded_on, status) 
                // VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                // if($stmt1->execute([$title, $seo_title, $slug, $meta_desc, $content, $img_id, $cat_id, $advance_bot, $description, $PostDate, $draft]))
                // {
                //             echo "inserted";
                // }
            
    }//update post end





    function trim_data($text) {
      // $text = trim($data); //<-- LINE 31
       if(is_array($text)) {
           return array_map('trim_data', $text);
       }

       $text = preg_replace("/(\r\n|\n|\r)/", "\n", $text); // cross-platform newlines
       $text = preg_replace("/\n\n\n\n+/", "\n", $text); // take care of duplicates 
      
       $text = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
       $text = stripslashes($text);
      
       $text = str_replace ( "\n", " ", $text );
       $text = str_replace ( "\t", " ", $text );
      
       return $text;
   }
?>