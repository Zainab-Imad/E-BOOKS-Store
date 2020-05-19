<?php include 'includes/connection.php';
if (isset($_POST['submit'])) {
    $allowed      = array('gif','png', 'jpg','jpeg');
    $cat          = $_POST['cat-id'];
    $cat_ar       = explode('O',$cat);
    $catId        = $cat_ar[0];
    $catName      = $cat_ar[1];
    $proId        = $_POST['pro-id'];
    $imgOne       = $_FILES['pro-img1']['name'];
    $img_tmpOne   = $_FILES['pro-img1']['tmp_name'];
    $imgTwo       = $_FILES['pro-img2']['name'];
    $img_tmpTwo   = $_FILES['pro-img2']['tmp_name'];
    $extOne       = pathinfo($imgOne, PATHINFO_EXTENSION);
    $extTwo       = pathinfo($imgTwo, PATHINFO_EXTENSION);
    $path         = 'uploads/product/';

    if(file_exists($path.$catName)){

    }else{
        mkdir($path."$catName");
    }

    move_uploaded_file($img_tmpOne, $path.$catName.'/'.$imgOne);
    move_uploaded_file($img_tmpTwo, $path.$catName.'/'.$imgTwo);
    $query = "insert into image(img_one,img_two,pro_id) values ('$imgOne','$imgTwo',$proId)";
    mysqli_query($conn,$query);


}

if (isset($_POST['update'])) {
    # code...
    $allowed      = array('gif','png', 'jpg','jpeg');
    $imgId        = $_POST['update-id'];
    $oldImgOne    = $_POST['img_one'];
    $oldImgTwo    = $_POST['img_two'];
    $imgOne       = $_FILES['update-imgOne']['name'];
    $img_tmpOne   = $_FILES['update-imgOne']['tmp_name'];
    $imgTwo       = $_FILES['update-imgTwo']['name'];
    $img_tmpTwo   = $_FILES['update-imgTwo']['tmp_name'];
    $extOne       = pathinfo($imgOne, PATHINFO_EXTENSION);
    $extTwo       = pathinfo($imgTwo, PATHINFO_EXTENSION);
    $catName      = $_POST['update-pro-catName'];
    $path         = 'uploads/product/';

    if($_FILES['update-imgOne']['error'] == 0 ) { // If Choose the Image Done, DO!
        if (in_array($extOne, $allowed)){ // If the Extension right, DO!
            unlink($path.$catName.'/'.$oldImgOne);
            move_uploaded_file($img_tmpOne, $path.$catName."/".$imgOne);
            $query = "update image set img_one='$imgOne' where img_id =$imgId";
            mysqli_query($conn, $query);
            header("location:manage_image.php");

        }else{ // If the Extension wrong. DO!
                header("error-500-with-image.php");
        }
    }
    if($_FILES['update-imgTwo']['error'] == 0 ) { // If Choose the Image Done, DO!
        if (in_array($extTwo, $allowed)){ // If the Extension right, DO!
            unlink($path.$catName.'/'.$oldImgTwo);
            move_uploaded_file($img_tmpTwo, $path.$catName."/".$imgTwo);
            $query = "update image set img_two='$imgTwo' where img_id =$imgId";
            mysqli_query($conn, $query);
            header("location:manage_image.php");

        }else{ // If the Extension wrong. DO!
                header("error-500-with-image.html");
            }
    }
}
include 'includes/header.php';
?>


