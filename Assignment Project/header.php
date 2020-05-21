<?php 
session_start();
include 'admin/includes/connection.php';
$sum  = 0;
$i    = 0;
$id   = 0;
if (isset($_POST['addToCart']) || isset($_GET['cart'])) {
    # code...
    if(isset($_GET['proId'])){
    	$id = $_GET['proId'];
    }elseif (isset($_GET['cart'])) {
    	# code...
    	$id = $_GET['cart'];
    }
    if (isset($_SESSION['product'])) {
        # code...
        if(in_array($id,$_SESSION['product'])) { // if the product in session
            $x = array_search($id, $_SESSION['product']);
            if (isset($_POST['qty'])){ // if the qty added from single-product page
            	$_SESSION['qty'][$x] += $_POST['qty'];
            }
            else{
            	$_SESSION['qty'][$x] += 1;
            }
        }else{ // if the product NOT in session
            $_SESSION['product'][] = $id;
            if (isset($_POST['qty'])){
            	$_SESSION['qty'][] = $_POST['qty'];
            }
            else{
            	$_SESSION['qty'][] =1;
            }
        }
    }else{
        $_SESSION['product'][] = $id;

        if (isset($_POST['qty'])){
            $_SESSION['qty'][] = $_POST['qty'];
        }
        else{
          	$_SESSION['qty'][] =1;
        }
    }
    if(isset($_GET['cart'])){
    header("location:index.php");
    }else{

    header("location:single-product.php?proId=$id");
    }
}
if (isset($_SESSION['product'])) {
    # code..
    foreach ($_SESSION['product'] as $pro_id) {
        # code...

        $query= "select product.pro_id,pro_name,pro_price,pro_desc,pro_qty,
             product.author_id,product.coll_id,product.cat_id,image.img_one,image.img_two,author_name,coll_name,cat_name 
             from product 
             inner join category on product.cat_id=category.cat_id 
             inner join author on product.author_id=author.author_id 
             inner join collection on product.coll_id=collection.coll_id 
             inner join image on product.pro_id=image.pro_id 
             where product.pro_id= $pro_id";
        $result = mysqli_query($conn,$query);
        while ($row = mysqli_fetch_assoc($result)) {
            # code...
            $productCart[] = $row;
        }
            }
}
if (isset($_SESSION['qty'])) {
    # code...
    foreach ($_SESSION['qty'] as $key) {
    # code...
    $qty[] =$key;
    }
}

if (isset($productCart)) {
    # code...
    foreach ($productCart as $key1 => $value1) {
        $i++;$k=0;
        foreach ($qty as $key => $value) {
            $k++;
            if($i == $k){
                $productCart[$key1]['qty'] = $value;
            }
        }
    }

}

function remove_product($Id){
    $Id  = intval($Id);
    $max = count($_SESSION['product']);
    for($i=0 ; $i<$max ; $i++){
        if($_SESSION['product'][$i] == $Id){
            unset($_SESSION['product'][$i]);
            unset($_SESSION['qty'][$i]);
        } 
    }
    $_SESSION['product']=array_values($_SESSION['product']);
    header("location:$_SERVER[HTTP_REFERER]");
}

if (isset ( $_GET ['proIdRemove'] )) { 
    $key = $_GET['proIdRemove'];
    $proId =$_GET['proId'];
    remove_product($_GET['proIdRemove']);
}
?>


<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Home | Bookshop Responsive Bootstrap4 Template</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/plugins.css">
    <link rel="stylesheet" type="text/css" href="style.css">

	<!-- Custom css -->
   <link rel="stylesheet" href="css/custom.css">

	<!-- Modernizer js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="js/vendor/modernizr-3.5.0.min.js"></script>

