<?php
require_once "../../class/clsdb.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new database();
    $user = $db->checkLogin($username, $password);

    if ($user) {
        // Lưu thông tin người dùng vào session
        $_SESSION['user'] = $user;
        $_SESSION['MaNV'] = $user['MaNV'];
        header("Location: index.php"); // Chuyển hướng đến trang nhân viên
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không chính xác!";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!-- Add Bootstrap CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <!-- Center the login form -->
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
    
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h3 class="card-title text-center mb-4">Đăng nhập</h3>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Tài khoản:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </form>
            <?php if (isset($error)): ?>
                <p class="text-danger text-center mt-3"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Bootstrap JS (Optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
