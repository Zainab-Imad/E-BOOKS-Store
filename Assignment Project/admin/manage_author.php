<?php require 'includes/connection.php';

if (isset($_POST['submit'])) {
    # code...
    $name    = $_POST['author-name'];
    $query = "insert into author(author_name) values('$name')";
    mysqli_query($conn,$query);
}
if(isset($_POST['update'])){
    $id       = $_POST['update-id'];
    $name     = $_POST['update-name'];

    $query = "update author set author_name='$name' where author_id = $id ";
    mysqli_query($conn, $query);
}

if (isset($_POST['remove'])) {
    # code...
    $id   = $_POST['del-id'];
    $query = "delete from author where author_id = $id";
    mysqli_query($conn,$query);
}

include 'includes/header.php';
die(print_r($_SESSION));
?>


<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Author</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Author Name</label>
            <input type="text" name="author-name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Category Image</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Upload</span>
                </div>
            </div>
        </div>00
        <button type="submit" name="submit" class="btn btn-lg btn-primary">Save</button>
    </form>
</div>
<div class="card mb-30">
    <table class="table table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select * from author ";
        $result = mysqli_query($conn,$query);
        while($author = mysqli_fetch_assoc($result)){
            if ($author['author_id'] !=1){
            echo "<tr>";
            echo "<td>{$author['author_id']}</td>";
            echo "<td>{$author['author_name']}</td>";
            echo "<td><button author_id='{$author['author_id']}' author_name='{$author['author_name']}' class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                   Update
                                    </button></td>";
            echo "<td><button author_id='{$author['author_id']}' author_name='{$author['author_name']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
                                    Remove
                                    </button></td>";
            echo "</tr>";
        }}
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
                    <label id="cc-payment" class="form-control">Are you sure you want to remove <span class="delAuthorName text-danger"></span> ?</label>
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
            var id   = $(this).attr('author_id');
            var name = $(this).attr('author_name');
            $('.update-id').val(id);
            $('.update-name').val(name);
        });
    });
    $('.remove').click(function () {
        var id   = $(this).attr('author_id');
        var name =$(this).attr('author_name');
        $('.delID').val(id);
        $('.delAuthorName').html(name);
    });
</script>
<?php include 'includes/footer.php' ;?>