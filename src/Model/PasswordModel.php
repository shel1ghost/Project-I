<?php

class Password {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createPassword($user_id, $application_name, $password, $category, $security_question, $security_answer, $two_factor_info) {
        $sql = "INSERT INTO passwords (user_id, application_name, password, category, security_question, security_answer, twofa_info) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("issssss", $user_id, $application_name, $password, $category, $security_question, $security_answer, $two_factor_info);
        return $stmt->execute();
    }

    public function getPasswordsByUserId($user_id) {
        $sql = "SELECT * FROM passwords WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $passwords = array();
        while ($row = $result->fetch_assoc()) {
            $passwords[] = $row;
        }
        return $passwords;
    }

    public function deletePassword($password_id) {
        $sql = "DELETE FROM passwords WHERE password_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $password_id);
        return $stmt->execute();
    }
}


// $passwordModel = new Password($conn);
// $passwordModel->createPassword($user_id, $title, $password, $two_factor_info, $security_question, $security_answer, $category);
// $passwords = $passwordModel->getPasswordsByUserId($user_id);
// foreach ($passwords as $password) {
//     // Process each password
// }

?>
