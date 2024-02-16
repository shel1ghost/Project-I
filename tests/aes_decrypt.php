<?php

$sBox = [
    0x63, 0x7c, 0x77, 0x7b, 0xf2, 0x6b, 0x6f, 0xc5, 0x30, 0x01, 0x67, 0x2b, 0xfe, 0xd7, 0xab, 0x76,
    0xca, 0x82, 0xc9, 0x7d, 0xfa, 0x59, 0x47, 0xf0, 0xad, 0xd4, 0xa2, 0xaf, 0x9c, 0xa4, 0x72, 0xc0,
    0xb7, 0xfd, 0x93, 0x26, 0x36, 0x3f, 0xf7, 0xcc, 0x34, 0xa5, 0xe5, 0xf1, 0x71, 0xd8, 0x31, 0x15,
    0x04, 0xc7, 0x23, 0xc3, 0x18, 0x96, 0x05, 0x9a, 0x07, 0x12, 0x80, 0xe2, 0xeb, 0x27, 0xb2, 0x75,
    0x09, 0x83, 0x2c, 0x1a, 0x1b, 0x6e, 0x5a, 0xa0, 0x52, 0x3b, 0xd6, 0xb3, 0x29, 0xe3, 0x2f, 0x84,
    0x53, 0xd1, 0x00, 0xed, 0x20, 0xfc, 0xb1, 0x5b, 0x6a, 0xcb, 0xbe, 0x39, 0x4a, 0x4c, 0x58, 0xcf,
    0xd0, 0xef, 0xaa, 0xfb, 0x43, 0x4d, 0x33, 0x85, 0x45, 0xf9, 0x02, 0x7f, 0x50, 0x3c, 0x9f, 0xa8,
    0x51, 0xa3, 0x40, 0x8f, 0x92, 0x9d, 0x38, 0xf5, 0xbc, 0xb6, 0xda, 0x21, 0x10, 0xff, 0xf3, 0xd2,
    0xcd, 0x0c, 0x13, 0xec, 0x5f, 0x97, 0x44, 0x17, 0xc4, 0xa7, 0x7e, 0x3d, 0x64, 0x5d, 0x19, 0x73,
    0x60, 0x81, 0x4f, 0xdc, 0x22, 0x2a, 0x90, 0x88, 0x46, 0xee, 0xb8, 0x14, 0xde, 0x5e, 0x0b, 0xdb,
    0xe0, 0x32, 0x3a, 0x0a, 0x49, 0x06, 0x24, 0x5c, 0xc2, 0xd3, 0xac, 0x62, 0x91, 0x95, 0xe4, 0x79,
    0xe7, 0xc8, 0x37, 0x6d, 0x8d, 0xd5, 0x4e, 0xa9, 0x6c, 0x56, 0xf4, 0xea, 0x65, 0x7a, 0xae, 0x08,
    0xba, 0x78, 0x25, 0x2e, 0x1c, 0xa6, 0xb4, 0xc6, 0xe8, 0xdd, 0x74, 0x1f, 0x4b, 0xbd, 0x8b, 0x8a,
    0x70, 0x3e, 0xb5, 0x66, 0x48, 0x03, 0xf6, 0x0e, 0x61, 0x35, 0x57, 0xb9, 0x86, 0xc1, 0x1d, 0x9e,
    0xe1, 0xf8, 0x98, 0x11, 0x69, 0xd9, 0x8e, 0x94, 0x9b, 0x1e, 0x87, 0xe9, 0xce, 0x55, 0x28, 0xdf,
    0x8c, 0xa1, 0x89, 0x0d, 0xbf, 0xe6, 0x42, 0x68, 0x41, 0x99, 0x2d, 0x0f, 0xb0, 0x54, 0xbb, 0x16
];


function keyExpansion(array $key, $sBox, $roundConstants) {
    $roundKeys = [];
    $roundKeys[] = $key;

    // Generate round keys
    for ($i = 1; $i < 11; $i++) {
        $prevRoundKey = $roundKeys[$i - 1];

        // Rotate previous round key
        $temp = [$prevRoundKey[1][3], $prevRoundKey[2][3], $prevRoundKey[3][3], $prevRoundKey[0][3]];
        
        // Substitute bytes
        for ($j = 0; $j < 4; $j++) {
            $temp[$j] = $sBox[hexdec($temp[$j])];
        }

        // XOR with round constant
        $temp[0] = sprintf('%02X', hexdec($temp[0]) ^ hexdec($roundConstants[$i - 1]));
        
        // XOR with previous word
        for ($j = 0; $j < 4; $j++) {
            $temp[$j] = sprintf('%02X', hexdec($temp[$j]) ^ hexdec($prevRoundKey[$j][0]));
        }

        // Generate next round key
        $roundKeys[] = [
            [$temp[0], $prevRoundKey[0][1], $prevRoundKey[0][2], $prevRoundKey[0][3]],
            [$temp[1], $prevRoundKey[1][1], $prevRoundKey[1][2], $prevRoundKey[1][3]],
            [$temp[2], $prevRoundKey[2][1], $prevRoundKey[2][2], $prevRoundKey[2][3]],
            [$temp[3], $prevRoundKey[3][1], $prevRoundKey[3][2], $prevRoundKey[3][3]]
        ];
    }

    // Reverse the order of round keys for decryption
    return array_reverse($roundKeys);
}


