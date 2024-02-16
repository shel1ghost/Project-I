<?php
function convertStringTo2DArray($string) {
    $array = [];
    $length = strlen($string);
    for ($i = 0; $i < $length; $i += 8) {
        $array[] = str_split(substr($string, $i, 8), 2);
    }
    return $array;
}

$result = convertStringTo2DArray('astra paradox test string!');
print_r($result);
?>
