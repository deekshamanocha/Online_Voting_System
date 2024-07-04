<?php
session_start();
require("../admin/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the JSON payload
    $data = json_decode(file_get_contents("php://input"), true);
    // print_r($data);
    $username = $data['username'];

    // Fetch OTP from external link
    $otpUrl = "https://evote.binbard.org/request_otp?phone=" . $username;
    // urlencode($username);
    $response = file_get_contents($otpUrl);
    $otpData = json_decode($response, true);

    if ($otpData && isset($otpData['otp'])) {
        $otp = $otpData['otp'];

        // Store the OTP in the database (assuming you have a column for OTP)
        $sql = $db->exec("UPDATE candidate SET otp='$otp' WHERE mobile='$username'");

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
