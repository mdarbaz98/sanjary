INR('#form_submit,#form_submit1').validate({
  rules: {
    files: {
      required: true,
      extension: 'jpg|png|jpeg',
    },
  },
  message: {
    files: 'select image',
  },
  submitHandler: function (form) {
    // alert(form)
    INR.ajax({
      url: 'upload.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        alert(data)
        getAllimages()
        INR('.nav-link').removeClass('active')
        INR('#profile-tab,#profile-tab1').click()
        INR('#profile-tab,#profile-tab1').addClass('active')

        // console.log(data)

        // if(data=='updated')
        // {
        //     alert("Blog Update Successfully");
        // }
        // else
        // {
        // }
        // INR("#update_blog_form").trigger("reset");
      },
    })
  },
})

// for image validation
function imageUdatevalidate() {
  INR('#imageUpdate,imageUpdate1').validate({
    rules: {
      alt: {
        required: true,
      },
      title: {
        required: true,
      },
    },
    message: {
      alt: 'enter',
    },
    submitHandler: function (form) {
      INR.ajax({
        url: 'action.php',
        type: 'post',
        data: new FormData(form),
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          if (data == 'updated') {
            alert('Image Updated Successfully')
          } else {
            alert('Something Went Wrong')
          }
          // INR("#update_blog_form").trigger("reset");
        },
      })
    },
  })
}
// get current all images
function getAllimages() {
  INR.ajax({
    url: 'get_images.php',
    type: 'post',
    data: {
      btn: 'getAllimages',
    },
    contentType: false,
    cache: false,
    processData: false,
    success: function (data) {
      INR('#getall_images').html(data)
    },
  })
}

var db_val = INR('#setCTA_selectedpro').val();
var db_array = db_array ? db_val.split(",") : [];
console.log(db_array)
var numberArray = db_array.map(Number);
console.log(db_val)

function setProduct_id(x){
    var id = INR(x).data('image');
    if(INR(x).is(":checked")){
        numberArray.push(id)    
    } else {
        numberArray.splice(numberArray.indexOf(id),1);
    }
    var pro_id = numberArray.join(",");
     if(pro_id.charAt(0)==','){
        pro_id=pro_id.substring(1);
    }
    INR('.image_id').attr('value',pro_id)
}


// onclick change right panel image data
function imageChahge(id, path) {                                                                                                                                                                                                                                                                                                                                                                                                                                           
  INR.ajax({
    type: 'POST',
    url: 'upload.php',
    dataType: 'html',
    data: {
      image_id: id,
    },
    success: function (data) {
      INR('#for_dynamicImage,#for_dynamicImage1,#for_dynamicImage2').html(data)
      //location.reload();
      // alert(data);
      //INR('.image_id').attr('value', id)
      setImgAgain = path
      // INR('.image_path').attr('src', path)
      // console.log(INR('.image_path').attr('src', path));
      
        var img = `<img src="INR{path}" alt="" onclick="removeImg(this)" class="set_images" style="width:90px">`; 
        INR(".set_images").append(img);
    
      imageUdatevalidate()
    },
  })
}

function appendProductsize(){
  let counter=1;
  var html_content=`
  <div class="row" id=INR{'append_productSize_'+counter} >
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

                          <div class="submit-btn">
                            <input type="button" class="post-btn" value="Add More" onclick="appendProductsize()">
                            <span class="post-btn" onclick="deleteSizeProduct(INR{counter})" style="background:#7e37d8;">Delete</span>                     
                          </div>`;

      INR('#forAppend').append(html_content);
      counter++;
}
function deleteSizeProduct(target){
  const ele=document.getElementById('append_productSize_'+target)
  ele.remove() 
}


const INPUT_FILE = document.querySelector('#upload-files')
const INPUT_CONTAINER = document.querySelector('#upload-container')
const FILES_LIST_CONTAINER = document.querySelector('#files-list-container')
const FILE_LIST = []
let UPLOADED_FILES = []

const multipleEvents = (element, eventNames, listener) => {
  const events = eventNames.split(' ')

  events.forEach((event) => {
    element.addEventListener(event, listener, false)
  })
}

