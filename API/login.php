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

$statement = $db->prepare("SELECT * FROM userdata WHERE mobile = :mobile AND role = :role");
$statement->bindValue(':mobile', $mobile);
$statement->bindValue(':role', $role);
$result = $statement->execute();

$row = $result->fetchArray(SQLITE3_ASSOC);

if ($row) {
    // Verify password
    if (password_verify($password, $row['password'])) {
        $usersdata = $row;
        $groups = $db->query("SELECT * FROM userdata WHERE role = 2 ");
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
            exit; // Stop further execution
        }
    } else {
        echo '
            <script>
                alert("Wrong password!");
                window.location = "../Routes/login.php";
            </script>        
            ';
        exit; // Stop further execution
    }
} else {
    echo '
        <script>
            alert("User not found or Wrong details!");
            window.location = "../Routes/login.php";
        </script>        
        ';
    exit; // Stop further execution
}