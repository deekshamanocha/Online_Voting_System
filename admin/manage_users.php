<?php
session_start();
require ("connect.php");
require("check_election.php");


if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user_id'])) {
    $voter_id = $_POST['delete_user_id'];
    $db->exec("DELETE FROM userdata WHERE id='$voter_id'");
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_user_id'])) {
    $candidate_id = $_POST['delete_user_id'];
    $db->exec("DELETE FROM candidate WHERE id='$candidate_id'");
}

$voters = $db->query("SELECT * FROM userdata");
$candidates = $db->query("SELECT * FROM candidate");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link rel="stylesheet" href="./css/manage_users.css">
</head>
<body>
    <div id="container">
    <div id="voter">
        <h2>Manage Voters</h2>
        <table>
        <caption> Voters Details</caption>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th colspan="2">Address</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $voters->fetchArray(SQLITE3_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['gender'] ; ?></td>
                    <td colspan="2" ><?php echo $row['address'] ; ?></td>
                    <td>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="delete_user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div id="candidate">
        <h2>Manage Candidate</h2>
        <table>
        <caption> Candidates Details</caption>

            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th colspan="2">Address</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $candidates->fetchArray(SQLITE3_ASSOC)) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['gender'] ; ?></td>
                    <td colspan="2" ><?php echo $row['address'] ; ?></td>
                    <td>
                        <form action="manage_users.php" method="post" style="display:inline;">
                            <input type="hidden" name="delete_user_id" value="<?php echo $row['id']; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <!-- <a href="admin_dashboard.php">Back to Dashboard</a> -->
    </div>
    <!-- <a href="admin_dashboard.php">Back to Dashboard</a> -->

    </div>
</body>
</html>
