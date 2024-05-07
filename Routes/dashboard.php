<?php
session_start();

if (empty($_SESSION) || !isset($_SESSION['usersdata'])) {
    header("Location: ../Login.html", TRUE, 301);
    exit();
}

$usersdata = $_SESSION['usersdata'];
$groupdata = $_SESSION['groupdata'];

if ($_SESSION['usersdata']['status'] == 0) {
    $status = 'Not voted';
} else {
    $status = 'Voted successfully';
}

?>

<html>

<head>
    <title>Online voting system - Dashboard</title>
    <link rel="stylesheet" href="../CSS/app.css">
    <link rel="stylesheet" href="../CSS/dashboard.css">
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
            }

            function homebutton() {
                window.location = "../home.html";
            }

            function profbutton() {
                window.location = "./Profile.php";
            }

            function logout() {
                document.cookie = "<?php echo session_name(); ?>=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.history.back();
            }
            </script>

        </div>
        <hr>
        <div id="user-profile">

        </div>

        <div id="group">
            <?php
            if ($_SESSION['groupdata']) {
                for ($i = 0; $i < count($groupdata); $i++) {
                    ?>
            <div>
                <img src="../uploads/<?php echo $groupdata[$i]['photo'] ?>" id="pimage">
                <p id="pname">Party Name: <?php echo $groupdata[$i]['name'] ?> </p>
                <p id="nvotes">Number of Votes: <?php echo $groupdata[$i]['votes'] ?> </p>
                <form action="../API/vote.php" method="post">
                    <p id="votestatus">Status: <?php echo $status ?> </p>
                    <input type="hidden" name="pvote" value="<?php echo $groupdata[$i]['votes'] ?>">
                    <input type="hidden" name="pid" value="<?php echo $groupdata[$i]['id'] ?>">
                    <input type="submit" name="votebutton" value="VOTE" id="votebutton"
                        <?php if ($_SESSION['usersdata']['status'] == 1) {echo 'disabled';} ?>> <br><br><br>
                </form>
            </div>
            <?php
                }
            } else {
                echo '
                        <script>
                            alert("Error occured! hello geu");
                            window.location = "../Login.html";
                        </script>
                
                    ';
            }
            ?>

        </div>
    </div>

    <script>
    window.localStorage.setItem("attempts", 0);
    </script>

</body>

</html>