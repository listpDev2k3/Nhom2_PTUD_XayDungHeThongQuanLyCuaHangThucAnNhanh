<?php
// Bắt đầu hoặc kiểm tra phiên hiện tại
session_start();

// Hủy toàn bộ biến trong session
session_unset();

// Hủy session hiện tại
session_destroy();

// Chuyển hướng về trang đăng nhập
header('Location: login.php?message=logout_success');
exit(); // Đảm bảo không chạy mã phía dưới
?>
