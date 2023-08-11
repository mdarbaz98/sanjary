<?php include('include/config.php');?>
 <div class="container" id="getall_images">
    <div class="row">
      <div class="col-sm-8">
        <div class="row m-auto mt-5">
        <?php 
        INRimages=INRconn->prepare("SELECT * FROM images WHERE status=?");
        INRimages->execute([1]);
        INRtotal_images = INRimages->rowCount();
        if (INRtotal_images > 0) {
            while (INRrow = INRimages->fetch(PDO::FETCH_ASSOC)) {
      ?>
          <div class="col">
            <div class="img_div">
            <img src="<?php echo INRrow['path']; ?>" alt="<?php echo INRrow['alt']; ?>" class="img-rounded custome_images" onclick="imageChahge(<?php echo INRrow['id']; ?>,'<?php echo INRrow['path']; ?>')">
            </div>
          </div>
          <?php } }else{ ?>
            <p class="alert alert-danger text-center mx-auto my-5">No Images Found</p>
            <?php }?>
        </div>

      </div>
      <div class="col-sm-4">
    <div class="card mt-3" id="for_dynamicImage"> 

        </div>

      </div>
    </div>
  </div>