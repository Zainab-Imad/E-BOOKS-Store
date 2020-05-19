<?php require 'includes/connection.php';
if (isset($_POST['submit'])) {
    # code...
    $name = $_POST['cat-name'];
    $img     = $_FILES['cat-img']['name'];
    $img_tmp = $_FILES['cat-img']['tmp_name'];
    $path    = 'uploads/category/';
    move_uploaded_file($img_tmp, $path . $img);
    $query = "insert into category(cat_name,cat_img) values('$name','$img')";
    mysqli_query($conn,$query);
}
if(isset($_POST['update'])){
    $id       = $_POST['update-id'];
    $name     = $_POST['update-name'];
    $image    = $_POST['update-image'];
    $img      = $_FILES['update-img']['name'];
    $img_tmp  = $_FILES['update-img']['tmp_name'];
    $path     = 'uploads/category/';
    if($_FILES['update-img']['error'] == 0 ){
        if ($image === $img) {
            move_uploaded_file($img_tmp, $path . $img);
            $query = "update category set cat_name='$name',cat_img='$img' where cat_id= $id ";
            mysqli_query($conn, $query);
        } else {
            $pathDel = 'uploads/category/'.$image;
            unlink($pathDel);
            move_uploaded_file($img_tmp, $path . $img);
            $query = "update category set cat_name='$name',cat_img='$img' where cat_id = $id ";
            mysqli_query($conn, $query);
        }
    } else {
        $query = "update category set cat_name='$name' where cat_id = $id ";
        mysqli_query($conn, $query);
    }
}
if (isset($_POST['remove'])) {
    # code...
    $id   = $_POST['del-id'];
    $img  =$_POST['del-img'];
    $path = 'uploads/category/'.$img;
    unlink($path);
    $query = "delete from category where cat_id = $id";
    mysqli_query($conn,$query);
}
include 'includes/header.php'; ?>

<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Category</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Category Name</label>
            <input type="text" name="cat-name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Category Image</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="cat-img" class="custom-file-input">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
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
            <th scope="col">Image</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select * from category ";
        $result = mysqli_query($conn,$query);
        while($cat = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$cat['cat_id']}</td>";
            echo "<td>{$cat['cat_name']}</td>";
            echo "<td><img width='50' height='50' src='uploads/category/{$cat['cat_img']}'></td>";
            echo "<td><button cat_id='{$cat['cat_id']}' cat_name='{$cat['cat_name']}' cat_img='{$cat['cat_img']}' class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                    Update
                                    </button></td>";
            echo "<td><button cat_id='{$cat['cat_id']}' cat_name='{$cat['cat_name']}' cat_img='{$cat['cat_img']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
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
                    <input id="cc-payment" name="update-name" type="text"  value="" class="update-name form-control">
                </div>
                <div class="modal-body">
                    <input id="cc-payment" name="update-img" type="file"  value="" class="update-img form-control">
                    <input id="cc-payment" name="update-image" type="hidden"  value="" class="update-image form-control">
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
                    <input id="cc-payment" name="del-img" type="hidden"  value="" class="delImg form-control">
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
        $('.update').click(function (){
            var id   = $(this).attr('cat_id');
            var name = $(this).attr('cat_name');
            var img  = $(this).attr('cat_img');
            $('.update-id').val(id);
            $('.update-name').val(name);
            $('.update-image').val(img);
        });
    });
    $('.remove').click(function () {
        var id   = $(this).attr('cat_id');
        var name =$(this).attr('cat_name');
        var img  =$(this).attr('cat_img');
        $('.delID').val(id);
        $('.delCatName').html(name);
        $('.delImg').val(img);
    });
</script>