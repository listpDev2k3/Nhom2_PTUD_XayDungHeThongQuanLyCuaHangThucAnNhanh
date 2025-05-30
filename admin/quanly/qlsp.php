<?php

include("../../class/clsmng.php");
$obj = new quanly();
if (isset($_POST["MaMonAn"])) {
    $id = $_POST["MaMonAn"];
    if ($obj->xoasanpham($id)) {
        echo "<script>alert('Xóa món ăn thành công')</script>";
    } else {
        echo "<script>alert('Xóa món ăn thất bại')</script>";
    }
}

$mon = $obj->danhsachsanpham();
if ($mon) {
    echo '<table width="100%" class="table table-hover">
            <h3 class="text-center text-danger">QUẢN LÝ MÓN ĂN</h3>
            <div><a class="nav-item text-end" href = "themsanpham.php" >Thêm mới</a></div>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>GIÁ GỐC</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($mon as $key => $value) {
        
        echo '
                <tr>
                    <td align="center">' . ($key + 1) . '</td>
                    <td><a href="suasanpham.php=' . $value["MaMonAn"] . '">' . $value["TenMonAn"] . '</a></td>
                    <td><a href="suasanpham.php=' . $value["MaMonAn"] . '">' . $value["GiaGoc"] . '</a></td>
                    
                    
                    <td align="center">
                        <form method="post">
                            <input type="hidden" name="MaMonAn" value="' . $value["MaMonAn"] . '">
                            <button type="submit" class="btn btn-dark text-white rounded-5 px-4 py-2" onclick="return confirm(\'Bạn có chắc muốn xóa món ăn này không?\')">Xóa</button>
                        </form>
                    </td>
                </tr>';
    }
    echo '</tbody>
        </table>';
}
?>
