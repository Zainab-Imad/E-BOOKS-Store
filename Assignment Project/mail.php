<?php
if (isset($_POST['send'])){
    $to = $_POST['email'];
    $messege = "thaaank youu ";
    $subject = "hi";
    $headers = "From: zeina.imad.zi@gmail.com";
    if (mail($to,$subject,$messege,$headers)){
        die('send succsessful');
    }else{
        die('fail');
    }

}
