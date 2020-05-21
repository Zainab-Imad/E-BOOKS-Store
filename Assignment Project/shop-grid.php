

<?php include 'admin/includes/connection.php';
include 'header.php';
if ( isset($_GET['catId'])) {
    $query = "select * from category where cat_id = {$_GET['catId']}";
    $result = mysqli_query($conn, $query);
    $cat = mysqli_fetch_assoc($result);
}
function filter($amount){
    $arr = explode(' - ',$amount);
    $min = $arr[0];
    $max = $arr[1];
    return " and product.pro_price BETWEEN $min and $max order by pro_price asc";
}

?>

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Shop Single</h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="index.php">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active"><?php
                            if (isset( $_GET['catId'])){
                                echo $cat['cat_name'];
                            } else{ echo "All"; }; ?></span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- End Bradcaump area -->
    <!-- Start Shop Page -->
    <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Product Categories</h3>
                            <ul>
                                <?php
                                $query ="
SELECT category.cat_id, `cat_name`, `cat_img`,count(product.cat_id) FROM `category` inner join product on product.cat_id=category.cat_id GROUP BY product.cat_id";
                                $result = mysqli_query($conn,$query);
                                while ( $cat = mysqli_fetch_assoc($result) ){
                                    echo "<li><a href='?catId={$cat['cat_id']}'>{$cat['cat_name']}<span>{$cat['count(product.cat_id)']}</span></a></li>";
                                }
                                ?>
                            </ul>
                        </aside>
                        <aside class="wedget__categories pro--range">
                            <h3 class="wedget__title">Filter by price</h3>
                                        <form method="post" action="">
                                            <div>
                                                <div id="slider-range"></div>
                                                <span>Price :</span><input type="text" id="amount" name="amount" readonly="">
                                            </div>
                                            <div>
                                                <div style="margin-top: 10px;">
                                                    <input class="btn-outline-dark" type="submit" name="filter" value="Filter">
                                                </div>
                                            </div>
                                        </form>

                        </aside>
                        <aside class="wedget__categories poroduct--tag">
                            <h3 class="wedget__title">Collection Tags</h3>
                            <ul>
                                <?php
                                $query ="select * from collection";
                                $result = mysqli_query($conn,$query);
                                while ($coll = mysqli_fetch_assoc($result)){
                                    if ($coll['coll_id'] != 1) {
                                        echo "<li><a href=\"?coll_id={$coll['coll_id']}\">{$coll['coll_name']}</a></li>";
                                    }
                                }
                                ?>
                            </ul>
                        </aside>
                        <aside class="wedget__categories sidebar--banner">
                            <img src="admin/uploads/banner_left.jpg" alt="banner images">
                            <div class="text">
                                <h2>new products</h2>
                                <h6>save up to <br> <strong>40%</strong>off</h6>
                            </div>
                        </aside>
                    </div>
                </div>
                <div class="col-lg-9 col-12 order-1 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
                                <div class="shop__list nav justify-content-center" role="tablist">
                                    <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
                                    <a class="nav-item nav-link " data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
                                </div>
                                <p>Showing 1–12 of 40 results</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab__container">
                        <div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
                            <div class="row">
                                <?php
                                if (isset($_GET['catId'])) {
                                    $query = " select * from product inner join image on product.pro_id=image.pro_id inner join category on product.cat_id=category.cat_id where product.cat_id= {$_GET['catId']}";
                                    if (isset($_POST['filter'])){
                                        $query.=filter($_POST['amount']);
                                    }
                                    $result = mysqli_query($conn, $query);
                                    while ($pro = mysqli_fetch_assoc($result)) {
                                        echo "<div class=\"product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12\">
                                    <div class=\"product__thumb\">
                                        <a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product image\"></a>
                                        <a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_two']}\" alt=\"product image\"></a>
                                        <div class=\"hot__box\">
                                            <span class=\"hot-label\">BEST SALLER</span>
                                        </div>
                                    </div>
                                    <div class=\"product__content content--center\">
                                        <h4><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h4>
                                        <ul class=\"prize d-flex\">
                                            <li>$ {$pro['pro_price']}</li>
                                        </ul>
                                        <div class=\"action\">
                                            <div class=\"actions_inner\">
                                                <ul class=\"add_to_links\">
                                                    <li><a class=\"cart\" href=\"single-product.php?proId={$pro['pro_id']}\"><i class=\"bi bi-shopping-bag4\"></i></a></li>
                                                    <li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
                                                    <li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"product__hover--content\">
                                    <ul class=\"rating d-flex\">
                                        <li style=\"color: #e59285\">$ {$pro['pro_price']}</li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                                ";
                                    }
                                } elseif (isset($_GET['coll_id'])){
                                    $query = "select * from product inner join image on product.pro_id=image.pro_id inner join collection on product.coll_id=collection.coll_id inner join category on product.cat_id=category.cat_id where product.coll_id={$_GET['coll_id']}";
                                    if (isset($_POST['filter'])){
                                        $query.=filter($_POST['amount']);
                                    }
                                    $result = mysqli_query($conn,$query);
                                    while ($pro = mysqli_fetch_assoc($result)) {
                                        echo "<div class=\"product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12\">
                                    <div class=\"product__thumb\">
                                        <a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product image\"></a>
                                        <a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_two']}\" alt=\"product image\"></a>
                                        <div class=\"hot__box\">
                                            <span class=\"hot-label\">BEST SALLER</span>
                                        </div>
                                    </div>
                                    <div class=\"product__content content--center\">
                                        <h4><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h4>
                                        <ul class=\"prize d-flex\">
                                            <li>$ {$pro['pro_price']}</li>
                                        </ul>
                                        <div class=\"action\">
                                            <div class=\"actions_inner\">
                                                <ul class=\"add_to_links\">
                                                    <li><a class=\"cart\" href=\"single-product.php?proId={$pro['pro_id']}\"><i class=\"bi bi-shopping-bag4\"></i></a></li>
                                                    <li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
                                                    <li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"product__hover--content\">
                                    <ul class=\"rating d-flex\">
                                        <li style=\"color: #e59285\">$ {$pro['pro_price']}</li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                                "; }
                                }
                                elseif (isset($_GET['authorId'])){
                                    $query = "select * from product inner join image on product.pro_id=image.pro_id inner join category on product.cat_id=category.cat_id inner join author on product.author_id=author.author_id where product.author_id={$_GET['authorId']}";
                                    $result = mysqli_query($conn,$query);
                                    while ($pro = mysqli_fetch_assoc($result)){
                                        echo "<div class=\"product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12\">
                                    <div class=\"product__thumb\">
                                        <a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product image\"></a>
                                        <a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_two']}\" alt=\"product image\"></a>
                                        <div class=\"hot__box\">
                                            <span class=\"hot-label\">BEST SALLER</span>
                                        </div>
                                    </div>
                                    <div class=\"product__content content--center\">
                                        <h4><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h4>
                                        <ul class=\"prize d-flex\">
                                            <li>$ {$pro['pro_price']}</li>
                                        </ul>
                                        <div class=\"action\">
                                            <div class=\"actions_inner\">
                                                <ul class=\"add_to_links\">
                                                    <li><a class=\"cart\" href=\"single-product.php?proId={$pro['pro_id']}\"><i class=\"bi bi-shopping-bag4\"></i></a></li>
                                                    <li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
                                                    <li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"product__hover--content\">
                                    <ul class=\"rating d-flex\">
                                        <li style=\"color: #e59285\">$ {$pro['pro_price']}</li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                                ";
                                    }
                                }
                                else {

                                    $query = " select * from product inner join image on product.pro_id=image.pro_id inner join category on product.cat_id=category.cat_id";
                                    if (isset($_POST['filter'])){
                                        $query.=filter($_POST['amount']);
                                    }
                                    $result = mysqli_query($conn,$query);
                                    while ($pro = mysqli_fetch_assoc($result)) {
                                        echo "<div class=\"product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12\">
                                    <div class=\"product__thumb\">
                                        <a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product image\"></a>
                                        <a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_two']}\" alt=\"product image\"></a>
                                        <div class=\"hot__box\">
                                            <span class=\"hot-label\">BEST SALLER</span>
                                        </div>
                                    </div>
                                    <div class=\"product__content content--center\">
                                        <h4><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h4>
                                        <ul class=\"prize d-flex\">
                                            <li>$ {$pro['pro_price']}</li>
                                        </ul>
                                        <div class=\"action\">
                                            <div class=\"actions_inner\">
                                                <ul class=\"add_to_links\">
                                                    <li><a class=\"cart\" href=\"single-product.php?proId={$pro['pro_id']}\"><i class=\"bi bi-shopping-bag4\"></i></a></li>
                                                    <li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
                                                    <li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class=\"product__hover--content\">
                                    <ul class=\"rating d-flex\">
                                        <li style=\"color: #e59285\">$ {$pro['pro_price']}</li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                                ";
                                    }
                                }

                                ?>
                                <!-- Start Single Product -->
                                <!-- End Single Product -->
                                <!-- Start Single Product -->

                                <!-- End Single Product -->
                            </div>
                            <ul class="wn__pagination">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                            </ul>
                        </div>
                        <div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
                            <div class="list__view__wrapper">
                                <!-- Start Single Product -->
                                <?php
                                if (isset($_GET['catId'])) {
                                    $query = " select * from product inner join image on product.pro_id=image.pro_id inner join category on product.cat_id=category.cat_id where product.cat_id= {$_GET['catId']}";
                                    if (isset($_POST['filter'])){
                                        $query.=filter($_POST['amount']);
                                    }
                                    $result = mysqli_query($conn, $query);
                                    while ($pro = mysqli_fetch_assoc($result)) {
                                        echo "<div class=\"list__view mt--40\">
	        							<div class=\"thumb\">
	        								<a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product images\"></a>
	        								<a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_two']}\" alt=\"product images\"></a>
	        							</div>
	        							<div class=\"content\">
	        								<h2><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h2>
	        								<ul class=\"rating d-flex\">
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li><i class=\"fa fa-star-o\"></i></li>
	        									<li><i class=\"fa fa-star-o\"></i></li>
	        								</ul>
	        								<ul class=\"prize__box\">
	        									<li>$ {$pro['pro_price']}</li>
	        								</ul>
	        								<p>{$pro['pro_desc']}</p>
	        								<ul class=\"cart__action d-flex\">
	        									<li class=\"cart\"><a href=\"single-product.php?proId={$pro['pro_id']}\">Add to cart</a></li>
	        									<li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
	        								<li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
	        								</ul>

	        							</div>
	        						</div>";
                                    }

                                }
                                elseif (isset($_GET['coll_id'])){
                                    $query = " select * from product inner join image on product.pro_id=image.pro_id inner join collection on product.coll_id=collection.coll_id inner join category on product.cat_id=category.cat_id where product.coll_id={$_GET['coll_id']}";
                                    if (isset($_POST['filter'])){
                                        $query.=filter($_POST['amount']);
                                    }
                                    $result = mysqli_query($conn,$query);
                                    while ($pro = mysqli_fetch_assoc($result)) {
                                        echo "<div class=\"list__view mt--40\">
	        							<div class=\"thumb\">
	        								<a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product images\"></a>
	        								<a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='450' height='565' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product images\"></a>
	        							</div>
	        							<div class=\"content\">
	        								<h2><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h2>
	        								<ul class=\"rating d-flex\">
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li><i class=\"fa fa-star-o\"></i></li>
	        									<li><i class=\"fa fa-star-o\"></i></li>
	        								</ul>
	        								<ul class=\"prize__box\">
	        									<li>$ {$pro['pro_price']}</li>
	        								</ul>
	        								<p>{$pro['pro_desc']}</p>
	        								<ul class=\"cart__action d-flex\">
	        									<li class=\"cart\"><a href=\"single-product.php?proId={$pro['pro_id']}\">Add to cart</a></li>
	        									<li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
	        									<li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
	        								</ul>

	        							</div>
	        						</div>";
                                    }
                                }
                                else {
                                    $query = " select * from product inner join image on product.pro_id=image.pro_id inner join category on product.cat_id=category.cat_id";
                                    if (isset($_POST['filter'])){
                                        $query.=filter($_POST['amount']);
                                    }
                                    $result = mysqli_query($conn,$query);
                                    while ($pro = mysqli_fetch_assoc($result)) {
                                        echo "<div class=\"list__view mt--40\">
	        							<div class=\"thumb\">
	        								<a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270' height='340' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product images\"></a>
	        								<a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='450' height='565' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product images\"></a>
	        							</div>
	        							<div class=\"content\">
	        								<h2><a href=\"single-product.php?proId={$pro['pro_id']}\">{$pro['pro_name']}</a></h2>
	        								<ul class=\"rating d-flex\">
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li class=\"on\"><i class=\"fa fa-star-o\"></i></li>
	        									<li><i class=\"fa fa-star-o\"></i></li>
	        									<li><i class=\"fa fa-star-o\"></i></li>
	        								</ul>
	        								<ul class=\"prize__box\">
	        									<li>$ {$pro['pro_price']}</li>
	        								</ul>
	        								<p>{$pro['pro_desc']}</p>
	        								<ul class=\"cart__action d-flex\">
	        									<li class=\"cart\"><a href=\"single-product.php?proId={$pro['pro_id']}\">Add to cart</a></li>
	        									<li><a class=\"wishlist\" pro=\"{$pro['pro_id']}\" name=\"wishlist\"><i class=\"bi bi-heart-beat\"></i></a></li>
	        									<li><a data-toggle=\"modal\" title=\"Quick View\" pro-data=\"{$pro['pro_id']}\" class=\"quickview modal-view detail-link\" href=\"#productmodal\"><i class=\"bi bi-search\"></i></a></li>
	        								</ul>

	        							</div>
	        						</div>";
                                    }
                                    } ?>
                                <!-- End Single Product -->
                                <!-- End Single Product -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->

    <?php include 'footer.php';?>
