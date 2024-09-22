
<?php
session_start(); 
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];

$sql = "DELETE FROM theloai WHERE ma_tloai = '$id'";
if(mysqli_query($conn, $sql)){
    $_SESSION['message'] = "Xóa thể loại thành công!";
    header('location:category.php');
    exit();
} else{
    echo "Error deleting record: " . mysqli_error($conn);
}

}

    
?>