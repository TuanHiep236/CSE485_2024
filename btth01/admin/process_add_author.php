<?php
session_start();
require 'db.php';

if(isset($_POST['sbm'])){
    $ten_tgia = $_POST['ten_tgia'];

    if(!empty($ten_tgia)){
        // Kiểm tra và xử lý file ảnh
        if (isset($_FILES['hinh_tgia']) && $_FILES['hinh_tgia']['error'] == 0) {
            // Thư mục lưu ảnh
            $target_dir = "/btth01/images/";
            // Đường dẫn đầy đủ của tệp ảnh
            $target_file = $target_dir . basename($_FILES["hinh_tgia"]["name"]);
            
            // Di chuyển tệp ảnh vào thư mục đích
            if (move_uploaded_file($_FILES["hinh_tgia"]["tmp_name"], $target_file)) {
                // Lưu tên tệp ảnh vào cơ sở dữ liệu
                $hinh_tgia = htmlspecialchars(basename($_FILES["hinh_tgia"]["name"]));
            } else {
                echo "Lỗi khi tải ảnh lên.";
                exit(); // Kết thúc nếu lỗi
            }
        } else {
            // Nếu không có tệp ảnh, đặt giá trị mặc định
            $hinh_tgia = 'default.png'; // Bạn có thể tạo một ảnh mặc định
        }

        // Chèn thông tin vào cơ sở dữ liệu
        $sql = "INSERT INTO tacgia (ten_tgia, hinh_tgia) VALUES ('$ten_tgia', '$hinh_tgia')";

        // Thực hiện câu lệnh SQL
        if($conn->query($sql) === TRUE){
            $_SESSION['message'] = "Thêm thông tin tác giả thành công!";
            header('location: author.php');
            exit();
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "Tên tác giả không được để trống.";
    }
}
?>
