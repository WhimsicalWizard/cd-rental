<?php
include_once('admin/dbcon.php');


session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: info.html");
    exit();
}

$result = mysqli_query($con, "SELECT * FROM members WHERE m_id=" . $_SESSION['user_id']);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" href="body.css">
    <style>
        a {
            color: blue;
        }

        a:hover {
            color: #00ff 99;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php include("header.html"); ?>


    <div id="logout">
        <a href="logout.php">Log Out</a>
    </div>
    <div>
        <form>
            <label>First Name</label>
            <input type="text" value=<?php
                                        echo $row["memberName"]
                                        ?>>
            <br>
            <label>Last Name</label>

            <input type="text" value=<?php
                                        echo $row["memberlast_name"]
                                        ?>>
            <br>
            <label>Username</label>

            <input type="text" id="username" value=<?php
                                                    echo $row["username"]
                                                    ?>>
            <br>
            <p id="usernameCheck"></p>
            <input class='btn' type="button" id="checkusers" value="Save" />
        </form>

    </div>
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        console.log("function")
        $(function() {
            $("#checkusers").on('click', function() {
                var username = $("#username").val();
                console.log("inside function")
                $.ajax({
                    method: "POST",
                    url: "check.php",
                    data: {
                        "username": username
                    },
                    success: function(response) {
                        if (response === "available") {
                            $("#usernameCheck").text("Username Available");
                        } else {
                            $("#usernameCheck").text("Username already exists");
                        }
                    }
                });

            })
        })
    </script>

</body>

</html>