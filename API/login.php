<?php
session_start();
require ("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!$connect) {
    echo '
                <script>
                    alert("Could not Login");
                </script>
            ';
}

$check = mysqli_query($connect, "SELECT * FROM userdata WHERE mobile = '$mobile' AND password = '$password' AND role = '$role'");

if (mysqli_num_rows($check) > 0) {
    $usersdata = mysqli_fetch_array($check);
    $groups = mysqli_query($connect, "SELECT * FROM userdata WHERE role=2 ");
    $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['usersdata'] = $usersdata;
    $_SESSION['groupdata'] = $groupdata;

    if ($role == 1) {
        echo '
                <script>
                    window.location.replace("../Routes/dashboard.php");
                </script>
            ';
    } else if ($role == 2) {
        echo '
                <script>
                    window.location.replace("../Routes/dashboard.php");
                </script>
                
            ';
    }


} else {
    echo '
        <script>
            alert("User not found or Wrong details!");
            window.location = "../Login.html";
        </script>        
        ';
}
?>