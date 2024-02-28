<?php

function encrypt($inputString) {
    // Check if input string length is exactly 32 characters
    if (strlen($inputString) != 32) {
        return "Input string must be exactly 32 characters long.";
    }

    $outputString = '';
    // Loop through every two characters
    for ($i = 0; $i < strlen($inputString); $i += 2) {
        // Append two characters from input string
        $outputString .= substr($inputString, $i, 2);
        // Append a random number between 0 and 9
        $outputString .= rand(0, 9);
    }
    // Encode the resulting string in base64
    $base64EncodedString = base64_encode($outputString);
    return $base64EncodedString;
}

function decrypt($base64EncodedString) {
    // Decode the base64 encoded string
    $decodedString = base64_decode($base64EncodedString);

    $originalString = '';
    // Loop through every two characters
    for ($i = 0; $i < strlen($decodedString); $i += 3) {
        // Append two characters from decoded string
        $originalString .= substr($decodedString, $i, 2);
    }
    return $originalString;
}

?>

