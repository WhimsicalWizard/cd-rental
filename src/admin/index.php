<?php
include_once("dbcon.php");
if (isset($_POST["submit"])) {
    $file = $_FILES["image"]["tmp_name"];
    $name = $_POST['name'];
    $released =  $_POST['year'];
    $available = $_POST['available'];
    $genre = $_POST['genre'];

    //gets the file extention and saves image with the movie name in the server 
    $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    echo $file_ext;
    $filename = $name . '.' . $file_ext;
    $img_dir = "image/";
    $destination = "D:/Applications/xammm/htdocs/movient/images/" . $filename;
    move_uploaded_file($file, $destination);

    //storing in database 
    $sql = "INSERT INTO movie (movie_name, img_name, img_dir, released, total_disk, genre) values ('$name', '$filename', '$img_dir', '$released', '$available', '$genre')";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        die("Insertion failed: " . mysqli_error($con));
    }
    echo "Data added successfully.";
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="index.php" method="post" enctype="multipart/form-data">
        <label>Movie Name</label>
        <input type="text" name="name" value="" required> <br>
        <label>Upload Image</label>
        <input type="file" name="image" value="" required><br>
        <label>Released Year</label>
        <input type="text" name="year" value="" required><br>
        <label>Available</label>
        <input type="text" name="available" value="" required>
        <br>
        <label>genre</label>
        <input type="text" name="genre" value="" required>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>


</body>

</html>