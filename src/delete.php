<?php
session_start();
include_once("admin/dbcon.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}

$userId = $_SESSION['user_id'];
$rent =  mysqli_query($con, "DELETE FROM rent WHERE rented_by= $userId");

$result = mysqli_query($con, "DELETE FROM members WHERE m_id=$userId");

if (!$result) {
    die("Failed to delete: " . mysqli_error($con));
} else {
    echo "<script>alert('Data deleted successfully');</script>";
    echo "<script>window.location.href = 'logout.php';</script>";
    
}
session_destroy();
?>