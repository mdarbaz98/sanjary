<?php
date_default_timezone_set("Asia/Kolkata");
$userid = $_COOKIE['userid'];
include('db.php');
// if($_POST['btn']=='getCartproduct'){
//     $stmt = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
//     $stmt->execute([$_POST['userid']]);
//     $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
//     echo $userCount=$stmt->rowCount();
       
// }

if($_POST['btn']=='addTocart'){
$add_cart_insert = $conn->prepare('INSERT INTO cart(pro_name, pro_category, pro_price, pro_img, pro_qty, sub_total, userid)VALUES(?,?,?,?,?,?,?)');
$add_cart_insert->execute([$_POST['pro_name'], $_POST['pro_category'], $_POST['pro_price'], $_POST['pro_img'], $_POST['pro_qty'], $_POST['pro_price'], $_POST['userid']]);   
    $stmt = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
    $stmt->execute([$_POST['userid']]);
    $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $userCount=$stmt->rowCount();
    $data = cartProduct($conn);
    $arr_data = array('cart_html' => $data,'cart_count' => $userCount, 'total_price' => $userCount);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($arr_data);

}
if($_POST['btn']=='addTowishlist'){
    $add_wishlist_insert = $conn->prepare('INSERT INTO wishlist(pro_name, pro_category, pro_price, pro_img, pro_qty, sub_total, userid)VALUES(?,?,?,?,?,?,?)');
    $add_wishlist_insert->execute([$_POST['pro_name'], $_POST['pro_category'], $_POST['pro_price'], $_POST['pro_img'], $_POST['pro_qty'], $_POST['pro_price'], $_POST['userid']]);   

        $stmt = $conn->prepare("SELECT * FROM `wishlist` WHERE userid=?");
        $stmt->execute([$_POST['userid']]);
        $user_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $userCount=$stmt->rowCount();

        // $data = cartProduct($conn);
        // $arr_data = array('cart_html' => $data,'cart_count' => $userCount, 'total_price' => $userCount);
        // header('Content-Type: application/json; charset=utf-8');
        // echo json_encode($arr_data);
    
    }

if($_POST['btn']=='checkout_form'){
    $add_checkout_insert = $conn->prepare('INSERT INTO cart(pro_name, pro_price, pro_img, pro_qty, userid)VALUES(?,?,?,?,?)');
    $add_checkout_insert->execute([$_POST['pro_name'], $_POST['pro_price'], $_POST['pro_img'], $_POST['pro_qty'], $_POST['userid']]);
    echo "inserted";
}
if($_POST['btn']=='checkout_details'){
   
    $order_id = date('YmdHis');

    if(!empty($_POST['email'])){
        $stmt = $conn->prepare("SELECT * FROM `customer_details` WHERE email=?");
        $stmt->execute([$_POST['email']]);
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);
        $userCount=$stmt->rowCount();
        if($userCount==0){
            
            $add_customer_insert = $conn->prepare('INSERT INTO customer_details(userid, name, email, phone)VALUES(?,?,?,?)');
            $add_customer_insert->execute([$_POST['userid'], $_POST['full_name'], $_POST['email'], $_POST['phone']]);
        }
        else{
            $userid = $user_data['userid'];
        }

        $add_address_insert = $conn->prepare('INSERT INTO address(address, city, state, pincode, userid)VALUES(?,?,?,?,?)');
        $add_address_insert->execute([$_POST['address'], $_POST['city'], $_POST['state'], $_POST['post_code'], $userid]);
        
        $stmt_cart = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
        $stmt_cart->execute([$userid]);
        while($user_cart_data = $stmt_cart->fetch(PDO::FETCH_ASSOC)){
            $add_order_insert = $conn->prepare('INSERT INTO order_product(pro_name, pro_category, pro_price, pro_img, pro_qty, sub_total, userid, order_id)VALUES(?,?,?,?,?,?,?,?)');
            $add_order_insert->execute([$user_cart_data['pro_name'], $user_cart_data['pro_category'], $user_cart_data['pro_price'], $user_cart_data['pro_img'], $user_cart_data['pro_qty'], $user_cart_data['sub_total'], $user_cart_data['userid'], $order_id]);
            }

        $stmt_total_price = $conn->prepare("SELECT SUM(sub_total) AS total_price FROM `order_product` WHERE userid=?");
        $stmt_total_price->execute([$userid]);
        $user_data = $stmt_total_price->fetch(PDO::FETCH_ASSOC);
        $sub_total = $user_data['total_price'];
        $shipping=20;
        $discount=40;
        $order_date = date('Y-m-d H:i:s');
        $total = ($sub_total-$discount)+$shipping;
        $add_order_detail_insert = $conn->prepare('INSERT INTO order_details(invoice_id, userid, disc_price, shipping_charges, sub_total, total, name, email, phone, address, city, pincode, state, payment_mode, order_date)VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $add_order_detail_insert->execute([$order_id, $userid, $discount, $shipping, $sub_total, $total, $_POST['full_name'], $_POST['email'], $_POST['phone'], $_POST['address'], $_POST['city'], $_POST['post_code'], $_POST['state'], $_POST['payment-method'], $order_date]);
        echo "done";
        
    } 
}

