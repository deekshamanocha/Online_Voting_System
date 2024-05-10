<?php

require ("../API/connect.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jersey+25+Charted&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="../CSS/home.css">
    <link rel="stylesheet" href="../CSS/bootstrap.min.css">
    <script src="../CSS/bootstrap.min.js">
    </script>
    <title>Online Voting System</title>

</head>

<body class="d-flex flex-column">

    <div id="headersection">
        <button id="homebtn" onclick="homepage()">Home</button>
        <div id="signin-up">
            <button id="signin" onclick="signin()"> <span>SignIn</span> </button>
            <button id="signup" onclick="signUp()"> <span>Sign-Up</span> </button>
        </div>
    </div>
    <br>
    <div id="livearea">
        <h2 id="live">
            <?php
            if ($election_is_live == true) {
                echo "ELECTION IS LIVE";
            } else {
                echo "ELECTION ENDED";
            }
            ?>
        </h2>
    </div>

    <b><span style="font-size:30px;cursor:pointer;color: black;" onclick="openNav()">&#9776; Candidate List</span></b>

    <div id="myNav" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">

            <div id="bodysection">
                <div class="flip-card" id="coloumn">
                    <div class="flip-card-inner">

                        <div class="flip-card-front">
                            <img src="../images/bjp.jpg" alt="Avatar" id="partyimg">
                        </div>
                        <div class="flip-card-back">
                            <h1>Candidate Name</h1>
                            <p style="font-size: large;">Narendra Damodardas Modi</p>
                            <img src="../images/narendra modi ji.jpg" alt="" id="candidateimg">
                        </div>
                    </div>
                </div>

                <div class="flip-card" id="coloumn">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="../images/congress.jpg" alt="Avatar" id="partyimg">
                        </div>
                        <div class="flip-card-back">
                            <h1>Candidate Name</h1>
                            <p style="font-size: large;">Rahul Gandhi</p>
                            <img src="../images/rahul gandhi.jpeg" alt="" id="candidateimg">
                        </div>
                    </div>
                </div>

                <div class="flip-card" id="coloumn">
                    <div class="flip-card-inner">
                        <div class="flip-card-front">
                            <img src="../images/aap.jpeg" alt="Avatar" id="partyimg">
                        </div>
                        <div class="flip-card-back">
                            <h1>Candidate Name</h1>
                            <p style="font-size: large;">Arvind Kejriwal</p>
                            <img src="../images/Arvind kejriwal.jpg" alt="" id="candidateimg">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="page-content">
    </div>
    <footer id="sticky-footer" class="flex-shrink-0  text-dark-50">
        <div class="container text-center">
            <small>Copyright &copy; All Rights Reserved</small>
        </div>
    </footer>


    <script>
        function homepage() {
            window.location = "Routes/home.php"
        }

        function signin() {
            document.cookie = "<?php echo session_name(); ?>=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            window.location.replace("../Login.html");
        }

        function signUp() {
            window.location = "./registeration.html";
            // alert("button clicked");
        }

        function openNav() {
            document.getElementById("myNav").style.height = "100%";
        }

        function closeNav() {
            document.getElementById("myNav").style.height = "0%";
        }
    </script>
</body>

</html>