<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Image</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Product Image one</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="pro-img1" class="custom-file-input" required>
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Product Image two</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="pro-img2" class="custom-file-input" required>
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Select Category</label>
            <select name="cat-id"  style="padding: 10px;" class="custom-file-select cat-select">
                <?php
                $query = " select * from category ";
                $result = mysqli_query($conn,$query);
                while($cat = mysqli_fetch_assoc($result)){
                    echo "<option value='{$cat['cat_id']}O{$cat['cat_name']}'>{$cat['cat_name']}</option>";

                }
                ?>
            </select>
        </div>
        <div class="form-group prody">
            <label>Select Product</label>
            <select name="pro-id"  style="padding: 10px;" class="custom-file-select pro-select">

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
            <th scope="col">Image One</th>
            <th scope="col">Image two</th>
            <th scope="col">Product Name</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = "select img_id,img_one,img_two,image.pro_id,pro_name,cat_name,product.cat_id from image inner join product on image.pro_id=product.pro_id inner join category on product.cat_id=category.cat_id ";
        $result = mysqli_query($conn,$query);
        while($img = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$img['img_id']}</td>";
            echo "<td><img width='50' height='50' src='uploads/product/{$img['cat_name']}/{$img['img_one']}'></td>";
            echo "<td><img width='50' height='50' src='uploads/product/{$img['cat_name']}/{$img['img_two']}'></td>";
            echo "<td>{$img['pro_name']}</td>";
            echo "<td><button img_id='{$img['img_id']}' pro_name='{$img['pro_name']}' pro_id='{$img['pro_id']}' img_one='{$img['img_one']}' img_two='{$img['img_two']}' cat_name='{$img['cat_name']}'  class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                   Update
                                    </button></td>";
            echo "<td><button img_id='{$img['img_id']}' pro_name='{$img['pro_name']}' img_one='{$img['img_one']}' img_two='{$img['img_two']}' cat_name='{$img['cat_name']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
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
                <h5 class="modal-title" id="mediumModalLabel">UPDATE On <span class="proName text-danger"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <label></label>
                    <input id="cc-payment" name="update-id" type="text"  value="" class="update-id form-control">
                    <input id="cc-payment" name="img_one" type="text"  value="" class="img_one form-control">
                    <input id="cc-payment" name="img_two" type="text"  value="" class="img_two form-control">
                    <input id="cc-payment" name="update-pro-catName" type="text"  value="" class="update-pro-catName form-control">
                </div>
                <div class="modal-body">
                    <label>Update Image One</label>
                    <input id="cc-payment" name="update-imgOne" type="file"  value="" class="update-imgOne form-control">
                </div>
                <div class="modal-body">
                    <label>Update Image Two</label>
                    <input id="cc-payment" name="update-imgTwo" type="file"  value="" class="update-imgTwo form-control">
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
                    <label id="cc-payment" class="form-control">Are you sure you want to remove <span class="delCollName text-danger"></span> Images ?</label>

                    <input id="cc-payment" name="del-id" type="hidden"  value="" class="delID form-control">
                    <input id="cc-payment" name="del-img-one" type="hidden"  value="" class="del-img-one form-control">
                    <input id="cc-payment" name="del-img-two" type="hidden"  value="" class="del-img-two form-control">
                    <input id="cc-payment" name="del-file" type="hidden"  value="" class="del-file form-control"> <!-- the file images by folder with category name -->
                </div>
                <div class="modal-footer">
                    <p class="text-muted">This will be the images deleted from folder too ! </p>
                    <input id="payment-button" type="submit" name="remove" value="Remove" class="btn btn-lg btn-info">

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.prody').hide();
        $('.cat-select').change(function () {
            $('.prody').show();
            var cat     = $('.cat-select').val();
            var cat_arr = cat.split('O');
            var cat_id  =cat_arr[0];
            $.ajax({
                type : "GET",
                url :"catId.php?cat-id="+cat_id,
                success : function (data) {

                    $('.pro-select').html(data);
                }
            });
        });

        $('.update').click(function (){
            var img_id   = $(this).attr('img_id'); //to update on row img_id
            var pro_name = $(this).attr('pro_name'); // to appear the name on modal
            var cat_name = $(this).attr('cat_name'); // to update the img based on file name
            var img_one  = $(this).attr('img_one'); // to delete old image one_img
            var img_two  = $(this).attr('img_two');

            $('.proName').html(pro_name);
            $('.update-id').val(img_id);
            $('.img_one').val(img_one);
            $('.img_two').val(img_two)
            $('.update-pro-catName').val(cat_name);
        });

        $('.remove').click(function () {
            var id       = $(this).attr('img_id');
            var pro_name = $(this).attr('pro_name');
            var cat_name = $(this).attr('cat_name');
            var img_one  = $(this).attr('img_one');
            var img_two  = $(this).attr('img_two');
            $('.delID').val(id);
            $('.delCollName').html(pro_name);
            $('.del-file').val(cat_name);
            $('.del-img-one').val(img_one);
            $('.del-img-two').val(img_two);
        });
    });

</script>

<?php include 'includes/footer.php';