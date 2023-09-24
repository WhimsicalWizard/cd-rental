<?php
include_once("dbcon.php");

// Fetch a list of movies from the database
$sql = "SELECT * FROM movie";
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Error: " . mysqli_error($con));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Movie to Edit</title>
</head>

<body>
    <h1>Select Movie to Edit</h1>
    <ul>
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
            <li>
                <a href="edit.php?id=<?php echo $row['movie_id']; ?>"><?php echo $row['movie_name']; ?></a>
            </li>
        <?php endwhile; ?>
    </ul>
</body>

</html>