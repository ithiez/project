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
        <title>Danh sách Tiểu thuyết</title>
        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/styles.php'); ?>
    </head>
    
    <body class="d-flex flex-column h-100">
        <main role="main">
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
            $sqlDanhSachTruyen = <<<EOT
                    SELECT truyen_id, truyen_ma, truyen_ten, truyen_hinhdaidien, truyen_loai, truyen_theloai, truyen_tacgia, truyen_mota_ngan, truyen_ngaydang
                    FROM truyen
                    WHERE truyen_loai = 1;
                EOT;
            // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
            $result = mysqli_query($conn, $sqlDanhSachTruyen);
            // 4. Khi thực thi các truy vấn dạng SELECT, dữ liệu lấy về cần phải phân tích để sử dụng
            // Thông thường, chúng ta sẽ sử dụng vòng lặp while để duyệt danh sách các dòng dữ liệu được SELECT
            // Ta sẽ tạo 1 mảng array để chứa các dữ liệu được trả về
            $dataDanhSachTieuThuyet = [];
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                $dataDanhSachTieuThuyet[] = array(
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
            ?>

            <h1 class="tieu-de">DANH SÁCH TIỂU THUYẾT</h1>
            <div class="container-fluid">          
                <!-- Danh sách TIỂU THUYẾT START -->             
                <div class="row">
                    <div class="col">
                        <!-- Đường link chuyển sang trang Thêm mới -->
                        <div class="text-right">
                            <a href="them.php" class="btn btn-info mb-2">Thêm mới</a>
                        </div>
                        <table class="table table-bordered bg-light text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>MÃ</th>
                                    <th>TÊN</th>
                                    <th>HÌNH ĐẠI DIỆN</th>
                                    <th>THỂ LOẠI</th>
                                    <th>TÁC GIẢ</th>                                  
                                    <th>NGÀY ĐĂNG</th>
                                    <th>HÀNH ĐỘNG</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dataDanhSachTieuThuyet as $truyentranh) : ?>
                                    <tr>
                                        <td><?= $truyentranh['truyen_id'] ?></td>
                                        <td><?= $truyentranh['truyen_ma'] ?></td>
                                        <td><?= $truyentranh['truyen_ten'] ?></td>
                                        <td>
                                            <img src="/project-nentang/assets/uploads/tieu-thuyet/<?= $truyentranh['truyen_hinhdaidien'] ?>" class="img-fluid" alt="">
                                        </td>
                                        <td><?= $truyentranh['truyen_theloai'] ?></td>
                                        <td><?= $truyentranh['truyen_tacgia'] ?></td>                                    
                                        <td><?= $truyentranh['truyen_ngaydang'] ?></td>
                                        <td>
                                            <!-- Nút sửa, bấm vào sẽ hiển thị form hiệu chỉnh thông tin dựa vào khóa chính `truyen_id` -->
                                            <a href="sua.php?truyen_id=<?= $truyentranh['truyen_id'] ?>" class="text-warning">
                                                <i class="fa fa-2x fa-edit mb-2"></i>
                                            </a>
                                            <!-- Nút xóa, bấm vào sẽ xóa thông tin dựa vào khóa chính `truyen_id` -->
                                            <button type="button" class="btnDelete btn-outline-danger" data-truyen_id="<?= $truyentranh['truyen_id'] ?>">
                                                <i class="fa fa-2x fa-trash-o"></i>                                              
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table><!-- Danh sách TIỂU THUYẾT END -->
                    </div>
                </div>              
            </div> <!-- End block content -->           
        </main>

        
        <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/scripts.php'); ?>

        <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
        <script>
            $('.btnDelete').on('click', function (e) {
                // Lấy giá trị của thuộc tính "data-truyen_id" của nút mà người dùng đang click
                var truyen_id = $(this).attr('data-truyen_id');

                // Hiển thị cảnh báo
                var xacNhanXoa = confirm('Bạn có chắc chắn muốn xóa?');
                if (xacNhanXoa == true) { // Người dùng đã chọn Yes
                    // Điều hướng đến trang xoa.php với tham số truyen_id được truyền theo request GET
                    location.href = 'xoa.php?truyen_id=' + truyen_id;
                }
            });
        </script>
    </body>
</html>