<?php
include 'connect_data.php';
if (isset($_POST['signUp'])) {
    $HoTen = $_POST['HoTen'];
    $SoDienThoai = $_POST['SoDienThoai'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkUser = "SELECT * FROM khachhang WHERE email = '$email' OR SoDienThoai = '$SoDienThoai'";
    $result = $conn->query($checkUser);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['email'] === $email) {
            echo "Email đã được sử dụng";
        } elseif ($row['SoDienThoai'] === $SoDienThoai) {
            echo "Số Điện Thoại đã được sử dụng";
        }
    } else {
        $insertQuery = "INSERT INTO khachhang(HoTen, SoDienThoai, email, password) VALUES ('$HoTen', '$SoDienThoai', '$email', '$password')";
        if ($conn->query($insertQuery) === TRUE) {
            echo "<div style='text-align: center; font-size: 20px; color: green;'>
                Đăng ký thành công! Bạn sẽ được chuyển đến trang đăng nhập sau 3 giây...
            </div>";
            header("refresh:3; url=http://localhost:85/Nhom21/dang_nhap.php"); 
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
