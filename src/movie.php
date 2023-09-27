<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}
include_once("header.html");
include_once("admin/dbcon.php");

$id = $_GET["id"];
$result = mysqli_query($con, "select * from movie where movie_id = $id");
if (!$result) {
    die("Error: " . mysqli_error($con));
}

$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Details</title>
    <link rel="stylesheet" type="text/css" href="style.css">

    <style>
        .details {
            width: 50%;
            height: 50%;
            margin-left: auto;
            margin-right: auto;
            align-content: center;

        }

        img {
            width: 50%;
            height: 50%;
        }

        .link-red {
            color: red;
        }



        .link-red:hover {
            color: blue;
        }
    </style>
</head>

<body>
    <h2>Movie Details</h2>
    <div class="details">
        <img src="admin/image/<?php echo $row['img_name']; ?>" alt="Movie Image">
        <p>Movie Name: <?php echo $row['movie_name']; ?></p>
        <p>Total Copies: <?php echo $row['total_disk']; ?></p>
        <p>Genre: <?php echo $row['genre']; ?></p>
        <p>Released Year: <?php echo $row['released']; ?></p>
        <?php
        echo "<p><a href=\"rentOng.php?id=$row[movie_id]\" onClick=\"return confirm('Are you sure you want to rent?')\" class=\"link-red\">Rent</a></p>";
        ?>


    </div>
</body>

</html>