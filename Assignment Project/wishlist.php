<?php
include 'admin/includes/connection.php';
include 'header.php';

if (isset($_SESSION['wishlist'])) {
    # code..
    foreach ($_SESSION['wishlist'] as $pro_id) {
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
            $productWish[] = $row;
        }
    }
}
function remove_wish($Id){
    $Id  = intval($Id);
    $max = count($_SESSION['product']);
    for($i=0 ; $i<$max ; $i++){
        if($_SESSION['wishlist'][$i] == $Id){
            unset($_SESSION['wishlist'][$i]);
        }
    }
    $_SESSION['wishlist']=array_values($_SESSION['wishlist']);
    echo("<script>location.href = 'wishlist.php';</script>");
}
if (isset ( $_GET ['wishRemove'] )) {
    $key = $_GET['wishRemove'];
    remove_wish($key);
}
?>


<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area bg-image--5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="bradcaump__inner text-center">
                    <h2 class="bradcaump-title">Wishlist</h2>
                    <nav class="bradcaump-content">
                        <a class="breadcrumb_item" href="index.php">Home</a>
                        <span class="brd-separetor">/</span>
                        <span class="breadcrumb_item active">Wishlist</span>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="wishlist-area section-padding--lg bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table wnro__table table-responsive">
                            <table>
                                <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name"><span class="nobr">Product Name</span></th>
                                    <th class="product-price"><span class="nobr"> Unit Price </span></th>
                                    <th class="product-stock-stauts"><span class="nobr"> Stock Status </span></th>
                                    <th class="product-add-to-cart"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                if (isset($productWish)){
                                    foreach ($productWish as $singleWish){

                                ?>
                                <tr>
                                    <td class="product-remove"><a href="?wishRemove=<?php echo $singleWish['pro_id']; ?>">×</a></td>
                                    <td class="product-thumbnail"><a href="#"><img width="80" height="100" src="admin/uploads/product/<?php echo $singleWish['cat_name'].'/'.$singleWish['img_one']; ?>" alt=""></a></td>
                                    <td class="product-name"><a href="#"><?php echo $singleWish['pro_name'] ?></a></td>
                                    <td class="product-price"><span class="amount">$ <?php echo $singleWish['pro_price'] ?></span></td>
                                    <td class="product-add-to-cart"><a href="single-product.php?proId=<?php echo $singleWish['pro_id'] ?>"> Add to Cart</a></td>
                                </tr>
                                    <?php }
                                }else {
                                    echo "<tr><td colspan='6'><p class='text-center alert-danger'>No Product Found</p></td></tr>";
                                } ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->
<?php include 'footer.php';
