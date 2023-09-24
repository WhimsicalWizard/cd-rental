<?php
include_once("dbcon.php");

if (isset($_GET['id'])) {
    $movieId = $_GET['id'];

    $sql = "SELECT * FROM movie WHERE movie_id = $movieId";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error: " . mysqli_error($con));
    }

    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: select_movie.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Movie</title>
</head>

<body>
    <h1>Edit Movie</h1>
    <form action="update.php" method="post">
        <input type="hidden" name="movie_id" value="<?php echo $row['movie_id']; ?>">
        <label>Movie Name</label>
        <input type="text" name="name" value="<?php echo $row['movie_name']; ?>" required><br>
        <label>Released Year</label>
        <input type="text" name="year" value="<?php echo $row['released']; ?>" required><br>
        <label>Available</label>
        <input type="text" name="available" value="<?php echo $row['total_disk']; ?>" required><br>
        <label>Genre</label>
        <input type="text" name="genre" value="<?php echo $row['genre']; ?>" required><br>
        <input type="submit" value="Update" name="submit">
    </form>
</body>

</html>