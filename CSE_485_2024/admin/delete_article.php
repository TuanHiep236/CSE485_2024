<?php 
include 'db.php';

?>
<?php 
if(isset($_GET['id'])){
    $id = $_GET['id'];

$sql = "DELETE from baiviet WHERE ma_bviet = '$id'";
if(mysqli_query($conn, $sql)){
    header('location:article.php?delete_msg=DONE.');
} else{
    echo "Error deleting record: " . mysqli_error($conn);
}

}

?>
