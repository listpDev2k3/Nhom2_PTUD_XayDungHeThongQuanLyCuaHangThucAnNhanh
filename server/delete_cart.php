<?php
require_once 'connect_data.php';

if (isset($_POST['cart_item_id'])) {
    $cart_item_id = $_POST['cart_item_id'];

    // Delete the item from the cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE MaMonAn = ?");
    $stmt->bind_param("i", $cart_item_id);
    $stmt->execute();

    // Get the updated total price for the cart
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
