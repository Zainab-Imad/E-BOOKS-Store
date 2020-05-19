<?php
session_start();
unset($_SESSION['customer']);
header("location:my-account.php");
