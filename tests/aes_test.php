<?php

// Encryption function
function encryptAES($data, $key, $iv) {
    $cipher = "aes-128-ecb";
    $options = 0;

    $encrypted = openssl_encrypt($data, $cipher, $key, $options, $iv);
    return base64_encode($encrypted);
}

// Decryption function
function decryptAES($data, $key, $iv) {
    $cipher = "aes-128-ecb";
    $options = 0;

    $decrypted = openssl_decrypt(base64_decode($data), $cipher, $key, $options, $iv);
    return $decrypted;
}

// Example usage
$plaintext = "00112233445566778899aabbccddeeff";
$key = "000102030405060708090a0b0c0d0e0f"; // 32-byte key for AES-256
$iv = openssl_random_pseudo_bytes(16); // Initialization Vector (IV) should be random

$encryptedText = encryptAES($plaintext, $key, $iv);

echo "Encrypted Text: " . $encryptedText . "\n";

$decryptedText = decryptAES($encryptedText, $key, $iv);

echo "Decrypted Text: " . $decryptedText . "\n";

?>

