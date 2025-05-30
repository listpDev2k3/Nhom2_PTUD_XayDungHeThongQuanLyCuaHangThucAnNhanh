<?php

require_once "../../class/clsdb.php";
$db = new database();

if (isset($_POST['shiftId'])) {
    $shiftId = $_POST['shiftId'];
    
    $result = $db->registerForShift($shiftId);

    if ($result) {
        echo json_encode(['status' => 'success', 'message' => 'Đăng ký ca làm việc thành công!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Đã có lỗi xảy ra khi đăng ký ca.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Shift ID không hợp lệ.']);
}
?>