const previewImages = () => {
  FILES_LIST_CONTAINER.innerHTML = ''
  if (FILE_LIST.length > 0) {
    FILE_LIST.forEach((addedFile, index) => {
      const content = `
            <div class="form__image-container js-remove-image" data-index="INR{index}">
              <img class="form__image" src="INR{addedFile.url}" alt="INR{addedFile.name}">
            </div>
          `

      FILES_LIST_CONTAINER.insertAdjacentHTML('beforeEnd', content)
    })
  } else {
    console.log('empty')
    INPUT_FILE.value = ''
  }
}

const fileUpload = () => {
  if (FILES_LIST_CONTAINER) {
    multipleEvents(INPUT_FILE, 'click dragstart dragover', () => {
      INPUT_CONTAINER.classList.add('active')
    })

    multipleEvents(INPUT_FILE, 'dragleave dragend drop change blur', () => {
      INPUT_CONTAINER.classList.remove('active')
    })

    INPUT_FILE.addEventListener('change', () => {
      const files = [...INPUT_FILE.files]
      console.log('changed')
      files.forEach((file) => {
        const fileURL = URL.createObjectURL(file)
        const fileName = file.name
        if (!file.type.match('image/')) {
          alert(file.name + ' is not an image')
          console.log(file.type)
        } else {
          const uploadedFiles = {
            name: fileName,
            url: fileURL,
          }

          FILE_LIST.push(uploadedFiles)
        }
      })

      console.log(FILE_LIST) //final list of uploaded files
      previewImages()
      UPLOADED_FILES = document.querySelectorAll('.js-remove-image')
      removeFile()
    })
  }
}

const removeFile = () => {
  UPLOADED_FILES = document.querySelectorAll('.js-remove-image')

  if (UPLOADED_FILES) {
    UPLOADED_FILES.forEach((image) => {
      image.addEventListener('click', function () {
        const fileIndex = this.getAttribute('data-index')

        FILE_LIST.splice(fileIndex, 1)
        previewImages()
        removeFile()
      })
    })
  } else {
    ;[...INPUT_FILE.files] = []
  }
}

fileUpload()
removeFile()
// Delete Category
function deleteCategory(id) {
  var x = confirm('Are you sure you want to permanent delete this?')
  if (x) {
    INR.ajax({
      type: 'POST',
      url: 'action.php',
      dataType: 'html',
      data: {
        deleteCategory_id: id,
        btn: 'deleteCategory_id',
      },
      success: function (data) {
        if (data == 'deleted') {
          alert('Category Successfully Deleted')
          location.reload()
        }
      },
    })
  }
}
//Delete user
function deleteUser(id) {
  var x = confirm('Are you sure you want to permanent delete this?')
  if (x) {
    INR.ajax({
      type: 'POST',
      url: 'action.php',
      dataType: 'html',
      data: {
        deleteUser_id: id,
        btn: 'deleteUser_id',
      },
      success: function (data) {
        if (data == 'deleted') {
          alert('User Successfully Deleted')
          location.reload()
        }
      },
    })
  }
}
// upload
function uploadProduct(id) {
  var x = confirm('Are you sure you want to upload this?')
  if (x) {
    INR.ajax({
      type: 'POST',
      url: 'action.php',
      dataType: 'html',
      data: {
        uploadProduct_id: id,
        btn: 'uploadProduct_id',
      },
      success: function (data) {
        if (data == 'uploaded') {
          alert('Product Successfully Uploaded')
          location.reload()
        }
      },
    })
  }
}
//Trash product
function trashProduct(id) {
  var x = confirm('Are you sure you want to trash this?')
  if (x) {
    INR.ajax({
      type: 'POST',
      url: 'action.php',
      dataType: 'html',
      data: {
        trashProduct_id: id,
        btn: 'trashProduct_id',
      },
      success: function (data) {
        if (data == 'trashed') {
          alert('Product Successfully Trashed')
          location.reload()
        }
      },
    })
  }
}
function deleteProductprice(id) {
  var x = confirm('Are you sure you want to delete this?')
  if (x) {
    INR.ajax({
      type: 'POST',
      url: 'action.php',
      dataType: 'html',
      data: {
        trashProductprice_id: id,
        btn: 'trashProductprice_id',
      },
      success: function (data) {
        if (data == 'deleted') {
          alert('Product Size Price Successfully Deleted')
          location.reload()
        }
      },
    })
  }
}

