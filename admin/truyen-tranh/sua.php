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
        <title>Chỉnh sửa truyện tranh</title>
        <!-- Nhúng file Quản lý các Liên kết CSS dùng chung cho toàn bộ trang web -->
        <?php include_once(__DIR__ . '/../../frontend/layouts/styles.php'); ?>
    </head>

    <body class="d-flex flex-column h-100">
        <main role="main">   
            <!-- Block content -->
            <h1 class="tieu-de">CHỈNH SỬA TRUYỆN TRANH</h1>
            <div class="container">
                <!-- Form TRUYỆN TRANH START -->
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
                // var_dump($truyenRow);die;
                /* --- End Truy vấn dữ liệu Truyện theo khóa chính --- */
                ?>

                <!-- Form cho phép người dùng upload file lên Server bắt buộc phải có thuộc tính enctype="multipart/form-data" -->
                <form name="frmSua" id="frmSua" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="truyen_ma">Mã:</label>
                        <input type="text" class="form-control ml-2" id="truyen_ma" name="truyen_ma" placeholder="Mã truyện tranh" 
                               value="<?= $truyenRow['truyen_ma'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="truyen_ten">Tên:</label>
                        <input type="text" class="form-control ml-2" id="truyen_ten" name="truyen_ten" placeholder="Tên truyện tranh" 
                               value="<?= $truyenRow['truyen_ten'] ?>">
                    </div>                
                    <div class="form-group">
                        <label for="truyen_loai">Loại:</label>
                        <input type="text" class="form-control ml-2" id="truyen_loai" name="truyen_loai" placeholder="Loại truyện tranh" value="#2-Truyện tranh" readonly>
                    </div>
                    <div class="form-group ">
                        <label for="truyen_theloai">Thể loại:</label>
                        <input type="text" class="form-control col ml-2" id="truyen_theloai" name="truyen_theloai" placeholder="Thể loại truyện tranh"
                               value="<?= $truyenRow['truyen_theloai'] ?>">
                    </div>
                    <div class="form-group ">
                        <label for="truyen_tacgia">Tác giả:</label>
                        <input type="text" class="form-control col ml-2" id="truyen_tacgia" name="truyen_tacgia" placeholder="Tác giả truyện tranh"
                               value="<?= $truyenRow['truyen_tacgia'] ?>">
                    </div>                   
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label for="truyen_hinhdaidien">Hình đại diện:
                                <!-- Tạo khung div hiển thị ảnh cho người dùng Xem trước khi upload file lên Server -->
                                <div class="preview-img-container mt-2">
                                    <img src="/project-nentang/assets/uploads/truyen-tranh/<?= $truyenRow['truyen_hinhdaidien'] ?>" id="preview-img" width="60%" />                          
                                    <!-- Input cho phép người dùng chọn FILE 
                                    Chỉ cho phép người dùng chọn các file Ảnh (*.jpg, *.jpeg, *.png, *.gif)
                                    -->
                                    <input type="file" class="col mt-2" id="truyen_hinhdaidien" name="truyen_hinhdaidien"
                                           accept=".jpg, .jpeg, .png, .gif">
                                </div>
                            </label>
                        </div>
                        <div class="form-group col-8">
                            <label for="truyen_mota_ngan">Mô tả ngắn:</label>
                            <textarea class="form-control col ml-2" id="truyen_mota_ngan" name="truyen_mota_ngan" placeholder="Mô tả ngắn về truyện tranh" rows="10"><?= $truyenRow['truyen_mota_ngan'] ?></textarea>
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="danh-sach.php" class="btn btn-secondary">Quay về</a>
                        <button class="btn btn-danger" name="btnLuu">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Form TRUYỆN TRANH END -->


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

