<?php
include('include/config.php');
$userid = $_COOKIE["userID"];
if ($_POST['btn'] == 'addToCartproduct') {
    $image = test_input($_POST['image']);
    $name = test_input($_POST['name']);
    $category = test_input($_POST['category']);
    $size = test_input($_POST['size']);
    $price = test_input($_POST['price']);
    $pro_id = test_input($_POST['pro_id']);
    $discounted_price = 0.0;
    $shipping_charge = 0.0;
   // $priceWithoutCommas = str_replace(",", "", $price);    
    //$quantity = intval($quantity);
    $price = floatval($price);
    $shipping_charge = floatval($shipping_charge);
    //  echo "<br>" .gettype($cart_save_amount);         
    $select_stmt2=$conn->prepare("INSERT INTO cart(pro_id, pro_name, size, pro_category, pro_price, pro_img, pro_qty, sub_total, total, shipping_charge, discounted_price, userid, wishlist) value(?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $select_stmt2->execute([$pro_id, $name, $size, $category, $price, $image, 1, $price, $price, $shipping_charge, $discounted_price, $userid, 0]);
    if($select_stmt2) {
//        echo $cart_quantitycode;
        echo "done";
    }
}

if ($_POST['btn'] == "load_maincart_data") {
    $cart_product = "";
    $product_calculation = "";
    $shipping_time = "";
    $saving_amnt = 0;
    $total_amnt = 0;
    $final_orgprice_round = 0;
    $shipping_charges = 0;
    $global_total = 0;
    $global = false;
    $finalTotal=0;
    $select_stmt1 = $conn->prepare("SELECT * FROM cart WHERE userid='$userid' && wishlist=0 ORDER BY id DESC");
    $select_stmt1->execute();
    $count = $select_stmt1->rowCount();
    if($count>0){
        while ($row = $select_stmt1->fetch(PDO::FETCH_ASSOC)) {
            $cartId = $row['id'];
            $pro_name = $row['pro_name'];
            $size = $row['size'];
            $pro_category = $row['pro_category'];
            $pro_price = $row['pro_price'];
            $pro_img = $row['pro_img'];
            $pro_qty = $row['pro_qty'];
            $sub_total = $row['sub_total'];
            $total = $row['total'];

            $cart_product.='<tr>
                                                                
            <td class="product-thumbnail  text-left">
                <div class="single-product">
                    <div class="product-img">
                        <a href="single-product.html"><img src="sanjary-admin/'.$pro_img.'" alt="" /></a>
                    </div>
                    <div class="product-info">
                        <h4 class="post-title"><a class="text-light-black" href="#">'.$pro_name.'</a></h4>
                        <p class="mb-0">Color :  Black</p>
                        <p class="mb-0">Size :     '.$size.'</p>
                    </div>
                </div>                
            </td>
            <td class="product-price">INR '.$pro_price.'</td>
            <td class="product-quantity">
                <div class="cart-plus-minus">
                    <input type="text" value="01" name="qtybutton" class="cart-plus-minus-box">
                </div>
            </td>
            <td class="product-subtotal">INR '.$total.'</td>
            <td class="product-remove">
                <a href="javascript:void(0)" onclick="deleteCartproduct('.$cartId.')"><i class="zmdi zmdi-close"></i></a>
            </td>
        </tr>';











            // $cart_product .= '<div class="card_p">
            //                        <div class="left__div">
            //                         <img src="https://admin.houseofsneakers.in/'.$pro_img.'" alt="'.$pro_img.'">
            //                             <div>
            //                                 <p>Adidas T-Shirt</p><span> '.$pro_name.' </span>
            //                             </div>
            //                         </div>
            //                         <div class="right__div">
            //                             <div class="qty"><span>'.$pro_qty.'</span>
            //                                 <div><i class="fa-solid fa-caret-down"></i>
            //                                     <i class="fa-solid fa-caret-down"></i>
            //                                 </div>
            //                             </div>
            //                             <div class="price">'.$sub_total.'</div>
            //                                 <i class="fa-regular fa-trash-can" onclick="deleteCartproduct('.$cartId.')"></i>
            //                         </div>
            //                     </div>';

    }

    }

                
                $select_strength_details=$conn->prepare("SELECT SUM(total) AS totalPrice, SUM(shipping_charge) AS shipping FROM cart WHERE userid='$userid' && wishlist=0");
                $select_strength_details->execute();
                while($priceTotal=$select_strength_details->fetch(PDO::FETCH_ASSOC)){
                    $totalCartPrice =  $priceTotal['totalPrice'];
                    $shipping_charge =  $priceTotal['shipping'];
                   

                    $finalTotal =$totalCartPrice+$shipping_charge;
                }

                $finalTotal = number_format(($finalTotal),2);
                // echo $total_saving_amount;

    $arr_data1 = array('datahtml' => $cart_product, 'product_calculation' => $finalTotal, 'cart_product_count' => $count, 'subtotal_CartPrice'=> $totalCartPrice, 
    'shipping_total_price'=> $shipping_charge, 'finalTotal'=> $finalTotal);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data1);
}
// update cart pop up start work
if ($_POST['btn'] == 'updateCartproduct') {
    $cartId = $_POST['cartid'];
    $cart_product_strength = "";
    $cart_product_quantity = "";
    $select_stmt1 = $conn->prepare("SELECT * FROM ogcart WHERE id='$cartId' && wishlist=0");
    $select_stmt1->execute();
    $quantity_array = array();
    while ($row = $select_stmt1->fetch(PDO::FETCH_ASSOC)) {
        $productCode = $row['productCode'];
        $strengthCode_cart = $row['strengthCode'];
        $quantityCode = $row['quantityCode'];
        $cart_quantity = $row['quantity'];
        $cart_quantityPrice = $row['quantityPrice'];
        $cart_totalPrice = $row['total'];
        $orgPrice = $row['orgPrice'];
        $cart_stregnth_name = getStrengthname($conn, $strengthCode_cart);
        $product = getProductInfoByCode($conn, $productCode);
        $productName = $product['name'];
        $productCategory = $product['category'];
        $productType=$product['productType'];

        if(strpos($productCategory,'Steroids')>0){
            $steroid=true;
            $gshipping=0;
        }
        elseif(strpos($productName,'USA to USA')>0){
            $ustous = true;
            $gshipping=0;
        }
        else{
            $generic = true;
            $gshipping=0;
        }

        $discount = getDiscount($conn, $quantityCode, $strengthCode_cart, $productCode, $productCategory);
        $cart_quantity_discount = round($cart_quantityPrice - ($cart_quantityPrice * ($discount / 100)), 2);

        $getStrength = $conn->prepare('SELECT * FROM ogstrength WHERE productCode=? ORDER BY strengthName ASC');
        $getStrength->execute([$productCode]);
        $j = 1;
        while ($strengthRow = $getStrength->fetch(PDO::FETCH_ASSOC)) {
            $strengthName = $strengthRow['strengthName'];
            $strengthCode = $strengthRow['strengthCode'];

            if ($strengthCode == $strengthCode_cart) {
                $Activeclass = 'show active';
                $active_ul_li = 'active';
                $toggle = 'true';
            } else {
                $Activeclass = '';
                $toggle = 'false';
                $active_ul_li = '';
            }

            $cart_product_strength .= '<li class="nav-item" role="presentation ' . $strengthName_cart . '">
                                                <button class="nav-link ' . $active_ul_li . '" id="strength-' . $strengthCode . '" data-bs-toggle="tab" data-bs-target="#cart_' . $strengthCode . '" type="button" role="tab" aria-controls="' . $strengthCode . '" aria-selected="' . $toggle . '">' . $strengthName . '</button>
                                              <input type="hidden" name="product_strength" class="cart_' . $j . '" id="product_strength" value="' . $strengthName . '"/>      
                                            </li>';

            $getQuantity1 = $conn->prepare('SELECT * FROM ogquantity WHERE strengthCode=? AND productCode=? AND quantity!=120 ORDER BY quantity ASC ');
            $getQuantity1->execute([$strengthCode, $productCode]);

            $cart_product_quantity .= '<div class="tab-pane fade ' . $Activeclass . '" id="cart_' . $strengthCode . '" role="tabpanel" aria-labelledby="strength-' . $strengthCode . '">
                                            <div class="qty-container">';

            while ($quantityRow = $getQuantity1->fetch(PDO::FETCH_ASSOC)) {

                $quantity = $quantityRow['quantity'];
                $quantityCode = $quantityRow['quantityCode'];
                $quantityPrice = $quantityRow['price'];
                $quantityOgPrice = $quantityRow['ogprice'];
                $total_quantity_price = $quantityPrice * $quantity;

                if($generic){
                    if($quantity>0 && $quantity<=200){
                        $gshipping = 10;
                    }
                    elseif($quantity>=201 && $quantity<=300){
                        $gshipping = 15;
                    }
                    elseif($quantity>=600){
                        $gshipping = 25;
                    }
                }
                if($ustous){
                    if($quantity>0){
                        $gshipping = 0;
                    }                            
                }
                if($steroid){
                    if($quantity>0 && $quantity<3){
                        $gshipping = 10;
                    }
                    elseif($quantity>0 && $quantity<6){
                        $gshipping = 20;
                    }
                    else{
                        $gshipping = 40;
                    }                            
                }
                if ($strengthCode == $strengthCode_cart) {
                    if ($cart_quantity == $quantity) {
                        $quantity_class = 'active';
                    } else {
                        $quantity_class = "";
                    }
                }

                
                $per_pill_price = $quantityPrice-($quantityPrice*($discount_quantity/100));
                $discount_total_price = $total_quantity_price-($total_quantity_price*($discount_quantity/100));
                $savedAmount = $total_quantity_price-$discount_total_price;
                $per_pill_price = number_format(($per_pill_price),2);
                
//                $discount_total_price = number_format(($discount_total_price),2);

                $total_quantity_price = number_format(($total_quantity_price),2);
                $savedAmount = number_format(($savedAmount),2);

    
                //$usatousa = usaToUsa($conn, $productName, $strengthName, $discount_quantity);
               // $quantity_discount = round($quantityPrice - ($quantityPrice * ($discount_quantity / 100)), 2);
                $cart_product_quantity .= '<div class="qty-per-pill ' . $quantity_class . '" onclick="test(this)" data-quantity="' . $quantity . '" data-strength="' . $j . '" data-product_strength="' . $strengthCode . '" data-cartProductid="' . $cartId . '" data-productCode="' . $productCode . '" data-qty_code="' . $quantityCode . '" data-qyt_prc="' . $quantityPrice . '" data-discount="' . $discount_quantity . '" data-product_orgPrice="'.$total_quantity_price.'" data-discount_total_price="'.$discount_total_price.'" data-savedAmount="'.$savedAmount.'" data-discount_per_pill_price="'.$per_pill_price.'" data-shipping_charge="'.$gshipping.'">
                                                                    <div class="str">' . $quantity . '</div>
                                                                    <div class="qty"><p>$' . $per_pill_price . '/'.$productType.'
                                                                     </p><p>$' . $discount_total_price . '</p></div>
                                                                </div>';
            }
            $cart_product_quantity .= '</div></div>';
            $j++;
        }
        $pill_calculation_strength .= '<div class="calculation">
                                            <div class="list">
                                                <span class="title">Strength</span>
                                                <span class="value ogprice Pill_Strength">'.$cart_stregnth_name.'</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Quantity</span>
                                                <span class="value shippingCharges Pill_Quantity"><span class="success-icon"></span>'.$cart_quantity.'</span>
                                            </div>
                                            <div class="list">
                                                <span class="title">Per Cost</span>
                                                <span class="value save-value Per_pill_cost">$'.$cart_quantity_discount.'</span>
                                            </div>
                                            <div class="list" style="border: none">
                                                <span class="total">To Pay</span>
                                                <span class="value finalprice toPay_total">$'.$cart_totalPrice.'</span>
                                            </div>
                                        </div>';
    }
    $arr_data1 = array('cart_product_strength' => $cart_product_strength, 'cart_product_quantity' => $cart_product_quantity, 'product_cart_name' => $productName, 'pill_calculation_strength' => $pill_calculation_strength);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data1);

}

