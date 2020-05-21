<?php include 'admin/includes/connection.php';
$query ="select product.pro_id,pro_name,pro_price,pro_desc,pro_qty,
product.author_id,product.coll_id,product.cat_id,image.img_one,image.img_two,author_name,coll_name,cat_name 
from product 
inner join category on product.cat_id=category.cat_id 
inner join author on product.author_id=author.author_id 
inner join collection on product.coll_id=collection.coll_id 
inner join image on product.pro_id=image.pro_id where product.pro_id=  {$_GET['pro-id']}";
$result = mysqli_query($conn,$query);
while ($pro = mysqli_fetch_assoc($result)){
    ?>
<div class="product-images">
    <div class="main-image images">
        <img width="420"  height="614" alt="big images" src="admin/uploads/product/<?php echo $pro['cat_name'].'/'.$pro['img_one']; ?>">
    </div>
</div>
<!-- end product images -->
<div class="product-info">
    <h1><?php echo $pro['pro_name']; ?></h1>

    <div class="price-box-3">
        <div class="s-price-box">
            <span class="new-price">$ <?php echo $pro['pro_price']; ?></span>
        </div>
    </div>
    <div class="quick-desc">
        <?php echo $pro['pro_desc']; ?>
    </div>

    <div class="social-sharing">
        <div class="widget widget_socialsharing_widget">
            <h3 class="widget-title-modal">Share this product</h3>
            <ul class="social__net social__net--2 d-flex justify-content-start">
                <li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                <li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                <li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                <li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="addtocart-btn">
        <a href="single-product.php?proId=<?php echo $pro['pro_id']; ?>">Add to cart</a>
    </div>
</div>
<?php } ?>
