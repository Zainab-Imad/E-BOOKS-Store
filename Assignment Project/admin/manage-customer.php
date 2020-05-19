<?php require 'includes/connection.php';
include 'includes/header.php';
?>





<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Customer</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <div class="form-group">
        <label>Search</label>
        <input type="search" id="search" name="search" class="form-control search-customer" required>
    </div>
</div>
<div class="card mb-30">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Email</th>
            <th scope="col">Country</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select * from customer ";
        $result = mysqli_query($conn,$query);
        while($customer = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$customer['customer_id']}</td>";
            echo "<td>{$customer['customer_name']}</td>";
            echo "<td>{$customer['customer_email']}</td>";
            echo "<td>{$customer['customer_country']}</td>";
            echo "<td>{$customer['customer_address']}</td>";
            echo "<td>{$customer['customer_phone']}</td>";
        }
        ?>
        </tbody>
    </table>
</div>
<?php include 'includes/footer.php';?>
<script>
    $(document).ready(function () {
        $(".search-customer").keyup(function () {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
