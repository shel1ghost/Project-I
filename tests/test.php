<?php
function inverseMixColumns($state) {
    // Inverse mix column matrix for AES decryption
    $inverseMixMatrix = [
        14, 11, 13, 9,
        9, 14, 11, 13,
        13, 9, 14, 11,
        11, 13, 9, 14
    ];

    // Perform matrix multiplication with the inverse mix column matrix
    $result = array();
    for ($col = 0; $col < 4; $col++) {
        for ($row = 0; $row < 4; $row++) {
            $sum = 0;
            for ($i = 0; $i < 4; $i++) {
                $sum ^= galoisMultiplication($state[$row * 4 + $i], $inverseMixMatrix[$i * 4 + $col]);
            }
            $result[$row * 4 + $col] = $sum;
        }
    }

    return $result;
}

// Helper function for Galois Multiplication
function galoisMultiplication($a, $b) {
    $p = 0;
    while ($b) {
        if ($b & 1) {
            $p ^= $a;
        }
        if ($a & 0x80) {
            $a = ($a << 1) ^ 0x1b; // AES polynomial: x^8 + x^4 + x^3 + x + 1
        } else {
            $a <<= 1;
        }
        $b >>= 1;
    }
    return $p;
}

// Example usage:
$state = [
    215, 4, 120, 221,
    248, 171, 222, 168,
    31, 18, 97, 196,
    83, 92, 26, 139
];

$result = inverseMixColumns($state);
print_r($result);

?>