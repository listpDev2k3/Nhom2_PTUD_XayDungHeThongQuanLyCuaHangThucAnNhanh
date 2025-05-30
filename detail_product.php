<?php
// Kết nối cơ sở dữ liệu
require_once 'server/connect_data.php';

if (isset($_GET['ma'])) {
    $product_id = $_GET['ma'];

    // Truy vấn lấy chi tiết sản phẩm và tên nguyên liệu
    $stmt = $conn->prepare("
        SELECT mon.*, nguyenlieu.TenNguyenLieu
        FROM mon
        JOIN nguyenlieu ON mon.MaNguyenLieu = nguyenlieu.MaNguyenLieu
        WHERE mon.MaMonAn = ?
    ");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Kiểm tra xem sản phẩm có tồn tại không
    if ($row = $result->fetch_assoc()) {
        $product = $row;
    } else {
        $product = null;
    }

    $stmt->close();
    $conn->close();
} else {
    // Nếu không có mã sản phẩm trong URL
    $product = null;
}
?>



<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="shortcut icon" type="image/x-icon" href="../img2/logo-project.jpg">
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product</title>
   
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
    />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat&family=Quicksand:wght@500&family=Tilt+Neon&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="css/HomePage_products.css" />
    <link rel="stylesheet" href="css/san-pham.css" />
  </head>
  <style>
    /* Reset styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    a {
      text-decoration: none !important;
      color: inherit !important;
    }

    a:hover {
      color: inherit !important;
    }

    a:visited {
      color: inherit !important;
    }

    input:focus {
      outline: none;
    }

    @font-face {
      font-family: "Quicksand";
      src: url("../font/Montserrat,Quicksand,Tilt_Neon/Quicksand/Quicksand-VariableFont_wght.ttf")
        format("truetype");
      font-style: normal;
    }

    html,
    body {
      width: 100%;
      font-family: "Quicksand" !important;
      background-color: rgba(0, 0, 0, 0.03);
    }

    ul,
    li {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 12px 32px;
      background-color: #111;
      width: 100%;
      padding-right: 150px;
      padding-left: 150px;
      margin-right: auto;
      margin-left: auto;

    }

    .header_title span {
      font-size: 32px;
      font-weight: bold;
      color: white;
      font-family: "Dancing Script", cursive;
    }

    .header_nav {
      display: flex;
      gap: 32px;
    }

    .header_nav div {
      font-size: 16px;
      font-weight: 500;
      color: white;
      cursor: pointer;
      position: relative;
    }

    .header_nav div:hover {
      color: orange; /* Highlight effect */
    }

    .header_right {
      display: flex;
      align-items: center;
      gap: 16px;
    }

    .header_right a img {
      width: 20px;
      height: 20px;
      filter: invert(1);
      cursor: pointer;
    }

    .header_right a:last-child {
      font-size: 16px;
      font-weight: 500;
      color: white !important;
    }
    
    /* .cart{
      z-index: 2;
    } */
  </style>
  <body>
    <header class="header">
      <div class="header_title">
        <span> Delicious Food </span>
      </div>
      <div class="header_nav">
        <div>Trang Chủ</div>
        <div>Thực Đơn</div>
        <div>Về Chúng Tôi</div>
        <div>Liên Hệ</div>
      </div>
      <div class="header_right">
        <a href=""><img src="icon/user_icon.svg" alt="" /></a>
        <a href="cart.php?MaKH=1" onclick="updateCartQuantity() ">
          <img src="icon/cart_icon.svg" alt="" />
          <span id="cart-count">0</span>
        </a>
        <a href="" >
          <img src="icon/search_icon.svg" alt="" />
        </a>
        <a href="dang_nhap.php">Đăng Nhập</a>
      </div>
    </header>
    <section>
      <?php if ($product): ?>
      <div id="product_detail">
        <div class="product_detail_title">
         <h1><?php echo $product['TenMonAn']; ?></h1>
        </div>
        
        <div class="product_detail_content">
          <div class="product_detail_content_img">
            <div class="content_img_mainThumbnail">
                  <img id="main_img_preview"
                    src="images/<?php echo $product['Hinhanh']; ?>"
                  />
            </div>
          </div>
          <div class="product_detail_content_info">
            <div class="product_detail_content_info_price">
              <h2>
                <?php echo $product['GiaGiam']; ?> VND
              </h2>
              <del><?php echo $product['GiaGoc'] ? $product['GiaGoc'] . ' VND' : '0'; ?></del>
            </div>
            <div class="product_detail_content_info_sku">
              <b>Mã Món Ăn: <?php echo $product['MaMonAn']; ?></b>
            </div>
            <div class="product_detail_content_info_items">
              <span><b>Nguyên Liệu Chính: </b><?php echo isset($product['TenNguyenLieu']) ? $product['TenNguyenLieu'] : 'Không có thông tin'; ?></span>
            </div>     
            <div class="product_detail_content_info_items">
              <span><b>Nguyên Liệu: </b><?php echo $product['NguyenLieuPhu']; ?></span>
            </div>     
            <div class="product_detail_content_info_items">
              <span><b>Tình Trạng: </b> Còn</span>
            </div>     
            <div class="product_detail_content_info_quantities">
              <span><b>Số Lượng</b></span>
              <button class="product_detail_content_info_quantities__button" type="button" value="-" onclick="onClickButtonValue('DOWS')">-</button>
              <button class="product_detail_content_info_quantities__button" type="button" value="+" onclick="onClickButtonValue('UP')">+</button>
              <input class="numberOfProduct" type="text" value="1" readonly>
            </div>
            <div class="product_detail_content_info_buy">
              <div>
                <h3>Mua Ngay</h3>
                <p>(Giao hàng tận nơi hoặc lấy tại cửa hàng )</p>
              </div>
              <div onclick="addToCart()">
                <i class="bi bi-cart"></i>
                <p>Thêm Vào Giỏ</p>
              </div>
            </div>
          </div>
          <div class="product_status">
              <div class="product_status_linehot flex_star">  
                <img
                  src="https://bizweb.dktcdn.net/100/462/529/themes/885708/assets/customer-service.png?1678878165820"
                  title="hotline"
                >
                <div>
                  <div>
                    <span> 
                      Gọi ngay<b>0987556203</b> để được tư vấn tốt nhất!
                    </span>
                  </div>
                  <div>
                    <span> 
                      Địa chỉ mua hàng chính hãng: <b>19 Nguyễn Du, P.7, Quận Gò</b>
                    </span>
                  </div>
                </div>

              </div>
              <div class="product_status_info">
                <div>
                  <span>
                    Tình trạng: 
                    <b>Còn 23 Phần</b>
                  </span>
                </div>
                <div>
                  <span>
                    Thương hiệu:
                    <b>Delicious Food </b>
                  </span>
                </div>
              </div>
              <div class="product_status_items">
                <div>
                  <i class="bi bi-gift"></i>
                  <span>Khuyến Mãi</span>
                </div>
                <ul>
                  <li>
                    <i>Miễn phí ship cho đơn hàng từ 2.000.000Đ</i> </li>
                  <li><i>Áp dụng chính sách 1 đổi 1 cho các món bị lỗi</i> </li>

                </ul>
              </div>
          </div>
        </div>
        
      </div>
      <div id="product_detail_last">
        <div class="product_detail_last_items">
          <h3>Mô tả chi tiết món ăn</h3>
          <h2> <?php echo $product['Mota']; ?></h2>
          <span><span>
        </div>
         <div class="product_detail_last_items">
          <h3>Delicious Food</h3>
          <span>Delicious Food là thương hiệu thức ăn nhanh cam kết mang đến hương vị tươi ngon và chất lượng cao trong từng món ăn. Với sự đa dạng từ gà chiên giòn, pizza phô mai, đến burger và khoai tây chiên, chúng tôi luôn chú trọng lựa chọn nguyên liệu tươi và đảm bảo quy trình chế biến an toàn. Delicious Food hứa hẹn là điểm đến lý tưởng cho những bữa ăn nhanh gọn, đầy đủ dinh dưỡng và luôn hấp dẫn cho mọi lứa tuổi.</span>
        </div>
      </div>
      <?php else: ?>
          <p>Sản phẩm không tồn tại hoặc có lỗi khi lấy thông tin.</p>
        <?php endif; ?>
    </section>
    <section class="news max-width">
      <div class="news__container">
        <div class="news__container__name">
          <span>TIN TỨC</span>
        </div>
        <div class="news__container__box">
          <div class="news__container__box__items">
            <div class="news__container__box__items__img">
              <img src="images/ga.jpg" alt="">
            </div>
            <div class="news__container__box__items__title">
              <span>
                Khai Trương cửa hàng gà rán Delicious Food thứ 25
              </span>
            </div>
          </div>
          <div class="news__container__box ds-flex">
            <div class="news__container__box__items">
              <div class="news__container__box__items__img">
                <img src="images/f1.png" alt="">
              </div>
              <div class="news__container__box__items__title">
                <span>
                  Chiếc pizza to nhất cửa hàng năm 2022
                </span>
              </div>
            </div>

        </div>
      </div>
    </section>
  </body>
    

