<?php
session_start();
include_once("admin/dbcon.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}


$userId =$_SESSION['user_id'];


$checkQuery = mysqli_query($con, "SELECT * FROM rent WHERE return_status = '1' AND rented_by = '$userId'");
$check = mysqli_fetch_assoc($checkQuery);

if ($check) {
   // cannot delete 
    $_SESSION["error_deleting"]= "Failed to delete user account, You havent returned movie";

     header("Location: profile.php");
    exit();
} else {
    // Allow deletion
    $deleteRentQuery = mysqli_query($con, "DELETE FROM rent WHERE rented_by = $userId");
    $deleteMembersQuery = mysqli_query($con, "DELETE FROM members WHERE m_id = $userId");

    if (!$deleteRentQuery || !$deleteMembersQuery) {
        // Deletion failed
        die("Failed to delete: " . mysqli_error($con));
    } else {
       
        echo "<script>alert('Data deleted successfully');</script>";
        echo "<script>window.location.href = 'logout.php';</script>";

    }
}
?>
