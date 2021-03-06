

<?php 

include 'admin/includes/connection.php';
include 'header.php';
?>
		<!-- End Search Popup -->
        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Shopping Cart</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Shopping Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- cart-main-area start -->
        <div class="cart-main-area section-padding--lg bg--white">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 ol-lg-12">
                        <form action="#">               
                            <div class="table-content wnro__table table-responsive">
                                <table>
                                    <thead>
                                        <tr class="title-top">
                                            <th class="product-thumbnail">Image</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($productCart)){ foreach ($productCart as $singleProduct) {
                                            # code...
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="admin/uploads/product/<?php echo $singleProduct['cat_name'].'/'.$singleProduct['img_one'] ?>" alt="product img"></a></td>
                                            <td class="product-name"><a href="#"><?php echo $singleProduct['pro_name'] ?></a></td>
                                            <td class="product-price"><span class="amount">$ <?php echo $singleProduct['pro_price'] ?></span></td>
                                            <td class="product-quantity"><?php echo $singleProduct['qty'] ?></td>
                                            <td class="product-subtotal">$ <?php echo $singleProduct['pro_price']*$singleProduct['qty']; ?></td>
                                            <td class="product-remove"><a href="?proIdRemove=<?php echo $singleProduct['pro_id'] ?>">X</a></td>
                                        </tr>
                                    <?php }}else echo "<tr><td colspan='6'><p class='text-center alert-danger'>No Product Found</p></td></tr>";?>
                                    </tbody>
                                </table>
                            </div>
                        </form>
                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li><a href="index.php">Home</a></li>
                                <li><div class="mini_action checkout">
                                        <a class="checkout__btn" style="background-color: #000000;color: white" href="checkout.php">Go to Checkout</a>
                                    </div></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-lg-6">
                        <div class="cartbox__total__area">
                            <div class="cartbox-total d-flex justify-content-between">
                                <ul class="cart__total__list">
                                    <li>Qty total</li>
                                </ul>
                                <ul class="cart__total__tk">
                                    <li><?php echo $items;?></li>
                                </ul>
                            </div>
                            <div class="cart__total__amount">
                                <span>Grand Total</span>
                                <span>$ <?php echo $sum;?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
        <!-- cart-main-area end -->
		<?php include 'footer.php'; ?>
