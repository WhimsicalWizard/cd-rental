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
        .container a {
            color: #007bff;
            text-decoration: none;
            margin-right: 20px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }



        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        #logging:hover {

            color: #fa7b00;
        }

        /* Style the save button */
        #submitform {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }

        #submitform:hover {
            background-color: #0056b3;
        }

        #usernameCheck {
            color: #ff0000;
            font-weight: bold;
            margin-top: 10px;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <?php include("header.html"); ?>


    <div class="container">
        <a href="logout.php" id="logging">Log Out</a>

        <form>

            <?php
            echo $row["memberName"]
            ?>

            <?php
            echo $row["memberlast_name"]
            ?>
            <label>Username</label>

            <input type="text" id="username" name="username" value="<?php
                                                                    echo $row["username"]
                                                                    ?>">
            <br>
            <p id="usernameCheck"></p>
            <input class='btn' type="button" id="submitform" value="Update" />

        </form>

    </div>
    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#submitform").on('click', function() {
                var username = $("#username").val();
                var failmsg = "";
                if (username === "") failmsg += "No Username was entered.\n";
                else if (username.length < 5) failmsg += "Username must be at least 5 characters.\n";
                else if (/[^a-zA-Z0-9_-]/.test(username)) failmsg += "Only a-z, A-Z, 0-9, - and _ allowed in Username.\n";
                console.log(failmsg);
                if (failmsg == "") {
                    $.ajax({
                        method: "POST",
                        url: "update.php",
                        data: {
                            "username": username
                        },
                        success: function(response) {
                            if (response == "exists") {
                                $("#usernameCheck").text("Username already exists");
                            }
                            if (response == "available") {
                                $("#usernameCheck").text("Username updated successfully");
                            }
                        }
                    });
                } else {

                    $("#usernameCheck").text(failmsg);
                }

            })
        })
    </script>




</body>

</html>