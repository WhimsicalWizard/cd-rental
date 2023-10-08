<?php
include_once("dbcon.php");
include_once("header.html");
session_start();

if (isset($_POST["submit"])) {
    $file = $_FILES["image"]["tmp_name"];
    $name = $_POST['name'];
    $released =  $_POST['year'];
    $available = $_POST['available'];
    $genre = $_POST['genre'];

    $file_ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

    $filename = $name . '.' . $file_ext;
    $img_dir = "image/";
    $destination = "image/" . $filename;
    move_uploaded_file($file, $destination);

    $sql = "INSERT INTO movie (movie_name, img_name,  released, total_disk, genre) values ('$name', '$filename',  '$released', '$available', '$genre')";

    $result = mysqli_query($con, $sql);
    if (!$result) {
        $_SESSION['message'] = "Update failed: " . mysqli_error($con);
    }
    $_SESSION['message'] = "update successfull";
    header('Location: index.php');
    exit;
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: #020223;
            color: #fff;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }


        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #666;
            box-shadow: 0 2px 4px rgb(f, f, f);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 98%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Add Movie</h1>

    <form action="add.php" method="post" enctype="multipart/form-data">
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