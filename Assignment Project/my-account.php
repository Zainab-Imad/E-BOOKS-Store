<?php

require_once 'admin/includes/connection.php';
session_start();
//$conn = mysqli_connect("localhost","root","","divisima");

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "select * from customer where customer_email='$email' and customer_password='$password'";
    $result = mysqli_query($conn, $query);

    $customer = mysqli_fetch_assoc($result);

    if(isset($customer['customer_id'])){
        $_SESSION['customer'] = $customer['customer_id'];
        header("location:checkout.php");
    } else{
        $error = "User Not Found";
    }
}
if (isset($_POST['register'])){
    session_start();

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];
    $country  = $_POST['country'];
    $address  = $_POST['address'];
    $phone    = $_POST['phone'];
    $query    = "insert into customer (customer_name,customer_email,customer_country,customer_address,customer_phone,password) 
                 values ('$name','$email','$country','$address','$phone','$password')";
    $result   = mysqli_query($conn, $query);
    $customer = mysqli_fetch_assoc($result);
    $query    = "select * from customer where customer_email='$email' and customer_password='$password'";
    $result   = mysqli_query($conn, $query);
    $customer = mysqli_fetch_assoc($result);

    header('location:my-account.php');
}
include 'header.php';

?>

<!-- End Search Popup -->
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area bg-image--6">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="bradcaump__inner text-center">
                        <h2 class="bradcaump-title">My Account</h2>
                        <nav class="bradcaump-content">
                            <a class="breadcrumb_item" href="index.php">Home</a>
                            <span class="brd-separetor">/</span>
                            <span class="breadcrumb_item active">My Account</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start My Account Area -->
    <section class="my_account_area pt--80 pb--55 bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Login</h3>
                        <form action="" method="post">
                            <div class="account__form">
                                <div class="input__box">
                                    <label>Username or email address <span>*</span></label>
                                    <input type="email" name="email">
                                </div>
                                <div class="input__box">
                                    <label>Password<span>*</span></label>
                                    <input type="password" name="password">
                                </div>
                                <div class="input__box">
                                    <?php if (isset($error)){ echo "<div class='alert alert-danger text-center'>$error</div>";} ?>
                                </div>
                                <div class="form__btn">
                                    <button name="login">Login</button>
                                    <label class="label-for-checkbox">
                                        <input id="rememberme" class="input-checkbox" name="rememberme" value="forever" type="checkbox">
                                        <span>Remember me</span>
                                    </label>
                                </div>
                                <a class="forget_pass" href="#">Lost your password?</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="my__account__wrapper">
                        <h3 class="account__title">Register</h3>
                        <form action="" method="post">
                            <div class="account__form">
                                <div class="input__box">
                                    <label>Name <span>*</span></label>
                                    <input type="text" name="name">
                                </div>
                                <div class="input__box">
                                    <label>Email address <span>*</span></label>
                                    <input type="email" name="email">
                                </div>
                                <div class="input__box">
                                    <label>Password <span>*</span></label>
                                    <input type="password" name="password" id="password">
                                </div>
                                <div class="input__box">
                                    <label>Confirm Password <span>*</span></label>
                                    <input type="password" id="confirm_password">
                                    <div class="alert-danger text-center" style="padding: 5px;" id='message'></div>
                                </div>
                                <div class="input__box">
                                    <label>Country<span>*</span></label>
                                    <select name="country" class="select__option">
                                        <option>Select a country…</option>
                                        <option selected>Jordan</option>
                                    </select>
                                </div>
                                <div class="input__box">
                                    <label>Address <span>*</span></label>
                                    <input type="text" name="address">
                                </div>
                                <div class="input__box">
                                    <label>Phone <span>*</span></label>
                                    <input type="tel" name="phone">
                                </div>
                                <div class="form__btn">
                                    <button name="register">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End My Account Area -->
<?php include 'footer.php';?>
<script>
    $('#message').hide();
    $('#password, #confirm_password').on('keyup', function () {
        if ($('#password').val() == $('#confirm_password').val()) {
            $('#message').show();
            $('#message').html('Matching').css('color', 'green');
        } else
            $('#message').show();
        $('#message').html('Not Matching').css('color', 'red');
    });
</script>
