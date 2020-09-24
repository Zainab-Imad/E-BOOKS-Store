<?php require 'includes/connection.php';

if (isset($_POST['submit'])) {
    # code...
    $email    = $_POST['admin-email'];
    $password = $_POST['admin-password'];
    $fullName = $_POST['admin-fullName'];
    $img     = $_FILES['admin-image']['name'];
    $img_tmp = $_FILES['admin-image']['tmp_name'];
    $path    = 'uploads/admin/';
    $query = "select * from admin where admin_email='$email'";
    $result = mysqli_query($conn, $query);
    $admin = mysqli_fetch_assoc($result);

    if(isset($admin['admin_email']) == $email || $admin['admin_fullName'] == $fullName){
        $error = "User Exist";
    } else{
        move_uploaded_file($img_tmp, $path . $img);
        $query = "insert into admin(admin_fullName,admin_email,admin_img,admin_password) values('$fullName','$email','$img','$password')";
        mysqli_query($conn,$query);
    }

}
if(isset($_POST['update'])){
    $id       = $_POST['update-id'];
    $name     = $_POST['update-name'];
    $email    = $_POST['update-email'];
    $password = $_POST['update-password'];
    $image    = $_POST['update-image'];
    $img      = $_FILES['update-img']['name'];
    $img_tmp  = $_FILES['update-img']['tmp_name'];
    $path     = 'uploads/admin/';
    if($_FILES['update-img']['error'] == 0 ){
        if ($image === $img) {
            move_uploaded_file($img_tmp, $path . $img);
            $query = "update admin set admin_fullName='$name',admin_email='$email',admin_img='$img',admin_password='$password' where admin_id = $id ";
            mysqli_query($conn, $query);
        }else {
            $pathDel = 'uploads/admin/' . $image;
            if(file_exists($pathDel)){unlink($pathDel);}
            move_uploaded_file($img_tmp, $path . $img);
            $query = "update admin set admin_fullName='$name',admin_email='$email',admin_img='$img',admin_password='$password' where admin_id = $id ";
            mysqli_query($conn, $query);
        }
    }else{
        $query = "update admin set admin_fullName='$name',admin_email='$email',admin_password='$password' where admin_id = $id ";
        mysqli_query($conn, $query);
    }
}
if (isset($_POST['remove'])) {
    # code...
    $id   = $_POST['del-id'];
    $img  =$_POST['del-img'];
    $path = 'uploads/admin/'.$img;
    unlink($path);
    $query = "delete from admin where admin_id = $id";
    mysqli_query($conn,$query);
}
include 'includes/header.php';
?>





<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Admin</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Admin Full Name</label>
            <input type="text" name="admin-fullName" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Admin Email</label>
            <div class="input-group mb-3">
                <input type="email" name="admin-email" class="form-control" required>
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2" >@example.com</span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Admin Image</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" name="admin-image" class="custom-file-input">
                    <label class="custom-file-label">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="admin-password" class="form-control" required>
        </div>
        <div class="form-group">
            <?php if (isset($error)){ echo "<div class='alert alert-danger text-center'>$error</div>";} ?>
        </div>
        <button type="submit" name="submit" class="btn btn-lg btn-primary">Save</button>
    </form>
</div>
<div class="card mb-30">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">FullName</th>
            <th scope="col">Email</th>
            <th scope="col">Image</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select * from admin ";
        $result = mysqli_query($conn,$query);
        while($admin = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>{$admin['admin_id']}</td>";
            echo "<td>{$admin['admin_fullName']}</td>";
            echo "<td>{$admin['admin_email']}</td>";
            echo "<td><img width='50' height='50' src='uploads/admin/{$admin['admin_img']}'></td>";
            echo "<td><input type='hidden' id='pass' href='?img={$admin['admin_img']}' value='{$admin['admin_password']}'><button  admin_id='{$admin['admin_id']}' admin_name='{$admin['admin_fullName']}'admin_email='{$admin['admin_email']}' admin_img={$admin['admin_img']} admin_password={$admin['admin_password']}' class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                    Update
                                    </button></td>";
            echo "<td><button admin_id='{$admin['admin_id']}' admin_img='{$admin['admin_img']}' admin_name='{$admin['admin_fullName']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
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
                    <input id="cc-payment" name="update-email" type="email" value="" class="update-email form-control">
                </div>
                <div class="modal-body">
                    <input id="cc-payment" name="update-img" type="file"  value="" class="update-img form-control">
                    <input id="cc-payment" name="update-image" type="hidden"  value="" class="update-image form-control">
                </div>
                <div class="modal-body">
                    <input id="cc-payment" name="update-password" type="text" value="" class="update-password form-control">
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
                    <label id="cc-payment" class="form-control">Are you sure you want to remove <span class="delAdmin text-danger"></span> ?</label>

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
            var id    = $(this).attr('admin_id');
            var name  = $(this).attr('admin_name');
            var email = $(this).attr('admin_email');
            var img = $(this).attr('admin_img');
            var pass  = $('#pass').val();
            $('.update-id').val(id);
            $('.update-name').val(name);
            $('.update-email').val(email);
            $('.update-image').val(img);
            $('.update-password').val(pass);
        });
        $('.remove').click(function () {
            var id = $(this).attr('admin_id');
            var img =$(this).attr('admin_img');
            var name=$(this).attr('admin_name');
            $('.delID').val(id);
            $('.delImg').val(img);

            $('.delAdmin').html(name);
        });
    });
</script>