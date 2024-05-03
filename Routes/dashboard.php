<?php
session_start();
if (empty($_SESSION) || !isset($_SESSION['usersdata'])) {
    header("Location: ../Login.html");
    exit();
}

$usersdata = $_SESSION['usersdata'];
?>

<html>

<head>
    <title>Online voting system - Dashboard</title>
    <link rel="stylesheet" href="../CSS/app.css">
</head>

<body>
    <div id="mainsection">
        <div id="headersection">
            <div id="bck-logout">
                <button id="back" onclick="backbutton()"> <span> Back </span></button>
                <div class="rt-nav">
                    <button id="prof" onclick="profbutton()"> <span> Profile </span></button>
                    <button id="logout" onclick="logout()"> <span>Logout</span> </button>
                    <button id="home" onclick="homebutton()"> <span>Home</span> </button>

                </div>

            </div>

            <h1>
                <marquee behavior="" direction=" ">Online Voting System</marquee>
            </h1>
            <script>
                function backbutton() {
                    window.location = "../Login.html";
                    // alert("button clicked");
                }

                function homebutton() {
                    window.location = "../main.html";
                    // alert("button clicked");
                }

                function profbutton() {
                    window.location = "./Profile.php";
                    // alert("button clicked");
                }

                function logout() {
                    window.location = "../API/logout.php"
                }
            </script>
        </div>
        <hr>
        <div id="user-profile">

        </div>

        <div id="group">

        </div>

        <?php if (!isset($_SESSION['usersdata'])) {
            echo "Current session ID: " . session_id() . " ";
            print_r($_SESSION);
        } ?>


    </div>

</body>

</html>