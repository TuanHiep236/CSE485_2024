<?php
    session_start();
    require 'db.php';
    if(isset($_POST['btn-add'])){
        $ten_tloai = $_POST['ten_tloai'];
        if(!empty($ten_tloai)){
            //echo"<pre>";
            //print_r($_POST);
            
            $sql ="INSERT INTO theloai(ten_tloai) VALUES('$ten_tloai') ";

            if($conn->query($sql)===TRUE){
                $_SESSION['message'] = "Thêm thể loại thành công!";
                header('location:category.php?id=');
                exit();
            }else{
                echo"loi {$mysqli}".$conn->error;
            }
        }
    }
    
?>

