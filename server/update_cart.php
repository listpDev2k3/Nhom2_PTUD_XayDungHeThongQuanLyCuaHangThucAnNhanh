<?php
require_once 'connect_data.php';

if (isset($_POST['cart_item_id']) && isset($_POST['new_quantity'])) {
    $cart_item_id = $_POST['cart_item_id'];
    $new_quantity = $_POST['new_quantity'];

    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE MaMonAn = ?");
    $stmt->bind_param("ii", $new_quantity, $cart_item_id);
    $stmt->execute();

    $stmt = $conn->prepare("SELECT SUM(cart.quantity * mon.GiaGiam) AS total_price
                            FROM cart
                            JOIN mon ON cart.MaMonAn = mon.MaMonAn
                            WHERE cart.MaKH = ?");
    $stmt->bind_param("i", $_GET['MaKH']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo json_encode([
        'success' => true,
        'total_price' => number_format($row['total_price'], 0, ',', '.')
    ]);

    $stmt->close();
    $conn->close();
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Missing parameters.'
    ]);
}
?>
