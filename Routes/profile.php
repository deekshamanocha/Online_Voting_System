<?php
session_start();

$usersdata = $_SESSION['usersdata'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/userprofile.css">
    <title>User Profile</title>
</head>

<body>
    <div class="profile">
        <div class="prof-img">
            <img src="../uploads/<?php echo $usersdata['photo'] ?>" id="user-img">
        </div>
        <div class="prof-details">

            <br>
            <b>Name: </b><br>
            <b>Mobile Number: </b><br>
            <b>Address: </b><br>
            <b>Status: </b><br>
        </div>
    </div>

</body>

</html>