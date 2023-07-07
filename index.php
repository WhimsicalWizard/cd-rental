<?php
include_once("admin/dbcon.php");
$result = mysqli_query($con, "select * from image");

if (!$result) die("Database fetch failed: " . mysqli_error($con));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movient</title>
    <style>
        body {
            background-color: #042425;
        }
    </style>

</head>

<body>
    <?php include("header.html");
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <img src="<?php echo $row['img_dir'] . $row['img_name']; ?>">
    <?php
    }
    ?>
</body>


</html>