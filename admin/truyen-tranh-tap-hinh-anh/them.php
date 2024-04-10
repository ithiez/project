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
        <title>Thêm Chapter Hình ảnh Truyện tranh</title>
        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/styles.php'); ?>
        <link href="/project-nentang/assets/vendor/dropzone/dropzone.min.css" type="text/css" rel="stylesheet" />
    </head>

    <body class="d-flex flex-column h-100">
        <main role="main">
            <!-- Block content -->
            <h1 class="tieu-de">THÊM CHAPTER HÌNH ẢNH TRUYỆN TRANH</h1>
            <div class="container">
                <!-- Form THÊM CHAPTER HÌNH ẢNH TRUYỆN TRANH START -->
                <div class="row">
                    <div class="col">
                        <form name="frmThemMoi" id="frmThemMoi" method="post" action="xuly-upload.php" enctype="multipart/form-data" class="dropzone">
                            <input type="hidden" name="chuong_id" id="chuong_id" value="<?= $_GET['chuong_id'] ?>" />
                            <div class="form-group">
                                <label for="">Tên Chaper:</label>
                                <input type="text" name="chuong_ten" id="chuong_ten" value="<?= $_GET['chuong_ten'] ?>" class="form-control ml-2" disabled />
                            </div>
                        </form>
                        <a href="/project-nentang/admin/truyen-tranh-tap/danh-sach.php" class="btn btn-secondary">Quay về Danh sách Chapter Truyện tranh</a>
                    </div>
                </div>
                <!-- End block content -->
        </main>


        <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/scripts.php'); ?>

        <script src="/project-nentang/assets/vendor/dropzone/dropzone.min.js"></script>

        <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
        <script>
            // Note that the name "frmThemMoi" is the camelized
            // id of the form.
            Dropzone.options.frmThemMoi = {
                paramName: "chuong_hinhanh_tenhinh", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                accept: function (file, done) {
                    done();
                }

            };
        </script>

    </body>
</html>