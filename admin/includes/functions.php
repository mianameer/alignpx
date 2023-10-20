<?php 
function generateUniqueOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';
    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[random_int(0, strlen($characters) - 1)];
    }
    return $otp;
}

// // Example usage:
// $otp = generateUniqueOTP();
// echo "Generated OTP: $otp";


?>