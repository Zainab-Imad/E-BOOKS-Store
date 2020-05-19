<?php include 'includes/connection.php';

if (isset($_POST['submit'])) {
    # code...
    $name      = $_POST['pro-name'];
    $price     = $_POST['pro-price'];
    $qty       = $_POST['pro-qty'];
    $desc      = $_POST['pro-desc'];
    $author    = $_POST['author-id'];
    $coll      = $_POST['coll-id'];
    $catId     = $_POST['cat-id'];

    $query = "insert into product(pro_name,pro_price,pro_qty,pro_desc,author_id,coll_id,cat_id) values('$name','$price','$qty','$desc','$author','$coll','$catId')";
    mysqli_query($conn, $query);
    header("location:manage_product.php");

}
if(isset($_POST['update'])){
    $proId   = $_POST['update-id'];
    $proName = $_POST['update-name'];
    $price   = $_POST['update-price'];
    $qty       = $_POST['update-qty'];
    $desc      = $_POST['update-desc'];
    $author    = $_POST['update-author'];
    $coll    = $_POST['update-coll'];
    $catId     = $_POST['update-cat'];
    $query = "update product set pro_name='$proName',pro_price=$price,pro_qty='$qty',pro_desc='$desc',author_id=$author,coll_id=$coll,cat_id=$catId where pro_id = $proId";
    mysqli_query($conn,$query);


}

if (isset($_POST['remove'])) {
    # code...
    $id   = $_POST['del-id'];
    $query = "select * from image where pro_id=$id";
    $result = mysqli_query($conn,$query);
    while ($img = mysqli_fetch_assoc($result)) {
        # code...
        $path="uploads/product/";
        unlink($path.$img['img_one']);
        unlink($path.$img['img_two']);
    }
    $query1 = "delete from image where pro_id=$id";
    $query2 = "delete from product where pro_id = $id";
    mysqli_query($conn,$query1);
    mysqli_query($conn,$query2);
}
include 'includes/header.php'; ?>

<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Product</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Product Name</label>
            <input type="text" name="pro-name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Product Price</label>
            <input type="text" name="pro-price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Product Qty</label>
            <input type="number" name="pro-qty" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Product Description</label>
            <input type="text" name="pro-desc" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Product Author</label>
            <select name="author-id"  style="padding: 10px;" class="custom-file-select select-author">
                <?php
                $query = " select * from author ";
                $result = mysqli_query($conn,$query);
                while($author = mysqli_fetch_assoc($result)){
                        echo "<option value='{$author['author_id']}'>{$author['author_name']}</option>";

                }
                ?>
            </select>
        </div>
        <div class="form-group collect" id="collect">
            <label>Product Collection</label>
            <select name="coll-id"  style="padding: 10px;" class="custom-file-select select-coll">
            
            </select>
        </div>
        <div class="form-group">
            <label>Category Name</label>
            <select name="cat-id"  style="padding: 10px;" class="custom-file-select select-cat" required>
                <?php
                $query = " select * from category ";
                $result = mysqli_query($conn,$query);
                while($cat = mysqli_fetch_assoc($result)){
                echo "<option value='{$cat['cat_id']}'>{$cat['cat_name']}</option>";

                }
                ?>
            </select>
        </div>


        <button type="submit" name="submit" class="btn btn-lg btn-primary">Save</button>
    </form>
