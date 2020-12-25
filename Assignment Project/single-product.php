<?php 
include 'header.php';
$query ="select product.pro_id,pro_name,pro_price,pro_desc,pro_qty,
product.author_id,product.coll_id,product.cat_id,image.img_one,image.img_two,author_name,coll_name,cat_name 
from product 
inner join category on product.cat_id=category.cat_id 
inner join author on product.author_id=author.author_id 
inner join collection on product.coll_id=collection.coll_id 
inner join image on product.pro_id=image.pro_id where product.pro_id=  {$_GET['proId']}";
$result = mysqli_query($conn,$query);
$pro    = mysqli_fetch_assoc($result);
$catID  = $pro['cat_id'];


?>
    <!-- End Search Popup -->
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
                            <span class="breadcrumb_item active"><?php echo $pro['cat_name'] ?></span>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active"><?php echo $pro['pro_name'] ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start main Content -->
    <div class="maincontent bg--white pt--80 pb--55">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-12">
                    <div class="wn__single__product">

                            <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="wn__fotorama__wrapper">
                                    <div class="fotorama wn__fotorama__action" data-nav="thumbs">
                                        <a href="1.jpg"><img height="565px" width="450px" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_one'];?>" alt="0000"></a>
                                        <a href="2.jpg"><img height="565px" width="450px" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_two'];?>" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="product__info__main">
                                    <h1 style="font-size: 40px;"><?php echo $pro['pro_name']; ?></h1>
                                    <h3 style="font-size: 30px;">BY: <?php echo $pro['author_name']; ?></h3>
                                    <div class="product-reviews-summary d-flex">
                                        <ul class="rating-summary d-flex">
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                            <li class="off"><i class="zmdi zmdi-star-outline"></i></li>
                                        </ul>
                                    </div>
                                    <div class="price-box">
                                        <span>$ <?php echo $pro['pro_price']; ?></span>
                                    </div>
                                    <div class="product__overview"><?php echo $pro['pro_desc'] ?></p>
                                    </div>
                                    <div class="box-tocart d-flex">
                                        <span>Qty</span>
                                        <input id="qty" class="input-text qty" name="qty"min="1" max="<?php echo $pro['pro_qty']?>"value="1" title="Qty" type="number">
                                        <div class="addtocart__actions">
                                            <button class="tocart" type="submit" name="addToCart" title="Add to Cart">Add to Cart</button>
                                        </div>
                                        <div class="product-addto-links clearfix">
                                            <a class="wishlist" pro="<?php echo $pro['pro_id'] ?>" name="wishlist"><i class="bi bi-heart-beat"></i></a>
                                        </div>
                                    </div>
                                    <div class="product_meta">
											<span class="posted_in">Categories:
												<a href="#"><?php echo $pro['cat_name']?></a>
											</span>
                                    </div>
                                    <div class="product-share">
                                        <ul>
                                            <li class="categories-title">Share :</li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-twitter icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-tumblr icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-facebook icons"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="icon-social-linkedin icons"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                              </div>
                            </div>
                        </div></form>
                    </div>
                    <div class="product__info__detailed">
                        <div class="pro_details_nav nav justify-content-start" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Details</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab">Reviews</a>
                        </div>
                        <div class="tab__container">
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
                                <div class="description__attribute">
                                    <p>Ideal for cold-weather training or work outdoors, the Chaz Hoodie promises superior warmth with every wear. Thick material blocks out the wind as ribbed cuffs and bottom band seal in body heat.Ideal for cold-weather training or work outdoors, the Chaz Hoodie promises superior warmth with every wear. Thick material blocks out the wind as ribbed cuffs and bottom band seal in body heat.Ideal for cold-weather training or work outdoors, the Chaz Hoodie promises superior warmth with every wear. Thick material blocks out the wind as ribbed cuffs and bottom band seal in body heat.Ideal for cold-weather training or work outdoors, the Chaz Hoodie promises superior warmth with every wear. Thick material blocks out the wind as ribbed cuffs and bottom band seal in body heat.</p>
                                    <ul>
                                        <li>• Two-tone gray heather hoodie.</li>
                                        <li>• Drawstring-adjustable hood. </li>
                                        <li>• Machine wash/dry.</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Tab Content -->
                            <!-- Start Single Tab Content -->
                            <div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
                                <div class="review__attribute">
                                    <h1>Customer Reviews</h1>
                                    <h2>Hastech</h2>
                                    <div class="review__ratings__type d-flex">
                                        <div class="review-ratings">
                                            <div class="rating-summary d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>

                                            <div class="rating-summary d-flex">
                                                <span>Price</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="rating-summary d-flex">
                                                <span>value</span>
                                                <ul class="rating d-flex">
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="review-content">
                                            <p>Hastech</p>
                                            <p>Review by Hastech</p>
                                            <p>Posted on 11/6/2018</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="review-fieldset">
                                    <h2>You're reviewing:</h2>
                                    <h3>Chaz Kangeroo Hoodie</h3>
                                    <div class="review-field-ratings">
                                        <div class="product-review-table">
                                            <div class="review-field-rating d-flex">
                                                <span>Quality</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Price</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                            <div class="review-field-rating d-flex">
                                                <span>Value</span>
                                                <ul class="rating d-flex">
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                    <li class="off"><i class="zmdi zmdi-star"></i></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="review_form_field">
                                        <div class="input__box">
                                            <span>Nickname</span>
                                            <input id="nickname_field" type="text" name="nickname">
                                        </div>
                                        <div class="input__box">
                                            <span>Summary</span>
                                            <input id="summery_field" type="text" name="summery">
                                        </div>
                                        <div class="input__box">
                                            <span>Review</span>
                                            <textarea name="review"></textarea>
                                        </div>
                                        <div class="review-form-actions">
                                            <button>Submit Review</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Tab Content -->
                        </div>
                    </div>
                    <div class="wn__related__product pt--80 pb--50">
                        <div class="section__title text-center">
                            <h2 class="title__be--2">Related Products</h2>
                        </div>
                        <div class="row mt--60">
                            <div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
                                <!-- Start Single Product -->
                                <?php
                                $query = "select * from product inner join image on product.pro_id=image.pro_id inner join category on product.cat_id= category.cat_id where category.cat_id=$catID";
                                $result =mysqli_query($conn,$query);
                                while ($pro = mysqli_fetch_assoc($result)){
                                    echo "<div class=\"product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12\">
                                    <div class=\"product__thumb\">
                                        <a class=\"first__img\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270px' height='340px' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product image\"></a>
                                        <a class=\"second__img animation1\" href=\"single-product.php?proId={$pro['pro_id']}\"><img width='270px' height='340px' src=\"admin/uploads/product/{$pro['cat_name']}/{$pro['img_one']}\" alt=\"product image\"></a>
                                        <div class=\"hot__box color--2\">
                                            <span class=\"hot-label\">Related</span>
                                        </div>
                                    </div>
                                    <div class=\"product__content content--center\">
                                        <h4><a href=\"single-product.php?proId={$pro['pro_id']}\">The Remainng</a></h4>
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
                                   
                                    </div>
                                </div>";
                                }
                                ?>
                                <!-- Start Single Product -->
                                <!-- Start Single Product -->

                                <!-- Start Single Product -->
                                <!-- Start Single Product -->

                                <!-- Start Single Product -->
                                <!-- Start Single Product -->

                                <!-- Start Single Product -->
                                <!-- Start Single Product -->

                                <!-- Start Single Product -->
                                <!-- Start Single Product -->

                                <!-- Start Single Product -->

                        </div>
                    </div>

                </div>
                </div>
                <div class="col-lg-3 col-12 md-mt-40 sm-mt-40">
                    <div class="shop__sidebar">
                        <aside class="wedget__categories poroduct--cat">
                            <h3 class="wedget__title">Product Categories</h3>
                            <ul>
                                <?php
                                $query ="
