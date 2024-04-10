<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>
<header class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark shadow">
            <a href="/project-nentang/">
                <img style="width: 80%" src="/project-nentang/assets/shared/img/logo.png">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item btn-danger btn-outline-secondary">
                        <a class="nav-link fa fa-home fa-2x active" href="/project-nentang/"></a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link" href="/project-nentang/admin">Admin</a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link" href="/project-nentang/gioi-thieu.php">Giới thiệu</a>
                    </li>
                    <li class="nav-item mt-auto">
                        <a class="nav-link" href="/project-nentang/lien-he.php">Liên hệ</a>
                    </li>

                    <li class="nav-item mt-auto dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                            Truyện
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="/project-nentang/tieu-thuyet">Tiểu thuyết</a>
                            <a class="dropdown-item" href="/project-nentang/truyen-tranh">Truyện tranh</a>
                        </div>
                    </li>

                </ul>
                
                <div class="text-ten-hien-thi">  
                    <?php
                    if (isset($_SESSION['ten_hien_thi']) && $_SESSION['ten_hien_thi']) {
                        echo $_SESSION['ten_hien_thi'];
                        echo '<a class="ml-3 nav-item text-info btn" href="/project-nentang/user/logout.php"><i class="fa fa-2x fa-sign-out"></i></a>';
                    } else {
                        echo '<a class = "nav-item text-light" href="/project-nentang/user/login.php">Đăng nhập</a>'
                        . '<a class = "nav-item text-light" href = "/project-nentang/user/signup.php">/Đăng ký</a>';
                    }
                    ?>                                
                </div>
            </div>
        </nav>
    </div>
</header>