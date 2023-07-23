<?php
include_once('admin/dbcon.php');


session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}

$result = mysqli_query($con, "SELECT * FROM members WHERE m_id=" . $_SESSION['user_id']);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="body.css">
    <style>
        a {
            color: blue;
        }

        a:hover {
            color: #00ff 99;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php include("header.html"); ?>

</body>
<div>

    <a href="logout.php">Log Out</a>
</div>

</html>