SELECT category.cat_id, `cat_name`,count(product.cat_id) FROM `category` inner join product on product.cat_id=category.cat_id GROUP BY product.cat_id";
                                $result = mysqli_query($conn,$query);
                                while ( $cat = mysqli_fetch_assoc($result) ){
                                    echo "<li><a href='shop-grid.php?catId={$cat['cat_id']}'>{$cat['cat_name']}<span>{$cat['count(product.cat_id)']}</span></a></li>";
                                }
                                ?>
                            </ul>
                        </aside>
                        <aside class="wedget__categories poroduct--tag">
                            <h3 class="wedget__title">Product Tags</h3>
                            <ul>
                                <?php
                                $query ="select * from collection";
                                $result = mysqli_query($conn,$query);
                                while ($coll = mysqli_fetch_assoc($result)){
                                    if ($coll['coll_id'] != 1) {
                                        echo "<li><a href=\"shop-grid.php?coll_id={$coll['coll_id']}\">{$coll['coll_name']}</a></li>";
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
            </div>
        </div>
    </div>
    <!-- End main Content -->
    <!-- Start Search Popup -->
    <div class="box-search-content search_active block-bg close__top">
        <form id="search_mini_form--2" class="minisearch" action="#">
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
    <!-- End Search Popup -->
    <!-- Footer Area -->
   <?php include 'footer.php';  