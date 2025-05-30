<?php
    
include("../../class/classmng.php");
$obj = new quanly();
include("xulysua.php");
$nhansu = $obj->danhsachnhanvien($id);
?>
    <h3 align="center" class="text-danger">CHỈNH SỬA NHÂN SỰ</h3>
    <form method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td width="30%">Mã Nhân viên</td>
                <td><input type="text" name="MaNV" class="form-control mt-3" required value="<?=$nhansu[0]['MaNV']?>" /></td>
            </tr>
            <tr>
                <td>Họ tên</td>
                <td><input type="text" name="HoTen" class="form-control mt-2"  required value="<?=$nhansu[0]['HoTen']?>" /></td>
            </tr>
            <tr>
                <td>Địa Chỉ</td>
                <td><input type="text" name="DiaChi" class="form-control mt-2" required value="<?=$nhansu[0]['DiaChi']?>" /></td>
            </tr>
            <tr>
                <td>Số điện thoại</td>
                <td><input type="file" name="Sdt" required class="form-control mt-2" required value="<?=$nhansu[0]['Sdt']?>" /></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="btSua" class="btn btn-dark text-white rounded-5 mt-3 px-5 py-2" value="Cập nhật" /></td>
            </tr>
        </table>
    </form>
?>