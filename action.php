<?php
include('include/config.php');
INRuserid = INR_COOKIE["userID"];
if (INR_POST['btn'] == 'addToCartproduct') {
    INRimage = test_input(INR_POST['image']);
    INRname = test_input(INR_POST['name']);
    INRcategory = test_input(INR_POST['category']);
    INRsize = test_input(INR_POST['size']);
    INRprice = test_input(INR_POST['price']);
    INRpro_id = test_input(INR_POST['pro_id']);
    INRdiscounted_price = 0.0;
    INRshipping_charge = 0.0;
   // INRpriceWithoutCommas = str_replace(",", "", INRprice);    
    //INRquantity = intval(INRquantity);
    INRprice = floatval(INRprice);
    INRshipping_charge = floatval(INRshipping_charge);
    //  echo "<br>" .gettype(INRcart_save_amount);         
    INRselect_stmt2=INRconn->prepare("INSERT INTO cart(pro_id, pro_name, size, pro_category, pro_price, pro_img, pro_qty, sub_total, total, shipping_charge, discounted_price, userid, wishlist) value(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    INRselect_stmt2->execute([INRpro_id, INRname, INRsize, INRcategory, INRprice, INRimage, 1, INRprice, INRprice, INRshipping_charge, INRdiscounted_price, INRuserid, 0]);
    if(INRselect_stmt2) {
//        echo INRcart_quantitycode;
        echo "done";
    }
}

if (INR_POST['btn'] == "load_maincart_data") {
    INRcart_product = "";
    INRproduct_calculation = "";
    INRshipping_time = "";
    INRsaving_amnt = 0;
    INRtotal_amnt = 0;
    INRfinal_orgprice_round = 0;
    INRshipping_charges = 0;
    INRglobal_total = 0;
    INRglobal = false;
    INRfinalTotal=0;
    INRselect_stmt1 = INRconn->prepare("SELECT * FROM cart WHERE userid='INRuserid' && wishlist=0 ORDER BY id DESC");
    INRselect_stmt1->execute();
    INRcount = INRselect_stmt1->rowCount();
    if(INRcount>0){
        while (INRrow = INRselect_stmt1->fetch(PDO::FETCH_ASSOC)) {
            INRcartId = INRrow['id'];
            INRpro_name = INRrow['pro_name'];
            INRsize = INRrow['size'];
            INRpro_category = INRrow['pro_category'];
            INRpro_price = INRrow['pro_price'];
            INRpro_img = INRrow['pro_img'];
            INRpro_qty = INRrow['pro_qty'];
            INRsub_total = INRrow['sub_total'];
            INRtotal = INRrow['total'];

            INRcart_product.='<tr>
                                                                
            <td class="product-thumbnail  text-left">
                <div class="single-product">
                    <div class="product-img">
                        <a href="single-product.html"><img src="sanjary-admin/'.INRpro_img.'" alt="" /></a>
                    </div>
                    <div class="product-info">
                        <h4 class="post-title"><a class="text-light-black" href="#">'.INRpro_name.'</a></h4>
                        <p class="mb-0">Color :  Black</p>
                        <p class="mb-0">Size :     '.INRsize.'</p>
                    </div>
                </div>                
            </td>
            <td class="product-price">INR '.INRpro_price.'</td>
            <td class="product-quantity">
                <div class="cart-plus-minus">
                    <input type="text" value="01" name="qtybutton" class="cart-plus-minus-box">
                </div>
            </td>
            <td class="product-subtotal">INR '.INRtotal.'</td>
            <td class="product-remove">
                <a href="javascript:void(0)" onclick="deleteCartproduct('.INRcartId.')"><i class="zmdi zmdi-close"></i></a>
            </td>
        </tr>';











            // INRcart_product .= '<div class="card_p">
            //                        <div class="left__div">
            //                         <img src="https://admin.houseofsneakers.in/'.INRpro_img.'" alt="'.INRpro_img.'">
            //                             <div>
            //                                 <p>Adidas T-Shirt</p><span> '.INRpro_name.' </span>
            //                             </div>
            //                         </div>
            //                         <div class="right__div">
            //                             <div class="qty"><span>'.INRpro_qty.'</span>
            //                                 <div><i class="fa-solid fa-caret-down"></i>
            //                                     <i class="fa-solid fa-caret-down"></i>
            //                                 </div>
            //                             </div>
            //                             <div class="price">'.INRsub_total.'</div>
            //                                 <i class="fa-regular fa-trash-can" onclick="deleteCartproduct('.INRcartId.')"></i>
            //                         </div>
            //                     </div>';

    }

    }

                
                INRselect_strength_details=INRconn->prepare("SELECT SUM(total) AS totalPrice, SUM(shipping_charge) AS shipping FROM cart WHERE userid='INRuserid' && wishlist=0");
                INRselect_strength_details->execute();
                while(INRpriceTotal=INRselect_strength_details->fetch(PDO::FETCH_ASSOC)){
                    INRtotalCartPrice =  INRpriceTotal['totalPrice'];
                    INRshipping_charge =  INRpriceTotal['shipping'];
                   

                    INRfinalTotal =INRtotalCartPrice+INRshipping_charge;
                }

                INRfinalTotal = number_format((INRfinalTotal),2);
                // echo INRtotal_saving_amount;

    INRarr_data1 = array('datahtml' => INRcart_product, 'product_calculation' => INRfinalTotal, 'cart_product_count' => INRcount, 'subtotal_CartPrice'=> INRtotalCartPrice, 
    'shipping_total_price'=> INRshipping_charge, 'finalTotal'=> INRfinalTotal);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(INRarr_data1);
}
// update cart pop up start work
if (INR_POST['btn'] == 'updateCartproduct') {
    INRcartId = INR_POST['cartid'];
    INRcart_product_strength = "";
    INRcart_product_quantity = "";
    INRselect_stmt1 = INRconn->prepare("SELECT * FROM ogcart WHERE id='INRcartId' && wishlist=0");
    INRselect_stmt1->execute();
    INRquantity_array = array();
    while (INRrow = INRselect_stmt1->fetch(PDO::FETCH_ASSOC)) {
        INRproductCode = INRrow['productCode'];
        INRstrengthCode_cart = INRrow['strengthCode'];
        INRquantityCode = INRrow['quantityCode'];
        INRcart_quantity = INRrow['quantity'];
        INRcart_quantityPrice = INRrow['quantityPrice'];
        INRcart_totalPrice = INRrow['total'];
        INRorgPrice = INRrow['orgPrice'];
        INRcart_stregnth_name = getStrengthname(INRconn, INRstrengthCode_cart);
        INRproduct = getProductInfoByCode(INRconn, INRproductCode);
        INRproductName = INRproduct['name'];
        INRproductCategory = INRproduct['category'];
        INRproductType=INRproduct['productType'];

        if(strpos(INRproductCategory,'Steroids')>0){
            INRsteroid=true;
            INRgshipping=0;
        }
        elseif(strpos(INRproductName,'USA to USA')>0){
            INRustous = true;
            INRgshipping=0;
        }
        else{
            INRgeneric = true;
            INRgshipping=0;
        }

        INRdiscount = getDiscount(INRconn, INRquantityCode, INRstrengthCode_cart, INRproductCode, INRproductCategory);
        INRcart_quantity_discount = round(INRcart_quantityPrice - (INRcart_quantityPrice * (INRdiscount / 100)), 2);

        INRgetStrength = INRconn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
        INRgetStrength->execute([INRproductCode]);
        INRj = 1;
        while (INRstrengthRow = INRgetStrength->fetch(PDO::FETCH_ASSOC)) {
            INRstrengthName = INRstrengthRow['strengthName'];
            INRstrengthCode = INRstrengthRow['strengthCode'];

            if (INRstrengthCode == INRstrengthCode_cart) {
                INRActiveclass = 'show active';
                INRactive_ul_li = 'active';
                INRtoggle = 'true';
            } else {
                INRActiveclass = '';
                INRtoggle = 'false';
                INRactive_ul_li = '';
            }

            INRcart_product_strength .= '<li class="nav-item" role="presentation ' . INRstrengthName_cart . '">
                                                <button class="nav-link ' . INRactive_ul_li . '" id="strength-' . INRstrengthCode . '" data-bs-toggle="tab" data-bs-target="#cart_' . INRstrengthCode . '" type="button" role="tab" aria-controls="' . INRstrengthCode . '" aria-selected="' . INRtoggle . '">' . INRstrengthName . '</button>
                                              <input type="hidden" name="product_strength" class="cart_' . INRj . '" id="product_strength" value="' . INRstrengthName . '"/>      
                                            </li>';

            INRgetQuantity1 = INRconn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
            INRgetQuantity1->execute([INRstrengthCode, INRproductCode]);

            INRcart_product_quantity .= '<div class="tab-pane fade ' . INRActiveclass . '" id="cart_' . INRstrengthCode . '" role="tabpanel" aria-labelledby="strength-' . INRstrengthCode . '">
                                            <div class="qty-container">';

            while (INRquantityRow = INRgetQuantity1->fetch(PDO::FETCH_ASSOC)) {

                INRquantity = INRquantityRow['quantity'];
                INRquantityCode = INRquantityRow['quantityCode'];
                INRquantityPrice = INRquantityRow['price'];
                INRquantityOgPrice = INRquantityRow['ogprice'];
                INRtotal_quantity_price = INRquantityPrice * INRquantity;

                if(INRgeneric){
                    if(INRquantity>0 && INRquantity<=200){
                        INRgshipping = 10;
                    }
                    elseif(INRquantity>=201 && INRquantity<=300){
                        INRgshipping = 15;
                    }
                    elseif(INRquantity>=600){
                        INRgshipping = 25;
                    }
                }
                if(INRustous){
                    if(INRquantity>0){
                        INRgshipping = 0;
                    }                            
                }
                if(INRsteroid){
                    if(INRquantity>0 && INRquantity<3){
                        INRgshipping = 10;
                    }
                    elseif(INRquantity>0 && INRquantity<6){
                        INRgshipping = 20;
                    }
                    else{
                        INRgshipping = 40;
                    }                            
                }
                if (INRstrengthCode == INRstrengthCode_cart) {
                    if (INRcart_quantity == INRquantity) {
                        INRquantity_class = 'active';
                    } else {
                        INRquantity_class = "";
                    }
                }

                
                INRper_pill_price = INRquantityPrice-(INRquantityPrice*(INRdiscount_quantity/100));
                INRdiscount_total_price = INRtotal_quantity_price-(INRtotal_quantity_price*(INRdiscount_quantity/100));
                INRsavedAmount = INRtotal_quantity_price-INRdiscount_total_price;
                INRper_pill_price = number_format((INRper_pill_price),2);
                
//                INRdiscount_total_price = number_format((INRdiscount_total_price),2);

                INRtotal_quantity_price = number_format((INRtotal_quantity_price),2);
                INRsavedAmount = number_format((INRsavedAmount),2);

    
                //INRusatousa = usaToUsa(INRconn, INRproductName, INRstrengthName, INRdiscount_quantity);
               // INRquantity_discount = round(INRquantityPrice - (INRquantityPrice * (INRdiscount_quantity / 100)), 2);
                INRcart_product_quantity .= '<div class="qty-per-pill ' . INRquantity_class . '" onclick="test(this)" data-quantity="' . INRquantity . '" data-strength="' . INRj . '" data-product_strength="' . INRstrengthCode . '" data-cartProductid="' . INRcartId . '" data-productCode="' . INRproductCode . '" data-qty_code="' . INRquantityCode . '" data-qyt_prc="' . INRquantityPrice . '" data-discount="' . INRdiscount_quantity . '" data-product_orgPrice="'.INRtotal_quantity_price.'" data-discount_total_price="'.INRdiscount_total_price.'" data-savedAmount="'.INRsavedAmount.'" data-discount_per_pill_price="'.INRper_pill_price.'" data-shipping_charge="'.INRgshipping.'">
                                                                    <div class="str">' . INRquantity . '</div>
                                                                    <div class="qty"><p>INR' . INRper_pill_price . '/'.INRproductType.'
                                                                     </p><p>INR' . INRdiscount_total_price . '</p></div>
                                                                </div>';
            }
            INRcart_product_quantity .= '</div></div>';
            INRj++;
        }
        INRpill_calculation_strength .= '<div class="calculation">
                                            <div class="list">
                                                <span class="title">Strength</span>
                                                <span class="value ogprice Pill_Strength">'.INRcart_stregnth_name.'</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Quantity</span>
                                                <span class="value shippingCharges Pill_Quantity"><span class="success-icon"></span>'.INRcart_quantity.'</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Per Cost</span>
                                                <span class="value save-value Per_pill_cost">INR'.INRcart_quantity_discount.'</span>
                                            </div>
                                            <div class="list" style="border: none">
                                                <span class="total">To Pay</span>
                                                <span class="value finalprice toPay_total">INR'.INRcart_totalPrice.'</span>
                                            </div>
                                        </div>';
    }
    INRarr_data1 = array('cart_product_strength' => INRcart_product_strength, 'cart_product_quantity' => INRcart_product_quantity, 'product_cart_name' => INRproductName, 'pill_calculation_strength' => INRpill_calculation_strength);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(INRarr_data1);

}

if (INR_POST['btn'] == 'DeleteFromCartPage') {
    INRcartId = INR_POST['cartid'];
    INRdeleteCartProduct = INRconn->prepare('DELETE FROM cart WHERE id="' . INRcartId . '" && wishlist=0');
    INRdeleteCartProduct->execute();
    if (INRdeleteCartProduct) {
        echo "done";
    }
}


if(INR_POST['btn']=='AddedToWishlist'){
    INRcartId =  test_input(INR_POST['id']);
    INRaddToWishlist = INRconn->prepare('UPDATE ogcart SET wishlist=1 WHERE id="'.INRcartId.'"');
    INRaddToWishlist->execute();
    if(INRaddToWishlist){
        echo "done";
    }
}

if(INR_POST['btn']=="count_cart") {
    INRrowCount=INRconn->prepare("SELECT * FROM cart WHERE userID='INRuserid' && wishlist=0");
    INRrowCount->execute();
    INRcount = INRrowCount->rowCount();
    echo INRcount;
}

// add user address



if (INR_POST['btn'] == 'addUseraddress') {
    INRname = test_input(INR_POST['name']);
    INRemail = test_input(INR_POST['email']);
    INRphone = test_input(INR_POST['phone']);
    INRaddress = test_input(INR_POST['address']);
    INRpincode = test_input(INR_POST['pincode']);
    INRcity = test_input(INR_POST['city']);
    INRstate = test_input(INR_POST['state']);

    INRselect_stmt2=INRconn->prepare("INSERT INTO address(name, email, phone, address, pincode, city, state) value(?,?,?,?,?,?,?)");
    INRselect_stmt2->execute([INRname, INRemail, INRphone, INRaddress, INRpincode, INRcity, INRstate]);
    if(INRselect_stmt2) {
    INRorderId = "INV-" . date("ymdhis");
    INRselectCartProduct = INRconn->prepare("SELECT * FROM cart WHERE userId= 'INRuserid' && wishlist=0");
    INRselectCartProduct->execute();
    while (INRrow = INRselectCartProduct->fetch(PDO::FETCH_ASSOC))
    {
        INRpro_id = INRrow['pro_id'];
        INRpro_name = INRrow['pro_name'];
        INRsize = INRrow['size'];
        INRpro_category = INRrow['pro_category'];
        INRpro_price = INRrow['pro_price'];
        INRpro_img = INRrow['pro_img'];
        INRpro_qty = INRrow['pro_qty'];
        INRsub_total = INRrow['sub_total'];
        INRtotal = INRrow['total'];
        INRshipping_charge = INRrow['shipping_charge'];
        INRdiscounted_price = INRrow['discounted_price'];
        INRinsertProduct = INRconn->prepare("INSERT into orderproduct(orderid, pro_name, size, pro_category, pro_price, pro_img, pro_qty, sub_total,
        total, shipping_charge, discounted_price, userid) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        INRinsertProduct->execute([INRorderId, INRpro_name, INRsize, INRpro_category, INRpro_price, INRpro_img, INRpro_qty, INRsub_total, INRtotal, INRshipping_charge, INRdiscounted_price, INRuserid]);
    }
    INRallProductPrice = INRconn->prepare("SELECT SUM(total) AS totalPrice, SUM(discounted_price) AS discount  FROM cart WHERE userID='INRuserid' && wishlist=0");
    INRallProductPrice->execute();
    while (INRpriceTotal = INRallProductPrice->fetch(PDO::FETCH_ASSOC))
    {
        INRtotalCartPrice = INRpriceTotal['totalPrice'];
        INRdiscount = INRpriceTotal['discount'];
    }
    INRinsertOrderDetails = INRconn->prepare("INSERT INTO order_details(orderid, userid, totalPrice, discount, name, email, phone, address, pincode, city, state) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    INRinsertOrderDetails->execute([INRorderId, INRuserid, INRtotalCartPrice, INRdiscount, INRname, INRemail, INRphone, INRaddress, INRpincode, INRcity, INRstate]);
    if (INRinsertOrderDetails)
    {
        INRdeleteFromCart = INRconn->prepare("DELETE FROM cart WHERE userid=? && wishlist=0");
        INRdeleteFromCart->execute([INRuserid]);
    }
    echo "done";
  }

}


function test_input(INRdata) {
    INRdata = trim(INRdata);
    INRdata = stripslashes(INRdata);
    INRdata = htmlspecialchars(INRdata);
    return INRdata;
  }

?>