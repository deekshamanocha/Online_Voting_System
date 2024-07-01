<?php
// $connect = mysqli_connect("localhost", "root", "", "online_voting_system") or die("connection failed!");

$db = new SQLite3('../db/online_voting_system.db');


// date_default_timezone_set('Asia/Kolkata');

// $currentDatetime = date('Y-m-dTH:i:s');

// $query = "SELECT * FROM meta";
// $result = $db->querySingle($query);

// $election_is_live = false;

// if ($result != false) {
//     if ($currentDatetime < $result) {
//         $election_is_live = true;
//     }
// } else {
//     echo "Error retrieving datetime from database.";
// }

// // echo "<script>var is_election_live = '" . $election_is_live . "';</script>";

// // $election_is_live = $result;