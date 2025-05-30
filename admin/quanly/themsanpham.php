<?php
include("../../class/clsmng.php");
$obj = new quanly();
include("xulithem.php");
?>
<div class="container">
    <h3 class="text-center">THÊM MÓN ĂN</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="mb-3">
                    <label for="tensp" class="form-label">Mã món ăn</label>
                    <input type="text" name="MaMonAn" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="mota" class="form-label">Tên món ăn</label>
                    <input type="text" name="TenMonAn" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="gia" class="form-label">Giá gốc</label>
                    <input type="number" name="GiaGoc" class="form-control" required>
                </div>
               
               
                <div class="text-center">
                    <button type="submit" name="btThem"  class="btn btn-dark rounded-5 px-5 py-2">THÊM</button>
                </div>
            </div>
        </div>
    </form>
</div>
