<?php include 'includes/connection.php';
include 'includes/header.php';
?>
<div class="card mb-30">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Total Price</th>
            <th scope="col">Order Id</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select * from orderdetails where order_id={$_GET['order_id']}";
        $result = mysqli_query($conn,$query);
        while($details = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td style='font-size: 20px; font-weight: bold ;'>#{$details['pro_id']}</td>";
            echo "<td>{$details['pro_name']}</td>";
            echo "<td><img width='50' height='50' src='uploads/product/{$details['cat_name']}/{$details['img_one']}'></td>";
            echo "<td>{$details['price']}</td>";
            echo "<td>{$details['qty']}</td>";
            echo "<td>{$details['qty']}.{$details['price']}</td>";
            echo "<td>{$details['order_id']}</td>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php include 'includes/footer.php';
