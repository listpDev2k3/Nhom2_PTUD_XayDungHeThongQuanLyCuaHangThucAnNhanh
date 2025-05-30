<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


require_once "../../class/clsdb.php";
$db = new database();

$month = date('m');
$year = date('Y');

$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

$allShifts = $db->getAllShifts();

$shiftsForSelectedDay = [];
if (isset($_GET['day'])) {
    $selectedDay = $_GET['day'];
    $shiftsForSelectedDay = $db->getShiftsForDay($selectedDay, $month, $year);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký ca làm việc</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-top: 20px;
        }

        .calendar-day {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            position: relative;
            height: 100px;
            cursor: pointer;
        }

        .calendar-day span {
            display: block;
            font-weight: bold;
        }

        .shift-box {
            position: absolute;
            bottom: 10px;
            width: 100%;
            background-color: #f0f0f0;
            padding: 3px;
            font-size: 12px;
            text-align: center;
        }

        .shift-box.available {
            background-color: #c8e6c9;
        }

        .shift-box.booked {
            background-color: #ffcdd2;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <header class="d-flex justify-content-between">
            <h1>Đăng ký ca làm việc</h1>
            <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger">Đăng xuất</button>
            </form>
        </header>

        <div class="row mt-4">
            <!-- Left Column: Calendar Display -->
            <div class="col-md-12">
                <h3>Lịch làm việc tháng <?php echo $month; ?>, <?php echo $year; ?></h3>
                <div class="calendar">
                    <?php
                    // Generate calendar days
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                        echo "<div class='calendar-day' data-bs-toggle='modal' data-bs-target='#shiftModal' data-day='{$day}'>";
                        echo "<span>{$day}</span>";

                        // Check if any shifts exist for this day
                        $shiftForDay = array_filter($shiftsForSelectedDay, function ($shift) use ($day) {
                            return date('d', strtotime($shift['NgayLamViec'])) == $day;
                        });

                        foreach ($shiftForDay as $shift) {
                            // Check the shift status (e.g., 'Available', 'Booked')
                            $shiftStatus = $shift['TrangThai'];
                            echo "<div class='shift-box {$shiftStatus}'>";
                            echo "{$shift['CaLamViec']}";
                            echo "</div>";
                        }

                        echo "</div>"; // Close calendar day div
                    }
                    ?>
                </div>
            </div>
        </div>

        <!-- Modal for Shifts -->
        <div class="modal fade" id="shiftModal" tabindex="-1" aria-labelledby="shiftModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="shiftModalLabel">Ca làm việc</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Ca làm việc cho ngày <span id="selectedDay"></span> - <?php echo $month; ?>-<?php echo $year; ?></h3>
                        <table class="table" id="shiftTable">
                            <thead>
                                <tr>
                                    <th>Ca làm việc</th>
                                    <th>Trạng thái</th>
                                    <th>Nhân viên</th>
                                    <th>Đăng ký</th>
                                </tr>
                            </thead>
                            <tbody id="shiftTableBody">
                                <!-- Shifts will be dynamically added here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Event listener for calendar day click
            const calendarDays = document.querySelectorAll('.calendar-day');
            calendarDays.forEach(day => {
                day.addEventListener('click', function() {
                    const dayNumber = this.getAttribute('data-day');
                    // Update modal title
                    document.getElementById('selectedDay').innerText = dayNumber;

                    // Fetch shifts for this day using AJAX
                    fetchShiftsForDay(dayNumber);
                });
            });

            // Function to fetch shifts for a given day
            function fetchShiftsForDay(day) {
                const xhr = new XMLHttpRequest();
                xhr.open('GET', 'fetch_shifts.php?day=' + day, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        const shifts = JSON.parse(xhr.responseText);
                        displayShiftsInModal(shifts);
                    } else {
                        console.error("Failed to fetch shifts");
                    }
                };
                xhr.send();
            }

            // Function to display shifts in the modal
            function displayShiftsInModal(shifts) {
                const tableBody = document.getElementById('shiftTableBody');
                tableBody.innerHTML = ''; // Clear any previous rows

                if (shifts.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="4">Không có ca làm việc cho ngày này.</td></tr>';
                } else {
                    shifts.forEach(shift => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${shift.CaLamViec}</td>
                    <td>${shift.TrangThai}</td>
                    <td>${shift.MaNV || 'Chưa có nhân viên'}</td>
                    <td>
                        ${shift.TrangThai === 'Available' ? `<button class="btn btn-primary btn-sm register-btn" data-shift-id="${shift.MaLLV}">Đăng ký</button>` : ''}
                    </td>
                `;
                        tableBody.appendChild(row);
                    });

                    // Add event listeners for all register buttons
                    const registerBtns = document.querySelectorAll('.register-btn');
                    registerBtns.forEach(btn => {
                        btn.addEventListener('click', function() {
                            const shiftId = this.getAttribute('data-shift-id');
                            registerForShift(shiftId); // Pass the shift ID to the register function
                        });
                    });
                }
            }

            function registerForShift(shiftId) {
                const xhr = new XMLHttpRequest();
                xhr.open('POST', 'register_shift.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log("Response from server:", xhr.responseText);

                        try {
                            const response = JSON.parse(xhr.responseText);
                            console.log("Parsed response:", response);

                            if (response.status === 'success') {
                                alert(response.message);
                            } else {
                                alert(response.message);
                            }
                        } catch (error) {
                            console.error("Failed to parse response as JSON:", error);
                        }
                    } else {
                        console.error("Failed to register shift, status code:", xhr.status);
                    }
                };


                xhr.send('shiftId=' + shiftId);
            }


        });
    </script>
</body>

</html>