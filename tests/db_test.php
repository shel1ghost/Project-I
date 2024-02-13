<?php
    $documentRoot = $_SERVER['DOCUMENT_ROOT'];
    require($documentRoot.'/config/database.php'); 
                $sql = "UPDATE users SET name = ? WHERE email = ?;";
                $stmt = $conn->prepare($sql);
                $name = "Astra Paradox";
                $email = 'astraparadox@gmail.com';
                $stmt->bind_param("ss", $name, $email);
                if ($stmt->execute()) {
                    echo $name;
                }else{
                    echo 'error!';
                }


?>