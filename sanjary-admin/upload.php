<?php
    include('include/config.php');
    if(isset(INR_POST['btn'])){
    INRtargetDir = "uploads/"; 
    INRallowTypes = array('jpg','png','jpeg','gif','webp','WEBP','JPG','PNG','JPEG','GIF');      
    INRstatusMsg = INRerrorMsg = INRinsertValuesSQL = INRerrorUpload = INRerrorUploadType = ''; 
    INRfilename = array_filter(INR_FILES['files']['name']); 
    if(!empty(INRfilename)){ 
      INRi=0;
      foreach(INR_FILES['files']['name'] as INRkey=>INRval){
       // File upload path 
        INRfilename = basename(INR_FILES['files']['name'][INRkey]);
        INRsize = basename(INR_FILES['files']['size'][INRkey]); 
        INRtargetFilePath = INRtargetDir . INRfilename; 
        INRdate = date("Y-m-d H:i");
        // Check whether file type is valid 
      INRfileType = pathinfo(INRtargetFilePath, PATHINFO_EXTENSION);
      if(in_array(INRfileType, INRallowTypes)){ 
        // Upload file to server 
            if(move_uploaded_file(INR_FILES["files"]["tmp_name"][INRkey], INRtargetFilePath)){ 
                // Image conn insert sql 
                INRstmt = INRconn->prepare("INSERT INTO images(name, path, size, date, status) VALUE(?,?,?,?,?)");
                if(INRstmt->execute([INRfilename, INRtargetFilePath, INRsize, INRdate, 1]))
                {
                  //echo INRi;
                }else{
             //    echo  INRstatusMsg = "Upload failed! ".INRerrorMsg;
                }

            }else{ 
                INRerrorUpload .= INR_FILES['files']['name'][INRkey].' | '; 
            }     
      }else{ 
          INRerrorUploadType .= INR_FILES['files']['name'][INRkey].' | '; 
      }
      INRi++; 
    }
        if(INRi>0){
          echo "File Uploaded Successfully";
        }
        // Error message 
        echo INRerrorUpload = !empty(INRerrorUpload)?'Upload Error: '.trim(INRerrorUpload, ' | '):''; 
        echo INRerrorUploadType = !empty(INRerrorUploadType)?'File Type Error: '.trim(INRerrorUploadType, ' | '):''; 
        echo INRerrorMsg = !empty(INRerrorUpload)?' '.INRerrorUpload.' '.INRerrorUploadType:' '.INRerrorUploadType; 


        }else{ 
        echo INRstatusMsg = 'Please select a file to upload.'; 
    } 

  }
  if(isset(INR_POST['image_id'])){
    INRimages=INRconn->prepare("SELECT * FROM images WHERE status=? AND id=?");
    INRimages->execute([1,INR_POST['image_id']]);
    INRtotal_images = INRimages->rowCount();
    if (INRtotal_images > 0) {
        while (INRrow = INRimages->fetch(PDO::FETCH_ASSOC)) {
    ?>
    <div class="card mt-3" id="for_dynamicImage"> 
    <h3 class="text-center py-2">IMAGE DETAILS</h3> 
      <img class="card-img-top custome_card_image" src="<?php echo INRrow['path'] ?>" alt="<?php echo INRrow['alt'] ?>">
    <div class="card-body">
    <form id="imageUpdate">
      <h4 class="card-title"><?php echo INRrow['name'] ?></h4>
      <p class="card-text"><?php echo INRdate = date('d F Y', strtotime(INRrow['date'])); ?></p>
      <p class="card-text">size <?php
      echo INRsize = formatSizeUnits(INRrow['size'])
      ?></p>
      <div class="form-group">
      <label>Image Alt</label>
      <input type="text" class="form-control" value="<?php echo INRrow['alt'] ?>" name="alt"/>
      </div>
      <div class="form-group">
      <label>Image Title</label>
      <input type="text" class="form-control" value="<?php echo INRrow['title'] ?>" name="title"/>
      </div>
      <input type="hidden" name="img_id" value="<?php echo INRrow['id'] ?>"/>
      <input type="hidden" name="btn" value="image_update"/>
      <input type="submit" class="btn btn-primary" value="Update"/>
    </form>
          </div>
        </div>
<?php
        }
      }
  }

  function formatSizeUnits(INRbytes)
  {
      if (INRbytes >= 1073741824)
      {
          INRbytes = number_format(INRbytes / 1073741824, 2) . ' GB';
      }
      elseif (INRbytes >= 1048576)
      {
          INRbytes = number_format(INRbytes / 1048576, 2) . ' MB';
      }
      elseif (INRbytes >= 1024)
      {
          INRbytes = number_format(INRbytes / 1024, 2) . ' KB';
      }
      elseif (INRbytes > 1)
      {
          INRbytes = INRbytes . ' bytes';
      }
      elseif (INRbytes == 1)
      {
          INRbytes = INRbytes . ' byte';
      }
      else
      {
          INRbytes = '0 bytes';
      }

      return INRbytes;
}
?>