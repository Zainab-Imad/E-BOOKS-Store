<?php

include 'admin/includes/connection.php';
include 'header.php';
if (empty($_SESSION['customer'])){

    session_start();
    ob_start();
    echo("<script>location.href = 'my-account.php';</script>");
}
if (isset($_POST['submit'])){
    $name = $_POST['fullName'];
    $country =$_POST['country'];
    $address = $_POST['address'];
    $phone =$_POST['phone'];
    $customerId = $_SESSION['customer'];
    $totalPrice = $_POST['totalPrice'];
    $totalQty =$items;
    $date    = date("Y.m.d");

    $query = "insert into orders (customer_id,recipient_name,country,address,phone,total_price,total_qty,status_id,order_date) 
              values ($customerId,'$name','$country','$address','$phone',$totalPrice,$totalQty,1,'$date')";
    mysqli_query($conn,$query);
    $query = "select order_id from orders where order_id=(select last_insert_id() where customer_id= {$_SESSION['customer']})";
    $result = mysqli_query($conn,$query);
    $fetch = mysqli_fetch_assoc($result);
    $orderId = $fetch['order_id'];
    if (isset($productCart)) {
        foreach ($productCart as $singleProduct){
            $proId   = $singleProduct['pro_id'];
            $qty     = $singleProduct['qty'];
            $name    = $singleProduct['pro_name'];
            $img     = $singleProduct['img_one'];
            $price   = $singleProduct['pro_price'];
            $catName = $singleProduct['cat_name'];

            $query = "insert into orderdetails (pro_id,pro_name,img_one,price,cat_name,qty,order_id) 
                        values ($proId,'$name','$img',$price,'$catName',$qty,$orderId)";
            mysqli_query($conn,$query);
            $query = "update product set pro_qty=pro_qty-$qty where pro_id=$proId";
            mysqli_query($conn,$query);
        }

    }
    unset($_SESSION['product']);
    unset($_SESSION['qty']);
     $message = "<p class=\"alert alert-success\" style=\"font-weight: bold;font-size: 30px;\">
                        Your Order Is Placed <span><i class=\"fa fa-check\"></i></span>
                    </p>";
}
?>
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">Checkout</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index.php">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">Checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Checkout Area -->
    <section class="wn__checkout__area section-padding--lg bg__white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php if (isset($message)){
                        echo $message;
                    }?>
                    <div class="wn_checkout_wrap">
                        <div class="checkout_info">
                            <span>Have a coupon? </span>
                            <a class="showcoupon" href="#">Click here to enter your code</a>
                        </div>
                        <div class="checkout_coupon">
                            <form action="#">
                                <div class="form__coupon">
                                    <input type="text" placeholder="Coupon code">
                                    <button>Apply coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
            <div class="col-lg-6 col-12 md-mt-40 sm-mt-40">
                <div class="wn__order__box">
                    <h3 class="onder__title">Your order</h3>
                    <ul class="order__total">
                        <li>Product</li>
                        <li>Total</li>
                    </ul>
                    <ul class="order_product">
                        <?php if (isset($productCart)){ foreach ($productCart as $singleProduct) {
                            # code...
                            ?>
                            <li><?php echo $singleProduct['pro_name']." at magna × ". $singleProduct['qty']; ?>
                                <span>$ <?php echo $singleProduct['pro_price']*$singleProduct['qty']; ?></span></li>
                        <?php } ?>
                    </ul>
                    <ul class="shipping__method">
                        <li>Cart Subtotal <p class="caty"> <?php echo $sum; ?></p></li>
                        <li>Shipping
                            <ul>
                                <li>
                                    <input class="ship" name="shipping_method[0]" data-index="0" value="48"  type="radio">
                                    <label>Fast Shipping: $48.00</label>

                                </li>
                                <li>
                                    <input class="ship" name="shipping_method[0]" data-index="0" value="0"  type="radio" checked>
                                    <label>Normal Shipping: $00.00</label>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="total__amount">
                        <li>Order Total <span class="orderTotal"><?php echo $sum; ?></span></li>
                    </ul>
                    <?php } else {echo "<h3 class=\"alert-danger text-lg-center\">No Pdoduct in Cart</h3>"; }?>
                </div>

            </div>
                <div class="col-lg-6 col-12">
                    <div class="customer_details">
                        <h3>Billing details</h3>
                        <form action="" method="post">
                        <div class="customar__field">
                            <?php
                            $query="select * from customer where customer_id = {$_SESSION['customer']}";
                            $result = mysqli_query($conn,$query);
                            $customer = mysqli_fetch_assoc($result);
                            ?>
                            <div class="input_box">
                                <label>First name <span>*</span></label>
                                <input type="text" name="fullName" required value="<?php echo $customer['customer_name']; ?>">
                                <input type="hidden" name="totalPrice" value="<?php echo $sum ?>" class="totalPrice">
                            </div>
                            <div class="input_box">
                                <label>Country<span>*</span></label>
                                <select name="country" class="select__option">
                                    <option>Select a country…</option>
                                    <option selected>Jordan</option>
                                </select>
                            </div>
                            <div class="input_box">
                                <label>Address <span>*</span></label>
                                <input type="text" name="address" value="<?php echo $customer['customer_address']; ?>" placeholder="City/ Region/ Street Address/ Builing No." required>
                            </div>
                            <div class="margin_between">
                                <div class="input_box space_between">
                                    <label>Phone <span>*</span></label>
                                    <input type="tel" name="phone" value="<?php echo $customer['customer_phone']; ?>" required>
                                </div>

                                <div class="input_box space_between">
                                    <label>Email address <span>*</span></label>
                                    <input type="email" name="email" value="<?php echo $customer['customer_email']; ?>" required>
                                </div>
                            </div>
                            <div>
                                <input class="btn btn-outline-danger btn-lg btn-block" type="submit" name="submit" value="place order">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- End Checkout Area -->
<?php include 'footer.php';?>
<script>
    $(document).ready(function () {
        $('.ship').change(function(){
            var y =parseInt($('.caty').text());
            var x = parseInt($( this ).val());
            var z =x+y;
            $('.orderTotal').html(z);
            $('.totalPrice').val(z);
        });
    });

</script>
