<?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]"; 
//include('include/database.php');



setcookie("userID");
$id = uniqid();
if(!isset($_COOKIE["userID"])) {
  setcookie("userID",$id,time()+31556926 ,'/');
  $insertUser=$conn->prepare("INSERT INTO customer(userid, cookieUser) VALUE('".$id."', 'yes')");
  $insertUser->execute();
  echo '<script type="text/javascript">location.reload()</script>';
} else {
  setcookie("userID",$_COOKIE["userID"],time()+31556926 ,'/');
  $checkUser=$conn->prepare("SELECT * FROM customer WHERE userid='".$_COOKIE["userID"]."'");
  $checkUser->execute();
  $isUser = $checkUser->rowCount();
  while($row=$checkUser->fetch(PDO::FETCH_ASSOC)){
	  $email = $row['email'];
	  $fname=$row['fname'];
	  $userid=$row['userid'];
  }
  if($email!=NULL){
	  $_SESSION['IS_LOGIN']=true;
	  $_SESSION['NAME']=$fname;
	  $_SESSION['EMAIL']=$email;
	  $_SESSION['USER_ID']=$userid;   
  }
  if($isUser==0){
	  $insertUser=$conn->prepare("INSERT INTO customer(userid, cookieUser) VALUE('".$_COOKIE['userID']."', 'yes')");
	  $insertUser->execute();
  } 
}
?>

<!doctype html>
<html class="no-js" lang="en">
	
