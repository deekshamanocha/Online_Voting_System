<?php
session_start();
require ("connect.php");
require("check_election.php");


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

$groups = $db->query("SELECT * FROM userdata WHERE role=2");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Results</title>
    <link rel="stylesheet" href="./css/view_results.css">
</head>
<body>
    <div id="container">
        <h2>Election Results</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Candidate Name</th>
                <th>Votes</th>
            </tr>
            <?php while ($row = $groups->fetchArray(SQLITE3_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['votes']; ?></td>
                </tr>
            <?php } ?>
        </table>
        <a href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
