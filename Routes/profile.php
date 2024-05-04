<?php
session_start();

if (empty($_SESSION) || !isset($_SESSION['usersdata'])) {
    header("Location: ../Login.html");
    exit();
}

$usersdata = $_SESSION['usersdata'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/app.css">
    <link rel="stylesheet" href="../CSS/userprofile.css">
    <title>User Profile</title>
</head>

<body>
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
                window.location = "../Login.html"
                // alert("button clicked");
            }

            function logout() {
                // window.location = "../API/logout.php"
                <?php
                $_SESSION = array();
                session_destroy();
                ?>

            }

            function homebutton() {
                window.location = "../main.html"
                // alert("button clicked");
            }

            function profbutton() {
                window.location = "./Profile.php"
                // alert("button clicked");
            }
        </script>
    </div>
    <div class="profile">
        <div class="prof-img">
            <img src="../uploads/<?php echo $usersdata['photo'] ?>" id="user-img">
        </div>
        <div class="prof-details">

            <table>
                <tr>
                    <th>Name</th>
                    <td><?php echo $usersdata['name'] ?></td>
                </tr>
                <tr>
                    <th>Mobile Number</th>
                    <td><?php echo $usersdata['mobile'] ?></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><?php echo $usersdata['gender'] ?></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td rowspan="2"><?php
                    echo $usersdata['address']
                        ?></td>
                </tr>
                <tr>
                </tr>
                <tr>

                    <th>Role</th>
                    <td><?php
                    if ($usersdata['role'] == 1) {
                        echo "Voter";
                    } else {
                        echo "Candidate";
                    }
                    ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>