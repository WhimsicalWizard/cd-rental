<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: info.php");
    exit();
}
include_once("admin/dbcon.php");
$result = mysqli_query($con, "select * from movie");
if (!$result) die("Database fetch failed: " . mysqli_error($con));
?>
<?php include("header.html"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movient</title>
    <link rel="stylesheet" type="text/css" href="body.css">
    <style>
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
    </style>



</head>

<body>

    <div class="container">
        <table width='70%' border="0">
            <tr>
                <td>S.N</td>
                <td>Movie Name</td>
                <td>Total Copies</td>
                <td>Genre</td>
                <td>Released year</td>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($result)) {
                $count = 1;

            ?>
                <div class="details">
                    <!-- <h3><?php echo $row['movie_name'] ?></h3> -->
                    <?php
                    echo "<tr>";

                    echo "<td>" . $count . "</td>";

                    echo "<td>" . $row['movie_name'] . "</td>";

                    echo "<td>" . $row['total_disk'] . "</td>";
                    echo "<td>" . $row['genre'] . "</td>";
                    echo "<td>" . $row['released'] . "</td>";
                    $count++;
                    echo "</tr>"

                    ?>
                </div>


            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>