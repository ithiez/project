<?php

// Hiển thị tất cả lỗi trong PHP
// Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
// Không nên hiển thị lỗi trên môi trường Triển khai (Production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Truy vấn database
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../dbconnect.php');

/* --- 
  --- 2. Truy vấn dữ liệu Truyện theo khóa chính
  ---
 */
// Chuẩn bị câu truy vấn $sqlSelect, lấy dữ liệu ban đầu của record cần update
// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
$truyen_id = $_GET['truyen_id'];
$sqlSelect = "SELECT * FROM `truyen` WHERE truyen_id=$truyen_id;";
// var_dump($sqlSelect);die;
// Thực thi câu truy vấn SQL để lấy về dữ liệu ban đầu của record cần update
$resultSelect = mysqli_query($conn, $sqlSelect);
$truyenRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC); // 1 record

/* --- End Truy vấn dữ liệu Truyện theo khóa chính --- */

// 3. Xóa file cũ để tránh rác trong thư mục UPLOADS
// Đường dẫn để chứa thư mục upload trên ứng dụng web của chúng ta. Các bạn có thể tùy chỉnh theo ý các bạn.
// Ví dụ: các file upload sẽ được lưu vào thư mục /../../assets/uploads/...
$upload_dir = __DIR__ . "/../../assets/uploads/truyen-tranh/";

// Kiểm tra nếu file có tổn tại thì xóa file đi
$old_file = $upload_dir . $truyenRow['truyen_hinhdaidien'];
if (file_exists($old_file)) {
    // Hàm unlink(filepath) dùng để xóa file trong PHP
    unlink($old_file);
}

// 4. Chuẩn bị câu truy vấn $sql
// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
$truyen_id = $_GET['truyen_id'];
$sql = "DELETE FROM `truyen` WHERE truyen_id=" . $truyen_id;

// 5. Thực thi câu lệnh DELETE
$result = mysqli_query($conn, $sql);

// 6. Đóng kết nối
mysqli_close($conn);

// Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
header('location:danh-sach.php');
