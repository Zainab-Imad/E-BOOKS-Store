<?php
#open connection to database
namespace login;

$conn = mysqli_connect("localhost","root","","divisima");
if (!$conn){
    die(" Cannot to connect to database");
}