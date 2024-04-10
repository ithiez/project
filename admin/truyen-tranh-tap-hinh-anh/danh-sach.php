<?php
// hàm `session_id()` sẽ trả về giá trị SESSION_ID (tên file session do Web Server tự động tạo)
// - Nếu trả về Rỗng hoặc NULL => chưa có file Session tồn tại
if (session_id() === '') {
    // Yêu cầu Web Server tạo file Session để lưu trữ giá trị tương ứng với CLIENT (Web Browser đang gởi Request)
    session_start();
}
?>
<?php include_once(__DIR__ . '/../../admin/includes/phan-quyen.php'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Danh sách Chapter Hình ảnh</title>
        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/styles.php'); ?>
        <style>
            .hinh-truyen-tranh {
                width: 150px;
            }
        </style>
    </head>

    <body class="d-flex flex-column h-100">
        <main role="main">
            <!-- Block content -->
            <?php
            // Hiển thị tất cả lỗi trong PHP
            // Chỉ nên hiển thị lỗi khi đang trong môi trường Phát triển (Development)
            // Không nên hiển thị lỗi trên môi trường Triển khai (Production)
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            // Thu thập thông tin từ Request gởi đến
            $chuong_id = $_GET['chuong_id'];
            $chuong_ten = $_GET['chuong_ten'];

            // Truy vấn database để lấy danh sách
            // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
            include_once(__DIR__ . '/../../dbconnect.php');

            // 2. Chuẩn bị câu truy vấn $sql
            $sqlDanhSachHinhAnhTruyenTranh = <<<EOT
      SELECT chuong_hinhanh_id, chuong_id, chuong_hinhanh_tenhinh
      FROM chuong_hinhanh
      WHERE chuong_id = $chuong_id
      ORDER BY chuong_hinhanh_id ASC
EOT;

            // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
            $result = mysqli_query($conn, $sqlDanhSachHinhAnhTruyenTranh);

            // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
            // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
            // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
            $dataDanhSachHinhAnhTruyenTranh = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $dataDanhSachHinhAnhTruyenTranh[] = array(
                    'chuong_hinhanh_id' => $row['chuong_hinhanh_id'],
                    'chuong_id' => $row['chuong_id'],
                    'chuong_hinhanh_tenhinh' => $row['chuong_hinhanh_tenhinh'],
                );
            }
            ?>
        </div>

        <h1 class="tieu-de">DANH SÁCH CHAPTER HÌNH ẢNH</h1>
        <div class="container-fluid">
            <!-- Danh sách TRUYỆN TRANH START -->
            <div class="row">
                <div class="col">
                    <!-- Đường link chuyển sang trang Thêm mới -->
                    <div class="text-right">
                        <a href="them.php?chuong_id=<?= $chuong_id ?>&chuong_ten=<?= $chuong_ten ?>" class="btn btn-info mb-2">Thêm mới</a>
                    </div>

                    <table class="table table-bordered bg-light text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>HÌNH ẢNH</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataDanhSachHinhAnhTruyenTranh as $ha) : ?>
                                <tr>
                                    <td><?= $ha['chuong_hinhanh_id'] ?></td>
                                    <td>
                                        <img src="/project-nentang/assets/uploads/<?= $ha['chuong_hinhanh_tenhinh'] ?>" class="hinh-truyen-tranh" />
                                    </td>
                                    <td>
                                        <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `chuong_hinhanh_id` -->
                                        <a href="sua.php?chuong_hinhanh_id=<?= $ha['chuong_hinhanh_id'] ?>&chuong_id=<?= $chuong_id ?>&chuong_ten=<?= $chuong_ten ?>" class="text-warning">
                                            <i class="fa fa-2x fa-edit mb-2"></i>
                                        </a>
                                        <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `chuong_hinhanh_id` -->
                                        <button type="button" class="btn-outline-danger btnDelete" data-chuong_hinhanh_id="<?= $ha['chuong_hinhanh_id'] ?>" data-chuong_id="<?= $chuong_id ?>" data-chuong_ten="<?= $chuong_ten ?>">
                                            <i class="fa fa-2x fa-trash-o"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Danh sách TRUYỆN TRANH END -->
        </div>
        <!-- End block content -->
    </main>


    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../frontend/layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <script>
        $('.btnDelete').on('click', function (e) {
            // Lấy giá trị của thuộc tính "data-chuong_hinhanh_id" của nút mà người dùng đang click
            var chuong_hinhanh_id = $(this).attr('data-chuong_hinhanh_id');
            var chuong_id = $(this).attr('data-chuong_id');
            var chuong_ten = $(this).attr('data-chuong_ten');

            // Hiển thị cảnh báo
            var xacNhanXoa = confirm('Bạn có chắc chắn muốn xóa?');
            if (xacNhanXoa == true) { // Người dùng đã chọn Yes
                // Điều hướng đến trang xoa.php với tham số chuong_hinhanh_id được truyền theo request GET
                location.href = 'xoa.php?chuong_hinhanh_id=' + chuong_hinhanh_id + '&chuong_id=' + chuong_id + '&chuong_ten=' + chuong_ten;
            }
        });
    </script>

</body>
</html>