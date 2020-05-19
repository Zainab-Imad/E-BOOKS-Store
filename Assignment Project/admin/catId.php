<?php
include 'includes/connection.php';

$query = "select pro_id,pro_name from product inner join category on product.cat_id=category.cat_id where product.cat_id={$_GET['cat-id']}";
$result = mysqli_query($conn,$query);
while($pro = mysqli_fetch_assoc($result)){
    echo "<option value='{$pro['pro_id']}'>{$pro['pro_name']}</option>";
}
