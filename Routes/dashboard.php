<?php
    session_start();
    if(!isset($_SESSION['usersdata'])) {
        header("location : ../Login.html");
    }

    $usersdata = $_SESSION['usersdata'];
?>

<html>

<head>
    <title>Online voting system - Dashboard</title>
    <link rel="stylesheet" href="../CSS/dashboard.css">
</head>

<body>
    <div id="mainsection">
        <div id="headersection">
            <div id="bck-logout">
                <button id="back" onclick="backbutton()"> <span> Back </span></button>
                <button id="logout" type="submit"> <span>Logout</span> </button>
            </div>

            <h1>
                <marquee behavior="" direction=" ">Online Voting System</marquee>
            </h1>
            <script>
            function backbutton() {
                window.location = "../Login.html"
                // alert("button clicked");
            }
            </script>
        </div>
        <hr>
        <div id="user-profile">

        </div>

        <div id="group">

        </div>


    </div>

</body>

</html>