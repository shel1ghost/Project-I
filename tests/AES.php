<?php
$sbox = [
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

$round_constants = [
    0x01, 0x02, 0x04, 0x08, 0x10, 0x20, 0x40, 0x80, 0x1B, 0x36
];


function key_expansion($key, $sbox, $round_constants) {
    $w = [];

    // Initialize the first four words of the key schedule to the input key
    for ($i = 0; $i < 4; $i++) {
        $w[$i] = array_slice($key, $i * 4, 4);
    }

    // Generate the subsequent words of the key schedule
    for ($i = 4; $i < 44; $i++) {
        $temp = $w[$i - 1];

        // Perform key schedule core for every fourth word
        if ($i % 4 === 0) {
            // Rotate word
            $temp = [$temp[1], $temp[2], $temp[3], $temp[0]];

            // Substitute bytes using S-box
            for ($j = 0; $j < 4; $j++) {
                $temp[$j] = $sbox[$temp[$j]];
            }

            // XOR with round constant
            $temp[0] ^= $round_constants[$i / 4 - 1];
        }

        // XOR with word 4 positions earlier
        for ($j = 0; $j < 4; $j++) {
            $w[$i][$j] = $w[$i - 4][$j] ^ $temp[$j];
        }
    }

    return $w;
}

function plaintextToMatrix($plaintext) {
    // Convert the plaintext to ASCII representation
    $plaintextBytes = str_split($plaintext);

    // Pad the plaintext if its length is less than 16 bytes
    $plaintextBytes = array_pad($plaintextBytes, 16, ' ');

    // Convert each character to its hexadecimal representation
    $hexValues = array_map(function ($char) {
        // Get the ASCII value of the character and convert it to its hexadecimal representation
        $hexValue = strtoupper(str_pad(dechex(ord($char)), 2, '0', STR_PAD_LEFT));
        // Convert the hexadecimal representation to decimal
        return hexdec($hexValue);
    }, $plaintextBytes);

    // Chunk the hexadecimal values into 4x4 matrix
    $matrix = array_chunk($hexValues, 4);

    return $matrix;
}


function keyStringToMatrix($keyString) {
    // Convert the key string to uppercase to ensure consistency
    $keyString = strtoupper($keyString);
    
    // Remove any non-hexadecimal characters
    $keyString = preg_replace('/[^A-F0-9]/', '', $keyString);
    
    // Ensure the key has exactly 32 characters (16 bytes)
    if (strlen($keyString) !== 32) {
        throw new InvalidArgumentException("Invalid key length. The key must be 32 hexadecimal characters long.");
    }
    
    // Initialize an empty array to store the flattened key
    $keyArray = [];
    
    // Convert the key string into a single-dimensional array
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            // Convert each pair of characters into a byte represented as hexadecimal
            $byteHex = substr($keyString, $i * 8 + $j * 2, 2);
            $keyArray[] = hexdec($byteHex); // Convert hexadecimal to decimal
        }
    }
    
    return $keyArray;
}

/*function addRoundKey(&$state, $w, $round) {
    for ($i = 0; $i < 4; $i++) {
        for ($j = 0; $j < 4; $j++) {
            $state[$j][$i] ^= $w[$round * 4 + $i][$j];
        }
    }
}*/
function multiDimensionalArraySlice($array, $offset, $length = null) {
    if ($length === null) {
        $length = count($array) - $offset;
    }

    $result = array();
    foreach ($array as $element) {
        if (is_array($element)) {
            $result[] = multiDimensionalArraySlice($element, $offset, $length);
        } else {
            $result[] = $element;
        }
    }
    return array_slice($result, $offset, $length);
}

function addRoundKey($state, $roundKey) {
    /**
     * Add Round Key operation for AES encryption.
     *
     * Parameters:
     * $state (array): The state array (4x4) represented as a 2D array.
     * $roundKey (array): The round key (4x4) represented as a 2D array.
     *
     * Returns:
     * array: The resulting state array after adding round key.
     */
    $result = array();
    foreach ($state as $s) {
        $temp = array();
        for ($i = 0; $i < 4; $i++) {
            for ($j = 0; $j < 4; $j++) {
                // XOR each byte of the state with the corresponding byte of the round key
                $temp[$i][$j] = $s[$i][$j] ^ $roundKey[$i][$j];
            }
        }
        $result[] = $temp;
    }
    return $result;
}



//Main AES Encryption function

function aes_encrypt($plaintext, $key){
    global $sbox, $round_constants;
    $array_key = keyStringToMatrix($key);
    $array_plaintext = plaintextToMatrix($plaintext);
    $w = key_expansion($array_key, $sbox, $round_constants);
    $state = [];
    // Initialize state
    for ($i = 0; $i < 4; $i++) {
        $state[$i] = array_slice($array_plaintext, $i * 4, 4);
    }
    $slicedArray = multiDimensionalArraySlice($state, 1, 2);
    $initial_round_key = array_slice($w, 0, 4);
    addRoundKey($slicedArray, $initial_round_key);
    return $state;
}



$plaintext = "00112233445566778899aabbccddeeff";
$key = "8b1a9953c4611296a827abf8c47804d7";


// $key = [
//     0x8B, 0x1A, 0x99, 0x53,
//     0xC4, 0x61, 0x12, 0x96,
//     0xA8, 0x27, 0xAB, 0xF8,
//     0xC4, 0x78, 0x04, 0xD7
// ];

//$array_key = keyStringToMatrix($key);
//$array_plaintext = plaintextToMatrix($plaintext);
//$key_exp = key_expansion($array_key, $sbox, $round_constants);

$res = aes_encrypt($plaintext, $key);

print_r($res);
//print_r($key_exp);



?>
