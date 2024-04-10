<?php declare(strict_types=1) ?>
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
        <title>Đọc truyện online - đọc truyện hay - TTruyen</title>

        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../frontend/layouts/styles.php'); ?>
    </head>
    <body class="d-flex flex-column h-100">
        <!-- header -->
        <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
        <!-- end header -->

        <main role="main" class="">
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

            if (isset($_POST["btn_signup"])) {
                //lấy thông tin từ các form bằng phương thức POST
                $ten_dang_nhap = $_POST["ten_dang_nhap"];
                $mat_khau = $_POST["mat_khau"];
                $ten_hien_thi = $_POST["ten_hien_thi"];

                // Kiểm tra Tên đăng nhập có bị trùng hay không
                $sql = "SELECT * FROM account WHERE ten_dang_nhap = '$ten_dang_nhap'";
                // Thực thi câu truy vấn
                $result = mysqli_query($conn, $sql);
                // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
                if (mysqli_num_rows($result) > 0) {
                    // Sử dụng javascript để thông báo
                    echo "Tên đăng nhập đã tồn tại<br />";
                }


                //Kiểm tra điều kiện bắt buộc đối với các field không được bỏ trống
                if ($ten_dang_nhap == "" || $mat_khau == "" || $ten_hien_thi == "") {
                    echo "Bạn vui lòng nhập đầy đủ thông tin";
                } else {
                    $sql = "INSERT INTO account(ten_dang_nhap, mat_khau, ten_hien_thi) VALUES ( '$ten_dang_nhap', '$mat_khau', '$ten_hien_thi')";
                    // thực thi câu $sql với biến conn lấy từ file connection.php
                    mysqli_query($conn, $sql);
                    echo "Chúc mừng bạn đã đăng ký thành công";
                }
            }
            ?>



            <div class="container bg-light">
                <div id="wrapper">
                    <form action="signup.php" method="post" id="form-login">                    
                        <h1 class="form-heading">ĐĂNG KÝ</h1>
                        <div class="form-group">
                            <i class="fa fa-2x fa-user"></i>
                            <input type="text" name="ten_dang_nhap" class="form-input" placeholder="Tên đăng nhập">
                        </div> 
                        <div class="form-group">
                            <i class="fa fa-2x fa-key"></i>
                            <input class="form-input" type="password" id="" name="mat_khau" placeholder="Mật khẩu">
                        </div>   
                        <div class="form-group">
                            <i class="fa fa-2x fa-user-circle"></i>
                            <input class="form-input" type="text" name="ten_hien_thi" placeholder="Tên hiển thị">
                        </div>                                                                        
                        <input type="submit" name="btn_signup" value="Đăng ký" class="form-submit">                      
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