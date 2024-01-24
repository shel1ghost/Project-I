<?php

// Encryption function
function encryptAES($data, $key, $iv) {
    $cipher = "aes-256-cbc";
    $options = 0;

    $encrypted = openssl_encrypt($data, $cipher, $key, $options, $iv);
    return base64_encode($encrypted);
}

// Decryption function
function decryptAES($data, $key, $iv) {
    $cipher = "aes-256-cbc";
    $options = 0;

    $decrypted = openssl_decrypt(base64_decode($data), $cipher, $key, $options, $iv);
    return $decrypted;
}

// Example usage
$plaintext = "Hello, this is a secret message!";
$key = "85a40a46ccd7a1212d6c5732094d0ed365ec310df848c76bb1b7eccaa58e52ef"; // 32-byte key for AES-256
$iv = openssl_random_pseudo_bytes(16); // Initialization Vector (IV) should be random

$encryptedText = encryptAES($plaintext, $key, $iv);

echo "Encrypted Text: " . $encryptedText . "\n";

$decryptedText = decryptAES($encryptedText, $key, $iv);

echo "Decrypted Text: " . $decryptedText . "\n";

?>

