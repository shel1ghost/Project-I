<?php

// Function to multiply the first matrix's columns with the second matrix and store the result in a separate matrix
function multiplyMatrices($firstMatrix, $secondMatrix) {
    // Check if the matrices have the same dimensions
    $rows = 4;
    $columns = 4;

    // Check if the matrices have the same number of elements
    if (count($firstMatrix) != $rows * $columns || count($secondMatrix) != $rows * $columns) {
        return false; // Matrices must have the same number of elements for multiplication
    }

    // Initialize the result matrix
    $result = array_fill(0, $rows * $columns, 0);

    // Iterate over each column of the first matrix
    for ($col = 0; $col < $columns; $col++) {
        // Iterate over each row of the first matrix
        for ($row = 0; $row < $rows; $row++) {
            $sum = 0;

            // Multiply each element of the current column of the first matrix with the corresponding element of the second matrix
            for ($i = 0; $i < $rows; $i++) {
                $sum += $firstMatrix[$i * $columns + $col] * $secondMatrix[$row * $columns + $i];
            }

            // Store the sum in the result matrix
            $result[$row * $columns + $col] = $sum;
        }
    }

    return $result;
}

// Example matrices represented as single-dimensional arrays
$firstMatrix = [
    1, 2, 3, 4,
    5, 6, 7, 8,
    9, 10, 11, 12,
    12, 14, 15, 16
];

$secondMatrix = [
    1, 2, 3, 4,
    5, 1, 2, 1,
    3, 2, 1, 3,
    6, 1, 2, 3
];

// Perform multiplication and store the result in a separate matrix
$result = multiplyMatrices($firstMatrix, $secondMatrix);

// Output the result
echo "Resultant Matrix:\n";
for ($i = 0; $i < count($result); $i += 4) {
    echo implode(", ", array_slice($result, $i, 4)) . "\n";
}

?>