<script>
  const cartQuantity = 0; 
  const onClickButtonValue = (signal) => {
    const quantitiesProduct = document.querySelector(".numberOfProduct");
    let total = parseInt(quantitiesProduct.value, 10);
    total = signal === "UP" ? total + 1 : Math.max(1, total - 1);
    quantitiesProduct.value = total;
  };
  const addToCart = () => {
    const productId = <?php echo json_encode($product['MaMonAn']); ?>;
    const quantity = document.querySelector(".numberOfProduct").value;
    const userId = 2;

    const data = new FormData();
    data.append('productId', productId);
    data.append('quantity', quantity);
    data.append('userId', userId);

    fetch('server/add_to_cart.php', {
      method: 'POST',
      body: data,
    })
    .then(response => response.json())
    .then(result => {
      if (result.success) {
        // Hiển thị thông báo thành công trên trang hiện tại
        alert(result.message);

        // Gọi hàm cập nhật số lượng giỏ hàng
        updateCartQuantity();
      } else {
        // Hiển thị thông báo lỗi
        alert(result.message);
      }
    })
    .catch(error => {
      alert('Có lỗi xảy ra khi kết nối với server.');
      console.error('Error:', error);
    });
  };
  const updateCartQuantity = () => {

    const cartCountElement = document.querySelector("#cart-count");

    const currentQuantity = parseInt(cartCountElement.textContent, 10);
    cartCountElement.textContent = currentQuantity + 1;
  };



  
</script>
  