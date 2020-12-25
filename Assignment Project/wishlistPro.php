<?php
session_start();
include 'admin/includes/connection.php';
if (isset($_SESSION['wishlist'])) {
    # code...
    echo ('before check array');
    if(in_array($_GET['pro-id'],$_SESSION['wishlist'])) { // if the
        echo ('in check array');
    }else {
        echo ('else');
        $_SESSION['wishlist'][] = $_GET['pro-id'];
    }
}else
{
    echo ('else two ');
    $_SESSION['wishlist'][] =  $_GET['pro-id'];
}
