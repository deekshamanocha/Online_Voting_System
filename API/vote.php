<?php
session_start();
include ("connect.php");

$votes = $_POST['pvote'];
$t_votes = $votes + 1;
$partyid = $_POST['pid'];
$user_id = $_SESSION['usersdata']['id'];

$update_vote = mysqli_query($connect, "UPDATE userdata SET votes='$t_votes' WHERE id ='$partyid' ");
$update_status = mysqli_query($connect, "UPDATE userdata SET status=1 WHERE id='$user_id' ");

if ($update_vote and $update_status) {
    $groups = mysqli_query($connect, "SELECT * FROM userdata WHERE role=2 ");
    $groupdata = mysqli_fetch_all($groups, MYSQLI_ASSOC);

    $_SESSION['usersdata']['status'] = 1;
    $_SESSION['groupdata'] = $groupdata;

    echo '
        <script>
            alert("Voting done successfully!");
            window.location = "../Routes/dashboard.php";
        </script>
    ';

} else {
    echo '
        <script>
            alert("Error occured! hello");
            window.location = "../Routes/dashboard.php";
        </script>
    ';
}

?>