function addRoundKey(array $state, array $roundKey) {
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $state[$i][$j] = sprintf('%02X', hexdec($state[$i][$j]) ^ hexdec($roundKey[$i][$j]));
        }
    }
    return $state;
}


function invSubBytes(array $state, $invSBox) {
    // Inverse SubBytes operation: substitute each byte of state with the corresponding byte from the inverse S-box
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $state[$i][$j] = sprintf('%02X', $invSBox[hexdec($state[$i][$j])]);
        }
    }

    return $state;
}

function invShiftRows(array $state) {
    // Inverse ShiftRows operation: shift each row of state cyclically to the right by its row index
    for ($i = 1; $i < 4; $i++) {
        $state[$i] = array_merge(array_slice($state[$i], 4 - $i), array_slice($state[$i], 0, 4 - $i));
    }

    return $state;
}

function invMixColumns(array $state) {
    // Inverse MixColumns operation
    $mul9 = function ($value) {
        return ($value << 3) ^ ($value << 1);
    };

    $mul11 = function ($value) {
        return ($value << 3) ^ ($value << 1) ^ $value;
    };

    $mul13 = function ($value) {
        return ($value << 3) ^ ($value << 2) ^ $value;
    };

    $mul14 = function ($value) {
        return ($value << 3) ^ ($value << 2) ^ ($value << 1);
    };

    $result = [];
    for ($i = 0; $i < 4; $i++) {
        $result[] = [
            sprintf('%02X', $mul14(hexdec($state[0][$i])) ^ $mul11(hexdec($state[1][$i])) ^ $mul13(hexdec($state[2][$i])) ^ $mul9(hexdec($state[3][$i]))),
            sprintf('%02X', $mul9(hexdec($state[0][$i])) ^ $mul14(hexdec($state[1][$i])) ^ $mul11(hexdec($state[2][$i])) ^ $mul13(hexdec($state[3][$i]))),
            sprintf('%02X', $mul13(hexdec($state[0][$i])) ^ $mul9(hexdec($state[1][$i])) ^ $mul14(hexdec($state[2][$i])) ^ $mul11(hexdec($state[3][$i]))),
            sprintf('%02X', $mul11(hexdec($state[0][$i])) ^ $mul13(hexdec($state[1][$i])) ^ $mul9(hexdec($state[2][$i])) ^ $mul14(hexdec($state[3][$i])))
        ];
    }

    return $result;
}

function convertStringTo2DArray($string) {
    $array = [];
    $length = strlen($string);
    for ($i = 0; $i < $length; $i += 8) {
        $array[] = str_split(substr($string, $i, 8), 2);
    }
    return $array;
}

function decryptAES(string $ciphertext, string $key, $sBox, $roundConstants) {
    // Convert ciphertext and key strings to 4x4 arrays
    $ciphertextArray = convertStringTo2DArray($ciphertext);
    $keyArray = convertStringTo2DArray($key);

    // Call the AES decryption function with the array inputs
    return decryptAESFromArray($ciphertextArray, $keyArray, $sBox, $roundConstants);
}

function decryptAESFromArray(array $ciphertext, array $key, $sBox, $roundConstants) {
    $invSBox = array_flip($sBox); // Generate inverse S-box

    // AES decryption process
    // Key expansion
    $roundKeys = keyExpansion($key, $sBox, $roundConstants);

    // Initial round
    $state = $ciphertext;
    $roundKey = convertStringTo2DArray($roundKeys[count($roundKeys) - 1]);
    $state = addRoundKey($state, $roundKey);

    // Main rounds (in reverse order)
    for ($round = count($roundKeys) - 2; $round >= 1; $round--) {
        // Inverse ShiftRows
        $state = invShiftRows($state);
        // Inverse SubBytes
        $state = invSubBytes($state, $invSBox);
        // AddRoundKey
        $roundKey = convertStringTo2DArray($roundKeys[$round]);
        $state = addRoundKey($state, $roundKey);
        // Inverse MixColumns
        $state = invMixColumns($state);
    }

    // Final round (no MixColumns)
    // Inverse ShiftRows
    $state = invShiftRows($state);
    // Inverse SubBytes
    $state = invSubBytes($state, $invSBox);
    // AddRoundKey
    $roundKey = convertStringTo2DArray($roundKeys[0]);
    $state = addRoundKey($state, $roundKey);

    return $state;
}

// Example usage:
$ciphertext = "69C4E0D86A7B0430D8CDB78070B4C55A";
$key = "000102030405060708090a0b0c0d0e0f";

$plaintext = decryptAES($ciphertext, $key, $sBox, $roundConstants);
foreach ($plaintext as $row) {
    echo implode(' ', $row) . "\n";
}
?>