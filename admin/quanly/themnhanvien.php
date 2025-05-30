<?php
include("../../class/clsmng.php");
$obj = new quanly();
include("xulythem.php");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm nhân viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* CSS để căn giữa form và tạo bảng cố định */
        .container {
            width: 50%;
            margin: 0 auto;
            padding-top: 50px;
        }

        .form-table {
            width: 100%;
            margin-top: 20px;
        }

        .form-table th, .form-table td {
            padding: 10px;
            text-align: left;
        }

        .form-table th {
            background-color: #f8f9fa;
        }

        .form-table td {
            background-color: #e9ecef;
        }

        .form-container {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .btn {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="container">
    <h3 class="text-center">THÊM NHÂN VIÊN</h3>
    <form method="post" enctype="multipart/form-data">
        <div class="form-container">
            <table class="form-table">
                <tr>
                    <th><label for="MaNV">Mã nhân viên</label></th>
                    <td><input type="text" name="MaNV" class="form-control" required></td>
                </tr>
                <tr>
                    <th><label for="HoTen">Họ tên</label></th>
                    <td><input type="text" name="HoTen" class="form-control" required></td>
                </tr>
                <tr>
                    <th><label for="Sdt">Số điện thoại</label></th>
                    <td><input type="number" name="Sdt" class="form-control" required></td>
                </tr>
                <tr>
                    <th><label for="DiaChi">Địa chỉ</label></th>
                    <td><input type="text" name="DiaChi" class="form-control" required></td>
                </tr>
            </table>

            <div class="text-center mt-4">
                <button type="submit" name="btThem" class="btn btn-dark rounded-5 px-5 py-2">THÊM</button>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>