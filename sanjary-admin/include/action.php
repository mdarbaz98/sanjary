<?php include('../include/db.php');
date_default_timezone_set('Asia/Kolkata');
ini_set('display_errors', 1);

    if(INR_POST['btn']=="addBlog")
        {
             INRcontent="";
            if(isset(INR_POST['content'])){
                INRcontent = trim_data(INR_POST['content']);
            }else{
                INRcontent="";
            }
            INRtitle="";
            if(isset(INR_POST['blog_title'])){
                INRtitle = trim_data(INR_POST['blog_title']);
            }
            else{
                INRtitle="";
            }
            INRseo_title="";
            if(isset(INR_POST['blog_title_seo'])){
                INRseo_title = trim_data(INR_POST['blog_title_seo']);
            }
            else{
                INRseo_title="";
            }
            INRblog_slug="";
            if(isset(INR_POST['blog_slug'])){
                INRblog_slug = strtolower(str_replace(" ","-",INR_POST['blog_slug']));
            }
            else{
                INRblog_slug="";
            }
            INRmeta_desc="";
            if(isset(INR_POST['meta_desc'])){
                INRmeta_desc = trim_data(INR_POST['meta_desc']);
            }
            else{
                INRmeta_desc="";
            }
            INRauthor_name="";
            if(isset(INR_POST['author_name'])) {
                INRauthor_name = (INR_POST['author_name']);
            }
            INRauthor_values="";
            if(!empty(INRauthor_name)){
                INRauthor_values  = implode(",",INRauthor_name);            
            }
            else{
                 INRauthor_values = "0";
            }

            INRreview="";
            if(isset(INR_POST['review'])){
            INRreview = (INR_POST['review']);
            }
                INRreview_value="";
                if(!empty(INRreview)){
                    INRreview_value  = implode(",",INRreview);            
                }
                else{
                    INRreview_value = "0";
                }

            if(isset(INR_POST['bot_robot'])){
                INRbot_robot = (INR_POST['bot_robot']);
            }
            INRbot_robot_value="";
            if(!empty(INRbot_robot)){
                INRbot_robot_value  = implode(", ",INRbot_robot);            
            }
            else{
                INRbot_robot_value = "0";
            }
            if(isset(INR_POST['max_snippet'])){
                INRmax_snippet = INR_POST['max_snippet'];
            }
            else{
                 INRmax_snippet = "max-snippet:";
            }
            if(isset(INR_POST['max_video'])){
            INRmax_video =(INR_POST['max_video']);
            }
            else{
                INRmax_video = "max-video:";
            }

            if(isset(INR_POST['max_image'])){
            INRmax_image=INR_POST['max_image'];
            }
            else{
                INRmax_image="max-image:";
            }
                INRmax_snippet_value =INR_POST['max_snippet_value'];   
                INRconcat_snippet = INRmax_snippet.INRmax_snippet_value;
                INRmax_video_value =INR_POST['max_video_value'];
                INRconcat_video = INRmax_video.INRmax_video_value;    
                INRmax_image_value =INR_POST['max_image_value'];
                INRconcat_image = INRmax_image.INRmax_image_value;

                INRadvance_bot = INRbot_robot_value.", ".INRconcat_snippet.", ".INRconcat_video.", ".INRconcat_image;
                
                INRfocus_key="";
                if(isset(INR_POST['focus_keyword'])){
                    INRfocus_key=trim_data(INR_POST['focus_keyword']);
                }
                else{
                    INRfocus_key="";
                }

                INRcategory="";
                if(isset(INR_POST['category'])){
                    INRcategory = trim_data(INR_POST['category']);
                }
                else{
                    INRcategory="";
                }
                INRsub_category="";
                if(isset(INR_POST['sub_category'])){
                INRsub_category = trim_data(INR_POST['sub_category']);
                }
                INRsub_category_value="";
                if(!empty(INRsub_category)){
                    INRsub_category_value  = implode(",",INRsub_category);            
                }
                else{
                    INRsub_category_value="";
                }

                INRdraft=0;
                if(isset(INR_POST['draft'])){
                    INRdraft = INR_POST['draft'];
                }
                else{
                    INRdraft = 0;
                }
                INRmessage="";
                if(isset(INR_POST['message'])){
                    INRmessage = trim_data(INR_POST['message']);
                }
                else{
                    INRmessage="";
                }
                INRfilename="";
                if(isset(INR_FILES["img"]["name"])){
                    INRfilename = trim_data(INR_FILES["img"]["name"]);
                    INRtempname = INR_FILES["img"]["tmp_name"];
                }
                else{
                    INRfilename="";
                }
                INRimg_alt="";
                if(isset(INR_POST['img_alt'])){
                    INRimg_alt = trim_data(INR_POST['img_alt']);
                }
                else{
                    INRimg_alt="";
                }
                INRimg_title="";
                if(isset(INR_POST['img_title'])){
                    INRimg_title = trim_data(INR_POST['img_title']);
                }
                else{
                    INRimg_title="";
                }
                INRblogPostDate="";
                if(isset(INR_POST['blogPostDate'])){
                    INRblogPostDate = date("Y-m-d H:i", strtotime(INR_POST['blogPostDate']));
                    // INRblogPostDate = trim_data(INR_POST['blogPostDate']);
                }
                else{
                    INRblogPostDate="";
                }
                INRfolder = "../assets/upload/".INRfilename;
                if (move_uploaded_file(INRtempname, INRfolder))
                {
                    //INRmsg = "Image uploaded successfully";
                }
                
                
                
                INRsql ="INSERT INTO `blog`(`blog_id`, `post_author`, `post_review`, `post_content`, `post_title`, `post_name`, `parent_category`, `category`, `description`, `featured_image`, `img_alt`, `img_title`, `title_slug`, `slug_title`, `focus_keyword`, `meta_desc`, `bot_meta_data`, `PostDate`, `status`) 
                    VALUES (0,'INRauthor_values','INRreview_value',?,'INRtitle','INRtitle','INRcategory','INRsub_category_value','INRmessage','INRfilename','INRimg_alt','INRimg_title','INRseo_title','INRblog_slug','INRfocus_key','INRmeta_desc','INRadvance_bot','INRblogPostDate',INRdraft)";

                    INRstmt1 = INRconn->prepare(INRsql);
                    if(INRstmt1->execute([INRcontent]))
                    {
                        INRlast_blog_id = INRconn->lastInsertId();
                        INRsql1 = "UPDATE `blog` SET `blog_id`='INRlast_blog_id' WHERE id='INRlast_blog_id'";
                        INRstmt2 = INRconn->prepare(INRsql1);
                        if(INRstmt2->execute()){
                                echo "inserted";
                                }   
                    }
        }//add blog end
                        
                   

                
            
    // trash blog id
        if(INR_POST['btn']=="blog_id_trash")
        {

            INRblog_id = INR_POST['blog_id_trash'];
            INRsql=INRconn->prepare("UPDATE `blog` SET `status`='1' WHERE `id`=?");            
            INRsql->execute([INRblog_id]);
            echo "Trashed";
           
        }

    // blog permenant delete

        if(INR_POST['btn']=="blogPermenetDelete_id")
        {
            INRblogPermenetDelete = INR_POST['blogPermenetDelete_id'];
            INRsql=INRconn->prepare("DELETE FROM `blog` WHERE `id`=?");            
            INRsql->execute([INRblogPermenetDelete]);
            echo "Deleted";
           
        }

        // blog restore data
        if(INR_POST['btn']=="blog_id_restore")
        {
           INRblog_id_restore = INR_POST['blog_id_restore'];
           INRsql=INRconn->prepare("UPDATE `blog` SET `status`='0' WHERE `id`=?");            
           INRsql->execute([INRblog_id_restore]);
            echo "Restored";
                    
        }

            // blog upload data
            if(INR_POST['btn']=="blogUploadRows_id")
            {
                INRblogUploadRows_id = INR_POST['blogUploadRows_id'];
                INRsql=INRconn->prepare("UPDATE `blog` SET `status`='0' WHERE `id`=?");            
                INRsql->execute([INRblogUploadRows_id]);
                echo "Uploaded";
             
            }
            
        // trash quotes data
        if(INR_POST['btn']=="quotesTrashRows_id")
        {

            INRquotesTrashRows_id = INR_POST['quotesTrashRows_id'];
            INRsql=INRconn->prepare("UPDATE `quotes` SET `status`='1' WHERE `id`=?");            
            INRsql->execute([INRquotesTrashRows_id]);
            echo "Trashed";
         
        }

                // permanent delete quotes data
                if(INR_POST['btn']=="quotesPermenetDelete_id")
                {
        
                    INRquotesPermenetDelete_id = INR_POST['quotesPermenetDelete_id'];
                    INRsql=INRconn->prepare("DELETE FROM `quotes` WHERE `id`=?");            
                    INRsql->execute([INRquotesPermenetDelete_id]);
                    echo "Deleted";
                 
                }

    //page trash here
    
        if(INR_POST['btn']=="page_id_trash")
        {

            INRpage_id = INR_POST['page_id_trash'];
            INRsql=INRconn->prepare("UPDATE `page` SET `status`='1' WHERE `id`=?");            
            INRsql->execute([INRpage_id]);
            echo "Trashed";
           
        }
        
        // page restore data
        if(INR_POST['btn']=="page_id_restore")
        {
           INRpage_id_restore = INR_POST['page_id_restore'];
           INRsql=INRconn->prepare("UPDATE `page` SET `status`='0' WHERE `id`=?");            
           INRsql->execute([INRpage_id_restore]);
            echo "Restored";
                    
        }
        // author trash
        if(INR_POST['btn']=="authorTrashRow_id")
        {

            INRauthor_id = INR_POST['authorTrashRow_id'];
            INRsql=INRconn->prepare("UPDATE `author` SET `status`='1' WHERE `id`=?");            
            INRsql->execute([INRauthor_id]);
            echo "Trashed";
           
        }
        // author restore
        if(INR_POST['btn']=="authorRestoreRows_id")
        {  
           INRauthorRestoreRows_id = INR_POST['authorRestoreRows_id'];
           INRsql=INRconn->prepare("UPDATE `author` SET `status`='0' WHERE `id`=?");            
           INRsql->execute([INRauthorRestoreRows_id]);
           echo "Restored";
        }
        
        if(INR_POST['btn']=="deleteAuthor_id")
        {
        INRdeleteAuthor_id = INR_POST['deleteAuthor_id'];
        INRsql=INRconn->prepare("DELETE FROM `author` WHERE `id`=?");            
        INRsql->execute([INRdeleteAuthor_id]);
        echo "Deleted";
    }
    
            if(INR_POST['btn']=="imageDelete_id")
            {
                INRid = INR_POST['imageDelete_id'];
                INRselectAuthor=INRconn->prepare("SELECT * FROM author WHERE id = 'INRid'");
                INRselectAuthor->execute();
                while(INRrow=INRselectAuthor->fetch(PDO::FETCH_ASSOC)){
                    INRfilename = INRrow['image'];
                    INRpath = '../assets/upload/authorProfile/'.INRfilename;
                    if(file_exists(INRpath)) {
                        unlink(INRpath);
                        INRsql=INRconn->prepare("UPDATE `author` SET `image`='' WHERE `id`=?");            
                        INRsql->execute([INRid]);
                        echo "Updated";
                        } 
                  
                }
        }
        
            if(INR_POST['btn']=="imageblogDelete_id")
            {
                INRid = INR_POST['imageblogDelete_id'];
                INRselectAuthor=INRconn->prepare("SELECT * FROM blog WHERE id = 'INRid'");
                INRselectAuthor->execute();
                while(INRrow=INRselectAuthor->fetch(PDO::FETCH_ASSOC)){
                    INRfilename = INRrow['featured_image'];
                    INRpath = '../assets/upload/'.INRfilename;
                    if(file_exists(INRpath)) {
                        unlink(INRpath);
                        INRsql=INRconn->prepare("UPDATE `blog` SET `featured_image`='' WHERE `id`=?");            
                        INRsql->execute([INRid]);
                        echo "Updated";
                        } 
                  
                }
            }
            
            if(INR_POST['btn']=="imagepageDelete_id")
            {
                INRid = INR_POST['imagepageDelete_id'];
                INRselectAuthor=INRconn->prepare("SELECT * FROM page WHERE id = 'INRid'");
                INRselectAuthor->execute();
                while(INRrow=INRselectAuthor->fetch(PDO::FETCH_ASSOC)){
                    INRfilename = INRrow['featured_image'];
                    INRpath = '../assets/upload/'.INRfilename;
                    if(file_exists(INRpath)) {
                        unlink(INRpath);
                        INRsql=INRconn->prepare("UPDATE `page` SET `featured_image`='' WHERE `id`=?");            
                        INRsql->execute([INRid]);
                        echo "Updated";
                        } 
                  
                }
            }
            if(INR_POST['btn']=="imagequoteDelete_id")
            {
                INRid = INR_POST['imagequoteDelete_id'];
                INRselectAuthor=INRconn->prepare("SELECT * FROM quotes WHERE id = 'INRid'");
                INRselectAuthor->execute();
                while(INRrow=INRselectAuthor->fetch(PDO::FETCH_ASSOC)){
                    INRfilename = INRrow['image'];
                    INRpath = '../assets/upload/quotes/'.INRfilename;
                    if(file_exists(INRpath)) {
                        unlink(INRpath);
                        INRsql=INRconn->prepare("UPDATE `quotes` SET `image`='' WHERE `id`=?");            
                        INRsql->execute([INRid]);
                        echo "Updated";
                        } 
                  
                }
            }
            
        if(INR_POST['btn']=="imagequoteDataDelete_id")
            {
                INRid = INR_POST['imagequoteDataDelete_id'];
                INRselectAuthor=INRconn->prepare("SELECT * FROM quotes_data WHERE id = 'INRid'");
                INRselectAuthor->execute();
                while(INRrow=INRselectAuthor->fetch(PDO::FETCH_ASSOC)){
                    INRfilename = INRrow['author_image'];
                    INRpath = '../assets/upload/quotes/'.INRfilename;
                    if(file_exists(INRpath)) {
                        unlink(INRpath);
                        INRsql=INRconn->prepare("UPDATE `quotes_data` SET `author_image`='' WHERE `id`=?");            
                        INRsql->execute([INRid]);
                        echo "Updated";
                        } 
                  
                }
            }
            
            if(INR_POST['btn']=="commentCheckid")
            {
                        INRstatus = INR_POST['commentVal'];    
                        INRid = INR_POST['commentCheckid'];
                        INRsql=INRconn->prepare("UPDATE `tbl_comment` SET `status`=? WHERE `comment_id`=?");            
                        INRsql->execute([INRstatus, INRid]);
                        echo "updated";
            }
            
            

