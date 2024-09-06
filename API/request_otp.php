<?php
session_start();
require("../admin/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    
    $username = $data['username'];
    $role = $data['role'];

    // Fetch OTP from external link
    $otpUrl = "https://evote.binbard.org/request_otp?phone=" . $username;
    $response = file_get_contents($otpUrl);
    $otpData = json_decode($response, true);

    if ($otpData && isset($otpData['otp'])) {
        $otp = $otpData['otp'];

        $table = ($role == 1) ? 'userdata' : 'candidate';
        $sql = $db->exec("UPDATE $table SET otp='$otp' WHERE mobile='$username'");

        if ($sql) {
            echo json_encode(['success' => true, 'message' => 'OTP sent successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to store OTP in database']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to fetch OTP from external service']);
    }
}
?>
