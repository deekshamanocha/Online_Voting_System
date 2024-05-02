<?php
$connect = mysqli_connect("localhost", "root", "", "online voting system") or die("connection failed!");

if ($connect) {
    echo "connected!";
} else {
    echo "Not connected!";
}

?>