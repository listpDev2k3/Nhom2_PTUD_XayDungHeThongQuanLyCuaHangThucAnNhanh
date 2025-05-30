<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

require_once "../../class/clsdb.php";
$db = new database();

// Handle CCCD and salary information
$salaryDetails = null;
$workingHours = 0;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cccd = $_POST['cccd']; // Get the entered CCCD

    // Fetch employee details from the database using CCCD
    $user = $db->getUserByCCCD($cccd); // Assuming you have a method to get user info by CCCD

    if ($user) {
        // Fetch salary data from the bangluong table
        $salaryDetails = $db->getSalaryDetails($user['MaNV']);
        
        // Fetch total working hours from the bangchamcong table
        $workingHours = $db->getTotalWorkingHours($user['MaNV']);
    } else {
        $error = "CCCD không hợp lệ.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xem Lương</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        
        <header class="d-flex justify-content-between">
            <h1>Xem Lương</h1>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </header>

        <div class="row mt-4">
            <!-- Left Column: CCCD Input -->
            <div class="col-md-4">
                <h3>Nhập CCCD</h3>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="cccd" class="form-label">Căn cước công dân</label>
                        <input type="text" class="form-control" id="cccd" name="cccd" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                <?php endif; ?>
            </div>

            <!-- Right Column: Salary Information -->
            <div class="col-md-8">
                <?php if ($salaryDetails && $workingHours > 0): ?>
                    <h3>Thông tin lương cho nhân viên: <?php echo htmlspecialchars($user['HoTen']); ?></h3>
                    <table class="table mt-4">
                        <tr>
                            <th>Số giờ làm</th>
                            <td><?php echo $workingHours; ?> giờ</td>
                        </tr>
                        <tr>
                            <th>Lương cơ bản</th>
                            <td><?php echo number_format($salaryDetails['LuongCoBan'], 0, ',', '.'); ?> VND</td>
                        </tr>
                        <tr>
                            <th>Phụ cấp</th>
                            <td><?php echo number_format($salaryDetails['Thuong'], 0, ',', '.'); ?> VND</td>
                        </tr>
                        <tr>
                            <th>Thưởng khác</th>
                            <td><?php echo number_format($salaryDetails['Thuong'], 0, ',', '.'); ?> VND</td>
                        </tr>
                        <tr>
                            <th>Tổng lương</th>
                            <td><?php echo number_format($salaryDetails['Tong'], 0, ',', '.'); ?> VND</td>
                        </tr>
                    </table>

                    <!-- Option to download or print salary slip -->
                    <a href="download_salary_slip.php?MaBangLuong=<?php echo $salaryDetails['MaBangLuong']; ?>" class="btn btn-success">Tải bảng lương (PDF/Excel)</a>
                    <button class="btn btn-info" onclick="window.print()">In bảng lương</button>
                <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <div class="alert alert-warning mt-4">Không tìm thấy dữ liệu cho CCCD này.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
