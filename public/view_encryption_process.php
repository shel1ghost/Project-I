<?php
session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}else if(!$_SESSION['authorized_user']){
    header('Location: access_passwords.php');
}
$documentRoot = $_SERVER['DOCUMENT_ROOT'];
require($documentRoot.'/config/database.php');
require($documentRoot.'/src/Controller/aes.php');
require($documentRoot.'/src/Controller/aes_process.php');
include $documentRoot.'/src/Controller/session_timeout.php';

$password_id = $_GET['id'];
$category = $_GET['category'];
$user_id = $_GET['user_id'];
$key_id = $_GET['key_id'];

//fetch the corresponding password from db
$stmt = $conn->prepare("SELECT password FROM passwords WHERE password_id = ?");
$stmt->bind_param("i", $password_id);
$stmt->execute();
$stmt->bind_result($password);
$stmt->fetch();
$stmt->close();

$stmt = $conn->prepare("SELECT key_value FROM password_keys WHERE key_id = ? AND user_id = ?");
$stmt->bind_param("ss", $key_id, $user_id);
$stmt->execute();
$stmt->bind_result($key_value);
$stmt->fetch();
$stmt->close();

$plaintext_password = decryptAES($password, $key_value);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption Process | CipherShield</title>
    <link rel="stylesheet" href="./css/view_encryption_process.css"/>
</head>
<body>
    <header>
        <div class="logo"></div>
        <div class="view_enc_process_title">
            <h1>Encryption Process - CipherShield</h1>
        </div>
        <div class="logout"><a href="logout.php">Logout</a></div>
    </header>
    <div class="main">
        <h2>How's your password actually encrypted with AES algorithm?</h2>
        <p class="description">AES (Advanced Encryption Standard) is a symmetric encryption algorithm commonly used to encrypt sensitive data like passwords. To encrypt a password using AES, a cryptographic key is generated, and the password may be padded to meet the algorithm's block size requirement. The AES algorithm then encrypts the padded password in fixed-size blocks using the generated key. The encrypted password, along with any necessary decryption information, is securely stored. During verification, the stored encrypted password is decrypted using the same key, and the result is compared with the entered password to authenticate it. Know how this process is performed with your password here:</p>
        <p><span>Plaintext Password: </span><?php echo $plaintext_password;?></p>
        <p><span>Encryption Key: </span><?php echo $key_value;?></p>
        <div>
            <?php
            $start_time = microtime(true);
            $array_plaintext = plaintextToMatrix($plaintext_password);
            $array_plaintext = convertArrayToDecimalArray($array_plaintext);
            //table ma show garne instead of matrix like format
            echo '<p class="steps">1. Converting plaintext password and key as a decimal matrix:</p>';
            echo '<div class="first_matrices">';
            echo '<table border="1" class="table"><caption>Password Matrix(4x4)</caption>';
            echo '<tr>';
            for($i=0; $i<16; $i++){
                if($i%4==0){
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '<td>'.$array_plaintext[$i].'</td>';
            }
            echo '</table>';
            $array_key = keyStringToMatrix($key_value);
            echo '<table border="1" class="table"><caption>Key Matrix(4x4)</caption>';
            echo '<tr>';
            for($i=0; $i<16; $i++){
                if($i%4==0){
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '<td>'.$array_key[$i].'</td>';
            }
            echo '</table>';
            echo '</div>';
            
            echo '<p class="steps">2. Adding initial round key (Round 1):</p>';
            $roundKeys = key_expansion($array_key, $sbox, $round_constants);
            $single_array_round_keys = convertArrayToDecimalArray($roundKeys);
            $state = $array_plaintext;
            $state = add_round_key($state, array_slice($single_array_round_keys, 0, 16));
            echo '<div class="first_matrices">';
            echo '<table border="1" class="table"><caption>Resulting State Matrix</caption>';
            echo '<tr>';
            for($i=0; $i<16; $i++){
                if($i%4==0){
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '<td>'.$state[$i].'</td>';
            }
            echo '</table>';
            echo '</div>';
            
            echo '<p class="steps">3. State matrices for next 8 rounds after substituting bytes, shifting rows, mixing columns and adding round keys:</p>';
            $start = 16;
            $end = 31;

            for ($round = 0; $round < 9; $round++) {
                $count = $round + 2;
                $state = subBytes($state, $sbox);
                echo '<p class="round_title">Round '.$count.':</p>';
                echo '<div class="first_matrices">';
                echo '<table border="1" class="table"><caption>Substitute Bytes</caption>';
                echo '<tr>';
                for($i=0; $i<16; $i++){
                    if($i%4==0){
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.$state[$i].'</td>';
                }
                echo '</table>';

                $state = shiftRows($state);
                echo '<table border="1" class="table"><caption>Shift Rows</caption>';
                echo '<tr>';
                for($i=0; $i<16; $i++){
                    if($i%4==0){
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.$state[$i].'</td>';
                }
                echo '</table>';

                $state = mixColumns($state);
                echo '<table border="1" class="table"><caption>Mix Columns</caption>';
                echo '<tr>';
                for($i=0; $i<16; $i++){
                    if($i%4==0){
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.$state[$i].'</td>';
                }
                echo '</table>';

                $state = add_round_key($state, array_slice($single_array_round_keys, $start, $end, false));
                echo '<table border="1" class="table"><caption>Add Round Key</caption>';
                echo '<tr>';
                for($i=0; $i<16; $i++){
                    if($i%4==0){
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.$state[$i].'</td>';
                }
                echo '</table>';

                $start = $end;
                $end += 16;
                
                echo '<table border="1" class="table"><caption>Resulted State Matrix</caption>';
                echo '<tr>';
                for($i=0; $i<16; $i++){
                    if($i%4==0){
                        echo '</tr>';
                        echo '<tr>';
                    }
                    echo '<td>'.$state[$i].'</td>';
                }
                echo '</table>';
                echo '</div>';
            }

            echo '<p class="steps">4. State matrix after final round (Encrypted Password): </p>';
            $state = subBytes($state, $sbox);
            $state = shiftRows($state);
            $state = add_round_key($state, array_slice($single_array_round_keys, 160, 175));
            echo '<div class="first_matrices">';
            echo '<table border="1" class="table"><caption>Final Round State Matrix</caption>';
            echo '<tr>';
            for($i=0; $i<16; $i++){
                if($i%4==0){
                    echo '</tr>';
                    echo '<tr>';
                }
                echo '<td>'.$state[$i].'</td>';
            }
            echo '</table>';
            echo '</div>';

            echo '<p class="steps">5. Converting the final round matrix decimal values to base64 encoded format:</p>';
            $encrypted_password = matrixToBase64($state);
            $end_time = microtime(true);
            $total_time = $end_time - $start_time;
            echo '<p><span>Encrypted Password: </span>'.$encrypted_password.'</p>';
            echo '<p><span>Total time taken: </span>'.number_format($total_time, 4).' seconds</p>';
            echo '<p><a href="view_pass_menu.php?category='.$category.'" class="return_back">Return Back</a></p>';
            ?>
        </div>
    </div>
</body>
</html>