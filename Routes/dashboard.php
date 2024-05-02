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
                    <button id="back" onclick="backbutton()"> <span>  Back </span></button>
                    <button id="logout" type="submit" > <span>Logout</span> </button>
                </div>
                
                <h1><marquee behavior=""  direction=" ">Online Voting System</marquee></h1>
                <script>
                    function backbutton() {
                        window.location="../Login.html"
                        // alert("button clicked");
                    }
                </script>
            </div>
            <hr>
            <div id="profile">
                    <img src="../uploads/<?php echo  $usersdata['photo']?>" height="50%" >
                    <br>
                    <b style="text-align: left;">Name: </b><br>
                    <b>Mobile Number: </b><br>
                    <b>Address: </b><br>
                    <b>Status: </b><br>
            </div>

            <div id="group">

            </div>

           
        </div>
        
    </body>
</html>