</div>
<div class="card mb-30">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Qty</th>
            <th scope="col">Description</th>
            <th scope="col">Author</th>
            <th scope="col">Collection</th>
            <th scope="col">Category</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select pro_id,pro_name,pro_price,pro_qty,pro_desc,product.author_id,product.coll_id,author_name,coll_name,cat_name,product.cat_id from product 
 inner join category on product.cat_id=category.cat_id 
 inner join author on product.author_id = author.author_id 
 inner join collection on product.coll_id=collection.coll_id order by product.pro_id asc ";
        $result = mysqli_query($conn,$query);
        while($pro = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$pro['pro_id']}</td>";
            echo "<td>{$pro['pro_name']}</td>";
            echo "<td>{$pro['pro_price']}</td>";
            echo "<td>{$pro['pro_qty']}</td>";
            echo "<td>{$pro['pro_desc']}</td>";
            if($pro['author_id'] == 1){ echo "<td>No Author</td>";}else{echo "<td>{$pro['author_name']}</td>";}
            if ($pro['coll_id']!=1) {
                echo "<td>{$pro['coll_name']}</td>";
            } else {
                echo "<td>No Collection</td>";
            }
            echo "<td>{$pro['cat_name']}</td>";
            echo "<td><button cat_id='{$pro['cat_id']}' coll_id='{$pro['coll_id']}' author_id='{$pro['author_id']}' class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                   Update
                                    </button></td>";
            echo "<td><button pro_id='{$pro['pro_id']}' pro_name='{$pro['pro_name']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
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
                    <label>Update Name</label>
                    <input id="cc-payment" name="update-id" type="hidden"  value="" class="update-id form-control">
                    <input id="cc-payment" name="update-name" type="text"  value="" class="update-name form-control">
                </div>
                <div class="modal-body">
                    <label>Update Price</label>
                    <input id="cc-payment" name="update-price" type="text"  value="" class="update-price form-control">
                </div>
                <div class="modal-body">
                    <label>Update Qty</label>
                    <input id="cc-payment" name="update-qty" type="number"  value="" class="update-qty form-control">
                </div>
                <div class="modal-body">
                    <label>Update Description</label>
                    <input id="cc-payment" name="update-desc" type="text"  value="" class="update-desc form-control">
                </div>
                <div class="modal-body">
                    <label>Update author</label>
                    <select name="update-author" style="padding: 10px;" id="update-author" class="update-author custom-file-select">
                        <?php
                        $query = " select * from author ";
                        $result = mysqli_query($conn,$query);
                        while($author = mysqli_fetch_assoc($result)){
                            echo "<option value='{$author['author_id']}'>{$author['author_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-body">
                    <label>Update collection</label>
                    <select name="update-coll" style="padding: 10px;" id="update-coll" class="update-coll custom-file-select">
                        <?php
                        $query = " select * from collection ";
                        $result = mysqli_query($conn,$query);
                        while($coll = mysqli_fetch_assoc($result)){
                            echo "<option value='{$coll['coll_id']}'>{$coll['coll_name']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="modal-body">
                    <label>Update Category</label>
                    <select name="update-cat" style="padding: 10px;" id="update-cat" class="update-cat custom-file-select">
                        <?php
                        $query = " select * from category ";
                        $result = mysqli_query($conn,$query);
                        while($cat = mysqli_fetch_assoc($result)){
                            echo "<option value='{$cat['cat_id']}'>{$cat['cat_name']}</option>";
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
                    <label id="cc-payment" class="form-control">Are you sure you want to remove <span class="delCatName text-danger"></span> ?</label>

                    <input id="cc-payment" name="del-id" type="hidden"  value="" class="delID form-control">
                </div>
                <div class="modal-footer">
                    <input id="payment-button" type="submit" name="remove" value="Remove" class="btn btn-lg btn-info">

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.update').click(function (){
            $tr = $(this).closest('tr');
            var data = $tr.children('td').map(function () {
                return $(this).text();
            }).get();
            console.log(data);
            $('.update-id').val(data[0]);
            $('.update-name').val(data[1]);
            $('.update-price').val(data[2]);
            $('.update-qty').val(data[3]);
            $('.update-desc').val(data[4]);

            var author_Id = $(this).attr('author_id');
            $('.update-author option[value="' + author_Id + '"]').remove();
            $('.update-author').prepend('<option value="' + author_Id + '" selected>' + data[5] + '</option>');
            
            var coll_Id = $(this).attr('coll_id');
            $('.update-coll option[value="'+coll_Id+'"]').remove();
            $('.update-coll').prepend('<option value="'+coll_Id+'" selected>'+data[6]+'</option>');
            

            var cat_Id = $(this).attr('cat_id');
            $('.update-cat option[value="'+cat_Id+'"]').remove();
            $('.update-cat').prepend('<option value="'+cat_Id+'" selected>'+data[7]+'</option>');

        });


    $('#collect').hide();
    $('.select-author').change(function () {

        $('#collect').show();
        var author_id = $('.select-author').val();
        $.ajax({
           type : "GET",
           url :"authorId.php?author-id="+author_id,
           success : function (data) {
               $('.select-coll').html(data);
           }
        });

    });

    $('.remove').click(function () {
        var id   = $(this).attr('pro_id');
        var name =$(this).attr('pro_name');
        $('.delID').val(id);
        $('.delCatName').html(name);
    });
    });
</script>

<?php include 'includes/footer.php'; ?>