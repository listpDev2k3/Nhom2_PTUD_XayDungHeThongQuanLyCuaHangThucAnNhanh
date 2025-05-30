<?php
if(isset($_POST["btThem"]))
{
    $MaNV=$_POST["MaNV"];
    $HoTen=$_POST["HoTen"];
    $Sdt=$_POST["Sdt"];
    $DiaChi=$_POST["DiaChi"];
   
    $obj = new quanly(); 
    if($obj->themnhanvien($MaNV, $HoTen, $Sdt,$DiaChi))
    {
        echo "<script>alert('Thêm nhân viên thành công')</script>";
    }
    else
    {
        echo "<script>alert('Thêm nhân viên thành công')</script>";
    }
}

?>
