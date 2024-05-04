<?php
session_start();

if (empty($_SESSION) || !isset($_SESSION['usersdata'])) {
    header("Location: ../Login.html", TRUE, 301);
    exit();
}

$usersdata = $_SESSION['usersdata'];
$groupdata = $_SESSION['groupdata'];

if ($_SESSION['usersdata']['status']==0) {
    $status = 'Not voted';
}
else {
    $status = 'Voted successfully';
}

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
                    window.history.back();
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
                    document.cookie = "<?php echo session_name(); ?>=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    window.history.back();
                    // window.location.replace("../Login.html");
                }
            </script>
        </div>
        <hr>
        <div id="user-profile">

        </div>

        <div id="group">
            <?php
                if ($_SESSION['groupdata']) {
                    for ($i=0; $i< count($groupdata); $i++) { 
                        ?>
                            <div>
                                <img src="../uploads/<?php echo $groupdata[$i]['photo'] ?> " height="100" width="100" style="float: left;" ><br>
                                <b>Party Name:</b> <?php echo $groupdata[$i]['name'] ?> <br>
                                <b>Number of Votes: </b> <?php echo $groupdata[$i]['votes'] ?> <br>
                                <form action="../API/vote.php" method="post" >
                                <b>Status: </b> <?php echo $status ?> 
                                    <input type="hidden" name="pvote" value="<?php echo $groupdata[$i]['votes'] ?>"><br>
                                    <input type="hidden" name="pid" value="<?php echo $groupdata[$i]['id']?>"><br>
                                    <input type="submit" name="votebutton" value="VOTE" id="votebutton">
                                </form> 
                            </div>
                        <?php
                    }
                }
                else {
                    echo '
                        <script>
                            alert("Error occured!");
                            window.location = "../Login.html";
                        </script>
                
                    ';
                }
            ?>
              
        </div>
    </div>

</body>

</html>