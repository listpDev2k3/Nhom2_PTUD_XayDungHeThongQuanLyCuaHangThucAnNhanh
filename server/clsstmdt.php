<?php
class Menu {
    private $db;

    // Nhận đối tượng kết nối cơ sở dữ liệu khi khởi tạo
    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy danh sách tất cả món ăn
    public function layDanhSachMonAn() {
        $sql = "SELECT * FROM mon";  // Truy vấn lấy toàn bộ món ăn từ bảng 'mon'
        $result = $this->db->query($sql);  // Thực hiện truy vấn

        // Kiểm tra kết quả trả về
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);  // Trả về danh sách món ăn dưới dạng mảng
        }
        return [];
    }

    // Tìm món ăn theo mã nguyên liệu
    public function timMonAnTheoNguyenLieu($MaNguyenLieu) {
        $sql = "SELECT * FROM mon WHERE MaNguyenLieu = ?";  // Truy vấn theo mã nguyên liệu
        $stmt = $this->db->prepare($sql);  // Chuẩn bị câu truy vấn
        $stmt->bind_param("i", $MaNguyenLieu);  // Liên kết tham số
        $stmt->execute();  // Thực thi câu truy vấn
        $result = $stmt->get_result();  // Lấy kết quả

        // Kiểm tra và trả về kết quả
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);  // Trả về mảng các món ăn
        }
        return [];
    }

    // Hiển thị món ăn
    public function hienThiMonAn($monAn) {
        $TenMonAn = $monAn['TenMonAn'];
        $GiaGoc = number_format($monAn['GiaGoc'], 0, ',', '.');
        $Mota = $monAn['Mota'];
        $Hinhanh = $monAn['Hinhanh'];
        $LoaiSanPham = strtolower($monAn['LoaiSanPham']);
        $MaMonAn = $monAn['MaMonAn'];

        // Hiển thị HTML món ăn
        echo '<div class="col-sm-6 col-lg-4 all ' . $LoaiSanPham . '">
                <div class="box">
                    <div class="img-box">
                        <img src="images/' . $Hinhanh . '" alt="' . $TenMonAn . '">
                    </div>
                    <div class="detail-box">
                        <h5>' . $TenMonAn . '</h5>
                        <p>' . $Mota . '</p>
                        <div class="options">
                            <h6>Giá: ' . $GiaGoc . ' đ</h6>
                            <a href="detail_product.php?ma=' . $MaMonAn .'">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456.029 456.029">
                                    <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                    c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z"/>
                                    <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                    C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                    c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                    C457.728,97.71,450.56,86.958,439.296,84.91z"/>
                                    <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                    c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>';
    }
}
?>
