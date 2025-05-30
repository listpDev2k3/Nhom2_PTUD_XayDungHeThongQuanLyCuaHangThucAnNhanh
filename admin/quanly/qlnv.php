<?php

include("../../class/clsmng.php");
$obj = new quanly();
if (isset($_POST["MaNV"])) {
    $id = $_POST["MaNV"];
    if ($obj->xoanhanvien($id)) {
        echo "<script>alert('Xóa nhân viên thành công')</script>";
    } else {
        echo "<script>alert('Xóa nhân viên thất bại')</script>";
    }
}

$nhanvien = $obj->danhsachnhanvien();
if ($nhanvien) {
    echo '<table width="100%" class="table table-hover">
            <h3 class="text-center text-danger" style="text-align:center;">QUẢN LÝ NHÂN SỰ</h3>
            <div><a class="nav-item text-end" href = "themnhanvien.php" >Thêm mới</a></div>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>SDT</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>';
    foreach ($nhanvien as $key => $value) {
        
        echo '
                <tr>
                    <td align="center">' . ($key + 1) . '</td>
                    <td><a href="suanhanvien.php=' . $value["MaNV"] . '">' . $value["HoTen"] . '</a></td>
                    <td><a href="suanhanvien.php=' . $value["MaNV"] . '">' . $value["DiaChi"] . '</a></td>
                    <td><a href="suanhanvien.php=' . $value["MaNV"] . '">' . $value["Sdt"] . '</a></td>
                    
                    <td align="center">
                        <form method="post">
                            <input type="hidden" name="MaNV" value="' . $value["MaNV"] . '">
                            <button type="submit" class="btn btn-dark text-white rounded-5 px-4 py-2" onclick="return confirm(\'Bạn có chắc muốn xóa  nhân viên này không?\')">Xóa</button>
                        </form>
                    </td>
                </tr>';
    }
    echo '</tbody>
        </table>';
}
?>