<!-- Mirrored from template.hasthemes.com/hurst-v1/hurst/index-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 31 Jul 2023 18:48:04 GMT -->
<head>
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>Home || Sanjary Furniture</title>
		<meta name="description" content="Hurst – Furniture Store eCommerce HTML Template is a clean and elegant design – suitable for selling flower, cookery, accessories, fashion, high fashion, accessories, digital, kids, watches, jewelries, shoes, kids, furniture, sports….. It has a fully responsive width adjusts automatically to any screen size or resolution.">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
		<!-- Place favicon.ico in the root directory -->
		
		<!-- Google Font -->
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Bree+Serif' rel='stylesheet' type='text/css'>


        <?php
      if(strpos($actual_link, 'localhost')) {
    ?>
      <base href="http://localhost/sanjary/">
    <?php
      }else {
    ?>
      <base href="<?php echo $actual_link; ?>">
    <?php
      }
      ?>

		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
		<link rel="stylesheet" href="css/animate.min.css">
		<!-- jquery-ui.min css -->
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<!-- meanmenu css -->
		<link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- nivo-slider css -->
		<link rel="stylesheet" href="lib/css/nivo-slider.css">
		<link rel="stylesheet" href="lib/css/preview.css">
		<!-- slick css -->
		<link rel="stylesheet" href="css/slick.min.css">
		<!-- lightbox css -->
		<link rel="stylesheet" href="css/lightbox.min.css">
		<!-- material-design-iconic-font css -->
		<link rel="stylesheet" href="css/material-design-iconic-font.css">
		<!-- All common css of theme -->
		<link rel="stylesheet" href="css/default.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.min.css">
        <!-- shortcode css -->
        <link rel="stylesheet" href="css/shortcode.css">
		<!-- responsive css -->
		<link rel="stylesheet" href="css/responsive.css">
		<!-- modernizr css -->
		<script src="js/vendor/modernizr-3.11.2.min.js"></script>
	</head>
	<body>	
		<!-- WRAPPER START -->
		<div class="wrapper bg-dark-white">

			<!-- HEADER-AREA START -->
			<header id="sticky-menu" class="header header-2">
				<div class="header-area">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 offset-md-4 col-7">
								<div class="logo text-md-center">
									<a href="/"><img src="img/logo/Sanjari-Logo-1.png" alt="Sanjari-Logo" /></a>
								</div>
							</div>
							<div class="col-md-4 col-5">
								<div class="mini-cart text-end">
									<ul>
										<li>
											<a class="cart-icon" href="cart">
												<i class="zmdi zmdi-shopping-cart"></i>
												<span class="total-item-cart">0</span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- MAIN-MENU START -->
				<div class="menu-toggle menu-toggle-2 hamburger hamburger--emphatic d-none d-md-block">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
				<div class="main-menu  d-none d-md-block">
					<nav>
						<ul>
							<li><a href="/">home</a>
								<div class="sub-menu menu-scroll">
									<ul>
										<li class="menu-title">Page's</li>
										<li><a href="/">Home Version 1</a></li>
										<li><a href="index-2.html">Home Version 2</a></li>
									</ul>
								</div>
							</li>
							<li><a href="shop.html">products</a>
								<div class="mega-menu menu-scroll">
									<div class="table">
										<div class="table-cell">
											<div class="half-width">
												<ul>
													<li class="menu-title">best brands</li>
													<li><a href="#">henning koppel</a></li>
													<li><a href="#">jehs + Laub</a></li>
													<li><a href="#">vicke lindstrand</a></li>
													<li><a href="#">don chadwick</a></li>
													<li><a href="#">akiko kuwahata</a></li>
													<li><a href="#">barbro berlin</a></li>
													<li><a href="#">cecilia hall</a></li>
													<li><a href="#">don chadwick</a></li>
												</ul>
											</div>
											<div class="half-width">
												<ul>
													<li class="menu-title">popular brands</li>
													<li><a href="#">akiko kuwahata</a></li>
													<li><a href="#">barbro berlin</a></li>
													<li><a href="#">cecilia hall</a></li>
													<li><a href="#">don chadwick</a></li>
													<li><a href="#">henning koppel</a></li>
													<li><a href="#">jehs + Laub</a></li>
													<li><a href="#">vicke lindstrand</a></li>
													<li><a href="#">don chadwick</a></li>
												</ul>
											</div>
											<div class="full-width">
												<div class="mega-menu-img">
													<a href="single-product.html"><img src="img/megamenu/1.jpg" alt="" /></a>
												</div>
											</div>
											<div class="pb-80"></div>
										</div>
									</div>
								</div>
							</li>
                            <li><a href="#">Shortcodes</a>
                                <div class="sub-menu menu-scroll">
                                    <ul>
                                        <li class="menu-title">Shortcodes</li>
                                        <li><a href="elements-accordions.html">Accordion</a></li>
                                        <li><a href="elements-toggles.html">Toggles</a></li>
                                        <li><a href="elements-tab.html">Tab</a></li>
                                        <li><a href="elements-product-tab.html">Product Tab</a></li>
                                        <li><a href="elements-product-tab-2.html">Product Tab 2</a></li>
                                        <li><a href="elements-carousel.html">product carousel</a></li>
                                        <li><a href="elements-carousel-2.html">product carousel 2</a></li>
                                        <li><a href="elements-featured-product.html">Featured Product</a></li>
                                        <li><a href="elements-featured-product-2.html">Featured Product 2</a></li>
                                        <li><a href="elements-button.html">Button</a></li>
                                        <li><a href="elements-table.html">Table</a></li>
                                        <li><a href="elements-progress-bars.html">Progress Bar</a></li>
                                        <li><a href="elements-blog.html">Blog</a></li>
                                        <li><a href="elements-blog-2.html">Blog - 2</a></li>
                                        <li><a href="elements-team.html">Team</a></li>
                                        <li><a href="elements-footer.html">Footer</a></li>
                                        <li><a href="elements-footer-2.html">Footer 2</a></li>
                                        <li><a href="elements-map.html">Map</a></li>
                                    </ul>
                                </div>
                            </li>
							<li><a href="shop-sidebar.html">accesories</a></li>
							<li><a href="shop-list.html">lookbook</a></li>
							<li><a href="blog.html">blog</a></li>
							<li><a href="#">pages</a>
								<div class="sub-menu menu-scroll">
									<ul>
										<li class="menu-title">Page's</li>
										<li><a href="shop.html">Shop</a></li>
										<li><a href="shop-sidebar.html">Shop Sidebar</a></li>
										<li><a href="shop-grid-right-sidebar.html">Shop Right Sidebar</a></li>
										<li><a href="shop-list.html">Shop List</a></li>
										<li><a href="shop-list-right-sidebar.html">Shop List right sidebar</a></li>
										<li><a href="single-product.html">Single Product</a></li>
										<li><a href="single-product-sidebar.html">Single Product Sidebar</a></li>
										<li><a href="cart.html">Shopping Cart</a></li>
										<li><a href="wishlist.html">Wishlist</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="order.html">Order</a></li>
										<li><a href="login.html">login / Registration</a></li>
										<li><a href="my-account.html">My Account</a></li>
										<li><a href="404.html">404</a></li>
										<li><a href="blog.html">Blog</a></li>
										<li><a href="single-blog.html">Single Blog</a></li>
										<li><a href="single-blog-sidebar.html">Single Blog Sidebar</a></li>
										<li><a href="about.html">About Us</a></li>
										<li><a href="contact.html">Contact</a></li>
									</ul>
								</div>
							</li>
							<li><a href="about.html">about us</a></li>
							<li><a href="contact.html">contact</a></li>
						</ul>
					</nav>
				</div>
				<!-- MAIN-MENU END -->
			</header>
			<!-- HEADER-AREA END -->
			<!-- Mobile-menu start -->
			<div class="mobile-menu-area">
				<div class="container-fluid">
					<div class="row">
						<div class="col-xs-12 d-block d-md-none">
							<div class="mobile-menu">
								<nav id="dropdown">
									<ul>
										<li><a href="/">home</a>
											<ul>
												<li><a href="/">Home Version 1</a></li>
												<li><a href="index-2.html">Home Version 2</a></li>
											</ul>
										</li>
										<li><a href="shop.html">products</a></li>
										<li><a href="shop-sidebar.html">accesories</a></li>
										<li><a href="shop-list.html">lookbook</a></li>
										<li><a href="blog.html">blog</a></li>
										<li><a href="#">pages</a>
											<ul>
												<li><a href="shop.html">Shop</a></li>
												<li><a href="shop-sidebar.html">Shop Sidebar</a></li>
												<li><a href="shop-list.html">Shop List</a></li>
												<li><a href="single-product.html">Single Product</a></li>
												<li><a href="single-product-sidebar.html">Single Product Sidebar</a></li>
												<li><a href="cart.html">Shopping Cart</a></li>
												<li><a href="wishlist.html">Wishlist</a></li>
												<li><a href="checkout.html">Checkout</a></li>
												<li><a href="order.html">Order</a></li>
												<li><a href="login.html">login / Registration</a></li>
												<li><a href="my-account.html">My Account</a></li>
												<li><a href="404.html">404</a></li>
												<li><a href="blog.html">Blog</a></li>
												<li><a href="single-blog.html">Single Blog</a></li>
												<li><a href="single-blog-sidebar.html">Single Blog Sidebar</a></li>
												<li><a href="about.html">About Us</a></li>
												<li><a href="contact.html">Contact</a></li>
											</ul>
										</li>
										<li><a href="about.html">about us</a></li>
										<li><a href="contact.html">contact</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Mobile-menu end -->