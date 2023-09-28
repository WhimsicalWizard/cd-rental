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
    <link rel="stylesheet" type="text/css" href="body.css">

    <style>
        .details {
            width: 50%;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background-color: #012324;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgb(0, 3, 3);
        }


        img {
            max-width: 100%;
            max-height: 500px;
            width: auto;
            height: auto;
            margin: 0 auto;
            display: block;
        }


        p {
            font-size: 18px;
            margin: 10px 0;
        }

        .link-red {
            color: red;
            text-decoration: none;
        }

        .link-red:hover {
            color: blue;
        }
    </style>
</head>

<body>
    <div class="details">

        <img src="admin/image/<?php echo $row['img_name']; ?>" alt="Movie Image">
        <p>Movie Name: <?php echo $row['movie_name']; ?></p>
        <p>Total Copies: <?php echo $row['total_disk']; ?></p>
        <p>Genre: <?php echo $row['genre']; ?></p>
        <p>Released Year: <?php echo $row['released']; ?></p>
        <?php
        echo "<p><a href=rentOng.php?id=$row[movie_id] onClick=return confirm('Are you sure you want to rent?') class=link-red>Rent</a></p>";
        ?>


    </div>
</body>

</html>