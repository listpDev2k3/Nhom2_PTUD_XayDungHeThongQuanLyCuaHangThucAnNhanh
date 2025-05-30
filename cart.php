<?php
require_once 'server/connect_data.php';

$cart_items = []; 
$total_price = 0; 

if (isset($_GET['MaKH'])) {
    $MaKH = $_GET['MaKH'];
    $stmt = $conn->prepare(" 
        SELECT 
            cart.MaMonAn,
            cart.quantity, 
            mon.TenMonAn, 
            mon.GiaGiam,
            mon.MaNguyenLieu, 
            mon.HinhAnh 
        FROM 
            cart 
        JOIN 
            mon ON cart.MaMonAn = mon.MaMonAn
        WHERE 
            cart.MaKH = ? 
    ");
    $stmt->bind_param("i", $MaKH);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $cart_items[] = $row;
        $total_price += $row['GiaGiam'] * $row['quantity'];
    }

    $stmt->close();
    $conn->close();
} else {
    $cart_items = [];
    $total_price = 0;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .cart-section {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        .cart-header {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr 1fr 1fr 1fr;
            padding: 10px 0;
            background-color: #f8f8f8;
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .cart-items {
            margin-top: 20px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 1fr 3fr 1fr 1fr 1fr 1fr;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-item-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .cart-item-name,
        .cart-item-quantity,
        .cart-item-price,
        .cart-item-total,
        .cart-item-actions {
            text-align: center;
        }

        .quantity-button {
            background-color: #4CAF50;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .quantity-button:hover {
            background-color: #45a049;
        }

        .btn-update,
        .btn-delete {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        .btn-update {
            background-color: #4CAF50;
        }

        .btn-update:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
        }

        .btn-delete:hover {
            background-color: #e53935;
        }

        .total-price {
            font-weight: bold;
            font-size: 16px;
            margin-top: 20px;
        }

        .total-price .price {
            color: #4CAF50;
            font-size: 18px;
        }

        .buttons {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .button {
            padding: 8px 16px;
            font-size: 14px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button-back {
            background-color: #f44336;
        }

        .button-back:hover {
            background-color: #e53935;
        }
    </style>
</head>
<body>

<section class="cart-section">
    <?php if (!empty($cart_items)): ?>
        <div class="cart-container">
            <div class="cart-header">
                <div>Hình ảnh</div>
                <div>Tên món ăn</div>
                <div>Số lượng</div>
                <div>Đơn giá</div>
                <div>Thành tiền</div>
                <div>Chỉnh sửa</div>
            </div>

            <div class="cart-items">
                <?php foreach ($cart_items as $item): ?>
                    <div class="cart-item" data-cart-item-id="<?php echo $item['MaMonAn']; ?>">
                        <div class="cart-item-image">
                            <img src="images/<?php echo htmlspecialchars($item['HinhAnh']); ?>" alt="<?php echo htmlspecialchars($item['TenMonAn']); ?>" width="100">
                        </div>
                        <div class="cart-item-name"><?php echo htmlspecialchars($item['TenMonAn']); ?></div>
                        <div class="cart-item-quantity">
                            <button class="quantity-button" type="button" value="-" onclick="changeQuantity('DOWS', this)">-</button>
                            <span class="quantity"><?php echo $item['quantity']; ?></span>
                            <button class="quantity-button" type="button" value="+" onclick="changeQuantity('UP', this)">+</button>
                        </div>
                        <div class="cart-item-price">
                            <?php echo number_format($item['GiaGiam'], 0, ',', '.'); ?> đ
                        </div>
                        <div class="cart-item-total">
                            <?php echo number_format($item['GiaGiam'] * $item['quantity'], 0, ',', '.'); ?> đ
                        </div>
                        <div class="cart-item-actions">
                            <button type="button" class="btn-update" onclick="updateCart('<?php echo $item['MaMonAn']; ?>')">Cập nhật</button>
                            <button type="button" class="btn-delete" onclick="deleteCartItem('<?php echo $item['MaMonAn']; ?>')">Sóa</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="total-price">
                <span>Tổng Tiền: </span>
                <span class="price"><?php echo number_format($total_price, 0, ',', '.'); ?> đ</span>
            </div>

            <div class="buttons">
                <a href="index.php" class="button button-back">Quay lại</a>
                <a href="thanhtoan.php" class="button">Thanh toán</a>
                <!--<a href="checkout.php?MaKH=<?php echo $MaKH; ?>" class="button">Thanh toán</a>-->
            </div>
        </div>
    <?php else: ?>
        <p>Giỏ hàng của bạn hiện tại trống!</p>
    <?php endif; ?>
</section>

<script>
    const changeQuantity = (signal, button) => {
        const quantityElement = button.closest('.cart-item').querySelector('.quantity');
        let quantity = parseInt(quantityElement.textContent, 10);

        if (signal === 'UP') {
            quantity += 1;
        } else if (signal === 'DOWS' && quantity > 1) {
            quantity -= 1;
        }

        quantityElement.textContent = quantity;
    };

    const updateCart = (cartItemId) => {
      const quantityElement = document.querySelector(`[data-cart-item-id="${cartItemId}"] .quantity`);
      const newQuantity = parseInt(quantityElement.textContent, 10);

      const data = new FormData();
      data.append('cart_item_id', cartItemId);
      data.append('new_quantity', newQuantity);

      fetch('server/update_cart.php', {
          method: 'POST',
          body: data,
      })
      .then(response => response.json())
      .then(result => {
          if (result.success) {
              document.querySelector(".total-price .price").textContent = result.total_price + " đ";
              alert("Giỏ hàng đã được cập nhật.");
          } else {
              alert("Cập nhật giỏ hàng thất bại.");
          }
      })
      .catch(error => {
          alert('Có lỗi xảy ra khi kết nối với server.');
          console.error('Error:', error);
      });
    };
    const deleteCartItem = (cartItemId) => {
      const data = new FormData();
      data.append('cart_item_id', cartItemId);

      fetch('server/delete_cart_item.php', {
          method: 'POST',
          body: data,
      })
      .then(response => response.json())
      .then(result => {
          if (result.success) {
              // Remove the item from the UI
              document.querySelector(`[data-cart-item-id="${cartItemId}"]`).remove();
              // Update the total price on the page
              document.querySelector(".total-price .price").textContent = result.total_price + " đ";
              alert("Sản phẩm đã được xóa.");
          } else {
              alert("Xóa sản phẩm thất bại.");
          }
      })
      .catch(error => {
          alert('Có lỗi xảy ra khi kết nối với server.');
          console.error('Error:', error);
      });
    };


</script>

</body>
</html>
