<?php
session_start();

require ("../API/connect.php");
require("../admin/check_election.php");

if (empty($_SESSION) || !isset($_SESSION['usersdata'])) {
    header("Location: .././Routes/login.php", TRUE, 301);
    exit();
}

$groups = $db->query("SELECT * FROM candidate WHERE role=2  and verified=1");
$groupdata = [];
$maxVotes = -1;
$winner = null;
$winnerName = "";

while ($row = $groups->fetchArray(SQLITE3_ASSOC)) {
    $groupdata[] = $row;
    if ($row['votes'] > $maxVotes) {
        $maxVotes = $row['votes'];
        $winner = $row;
        $winnerName = $row['name'];
    } elseif ($row['votes'] == $maxVotes) {
        $winner = null;  // Handle tie case
        $winnerName = "Election Tie";
    }
}

$_SESSION['groupdata'] = $groupdata;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/dashboard.css">
    <title>Voting Results</title>
    <style>
        body {
            background-color: #000;
            color: black;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 50px;
        }

        .result-box {
            width: 80%;
            margin: 0 auto;
            background-color: #222;
            border: 2px solid #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .candidate {
            margin-bottom: 20px;
        }

        .winner {
            margin-top: 40px;
            font-size: 24px;
        }

        .special-election {
            margin-top: 20px;
            font-size: 18px;
            color: #ff0000;
        }
    </style>
</head>

<body>
    <div id="headersection">
        <div id="bck-logout">
            <button id="back" onclick="backbutton()">Back</button>
            <div class="rt-nav">
                <button id="prof" onclick="profbutton()">Profile</button>
                <button id="home" onclick="homebutton()">Home</button>
                <button id="dashboard" onclick="dashbutton()">Dashboard</button>
                <button id="logout" onclick="logout()">Logout</button>
            </div>
        </div>

        <h1>
            <marquee behavior="" direction="">
                <?php echo $election_is_live ? "Election is Live Now" : "Election has ended. Results Declared"; ?>
            </marquee>
        </h1>
        <script>
            function backbutton() {
                window.history.back();
            }
            function dashbutton() {
                window.location = "./dashboard.php"
            }
            function homebutton() {
                window.location = "../Routes/home.php";
            }
            function profbutton() {
                window.location = "./Profile.php";
            }
            function logout() {
                document.cookie = "<?php echo session_name(); ?>=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                window.location.href = "../Routes/login.php";
            }
        </script>
    </div>
    <div style="color: black; background-image: url(../images/img2.jpg); border: solid whitesmoke;" class="result-box">
        <h1>Voting Results</h1>

        <?php foreach ($groupdata as $result): ?>
            <div class="candidate">
                <h2><?php echo htmlspecialchars($result['name']); ?></h2>
                <p>Votes: <span class="mvotes"><?php echo $result['votes']; ?></span></p>
            </div>
            <br>
        <?php endforeach; ?>

        <div style="border: solid rgb(255, 246, 246); background-color: rgb(255, 243, 5); color: #000; font-weight: 900;" class="winner">
            <p>Winner: <span id="winner_name"><?php echo $winnerName; ?></span></p>
        </div>

        <div class="special-election" id="special_election"></div>
    </div>
</body>
</html>
