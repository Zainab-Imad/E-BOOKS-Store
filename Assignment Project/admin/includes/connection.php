<?php
#open connection to database
$conn = mysqli_connect("localhost","root","","divisima");
if (!$conn){
    die(" Cannot to connect to database");
}