<?php
session_start();
include_once("admin/dbcon.php");

if (isset($_SESSION["user_id"]) && isset($_GET['id'])) {
    $user = $_SESSION["user_id"];
    $id = $_GET['id'];
    $rentDate = date("Y-m-d");
    $returnDate = date("Y-m-d", strtotime("+1 week", strtotime($rentDate)));

    $movieQuery = mysqli_query($con, "SELECT total_disk FROM movie WHERE movie_id = '$id'");
    $movieData = mysqli_fetch_assoc($movieQuery);
    $total_disk = $movieData['total_disk'];

    $checkQuery = mysqli_query($con, "SELECT * FROM rent WHERE movie_id = '$id' AND rented_by = '$user' ORDER BY r_id DESC LIMIT 1");
    $check = mysqli_fetch_assoc($checkQuery);
    $status = $check['return_status'];
    if ($status == 0) {
        $total_disk--;

        $user = mysqli_real_escape_string($con, $user);
        $id = mysqli_real_escape_string($con, $id);



        mysqli_query($con, "UPDATE movie SET total_disk = '$total_disk' WHERE movie_id = '$id'");

        $sql = "INSERT INTO rent (rented_by, movie_id, r_date, return_date, return_status) VALUES ( '$user', '$id', '$rentDate','$returnDate',1)";
       
        
        $result = mysqli_query($con, $sql);

        if ($result) {
            $_SESSION['message'] = "Rent Successful.";
        } else {
            $_SESSION['error'] = "Failed to register: " . mysqli_error($con);
        }
    } else {
        $_SESSION['error'] = "Already Rented";
    }
} else {
    $_SESSION['error'] = "The user or movie ID is missing.";
}

header('Location: rent.php');
exit;
