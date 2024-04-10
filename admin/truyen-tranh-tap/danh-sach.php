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
        <title>Danh Sách Chapter Truyện Tranh</title>
        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/styles.php'); ?>
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

            // Truy vấn database để lấy danh sách
            // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
            include_once(__DIR__ . '/../../dbconnect.php');

            // 2. Chuẩn bị câu truy vấn $sql
            $sqlDanhSachTapTruyen = <<<EOT
      SELECT c.chuong_id, c.chuong_so, c.chuong_ten, c.chuong_id,
        t.truyen_ten
      FROM chuong c
      JOIN truyen t ON c.truyen_id = t.truyen_id
      WHERE t.truyen_loai = 2
      ORDER BY t.truyen_ten, c.chuong_so;
EOT;

            // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
            $result = mysqli_query($conn, $sqlDanhSachTapTruyen);

            // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
            // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
            // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
            $dataDanhSachTapTruyenTranh = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $dataDanhSachTapTruyenTranh[] = array(
                    'chuong_id' => $row['chuong_id'],
                    'chuong_so' => $row['chuong_so'],
                    'chuong_ten' => $row['chuong_ten'],
                    'truyen_ten' => $row['truyen_ten'],
                );
            }
            // print_r($dataDanhSachTapTruyenTranh);die;
            ?>
        </div>

        <h1 class="tieu-de">DANH SÁCH CHAPTER TRUYỆN TRANH</h1>
        <div class="container-fluid">
            <!-- Danh sách TRUYỆN TRANH START -->
            <div class="row">
                <div class="col">
                    <!-- Đường link chuyển sang trang Thêm mới -->
                    <div class="text-right">
                        <a href="them.php" class="btn btn-info mb-2">Thêm Chapter</a>
                    </div>

                    <table class="table table-bordered bg-light text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CHAPTER</th>
                                <th>TÊN CHAPTER</th>
                                <th>TÊN TRUYỆN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataDanhSachTapTruyenTranh as $tap) : ?>
                                <tr>
                                    <td><?= $tap['chuong_id'] ?></td>
                                    <td><?= $tap['chuong_so'] ?></td>
                                    <td><?= $tap['chuong_ten'] ?></td>
                                    <td><?= $tap['truyen_ten'] ?></td>
                                    <td>
                                        <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `chuong_id` -->
                                        <a href="sua.php?chuong_id=<?= $tap['chuong_id'] ?>" class="text-warning">
                                            <i class="fa fa-2x fa-edit mb-2"></i>
                                        </a>
                                        <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `chuong_id` -->
                                        <button type="button" class="btn-outline-danger btnDelete" data-chuong_id="<?= $tap['chuong_id'] ?>">
                                            <i class="fa fa-2x fa-trash-o"></i>
                                        </button>                 
                                        <!-- Nút Xem danh sách hình ảnh cho tập Truyện dựa vào khóa chính `chuong_id` -->
                                        <a href="/project-nentang/admin/truyen-tranh-tap-hinh-anh/danh-sach.php?chuong_id=<?= $tap['chuong_id'] ?>&chuong_ten=<?= $tap['chuong_ten'] ?>" class="text-success">
                                            <i class="fa fa-2x fa-image"></i>
                                            <!-- Nút Thêm hình ảnh cho tập Truyện dựa vào khóa chính `chuong_id` -->
                                            <a href="/project-nentang/admin/truyen-tranh-tap-hinh-anh/them.php?chuong_id=<?= $tap['chuong_id'] ?>&chuong_ten=<?= $tap['chuong_ten'] ?>" class="btn btn-outline-success">
                                                Thêm ảnh
                                            </a>
                                            <br />

                                        </a>
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
            // Lấy giá trị của thuộc tính "data-chuong_id" của nút mà người dùng đang click
            var chuong_id = $(this).attr('data-chuong_id');
            // Hiển thị cảnh báo
            var xacNhanXoa = confirm('Bạn có chắc chắn muốn xóa?');
            if (xacNhanXoa == true) { // Người dùng đã chọn Yes             
                // Điều hướng đến trang xoa.php với tham số chuong_id được truyền theo request GET
                location.href = 'xoa.php?chuong_id=' + chuong_id;
            }
        });
    </script>

</body>
</html>