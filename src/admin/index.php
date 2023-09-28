<?php
include_once("dbcon.php");
include_once("header.html");
session_start();

$sql = "SELECT * FROM movie";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error: " . mysqli_error($con));
}


if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Movie to Edit</title>
    <style>
        body {
            background-color: #020223;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .real {
            padding: 20px;
            border-radius: 5px;
            text-align: center;
            background-color: #020227;
            box-shadow: 0 0 50px rgba(100, 100, 100, 1);
            width: 50%;
            margin: 10px auto;

        }

        .view {
            border: none;
            margin: 10px auto;
            text-align: center;

            padding: 10px;
        }

        .view a {
            display: block;
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .view a:hover {
            color: #00aa0f;
        }
    </style>
</head>

<body>
    <div class="real">
        <h1>Select Movie to Edit</h1>
        <div class="view">

            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <a href="edit.php?id=<?php echo $row['movie_id']; ?>"><?php echo $row['movie_name']; ?></a>
            <?php endwhile; ?>

        </div>
    </div>

</body>

</html>