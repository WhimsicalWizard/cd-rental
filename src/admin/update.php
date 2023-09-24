<?php
include_once("dbcon.php");

if (isset($_POST["submit"])) {
    $movieId = $_POST['movie_id'];
    $name = $_POST['name'];
    $released = $_POST['year'];
    $available = $_POST['available'];
    $genre = $_POST['genre'];

    $sql = "UPDATE movie SET movie_name = '$name', released = '$released', total_disk = '$available', genre = '$genre' WHERE movie_id = $movieId";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Update failed: " . mysqli_error($con));
    }

    echo "Data updated successfully.";
}
