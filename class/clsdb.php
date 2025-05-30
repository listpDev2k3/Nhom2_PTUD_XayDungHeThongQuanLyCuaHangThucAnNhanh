<?php
class database
{
    private function connect()
    {
        $conn = new mysqli("localhost", "fastfood", "123", "demo");
        if ($conn->connect_errno) {
            echo "ket noi KHONG thong cong";
            exit();
        } else
            return $conn;
    }
    public function getConnection()
    {
        return $this->connect();
    }
    public function getdata($sql) {
        $conn = $this->getConnection();
        $result = $conn->query($sql);
    
        if ($result === false) {
            // Kiểm tra nếu truy vấn bị lỗi và thông báo lỗi
            echo "Lỗi truy vấn: " . $conn->error;
            return false;
        }
    
        return $result;
    }
    public function deletedata($sql)
    {
        $link = $this->connect();
        if ($link->query($sql)) {
            return 1;
        } else {
            
            return 0;
        }
    }
    public function adddata($sql){
        $link=$this->connect();
        if($link->query($sql))
            return 1;
        else
            return 0;
    }
    public function updatedata($sql){
        $link=$this->connect();
        if($link->query($sql))
            return 1;
        else
            return 0;
    }
    public function checkLogin($username, $password)
    {
        $conn = $this->connect();


        $query = "SELECT MaNV, HoTen, ViTri, Sdt, Email, DiaChi, ChucVu FROM nguoidung WHERE MaNV = ? AND password = ?";


        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        // Bind kết quả vào các biến
        $stmt->bind_result($MaNV, $HoTen, $ViTri, $Sdt, $Email, $DiaChi, $ChucVu);

        // Lấy kết quả trả về
        if ($stmt->fetch()) {

            $user = array(
                'MaNV' => $MaNV,
                'HoTen' => $HoTen,
                'ViTri' => $ViTri,
                'Sdt' => $Sdt,
                'Email' => $Email,
                'ChucVu' => $ChucVu,
                'DiaChi' => $DiaChi
            );
            return $user;
        } else {
            return false;
        }
    }

    public function getAllShifts()
    {
        $conn = $this->connect(); // Assuming you are using mysqli for this connection
        $query = "SELECT * FROM lichlamviec";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        $shifts = [];
        $result = $stmt->get_result(); // Use get_result() for retrieving the result set

        // Loop through the results
        while ($row = $result->fetch_assoc()) {
            $shifts[] = $row;
        }

        return $shifts;
    }

    public function getShiftsForDay($day, $month, $year)
    {
        $conn = $this->connect();

        // Prepare the query to fetch shifts for the specific day
        $query = "SELECT * FROM lichlamviec WHERE DAY(NgayLamViec) = ? AND MONTH(NgayLamViec) = ? AND YEAR(NgayLamViec) = ?";

        // Prepare statement
        if ($stmt = $conn->prepare($query)) {
            // Bind the parameters to the query
            $stmt->bind_param("iii", $day, $month, $year); // 'iii' for 3 integers

            // Execute the query
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Fetch all rows and return as an associative array
            $shifts = $result->fetch_all(MYSQLI_ASSOC);

            // Close the statement and connection
            $stmt->close();
            $conn->close();

            return $shifts;
        } else {
            // If statement preparation fails
            return [];
        }
    }
    public function getUserByCCCD($cccd)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("SELECT * FROM nguoidung WHERE cccd = ?");
        $stmt->bind_param("s", $cccd);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return the user details
    }

    public function getSalaryDetails($employeeId)
    {
        $conn = $this->connect();

        $stmt = $conn->prepare("SELECT * FROM bangluong WHERE MaNV = ?");
        $stmt->bind_param("s", $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); // Return the salary details
    }

    public function getTotalWorkingHours($employeeId)
    {
        $conn = $this->connect();
        $stmt = $conn->prepare("SELECT SUM(TIMESTAMPDIFF(HOUR, GioBatDau, GioKetThuc)) AS TotalHours FROM bangchamcong WHERE MaNV = ?");
        $stmt->bind_param("s", $employeeId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['TotalHours']; // Return total hours worked
    }


    public function registerForShift($shiftId)
{
    session_start();

    // Check if user is logged in
    if (!isset($_SESSION['MaNV'])) {
        return json_encode(["success" => false, "message" => "Chưa đăng nhập."]);
    }

    $userId = $_SESSION['MaNV'];

    $conn = $this->connect();

    // Start transaction
    $conn->begin_transaction();

    try {
        // Prepare the update query
        $updateQuery = "UPDATE lichlamviec SET TrangThai = 'Đã duyệt', MaNV = '" . $userId ."' WHERE MaLLV = " . $shiftId;


        $stmt = $conn->prepare($updateQuery);

        // Check if statement is prepared correctly
        if (!$stmt) {
            return json_encode(["success" => false, "message" => "Lỗi chuẩn bị câu lệnh SQL."]);
        }

        // Execute the query
        $stmt->execute();

        // Check if there's an error with the execution
        if ($stmt->error) {
            return json_encode(["success" => false, "message" => "Lỗi khi thực thi câu lệnh."]);
        }

        // Log the affected rows
        $affectedRows = $stmt->affected_rows;

        // Check if the update was successful
        if ($affectedRows > 0) {
            $conn->commit();
            return json_encode([
                "success" => true,
                "message" => "Đăng ký ca làm việc thành công",
                "affectedRows" => $affectedRows
            ]);
        } else {
            $conn->rollback();
            return json_encode([
                "success" => false,
                "message" => "Ca làm việc đã có người",
                "affectedRows" => $affectedRows
            ]);
        }
    } catch (Exception $e) {
        // Rollback the transaction if there's an exception
        $conn->rollback();
        return json_encode(["success" => false, "message" => "Lỗi: " . $e->getMessage()]);
    } finally {
        // Clean up
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
}

}
