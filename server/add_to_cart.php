<?php
// Kết nối database
require_once 'connect_data.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy các giá trị từ POST request
    $productId = isset($_POST['productId']) ? intval($_POST['productId']) : null;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : null;
    $userId = isset($_POST['userId']) ? intval($_POST['userId']) : null;

    // Kiểm tra nếu các giá trị hợp lệ
    if ($productId && $quantity && $userId) {
        // MaDonDat mặc định là 0
        $MaDonDat = 0;

        // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng cart
        $stmt = $conn->prepare("INSERT INTO cart (MaMonAn, MaKH, quantity, MaDonDat) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $productId, $userId, $quantity, $MaDonDat);

        // Thực thi câu lệnh SQL
        if ($stmt->execute()) {
            // Trả về phản hồi thành công
            echo json_encode(['success' => true, 'message' => 'Thêm sản phẩm vào giỏ hàng thành công!']);
        } else {
            // Nếu không thể thực hiện lệnh SQL
            echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi thêm vào giỏ hàng.']);
        }

        $stmt->close();
    } else {
        // Nếu các giá trị không hợp lệ
        echo json_encode(['success' => false, 'message' => 'Thông tin không đầy đủ.']);
    }
} else {
    // Nếu không phải là POST request
    echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
}
?>