// Category Delete here 

if(INR_POST['btn']=="deleteCategory_id")
{

    INRdeleteCategory_id = INR_POST['deleteCategory_id'];
    INRsql=INRconn->prepare("DELETE FROM `categories` WHERE `id`=?");            
    INRsql->execute([INRdeleteCategory_id]);
    echo "Deleted";
 
}
// Quotes Category Delete here 

if(INR_POST['btn']=="deletequotesCategory_id")
{

    INRdeletequotesCategory_id = INR_POST['deletequotesCategory_id'];
    INRsql=INRconn->prepare("DELETE FROM `quotescat` WHERE `id`=?");            
    INRsql->execute([INRdeletequotesCategory_id]);
    echo "Deleted";
 
}


        // quotes restore
        if(INR_POST['btn']=="quoteRestoreRows_id")
        {
            INRquoteRestoreRows_id = INR_POST['quoteRestoreRows_id'];
            INRsql=INRconn->prepare("UPDATE `quotes` SET `status`='0' WHERE `id`=?");            
            INRsql->execute([INRquoteRestoreRows_id]);
            echo "Restored";
            
        }
        // quotes upload draft data

        
        if(INR_POST['btn']=="uploadDraftdata_id")
        {
            INRuploadDraftdata_id = INR_POST['uploadDraftdata_id'];
            INRsql=INRconn->prepare("UPDATE `quotes` SET `status`='0' WHERE `id`=?");            
            INRsql->execute([INRuploadDraftdata_id]);
            echo "Uploaded";
        
        }

        
        if(INR_POST['btn']=="addCategory")
    {
        INRcat="";
        if(isset(INR_POST['cat'])){
            INRcat = trim_data(INR_POST['cat']);
        }
        INRcat_slug="";
        if(isset(INR_POST['cat_slug'])){
            INRcat_slug = trim_data(INR_POST['cat_slug']);
        }
        INRcat_desc="";
        if(isset(INR_POST['description'])){
            INRcat_desc = trim_data(INR_POST['description']);
        }
        INRcat_title="";
        if(isset(INR_POST['cat_title'])){
            INRcat_title = trim_data(INR_POST['cat_title']);
        }
        INRmeta_desc="";
        if(isset(INR_POST['meta_desc'])){
            INRmeta_desc = trim_data(INR_POST['meta_desc']);
        }
        
        INRparent_cat="";
        if(isset(INR_POST['parent_cat'])){
            INRparent_cat = INR_POST['parent_cat'];
        }
        // if(INRparent_cat==0){
            
        // }
        
        
         INRsql = "INSERT INTO `categories`
        (`cat_id`, `cat_name`, `cat_slug`, `cat_desc`, `cat_title`, `meta_desc`, `status`)
        VALUES ('0','INRcat','INRcat_slug','INRcat_desc',
        'INRcat_title','INRmeta_desc','INRparent_cat')";

        INRstmt = INRconn->prepare(INRsql);
        if(INRstmt->execute()){

            INRlast_id = INRconn->lastInsertId();
            if(!empty(INRlast_id))
            {
                INRsql = "UPDATE `categories` SET `cat_id`='INRlast_id' WHERE id='INRlast_id'";
                INRstmt = INRconn->prepare(INRsql);
                if(INRstmt->execute()){
                echo "inserted";
            }
        }
    }

  
}
        if(INR_POST['btn']=="updateCategory")
        {
        INRcat_id="";
        if(isset(INR_POST['cat_id'])){
            INRcat_id = INR_POST['cat_id'];
        }
        
        INRcat="";
        if(isset(INR_POST['cat'])){
            INRcat = trim_data(INR_POST['cat']);
        }
        INRcat_slug="";
        if(isset(INR_POST['cat_slug'])){
            INRcat_slug = trim_data(INR_POST['cat_slug']);
        }
        INRcat_desc="";
        if(isset(INR_POST['description'])){
            INRcat_desc = trim_data(INR_POST['description']);
        }
        INRcat_title="";
        if(isset(INR_POST['cat_title'])){
            INRcat_title = trim_data(INR_POST['cat_title']);
        }
        INRmeta_desc="";
        if(isset(INR_POST['meta_desc'])){
            INRmeta_desc = trim_data(INR_POST['meta_desc']);
        }
        
        INRparent_cat="";
        if(isset(INR_POST['parent_cat'])){
            INRparent_cat = INR_POST['parent_cat'];
        }
        
        INRsql = "UPDATE `categories` SET `cat_name`='INRcat',`cat_slug`='INRcat_slug',`cat_desc`='INRcat_desc',`cat_title`='INRcat_title',`meta_desc`='INRmeta_desc',`status`='INRparent_cat' WHERE `id`='INRcat_id'";

        INRstmt = INRconn->prepare(INRsql);
        if(INRstmt->execute()){
        echo "updated";
        }
    
    }



        if(INR_POST['btn']=="addQuotescategory")
    {
        INRcat="";
        if(isset(INR_POST['cat'])){
            INRcat = trim_data(INR_POST['cat']);
        }
        INRcat_slug="";
        if(isset(INR_POST['cat_slug'])){
            INRcat_slug = trim_data(INR_POST['cat_slug']);
        }
        INRcat_desc="";
        if(isset(INR_POST['description'])){
            INRcat_desc = trim_data(INR_POST['description']);
        }
        INRcat_title="";
        if(isset(INR_POST['cat_title'])){
            INRcat_title = trim_data(INR_POST['cat_title']);
        }
        INRmeta_desc="";
        if(isset(INR_POST['meta_desc'])){
            INRmeta_desc = trim_data(INR_POST['meta_desc']);
        }
        
         INRsql = "INSERT INTO `quotescat`(`categoryName`, `slug`, `title`, `meta_desc`, `description`, `status`)
         VALUES('INRcat','INRcat_slug','INRcat_title','INRmeta_desc','INRcat_desc',1)";

        INRstmt = INRconn->prepare(INRsql);
        if(INRstmt->execute()){
        echo "inserted";

        }
    }
        
        if(INR_POST['btn']=="updateQuotescategory")
        {
            INRcat_id="";
            if(isset(INR_POST['cat_id'])){
                INRcat_id = INR_POST['cat_id'];
            }
            INRcat="";
            if(isset(INR_POST['cat'])){
                INRcat = trim_data(INR_POST['cat']);
            }
            INRcat_slug="";
            if(isset(INR_POST['cat_slug'])){
                INRcat_slug = trim_data(INR_POST['cat_slug']);
            }
            INRcat_desc="";
            if(isset(INR_POST['description'])){
                INRcat_desc = trim_data(INR_POST['description']);
            }
            INRcat_title="";
            if(isset(INR_POST['cat_title'])){
                INRcat_title = trim_data(INR_POST['cat_title']);
            }
            INRmeta_desc="";
            if(isset(INR_POST['meta_desc'])){
                INRmeta_desc = trim_data(INR_POST['meta_desc']);
            }
        
        
        
        INRsql = "UPDATE `quotescat` SET `categoryName`='INRcat',`slug`='INRcat_slug',`title`='INRcat_title',`meta_desc`='INRmeta_desc',`description`='INRcat_desc',`status`=1 WHERE `id`='INRcat_id'";
        INRstmt = INRconn->prepare(INRsql);
        if(INRstmt->execute()){
        echo "updated";
        }
    
    }
        
        
        if(INR_POST['btn']=="addQuotes")
        {
            INRtitle="";
            if(isset(INR_POST['quote_title'])){
                INRtitle = trim_data(INR_POST['quote_title']);
            }
            else{
                INRtitle="";
            }
            INRseo_title="";
            if(isset(INR_POST['quote_title_seo'])){
                INRseo_title = trim_data(INR_POST['quote_title_seo']);
            }
            else{
                INRseo_title="";
            }

            INRslug="";
            if(isset(INR_POST['quote_slug'])){
                INRslug = strtolower(str_replace(" ","-",INR_POST['quote_slug']));
            }
            else{
                INRslug="";
            }

            INRmeta_desc="";
            if(isset(INR_POST['meta_desc'])){
                INRmeta_desc = trim_data(INR_POST['meta_desc']);
            }
            else{
                INRmeta_desc="";
            }

            INRcontent="";
            if(isset(INR_POST['content'])){
                INRcontent =INR_POST['content'];
            }
            else{
                 INRcontent="";
            }
           

            if(isset(INR_POST['bot_robot'])){
            INRbot_robot = (INR_POST['bot_robot']);
            }
            INRbot_robot_value="";
            if(!empty(INRbot_robot)){
                INRbot_robot_value  = implode(", ",INRbot_robot);            
            }
            else{
                INRbot_robot_value = "0";
            }
            if(isset(INR_POST['max_snippet'])){
                INRmax_snippet = INR_POST['max_snippet'];
            }
            else{
                 INRmax_snippet = "max-snippet:";
            }
            if(isset(INR_POST['max_video'])){
            INRmax_video =(INR_POST['max_video']);
            }
            else{
                INRmax_video = "max-video:";
            }

            if(isset(INR_POST['max_image'])){
            INRmax_image=INR_POST['max_image'];
            }
            else{
                INRmax_image="max-image:";
            }
                INRmax_snippet_value =INR_POST['max_snippet_value'];   
                INRconcat_snippet = INRmax_snippet.INRmax_snippet_value;
                INRmax_video_value =INR_POST['max_video_value'];
                INRconcat_video = INRmax_video.INRmax_video_value;    
                INRmax_image_value =INR_POST['max_image_value'];
                INRconcat_image = INRmax_image.INRmax_image_value;
                INRadvance_bot = INRbot_robot_value.", ".INRconcat_snippet.", ".INRconcat_video.", ".INRconcat_image;
                INRcontent=trim_data(INR_POST['content']);
                INRfocus_key=trim_data(INR_POST['focus_keyword']);
                INRcategory = trim_data(INR_POST['category']);


                INRmessage="";
                if(isset(INR_POST['message'])){
                    INRmessage = trim_data(INR_POST['message']);
                }
                else{
                    INRmessage="";
                }
                INRfilename="";
                if(isset(INR_FILES["img"]["name"])){
                    INRfilename = INR_FILES["img"]["name"];
                    INRtempname = INR_FILES["img"]["tmp_name"];
                    INRfolder = "../assets/upload/quotes/".INRfilename;
                    if (move_uploaded_file(INRtempname, INRfolder))
                    {
                        //INRmsg = "Image uploaded successfully";
                    }     
                }
                else{
                    INRfilename="";
                }
                INRimg_alt="";
                if(isset(INR_POST['img_alt'])){
                    INRimg_alt = trim_data(INR_POST['img_alt']);
                }
                else{
                    INRimg_alt="";
                }
                INRimg_title="";
                if(isset(INR_POST['img_title'])){
                    INRimg_title = trim_data(INR_POST['img_title']);
                }
                else{
                    INRimg_title="";
                }

                INRdraft=0;
                if(isset(INR_POST['draft'])){
                    INRdraft = INR_POST['draft'];
                }
                else{
                    INRdraft = 0;
                }
   

        INRsql ="INSERT INTO `quotes`(`title`, `cat_id`, `content`, `image`, `seo_title`, `slug`, `focus_keyword`, `meta_desc`, `img_alt`, `img_title`, `rank_math_bot`, `quotes_desc`, `status`) VALUES
        ('INRtitle','INRcategory','INRcontent','INRfilename','INRseo_title','INRslug','INRfocus_key','INRmeta_desc','INRimg_alt','INRimg_title','INRadvance_bot','INRmessage',INRdraft)";

                    INRstmt_quotes = INRconn->prepare(INRsql);
                    if(INRstmt_quotes->execute())
                    {

                        INRlast_quote_id = INRconn->lastInsertId();
                        if(!empty(INRlast_quote_id)){
                
                            INRtotalAuthor = count(INR_POST['authorname']);
                            for(INRi=0;INRi<INRtotalAuthor;INRi++){
                                    INRname = trim_data(INR_POST['authorname'][INRi]);
                                    INRimage_alt = trim_data(INR_POST['image_alt'][INRi]);
                                    INRcontent = trim_data(INR_POST['quote'][INRi]);
                                    INRimage = INR_FILES["author_image"]["name"][INRi];
                                    INRimage_temp = INR_FILES["author_image"]["tmp_name"][INRi];
                
                                    INRfolder_author = "../assets/upload/quotes/".INRimage;
                                    if (move_uploaded_file(INRimage_temp, INRfolder_author))
                                    {
                                        //INRmsg = "Image uploaded successfully author";
                                    }
                                    INRsql = "INSERT INTO `quotes_data`(`quotes_id`, `author_name`, `author_content`, `author_image`,`alt_image`) 
                                    VALUES ('INRlast_quote_id','INRname','INRcontent','INRimage','INRimage_alt')";
                                    INRstmt = INRconn->prepare(INRsql);
                                    if(INRstmt->execute()){
                                    echo "inserted";              
                                    }
                                }
                        }
                      
                    }
                     
        }
        //add quotes end

        // edit quotes start here 
        if(INR_POST['btn']=="editQuotes")
        {

            INRtitle="";
            if(isset(INR_POST['quote_title'])){
                INRtitle = trim_data(INR_POST['quote_title']);
            }
            else{
                INRtitle="";
            }
            INRseo_title="";
            if(isset(INR_POST['quote_title_seo'])){
                INRseo_title = trim_data(INR_POST['quote_title_seo']);
            }
            else{
                INRseo_title="";
            }

            INRslug="";
            if(isset(INR_POST['quote_slug'])){
                INRslug = strtolower(str_replace(" ","-",INR_POST['quote_slug']));
            }
            else{
                INRslug="";
            }

            INRmeta_desc="";
            if(isset(INR_POST['meta_desc'])){
                INRmeta_desc = trim_data(INR_POST['meta_desc']);
            }
            else{
                INRmeta_desc="";
            }

            INRcontent="";
            if(isset(INR_POST['content'])){
                INRcontent = INR_POST['content'];
            }
            else{
                INRcontent="";
            }

            INRfocus_key="";
            if(isset(INR_POST['focus_keyword'])){
                INRfocus_key = trim_data(INR_POST['focus_keyword']);
            }
            else{
                INRfocus_key="";
            }
            INRcategory="";
            if(isset(INR_POST['category'])){
                INRcategory = trim_data(INR_POST['category']);
            }
            else{
                INRcategory="";
            }

            INRimg_path="";
            if(isset(INR_POST['img_path_old'])){
                INRimg_path = INR_POST['img_path_old'];
            }
            else{
                INRimg_path="";
            }

            if(isset(INR_POST['quotes_id'])){
                INRquotes_id = INR_POST['quotes_id'];
            }
            if(isset(INR_POST['bot_robot'])){
            INRbot_robot = (INR_POST['bot_robot']);
            }
            INRbot_robot_value="";
            if(!empty(INRbot_robot)){
                INRbot_robot_value  = implode(", ",INRbot_robot);            
            }
            else{
                INRbot_robot_value = "0";
            }
            if(isset(INR_POST['max_snippet'])){
                INRmax_snippet = INR_POST['max_snippet'];
            }
            else{
                 INRmax_snippet = "max-snippet:";
            }
            if(isset(INR_POST['max_video'])){
            INRmax_video =(INR_POST['max_video']);
            }
            else{
                INRmax_video = "max-video:";
            }

            if(isset(INR_POST['max_image'])){
            INRmax_image=INR_POST['max_image'];
            }
            else{
                INRmax_image="max-image:";
            }
                INRmax_snippet_value =INR_POST['max_snippet_value'];   
                INRconcat_snippet = INRmax_snippet.INRmax_snippet_value;
                INRmax_video_value =INR_POST['max_video_value'];
                INRconcat_video = INRmax_video.INRmax_video_value;    
                INRmax_image_value =INR_POST['max_image_value'];
                INRconcat_image = INRmax_image.INRmax_image_value;
                INRadvance_bot = INRbot_robot_value.", ".INRconcat_snippet.", ".INRconcat_video.", ".INRconcat_image;
              
              
                INRdraft=0;
                if(isset(INR_POST['draft'])){
                    INRdraft = INR_POST['draft'];
                }
                else{
                    INRdraft = 0;
                }
                INRmessage="";
                if(isset(INR_POST['message'])){
                    INRmessage = trim_data(INR_POST['message']);
                }
                else{
                    INRmessage="";
                }
                INRimg_alt="";
                if(isset(INR_POST['img_alt'])){
                    INRimg_alt = trim_data(INR_POST['img_alt']);
                }
                else{
                    INRimg_alt="";
                }
                INRimg_title="";
                if(isset(INR_POST['img_title'])){
                    INRimg_title = trim_data(INR_POST['img_title']);
                }
                else{
                    INRimg_title="";
                }
                INRold_img_path="";
                if(isset(INR_FILES["img"]["name"])){    
                    INRold_img_path = INR_FILES["img"]["name"];
                    INRtempname = INR_FILES["img"]["tmp_name"];
                   }
                   else
                   {
                    INRold_img_path="";
                   }

                   if(empty(INRold_img_path)){
                       INRold_img_path = INRimg_path;
                   }
                   else
                   {
                       INRfolder = "../assets/upload/quotes/".INRold_img_path;
                          if (move_uploaded_file(INRtempname, INRfolder))
                          {
                               INRmsg = "Image uploaded successfully";
                          }
                      
                   }
            INRsql ="UPDATE `quotes` SET `title`='INRtitle',`cat_id`='INRcategory',`content`='INRcontent',`image`='INRold_img_path',`seo_title`='INRseo_title',`slug`='INRslug',`focus_keyword`='INRfocus_key',
            `meta_desc`='INRmeta_desc',`img_alt`='INRimg_alt',`img_title`='INRimg_title',`rank_math_bot`='INRadvance_bot',`quotes_desc`='INRmessage',`status`='0' WHERE `id`='INRquotes_id'";

                    INRstmt_quotes = INRconn->prepare(INRsql);
                    if(INRstmt_quotes->execute())
                    {
                        echo "updated";
                    }
         
    }


