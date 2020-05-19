<?php include 'includes/connection.php';
include 'includes/header.php';

if (isset($_POST['update'])){
    $orderId = $_POST['update-id'];
    $status  = $_POST['update-status'];

    $query   = "update orders set status_id='$status' where order_id =$orderId";
    mysqli_query($conn,$query);
}

if (isset($_POST['remove'])){
    $orderId = $_POST['del-id'];

    $query   = "delete from orders where order_id = $orderId";
    mysqli_query($conn,$query);
    $query   = "delete from orderdetails where order_id=$orderId";
    mysqli_query($conn,$query);
}
?>

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Orders</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Search</label>
            <input type="search" id="search" name="search" class="form-control search-order" required>
        </div>

    </form>
</div>
<div class="card mb-30">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Recipient Name</th>
            <th scope="col">Country</th>
            <th scope="col">Address</th>
            <th scope="col">Phone</th>
            <th scope="col">Total Price</th>
            <th scope="col">Total Qty</th>
            <th scope="col">Status</th>
            <th scope="col">Details</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select order_id,orders.customer_id,customer_name,recipient_name,country,address,phone,total_price,total_qty,orders.status_id,status_name 
                   from orders 
                   inner join customer on orders.customer_id=customer.customer_id
                   inner join orderstatus on orders.status_id=orderstatus.status_id
                   order by order_id asc";
        $result = mysqli_query($conn,$query);
        while($order = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td style='font-size: 20px; font-weight: bold ;'>#{$order['order_id']}</td>";
            echo "<td>{$order['customer_name']}</td>";
            echo "<td>{$order['recipient_name']}</td>";
            echo "<td>{$order['country']}</td>";
            echo "<td>{$order['address']}</td>";
            echo "<td>{$order['phone']}</td>";
            echo "<td>{$order['total_price']}</td>";
            echo "<td>{$order['total_qty']}</td>";
            echo "<td class='status-name'>{$order['status_name']}</td>";
            echo "<td><a class='btn btn-primary mb-1' href='order_details.php?order_id={$order['order_id']}'>
                                    Products
                                    </a></td></td>";
            echo "<td><button order_id='{$order['order_id']}' status_id='{$order['status_id']}' status_name='{$order['status_name']}' class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                    Update
                                    </button></td>";
            echo "<td><button order_id='{$order['order_id']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
                                    Remove
                                    </button></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<div class='modal fade' id='updateModal' tabindex='-1' role='dialog' aria-labelledby='mediumModalLabel' aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">UPDATE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input id="cc-payment" name="update-id" type="hidden"  value="" class="update-id form-control">
                </div>
                <div class="modal-body">
                    <label>Update Status</label>
                    <select name="update-status" style="padding: 10px;" id="update-status" class="update-status custom-file-select">
                        <?php
                        $query = " select * from orderstatus ";
                        $result = mysqli_query($conn,$query);
                        while($status = mysqli_fetch_assoc($result)){
                            echo "<option value='{$status['status_id']}'>{$status['status_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-footer">
                    <input id="payment-button" type="submit" name="update" value="Save" class="btn btn-lg btn-info">

                </div>
            </form>
        </div>
    </div>
</div>
<div class='modal fade' id='removeModal' tabindex='-1' role='dialog' aria-labelledby='mediumModalLabel' aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">REMOVE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label id="cc-payment" class="form-control">Are you sure you want to remove #<span class="delOrder text-danger"></span> order?</label>
                    <input id="cc-payment" name="del-id" type="hidden"  value="" class="delID form-control">
                </div>
                <div class="modal-footer">
                    <input id="payment-button" type="submit" name="remove" value="Remove" class="btn btn-lg btn-info">

                </div>
            </form>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

<script>
    $(document).ready(function () {
        $('.update').click(function () {
            var id = $(this).attr('order_id');
            $('.update-id').val(id);
            var status_id = $(this).attr('status_id');
            var status_name = $(this).attr('status_name');
            $('.update-status option[value="' + status_id + '"]').remove();
            $('.update-status').prepend('<option value="' + status_id + '" selected>' + status_name + '</option>');
        });

        $('.remove').click(function () {
            var id = $(this).attr('order_id');
            $('.delID').val(id);
            $('.delOrder').html(id);
        });
        $(".search-order").keyup(function () {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

    });
</script>
