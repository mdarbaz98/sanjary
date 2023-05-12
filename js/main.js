function addTocart(x){
    var id = $(x).data('proid');
    var name = $(x).data('name');
    var category = $(x).data('category');
    alert(category);
    var img = $(x).data('proimg');
    var price = $(x).data('price');
    var qty = $(x).data('qty');
    var userid = $(x).data('userid');    
    $.ajax({
        type: 'POST',
        url: 'include/action.php',
        dataType: 'json',
        data: {
          btn: 'addTocart',
          pro_name: name,
          pro_category: category,
          pro_price: price,
          pro_qty: qty,
          pro_img: img,
          pro_id:id,
          userid: userid,
        },
        success: function (data) {
          var json = $.parseJSON(JSON.stringify(data))
          var carthtml = json.cart_html
          var cartcount = json.cart_count
          console.log(carthtml);
          
          var array = carthtml.split(",");
          var data_content = array[1];
          
          $('#total_product_count').html(cartcount);
          $('#get_updated_carProduct').html(data_content);
         

         
          
          
          // var array = data.split(",");
          //   var done = array[0];
          //   var count = array[1];
          //    if(done=='inserted')
          //     {
          //       $('#total_product_count').html(count);
          //     }
        },
      });
 }
 function addTowishlist(x){
  var id = $(x).data('proid');
  var name = $(x).data('name');
  var category = $(x).data('category');
  alert(category);
  var img = $(x).data('proimg');
  var price = $(x).data('price');
  var qty = $(x).data('qty');
  var userid = $(x).data('userid');    
  $.ajax({
      type: 'POST',
      url: 'include/action.php',
      dataType: 'json',
      data: {
        btn: 'addTowishlist',
        pro_name: name,
        pro_category: category,
        pro_price: price,
        pro_qty: qty,
        pro_img: img,
        pro_id:id,
        userid: userid,
      },
      success: function (data) {
        var json = $.parseJSON(JSON.stringify(data))
        var carthtml = json.cart_html
        var cartcount = json.cart_count
        console.log(carthtml);
        
        var array = carthtml.split(",");
        var data_content = array[1];
        
        $('#total_product_count').html(cartcount);
        $('#get_updated_carProduct').html(data_content);
       

       
        
        
        // var array = data.split(",");
        //   var done = array[0];
        //   var count = array[1];
        //    if(done=='inserted')
        //     {
        //       $('#total_product_count').html(count);
        //     }
      },
    });
 }

  //getAllupdatedcartProduct();
function getAllupdatedcartProduct(){
    $.ajax({
    type: 'POST',
    url: 'include/action.php',
    dataType: 'html',
    data: {
      btn: 'getAllupdatedcartProduct',
    },
    success: function (data) {
             console.log(data);
             console.log(typeof data);
            var array = data.split(",");
           
            var count = array[0];
            // var total_price = array[1];
            var data_content = array[1];
          

          //    if(done=='inserted')
          //     {


    //alert("get cart"+ data)
      $('#total_product_count').html(count);
      $('#get_updated_carProduct').html(data_content);
      //$('#cart_totalPrice').html(total_price); 
    },
  });
}


function deleteCart(cart_id){ 
  $.ajax({
    type: 'POST',
    url: 'include/action.php',
    dataType: 'html',
    data: {
      btn: 'deleteCart',
      cart_id: cart_id,
    },
    success: function (data) {
      alert("delete");
      getAllupdatedcartProduct()
      
    },
  });
}

function addQuantity(cart_id,userid){
  $.ajax({
    type: 'POST',
    url: 'include/action.php',
    dataType: 'json',
    data: {
      btn: 'addQuantity',
      cart_id: cart_id,
      userid: userid,
    },
    success: function (data) {
      var json = $.parseJSON(JSON.stringify(data))
      var qty = json.qty
      var sub_total = json.sub_total
      var total_price = json.total_price

      $('#change_qty').html(qty);
      $('#change_subtotal').html(sub_total);
      $('#change_totalPrice').html(total_price);
      
    },
  });
}

function removeQuantity(cart_id,userid){
  $.ajax({
    type: 'POST',
    url: 'include/action.php',
    dataType: 'json',
    data: {
      btn: 'removeQuantity',
      cart_id: cart_id,
      userid: userid,
    },
    success: function (data) {
      var json = $.parseJSON(JSON.stringify(data))
      var qty = json.qty
      var sub_total = json.sub_total
      var total_price = json.total_price
      $('#change_qty').html(qty);
      $('#change_subtotal').html(sub_total);
      $('#change_totalPrice').html(total_price);
      
    },
  });
}