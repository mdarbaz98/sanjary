function getSizeprice(x){
    var price = INR(x).data('price');
    var dprice = INR(x).data('dprice');
    var size = INR(x).data('size');
    INR(`.sizeProduct_price`).html(price);
  }
  
  //product add into cart
  function addProductToCart(x){
      var image = INR(x).data('image');
      var name = INR(x).data('pro_name');
      var category = INR(x).data('category');
      var price = INR(x).data('price');
      var size = INR(x).data('size');
      var pro_id = INR(x).data('pro_id');
      var btn = 'addToCartproduct';
      INR.ajax ({
        url: 'action.php',
        type: 'post',
        dataType: 'html',
        data: {'btn':btn,
               'image':image,
               'name':name,
               'category':category,
               'price':price,
               'size':size,
               'pro_id':pro_id
                },
                beforeSend: function () {
                  INR(".content").css("opacity", 0.5);
                  INR(".btn-ring-addtocart").show();
                },
        success: function(data) {
                console.log(data)
                if(data){
                  // var success_cart_btn =`
                  // <a class="add_to_cart" href="cart.php" id="setaddProductToCart" />Checkout</a>`;
  
                  // INR(`#setaddProductToCart`).parent().attr("onclick", "").html(success_cart_btn);
  
                  // INR(`[data-quantitycode=INR{data}]`).attr('data-cart',"yes");
                  
                  // INR(".content").css("opacity", 1);
                  // INR(".btn-ring-addtocart").hide();
                  
                  //load_cart();
                  count_cart();
                  getCart()
                  
                }
              }
        });
  }
  
  function getCart() {
      var btn = "load_maincart_data";
      INR.ajax({
        url: "action.php",
        type: "post",
        dataType: "json",
        data: { btn: btn },
        beforeSend: function () {
          INR(".loader-bg").show();
        },
        success: function (data) {
          var json = INR.parseJSON(JSON.stringify(data));
          var cart_product_count = json.cart_product_count;
          var htmldata = json.datahtml;
          var product_calculation = json.product_calculation;
          var shipping_total_price = json.shipping_total_price;
          var finalTotal = json.finalTotal;
  
          // var total_saving_amount = json.total_saving_amount;
          // var final_total_amount = json.final_total_amount;
          // console.log(shipping_total_price);
          
          if(shipping_total_price==0){ 
            var shipping_free=`<span class="success-icon"><i class="fa-solid fa-circle-check"></i></span>FREE`;
            INR(`.total_shipping_amount`).html(shipping_free);
            }else{
            INR(`.total_shipping_amount`).html("INR"+shipping_total_price);
            }
  
          INR(".cart_total_product").html(cart_product_count);
          INR(".cartProductlisting").html(htmldata);
          INR(".cart_subtotal").html("INR "+product_calculation);
          INR(".product_shipping").html(shipping_total_price);
          INR(".final_cartTotal").html("INR "+finalTotal);
          
          // INR(".loader-bg").hide();
        },
      });
    }
    getCart();
    
    function deleteCartproduct(id) {
      var btn = "DeleteFromCartPage";
      INR.ajax({
        url: "action.php",
        type: "post",
        dataType: "html",
        data: { btn: btn, cartid: id },
        success: function (data) {
          if (data == "done") {
            //snackbar('Item Removed');
            // if(currentPage1.includes('cart')){
            //     load_main_cart();
            //     loadCoupan();
            // }
            // if(currentPage1.includes('checkout')){
            //     load_checkout();
            // }
            // if(pageName=='ProductPage'){
            //     loadMainStrength();
            // }
    
            getCart();
            count_cart();
          }
        },
      });
    }
    function emptyCartproduct() {
      var btn = "RemoveAllcartproduct";
      snackbar("Deleting Cart ...");
      INR.ajax({
        url: "new_action.php",
        type: "post",
        dataType: "html",
        data: { btn: btn },
    
        success: function (data) {
          if (data == "done") {
            getCart();
            count_cart();
            //count_cart();
          }
        },
      });
    }
    
    function cartProductupdate(id) {
      var btn = "updateCartproduct";
      INR.ajax({
        url: "new_action.php",
        type: "post",
        dataType: "json",
        data: { btn: btn, cartid: id },
        beforeSend: function () {
          INR(".loader-bg").show();
        },
        success: function (data) {
          var json = INR.parseJSON(JSON.stringify(data));
          var cart_product_strength = json.cart_product_strength;
          var cart_product_quantity = json.cart_product_quantity;
          var product_cart_name = json.product_cart_name;
          var pill_calculation_strength = json.pill_calculation_strength;
    
          INR(".strength-section").html(cart_product_strength);
          INR("#productTabContent").html(cart_product_quantity);
          INR(".product_cart_name").html(product_cart_name);
          INR(".pill-strength-calculation").html(pill_calculation_strength);
          INR("#cartProduct_update").modal("show");
          INR(".loader-bg").hide();
          // if(data=='done'){
              getCart();
              count_cart();
          // }
        },
      });
    }
  
    function addToWishlist(x) {
      var id = INR(x).attr("id");
      var btn = "AddedToWishlist";
      snackbar("Adding to wishlist...");
      INR.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn, id: id },
        success: function (data) {
          if (data == "done") {
            snackbar("Added to Wishlist");
            if (currentPage1.includes("cart")) {
              load_main_cart();
              loadCoupan();
            }
            if (currentPage1.includes("checkout")) {
              load_checkout();
            }
            if (pageName == "ProductPage") {
              loadMainStrength();
            }
            load_cart();
            count_cart();
          }
        },
      });
    }
  
    function load_for_active_class_call() {
      INR(".size_accordion .active").click();
    }
    load_for_active_class_call();

    function count_cart() {
      var btn = "count_cart";
      INR.ajax({
        url: "action.php",
        type: "post",
        data: { btn: btn },
        success: function (data) {
          INR(".total-item-cart").html(data);
        },
      });
    }
    count_cart();

    // register for validation 
INR(function() {
  INR("form[name='userOrderplace']").validate({
    // Specify validation rules
    rules: {
      name: {
        minlength: 3,
                    maxlength: 30,
                    //pattern: "^[a-zA-Z_]*INR",
                    required: true
      },
      email: {
        required: true,
        email: true
      },
      phone: {
        required: true,
        minlength: 10,
        maxlength: 10,
      },
      address: {
        minlength: 3,
                    maxlength: 30,
                    //pattern: "^[a-zA-Z_]*INR",
                    required: true
      },pincode: {
        minlength: 3,
                    maxlength: 30,
                    //pattern: "^[a-zA-Z_]*INR",
                    required: true
      },state: {
                    //minlength: 3,
                    //maxlength: 30,
                    //pattern: "^[a-zA-Z_]*INR",
                    required: true
      },
      city: {
                    //minlength: 3,
                    //maxlength: 30,
                    //pattern: "^[a-zA-Z_]*INR",
                    required: true
      },
    },
    // Specify validation error messages
    messages: {
      name: {
        minlength:"min length should be 3",
        maxlength:"min length should be 30",
        //pattern: "should be alphabet",
        required:"Please enter your first name"
      },
      lname: {
        minlength:"min length should be 3",
        maxlength:"min length should be 30",
        //pattern: "should be alphabet",
        required:"Please enter your last name"
      },
      email: "Please enter a valid email address",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 6 characters long"
      },
    },
    submitHandler: function(form) {
          var formData = new FormData(form);
          var url = window.location.href;
          INR.ajax({
            url: "action.php",
            type: "post",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
            alert(data);
   //             window.location.replace(url);
            
            },
          });
        }
  });
});