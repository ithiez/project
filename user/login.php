<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>

<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Đăng nhập</title>

        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../frontend/layouts/styles.php'); ?>
    </head>
    <body class="d-flex flex-column h-100">
        <!-- header -->
        <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
        <!-- end header -->

        <main role="main" class="bg-light">
            <!-- Block content -->
            <?php
            // Hiển thị tất cả lỗi trong PHP
            // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
            // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            // Truy vấn database để lấy danh sách
            // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
            include_once(__DIR__ . '/../dbconnect.php');

            if (isset($_POST["btn_login"])) {
                // lấy thông tin người dùng
                $ten_dang_nhap = $_POST["ten_dang_nhap"];
                $mat_khau = $_POST["mat_khau"];

                //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt 
                //mà người dùng cố tình thêm vào để tấn công theo phương thức sql injection
                $ten_dang_nhap = strip_tags($ten_dang_nhap);
                $ten_dang_nhap = addslashes($ten_dang_nhap);
                $mat_khau = strip_tags($mat_khau);
                $mat_khau = addslashes($mat_khau);
                if ($ten_dang_nhap == "" || $mat_khau == "") {
                    echo "Tên tài khoản và mật khẩu bạn không được để trống!";
                } else {
                    $sql = "SELECT * FROM account WHERE ten_dang_nhap = '$ten_dang_nhap' and mat_khau = '$mat_khau' ";
                    echo $sql;
                    $query = mysqli_query($conn, $sql);
                    $num_rows = mysqli_num_rows($query);
                    if ($num_rows == 0) {
                        echo "Tên đăng nhập hoặc mật khẩu không đúng !";
                    } else {
                        // Lấy ra thông tin người dùng và lưu vào session
                        while ($data = mysqli_fetch_array($query)) {

                            $_SESSION['ten_hien_thi'] = $data["ten_hien_thi"];
                            $_SESSION["ten_dang_nhap"] = $data["ten_dang_nhap"];
                            $_SESSION["mat_khau"] = $data["mat_khau"];
                            $_SESSION["phan_quyen"] = $data["phan_quyen"];
                            $_SESSION["trang_thai"] = $data["trang_thai"];
                        }

                        // Thực thi hành động sau khi lưu thông tin vào session
                        // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
                        header('Location: /project-nentang/index.php');
                    }
                }
            }
            ?>

            <div class="container">
                <div id="wrapper">
                    <form method="POST" action="login.php" id="form-login">
                        <h1 class="form-heading">ĐĂNG NHẬP</h1>
                        <div class="form-group">
                            <i class="fa fa-2x fa-user"></i>
                            <input type="text" name="ten_dang_nhap" class="form-input" placeholder="Tên đăng nhập">
                        </div>
                        <div class="form-group">
                            <i class="fa fa-2x fa-key"></i>
                            <input type="password" name="mat_khau" class="form-input" placeholder="Mật khẩu">                                 
                        </div> 
                        <input type="submit" name="btn_login" value="Đăng nhập" class="form-submit">                                                                                           
                    </form>                       
                </div>
            </div>          
        </main>
        <!-- footer -->
        <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
        <!-- end footer -->

        <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
        <?php include_once(__DIR__ . '/../frontend/layouts/scripts.php'); ?>

        <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->

    </body>

</html>