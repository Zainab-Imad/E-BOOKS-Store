<?php session_start();
include 'admin/includes/connection.php';
if (isset($_SESSION['wishlist'])) {
    # code...
    if(in_array($_GET['pro-id'],$_SESSION['wishlist'])) { // if the

    }else {
        $_SESSION['wishlist'][] =$_GET['pro-id'];
    }}
