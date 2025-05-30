<?php
if(isset($_POST["btThem"]))
{
    $MaMonAn=$_POST["MaMonAn"];
    $TenMonAn=$_POST["TenMonAn"];
    $GiaGoc=$_POST["GiaGoc"];
    
   
    $obj = new quanly(); 
    if($obj->themsanpham($MaMonAn, $TenMonAn, $GiaGoc))
    {
        echo "<script>alert('Thêm MÓN ĂN thành công')</script>";
    }
    else
    {
        echo "<script>alert('Thêm MÓN ĂN thành công')</script>";
    }
}

?>
