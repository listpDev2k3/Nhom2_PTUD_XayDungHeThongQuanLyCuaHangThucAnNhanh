<?php
if(isset($_POST["btSua"]))
{
    $MaNV = $_POST["MaNV"];
    $HoTen = $_POST["HoTen"];
    $DiaChi = $_POST["DiaChi"];
    $Sdt = $_POST["Sdt"];

    $sql = "UPDATE nguoidung SET HoTen='$HoTen', DiaChi='$DiaChi',Sdt='$Sdt' WHERE MaNV='$id";
        if($obj->capnhatnhanvien($MaNV,$HoTen, $DiaChi, $Sdt))
        {
            echo "<script>alert('Cập nhật nhân viên thành công')</script>";
        }
        else
        {
            echo "<script>alert('Cập nhật nhân viên không thành công')</script>";
        }
    }


?>