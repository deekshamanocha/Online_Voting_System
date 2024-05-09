<?php
session_start();

require ("connect.php");

$mobile = $_POST['mobile'];
$password = $_POST['password'];
$role = $_POST['role'];

if (!$db) {
    echo '
                <script>
                    alert("Could not Login");
                </script>
            ';
}

$check = $db->query("SELECT * FROM userdata WHERE mobile = '$mobile' AND password = '$password' AND role = '$role'");

if ($check->fetchArray(SQLITE3_ASSOC)) {
    $usersdata = $db->querySingle("SELECT * FROM userdata WHERE mobile = '$mobile'", true);
    $groups = $db->query("SELECT * FROM userdata WHERE role=2 ");
    $groupdata = [];
    while ($row = $groups->fetchArray(SQLITE3_ASSOC)) {
        $groupdata[] = $row;
    }

    $_SESSION['usersdata'] = $usersdata;
    $_SESSION['groupdata'] = $groupdata;

    if ($role == 1 || $role == 2) {
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