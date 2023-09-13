<?php
session_start();
include_once('admin/dbcon.php');

// Check for and display success message
if (isset($_SESSION['message'])) {
    echo "<script>alert('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); // Clear the message to avoid displaying it again on refresh
}

// Check for and display error message
if (isset($_SESSION['error'])) {
    echo "<script>alert('" . $_SESSION['error'] . "');</script>";
    unset($_SESSION['error']); // Clear the error to avoid displaying it again on refresh
}


if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}

$nameQuery = mysqli_query($con, "SELECT memberName FROM members WHERE m_id = '" . $_SESSION['user_id'] . "'");
$nameRow = mysqli_fetch_assoc($nameQuery);
$name = $nameRow['memberName'];

// Modify the query to fetch data from the "movies" table
$result = mysqli_query($con, "SELECT * FROM rent r JOIN movie m ON r.movie_id= m.movie_id   WHERE r.rented_by = '" . $_SESSION['user_id'] . "'order by r_id asc");
include_once('header.html');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent</title>

    <link rel="stylesheet" href="body.css">
    <link rel="stylesheet" href=".css">
    <style>
        .sort {
            width: 30%;
            align-content: center;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
        }

        .name {
            width: 30%;
            text-align: center;
            margin-top: 10px;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
        }

        table {
            height: auto;

            padding-left: 30px;
            padding-right: 30px;
            align-content: center;
            margin-left: auto;
            margin-right: auto;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #040f25;
            width: 80%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #efefef;
        }

        th,
        td {
            padding: 8px;
        }

        /* Style for the table header */
        th {
            background-color: #aaf0fa;
        }

        input {
            border-radius: 5px;
        }

        a.return-link {
            color: #ff5f50;
            font-weight: bold;
            text-decoration: none;
        }

        a.return-link:hover {
            color: green;
        }

        .name a {
            color: #82aef5;
        }

        .name a:hover {
            color: #2222ff;
        }


        select {
            border-radius: 5px;
            background-color: #ffffff;
        }
    </style>

    </style>
</head>


<body>
    <div class="name">
        <?php echo "Welcome " . $name . "</br>";
        ?>
        <a href="index.php">Rent Movie</a>
    </div>


    <!-- <div class="sort">
        <label for="search">Search Movie</label>
        <input type="text" id="movie_search" name="movie_search">
        <label for="sortby">Sort by</label>
        <select id="sortby" name="sortby">
            <option value="default">None</option>
            <option value="release">Year</option>
            <option value="genre">Genre</option>
            <option value="return">Return Status</option>
        </select>
    </div> -->




    <div id="table-container">
        <table width='70%' border="0">
            <tr>
                <td>S.N</td>
                <td>Movie Name</td>
                <td>Rented At</td>
                <td>Return By</td>
                <td>Return Status</td> <!-- column for showing the return status -->
                <td>Genre</td>
                <td>Released year</td>
                <td>Action</td> <!-- New column for the "Return" link -->
            </tr>
    </div>


    <div class="container">


        <?php
        $count = 1;

        while ($mov = mysqli_fetch_array($result)) {
            $movie = mysqli_query($con, "Select * from movie where movie_id= '" . $mov['movie_id'] . "'");
            $row = mysqli_fetch_assoc($movie);


           
            echo "<tr>";
            echo "<td>" . $mov['r_id'] . "</td>";
            echo "<td>" . $row['movie_name'] . "</td>";
            echo "<td>" . $mov['r_date'] . "</td>";
            echo "<td>" . $mov['return_date'] . "</td>";
            echo "<td>";
            if ($mov['return_status'] == 1) {
                echo "Returned";
            } else {
                echo "Not Returned";
            }
            echo "</td>";
            echo "<td>" . $row['genre'] . "</td>";
            echo "<td>" . $row['released'] . "</td>";
            echo "<td>";
            if ($mov['return_status'] == 0) {
                echo "<a class='return-link' href='returnMovie.php?rental_id=" . $mov['r_id'] . "'>Return</a></td>";
            } else {
                echo "N/A";
            }
            echo "</td>";
            $count++;
            echo "</tr>";
        }

        ?>
        </table>
    </div>

</body>

</html>