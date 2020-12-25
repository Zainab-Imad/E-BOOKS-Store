<?php
session_start();
require 'includes/connection.php';
$conn = mysqli_connect("localhost","root","","divisima");
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "select * from admin where admin_email='$email' and admin_password='$password'";
    $result = mysqli_query($conn, $query);
    $adminSet = mysqli_fetch_assoc($result);
    if(isset($adminSet['admin_id'])){
        $_SESSION['admin_id']=$adminSet['admin_id'];
        $_SESSION['admin_email']=$adminSet['admin_email'];
        header("location:dashboard-ecommerce.php");
    } else{
        $error = "User Not Found";
    }
}
?>


<!doctype html>
<html lang="zxx">

<!-- Mirrored from templates.envytheme.com/fiva-admin-html/login-with-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 16:53:46 GMT -->
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Vendors Min CSS -->
    <link rel="stylesheet" href="assets/css/vendors.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="assets/css/responsive.css">

    <title>Fiva - Bootstrap 4 Admin Dashboard Template</title>

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
</head>

<body>

<!-- Start Login Area -->
<div class="login-area bg-image">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="login-form">
                <div class="logo">
                    <a href="dashboard-analytics.php"><img src="assets/img/logo.png" alt="image"></a>
                </div>

                <h2>Welcome</h2>

                <form action="" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="email" placeholder="Email">
                        <span class="label-title"><i class='bx bx-user'></i></span>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <span class="label-title"><i class='bx bx-lock'></i></span>
                    </div>
                    <div class="form-group">
                        <?php if (isset($error)){ echo "<div class='alert alert-danger text-center'>$error</div>";} ?>
                    </div>
                    <div class="form-group">
                        <div class="remember-forgot">
                            <label class="checkbox-box">Remember me
                                <input type="checkbox">
                                <span class="checkmark"></span>
                            </label>

                            <a href="forgot-password.html" class="forgot-password">Forgot password?</a>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="login-btn">Login</button>

                    <p class="mb-0">Don’t have an account? <a href="register-with-image.php ">Sign Up</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Login Area -->


<!-- Vendors Min JS -->
<script src="assets/js/vendors.min.js"></script>

<!-- ApexCharts JS -->
<script src="assets/js/apexcharts/apexcharts.min.js"></script>
<script src="assets/js/apexcharts/apexcharts-stock-prices.js"></script>
<script src="assets/js/apexcharts/apexcharts-irregular-data-series.js"></script>
<script src="assets/js/apexcharts/apex-custom-line-chart.js"></script>
<script src="assets/js/apexcharts/apex-custom-pie-donut-chart.js"></script>
<script src="assets/js/apexcharts/apex-custom-area-charts.js"></script>
<script src="assets/js/apexcharts/apex-custom-column-chart.js"></script>
<script src="assets/js/apexcharts/apex-custom-bar-charts.js"></script>
<script src="assets/js/apexcharts/apex-custom-mixed-charts.js"></script>
<script src="assets/js/apexcharts/apex-custom-radialbar-charts.js"></script>
<script src="assets/js/apexcharts/apex-custom-radar-chart.js"></script>

<!-- ChartJS -->
<script src="assets/js/chartjs/chartjs.min.js"></script>
<div class="chartjs-colors"> <!-- To use template colors with Javascript -->
    <div class="bg-primary"></div>
    <div class="bg-primary-light"></div>
    <div class="bg-secondary"></div>
    <div class="bg-info"></div>
    <div class="bg-success"></div>
    <div class="bg-success-light"></div>
    <div class="bg-danger"></div>
    <div class="bg-warning"></div>
    <div class="bg-purple"></div>
    <div class="bg-pink"></div>
</div>

<!-- jvectormap Min JS -->
<script src="assets/js/jvectormap-1.2.2.min.js"></script>
<!-- jvectormap World Mil JS -->
<script src="assets/js/jvectormap-world-mill-en.js"></script>
<!-- Custom JS -->
<script src="assets/js/custom.js"></script>
</body>

<!-- Mirrored from templates.envytheme.com/fiva-admin-html/login-with-image.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 30 Jan 2020 16:53:46 GMT -->
</html>
