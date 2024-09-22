<?php
include 'db.php';
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $ma_bviet = $_GET['id'];
    $sql = "SELECT * FROM baiviet WHERE ma_bviet = '$ma_bviet'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Điền thông tin vào các trường của form chỉnh sửa
        $tieude = $row['tieude'];
        $ten_bhat = $row['ten_bhat'];
        $ma_tloai = $row['ma_tloai'];
        $tomtat = $row['tomtat'];
        $noidung = $row['noidung'];
        $ma_tgia = $row['ma_tgia'];
        $ngayviet = $row['ngayviet'];
    } else {
        echo "Không tìm thấy bài viết.";
    }
} else {
    echo "Tham số ID không hợp lệ.";
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['ma_bviet'])) {
        // $ma_bviet = $_SESSION['ma_bviet'];
   
        $tieude = $_POST['tieude'];
        $ten_bhat = $_POST['ten_bhat'];
        $ma_tloai = $_POST['ma_tloai'];
        $tomtat = $_POST['tomtat'];
        $noidung = $_POST['noidung'];
        $ma_tgia = $_POST['ma_tgia'];
        $ngayviet = $_POST['ngayviet'];

        $sql = "UPDATE baiviet SET tieude = '$tieude', ten_bhat = '$ten_bhat', ma_tloai = '$ma_tloai', tomtat = '$tomtat', noidung = '$noidung', ma_tgia = '$ma_tgia', ngayviet = '$ngayviet' WHERE ma_bviet = '$ma_bviet'";
        
        if ($conn->query($sql) === TRUE) {
            echo "Thành công!";
        } else {
            echo "Lỗi: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Không tồn tại 'ma_bviet' trong mảng POST.";
    }
}

?>
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
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary shadow p-3 bg-white rounded">
            <div class="container-fluid">
                <div class="h3">
                    <a class="navbar-brand" href="#">Administration</a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">Trang ngoài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="category.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="author.php">Tác giả</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fw-bold" href="article.php">Bài viết</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>

    </header>
    <main class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm">
            <h3 class="text-center text-uppercase fw-bold">Sửa bài viết</h3>
            <form action="" method="post">
            <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Mã bài viết :  </span>
                    <input type="text" class="form-control" name="ma_bviet" value="<?php echo $ma_bviet; ?>"required readonly>
                     
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên Bài Viết</span>
                    <input type="text" class="form-control" name="tieude" value="<?php echo $tieude; ?>" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tên Bài Hát</span>
                    <input type="text" class="form-control" name="ten_bhat" value="<?php echo $ten_bhat; ?>" required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Mã Thể Loại </span>
                    <input type="text" class="form-control" name="ma_tloai" value="<?php echo $ma_tloai; ?>" required>
                </div>
                <div class="input-group mt-4 mb-4">
                    <span class="input-group-text" id="lblCatName">Tóm Tắt </span>
                    <input class="form-control" name="tomtat" value="<?php echo $tomtat; ?>"required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Nội Dung</span>
                    <textarea class="form-control" name="noidung" value="<?php echo $noidung; ?>"required></textarea>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Tác Giả</span>
                    <input type="text" class="form-control" name="ma_tgia" value="<?php echo $ma_tgia; ?>"required>
                </div>
                <div class="input-group mt-3 mb-3">
                    <span class="input-group-text" id="lblCatName">Ngày Viết </span>
                    <input type="date" class="form-control" name="ngayviet" value="<?php echo $ngayviet; ?>" required>
                </div>

                <div class="form-group float-end ">
                    <input type="submit" value="Update" class="btn btn-success">
                    <a href="article.php" class="btn btn-warning">Quay Lại</a>
                </div>
            </form>
        </div>
    </div>
</main>
    <footer class="bg-white d-flex justify-content-center align-items-center border-top border-secondary  border-2" style="height:80px">
        <h4 class="text-center text-uppercase fw-bold">TLU's music garden</h4>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>