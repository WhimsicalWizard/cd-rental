<?php
include_once('admin/dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $username = $_POST['username'];
    $city = $_POST['city'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = $_POST['password'];

    $usernameQuery = mysqli_query($con, "SELECT username FROM members WHERE username = '$username'");
    $count = mysqli_num_rows($usernameQuery);

    if ($count > 0) {
        echo "The username already exists.";
    } else {
        $sql = "INSERT INTO members (memberName, memberlast_name, username, city, phone, email, password)
                VALUES ('$firstName', '$lastName', '$username', '$city', '$phone', '$email', '$password')";
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die("Failed to register: " . mysqli_error($con));
        } else {
            echo "Registration Successful. Please login.";
            header('Location: login.php');
            exit;
        }
    }
}

?>