// add author here
    if(INR_POST['btn']=="addAuthor")
    {
        INRfname="";
        if(isset(INR_POST['fname'])){
            INRfname = trim_data(INR_POST['fname']);
        }
        INRlname="";
        if(isset(INR_POST['lname'])){
            INRlname = trim_data(INR_POST['lname']);
        }
        INRusername="";
        if(isset(INR_POST['username'])){
            INRusername = trim_data(INR_POST['username']);
        }
        INRpass="";
        if(isset(INR_POST['pass'])){
            INRpass = trim_data(INR_POST['pass']);
        }
        INRfilename="";
        if(isset(INR_FILES["img"]["name"])){
            INRfilename = INR_FILES["img"]["name"];
            INRtempname = INR_FILES["img"]["tmp_name"];
        }
        INRqualification="";
        if(isset(INR_POST['qualification'])){
            INRqualification = trim_data(INR_POST['qualification']);
        }
        INRtitle="";
        if(isset(INR_POST['title'])){
            INRtitle = trim_data(INR_POST['title']);
        }
        INRslug="";
        if(isset(INR_POST['slug'])){
            INRslug = trim_data(INR_POST['slug']);
        }
        INRimg_title="";
        if(isset(INR_POST['img_title'])){
            INRimg_title = trim_data(INR_POST['img_title']);
        }
        INRimg_alt="";
        if(isset(INR_POST['img_alt'])){
            INRimg_alt = trim_data(INR_POST['img_alt']);
        }
        INRmeta_title="";
        if(isset(INR_POST['meta_title'])){
            INRmeta_title = trim_data(INR_POST['meta_title']);
        }
        INRmeta_desc="";
        if(isset(INR_POST['meta_desc'])){
            INRmeta_desc = trim_data(INR_POST['meta_desc']);
        }
        INRposition="";
        if(isset(INR_POST['position'])){
            INRposition = trim_data(INR_POST['position']);
        }
        INRmessage="";
        if(isset(INR_POST['text'])){
            INRmessage = trim_data(INR_POST['text']);
        }
        INRhighlights="";
        if(isset(INR_POST['highlights'])){
            INRhighlights = INR_POST['highlights'];
        }
        INRexperience="";
        if(isset(INR_POST['experience'])){
            INRexperience = INR_POST['experience'];
        }


            // file move to image folder
            INRfolder = "../assets/upload/authorProfile/".INRfilename;
            if (move_uploaded_file(INRtempname, INRfolder))
            {
                //INRmsg = "Image uploaded successfully";
            }
            else{
                //INRmsg = "Failed to upload image";
                }
            
                INRsql = "INSERT INTO `author`(`author_first_name`, `author_last_name`, `author_position`, `author_username`, `author_password`, `qualification`, `title`, `slug`, `meta_title`, `meta_desc`, `highlights`, `experience`, `image`, `img_alt`, `img_title`, `message`, `status`)
                VALUES ('INRfname','INRlname','INRposition','INRusername','INRpass','INRqualification','INRtitle','INRslug','INRmeta_title','INRmeta_desc','INRhighlights','INRexperience','INRfilename','INRimg_title','INRimg_alt','INRmessage',0)";
            INRstmt = INRconn->prepare(INRsql);
            if(INRstmt->execute()){
                echo "inserted";
            }    

    }

    // update author here
    if(INR_POST['btn']=="updateAuthorUser")
    {
        if(isset(INR_POST['author_id'])){
            INRid = trim_data(INR_POST['author_id']);
        }
        INRold_image="";
        if(isset(INR_POST['old_image'])){
            INRold_image = INR_POST['old_image'];
        }
        INRfname="";
        if(isset(INR_POST['fname'])){
            INRfname = trim_data(INR_POST['fname']);
        }
        INRlname="";
        if(isset(INR_POST['lname'])){
            INRlname = trim_data(INR_POST['lname']);
        }
        INRusername="";
        if(isset(INR_POST['username'])){
            INRusername = trim_data(INR_POST['username']);
        }
        INRpass="";
        if(isset(INR_POST['pass'])){
            INRpass = trim_data(INR_POST['pass']);
        }
        INRqualification="";
        if(isset(INR_POST['qualification'])){
            INRqualification = trim_data(INR_POST['qualification']);
        }
         INRtitle="";
        if(isset(INR_POST['title'])){
            INRtitle = trim_data(INR_POST['title']);
        }
        INRslug="";
        if(isset(INR_POST['slug'])){
            INRslug = trim_data(INR_POST['slug']);
        }
        INRimg_title="";
        if(isset(INR_POST['img_title'])){
            INRimg_title = trim_data(INR_POST['img_title']);
        }
        INRimg_alt="";
        if(isset(INR_POST['img_alt'])){
            INRimg_alt = trim_data(INR_POST['img_alt']);
        }
        INRmeta_title="";
        if(isset(INR_POST['meta_title'])){
            INRmeta_title = trim_data(INR_POST['meta_title']);
        }
        INRmeta_desc="";
        if(isset(INR_POST['meta_desc'])){
            INRmeta_desc = trim_data(INR_POST['meta_desc']);
        }
        INRposition="";
        if(isset(INR_POST['position'])){
            INRposition = trim_data(INR_POST['position']);
        }
        INRmessage="";
        if(isset(INR_POST['text'])){
            INRmessage = trim_data(INR_POST['text']);
        }
        INRhighlights="";
        if(isset(INR_POST['highlights'])){
            INRhighlights = INR_POST['highlights'];
        }
        INRexperience="";
        if(isset(INR_POST['experience'])){
            INRexperience = INR_POST['experience'];
        }
        
        INRfilename="";
        if(isset(INR_FILES["img"]["name"])){
            INRfilename = INR_FILES["img"]["name"];
            INRtempname = INR_FILES["img"]["tmp_name"];
        }
        else{
            INRfilename = INRold_image;
        }

        if(empty(INRfilename)){
            INRfilename = INRold_image;
        }
        else
        {
                INRfolder = "../assets/upload/authorProfile/".INRfilename;
                if (move_uploaded_file(INRtempname, INRfolder))
                {
                    //INRmsg = "Image uploaded successfully";
                }
                           
        }
                 INRsql = "UPDATE `author` SET `author_first_name`='INRfname',`author_last_name`='INRlname',`author_position`='INRposition',`author_username`='INRusername',`author_password`='INRpass',
                `qualification`='INRqualification',`title`='INRtitle',`slug`='INRslug',`meta_title`='INRmeta_title',`meta_desc`='INRmeta_desc',`highlights`='INRhighlights',`experience`='INRexperience',`image`='INRfilename',`img_alt`='INRimg_alt',`img_title`='INRimg_title',`message`='INRmessage',`status`='0' WHERE `id`='INRid'";
            
            INRstmt = INRconn->prepare(INRsql);
            if(INRstmt->execute()){
                echo "updated";
            }    

    }
    // delete author data here 
    
    if(INR_POST['btn']=="deleteFunctionAuthor_id")
    {
        INRdeleteFunctionAuthor_id = INR_POST['deleteFunctionAuthor_id'];
        INRsql=INRconn->prepare("UPDATE `contact_enquiry` SET `status`='1' WHERE `id`=?");  
        INRsql->execute([INRdeleteFunctionAuthor_id]);
        echo "Trashed";
    }
    // user comment delete 
    
    if(INR_POST['btn']=="deleteuserComment_id")
    {
        INRdeleteuserComment_id = INR_POST['deleteuserComment_id'];
        INRsql=INRconn->prepare("Delete FROM `tbl_comment` WHERE `comment_id`=?");  
        INRsql->execute([INRdeleteuserComment_id]);
        echo "deleted";
    }
    
    if(INR_POST['btn']=="permanentdeleteFunctionAuthor_id")
    {
        INRpermanentdeleteFunctionAuthor_id = INR_POST['permanentdeleteFunctionAuthor_id'];
        INRsql=INRconn->prepare("Delete FROM `contact_enquiry`WHERE `id`=?");  
        INRsql->execute([INRpermanentdeleteFunctionAuthor_id]);
        echo "Deleted";
    }

        if(INR_POST['btn'] === "add_image_quote")
        {
            INRold_imgPath = trim_data(INR_POST["quote_author_image"]);
            INRauthor_image="";
            if(isset(INR_FILES["author_image"]["name"])){
                INRauthor_image = INR_FILES["author_image"]["name"];
                INRauthor_image_temp = INR_FILES["author_image"]["tmp_name"];
            }else
            {
                INRauthor_image = INRold_imgPath;
            }
            INRimg_alt="";
            if(isset(INR_POST["img_alt"])){
                INRimg_alt = trim_data(INR_POST["img_alt"]);    
            }
            else{
                INRimg_alt="";
            }
            
            INRid = INR_POST['quote_author_id'];
            
            if(!empty(INRauthor_image)){
            INRfolder = "../assets/upload/quotes/".INRauthor_image;
            if (move_uploaded_file(INRauthor_image_temp, INRfolder))
                {
                    INRmsg = "Image uploaded successfully content";
                }
            }else{
                 INRauthor_image = INRold_imgPath;
            }
            
            INRsql = "UPDATE `quotes_data` SET `author_image`='INRauthor_image',`alt_image`='INRimg_alt' WHERE `id`='INRid'";
            INRstmt = INRconn->prepare(INRsql);
            if(INRstmt->execute()){
                echo "updated";
            }
        }
    
        if(INR_POST['btn']=="quotes_author_content_id")
        {
                INRquotes_author_content_id = INR_POST['quotes_author_content_id'];
                INRstmt = INRconn->prepare("SELECT * FROM `quotes_data` WHERE id = 'INRquotes_author_content_id'");
                INRstmt->execute();
                INRdata = INRstmt->fetchAll(PDO::FETCH_ASSOC);   
                if (!empty(INRdata)) {
                    foreach (INRdata as INRdata)
                    {
                        echo"
                        <form id='update_author_data'>
                        <div class='mb-3'>
                        <label for='formmessage'>Author Name :</label>
                        <input type='text' class='form-control' name='author_name' value='" .INRdata['author_name']. "'>
                        </div>
                        <div class='mb-3'>
                        <label for='formmessage'>Author Content :</label>
                        <textarea class='form-control' name='author_content' rows='3'> ".INRdata['author_content']." </textarea>
                        </div>
                        <div class='submit-btns'>
                        <input type='hidden' value='update_author_quotes' name='btn'>
                        <input type='hidden'  value='". INRdata['id'] ."' name='quote_author_id'>
                        <input type='submit' name='add_image_quote' class='post-btn text-left' value='Save'> 
                        </div>
                        </form>";   
                    }
                }
        }

        if(INR_POST['btn']=="update_author_quotes")
        {
            INRid = INR_POST['quote_author_id'];
            INRauthor_name = trim_data(INR_POST["author_name"]);
            INRauthor_content = trim_data(INR_POST["author_content"]);

            INRsql = "UPDATE `quotes_data` SET `author_name`='INRauthor_name',`author_content`='INRauthor_content' WHERE id='INRid'";
            INRstmt = INRconn->prepare(INRsql);
            if(INRstmt->execute()){
                echo "updated";
                }
        }


        if(INR_POST['btn'] == "filter_blog_data")
        {
                    INRauthor_name = "";
                    INRcategory = "";
                    INRdate = "";
                    INRerror="";
                    if(!empty(INR_POST['author_name']))
                    {
                    echo INRauthor_name = trim_data(INR_POST['author_name']);
                    }
                    else
                    {
                        INRerror = "required";
                    }
                    if(!empty(INR_POST['category_filter']))
                    {
                    echo INRcategory = trim_data(INR_POST['category_filter']);
                    }
                    else
                    {
                        INRerror = "required";
                    }
                    if(!empty(INR_POST['lastPostDate']))
                    {
                        echo INRdate = trim_data(INR_POST['lastPostDate']);
                    }
                    else
                    {
                        INRerror = "required";
                    }
                    //echo INRerror;
                    if(!empty(INRauthor_name || INRcategory || INRdate))
                    {
                        INRsql = "SELECT * FROM `blog` WHERE post_author='INRauthor_name' OR parent_category='INRcategory' OR category='INRcategory' OR publish_date='INRdate'";
                        INRstmt_aut = INRconn->prepare(INRsql);
                        INRstmt_aut->execute();
                        INRaut_data = INRstmt_aut->fetchAll(PDO::FETCH_ASSOC);
                                echo '<table id="datatable" class="table table-bordered dt-responsive">
                                <thead>
                                    <tr role="row">
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Categories</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>';
                                if(!empty(INRaut_data))
                                {
                                    foreach(INRaut_data as INRauthor_row)
                                    {   
                                        INRcategory = INRauthor_row['parent_category'];
                                        INRsub_category = INRauthor_row['category'];
                                        INRcat_array = array(INRcategory,INRsub_category);
                                        INRtitle = INRauthor_row['post_title'];
                                        INRimage = INRauthor_row['featured_image'];
                                        
                                        INRauthor = INRauthor_row['post_author'];
                                        INRexploded_array = explode(',',INRauthor);
                                        
                                        INRstmt_author = INRconn->prepare("SELECT id, author_first_name FROM `author`");
                                        INRstmt_author->execute();
                                        INRauthor_data = INRstmt_author->fetchAll(PDO::FETCH_ASSOC);
                                        if(!empty(INRauthor_data))
                                        {
                                            foreach (INRauthor_data as INRauthor_data_val)
                                            {
                                                    if(in_array(INRauthor_data_val['id'], INRexploded_array))
                                                    {
                                                            INRauthor =  INRauthor_data_val['author_first_name'].",";
                                    
                                                        
                                                    }
                                            }
                                        }
                                        
                                        INRcat="";
                                        INRstmt_cat = INRconn->prepare("SELECT * FROM `categories`");
                                        INRstmt_cat->execute();
                                        INRcat_data = INRstmt_cat->fetchAll(PDO::FETCH_ASSOC);
                                        if (!empty(INRcat_data))
                                        {
                                                foreach (INRcat_data as INRcat_data_val)
                                                {
                                                    if(in_array(INRcat_data_val['cat_id'], INRcat_array))
                                                    {
                                                        INRcat = INRcat_data_val['cat_name'].",";
                                
                                                       
                                                    }
                                                
                                                }
                                        }
                                        echo "<tr>";
                                        echo "<td class='sorting_1 dtr-control' tabindex='0'><img src='../assets/upload/" .INRimage. "'/></td>";
                                        echo "<td>" .INRtitle. "</td>";
                                        echo "<td>" . INRauthor . "</td>";
                                        echo "<td>" .INRcat. "</td>";
                                        echo "<td><a href='update_blog.php?id=".INRauthor_row["id"]."' class='btn btn-success'><i class='fas fa-edit'></i></td>";
                                        echo "<td><a href='javascript:void(0)' class='btn btn-danger' onclick='blogTrashRows(".INRauthor_row['id'].")'><i class='fas fa-trash-alt'></i></td>";
                                        echo "</tr>";
                                    }
                                }
                                else
                                {
                                    echo "<tr>No Data Found</tr>";
                                }
                                    echo "</table>";
                    }
            }

