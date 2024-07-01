<?php
session_start();
require ("connect.php");
require("check_election.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $admin = $db->querySingle("SELECT * FROM admins WHERE username='$username'", true);

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin_dashboard.php");
    } else {
        echo '
            <script>
                alert("Invalid username or password!");
                window.location = "admin_login.php";
            </script>
        ';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="./css/admin_login.css">
</head>
<body>
    <div id="bodysection">
        <h2>Admin Login</h2>
        <form onsubmit="handleOTP()" method="post">
            <fieldset id="mform">
            <input type="text" name="phone" placeholder="Username" required><br>
            <input hidden type="number" name="otp" placeholder="Password" required><br>
            <button type="submit">Login</button>

            </fieldset>
            
        </form>
    </div>
    <script>
        fuction requestOTP(){
            phone = '32';
            const p = await fetch('request_otp.php')
            p.success == true{
                // remove removeAttr
            } else{

            }
        }
        function validateOTP(){
            phone = '32';
            otp = '4434';
            const p = await fetch('validate_otp.php');
            if(p.success) location.href = "dashboard.php";
            else // alert otp validate failed;
        }
        function handleOTP(e){
            e.preventDefault();
            // if number wali hidden => requestOTP();
            // else validateOTP();
        }

        </script>
</body>
</html>
