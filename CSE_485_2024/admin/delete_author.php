<?php 
session_start();
include 'db.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];

$sql = "DELETE FROM tacgia WHERE ma_tgia = '$id'";
if(mysqli_query($conn, $sql)){
    $_SESSION['message'] = "Xóa thông tin tác giả thành công!";
    header('location:author.php');
} else{
    echo "Error deleting record: " . mysqli_error($conn);
}
}
?>