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
$attempt_statement = $db->prepare("SELECT failed_attempts FROM userdata WHERE mobile = :mobile AND role = :role");
$attempt_statement->bindValue(':mobile', $mobile);
$attempt_statement->bindValue(':role', $role);
$attempt_result = $attempt_statement->execute();

$attempt_row = $attempt_result->fetchArray(SQLITE3_ASSOC);

if ($attempt_row && $attempt_row['failed_attempts'] >= 3) {
    echo '
        <script>
            alert("Your account is locked due to multiple failed login attempts. Please contact support.");
            window.location = "../Routes/login.php";
        </script>
    ';
    exit; // Stop further execution
}
$statement = $db->prepare("SELECT * FROM userdata WHERE mobile = :mobile AND role = :role");
$statement->bindValue(':mobile', $mobile);
$statement->bindValue(':role', $role);
$result = $statement->execute();

$row = $result->fetchArray(SQLITE3_ASSOC);

if ($row) {
    // Verify password
    if (password_verify($password, $row['password'])) {
        $reset_statement = $db->query("UPDATE userdata SET failed_attempts = 0 WHERE mobile = :mobile AND role = :role");
        $usersdata = $row;
        $groups = $db->query("SELECT * FROM userdata WHERE role = 2 ");
        $groupdata = [];
        while ($row = $groups->fetchArray(SQLITE3_ASSOC)) {
            $groupdata[] = $row;
        }

        $_SESSION['usersdata'] = $usersdata;
        $_SESSION['groupdata'] = $groupdata;

        if ($role == 1 || $role == 2) {
            // $_SESSION['login_banned'] = 'true';
            echo '
                <script>
                    window.location.replace("../Routes/dashboard.php");
                </script>
            ';
            exit; // Stop further execution
        }
    } else {
        $increment_statement = $db->prepare("UPDATE userdata SET failed_attempts = failed_attempts + 1 WHERE mobile = :mobile AND role = :role");
        $increment_statement->bindValue(':mobile', $mobile);
        $increment_statement->bindValue(':role', $role);
        $increment_statement->execute();
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