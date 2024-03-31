<?php

// Encryption function
function encryptAES($data, $key) {
    $cipher = "aes-128-ecb";
    $options = 0;

    $encrypted = openssl_encrypt($data, $cipher, $key);
    return $encrypted;
}

// Decryption function
function decryptAES($data, $key) {
    $cipher = "aes-128-ecb";
    $options = 0;

    $decrypted = openssl_decrypt($data, $cipher, $key);
    return $decrypted;
}

 $plaintext = "00112233445566778899aabbccddeeff";
 $key = "000102030405060708090a0b0c0d0e0f";

// $cipher = encryptAES($plaintext, $key);
// echo $cipher;
// echo "\n";
// $decrypt = decryptAES($cipher, $key);
// echo $decrypt;
?>
