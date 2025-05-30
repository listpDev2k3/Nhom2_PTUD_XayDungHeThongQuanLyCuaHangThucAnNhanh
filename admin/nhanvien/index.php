    <?php
    session_start();


    if (!isset($_SESSION['user'])) {
        header("Location: login.php"); // Chuyển hướng về trang đăng nhập nếu chưa đăng nhập
        exit();
    }

    // Lấy thông tin người dùng từ session
    $user = $_SESSION['user'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Thông Tin Nhân Viên</title>
        <link rel="stylesheet" href="../../css/thongtin.css">
    </head>
    <body>
        <div class="container">
            <header class="header">
                <h1>Trang chủ</h1>
                <form method="POST" action="logout.php" style="display: inline;">
                <button type="submit" class="logout-btn">Đăng xuất</button>
                </form>
            </header>
            <div class="content">
                <nav class="sidebar">
                    <ul>
                        <li><button class="sidebar-btn">Cập nhật đơn hàng</button></li>
                        <li><button class="sidebar-btn" onclick="window.location.href='xemluong.php'">Xem lương</button></li>
                        <li><button class="sidebar-btn" onclick="window.location.href='dangkyca.php'">Đăng ký ca</button></li>
                    </ul>
                </nav>
                <main class="main-content">
                    <div class="avatar">
                        <img src="avatar-placeholder.png" alt="Avatar" class="avatar-img">
                    </div>
                    <table>
                <tr>
                    <th>Trường</th>
                    <th>Thông tin</th>
                </tr>
                <tr>
                    <td>Họ tên</td>
                    <td><?php echo htmlspecialchars($user['HoTen']); ?></td>
                </tr>
                <tr>
                    <td>Mã nhân viên</td>
                    <td><?php echo htmlspecialchars($user['MaNV']); ?></td>
                </tr>
                <tr>
                    <td>Vị Trí</td>
                    <td><?php echo htmlspecialchars($user['ViTri']); ?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td><?php echo htmlspecialchars($user['Sdt']); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($user['Email']); ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td><?php echo htmlspecialchars($user['DiaChi']); ?></td>
                </tr>
            </table>
                </main>
            </div>
        </div>
    </body>
    </html>