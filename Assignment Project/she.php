


<?php

//database_connection.php
include 'admin/includes/connection.php';

?>


index.php




<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
<!-- Page Content -->
<div class="container">
    <div class="row">
        <br />
        <h2 align="center">Advance Ajax Product Filters in PHP</h2>
        <br />
        <div class="col-md-3">
            <div class="list-group">
                <h3>Price</h3>
                <input type="hidden" id="hidden_minimum_price" value="0" />
                <input type="hidden" id="hidden_maximum_price" value="65000" />
                <p id="price_show">1000 - 65000</p>
                <div id="price_range"></div>
            </div>




            <div class="list-group">
                <h3>Internal categor</h3>
                <?php
                $query = "
                    SELECT * FROM category 
                    ";
                $statement = mysqli_query($conn,$query);

                while($result =mysqli_fetch_assoc($statement)){

                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector storage" value="" > <?php echo $result['cat_id'];?> GB</label>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

        <div class="col-md-9">
            <br />
            <div class="row filter_data">

            </div>
        </div>
    </div>

</div>
<style>
    #loading
    {
        text-align:center;
        background: url('loader.gif') no-repeat center;
        height: 150px;
    }
</style>

<script>
    $(document).ready(function(){

        filter_data();

        function filter_data()
        {
            $('.filter_data').html('<div id="loading" style="" ></div>');
            var action = 'fetch_data';
            var minimum_price = $('#hidden_minimum_price').val();
            var maximum_price = $('#hidden_maximum_price').val();
            var brand = get_filter('brand');
            var ram = get_filter('ram');
            var storage = get_filter('storage');
            $.ajax({
                url:"fetch_data.php",
                method:"POST",
                data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
                success:function(data){
                    $('.filter_data').html(data);
                }
            });
        }

        function get_filter(class_name)
        {
            var filter = [];
            $('.'+class_name+':checked').each(function(){
                filter.push($(this).val());
            });
            return filter;
        }

        $('.common_selector').click(function(){
            filter_data();
        });

        $('#price_range').slider({
            range:true,
            min:1000,
            max:65000,
            values:[1000, 65000],
            step:500,
            stop:function(event, ui)
            {
                $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
                $('#hidden_minimum_price').val(ui.values[0]);
                $('#hidden_maximum_price').val(ui.values[1]);
                filter_data();
            }
        });

    });
</script>

</body>

</html>


fetch_data.php


<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
    $query = "
  SELECT * FROM product WHERE product_status = '1'
 ";
    if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
    {
        $query .= "
   AND product_price BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
  ";
    }
    if(isset($_POST["brand"]))
    {
        $brand_filter = implode("','", $_POST["brand"]);
        $query .= "
   AND product_brand IN('".$brand_filter."')
  ";
    }
    if(isset($_POST["ram"]))
    {
        $ram_filter = implode("','", $_POST["ram"]);
        $query .= "
   AND product_ram IN('".$ram_filter."')
  ";
    }
    if(isset($_POST["storage"]))
    {
        $storage_filter = implode("','", $_POST["storage"]);
        $query .= "
   AND product_storage IN('".$storage_filter."')
  ";
    }

    $statement = $conn->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    $total_row = $statement->rowCount();
    $output = '';
    if($total_row > 0)
    {
        foreach($result as $row)
        {
            $output .= '
   <div class="col-sm-4 col-lg-3 col-md-3">
    <div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
     <img src="image/'. $row['product_image'] .'" alt="" class="img-responsive" >
     <p align="center"><strong><a href="#">'. $row['product_name'] .'</a></strong></p>
     <h4 style="text-align:center;" class="text-danger" >'. $row['product_price'] .'</h4>
     <p>Camera : '. $row['product_camera'].' MP<br />
     Brand : '. $row['product_brand'] .' <br />
     RAM : '. $row['product_ram'] .' GB<br />
     Storage : '. $row['product_storage'] .' GB </p>
    </div>

   </div>
   ';
        }
    }
    else
    {
        $output = '<h3>No Data Found</h3>';
    }
    echo $output;
}

?>



Download Source Code




Share This:   Facebook Twitter Google+ Stumble Digg
Email This
BlogThis!
Share to Twitter
Share to Facebook
Related Posts:
How to Make Product Filter in php using Ajax
Most of the e-commerce websites provide nice UI for filter product on their website by using different type of search filter like price range pro… Read More
Newer PostOlder PostHome
19 comments:

Unknown2 September 2018 at 02:31
Great Bossssssssssssssssssssssssssssssss!!

Reply

Unknown3 September 2018 at 04:44
Thank you for this!!!

Reply

Unknown4 September 2018 at 09:59
how to use Pagination in this ?

Reply

Adeel AHmad12 September 2018 at 14:31
v niceeee

Reply

Unknown20 September 2018 at 23:27
How to make pagination?

Reply

Unknown30 September 2018 at 09:24
Thank you for this.

Reply

Unknown5 October 2018 at 03:35
It does not have database. Where is the sql file?

Reply
Replies

Unknown16 October 2018 at 05:04
copy database and create new database

Reply

Unknown6 October 2018 at 18:34
How can I put a select option with products name? obrigado

Reply

Dicko Network27 October 2018 at 18:17
Je suis vraiment content, parceque j'ai beaucoup appris à votre côté. Merci proffeseur .

Reply

Dicko Network27 October 2018 at 18:47
s'il vous plaît, vous pouvez créer le droit d'accessoires aux pages ?
Vraiment ça sera très super. Merci .

Reply
Replies

Unknown23 November 2018 at 12:38
C'est une bonnee idée merci

Reply

Unknown29 October 2018 at 23:41
please add pagination on this video ?﻿

Reply

Unknown30 October 2018 at 09:41
Perfect , Thanks

Reply

Unknown30 October 2018 at 09:43
thank you so mauch

Reply

ram12 November 2018 at 23:37
how to use Pagination in this ?

Reply

Unknown7 December 2018 at 11:54
sir Database nai mili

Reply

Unknown14 January 2019 at 11:42
Hello Sir, The download link is corrupted now .Can you please re upload the link . it will be usefull to us

Reply

Chuks Perspective30 January 2019 at 08:26
wow!!! this is awesome
but am having some issues. it seems the js disables some other js codes in my php script.

Reply







Popular Posts
Live Chat System in PHP using Ajax JQuery
PHP MySql Based Online Exam System Project
Bootstrap Multi Select Dropdown with Checkboxes using Jquery in PHP
How to make Login with Google Account using PHP
Online Student Attendance System in PHP Mysql
How to Make Product Filter in php using Ajax
Live Add Edit Delete Datatables Records using PHP Ajax
Simple PHP Mysql Shopping Cart
Dynamically Add / Remove input fields in PHP with Jquery Ajax
PHP Ajax Update MySQL Data Through Bootstrap Modal


Search for:
Search

Copyright © 2020 Webslesson