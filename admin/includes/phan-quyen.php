<?php
if (isset($_SESSION['ten_dang_nhap']) == false) {
    // Nếu người dùng chưa đăng nhập thì chuyển hướng website sang trang đăng nhập
    header('Location: /project-nentang/user/login.php');
} else {
    if (isset($_SESSION['phan_quyen']) == true) {
        // Ngược lại nếu đã đăng nhập
        $phan_quyen = $_SESSION['phan_quyen'];
        // Kiểm tra quyền của người đó có phải là admin hay không
        if ($phan_quyen == '0') {
            // Nếu không phải admin thì xuất thông báo        
            header('Location: /project-nentang/index.php');
            exit();
        }
    }
}
?>;