// quotes filter data here 

if(INR_POST['btn'] == "filter_Quotesdata")
{
            INRcategory = "";
            INRdate = "";
            INRerror="";
            if(!empty(INR_POST['category_filter']))
            {
            echo INRcategory = trim_data(INR_POST['category_filter']);
            }
           
            if(!empty(INR_POST['date']))
            {
                echo INRdate = trim_data(INR_POST['date']);
            }
          
            //echo INRerror;
            if(!empty(INRcategory || INRdate))
            {
                INRsql = "SELECT * FROM `quotes` WHERE `cat_id`='INRcategory' OR `date`='INRdate'";
                INRstmt_quo = INRconn->prepare(INRsql);
                INRstmt_quo->execute();
                INRquo_data = INRstmt_quo->fetchAll(PDO::FETCH_ASSOC);
                        echo '<table id="datatable" class="table table-bordered dt-responsive">
                        <thead>
                            <tr role="row">
                                <th>Image</th>
                                <th>Title</th>
                                <th>Categories</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>';
                        if(!empty(INRquo_data))
                        {
                            foreach(INRquo_data as INRquo_data_val)
                            {   
                                INRcategory = INRquo_data_val['cat_id'];
                                echo "<tr>";
                                echo "<td><img src='upload/quotes/" . INRquo_data_val['image'] . "' class='product_img_data'/></td>";
                                echo "<td>" . INRquo_data_val['title'] . "</td>";
                                INRstmt1 = INRconn->prepare("SELECT * FROM `quotescat` WHERE id='INRcategory'");
                                INRstmt1->execute();
                                
                                INRdata_cat = INRstmt1->fetchAll(PDO::FETCH_ASSOC);	
                                foreach (INRdata_cat as INRdata_cat_val)
                                {	
                                    echo "<td>" .INRdata_cat_val['categoryName']. "</td>";
                                }
                                
                                echo "<td><a href='updateQuote.php?id=".INRquo_data_val["id"]."' class='btn btn-success'><i class='fas fa-edit'></i></td>";
                                echo "<td><a href='javascript:void(0)' class='btn btn-danger' onclick='quotesTrashRows(".INRquo_data_val['id'].")'><i class='fas fa-trash-alt'></i></td>";
                                echo "</tr>";
                            }
                        }
                        else
                        {
                            echo "<tr>No Data Found</tr>";
                        }
                            echo "</table>";
            }
            else
            {

            }
    }

    if(INR_POST['btn'] == "add_page")
    {
        INRtitle = trim_data(INR_POST['i1']);
        INRseo_title = trim_data(INR_POST['i2']);
        INRslug = trim_data(INR_POST['i3']);
        
        if(isset(INR_POST['author_name']))
        {
    
        INRauthor_name = (INR_POST['author_name']);
        }
        INRauthor_values="";
        if(!empty(INRauthor_name))
        {
            INRauthor_values  = implode(",",INRauthor_name);            
        }
        else
        {
            echo INRauthor_values = "1";
        }
        
    
        if(isset(INR_POST['review']))
        {
        INRreview = (INR_POST['review']);
        }
        INRreview_value="";
        if(!empty(INRreview))
        {
            INRreview_value  = implode(",",INRreview);            
        }
        else
        {
            echo INRreview_value = "1";
        }
    
        if(isset(INR_POST['bot_robot']))
        {
        INRbot_robot = (INR_POST['bot_robot']);
        }
        INRbot_robot_value="";
        if(!empty(INRbot_robot))
        {
            INRbot_robot_value  = implode(", ",INRbot_robot);            
        }
        else
        {
            echo INRbot_robot_value = "0";
        }
    
        if(isset(INR_POST['max_snippet']))
        {
            INRmax_snippet = INR_POST['max_snippet'];
        }
        else
        {
            echo INRmax_snippet = "max-snippet:";
        }
        if(isset(INR_POST['max_video']))
        {
        INRmax_video =(INR_POST['max_video']);
        }
        else
        {
            echo INRmax_video = "max-video:";
        }
    
        if(isset(INR_POST['max_image']))
        {
        INRmax_image=INR_POST['max_image'];
        }
        else
        {
            echo INRmax_image="max-image:";
        }
            INRmax_snippet_value =INR_POST['max_snippet_value'];   
            INRconcat_snippet = INRmax_snippet.INRmax_snippet_value;
            INRmax_video_value =INR_POST['max_video_value'];
            INRconcat_video = INRmax_video.INRmax_video_value;    
            INRmax_image_value =INR_POST['max_image_value'];
            INRconcat_image = INRmax_image.INRmax_image_value;
            
            echo INRadvance_bot = INRbot_robot_value.", ".INRconcat_snippet.", ".INRconcat_video.", ".INRconcat_image;
    
            INRcontent=trim_data(INR_POST['content']);
            INRfocus_key=trim_data(INR_POST['focus_keyword']);
            INRdate_publish=trim_data(INR_POST['date_publish']);
            INRcategory = trim_data(INR_POST['category']);
            //INRsub_category = trim_data(INR_POST['sub_category']);
    
            if(isset(INR_POST['sub_category']))
            {
            INRsub_category = INR_POST['sub_category'];
            }
            INRsub_category_value="";
            if(!empty(INRsub_category))
            {
                INRsub_category_value  = implode(",",INRsub_category);            
            }
            else
            {
                echo INRsub_category_value = "no";
            }
    
    
            INRmessage = trim_data(INR_POST['message']);
            INRdate_publish = INR_POST['date_publish'];
            INRdate_modified = INR_POST['date_modified'];
            INRfilename = trim_data(INR_FILES["img"]["name"]);
            INRtempname = INR_FILES["img"]["tmp_name"];
            INRdate = date("Y-m-d");    
            // file move to image folder
            INRfolder = "upload/".INRfilename;
            if (move_uploaded_file(INRtempname, INRfolder))
            {
                INRmsg = "Image uploaded successfully";
            }
            else{
                INRmsg = "Failed to upload image";
                }
            
                echo INRsql = "INSERT INTO `page`(`post_author`, `post_review`, `post_content`, `post_title`, `post_name`, `parent_category`, `category`, `description`, `permalink`, `featured_image`, `publish_date`, `modified_date`, `title_slug`, `bot_meta_data`, `canonical_url`, `status`)
                VALUES ('INRauthor_values','INRreview_value','INRcontent','INRtitle','INRtitle','INRcategory','INRsub_category_value','INRmessage','','INRfilename','INRdate_publish','INRdate_modified','INRslug','INRadvance_bot','',0)";
                INRstmt6 = INRconn->prepare(INRsql);
                if(INRstmt6->execute()){
                    echo "inserted page";    
                }
             
    }

            function trim_data(INRtext) {
               // INRtext = trim(INRdata); //<-- LINE 31
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
    