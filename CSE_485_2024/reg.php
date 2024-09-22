<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Music for Life</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <?php
    
    include 'E:\XAMPP\htdocs\btth01\admin\db.php';
    
    // Biến để lưu thông báo
$message = '';

// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Kiểm tra xem tên người dùng đã tồn tại hay chưa
    $check_query = "SELECT * FROM users WHERE user_name = '$user_name'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $message = "Tên người dùng đã tồn tại!";
    } else {
        // Băm mật khẩu trước khi lưu vào cơ sở dữ liệu
       
        // Thêm dữ liệu vào cơ sở dữ liệu với INSERT IGNORE
        $insert_query = "INSERT IGNORE INTO users (user_name, password) VALUES ('$user_name', '$password')";
        
        // Thực thi truy vấn
        if (mysqli_query($conn, $insert_query)) {
            $message = "Đăng ký tài khoản thành công!";
            header('location:login.php?id=');
        } else {
            $message = "Đăng ký tài khoản thất bại. Vui lòng thử lại.";
        }
    }
}
?>
    

   
   
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="my-logo">
                    <a class="navbar-brand" href="#">
                        <img src="images/logo2.png" alt="" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        
                    </ul>
                    
                </div>
            </div>
        </nav>
    </header>

    <main class="container mt-5 mb-5">
        <div class="d-flex justify-content-center h-100">
            <div class="card">
                <div class="card-header">
                    <h3>Đăng ký</h3>
                    <div class="d-flex justify-content-end social_icon">
                        <span><i class="fab fa-facebook-square"></i></span>
                        <span><i class="fab fa-google-plus-square"></i></span>
                        <span><i class="fab fa-twitter-square"></i></span>
                    </div>
                </div>
                <div class="card-body">
                    <?php if ($message): ?>
                        <div class="alert alert-info"><?php echo $message; ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="txtUser"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="user_name" placeholder="Tên đăng nhập" required>
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="txtPass"><i class="fas fa-key"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Mật khẩu" required>
                        </div>

                        
                        <div class="form-group">
                            <input type="submit" value="Đăng ký" class="btn float-end login_btn">
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center ">
                        Bạn đã có tài khoản?<a href="login.php" class="text-warning text-decoration-none">Đăng nhập</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#" class="text-warning text-decoration-none">Quên mật khẩu?</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>