if($_POST['btn']=='deleteCart'){
        $cart_id = $_POST['cart_id'];
        $delete_cart = $conn->prepare('DELETE FROM `cart` WHERE id=?');
        $delete_cart->execute([$cart_id]);

        echo "deleted";
}
if($_POST['btn']=='getAllupdatedcartProduct'){
    // $stmt = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
    // $stmt->execute([$userid]);
    // $userCount=$stmt->rowCount(); 
    echo $data = cartProduct($conn);
    //echo $cart_data =$userCount.",".$data;

}
if($_POST['btn']=='addQuantity'){

        $sub_total=0;
        $cartTotal=0;
        $shipping_charges=20;
        $cart_id = $_POST['cart_id'];
        $cart_userid = $_POST['userid'];
        $qty_stmt = $conn->prepare("SELECT * FROM `cart` WHERE id=?");
        $qty_stmt->execute([$cart_id]);
        while ($row = $qty_stmt->fetch(PDO::FETCH_ASSOC)){
         $qty=$row['pro_qty'];
         $price = $row['pro_price'];
         
         $total_qty=$qty+1;   
         
         $sub_total = $sub_total+($price * $total_qty);   
         $qty_cart = $conn->prepare('UPDATE `cart` SET `pro_qty`=?,`sub_total`=? WHERE id=?');
         $qty_cart->execute([$total_qty, $sub_total, $cart_id]);   
        
         $get_allcart_stmt = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
         $get_allcart_stmt->execute([$cart_userid]);
         while ($row = $get_allcart_stmt->fetch(PDO::FETCH_ASSOC)){
         $sub_qty=$row['pro_qty']; 
         $sub_total=$row['sub_total'];
         $cartTotal = $cartTotal + ($row["pro_price"] * $row["pro_qty"]);
         $cartTotal=$cartTotal+$shipping_charges;               
         }

         $arr_data = array('qty' => $sub_qty,'sub_total' => $sub_total, 'total_price' => $cartTotal);
         header('Content-Type: application/json; charset=utf-8');
         echo json_encode($arr_data);

    }
}
if($_POST['btn']=='removeQuantity'){

    $sub_total=0;
    $cartTotal=0;
    $shipping_charges=20;
    $cart_id = $_POST['cart_id'];
    $cart_userid = $_POST['userid'];
    $qty_stmt = $conn->prepare("SELECT * FROM `cart` WHERE id=?");
    $qty_stmt->execute([$cart_id]);
    while ($row = $qty_stmt->fetch(PDO::FETCH_ASSOC)){
     $qty=$row['pro_qty'];
     $price = $row['pro_price'];
     $total_qty=$qty-1;   
     $sub_total = $sub_total+($price * $total_qty);   
     $qty_cart = $conn->prepare('UPDATE `cart` SET `pro_qty`=?,`sub_total`=? WHERE id=?');
     $qty_cart->execute([$total_qty, $sub_total, $cart_id]);   
    
     $get_allcart_stmt = $conn->prepare("SELECT * FROM `cart` WHERE userid=?");
     $get_allcart_stmt->execute([$cart_userid]);
     while ($row = $get_allcart_stmt->fetch(PDO::FETCH_ASSOC)){
     $sub_qty=$row['pro_qty']; 
     $sub_total=$row['sub_total'];
     $cartTotal = $cartTotal + ($row["pro_price"] * $row["pro_qty"]);
     $cartTotal=$cartTotal+$shipping_charges;               
     }

     $arr_data = array('qty' => $sub_qty,'sub_total' => $sub_total, 'total_price' => $cartTotal);
     header('Content-Type: application/json; charset=utf-8');
     echo json_encode($arr_data);

}
}



