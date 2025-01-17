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
        <title>Truyện tranh</title>

        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../frontend/layouts/styles.php'); ?>

    </head>

    <body class="d-flex flex-column h-100">
        <!-- header -->
        <?php include_once(__DIR__ . '/../frontend/layouts/partials/header.php'); ?>
        <!-- end header -->

        <main role="main">
            <!-- Block content -->
            <div class="container mt-2">
                <h1 class="tieu-de">TRUYỆN TRANH</h1>

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

                // 2. Chuẩn bị câu truy vấn $sql
                $sqlDanhSachTruyen = <<<EOT
      SELECT truyen_id, truyen_ma, truyen_ten, truyen_hinhdaidien, truyen_loai, truyen_theloai, truyen_tacgia, truyen_mota_ngan, truyen_ngaydang
      FROM truyen
      WHERE truyen_loai = 2;
EOT;

                // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                $result = mysqli_query($conn, $sqlDanhSachTruyen);

                // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
                // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
                // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
                $dataDanhSachTruyen = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $dataDanhSachTruyen[] = array(
                        'truyen_id' => $row['truyen_id'],
                        'truyen_ma' => $row['truyen_ma'],
                        'truyen_ten' => $row['truyen_ten'],
                        'truyen_hinhdaidien' => $row['truyen_hinhdaidien'],
                        'truyen_loai' => $row['truyen_loai'],
                        'truyen_theloai' => $row['truyen_theloai'],
                        'truyen_tacgia' => $row['truyen_tacgia'],
                        'truyen_mota_ngan' => $row['truyen_mota_ngan'],
                        'truyen_ngaydang' => $row['truyen_ngaydang'],
                    );
                }
                // print_r($dataDanhSachTruyen);die;
                // 5. Phân thành 2 array tùy theo loại Truyện
                // Sử dụng hàm array_filter() để lọc các phần tử theo điều kiện mong muốn
                $dataDanhSachTieuThuyet = array_filter($dataDanhSachTruyen, function ($value, $key) {
                    return $value['truyen_loai'] == 1; // #1: Tiểu thuyết; #2: Truyện tranh
                }, ARRAY_FILTER_USE_BOTH);

                $dataDanhSachTruyenTranh = array_filter($dataDanhSachTruyen, function ($value, $key) {
                    return $value['truyen_loai'] == 2; // #1: Tiểu thuyết; #2: Truyện tranh
                }, ARRAY_FILTER_USE_BOTH);
                ?>
            </div>

            <div class="container bg-white">
                <!-- Danh sách TRUYỆN TRANH START -->
                <div class="row row-cols-5">
                    <?php foreach ($dataDanhSachTruyenTranh as $truyentranh) : ?>
                        <div class="col text-center">
                            <div class="card">
                                <a href="truyen-tranh/chi-tiet.php?truyen_id=<?= $truyentranh['truyen_id'] ?>">
                                    <img src="/project-nentang/assets/uploads/truyen-tranh/<?= $truyentranh['truyen_hinhdaidien'] ?>" class="card-img-top img-fluid" alt="">
                                </a>
                            </div>
                            <div class="card-text mb-3 mt-2">
                                <a class="text-decoration-none" href="/truyen-tranh/chi-tiet.php?truyen_id=<?= $truyentranh['truyen_id'] ?>">
                                    <h5 class="text-dark"><?= $truyentranh['truyen_ten'] ?></h5>
                                </a>
                            </div>                      
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Danh sách TRUYỆN TRANH END -->
            </div>
            <!-- End block content -->
        </main>

        <!-- footer -->
        <?php include_once(__DIR__ . '/../frontend/layouts/partials/footer.php'); ?>
        <!-- end footer -->

        <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
        <?php include_once(__DIR__ . '/../frontend/layouts/scripts.php'); ?>

        <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->

    </body>

</html>