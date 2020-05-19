<?php require 'includes/connection.php';

if (isset($_POST['submit'])) {
    # code...
    $name      = $_POST['coll-name'];
    $author    = $_POST['author-id'];
    $query     = "insert into collection(coll_name,author_id) values('$name',$author)";
    mysqli_query($conn,$query);
}

if(isset($_POST['update'])){
    $id       = $_POST['update-id'];
    $name     = $_POST['update-name'];
    $author   = $_POST['update-author'];
    $query    = "update collection set coll_name='$name', author_id='$author' where coll_id = $id ";
    mysqli_query($conn, $query);
}

if (isset($_POST['remove'])) {
    # code...
    $id       = $_POST['del-id'];
    $query    = "delete from collection where coll_id = $id";
    mysqli_query($conn,$query);
}

include 'includes/header.php';
?>


<div class="breadcrumb-area">
    <h1>Dashboard</h1>

    <ol class="breadcrumb">
        <li class="item"><a href="dashboard-analytics.php"><i class='bx bx-home-alt'></i></a></li>

        <li class="item">Dashboard</li>

        <li class="item">Manage Collection</li>
    </ol>
</div>
<!-- End Breadcrumb Area -->
<div class="card mb-30">
    <form method="post" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label>Collection Name</label>
            <input type="text" name="coll-name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Collection Author</label>
            <select name="author-id"  style="padding: 10px;" class="custom-file-select">
                <?php
                $query = " select * from author ";
                $result = mysqli_query($conn,$query);
                while($author = mysqli_fetch_assoc($result)){
                    echo "<option value='{$author['author_id']}'>{$author['author_name']}</option>";

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
            <th scope="col">The series</th>
            <th scope="col">Author</th>
            <th scope="col">Update</th>
            <th scope="col">Remove</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query = " select * from collection inner join author on collection.author_id=author.author_id";
        $result = mysqli_query($conn,$query);
        while($coll = mysqli_fetch_assoc($result)){
            if ($coll['coll_id'] != 1){
            echo "<tr>";
            echo "<td>{$coll['coll_id']}</td>";
            echo "<td>{$coll['coll_name']}</td>";
            echo "<td>{$coll['author_name']}</td>";
            echo "<td><button coll_id='{$coll['coll_id']}' coll_name='{$coll['coll_name']}'author_id='{$coll['author_id']}' author_name='{$coll['author_name']}' class='update btn btn-warning mb-1' data-toggle='modal' data-target='#updateModal'>
                                   Update
                                    </button></td>";
            echo "<td><button coll_id='{$coll['coll_id']}' coll_name='{$coll['coll_name']}' class='remove btn btn-dark mb-1' data-toggle='modal' data-target='#removeModal'>
                                    Remove
                                    </button></td>";
            echo "</tr>";
        }
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
                    <label>Update author</label>
                    <select name="update-author" style="padding: 10px;" id="update-author" class="update-author custom-file-select">
                        <?php
                        $query = " select * from author ";
                        $result = mysqli_query($conn,$query);
                        while($author = mysqli_fetch_assoc($result)){
                            if ($author['author_id'] != 1){
                            echo "<option value='{$author['author_id']}'>{$author['author_name']}</option>";
                        }}
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
                    <label id="cc-payment" class="form-control">Are you sure you want to remove <span class="delCollName text-danger"></span> ?</label>
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
            var id   = $(this).attr('coll_id');
            var name = $(this).attr('coll_name');

            $('.update-id').val(id);
            $('.update-name').val(name);

            var author_Id = $(this).attr('author_id');
            var author_Name = $(this).attr('author_name');
            $('.update-author option[value="' + author_Id + '"]').remove();
            $('.update-author').prepend('<option value="' + author_Id + '" selected>' + author_Name + '</option>');

        });
    });
    $('.remove').click(function () {
        var id   = $(this).attr('coll_id');
        var name =$(this).attr('coll_name');
        $('.delID').val(id);
        $('.delCollName').html(name);
    });
</script>
<?php include 'includes/footer.php' ;?>
