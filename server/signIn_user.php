<?php
include 'connect_data.php'; // Kết nối cơ sở dữ liệu

if (isset($_POST['signIn'])) {
    $SoDienThoai = $conn->real_escape_string($_POST['SoDienThoai']);
    $password = $_POST['password'];

    // Truy vấn kiểm tra thông tin người dùng
    $sql = "SELECT MaKH, HoTen, SoDienThoai, email, password FROM khachhang WHERE SoDienThoai = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $SoDienThoai);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // So sánh mật khẩu
        if ($password === $row['password']) {
            // Khởi tạo session và lưu thông tin người dùng
            session_start();
            $_SESSION['MaKH'] = $row['MaKH'];
            $_SESSION['HoTen'] = $row['HoTen'];
            $_SESSION['SoDienThoai'] = $row['SoDienThoai'];
            $_SESSION['email'] = $row['email'];

            // Thông báo thành công và chuyển hướng
            echo "<div style='text-align: center; font-size: 20px; color: green;'>
                Đăng Nhập thành công! Bạn sẽ được chuyển đến trang chủ sau 3 giây...
            </div>";
            header("refresh:3; url=http://localhost:85/Nhom21/thongtincanhan.php");
            exit();
        } else {
            // Sai mật khẩu
            echo "<div style='text-align: center; font-size: 20px; color: red;'>
                Mật khẩu không đúng! Bạn sẽ được chuyển đến trang đăng nhập sau 3 giây...
            </div>";
            header("refresh:3; url=http://localhost:85/Nhom21/dang_nhap.php");
            exit();
        }
    } else {
        // Không tìm thấy người dùng
        echo "<div style='text-align: center; font-size: 20px; color: red;'>
            Không tìm thấy tài khoản! Bạn sẽ được chuyển đến trang đăng nhập sau 3 giây...
        </div>";
        header("refresh:3; url=http://localhost:85/Nhom21/dang_nhap.php");
        exit();
    }

    $stmt->close();
}
$conn->close();
?>
