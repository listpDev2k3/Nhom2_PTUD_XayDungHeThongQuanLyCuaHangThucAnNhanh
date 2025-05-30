<?php
include_once 'clsdb.php';  // Đảm bảo đường dẫn chính xác đến tệp clsdb.php
class quanly extends database
{
    public function danhsachnhanvien($id='')
    {
        if($id)
            $sql="select * from nguoidung where MaNV='$id'";
        else
            $sql="select * from nguoidung";
        return $this->getdata($sql);
    }

    public function xoanhanvien($id)
    {
        $sql = "delete from nguoidung where MaNV='$id'";
        return $this->deletedata($sql);
    }

    public function capnhatnhanvien($MaNV, $HoTen, $Sdt, $DiaChi)
    {
        $sql = "update nguoidung set HoTen='$HoTen', Sdt='$Sdt', DiaChi='$DiaChi' where MaNV='$id'";
        return $this->updatedata($sql);
    }
    public function themnhanvien($MaNV, $HoTen, $Sdt, $DiaChi)
    {
       
        $sql = "insert into nguoidung (MaNV, HoTen, Sdt, DiaChi) VALUES ('$MaNV', '$HoTen', 'Sdt', '$DiaChi')";
        return $this->adddata($sql);
    }
    public function danhsachsanpham($id='')
    {
        if($id)
            $sql="select * from mon where MaMonAn='$id'";
        else
            $sql="select * from mon";
        return $this->getdata($sql);
    }

    public function xoasanpham($id)
    {
        $sql = "delete from mon where MaMonAn='$id'";
        return $this->deletedata($sql);
    }

    public function capnhatsanpham($MaMonAn, $TenMonAn, $GiaGoc)
    {
        $sql = "update mon set MaMonAn='$MaMonAn', TenMonAn='$TenMonAn', GiaGoc='$GiaGoc' where MaMonAn='$id'";
        return $this->updatedata($sql);
    }
    public function themsanpham($MaMonAn, $TenMonAn, $GiaGoc)
    {
       
        $sql = "insert into mon (MaMonAn, TenMonAn, GiaGoc) VALUES ('$MaMonAn', '$TenMonAn', '$GiaGoc')";
        return $this->adddata($sql);
    }
}
?>