function cartProduct($conn){
    
    $userid = $_COOKIE['userid'];
    $cartTotal=0;
    $data="
    <div class='px-6 text-right'>
    <span class='canvas-close d-inline-block fs-24 mb-1 ml-auto lh-1 text-primary'>
    <i class='fal fa-times'></i></span>
    </div>
    <div class='card-header bg-transparent py-0 px-6'>
        <h3 class='fs-24 mb-5'>
            Your Cart
        </h3>
    </div>";
        if(!empty($userid)){
        $get_cart_product=$conn->prepare("SELECT * FROM cart where userid=? order by id desc");
        $get_cart_product->execute([$userid]);
        $i=0;
        $total_cart_product = $get_cart_product->rowCount();
        if($total_cart_product > 0) {
    $data.="<div class='card-body px-6 pt-7 overflow-y-auto'>";
            while ($row = $get_cart_product->fetch(PDO::FETCH_ASSOC)){
            $price = $row['pro_price'];
            $image = $row['pro_img'];
            $name = $row['pro_name'];
            $qty = $row['pro_qty'];
            $id = $row['id'];
            $cartTotal = $cartTotal + ($row["pro_price"] * $row["pro_qty"]);
            $data.="
            <div class='mb-6 d-flex'>
                <a href='javascript:void(0)' class='d-block mr-4' onclick='deleteCart($id)'><i class='fal fa-times'></i></a>
                <div class='media'>
                    <div class='w-70px mr-4'>
                        <img src='sanjar-admin/{$image}' alt='Partridge Bar Stool'>
                    </div>
                    <div class='media-body'>
                        <p class='text-muted fs-12 mb-0 text-uppercase letter-spacing-05 lh-1 mb-1'>chairs</p>
                        <a href='' class='font-weight-bold mb-3 d-block'>{$name}</a>
                        <div class='d-flex align-items-center'>
                            <div class='input-group position-relative'>
                                <a href='#' class='down position-absolute pos-fixed-left-center pl-2'><i
                                        class='far fa-minus'></i></a>
                                <input type='number' class='w-100px px-6 text-center' value='{$qty}'>
                                <a href='#' class='up position-absolute pos-fixed-right-center pr-2'><i
                                        class='far fa-plus'></i>
                                </a>
                            </div>
                            <input type='hidden' value='$cartTotal' name='cart_total_price' id='cart_total_price' class='cart_total_price'/>
                            <p class='mb-0 ml-12 text-primary'>{$price}.00</p>
                        </div>
                    </div>
                </div>
            </div>";
            } 
$data.="</div>
            <div class='card-footer mt-auto border-0 bg-transparent px-6 pb-0 pt-5'>
                <div class='d-flex align-items-center mb-4'>
                    <span class='font-weight-bold text-primary'>Subtotal</span>
                    <span class='d-block ml-auto text-primary'>{$cartTotal}.00</span>
                </div>
                    <input type='text' class='form-control w-100 text-primary mb-4'
                        placeholder='Enter coupon code here'>
                    <a href='checkout.php' class='btn btn-primary btn-block mb-2'>CHECK OUT</a>
                    <a href='cart.php' class='d-block fs-14 text-uppercase letter-spacing-05 text-center font-weight-bold'>View
                        Cart</a>";
    $data.="</div>
        </div>";
            }else{
                echo "Empty";
            }   
        }
 
        return $cart_data = $total_cart_product.",".$data;
}

?>