// 2. Nếu người dùng có bấm nút "Lưu dữ liệu" -> thì tiến hành xử lý
// Kiểm tra xem dữ liệu từ Client truyền đến có tồn tại KEY nào có tên là "btnLuu" hay không? => nếu có tồn tại thì xem như người dùng đã bấm nút
        if (isset($_POST['btnLuu'])) {
            // 3. Thu thập các thông tin do người dùng từ Client truyền đến
            $truyen_ma = $_POST['truyen_ma'];
            $truyen_ten = $_POST['truyen_ten'];
            $truyen_loai = 2; // #2-Truyện tranh
            $truyen_theloai = $_POST['truyen_theloai'];
            $truyen_tacgia = $_POST['truyen_tacgia'];
            $truyen_mota_ngan = $_POST['truyen_mota_ngan'];
            $truyen_ngaydang = date('Y-m-d H:i:s');

            // 4. Kiểm tra ràng buộc dữ liệu (Validation)
            // Tạo biến lỗi để chứa thông báo lỗi
            $errors = [];

            // -- Validate Mã truyện tranh
            // required
            if (empty($truyen_ma)) {
                $errors['truyen_ma'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $truyen_ma,
                    'msg' => 'Vui lòng nhập mã Truyện'
                ];
            }
            // minlength 3
            else if (!empty($truyen_ma) && strlen($truyen_ma) < 3) {
                $errors['truyen_ma'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 3,
                    'value' => $truyen_ma,
                    'msg' => 'Mã truyện phải có ít nhất 3 ký tự'
                ];
            }
            // maxlength 50
            else if (!empty($truyen_ma) && strlen($truyen_ma) > 100) {
                $errors['truyen_ma'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 100,
                    'value' => $truyen_ma,
                    'msg' => 'Mã truyện không được vượt quá 50 ký tự'
                ];
            }

            // -- Validate Tên Truyện tranh
            // required
            if (empty($truyen_ten)) {
                $errors['truyen_ten'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $truyen_ten,
                    'msg' => 'Vui lòng nhập tên Truyện'
                ];
            }
            // minlength 3
            else if (!empty($truyen_ten) && strlen($truyen_ten) < 3) {
                $errors['truyen_ten'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 3,
                    'value' => $truyen_ten,
                    'msg' => 'Tên Truyện phải có ít nhất 3 ký tự'
                ];
            }
            // maxlength 50
            else if (!empty($truyen_ten) && strlen($truyen_ten) > 50) {
                $errors['truyen_ten'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 50,
                    'value' => $truyen_ten,
                    'msg' => 'Tên Truyện không được vượt quá 50 ký tự'
                ];
            }

            // -- Validate Thể loại Truyện tranh
            // required
            if (empty($truyen_theloai)) {
                $errors['truyen_theloai'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $truyen_theloai,
                    'msg' => 'Vui lòng nhập thể loại Truyện'
                ];
            }
            // minlength 3
            else if (!empty($truyen_theloai) && strlen($truyen_theloai) < 3) {
                $errors['truyen_theloai'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 3,
                    'value' => $truyen_theloai,
                    'msg' => 'Thể loại Truyện phải có ít nhất 3 ký tự'
                ];
            }
            // maxlength 50
            else if (!empty($truyen_theloai) && strlen($truyen_theloai) > 100) {
                $errors['truyen_theloai'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 100,
                    'value' => $truyen_theloai,
                    'msg' => 'Thể loại Truyện không được vượt quá 50 ký tự'
                ];
            }

            // -- Validate Tác giả Truyện tranh
            // required
            if (empty($truyen_tacgia)) {
                $errors['truyen_tacgia'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $truyen_tacgia,
                    'msg' => 'Vui lòng nhập tác giả Truyện'
                ];
            }
            // minlength 3
            else if (!empty($truyen_tacgia) && strlen($truyen_tacgia) < 3) {
                $errors['truyen_tacgia'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 3,
                    'value' => $truyen_tacgia,
                    'msg' => 'Tác giả Truyện phải có ít nhất 3 ký tự'
                ];
            }
            // maxlength 50
            else if (!empty($truyen_tacgia) && strlen($truyen_tacgia) > 50) {
                $errors['truyen_tacgia'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 50,
                    'value' => $truyen_tacgia,
                    'msg' => 'Tác giả Truyện không được vượt quá 50 ký tự'
                ];
            }

            // -- Validate Mô tả ngắn
            // required
            if (empty($truyen_mota_ngan)) {
                $errors['truyen_mota_ngan'][] = [
                    'rule' => 'required',
                    'rule_value' => true,
                    'value' => $truyen_mota_ngan,
                    'msg' => 'Vui lòng nhập mô tả ngắn Truyện'
                ];
            }
            // minlength 3
            else if (!empty($truyen_mota_ngan) && strlen($truyen_mota_ngan) < 3) {
                $errors['truyen_mota_ngan'][] = [
                    'rule' => 'minlength',
                    'rule_value' => 3,
                    'value' => $truyen_mota_ngan,
                    'msg' => 'Mô tả Truyện phải có ít nhất 3 ký tự'
                ];
            }
            // maxlength 65000
            else if (!empty($truyen_mota_ngan) && strlen($truyen_mota_ngan) > 65000) {
                $errors['truyen_mota_ngan'][] = [
                    'rule' => 'maxlength',
                    'rule_value' => 65000,
                    'value' => $truyen_mota_ngan,
                    'msg' => 'Mô tả Truyện không được vượt quá 65000 ký tự'
                ];
            }

            // -- Validate File hình ảnh đại diện
            // Thu thập thông tin về FILES
            // Nếu người dùng có chọn file để upload
            if (isset($_FILES['truyen_hinhdaidien'])) {
                // Đối với mỗi file, sẽ có các thuộc tính như sau:
                // $_FILES['truyen_hinhdaidien']['name']     : Tên của file chúng ta upload
                // $_FILES['truyen_hinhdaidien']['type']     : Kiểu file mà chúng ta upload (hình ảnh, word, excel, pdf, txt, ...)
                // $_FILES['truyen_hinhdaidien']['tmp_name'] : Đường dẫn đến file tạm trên web server
                // $_FILES['truyen_hinhdaidien']['error']    : Trạng thái của file chúng ta upload, 0 => không có lỗi
                // $_FILES['truyen_hinhdaidien']['size']     : Kích thước của file chúng ta upload
                // -- Validate trường hợp file Upload lên Server bị lỗi
                // Nếu file upload bị lỗi, tức là thuộc tính error > 0
                if ($_FILES['truyen_hinhdaidien']['error'] > 0) {
                    // File Upload Bị Lỗi
                    $fileError = $_FILES["truyen_hinhdaidien"]["error"];

                    // Tùy thuộc vào giá trị lỗi mà chúng ta sẽ trả về câu thông báo lỗi thân thiện cho người dùng...
                    switch ($fileError) {
                        case UPLOAD_ERR_OK: // 0
                            break;
                        case UPLOAD_ERR_INI_SIZE:
                            // Exceeds max size in php.ini
                            $errors['truyen_hinhdaidien'][] = [
                                'rule' => 'max_size',
                                'rule_value' => '5Mb',
                                'value' => $_FILES["truyen_hinhdaidien"]["tmp_name"],
                                'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                            ];
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            // Exceeds max size in html form
                            $errors['truyen_hinhdaidien'][] = [
                                'rule' => 'max_size',
                                'rule_value' => '5Mb',
                                'value' => $_FILES["truyen_hinhdaidien"]["tmp_name"],
                                'msg' => 'File bạn upload có dung lượng quá lớn. Vui lòng upload file không vượt quá 5Mb...'
                            ];
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            // Không ràng buộc phải chọn file
                            // No file was uploaded
                            // $errors['truyen_hinhdaidien'][] = [
                            //   'rule' => 'no_file',
                            //   'rule_value' => true,
                            //   'value' => $_FILES["truyen_hinhdaidien"]["tmp_name"],
                            //   'msg' => 'Bạn chưa chọn file để upload...'
                            // ];
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            // No /tmp dir to write to
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            // Error writing to disk
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            // A PHP extension stopped the file upload
                            break;
                        default:
                            // No error was faced! Phew!
                            break;
                    }
                } else {
                    // -- Validate trường hợp file Upload lên Server thành công mà bị sai về Loại file (file types)
                    // Nếu người dùng upload file khác *.jpg, *.jpeg, *.png, *.gif
                    // thì báo lỗi
                    $file_extension = pathinfo($_FILES['truyen_hinhdaidien']["name"], PATHINFO_EXTENSION); // Lấy đuôi file (file extension) để so sánh
                    if (!($file_extension == 'jpg' || $file_extension == 'jpeg' || $file_extension == 'png' || $file_extension == 'gif'
                            )) {
                        $errors['truyen_hinhdaidien'][] = [
                            'rule' => 'file_extension',
                            'rule_value' => '.jpg, .jpeg, .png, .gif',
                            'value' => $_FILES['truyen_hinhdaidien']["name"],
                            'msg' => 'Chỉ cho phép upload các định dạng (*.jpg, *.jpeg, *.png, *.gif)...'
                        ];
                    }

                    // -- Validate trường hợp file Upload lên Server thành công mà kích thước file quá lớn
                    $file_size = $_FILES['truyen_hinhdaidien']["size"];
                    if ($file_size > (1024 * 1024 * 10)) { // 1 Mb = 1024 Kb = 1024 * 1024 Byte
                        $errors['truyen_hinhdaidien'][] = [
                            'rule' => 'file_size',
                            'rule_value' => (1024 * 1024 * 10),
                            'value' => $_FILES['truyen_hinhdaidien']["name"],
                            'msg' => 'Chỉ cho phép upload file nhỏ hơn 10Mb...'
                        ];
                    }
                }
            }
        }
        ?>

        <!-- Vùng hiển thị thông báo lỗi khi người dùng nhập liệu có sai sót thông tin -->
        <!-- Nếu có lỗi VALIDATE dữ liệu thì hiển thị ra màn hình 
        - Sử dụng thành phần (component) Alert của Bootstrap
        - Mỗi một lỗi hiển thị sẽ in theo cấu trúc Danh sách không thứ tự UL > LI
        -->
        <?php
        if (
                isset($_POST['btnLuu'])   // Nếu người dùng có bấm nút "Lưu dữ liệu"
                && isset($errors)         // Nếu biến $errors có tồn tại
                && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
        ) :
            ?>
            <div id="errors-container" class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <ul>
                    <?php foreach ($errors as $fields) : ?>
                        <?php foreach ($fields as $field) : ?>
                            <li><?php echo $field['msg']; ?></li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php
        // Nếu không có lỗi VALIDATE dữ liệu (tức là dữ liệu đã hợp lệ)
        // Tiến hành thực thi câu lệnh SQL Query Database
        // => giá trị của biến $errors là rỗng
        if (
                isset($_POST['btnLuu'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                && (!isset($errors) || (empty($errors))) // Nếu biến $errors không tồn tại Hoặc giá trị của biến $errors rỗng
        ) {
            // VALIDATE dữ liệu đã hợp lệ
            $tentaptin = $truyenRow['truyen_hinhdaidien'];

            // Nếu người dùng có chọn file hình mới -> và quá trình upload hình thành công
            if (isset($_FILES['truyen_hinhdaidien']) && $_FILES['truyen_hinhdaidien']['error'] == 0) {
                // Đường dẫn để chứa thư mục upload trên ứng dụng web của chúng ta. Các bạn có thể tùy chỉnh theo ý các bạn.
                // Ví dụ: các file upload sẽ được lưu vào thư mục "assets/uploads/..."
                $upload_dir = __DIR__ . "/../../assets/uploads/truyen-tranh/";

                // Xóa file cũ để tránh rác trong thư mục UPLOADS
                // Kiểm tra nếu file có tổn tại thì xóa file đi
                $old_file = $upload_dir . $truyenRow['truyen_hinhdaidien'];
                if (file_exists($old_file)) {
                    // Hàm unlink(filepath) dùng để xóa file trong PHP
                    unlink($old_file);
                }

                // Để tránh trường hợp có 2 người dùng cùng lúc upload tập tin trùng tên nhau
                // Ví dụ:
                // - Người 1: upload tập tin hình ảnh tên `hoahong.jpg`
                // - Người 2: cũng upload tập tin hình ảnh tên `hoahong.jpg`
                // => dẫn đến tên tin trong thư mục chỉ còn lại tập tin người dùng upload cuối cùng
                // Cách giải quyết đơn giản là chúng ta sẽ ghép thêm ngày giờ vào tên file
                $tentaptin = date('YmdHis') . '_' . $_FILES['truyen_hinhdaidien']['name']; //20200530154922_hoahong.jpg
                // Tiến hành di chuyển file từ thư mục tạm trên server vào thư mục chúng ta muốn chứa các file uploads
                // Ví dụ: move file từ C:\xampp\tmp\php6091.tmp -> C:/xampp/htdocs/project-nentang/assets/uploads/hoahong.jpg
                // var_dump($_FILES['truyen_hinhdaidien']['tmp_name']);
                // var_dump($upload_dir . $tentaptin);
                move_uploaded_file($_FILES['truyen_hinhdaidien']['tmp_name'], $upload_dir . $tentaptin);
            }

            // 4. Chuẩn bị câu lệnh SQL
            $sqlThemMoiTruyen = <<<EOT
        UPDATE truyen
        SET 
          truyen_ma = '$truyen_ma',
          truyen_ten = '$truyen_ten',
          truyen_hinhdaidien = '$tentaptin',
          truyen_loai = $truyen_loai,
          truyen_theloai = '$truyen_theloai',
          truyen_tacgia = '$truyen_tacgia',
          truyen_mota_ngan = '$truyen_mota_ngan',
          truyen_ngaydang = '$truyen_ngaydang'
        WHERE truyen_id = $truyen_id
EOT;
            // print_r($sqlThemMoiTruyen);
            // die;
            // 5. Thực thi câu truy vấn SQL để lấy về dữ liệu
            mysqli_query($conn, $sqlThemMoiTruyen) or die("<b>Có lỗi khi thực thi câu lệnh SQL: </b>" . mysqli_error($conn) . "<br /><b>Câu lệnh vừa thực thi:</b></br>$sqlThemMoiTruyen");

            // 6. Sau khi cập nhật dữ liệu, tự động điều hướng về trang Danh sách
            // Điều hướng bằng Javascript
            echo '<script>location.href = "danh-sach.php";</script>';
        }
        ?>
    </div>
    <!-- End block content -->
</main>


<!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
<?php include_once(__DIR__ . '/../../frontend/layouts/scripts.php'); ?>

<!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
<script>
    // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
    const reader = new FileReader();
    const fileInput = document.getElementById("truyen_hinhdaidien");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
        img.src = e.target.result;
    };
    fileInput.addEventListener('change', e => {
        const f = e.target.files[0];
        reader.readAsDataURL(f);
    });
</script>

</body>
</html>