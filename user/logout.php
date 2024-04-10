<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>
<?php
if (isset($_SESSION['ten_hien_thi'])){
    unset($_SESSION['ten_hien_thi']); // xóa session login
}
echo '<script>location.href = "login.php";</script>';
?>;