if ($_POST['btn'] == 'DeleteFromCartPage') {
    $cartId = $_POST['cartid'];
    $deleteCartProduct = $conn->prepare('DELETE FROM cart WHERE id="' . $cartId . '" && wishlist=0');
    $deleteCartProduct->execute();
    if ($deleteCartProduct) {
        echo "done";
    }
}


if($_POST['btn']=='AddedToWishlist'){
    $cartId =  test_input($_POST['id']);
    $addToWishlist = $conn->prepare('UPDATE ogcart SET wishlist=1 WHERE id="'.$cartId.'"');
    $addToWishlist->execute();
    if($addToWishlist){
        echo "done";
    }
}

if($_POST['btn']=="count_cart") {
    $rowCount=$conn->prepare("SELECT * FROM cart WHERE userID='$userid' && wishlist=0");
    $rowCount->execute();
    $count = $rowCount->rowCount();
    echo $count;
}

// add user address



if ($_POST['btn'] == 'addUseraddress') {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $phone = test_input($_POST['phone']);
    $address = test_input($_POST['address']);
    $pincode = test_input($_POST['pincode']);
    $city = test_input($_POST['city']);
    $state = test_input($_POST['state']);

    $select_stmt2=$conn->prepare("INSERT INTO address(name, email, phone, address, pincode, city, state) value(?,?,?,?,?,?,?)");
    $select_stmt2->execute([$name, $email, $phone, $address, $pincode, $city, $state]);
    if($select_stmt2) {
    $orderId = "INV-" . date("ymdhis");
    $selectCartProduct = $conn->prepare("SELECT * FROM cart WHERE userId= '$userid' && wishlist=0");
    $selectCartProduct->execute();
    while ($row = $selectCartProduct->fetch(PDO::FETCH_ASSOC))
    {
        $pro_id = $row['pro_id'];
        $pro_name = $row['pro_name'];
        $size = $row['size'];
        $pro_category = $row['pro_category'];
        $pro_price = $row['pro_price'];
        $pro_img = $row['pro_img'];
        $pro_qty = $row['pro_qty'];
        $sub_total = $row['sub_total'];
        $total = $row['total'];
        $shipping_charge = $row['shipping_charge'];
        $discounted_price = $row['discounted_price'];
        $insertProduct = $conn->prepare("INSERT into orderproduct(orderid, pro_name, size, pro_category, pro_price, pro_img, pro_qty, sub_total,
        total, shipping_charge, discounted_price, userid) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $insertProduct->execute([$orderId, $pro_name, $size, $pro_category, $pro_price, $pro_img, $pro_qty, $sub_total, $total, $shipping_charge, $discounted_price, $userid]);
    }
    $allProductPrice = $conn->prepare("SELECT SUM(total) AS totalPrice, SUM(discounted_price) AS discount  FROM cart WHERE userID='$userid' && wishlist=0");
    $allProductPrice->execute();
    while ($priceTotal = $allProductPrice->fetch(PDO::FETCH_ASSOC))
    {
        $totalCartPrice = $priceTotal['totalPrice'];
        $discount = $priceTotal['discount'];
    }
    $insertOrderDetails = $conn->prepare("INSERT INTO order_details(orderid, userid, totalPrice, discount, name, email, phone, address, pincode, city, state) VALUES(?,?,?,?,?,?,?,?,?,?,?)");
    $insertOrderDetails->execute([$orderId, $userid, $totalCartPrice, $discount, $name, $email, $phone, $address, $pincode, $city, $state]);
    if ($insertOrderDetails)
    {
        $deleteFromCart = $conn->prepare("DELETE FROM cart WHERE userid=? && wishlist=0");
        $deleteFromCart->execute([$userid]);
    }
    echo "done";
  }

}


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

?>