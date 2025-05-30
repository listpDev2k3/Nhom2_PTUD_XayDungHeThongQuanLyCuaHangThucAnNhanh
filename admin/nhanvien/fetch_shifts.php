<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once "../../class/clsdb.php";

if (isset($_GET['day'])) {
    $day = $_GET['day'];
    $month = date('m'); 
    $year = date('Y');  

    $db = new database();

    $shifts = $db->getShiftsForDay($day, $month, $year);

    echo json_encode($shifts);
} else {
    echo json_encode([]);
}
?>
