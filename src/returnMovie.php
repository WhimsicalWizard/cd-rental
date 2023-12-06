<?php
session_start();
include_once("admin/dbcon.php");

if (isset($_SESSION["user_id"]) && isset($_GET['rental_id'])) {
    $rental_id = $_GET['rental_id'];
    $returnDate = date("Y-m-d");

    $rentalQuery = mysqli_query($con, "SELECT * FROM rent WHERE r_id = '$rental_id'");
    $rentalData = mysqli_fetch_assoc($rentalQuery);
    $return_status = $rentalData['return_status'];

    $id = $rentalData['movie_id'];

    $movieQuery = mysqli_query($con, "SELECT total_disk FROM movie WHERE movie_id = '$id'");
    $movieData = mysqli_fetch_assoc($movieQuery);
    $total_disk = $movieData['total_disk'];




    // Check if the movie has already been returned
    if ($return_status == 0) {
        $_SESSION['error'] = "This movie has already been returned.";
    } else {
        $total_disk++;
        $disk =  mysqli_query($con, "UPDATE movie SET total_disk= '$total_disk' WHERE movie_id = '$id'");

        $sql = "UPDATE rent SET return_date = ?, return_status = 0 WHERE r_id = ?";
        $stmt = mysqli_prepare($con, $sql);

        mysqli_stmt_bind_param($stmt, "ss", $returnDate, $rental_id);
        $result = mysqli_stmt_execute($stmt);

        if ($result) {
            $_SESSION['message'] = "Movie successfully returned.";
        } else {
            $_SESSION['error'] = "Failed to update the rental record: " . mysqli_error($con);
        }
    }
} else {
    $_SESSION['error'] = "Invalid request. Please try again.";
}

header('Location: rent.php');
exit;
