<?php

// Encryption function
function encryptAES($data, $key) {
    $cipher = "aes-128-cbc";
    $options = 0;

    $encrypted = openssl_encrypt($data, $cipher, $key);
    return $encrypted;
}

// Decryption function
function decryptAES($data, $key) {
    $cipher = "aes-128-cbc";
    $options = 0;

    $decrypted = openssl_decrypt(($data), $cipher, $key);
    return $decrypted;
}

// Example usage
$plaintext = "qwerty@#$12345600!";
$key = "8b1a9953c4611296a827abf8c47804d7"; // 32-byte key for AES-256
//$iv = openssl_random_pseudo_bytes(16); // Initialization Vector (IV) should be random

$encryptedText = encryptAES($plaintext, $key);
//$enc_again = encryptAES($plaintext, $key);

echo "\nEncrypted Text: " . $encryptedText . "\n";
//echo $enc_again."\n";

$decryptedText = decryptAES($encryptedText, $key);

echo "Decrypted Text: " . $decryptedText . "\n";

?>