</head>
<body>
	<!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">
		<!-- Header -->
		<header id="wn__header" class="header__area header__absolute sticky__header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<div class="logo">
							<a href="index.php">
								<img src="images/logo/logo.png" alt="logo images">
							</a>
						</div>
					</div>
					<div class="col-lg-8 d-none d-lg-block">
						<nav class="mainmenu__nav">
							<ul class="meninmenu d-flex justify-content-start">
								<li class="drop with--one--item"><a href="index.php">Home</a></li>
								<li class="drop"><a href="shop-grid.php">Shop</a>
								</li>
								<li class="drop"><a href="shop-grid.php">Books</a>
									<div class="megamenu mega03">
										<ul class="item item03">
											<li class="title">Categories</li>
											<?php
											$query = "select * from category";
											$result = mysqli_query($conn,$query);
											while ($cat=mysqli_fetch_assoc($result)) {
												# code...
												echo "<li><a href='shop-grid.php?catId={$cat['cat_id']}'>{$cat['cat_name']}</a></li>";
											}
											?>
										</ul>
										<ul class="item item03">
											<li class="title">Collections</li>
											<?php
											$query = "select * from collection";
											$result = mysqli_query($conn,$query);
											while ($coll = mysqli_fetch_assoc($result)){
												# code...
												if($coll['coll_id'] != 1){
												echo "<li><a href='shop-grid.php?coll_id={$coll['coll_id']}'>{$coll['coll_name']}</a></li>";
											}
											}
											?>
										</ul>
                                        <ul class="item item03">
                                            <li class="title">By Author</li>
                                            <?php
                                            $query = "select * from author";
                                            $result = mysqli_query($conn,$query);
                                            while ($author = mysqli_fetch_assoc($result)){
                                                # code...
                                                if($author['author_id'] != 1){
                                                    echo "<li><a href='shop-grid.php?authorId={$author['author_id']}'>{$author['author_name']}</a></li>";
                                                }
                                            }
                                            ?>
                                        </ul>
									</div>
								</li>
								<li class="drop"><a href="shop-grid.html">Kids</a>
									<div class="megamenu mega02">
										<ul class="item item02">
											<li class="title">Top Collections</li>
                                            <?php
                                            $query  = "select DISTINCT(collection.coll_id),coll_name from collection inner join product on collection.coll_id=product.coll_id where product.cat_id=16 order by collection.coll_id desc ";
                                            $result = mysqli_query($conn,$query);
                                            while ( $coll =mysqli_fetch_assoc($result)){
                                                if ($coll['coll_id'] != 1) {
                                                    echo "<li><a href=\"shop-grid.php?coll_id={$coll['coll_id']}\">{$coll['coll_name']}</a></li>";
                                                }
                                            }

                                            ?>
										</ul>
										<ul class="item item02">
                                            <li class="title">New Collection</li>
                                            <?php
                                            $query  = "select DISTINCT(collection.coll_id),coll_name from collection inner join product on collection.coll_id=product.coll_id where product.cat_id=16";
                                            $result = mysqli_query($conn,$query);
                                            while ( $coll =mysqli_fetch_assoc($result)){
                                                if ($coll['coll_id'] != 1) {
                                                    echo "<li><a href=\"shop-grid.php?coll_id={$coll['coll_id']}\">{$coll['coll_name']}</a></li>";
                                                }
                                            }

                                            ?>

										</ul>
									</div>
								</li>
								<li><a href="contact.php">Contact</a></li>
							</ul>
						</nav>
					</div>
					<div class="col-md-6 col-sm-6 col-6 col-lg-2">
						<ul class="header__sidebar__right d-flex justify-content-end align-items-center">
							<li class="wishlist"><a href="wishlist.php"></a></li>
							<li class="shopcart"><a class="cartbox_active" href="#"><span class="product_qun"><?php
                                        if(isset($productCart)){
                                            echo count($productCart);
                                        }
                                        else{
                                            echo "0";
                                        } ?></span></a>
								<!-- Start Shopping Cart -->
                            <div class="block-minicart minicart__active">
                                <div class="minicart-content-wrapper">
                                    <div class="micart__close">
                                        <span>close</span>
                                    </div>
                                    <div class="mini_action checkout">
                                        <a class="checkout__btn" href="checkout.php">Go to Checkout</a>
                                    </div>
                                    <form action='' method='post'>
                                    <div class="single__items">
                                        <div class="miniproduct">
                                            <?php $sum = 0 ; $items = 0;
                                            if (isset($productCart)) {
                                                foreach ($productCart as $singleProduct){
                                                    $items+=$singleProduct['qty'];
                                                    $sum+=$singleProduct['pro_price']*$singleProduct['qty'];
                                                    $proId = $singleProduct['pro_id'];
                                                    echo "<div class='item01 d-flex'>
                                                <div class='thumb'>
                                                    <a href='product-details.html'><img src='admin/uploads/product/{$singleProduct['cat_name']}/{$singleProduct['img_one']}' alt='product images'></a>
                                                </div>";
                                                echo"<input type='hidden' name='proId' value='{$singleProduct['pro_id']}'>
                                                <div class='content'>
                                                    <h6><a href='product-details.html'>{$singleProduct['pro_name']}</a></h6>
                                                    <span class='prize'>{$singleProduct['pro_price']}</span>
                                                    <div class='product_prize d-flex justify-content-between'>
                                                
                                                        <span class='qun'>{$singleProduct['qty']}</span>
                                                        <ul class='d-flex justify-content-end'>

                                                            <li><a href='#'><i class='zmdi zmdi-settings'></i></a></li>
                                                        
                                                            <li><a href='?proId={$proId}&proIdRemove={$singleProduct['pro_id']}'><i class='zmdi zmdi-delete'></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>";
                                            } }else {
                                                echo "<h3>No Product In Cart</h3>";
                                            }
                                            
                                            ?>
                                        </div>
                                    </div></form>
                                    <div class="items-total d-flex justify-content-between">
                                            <span><?php echo $items; ?></span>
                                            <span>Cart Subtotal</span>
                                        </div>
                                    <div class="total_amount text-right">
                                        <span><?php echo $sum; ?></span>
                                    </div>
                                    <div class="mini_action cart">
                                        <a class="cart__btn" href="cart.php">View and edit cart</a>
                                    </div>
                                </div>
                            </div>
								<!-- End Shopping Cart -->
							</li>
							<li class="setting__bar__icon"><a class="setting__active" href="#"></a>
								<div class="searchbar__content setting__block">
									<div class="content-inner">
										<div class="switcher-currency">
											<strong class="label switcher-label">
												<span>My Account</span>
											</strong>
											<div class="switcher-options">
												<div class="switcher-currency-trigger">
													<div class="setting__menu">
                                                        <?php if(isset($_SESSION['customer'])){
                                                            echo "<span><a href=\"wishlist.php\">My Wishlist</a></span><span><span><a href=\"logout.php\">Logout</a></span>";
                                                        } else{
                                                            echo "<span><a href='my-account.php'>Login</a></span>";
                                                        }?>

													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<!-- Start Mobile Menu -->
				<div class="row d-none">
					<div class="col-lg-12 d-none">
						<nav class="mobilemenu__nav">
							<ul class="meninmenu">
								<li><a href="index.php">Home</a></li>
								<li><a href="#">Pages</a>
									<ul>
										<li><a href="about.html">About Page</a></li>
										<li><a href="portfolio.html">Portfolio</a>
											<ul>
												<li><a href="portfolio.html">Portfolio</a></li>
												<li><a href="portfolio-details.html">Portfolio Details</a></li>
											</ul>
										</li>
										<li><a href="my-account.html">My Account</a></li>
										<li><a href="cart.html">Cart Page</a></li>
										<li><a href="checkout.html">Checkout Page</a></li>
										<li><a href="wishlist.html">Wishlist Page</a></li>
										<li><a href="error404.html">404 Page</a></li>
										<li><a href="faq.html">Faq Page</a></li>
										<li><a href="team.html">Team Page</a></li>
									</ul>
								</li>
								<li><a href="shop-grid.html">Shop</a>
									<ul>
										<li><a href="shop-grid.html">Shop Grid</a></li>
										<li><a href="single-product.html">Single Product</a></li>
									</ul>
								</li>

								<li><a href="contact.html">Contact</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<!-- End Mobile Menu -->
	            <div class="mobile-menu d-block d-lg-none">
	            </div>
	            <!-- Mobile Menu -->	
			</div>		
		</header>
		<!-- //Header -->
		<!-- Start Search Popup -->
		<div class="brown--color box-search-content search_active block-bg close__top">
			<form id="search_mini_form" class="minisearch" action="#">
				<div class="field__search">
					<input type="text" placeholder="Search entire store here...">
					<div class="action">
						<a href="#"><i class="zmdi zmdi-search"></i></a>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
		</div>