<?php
session_start();
require("../admin/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON payload
    $data = json_decode(file_get_contents("php://input"), true);
    $username = $data['username'];
    // $role = $data['role'];
    $otp = $data['otp'];

    // Validate OTP
    // if($role==1){

    //     $sql = $db->querySingle("SELECT otp FROM userdata WHERE mobile = '$username' AND otp = '$otp'");
    // }
    // else{
        $sql = $db->querySingle("SELECT otp FROM candidate WHERE mobile = '$username' AND otp = '$otp'");

    // }
    
    if ($sql) {
        echo json_encode(['success' => true, 'message' => 'OTP validated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid OTP']);
    }
}
?>
