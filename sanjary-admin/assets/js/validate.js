//product
INR('#product_form').validate({
  rules: {
    pro_name: 'required',
    desc: 'required',
    category: {
      required: true,
    },
    // img_id: {
    //   required: true,
    // },
  },
  messages: {},
  submitHandler: function (form) {
    INR.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        console.log(data);
        if (data.includes("inserted")) {
          var id = data.substr(8);
          window.location.href = "product_update.php?id=" + id + "&status=add";
        } else {
          alert("Enter Valid " + data);
          INR('#' + data).focus();
        }

      },
    })
  },
})

INR('#updateProduct').validate({
  rules: {
    pro_name: 'required',
    desc: 'required',
    category: {
      required: true,
    },
    // color: {
    //   required: true,
    // },
    // size: {
    //   required: true,
    // },
    // img_id: {
    //   required: true,
    // },
  },
  messages: {},
  submitHandler: function (form) {
    INR.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if(data=='updated'){
          alert("Product Updated")
          window.location.reload();
        }        
      },
    })
  },
});

INR('#user_form').validate({
  rules: {
    name: 'required',
    username: 'required',
    pwd: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {},
  submitHandler: function (form) {
    INR.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if(data == 'inserted'){
          alert("User Added Successfully")
          window.location.reload();
        }
      },
    })
  },
})

INR('#Updateuser').validate({
  rules: {
    name: 'required',
    username: 'required',
    pwd: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {},
  submitHandler: function (form) {
    INR.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        if(data == 'updated'){
          alert("User Updated Successfully")
          window.location.reload();
        }
      },
    })
  },
})
//
INR('#addCategory').validate({
  rules: {
    category: 'required',
    title: 'required',
    content: { required: true },
    slug: { required: true },
    cat_name: {
      required: true,
    },
    desc: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {
    title: 'Please Enter  Title',
    category: 'Please Select Category',
    img_id: 'Select Image',
  },
  submitHandler: function (form) {
    alert('validated form')
    INR.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        alert(data)
        console.log(data)
      },
    })
  },
})
// update category
INR('#updateCategory').validate({
  rules: {
    category: 'required',
    title: 'required',
    content: { required: true },
    slug: { required: true },
    cat_name: {
      required: true,
    },
    desc: {
      required: true,
    },
    img_id: {
      required: true,
    },
  },
  messages: {
    title: 'Please Enter  Title',
    category: 'Please Select Category',
    img_id: 'Select Image',
  },
  submitHandler: function (form) {
    alert('update validated form')
    INR.ajax({
      url: 'action.php',
      type: 'post',
      data: new FormData(form),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        alert(data)
        console.log(data)
      },
    })
  },
})