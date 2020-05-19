<?php include 'includes/connection.php';
$query ="select * from collection";
$result =mysqli_query($conn,$query);
while ($coll = mysqli_fetch_assoc($result)){
    if($coll['coll_id'] == 1){
        echo "<option value='{$coll['coll_id']}'>{$coll['coll_name']}</option>";
    }
}
$query = "select * from collection inner join author on collection.author_id= author.author_id where collection.author_id={$_GET['author-id']}";
$result = mysqli_query($conn,$query);
while($coll = mysqli_fetch_assoc($result)){
    echo "<option value='{$coll['coll_id']}'>{$coll['coll_name']}</option>";
}