function productPriceupdate(id){
    INR.ajax({
    type: 'POST',
    url: 'action.php',
    dataType: 'json',
    data: {
      productPriceupdate: id,
      btn: 'productPriceupdate',
    },
    success: function (data) {

      var json = INR.parseJSON(JSON.stringify(data));
      var price = json.price;
      var dprice = json.dprice;
      var size = json.size;
      var updateProductprice_id = json.updateProductprice_id;

      INR("#productPrice_price").val(price);
      INR("#productPrice_dprice").val(dprice);
      INR("#productPrice_size").val(size);
      INR("#updateProductprice_id").val(updateProductprice_id);
    },
  })
  INR('#priceUpdatemodal').modal('show');
}
//Permanent Delete product
function deleteProduct(id) {
  var x = confirm('Are you sure you want to permanent delete this?')
  if (x) {
    INR.ajax({
      type: 'POST',
      url: 'action.php',
      dataType: 'html',
      data: {
        deleteProduct_id: id,
        btn: 'deleteProduct_id',
      },
      success: function (data) {
        if (data == 'deleted') {
          alert('Product Successfully Deleted')
          location.reload()
        }
      },
    })
  }
}

//post search text here
INR('#search_post_title').keyup(function () {
  var name = INR('#search_post_title').val()
  if (name == '') {
    //Assigning empty value to "display" div in "search.php" file.
    INR('#datatable').html('')
    //alert("blank");
  } else {
    INR.ajax({
      type: 'post',
      url: 'getFilter_table.php',
      data: { post_title: name, btn: 'post_title' },
      cache: false,
      success: function (data) {
        INR('#datatable').html(data)
        //alert(data);
        //console.log(data);
      },
    })
  }
})

// product search table

INR('#product_search_table').keyup(function () {
  var name = INR('#product_search_table').val()
  if (name == '') {
    //Assigning empty value to "display" div in "search.php" file.
    INR('#datatable').html('')
    //alert("blank");
  } else {
    INR.ajax({
      type: 'post',
      url: 'getFilter_table.php',
      data: { pro_name: name, btn: 'pro_name' },
      cache: false,
      success: function (data) {
        INR('#datatable').html(data)
        //alert(data);
        //console.log(data);
      },
    })
  }
})



// SEO Title KeyUp Function
function copytext_cat(e) {
  let ctrC = document.getElementById('cat').value
  //alert(ctrC)
  str = ctrC.replace(/\s+/g, '-').toLowerCase()
  document.getElementById('cat_slug').value = str
}

var db_val = INR('#image_id').val();
var db_array = db_val.split(",");
var numberArray = db_array.map(Number)

function imageCheckbox(x){
  var image_id = INR(x).data('image');
  if(INR(x).is(":checked")){
    numberArray.push(image_id)    
  } else {
    numberArray.splice(numberArray.indexOf(image_id),1);
  }
  var pro_id = numberArray.join(",");
  if(pro_id.charAt(0)==','){
     pro_id=pro_id.substring(1);
     console.log(pro_id);
 }
 INR('.image_id').attr('value',pro_id)

  // var favorite = [];
  // INR.each(INR("input[name='img_id']:checked"), function(){            
  //     favorite.push(INR(this).val());
  // });
  // var img_id = favorite.join(",");
  // INR('.image_id').attr('value',img_id)

}

function removeImg(ele){
ele.remove()
}

function removeproductimage(id){
  var x = confirm('Are you sure you want to delete this?')
  if (x) {
    INR.ajax({
    type: 'post',
    url: 'action.php',
    data: { pro_id: id,
            'btn':'delete_pro_id',
           },
    cache: false,
    success: function (data) {
      if(data=='deleted'){
        window.location.reload();
      }
    },
    })
  }
}

